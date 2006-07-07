
// $Id: conference.c,v 1.7 2005/10/27 17:53:35 stevek Exp $

/*
 * app_conference
 *
 * A channel independent conference application for Asterisk
 *
 * Copyright (C) 2002, 2003 Junghanns.NET GmbH
 * Copyright (C) 2003, 2004 HorizonLive.com, Inc.
 *
 * Klaus-Peter Junghanns <kapejod@ns1.jnetdns.de>
 *
 * This program may be modified and distributed under the 
 * terms of the GNU Public License.
 *
 */

#include "conference.h"
#include "regex.h"

//
// static variables
//

// single-linked list of current conferences
static struct ast_conference *conflist = NULL ;

// mutex for synchronizing access to conflist
AST_MUTEX_DEFINE_STATIC(conflist_lock);
//static ast_mutex_t conflist_lock = AST_MUTEX_INITIALIZER ;

// mutex for synchronizing calls to start_conference() and remove_conf()
AST_MUTEX_DEFINE_STATIC(start_stop_conf_lock);
//static ast_mutex_t start_stop_conf_lock = AST_MUTEX_INITIALIZER ;

static int conference_count = 0 ;

//
// main conference function
//

void conference_exec( struct ast_conference *conf ) 
{

	struct ast_conf_member *member, *temp_member , *membertest;
	struct conf_frame *cfr, *spoken_frames, *send_frames ;
	
	// count number of speakers, number of listeners
	int speaker_count ;
	int listener_count ;
	
	ast_log( AST_CONF_DEBUG, "[ $Revision: 1.7 $ ] entered conference_exec, name => %s\n", conf->name ) ;
	
	// timer timestamps
	struct timeval base, curr, notify ;
	gettimeofday( &base, NULL ) ;
	gettimeofday( &notify, NULL ) ;

	// holds differences of curr and base
	long time_diff = 0 ;
	long time_sleep = 0 ;
	
	int since_last_slept = 0 ;
	
	//
	// variables for checking thread frequency
	//

	// count to AST_CONF_FRAMES_PER_SECOND
	int tf_count = 0 ;
	long tf_diff = 0 ;
	float tf_frequency = 0.0 ;

	struct timeval tf_base, tf_curr ;
	gettimeofday( &tf_base, NULL ) ;

	//
	// main conference thread loop
	//

 
	while ( 42 == 42 )
	{
		// update the current timestamp
		gettimeofday( &curr, NULL ) ;

		// calculate difference in timestamps
		time_diff = usecdiff( &curr, &base ) ;

		// calculate time we should sleep
		time_sleep = AST_CONF_FRAME_INTERVAL - time_diff ;
		
		if ( time_sleep > 0 ) 
		{		
			// sleep for sleep_time ( as milliseconds )
			usleep( time_sleep * 1000 ) ;

			// reset since last slept counter
			since_last_slept = 0 ;

			continue ;
		}
		else
		{
			// long sleep warning
			if ( 
				since_last_slept == 0
				&& time_diff > AST_CONF_CONFERENCE_SLEEP * 2 
			)
			{
				ast_log( 
					AST_CONF_DEBUG, 
					"long scheduling delay, time_diff => %ld, AST_CONF_FRAME_INTERVAL => %d\n",
					time_diff, AST_CONF_FRAME_INTERVAL 
				) ;
			}

			// increment times since last slept
			++since_last_slept ;

			// sleep every other time
			if ( since_last_slept % 2 )
				usleep( 0 ) ;
		}

		// adjust the timer base ( it will be used later to timestamp outgoing frames )
		add_milliseconds( &base, AST_CONF_FRAME_INTERVAL ) ;
		
		//
		// check thread frequency
		//
	
		if ( ++tf_count >= AST_CONF_FRAMES_PER_SECOND )
		{
			// update current timestamp	
			gettimeofday( &tf_curr, NULL ) ;

			// compute timestamp difference
			tf_diff = usecdiff( &tf_curr, &tf_base ) ;

			// compute sampling frequency
			tf_frequency = ( float )( tf_diff ) / ( float )( tf_count ) ;

			if ( 
				( tf_frequency <= ( float )( AST_CONF_FRAME_INTERVAL - 1 ) )
				|| ( tf_frequency >= ( float )( AST_CONF_FRAME_INTERVAL + 1 ) )
			)
			{
				ast_log( 
					LOG_WARNING, 
					"processed frame frequency variation, name => %s, tf_count => %d, tf_diff => %ld, tf_frequency => %2.4f\n",
					conf->name, tf_count, tf_diff, tf_frequency
				) ;
			}

			// reset values 
			tf_base = tf_curr ;
			tf_count = 0 ;
		}

		//-----------------//
		// INCOMING FRAMES //
		//-----------------//

		// ast_log( AST_CONF_DEBUG, "PROCESSING FRAMES, conference => %s, step => %d, ms => %ld\n", 
		//	conf->name, step, ( base.tv_usec / 20000 ) ) ;

		// acquire conference mutex
		TIMELOG(ast_mutex_lock( &conf->lock ),1,"conf thread conf lock");

		// update the current delivery time
		conf->delivery_time = base ;

		//
		// loop through the list of members 
		// ( conf->memberlist is a single-linked list )
		//

		// ast_log( AST_CONF_DEBUG, "begin processing incoming audio, name => %s\n", conf->name ) ;

		// reset speaker and listener count
		speaker_count = 0 ;
		listener_count = 0 ;
		
		// get list of conference members
		member = conf->memberlist ;

		// reset pointer lists
		spoken_frames = NULL ;

		// loop over member list to retrieve queued frames
		while ( member != NULL )
		{
			// acquire member mutex
			TIMELOG(ast_mutex_lock( &member->lock ),1,"conf thread member lock") ;

			// check for dead members
			if ( member->remove_flag == 1 ) 
			{
				// leave message for other members of the conference
				membertest = conf->memberlist ;

				int silent_exit = 0 ;
				if (member->quiet_entry_exit == -1)
				{
				silent_exit = 1 ;
				}

				while (membertest != NULL) 
				{
					if (silent_exit < 1)
					{
						if(!strcmp(membertest->channel_name, member->channel_name)) 
						{
							ast_log( LOG_ERROR, "skipping leave message on %s\n", membertest->channel_name ) ;
						}
						else
						{
							if (!basic_play_sound ( membertest->channel_name, "leave" ))
							{
								ast_log( LOG_ERROR, "playing conference leave message FAILED on %s\n", membertest->channel_name ) ;
							}
						}
					}
					else
					{
						ast_log( LOG_NOTICE, "skipping all entry messages on %s\n", membertest->channel_name ) ;
					}
					membertest = membertest->next;
				}


				ast_log( LOG_NOTICE, "found member slated for removal, channel => %s\n", member->channel_name ) ;
				temp_member = member->next ;
				remove_member( member, conf ) ;
				member = temp_member ;
				continue ;
			}
			
			// get speaking member's audio frames,
			if ( member->type == 'L' )
			{
				// listeners never have frames
				cfr = NULL ;
			}
			else
			{
				// tell member the number of frames we're going to need ( used to help dropping algorithm )
				member->inFramesNeeded = ( time_diff / AST_CONF_FRAME_INTERVAL ) - 1 ;
								
// !!! TESTING !!!
if ( 
	conf->debug_flag == 1 
	&& member->inFramesNeeded > 0 
)
{
	ast_log( AST_CONF_DEBUG, "channel => %s, inFramesNeeded => %d, inFramesCount => %d\n", 
		member->channel_name, member->inFramesNeeded, member->inFramesCount ) ;
}

				// non-listener member should have frames,
				// unless silence detection dropped them
				cfr = get_incoming_frame( member ) ;
			}

			// handle retrieved frames
			if ( cfr == NULL ) 
			{
				// this member is listen-only, or has not spoken
				// ast_log( AST_CONF_DEBUG, "silent member, channel => %s\n", member->channel_name ) ;
				
// !!! TESTING !!!
#if 0
if ( member->speaking_state == 1 )
{
	ast_log( AST_CONF_DEBUG, "member has stopped speaking, channel => %s, incoming => %d, outgoing => %d\n",
		member->channel_name, member->inFramesCount, member->outFramesCount ) ;
}
#endif
if ( conf->debug_flag == 1 )
{
	ast_log( AST_CONF_DEBUG, "member is silent, channel => %s, incoming => %d, outgoing => %d\n",
		member->channel_name, member->inFramesCount, member->outFramesCount ) ;
}

				// mark member as silent
				member->speaking_state = 0 ;
				
				// count the listeners
				++listener_count ;
			}
			else if ( cfr->fr == NULL )
			{
				ast_log( AST_CONF_DEBUG, "got incoming conf_frame with null ast_frame\n" ) ;

// !!! TESTING !!!
#if 0
if ( member->speaking_state == 1 )
{
	ast_log( AST_CONF_DEBUG, "member has stopped speaking, channel => %s, incoming => %d, outgoing => %d\n",
		member->channel_name, member->inFramesCount, member->outFramesCount ) ;
}
#endif
if ( conf->debug_flag == 1 )
{
	ast_log( AST_CONF_DEBUG, "member is silent, channel => %s, incoming => %d, outgoing => %d\n",
		member->channel_name, member->inFramesCount, member->outFramesCount ) ;
}

				// mark member as silent
				member->speaking_state = 0 ;
				
				// count the listeners
				++listener_count ;
			}
			else
			{
				// this speaking member has spoken
				// ast_log( AST_CONF_DEBUG, "speaking member, channel => %s\n", member->channel_name ) ;
				
				// append the frame to the list of spoken frames
				if ( spoken_frames != NULL ) 
				{
					// add new frame to end of list
					cfr->next = spoken_frames ;
					spoken_frames->prev = cfr ;
				}

				// point the list at the new frame
				spoken_frames = cfr ;
				
// !!! TESTING !!!
#if 0
if ( member->speaking_state == 0 )
{
	ast_log( AST_CONF_DEBUG, "member has started speaking, channel => %s, incoming => %d, outgoing => %d\n",
		member->channel_name, member->inFramesCount, member->outFramesCount ) ;
}
#endif
if ( conf->debug_flag == 1 )
{
	ast_log( AST_CONF_DEBUG, "member is speaking, channel => %s, incoming => %d, outgoing => %d\n",
		member->channel_name, member->inFramesCount, member->outFramesCount ) ;
}
				
				// mark member as speaker
				member->speaking_state = 1 ;
				member->speaking_state_notify = 1 ;
				
				// count the speakers
				++speaker_count ;
			}

			// release member mutex
			ast_mutex_unlock( &member->lock ) ;

			// adjust our pointer to the next inline
			member = member->next ;
		} 

		//
		// break, if we have no more members
		//

		if ( conf->membercount == 0 ) 
		{
			ast_log( LOG_NOTICE, "removing conference, count => %d, name => %s\n", conf->membercount, conf->name ) ;
			remove_conf( conf ) ; // stop the conference
			break ; // break from main processing loop
		}

		// ast_log( AST_CONF_DEBUG, "finished processing incoming audio, name => %s\n", conf->name ) ;


		//---------------//
		// MIXING FRAMES //
		//---------------//

		// mix frames and get batch of outgoing frames
		send_frames = mix_frames( spoken_frames, speaker_count, listener_count ) ;

		// accounting: if there are frames, count them as one incoming frame
		if ( send_frames != NULL )
		{
			// set delivery timestamp 
			// set_conf_frame_delivery( send_frames, base ) ;

			// ast_log( AST_CONF_DEBUG, "base => %ld.%ld %d\n", base.tv_sec, base.tv_usec, ( int )( base.tv_usec / 1000 ) ) ;

			conf->stats.frames_in++ ;
		}
			
		//-----------------//
		// OUTGOING FRAMES //
		//-----------------//


		//
		// queue send frames
		//
		
		// ast_log( AST_CONF_DEBUG, "begin queueing outgoing audio, name => %s\n", conf->name ) ;
		
		//
		// loop over member list to queue outgoing frames
		//
		for ( member = conf->memberlist ; member != NULL ; member = member->next ) 
		{			
			// skip members that are not ready
			if ( member->ready_for_outgoing == 0 )
				continue ;
		
			if ( member->speaking_state == 0 )
			{
				// queue listener frame
				queue_frame_for_listener( conf, member, send_frames ) ;
			}
			else
			{
				// queue speaker frame
				queue_frame_for_speaker( conf, member, send_frames ) ;
			}
		}

		// ast_log( AST_CONF_DEBUG, "end queueing outgoing audio, name => %s\n", conf->name ) ;

		//---------//
		// CLEANUP //
		//---------//

		// clean up send frames		
		while ( send_frames != NULL )
		{		
			// accouting: count all frames and mixed frames
			if ( send_frames->member == NULL )
				conf->stats.frames_out++ ;
			else
				conf->stats.frames_mixed++ ;
			
			// delete the frame
			send_frames = delete_conf_frame( send_frames ) ;
		}

		//
		// notify the manager of state changes every 500 milliseconds
		//
		
		if ( ( usecdiff( &curr, &notify ) / AST_CONF_NOTIFICATION_SLEEP ) >= 1 )
		{
			// send the notifications
			send_state_change_notifications( conf->memberlist ) ;
		
			// increment the notification timer base
			add_milliseconds( &notify, AST_CONF_NOTIFICATION_SLEEP ) ;
		}

		// release conference mutex
		ast_mutex_unlock( &conf->lock ) ;
		
		// !!! TESTING !!!
		// usleep( 1 ) ;
	} 
	// end while ( 42 == 42 )

	//
	// exit the conference thread
	// 
	
	ast_log( AST_CONF_DEBUG, "exit conference_exec\n" ) ;

	// exit the thread
	pthread_exit( NULL ) ;

	return ;
}

//
// manange conference functions
//

// called by app_conference.c:load_module()
void init_conference( void ) 
{
	ast_mutex_init( &start_stop_conf_lock ) ;
	ast_mutex_init( &conflist_lock ) ;
}

struct ast_conference* start_conference( struct ast_conf_member* member ) 
{
	// check input
	if ( member == NULL )
	{
		ast_log( LOG_WARNING, "unable to handle null member\n" ) ;
		return NULL ;
	}

	struct ast_conference* conf = NULL ;

	// acquire mutex
	ast_mutex_lock( &start_stop_conf_lock ) ;

	// look for an existing conference
	ast_log( AST_CONF_DEBUG, "attempting to find requested conference\n" ) ;
	conf = find_conf( member->id ) ;
	
	// unable to find an existing conference, try to create one
	if ( conf == NULL )
	{
		// create a new conference
		ast_log( AST_CONF_DEBUG, "attempting to create requested conference\n" ) ;

		// create the new conference with one member
		conf = create_conf( member->id, member ) ;

		// return an error if create_conf() failed
		if ( conf == NULL ) 
		{
			ast_log( LOG_ERROR, "unable to find or create requested conference\n" ) ;
			ast_mutex_unlock( &start_stop_conf_lock ) ; // release mutex
			return NULL ;
		}
	}
	else
	{
		//
		// existing conference found, add new member to the conference
		//
		// once we call add_member(), this thread
		// is responsible for calling delete_member()
		//
		add_member( member, conf ) ;
		
	}

	// release mutex
	ast_mutex_unlock( &start_stop_conf_lock ) ;

	return conf ;
}


struct ast_conference* find_conf( const char* name ) 
{	
	// no conferences exist
	if ( conflist == NULL ) 
	{
		ast_log( AST_CONF_DEBUG, "conflist has not yet been initialized, name => %s\n", name ) ;
		return NULL ;
	}
	
	// acquire mutex
	ast_mutex_lock( &conflist_lock ) ;

	struct ast_conference *conf = conflist ;
	
	// loop through conf list
	while ( conf != NULL ) 
	{
		if ( strncasecmp( (char*)&(conf->name), name, 80 ) == 0 )
		{
			// found conf name match 
			ast_log( AST_CONF_DEBUG, "found conference in conflist, name => %s\n", name ) ;
			break ;
		}
	
		conf = conf->next ;
	}

	// release mutex
	ast_mutex_unlock( &conflist_lock ) ;

	if ( conf == NULL )
	{
		ast_log( AST_CONF_DEBUG, "unable to find conference in conflist, name => %s\n", name ) ;
	}

	return conf ;
}

struct ast_conference* create_conf( char* name, struct ast_conf_member* member )
{
	ast_log( AST_CONF_DEBUG, "entered create_conf, name => %s\n", name ) ;	

	//
	// allocate memory for conference
	//

	struct ast_conference *conf = malloc( sizeof( struct ast_conference ) ) ;
	
	if ( conf == NULL ) 
	{
		ast_log( LOG_ERROR, "unable to malloc ast_conference\n" ) ;
		return NULL ;
	}

	//
	// initialize conference
	//
	
	conf->next = NULL ;
	conf->memberlist = NULL ;

	conf->membercount = 0 ;
	conf->conference_thread = -1 ;

	conf->debug_flag = 0 ;

	// zero stats
	memset(	&conf->stats, 0x0, sizeof( ast_conference_stats ) ) ;
	
	// record start time
	gettimeofday( &conf->stats.time_entered, NULL ) ;

	// copy name to conference
	strncpy( (char*)&(conf->name), name, sizeof(conf->name) - 1 ) ;
	strncpy( (char*)&(conf->stats.name), name, sizeof(conf->name) - 1 ) ;
	
	// initialize mutexes
	ast_mutex_init( &conf->lock ) ;
	
	// build translation paths	

	int c;	
	for ( c = 0 ; c < AC_SUPPORTED_FORMATS ; ++c )
	{
		if ( c == AC_SLINEAR_INDEX )
			conf->from_slinear_paths[ c ] = NULL;
		else 
			conf->from_slinear_paths[ c ] =ast_translator_build_path( 1 << c, AST_FORMAT_SLINEAR);
	}

	// add the initial member
	add_member( member, conf ) ;
	
	//
	// prepend new conference to conflist
	//

	// acquire mutex
	ast_mutex_lock( &conflist_lock ) ;

	conf->next = conflist ;
	conflist = conf ;

	ast_log( AST_CONF_DEBUG, "added new conference to conflist, name => %s\n", name ) ;

	//
	// spawn thread for new conference, using conference_exec( conf )
	//

	// acquire conference mutexes
	ast_mutex_lock( &conf->lock ) ;
	
	if ( pthread_create( &conf->conference_thread, NULL, (void*)conference_exec, conf ) == 0 ) 
	{
		// detach the thread so it doesn't leak
		pthread_detach( conf->conference_thread ) ;
	
		// release conference mutexes
		ast_mutex_unlock( &conf->lock ) ;

		ast_log( AST_CONF_DEBUG, "started conference thread for conference, name => %s\n", conf->name ) ;
	}
	else
	{
		ast_log( LOG_ERROR, "unable to start conference thread for conference %s\n", conf->name ) ;
		
		conf->conference_thread = -1 ;

		// release conference mutexes
		ast_mutex_unlock( &conf->lock ) ;

		// clean up conference
		free( conf ) ;
		conf = NULL ;
	}

	// count new conference 
	if ( conf != NULL )
		++conference_count ;

	// release mutex
	ast_mutex_unlock( &conflist_lock ) ;

	return conf ;
}

void remove_conf( struct ast_conference *conf )
{
	// ast_log( AST_CONF_DEBUG, "attempting to remove conference, name => %s\n", conf->name ) ;

	struct ast_conference *conf_current = conflist ;
	struct ast_conference *conf_temp = NULL ;

	// acquire mutex
	ast_mutex_lock( &start_stop_conf_lock ) ;

	// acquire mutex
	ast_mutex_lock( &conflist_lock ) ;

	// loop through list of conferences
	while ( conf_current != NULL ) 
	{
		// if conf_current point to the passed conf,
		if ( conf_current == conf ) 
		{
			if ( conf_temp == NULL ) 
			{
				// this is the first conf in the list, so we just point 
				// conflist past the current conf to the next
				conflist = conf_current->next ;
			}
			else 
			{
				// this is not the first conf in the list, so we need to
				// point the preceeding conf to the next conf in the list
				conf_temp->next = conf_current->next ;
			}

			//
			// do some frame clean up
			//
			int c;	
			for ( c = 0 ; c < AC_SUPPORTED_FORMATS ; ++c )
			{				
				// free the translation paths
				if ( conf_current->from_slinear_paths[ c ] != NULL )
				{
					ast_translator_free_path( conf_current->from_slinear_paths[ c ] ) ;
					conf_current->from_slinear_paths[ c ] = NULL ;
				}
			}

			// calculate time in conference
			struct timeval time_exited ;
			gettimeofday( &time_exited, NULL ) ;
			
			// total time converted to seconds
			long tt = ( usecdiff( &time_exited, &conf_current->stats.time_entered ) / 1000 ) ;
	
			// report accounting information
			ast_log( LOG_NOTICE, "conference accounting, fi => %ld, fo => %ld, fm => %ld, tt => %ld\n",
				conf_current->stats.frames_in, conf_current->stats.frames_out, conf_current->stats.frames_mixed, tt ) ;

			ast_log( AST_CONF_DEBUG, "removed conference, name => %s\n", conf_current->name ) ;

			ast_mutex_unlock( &conf_current->lock ) ;
			
			free( conf_current ) ;
			conf_current = NULL ;
			
			break ;
		}

		// save a refence to the soon to be previous conf
		conf_temp = conf_current ;
		
		// move conf_current to the next in the list
		conf_current = conf_current->next ;
	}
	
	// count new conference 
	--conference_count ;

	// release mutex
	ast_mutex_unlock( &conflist_lock ) ;
	
	// release mutex
	ast_mutex_unlock( &start_stop_conf_lock ) ;

	return ;
}

//
// member-related functions
//

void add_member( struct ast_conf_member *member, struct ast_conference *conf ) 
{
	if ( conf == NULL ) 
	{
		ast_log( LOG_ERROR, "unable to add member to NULL conference\n" ) ;
		return ;
	}
	
	// acquire the conference lock
	ast_mutex_lock( &conf->lock ) ;

	member->next = conf->memberlist ; // next is now list
	conf->memberlist = member ; // member is now at head of list

	// update conference stats
	count_member( member, conf, 1 ) ;

	ast_log( AST_CONF_DEBUG, "member added to conference, name => %s\n", conf->name ) ;
	
	// release the conference lock
	ast_mutex_unlock( &conf->lock ) ;	

	return ;
}

int remove_member( struct ast_conf_member* member, struct ast_conference* conf ) 
{
	// check for member
	if ( member == NULL )
	{
		ast_log( LOG_WARNING, "unable to remove NULL member\n" ) ;
		return -1 ;
	}

	// check for conference
	if ( conf == NULL )
	{
		ast_log( LOG_WARNING, "unable to remove member from NULL conference\n" ) ;
		return -1 ;
	}

	//
	// loop through the member list looking
	// for the requested member
	//

	struct ast_conf_member *member_list = conf->memberlist ;
	struct ast_conf_member *member_temp = NULL ;
	
	int count = -1 ; // default return code

	while ( member_list != NULL ) 
	{
		if ( member_list == member ) 
		{
			//
			// log some accounting information
			//

			// calculate time in conference
			struct timeval time_exited ;
			gettimeofday( &time_exited, NULL ) ;
			long tt = ( usecdiff( &time_exited, &member->time_entered ) / 1000 ) ; // convert to seconds

			ast_log( 
				LOG_NOTICE, 
				"member accounting, channel => %s, te => %ld, fi => %ld, fid => %ld, fo => %ld, fod => %ld, tt => %ld\n",
				member->channel_name,
				member->time_entered.tv_sec, member->frames_in, member->frames_in_dropped, 
				member->frames_out, member->frames_out_dropped, tt 
			) ;

			//
			// if this is the first member in the linked-list,
			// skip over the first member in the list, else
			//
			// point the previous 'next' to the current 'next',
			// thus skipping the current member in the list	
			//	
			if ( member_temp == NULL )
				conf->memberlist = member->next ;
			else 
				member_temp->next = member->next ;

			// update conference stats
			count = count_member( member, conf, 0 ) ;

			// delete the member
			delete_member( member ) ;
			
			ast_log( AST_CONF_DEBUG, "removed member from conference, name => %s, remaining => %d\n", conf->name, conf->membercount ) ;
			
			break ;
		}
		
		// save a pointer to the current member,
		// and then point to the next member in the list
		member_temp = member_list ;
		member_list = member_list->next ;
	}
	
	// return -1 on error, or the number of members 
	// remaining if the requested member was deleted
	return count ;
}

int count_member( struct ast_conf_member* member, struct ast_conference* conf, short add_member )
{
	if ( member == NULL || conf == NULL )
	{
		ast_log( LOG_WARNING, "unable to count member\n" ) ;
		return -1 ;
	}

	short delta = ( add_member == 1 ) ? 1 : -1 ;

	// member type
	if ( memberIsModerator( member ) == 1 )
	{
		conf->stats.moderators += delta ;
	}
	else 
	{
		// count non-moderators as listeners
		conf->stats.listeners += delta ;
	}

	// connection type
	if ( memberIsPhoneClient( member ) == 1 )
	{
		conf->stats.phone += delta ;
	}
	else if ( memberIsIaxClient( member ) == 1 )
	{
		conf->stats.iaxclient += delta ;
	}
	else if ( memberIsSIPClient( member ) == 1 )
	{
		conf->stats.sip += delta ;
	}
	
	// increment member count
	conf->membercount += delta ;

	return conf->membercount ;
}

//
// queue incoming frame functions
//

int queue_frame_for_speaker( 
	struct ast_conference* conf, 
	struct ast_conf_member* member, 
	conf_frame* frame
)
{
	//
	// check inputs
	//
	
	if ( conf == NULL )
	{
		ast_log( LOG_WARNING, "unable to queue speaker frame with null conference\n" ) ;
		return -1 ;
	}
	
	if ( member == NULL )
	{
		ast_log( LOG_WARNING, "unable to queue speaker frame with null member\n" ) ;
		return -1 ;
	}
	
	//
	// loop over spoken frames looking for member's appropriate match
	//
	
	short found_flag = 0 ;
	struct ast_frame* qf ;
	
	for ( ; frame != NULL ; frame = frame->next ) 
	{
		if ( frame->member != member )
			continue ;

		if ( frame->fr == NULL )
		{
			ast_log( LOG_WARNING, "unable to queue speaker frame with null data\n" ) ;
			continue ;
		}

		//
		// convert and queue frame
		//
		
		// short-cut pointer to the ast_frame
		qf = frame->fr ;

		// acquire member lock
		TIMELOG(ast_mutex_lock( &member->lock ),1,"queue_frame_for_speaker: memberlock") ;
	
		if ( qf->subclass == member->write_format )
		{
			// frame is already in correct format, so just queue it
			queue_outgoing_frame( member, qf, conf->delivery_time ) ;
		}
		else
		{
			//
			// convert frame to member's write format
			// ( calling ast_frdup() to make sure the translator's copy sticks around )
			//
			qf = convert_frame_from_slinear( member->from_slinear, ast_frdup( qf ) ) ;

			if ( qf != NULL )
			{
				// queue frame
				queue_outgoing_frame( member, qf, conf->delivery_time ) ;
				
				// free frame ( the translator's copy )
				ast_frfree( qf ) ;
			}
			else
			{
				ast_log( LOG_WARNING, "unable to translate outgoing speaker frame, channel => %s\n", member->channel_name ) ;
			}
		}

		// release member lock
		ast_mutex_unlock( &member->lock ) ;
		
		// set found flag
		found_flag = 1 ;
		
		// we found the frame, skip to the next member
		break ;
	}
	
	// queue a silent frame
	if ( found_flag == 0 )
		queue_silent_frame( conf, member ) ;
	
	return 0 ;
}

int queue_frame_for_listener( 
	struct ast_conference* conf, 
	struct ast_conf_member* member, 
	conf_frame* frame
)
{
	//
	// check inputs
	//
	
	if ( conf == NULL )
	{
		ast_log( LOG_WARNING, "unable to queue listener frame with null conference\n" ) ;
		return -1 ;
	}
	
	if ( member == NULL )
	{
		ast_log( LOG_WARNING, "unable to queue listener frame with null member\n" ) ;
		return -1 ;
	}

	//
	// loop over spoken frames looking for member's appropriate match
	//

	short found_flag = 0 ;
	struct ast_frame* qf ;

	for ( ; frame != NULL ; frame = frame->next ) 
	{
		// we're looking for a null or matching member
		if ( frame->member != NULL && frame->member != member )
			continue ;
	
		if ( frame->fr == NULL )
		{
			ast_log( LOG_WARNING, "unknown error queueing frame for listener, frame->fr == NULL\n" ) ;
			continue ;
		}

		// acquire member lock
		TIMELOG(ast_mutex_lock( &member->lock ),1,"queue_frame_for_listener") ;

		// first, try for a pre-converted frame
		qf = frame->converted[ member->write_format_index ] ;

		/*
		if ( qf != NULL && (member->smooth_size_out > 0)) {
			if (qf->datalen != member->smooth_size_out ) {
//ast_log (AST_CONF_DEBUG, "ignoring and freeing previously stored frame, with datalen=>%d != smooth_size_out=>%d\n",qf->datalen,member->smooth_size_out);
				ast_frfree( qf ) ;
				qf = NULL ;
			}
		}
		*/
	
		// convert ( and store ) the frame
		if ( qf == NULL )
		{		
			// make a copy of the slinear version of the frame
			qf = ast_frdup( frame->fr ) ;	
			
			if ( qf == NULL )
			{
				ast_log( LOG_WARNING, "unable to duplicate frame\n" ) ;
				continue ;
			}
			
			// convert using the conference's translation path
			qf = convert_frame_from_slinear( conf->from_slinear_paths[ member->write_format_index ], qf ) ;
			if ( qf == NULL )
				ast_log( LOG_WARNING, "unable to translate frame for listener, channel => %s , member->write_format => %d , member->write_format_index %d , qf->frametype -> %d , qf->subclass -> %d, qf->datalen=> %d, qf->samples =>%d\n", member->channel_name , member->write_format, member->write_format_index, qf->frametype, qf->subclass , qf->datalen, qf->samples) ;
			
			// store the converted frame
			// ( the frame will be free'd next time through the loop )
			frame->converted[ member->write_format_index ] = qf ;
//ast_log (AST_CONF_DEBUG, "storing converted frame into index=>%d, qf->frametype=>%d, qf->subclass=%d, qf->datalen=%d \n",member->write_format_index, qf->frametype, qf->subclass, qf->datalen);
		}

		if ( qf != NULL )
		{
			// duplicate the frame before queue'ing it
			// ( since this member doesn't own this _shared_ frame )
			// qf = ast_frdup( qf ) ;
			
			if ( queue_outgoing_frame( member, qf, conf->delivery_time ) != 0 )
			{
				// free the new frame if it couldn't be queue'd
				ast_frfree( qf ) ;
				qf = NULL ;
			}
		}
		else
		{
			ast_log( LOG_WARNING, "unable to translate outgoing listener frame, channel => %s\n", member->channel_name ) ;
		}

		// release member lock
		ast_mutex_unlock( &member->lock ) ;
		
		// set found flag
		found_flag = 1 ;
		
		// break from for loop
		break ;
	}
	
	// queue a silent frame
	if ( found_flag == 0 )
		queue_silent_frame( conf, member ) ;

	return 0 ;
}

int queue_silent_frame( 
	struct ast_conference* conf, 
	struct ast_conf_member* member
)
{	
#ifdef APP_CONFERENCE_DEBUG
	//
	// check inputs
	//
	
	if ( conf == NULL )
	{
		ast_log( AST_CONF_DEBUG, "unable to queue silent frame for null conference\n" ) ;
		return -1 ;
	}
	
	if ( member == NULL )
	{
		ast_log( AST_CONF_DEBUG, "unable to queue silent frame for null member\n" ) ;
		return -1 ;
	}
#endif // APP_CONFERENCE_DEBUG

	//
	// initialize static variables
	//

	static conf_frame* silent_frame = NULL ;
	static struct ast_frame* qf = NULL ;

	if ( silent_frame == NULL )
	{
		if ( ( silent_frame = get_silent_frame() ) == NULL )
		{
			ast_log( LOG_WARNING, "unable to initialize static silent frame\n" ) ;
			return -1 ;
		}
	}	

	// acquire member lock
	TIMELOG(ast_mutex_lock( &member->lock ),1,"queue_silent_frame") ;

	// get the appropriate silent frame
	qf = silent_frame->converted[ member->write_format_index ] ;
	
	if ( qf == NULL )
	{
		//
		// we need to do this to avoid echo on the speaker's line.
		// translators seem to be single-purpose, i.e. they
		// can't be used simultaneously for multiple audio streams
		//
	
		struct ast_trans_pvt* trans = ast_translator_build_path( member->write_format, AST_FORMAT_SLINEAR ) ;
	
		if ( trans != NULL )
		{
			// attempt ( five times ) to get a silent frame
			// to make sure we provice the translator with enough data 
			int c;
			for ( c = 0 ; c < 5 ; ++c )
			{
				// translate the frame
				qf = ast_translate( trans, silent_frame->fr, 0 ) ;
				
				// break if we get a frame
				if ( qf != NULL ) break ;
			}
			
			if ( qf != NULL )
			{
				// isolate the frame so we can keep it around after trans is free'd
				qf = ast_frisolate( qf ) ;
			
				// cache the new, isolated frame
				silent_frame->converted[ member->write_format_index ] = qf ;
			}
			
			ast_translator_free_path( trans ) ;
		}
	}
	
	//
	// queue the frame, if it's not null, 
	// otherwise there was an error
	//
	if ( qf != NULL )
	{
		queue_outgoing_frame( member, qf, conf->delivery_time ) ;
	}
	else
	{
		ast_log( LOG_ERROR, "unable to translate outgoing silent frame, channel => %s\n", member->channel_name ) ;
	}
	
	// release member lock
	ast_mutex_unlock( &member->lock ) ;

	return 0 ;
}

//
// get conference stats
//

//
// returns: -1 => error, 0 => debugging off, 1 => debugging on
// state: on => 1, off => 0, toggle => -1
//
int set_conference_debugging( const char* name, int state )
{
	if ( name == NULL )
		return -1 ;

	// acquire mutex
	ast_mutex_lock( &conflist_lock ) ;

	struct ast_conference *conf = conflist ;
	int new_state = -1 ;
	
	// loop through conf list
	while ( conf != NULL ) 
	{
		if ( strncasecmp( (const char*)&(conf->name), name, 80 ) == 0 )
		{
			// lock conference
			// ast_mutex_lock( &(conf->lock) ) ;

			// toggle or set the state
			if ( state == -1 )
				conf->debug_flag = ( conf->debug_flag == 0 ) ? 1 : 0 ;
			else
				conf->debug_flag = ( state == 0 ) ? 0 : 1 ;

			new_state = conf->debug_flag ;

			// unlock conference
			// ast_mutex_unlock( &(conf->lock) ) ;

			break ;
		}
	
		conf = conf->next ;
	}

	// release mutex
	ast_mutex_unlock( &conflist_lock ) ;
	
	return new_state ;
}

int get_conference_count( void ) 
{
	return conference_count ;
}

int get_conference_stats( ast_conference_stats* stats, int requested )
{	
	// no conferences exist
	if ( conflist == NULL ) 
	{
		ast_log( AST_CONF_DEBUG, "conflist has not yet been initialize\n" ) ;
		return 0 ;
	}
	
	// acquire mutex
	ast_mutex_lock( &conflist_lock ) ;

	// compare the number of requested to the number of available conferences
	requested = ( get_conference_count() < requested ) ? get_conference_count() : requested ;

	//
	// loop through conf list
	//

	struct ast_conference* conf = conflist ;
	int count = 0 ;
	
	while ( count <= requested && conf != NULL ) 
	{
		// copy stats struct to array
		stats[ count ] = conf->stats ; 
		
		conf = conf->next ;
		++count ;
	}

	// release mutex
	ast_mutex_unlock( &conflist_lock ) ;

	return count ;
}

int get_conference_stats_by_name( ast_conference_stats* stats, const char* name )
{	
	// no conferences exist
	if ( conflist == NULL ) 
	{
		ast_log( AST_CONF_DEBUG, "conflist has not yet been initialized, name => %s\n", name ) ;
		return 0 ;
	}
	
	// make sure stats is null
	stats = NULL ;
	
	// acquire mutex
	ast_mutex_lock( &conflist_lock ) ;

	struct ast_conference *conf = conflist ;
	
	// loop through conf list
	while ( conf != NULL ) 
	{
		if ( strncasecmp( (const char*)&(conf->name), name, 80 ) == 0 )
		{
			// copy stats for found conference
			*stats = conf->stats ;
			break ;
		}
	
		conf = conf->next ;
	}

	// release mutex
	ast_mutex_unlock( &conflist_lock ) ;

	return ( stats == NULL ) ? 0 : 1 ;
}

struct ast_conf_member *find_member ( char *chan, int lock) 
{
	struct ast_conf_member *found = NULL;
	struct ast_conf_member *member;	
	struct ast_conference *conf;



	ast_mutex_lock( &conflist_lock ) ;

	conf = conflist;

	// loop through conf list
	while ( conf != NULL && !found ) 
	{
		// lock conference
		ast_mutex_lock( &conf->lock );

		member = conf->memberlist ;

		while (member != NULL) 
		{
		    if(!strcmp(member->channel_name, chan)) {
			found = member;
			if(lock) 
			    ast_mutex_lock(&member->lock);
			break;
		    }
		    member = member->next;
		}

		// unlock conference
		ast_mutex_unlock( &conf->lock );

		conf = conf->next ;
	}

	// release mutex
	ast_mutex_unlock( &conflist_lock ) ;

	return found;
}

