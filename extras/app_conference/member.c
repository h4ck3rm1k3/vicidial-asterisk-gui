
// $Id: member.c,v 1.9-1 2006/06/01 16:10:10 mflorell Exp $

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

#include "member.h"
#include "regex.h"



// process an incoming frame.  Returns 0 normally, 1 if hangup was received.
static int process_incoming(struct ast_conference *conf, struct ast_conf_member *member, struct ast_frame *f) 
{

	int silent_frame = 0;

	if ( 
		f->frametype == AST_FRAME_DTMF
		&& member->send_dtmf
	)
	{	// send the DTMF event to the MGR interface..
		manager_event(
			EVENT_FLAG_CALL,
			"ConferenceDTMF",
			"Channel: %s\r\n"
			"Key: %c\r\n",
			member->channel_name,
			f->subclass
		) ;

		ast_frfree(f);
		f = NULL;
	}
	else if ( member->type == 'L' )
	{
		// this is a listen-only user, ignore the frame
		ast_frfree( f ) ;
		f = NULL ;
	}
	else if ( ( f->frametype == AST_FRAME_VOICE ) || (f->frametype == AST_FRAME_DTMF) )
//	else if ( f->frametype == AST_FRAME_VOICE )
	{			
		// accounting: count the incoming frame
		member->frames_in++ ;

		if (f->frametype == AST_FRAME_DTMF)
		{
			if ( (member->inband_dtmf == -1) || (member->rfc_dtmf == -1) )
			{
				char *digit = "X" ;
				char *dtmfRFC = "X" ;
				int conf_count ;
				struct ast_conf_member *membertest;

				if (f->subclass == 35) { digit = "hash" ;   dtmfRFC = "#" ; }
				if (f->subclass == 42) { digit = "star" ;   dtmfRFC = "*" ; }
				if (f->subclass == 48) { digit = "0" ;   dtmfRFC = "0" ; }
				if (f->subclass == 49) { digit = "1" ;   dtmfRFC = "1" ; }
				if (f->subclass == 50) { digit = "2" ;   dtmfRFC = "2" ; }
				if (f->subclass == 51) { digit = "3" ;   dtmfRFC = "3" ; }
				if (f->subclass == 52) { digit = "4" ;   dtmfRFC = "4" ; }
				if (f->subclass == 53) { digit = "5" ;   dtmfRFC = "5" ; }
				if (f->subclass == 54) { digit = "6" ;   dtmfRFC = "6" ; }
				if (f->subclass == 55) { digit = "7" ;   dtmfRFC = "7" ; }
				if (f->subclass == 56) { digit = "8" ;   dtmfRFC = "8" ; }
				if (f->subclass == 57) { digit = "9" ;   dtmfRFC = "9" ; }

				ast_log( LOG_NOTICE, "DTMF debug frame output to voice %d - %s\n", f->subclass, digit ) ;

				int res = 0 ;
				int dtmf_invalid = 0 ;
				regex_t re;
			  
				if(regcomp(&re, digit, REG_EXTENDED|REG_NOSUB) != 0) { dtmf_invalid = 0; }
				dtmf_invalid = regexec(&re, "0123456789*#abcdABCDstarhash", (size_t)0, NULL, 0);
				regfree(&re);
				ast_log( LOG_NOTICE, "Regex debug %d - %s - %s\n", dtmf_invalid, member->channel_name, digit) ;

				// play DTMF for other members of the conference
				membertest = conf->memberlist ;
				conf_count = conf->membercount ;

			//	ast_log( LOG_NOTICE, "2 DTMF debug frame output to voice, conf count %d\n", conf_count) ;

				while (membertest != NULL) 
				{
					
					if( (!strcmp(membertest->channel_name, member->channel_name)) || ( digit == "X" ) )
					{
						ast_log( LOG_ERROR, "skipping playing DTMF tone on %s\n", membertest->channel_name ) ;
					}
					else
					{

						if (member->inband_dtmf == -1)
						{
							if (!basic_play_sound ( membertest->channel_name, digit ))
							{
								ast_log( LOG_ERROR, "playing DTMF tone FAILED on %s\n", membertest->channel_name ) ;
							}
						}

						if (member->rfc_dtmf == -1)
						{
							ast_log( LOG_NOTICE, "START sending DTMF signal on %s\n", membertest->channel_name ) ;

							if(dtmf_invalid > 0)
							{
								ast_log(LOG_WARNING, "Illegal DTMF character '%s' in string. (0-9*#aAbBcCdD allowed)\n", digit);
							}
							else 
							{

								res = ast_dtmf_stream(membertest->chan,NULL,digit,250);
								if (res)
								{
									ast_log( LOG_NOTICE, "DTMF signal %s on %s sent\n", digit,  membertest->channel_name ) ;
								}
							}
						}
					}
					membertest = membertest->next;
				}
			}


		}


#ifdef DEBUG_OUTPUT_PCM
		// !!! TESTING !!!
		if ( member->incoming_fh != NULL )
		{
			fwrite( f->data, f->datalen, 1, member->incoming_fh ) ;
			fflush( member->incoming_fh ) ;
		}
#endif
				
#if ( SILDET == 2 )
		// 
		// make sure we have a valid dsp and frame type
		//
		if ( 
			member->dsp != NULL
			&& f->subclass == AST_FORMAT_SLINEAR 
			&& f->datalen == AST_CONF_FRAME_DATA_SIZE
		)
		{
			// send the frame to the preprocessor
#ifdef DEBUG_USE_TIMELOG
			int spx_ret;
			TIMELOG(spx_ret = speex_preprocess( member->dsp, f->data, NULL ), 3, "speex_preprocess"); 
			if ( spx_ret == 0 )
#else
			if ( speex_preprocess( member->dsp, f->data, NULL ) == 0 )
#endif
			{
				//
				// we ignore the preprocessor's outcome if we've seen voice frames 
				// in within the last AST_CONF_SKIP_SPEEX_PREPROCESS frames
				//
				if ( member->ignore_speex_count > 0 )
				{
					// ast_log( AST_CONF_DEBUG, "ignore_speex_count => %d\n", member->ignore_speex_count ) ;
				
					// skip speex_preprocess(), and decrement counter
					--member->ignore_speex_count ;
				}
				else
				{
					// set silent_frame flag
					silent_frame = 1 ;
				}
			}
			else
			{
				// voice detected, reset skip count
				member->ignore_speex_count = AST_CONF_SKIP_SPEEX_PREPROCESS ;
			}
		}
#endif

		// used to debug drop off in received frames
  //				struct timeval tv ;
  //				gettimeofday( &tv, NULL ) ;

		if ( silent_frame == 1 ) 
		{
			// ignore silent frames
  //					ast_log( AST_CONF_DEBUG, "RECEIVED SILENT FRAME, channel => %s, frames_in => %ld, s => %ld, ms => %ld\n", 
  //						member->channel_name, member->frames_in, tv.tv_sec, tv.tv_usec ) ;
		} 
		else 
		{				
			// queue a non-silent frame for mixing

  //					ast_log( AST_CONF_DEBUG, "RECEIVED VOICE FRAME, channel => %s, frames_in => %ld, s => %ld, ms => %ld\n", 
  //						member->channel_name, member->frames_in, tv.tv_sec, tv.tv_usec ) ;

			// acquire member lock
			ast_mutex_lock( &member->lock ) ;

			//
			// queue up the voice frame so the conference 
			// thread can mix them before sending
			//
					
  //					struct ast_frame* af = ast_frdup( f ) ;
			
  //					if ( queue_incoming_frame( member, af ) != 0 )
			if ( queue_incoming_frame( member, f ) != 0 )
			{
				// free the duplicated frame, if we can't queue it
				// ast_log( LOG_NOTICE, "dropped incoming frame, channel => %s\n", chan->name ) ;
				// ast_frfree( af ) ;
				// af = NULL ;
			}
			else
			{
				// everything is going ok
			}

			// release member mutex
			ast_mutex_unlock( &member->lock ) ;
		}

		// free the original frame
		ast_frfree( f ) ;
		f = NULL ;
	}
	else if ( 
		f->frametype == AST_FRAME_CONTROL
		&& f->subclass == AST_CONTROL_HANGUP 
	) 
	{
		// hangup received
		
		// free the frame 
		ast_frfree( f ) ;
		f = NULL ;
		
		// break out of the while ( 42 == 42 )
		return 1 ;
	}
	else
	{
		// undesirables
		ast_frfree( f ) ;
		f = NULL ;
	}
	return 0;
}

// get the next frame from the soundq;  must be called with member locked.
static struct ast_frame *get_next_soundframe(struct ast_conf_member *member, struct ast_frame
    *exampleframe) {
    struct ast_frame *f;

again:
    f=ast_readframe(member->soundq->stream); 

    if(!f) { // we're done with this sound; remove it from the queue, and try again
	struct ast_conf_soundq *toboot = member->soundq;

	ast_closestream(toboot->stream);
	member->soundq = toboot->next;

	//ast_log( LOG_WARNING, "finished playing a sound, next = %x\n", member->soundq);
	// notify applications via mgr interface that this sound has been played
	manager_event(
		EVENT_FLAG_CALL, 
		"ConferenceSoundComplete", 
		"Channel: %s\r\n"
		"Sound: %s\r\n",
		member->channel_name, 
		toboot->name
	);

	free(toboot);
	if(member->soundq) goto again;

	// if we get here, we've gotten to the end of the queue; reset write format
	if ( ast_set_write_format( member->chan, member->write_format ) < 0 ) 
	{
		ast_log( LOG_ERROR, "unable to set write format to %d\n",
		    member->write_format ) ;
	}
    } else {
	// copy delivery from exampleframe
	f->delivery = exampleframe->delivery;
    }

    return f;
}

// process outgoing frames for the channel, playing either normal conference audio,
// or requested sounds
static int process_outgoing(struct ast_conf_member *member) 
{
	conf_frame* cf ; // frame read from the output queue
	struct ast_frame *f;
	struct ast_frame *realframe = NULL;

	for(;;)
	{	
		// acquire member mutex and grab a frame.
		ast_mutex_lock( &member->lock ) ;
		cf = get_outgoing_frame( member ) ;

		// if there's no frames exit the loop.
		if(!cf){
		    ast_mutex_unlock( &member->lock ) ;
		    break;
		}

		f = cf->fr;

		// if we're playing sounds, we can just replace the frame with the
		// next sound frame, and send it instead
		if(member->soundq) {
		    realframe = f;
		    f = get_next_soundframe(member, f);
		    if(!f) { // if we didn't get anything, just revert to "normal"
			f = realframe;
			realframe = NULL;
		    }
		}

		ast_mutex_unlock(&member->lock);

#ifdef DEBUG_FRAME_TIMESTAMPS	
		// !!! TESTING !!!
		int delivery_diff = usecdiff( &f->delivery, &member->lastsent_timeval ) ;
		if ( ( delivery_diff != AST_CONF_FRAME_INTERVAL     ) && 
		     ( delivery_diff != 2 * AST_CONF_FRAME_INTERVAL )  &&
		     ( delivery_diff != 3 * AST_CONF_FRAME_INTERVAL ) )
		{		
			ast_log( AST_CONF_DEBUG, "unanticipated delivery time, delivery_diff => %d, delivery.tv_usec => %ld\n", 
				delivery_diff, f->delivery.tv_usec ) ;
		}

		// !!! TESTING !!!
		if ( 	
			f->delivery.tv_sec < member->lastsent_timeval.tv_sec 
			|| ( 
				f->delivery.tv_sec == member->lastsent_timeval.tv_sec 
				&& f->delivery.tv_usec <= member->lastsent_timeval.tv_usec 
			)
		)
		{
			ast_log( LOG_WARNING, "queued frame timestamped in the past, %ld.%ld <= %ld.%ld\n",
				f->delivery.tv_sec, f->delivery.tv_usec, 
				member->lastsent_timeval.tv_sec, member->lastsent_timeval.tv_usec ) ;
		}
		member->lastsent_timeval = f->delivery ;
#endif

//#ifdef DEBUG_USE_TIMELOG
//		TIMELOG( ast_write( member->chan, f ), 10, "member: ast_write");
//#else
		// send the voice frame
		if ( ast_write( member->chan, f ) == 0 )
		{
			// struct timeval tv ;
			// gettimeofday( &tv, NULL ) ;
			// ast_log( AST_CONF_DEBUG, "SENT VOICE FRAME, channel => %s, frames_out => %ld, s => %ld, ms => %ld\n", 
			//	member->channel_name, member->frames_out, tv.tv_sec, tv.tv_usec ) ;
		}
		else
		{
			// log 'dropped' outgoing frame
			ast_log( LOG_ERROR, "unable to write voice frame to channel, channel => %s\n", member->channel_name ) ;

			// accounting: count dropped outgoing frames
			member->frames_out_dropped++ ;
		}
//#endif

		// clean up frame
		delete_conf_frame( cf ) ;
	}
	return 0;
}

//
// main member thread function
//

int member_exec( struct ast_channel* chan, void* data )
{
//	struct timeval start, end ;
//	gettimeofday( &start, NULL ) ;

	struct ast_conference *conf ;
	struct ast_conf_member *member, *membertest;

	struct ast_frame *f ; // frame received from ast_read()

	int left = 0 ;
	int res;
	
	ast_log( AST_CONF_DEBUG, "[ $Revision: 1.9 $ ] begin processing member thread, channel => %s\n", chan->name ) ;
	
	// 
	// If the call has not yet been answered, answer the call
	// Note: asterisk apps seem to check _state, but it seems like it's safe
	// to just call ast_answer.  It will just do nothing if it is up.
	// it will also return -1 if the channel is a zombie, or has hung up.
	//
	
	res = ast_answer( chan ) ;
	if ( res ) 
	{
		ast_log( LOG_ERROR, "unable to answer call\n" ) ;
		return -1 ;
	}

	//
	// create a new member for the conference
 	//
	
//	ast_log( AST_CONF_DEBUG, "creating new member, id => %s, flags => %s, p => %s\n", 
//		id, flags, priority ) ;
	
	member = create_member( chan, (const char*)( data ) ) ; // flags, atoi( priority ) ) ;
	
	// unable to create member, return an error
	if ( member == NULL ) 
	{
		ast_log( LOG_ERROR, "unable to create member\n" ) ;
		return -1 ;
	} 

	//
	// setup asterisk read/write formats
	//
	
	ast_log( AST_CONF_DEBUG, "CHANNEL INFO, CHANNEL => %s, DNID => %s, CALLER_ID => %s, ANI => %s\n", 
		chan->name, chan->cid.cid_dnid, chan->cid.cid_num, chan->cid.cid_ani ) ;

	ast_log( AST_CONF_DEBUG, "CHANNEL CODECS, CHANNEL => %s, NATIVE => %d, READ => %d, WRITE => %d\n", 
		chan->name, chan->nativeformats, member->read_format, member->write_format ) ;

	if ( ast_set_read_format( chan, member->read_format ) < 0 )
	{
		ast_log( LOG_ERROR, "unable to set read format to signed linear\n" ) ;
		delete_member( member ) ;
		return -1 ;
	} 

	// for right now, we'll send everything as slinear
	if ( ast_set_write_format( chan, member->write_format ) < 0 ) // AST_FORMAT_SLINEAR, chan->nativeformats
	{
		ast_log( LOG_ERROR, "unable to set write format to signed linear\n" ) ;
		delete_member( member ) ;
		return -1 ;
	}

	//
	// setup a conference for the new member
	//

	conf = start_conference( member ) ;
		
	if ( conf == NULL )
	{
		ast_log( LOG_ERROR, "unable to setup member conference\n" ) ;
		delete_member( member) ;
		return -1 ;
	}
		
#ifdef DEBUG_OUTPUT_PCM
	// !!! TESTING !!!
	char* incoming_fn = malloc( 512 ) ;
	snprintf( incoming_fn, 512, "/tmp/ac_%s_%ld.gsm", chan->dnid, fr_base.tv_usec ) ;

	// !!! TESTING !!!
	member->incoming_fh = ( member->read_format == 2 ) 
		? fopen( member->incoming_fn, "wb" )
		: NULL 
	;

	// !!! TESTING !!!
	if ( member->incoming_fh == NULL )
	{
		ast_log( AST_CONF_DEBUG, "incoming_fh is null, incoming_fn => %s\n", incoming_fn ) ;
	}
	else
	{
		ast_log( AST_CONF_DEBUG, "incoming_fh is not null, incoming_fn => %s\n", incoming_fn ) ;
	}

	// !!! TESTING !!!
	free( incoming_fn ) ;
#endif

	//
	// process loop for new member ( this runs in it's own thread
	//
	
	ast_log( AST_CONF_DEBUG, "begin member event loop, channel => %s\n", chan->name ) ;
	
	// timer timestamps
	struct timeval base, curr ;
	gettimeofday( &base, NULL ) ;



	// tell conference_exec we're ready for frames
	member->ready_for_outgoing = 1 ;

	int conf_count = 0 ;
	int silent_entry = 0 ;

	// entry message for other members of the conference
	membertest = conf->memberlist ;
	conf_count = conf->membercount ;

	ast_log( LOG_NOTICE, "Conference Members: %d\n", conf_count ) ;

	if (member->quiet_entry_exit == -1)
	{
	silent_entry = 1 ;
	}
	ast_log( LOG_NOTICE, "Quiet debug %d - %d\n", member->quiet_entry_exit, silent_entry ) ;

	while (membertest != NULL) 
	{
		if (silent_entry < 1)
		{
			if( (!strcmp(membertest->channel_name, member->channel_name)) && (conf_count < 2) )
			{
				ast_log( LOG_NOTICE, "skipping entry message on %s\n", membertest->channel_name ) ;

				if (!basic_play_sound ( member->channel_name, "conf-onlyperson" ))
				{
				ast_log( LOG_ERROR, "playing conference welcome message FAILED\n" ) ;
				}
			}
			else
			{
				if (!basic_play_sound ( membertest->channel_name, "enter" ))
				{
					ast_log( LOG_ERROR, "playing conference entry message FAILED on %s\n", membertest->channel_name ) ;
				}
			}
		}
		else
		{
			ast_log( LOG_NOTICE, "skipping all entry messages on %s\n", membertest->channel_name ) ;
		}

		membertest = membertest->next;
	}



	while ( 42 == 42 )
	{
		// make sure we have a channel to process
		if ( chan == NULL )
		{
			ast_log( LOG_NOTICE, "member channel has closed\n" ) ;
			break ;
		}

		//-----------------//
		// INCOMING FRAMES //
		//-----------------//
		
		// wait for an event on this channel
		left = ast_waitfor( chan, AST_CONF_WAITFOR_LATENCY ) ;

		// ast_log( AST_CONF_DEBUG, "received event on channel, name => %s, rest => %d\n", chan->name, rest ) ;
		
		if ( left < 0 )
		{
			// an error occured	
			ast_log( 
				LOG_NOTICE, 
				"an error occured waiting for a frame, channel => %s, error => %d\n", 
				chan->name, left
			) ;
		}
		else if ( left == 0 )
		{
			// no frame has arrived yet
			// ast_log( LOG_NOTICE, "no frame available from channel, channel => %s\n", chan->name ) ;
		}
		else if ( left > 0 ) 
		{
			// a frame has come in before the latency timeout 
			// was reached, so we process the frame

			f = ast_read( chan ) ;
			
			if ( f == NULL ) 
			{
				ast_log( LOG_NOTICE, "unable to read from channel, channel => %s\n", chan->name ) ;
				break ;
			}

			// actually process the frame: break if we got hangup.
			if(process_incoming(conf, member, f)) break;

		}
		
		//-----------------//
		// OUTGOING FRAMES //
		//-----------------//

		// update the current timestamps
		gettimeofday( &curr, NULL ) ;

		process_outgoing(member);


		// back to process incoming frames
		continue ;
	}

	ast_log( AST_CONF_DEBUG, "end member event loop, time_entered => %ld\n", member->time_entered.tv_sec ) ;
	
	//
	// clean up
	//

#ifdef DEBUG_OUTPUT_PCM
	// !!! TESTING !!!	
	if ( member->incoming_fh != NULL )
		fclose( member->incoming_fh ) ;
#endif

	if ( member != NULL ) member->remove_flag = 1 ;

//	gettimeofday( &end, NULL ) ;
//	int expected_frames = ( int )( floor( (double)( usecdiff( &end, &start ) / AST_CONF_FRAME_INTERVAL ) ) ) ;
//	ast_log( AST_CONF_DEBUG, "expected_frames => %d\n", expected_frames ) ;

	return -1 ;
}

// basic sound playing function
int basic_play_sound ( char *channel, char *file )
{
//	char *channel, *file;
	struct ast_conf_member *play_member;
	struct ast_conf_soundq *newsound;
	struct ast_conf_soundq **q;

		play_member = find_member(channel, 1);
		if(!play_member) {
			ast_log( LOG_ERROR, "Member %s not found\n", channel) ;
			return 0;
		}

	newsound = calloc(1,sizeof(struct ast_conf_soundq));
	newsound->stream = ast_openstream(play_member->chan, file, NULL);
	if(!newsound->stream) { 
		free(newsound);
		ast_mutex_unlock(&play_member->lock);
	ast_log( LOG_ERROR, "sound file not found\n" ) ;
	}
	play_member->chan->stream = NULL;

	ast_copy_string(newsound->name, file, sizeof(newsound->name));

	// append sound to the end of the list.
	for(q=&play_member->soundq; *q; q = &((*q)->next)) ;;

	*q = newsound;

	ast_mutex_unlock(&play_member->lock);

	ast_log( LOG_NOTICE, "playing conference message %s\n", file ) ;
	return 1;
}

//
// manange member functions
//

struct ast_conf_member* create_member( struct ast_channel *chan, const char* data ) 
{
	//
	// check input
	//
	
	if ( chan == NULL )
	{
		ast_log( LOG_ERROR, "unable to create member with null channel\n" ) ;
		return NULL ;
	}
	
	if ( chan->name == NULL )
	{
		ast_log( LOG_ERROR, "unable to create member with null channel name\n" ) ;
		return NULL ;
	}
	
	//
	// allocate memory for new conference member
	//

	struct ast_conf_member *member = calloc( 1, sizeof( struct ast_conf_member ) ) ;
	
	if ( member == NULL ) 
	{
		ast_log( LOG_ERROR, "unable to malloc ast_conf_member\n" ) ;
		return NULL ;
	}
	
	// initialize mutex
	ast_mutex_init( &member->lock ) ;

	//
	// initialize member with passed data values
	//
	
	char argstr[80] ;
	char *stringp, *token ;

	// copy the passed data
	strncpy( argstr, data, sizeof(argstr) - 1 ) ;

	// point to the copied data
	stringp = argstr ;
	
	ast_log( AST_CONF_DEBUG, "attempting to parse passed params, stringp => %s\n", stringp ) ;
	
	// parse the id
	if ( ( token = strsep( &stringp, "|" ) ) != NULL )
	{
		member->id = malloc( strlen( token ) + 1 ) ;
		strcpy( member->id, token ) ;
	}
	else
	{
		ast_log( LOG_ERROR, "unable to parse member id\n" ) ;
		free( member ) ;
		return NULL ;
	}

	// parse the flags
	if ( ( token = strsep( &stringp, "|" ) ) != NULL )
	{
		member->flags = malloc( strlen( token ) + 1 ) ;
		strcpy( member->flags, token ) ;
	}
	else
	{
		// make member->flags something 
		member->flags = malloc( sizeof( char ) ) ;
		memset( member->flags, 0x0, sizeof( char ) ) ;
	}
	
	// parse the priority
	member->priority = ( token = strsep( &stringp, "|" ) ) != NULL
		? atoi( token ) 
		: 0
	;

	// parse the vad_prob_start
	member->vad_prob_start = ( token = strsep( &stringp, "|" ) ) != NULL
		? atof( token ) 
		: AST_CONF_PROB_START
	;
	
	// parse the vad_prob_continue
	member->vad_prob_continue = ( token = strsep( &stringp, "|" ) ) != NULL
		? atof( token ) 
		: AST_CONF_PROB_CONTINUE
	;

	// parse the expected frame size, in samples. ??
	

	// debugging
	ast_log( 
		AST_CONF_DEBUG, 
		"parsed data params, id => %s, flags => %s, priority => %d, vad_prob_start => %f, vad_prob_continue => %f\n",
		member->id, member->flags, member->priority, member->vad_prob_start, member->vad_prob_continue
	) ;

	//
	// initialize member with default values
	//

	// keep pointer to member's channel
	member->chan = chan ;
	
	// copy the channel name
	member->channel_name = malloc( strlen( chan->name ) + 1 ) ;
	strcpy( member->channel_name, chan->name ) ;
			
	// ( default can be overridden by passed flags )
//	member->type = 'L' ;
	member->type = 'S' ;

	// ready flag
	member->ready_for_outgoing = 0 ;

	// incoming frame queue
	member->inFrames = NULL ;
	member->inFramesTail = NULL ;
	member->inFramesCount = 0 ;

	// last frame caching
	member->inFramesRepeatLast = 0 ;
	member->inFramesLast = NULL ; 
	member->okayToCacheLast = 0 ;

	// outgoing frame queue
	member->outFrames = NULL ;
	member->outFramesTail = NULL ;
	member->outFramesCount = 0 ;
	
	member->outPacker = NULL;

	// ( not currently used )
	// member->samplesperframe = AST_CONF_BLOCK_SAMPLES ;

	// used for determining need to mix frames
	// and for management interface notification
	member->speaking_state_prev = 0 ;
	member->speaking_state_notify = 0 ;
	member->speaking_state = 0 ;

	// linked-list pointer
	member->next = NULL ;
	
	// account data
	member->frames_in = 0 ;
	member->frames_in_dropped = 0 ;
	member->frames_out = 0 ;
	member->frames_out_dropped = 0 ;

	// for counting sequentially dropped frames
	member->sequential_drops = 0 ;
	member->since_dropped = 0 ;

	// flags
	member->remove_flag = 0 ;

	// record start time
	gettimeofday( &member->time_entered, NULL ) ;

	// init dropped frame timestamps
	gettimeofday( &member->last_in_dropped, NULL ) ;
	gettimeofday( &member->last_out_dropped, NULL ) ;

	//
	// parse passed flags
	//
	
	// silence detection flags w/ defaults
	int vad_flag = 0 ;
	int denoise_flag = 0 ;
	int agc_flag = 0 ;
	
	// is this member using the telephone?
	int via_telephone = 0 ;
	
	// temp pointer to flags string
	// char* flags = member->flags ;
	char* flags = member->flags ;
	int i;
	for ( i = 0 ; i < strlen( flags ) ; ++i )
	{
		// allowed flags are M, L, S, V, D, A
		switch ( flags[i] )
		{
			// call via telephone
			case 'T':
				via_telephone = 1 ;
				break ;
		
			// member types ( last flag wins )
			case 'M':
				member->type = 'M' ;
				break ;
			case 'L':
				member->type = 'L' ;
				break ;
			case 'S':
				member->type = 'S' ;
				break ;

			// speex preprocessing options
			case 'V':
				vad_flag = 1 ;
				break ;
			case 'D':
				denoise_flag = 1 ;
				break ;
			case 'A':
				agc_flag = 1 ;
				break ;

			// additional features
			case 'd': // Send DTMF manager events..
				member->send_dtmf = 1;
				break;
			case 'q': // Quiet entry and exit from conference
				member->quiet_entry_exit = 1;
				break;
			case 'i': // use Inband DTMF broadcast
				member->inband_dtmf = 1;
				break;
			case 't': // use RFC DTMF broadcast
				member->rfc_dtmf = 1;
				break;

			default:
				ast_log( LOG_WARNING, "received invalid flag, chan => %s, flag => %c\n", 
					chan->name, flags[i] ) ;			
				break ;
		}
	}

	// set the dsp to null so silence detection is disabled by default
	member->dsp = NULL ;

#if ( SILDET == 2 )
	//
	// configure silence detection and preprocessing
	// if the user is coming in via the telephone, 
	// and is not listen-only
	//
	if ( 
		via_telephone == 1 
		&& member->type != 'L'
	)
	{
		// create a speex preprocessor
		member->dsp = speex_preprocess_state_init( AST_CONF_BLOCK_SAMPLES, AST_CONF_SAMPLE_RATE ) ;
		
		if ( member->dsp == NULL ) 
		{
			ast_log( LOG_WARNING, "unable to initialize member dsp, channel => %s\n", chan->name ) ;
		}
		else
		{
			ast_log( LOG_NOTICE, "member dsp initialized, channel => %s, v => %d, d => %d, a => %d\n", 
				chan->name, vad_flag, denoise_flag, agc_flag ) ;
		
			// set speex preprocessor options
			speex_preprocess_ctl( member->dsp, SPEEX_PREPROCESS_SET_VAD, &vad_flag ) ;
			speex_preprocess_ctl( member->dsp, SPEEX_PREPROCESS_SET_DENOISE, &denoise_flag ) ;
			speex_preprocess_ctl( member->dsp, SPEEX_PREPROCESS_SET_AGC, &agc_flag ) ;

			speex_preprocess_ctl( member->dsp, SPEEX_PREPROCESS_SET_PROB_START, &member->vad_prob_start ) ;
			speex_preprocess_ctl( member->dsp, SPEEX_PREPROCESS_SET_PROB_CONTINUE, &member->vad_prob_continue ) ;
			
			ast_log( AST_CONF_DEBUG, "speech_prob_start => %f, speech_prob_continue => %f\n", 
				member->dsp->speech_prob_start, member->dsp->speech_prob_continue ) ;
		}
	}
#endif

	//
	// set connection type
	//

	if ( via_telephone == 1 )
	{
		member->connection_type = 'T' ;
	}
	else if ( strncmp( member->channel_name, "SIP", 3 ) == 0 )
	{
		member->connection_type = 'S' ;
	}
	else // default to iax
	{
		member->connection_type = 'X' ;
	}

	//
	// read, write, and translation options
	//

	// set member's audio formats, taking dsp preprocessing into account
	// ( chan->nativeformats, AST_FORMAT_SLINEAR, AST_FORMAT_ULAW, AST_FORMAT_GSM )
	member->read_format = ( member->dsp == NULL ) ? chan->nativeformats : AST_FORMAT_SLINEAR ;
	member->write_format = chan->nativeformats ;
	
	// translation paths ( ast_translator_build_path() returns null if formats match )
	member->to_slinear = ast_translator_build_path( AST_FORMAT_SLINEAR, member->read_format ) ;
	member->from_slinear = ast_translator_build_path( member->write_format, AST_FORMAT_SLINEAR ) ;
	
	//ast_log( AST_CONF_DEBUG, "AST_FORMAT_SLINEAR => %d\n", AST_FORMAT_SLINEAR ) ;
	
	// index for converted_frames array
	{
		int format, index;
		index=-1;
		format = member->write_format;
		while( format > 0){
			index++;	
			format = format >> 1;
		}
		member->write_format_index= index;
		//ast_log( AST_CONF_DEBUG, "converted write_format [%d] to index[%d]\n", member->write_format, index );

		index=-1;
		format = member->read_format;
		while( format > 0){
			index++;	
			format = format >> 1;
		}
		member->read_format_index=index;
		//ast_log( AST_CONF_DEBUG, "converted read_format [%d] to index[%d]\n", member->read_format, index );
	}

	// smoother defaults.
	member->smooth_multiple =1;
	member->smooth_size_in = -1;
	member->smooth_size_out = -1;
	member->inSmoother= NULL;
	member->outPacker= NULL;

	switch (member->read_format){
			/* these assumptions may be incorrect */
			case AST_FORMAT_ULAW:
			case AST_FORMAT_ALAW:
				/*
				member->smooth_size_in  = 160; //bytes
				member->smooth_size_out = 160; //samples
				*/
				break;
			case AST_FORMAT_GSM:
				/*
				member->smooth_size_in  = 33; //bytes
				member->smooth_size_out = 160;//samples
				*/
				break;
			case AST_FORMAT_SPEEX:
				/* this assumptions are wrong 
				member->smooth_multiple = 2 ;  // for testing, force to dual frame
				member->smooth_size_in  = 39;  // bytes
				member->smooth_size_out = 160; // samples
				*/
				break;
			case AST_FORMAT_SLINEAR:
				/*
				member->smooth_size_in  = 320; //bytes
				member->smooth_size_out = 160; //samples
				*/
				break;
			default:
				member->inSmoother = NULL; //don't use smoother for this type.
				//ast_log( AST_CONF_DEBUG, "smoother is NULL for member->read_format => %d\n", member->read_format);
	}
	if (member->smooth_size_in > 0){
		member->inSmoother = ast_smoother_new(member->smooth_size_in); 
		//ast_log( AST_CONF_DEBUG, "created smoother(%d) for %d\n", member->smooth_size_in , member->read_format);
	}


	//
	// finish up
	//
		
	ast_log( AST_CONF_DEBUG, "created member, type => %c, priority => %d, readformat => %d\n", 	
		member->type, member->priority, chan->readformat ) ;

	return member ;
}

struct ast_conf_member* delete_member( struct ast_conf_member* member ) 
{
	// !!! NO RETURN TEST !!!
	// do { sleep(1) ; } while (1) ;

	// !!! CRASH TEST !!!
	// *((int *)0) = 0;

	if ( member == NULL )
	{
		ast_log( LOG_WARNING, "unable to the delete null member\n" ) ;
		return NULL ;
	}
	
	//
	// clean up member flags
	//
	
	if ( member->flags != NULL )
	{
		// !!! DEBUGING !!!	
		ast_log( AST_CONF_DEBUG, "freeing member flags, name => %s\n", 
			member->channel_name ) ;
		free( member->flags ) ;
	}
	
	//
	// delete the members frames
	//

	conf_frame* cf ;

	// !!! DEBUGING !!!	
	ast_log( AST_CONF_DEBUG, "deleting member input frames, name => %s\n", 
		member->channel_name ) ;

	// incoming frames
	cf = member->inFrames ;
	
	while ( cf != NULL )
	{
		cf = delete_conf_frame( cf ) ;
	}
	if (member->inSmoother != NULL)
		ast_smoother_free(member->inSmoother);

	// !!! DEBUGING !!!	
	ast_log( AST_CONF_DEBUG, "deleting member output frames, name => %s\n", 
		member->channel_name ) ;

	// outgoing frames
	cf = member->outFrames ;
	
	while ( cf != NULL )
	{
		cf = delete_conf_frame( cf ) ;
	}
	
	if (member->outPacker != NULL)
		ast_packer_free(member->outPacker);
	

#if ( SILDET == 2 )
	if ( member->dsp != NULL )
	{
		// !!! DEBUGING !!!	
		ast_log( AST_CONF_DEBUG, "destroying member preprocessor, name => %s\n", 
			member->channel_name ) ;
		speex_preprocess_state_destroy( member->dsp ) ;
	}
#endif

	// !!! DEBUGING !!!	
	ast_log( AST_CONF_DEBUG, "freeing member translator paths, name => %s\n", 
		member->channel_name ) ;

	// free the mixing translators
	ast_translator_free_path( member->to_slinear ) ;
	ast_translator_free_path( member->from_slinear ) ;

	// get a pointer to the next 
	// member so we can return it
	struct ast_conf_member* nm = member->next ;
	
	// !!! DEBUGING !!!	
	ast_log( AST_CONF_DEBUG, "freeing member channel name, name => %s\n", 
		member->channel_name ) ;

	// free the member's copy for the channel name
	free( member->channel_name ) ;
	
	// !!! DEBUGING !!!	
	ast_log( AST_CONF_DEBUG, "freeing member\n" ) ;

	// free the member's memory
	free( member ) ;
	member = NULL ;
	
	return nm ;
}

//
// incoming frame functions
//

conf_frame* get_incoming_frame( struct ast_conf_member *member )
{
	//
	// sanity checks
	//
	
	if ( member == NULL )
	{
		ast_log( LOG_WARNING, "unable to get frame from null member\n" ) ;
		return NULL ;
	}
 
 	//
 	// repeat last frame a couple times to smooth transition
 	//
 	
#ifdef AST_CONF_CACHE_LAST_FRAME
	if ( member->inFramesCount == 0 )
	{
		// nothing to do if there's no cached frame
		if ( member->inFramesLast == NULL )
			return NULL ;

		// turn off 'okay to cache' flag
		member->okayToCacheLast = 0 ;

		if ( member->inFramesRepeatLast >= AST_CONF_CACHE_LAST_FRAME )
		{
			// already used this frame AST_CONF_CACHE_LAST_FRAME times
		
			// reset repeat count
			member->inFramesRepeatLast = 0 ;
			
			// clear the cached frame
			delete_conf_frame( member->inFramesLast ) ;
			member->inFramesLast = NULL ;
			
			// return null
			return NULL ;
		}
		else
		{			 
			ast_log( AST_CONF_DEBUG, "repeating cached frame, channel => %s, inFramesRepeatLast => %d\n",
				member->channel_name, member->inFramesRepeatLast ) ;
		
			// increment counter
			member->inFramesRepeatLast++ ;
			
			// return a copy of the cached frame
			return copy_conf_frame( member->inFramesLast ) ;
		}		
	}
	else if ( member->okayToCacheLast == 0 && member->inFramesCount >= 3 ) 
	{
		ast_log( AST_CONF_DEBUG, "enabling cached frame, channel => %s, incoming => %d, outgoing => %d\n",
			member->channel_name, member->inFramesCount, member->outFramesCount ) ;
	
		// turn on 'okay to cache' flag
		member->okayToCacheLast = 1 ;
	}
#else
	if ( member->inFramesCount == 0 )
		return NULL ;
#endif // AST_CONF_CACHE_LAST_FRAME

	//
	// return the next frame in the queue
	//
	
	conf_frame* cfr = NULL ;

	// get first frame in line
	cfr = member->inFramesTail ;

	// if it's the only frame, reset the queue,
	// else, move the second frame to the front
	if ( member->inFramesTail == member->inFrames )
	{
		member->inFramesTail = NULL ;
		member->inFrames = NULL ;
	} 
	else 
	{
		// move the pointer to the next frame
		member->inFramesTail = member->inFramesTail->prev ;

		// reset it's 'next' pointer
		if ( member->inFramesTail != NULL ) 
			member->inFramesTail->next = NULL ;
	}

	// separate the conf frame from the list
	cfr->next = NULL ;
	cfr->prev = NULL ;

	// decriment frame count
	member->inFramesCount-- ;
	
#ifdef AST_CONF_CACHE_LAST_FRAME
	// copy frame if queue is now empty
	if ( 
		member->inFramesCount == 0 
		&& member->okayToCacheLast == 1 
	)
	{
		// reset repeat count
		member->inFramesRepeatLast = 0 ;

		// clear cached frame
		if ( member->inFramesLast != NULL )
		{
			delete_conf_frame( member->inFramesLast ) ;
			member->inFramesLast = NULL ;
		}
		
		// cache new frame  
		member->inFramesLast = copy_conf_frame( cfr ) ;
	}
#endif // AST_CONF_CACHE_LAST_FRAME
	
	return cfr ;
}

int queue_incoming_frame( struct ast_conf_member* member, struct ast_frame* fr ) 
{
	//
	// sanity checks
	//
	
	// check on frame
	if ( fr == NULL ) 
	{
		ast_log( LOG_ERROR, "unable to queue null frame\n" ) ;
		return -1 ;
	}
	
	// check on member
	if ( member == NULL )
	{
		ast_log( LOG_ERROR, "unable to queue frame for null member\n" ) ;
		return -1 ;
	}

	//
	// drop a frame if we've filled half the buffer
	// ( no more than once per AST_CONF_QUEUE_DROP_TIME_LIMIT ms )
	//
	

	/*
ast_log( 
	AST_CONF_DEBUG,
	"queue frame on channel => %s, fr->subclass => %d, fr->datalen => %d, fr->samples => %d\n",
	member->channel_name, fr->subclass, fr->datalen, fr->samples
) ;
*/


	if ( member->inFramesCount > member->inFramesNeeded )
	{
		if ( member->inFramesCount > AST_CONF_QUEUE_DROP_THRESHOLD ) 
		{
			struct timeval curr ;
			gettimeofday( &curr, NULL ) ;

			// time since last dropped frame			
			long diff = usecdiff( &curr, &member->last_in_dropped ) ;

			// number of milliseconds which must pass between frame drops
			// ( 15 frames => -100ms, 10 frames => 400ms, 5 frames => 900ms, 0 frames => 1400ms, etc. )
			long time_limit = 1000 - ( ( member->inFramesCount - AST_CONF_QUEUE_DROP_THRESHOLD ) * 100 ) ;
			
			if ( diff >= time_limit )
			{
				// count sequential drops
				member->sequential_drops++ ;
	
			//	ast_log( 
			//		AST_CONF_DEBUG,
			//		"dropping frame from input buffer, channel => %s, incoming => %d, outgoing => %d\n",
			//		member->channel_name, member->inFramesCount, member->outFramesCount
			//	) ;
				
				// accounting: count dropped incoming frames
				member->frames_in_dropped++ ;
	
				// reset frames since dropped
				member->since_dropped = 0 ;
	
				// delete the frame
				delete_conf_frame( get_incoming_frame( member ) ) ;
				
				gettimeofday( &member->last_in_dropped, NULL ) ;
			}
			else
			{
/*
				ast_log( 
					AST_CONF_DEBUG,
					"input buffer larger than drop threshold, channel => %s, incoming => %d, outgoing => %d\n",
					member->channel_name, member->inFramesCount, member->outFramesCount
				) ;
*/
			}
		}
	}

	//
	// if we have to drop frames, we'll drop new frames
	// because it's easier ( and doesn't matter much anyway ).
	//
	
	if ( member->inFramesCount >= AST_CONF_MAX_QUEUE ) 
	{
		// count sequential drops
		member->sequential_drops++ ;
	
		ast_log( 
			AST_CONF_DEBUG,
			"unable to queue incoming frame, channel => %s, incoming => %d, outgoing => %d\n",
			member->channel_name, member->inFramesCount, member->outFramesCount
		) ;

		// accounting: count dropped incoming frames
		member->frames_in_dropped++ ;

		// reset frames since dropped
		member->since_dropped = 0 ;
		
		return -1 ;
	} 

	// reset sequential drops 
	member->sequential_drops = 0 ;
	
	// increment frames since dropped
	member->since_dropped++ ;

	//
	// create new conf frame from passed data frame
	//
	
	// ( member->inFrames may be null at this point )
	if (member->inSmoother == NULL ){
		conf_frame* cfr = create_conf_frame( member, member->inFrames, fr ) ;
		if ( cfr == NULL ) 
		{
			ast_log( LOG_ERROR, "unable to malloc conf_frame\n" ) ;
			return -1 ;
		}
		
		//
		// add new frame to speaking members incoming frame queue
		// ( i.e. save this frame data, so we can distribute it in conference_exec later )
		//

		if ( member->inFrames == NULL ) {
			member->inFramesTail = cfr ;
		}
		member->inFrames = cfr ;
		member->inFramesCount++ ;
	} else {
		//feed frame(fr) into the smoother
		
		// smoother tmp frame
		struct ast_frame *sfr;
		int multiple = 1;
		int i=0;

		if ( (member->smooth_size_in > 0 ) && (member->smooth_size_in * member->smooth_multiple != fr->datalen) )
		{
			//ast_log(AST_CONF_DEBUG,"resetting smooth_size_in. old size=> %d, multiple =>%d, datalen=> %d\n", member->smooth_size_in, member->smooth_multiple, fr->datalen );
			if ( fr->datalen % member->smooth_multiple != 0) {
				// if datalen not divisible by smooth_multiple, assume we're just getting normal encoding.
			//	ast_log(AST_CONF_DEBUG,"smooth_multiple does not divide datalen. changing smooth size from %d to %d, multiple => 1\n", member->smooth_size_in, fr->datalen);
				member->smooth_size_in = fr->datalen;
				member->smooth_multiple = 1;
			} else {
				// assume a fixed multiple, so divide into datalen.
				int newsmooth = fr->datalen / member->smooth_multiple ;
			//	ast_log(AST_CONF_DEBUG,"datalen is divisible by smooth_multiple, changing smooth size from %d to %d\n", member->smooth_size_in, newsmooth);
				member->smooth_size_in = newsmooth;
			}

			//free input smoother.
			if (member->inSmoother != NULL)
				ast_smoother_free(member->inSmoother);

			//make new input smoother.
			member->inSmoother = ast_smoother_new(member->smooth_size_in); 
		}

		ast_smoother_feed( member->inSmoother, fr );
//ast_log (AST_CONF_DEBUG, "SMOOTH:Feeding frame into inSmoother, timestamp => %ld.%ld\n", fr->delivery.tv_sec, fr->delivery.tv_usec);

		if ( multiple > 1 )
			fr->samples /= multiple;

		// read smoothed version of frames, add to queue
		while( ( sfr = ast_smoother_read( member->inSmoother ) ) ){

			++i;
//ast_log( AST_CONF_DEBUG , "\treading new frame [%d] from smoother, inFramesCount[%d], \n\tsfr->frametype -> %d , sfr->subclass -> %d , sfr->datalen => %d sfr->samples => %d\n", i , member->inFramesCount , sfr->frametype, sfr->subclass, sfr->datalen, sfr->samples);
//ast_log (AST_CONF_DEBUG, "SMOOTH:Reading frame from inSmoother, i=>%d, timestamp => %ld.%ld\n",i, sfr->delivery.tv_sec, sfr->delivery.tv_usec);
			conf_frame* cfr = create_conf_frame( member, member->inFrames, sfr ) ;
			if ( cfr == NULL ) 
			{
				ast_log( LOG_ERROR, "unable to malloc conf_frame\n" ) ;
				return -1 ;
			}
			
			//
			// add new frame to speaking members incoming frame queue
			// ( i.e. save this frame data, so we can distribute it in conference_exec later )
			//

			if ( member->inFrames == NULL ) {
				member->inFramesTail = cfr ;
			}
			member->inFrames = cfr ;
			member->inFramesCount++ ;
		}
	}
	
	return 0 ;
}

//
// outgoing frame functions
//

conf_frame* get_outgoing_frame( struct ast_conf_member *member )
{
	if ( member == NULL )
	{
		ast_log( LOG_WARNING, "unable to get frame from null member\n" ) ;
		return NULL ;
	}

	conf_frame* cfr ;

	// ast_log( AST_CONF_DEBUG, "getting member frames, count => %d\n", member->outFramesCount ) ;
 
	if ( member->outFramesCount > AST_CONF_MIN_QUEUE ) 
	{
		cfr = member->outFramesTail ;
	
		// if it's the only frame, reset the queu,
		// else, move the second frame to the front
		if ( member->outFramesTail == member->outFrames )
		{
			member->outFrames = NULL ;
			member->outFramesTail = NULL ;
		} 
		else 
		{
			// move the pointer to the next frame
			member->outFramesTail = member->outFramesTail->prev ;

			// reset it's 'next' pointer
			if ( member->outFramesTail != NULL ) 
				member->outFramesTail->next = NULL ;
		}

		// separate the conf frame from the list
		cfr->next = NULL ;
		cfr->prev = NULL ;

		// decriment frame count
		member->outFramesCount-- ;
		
		return cfr ;
	} 

	return NULL ;
}

int __queue_outgoing_frame( struct ast_conf_member* member, const struct ast_frame* fr, struct timeval delivery ) 
{
	// accounting: count the number of outgoing frames for this member
	member->frames_out++ ;	
	
/*
	//
	// drop a frame if we've filled half the buffer
	//

	if ( member->outFramesCount > AST_CONF_QUEUE_DROP_THRESHOLD ) 
	{
		struct timeval curr ;
		gettimeofday( &curr, NULL ) ;
		
		long diff = usecdiff( &curr, &member->last_out_dropped ) ;
		
		if ( diff >= AST_CONF_QUEUE_DROP_TIME_LIMIT )
		{
			ast_log( 
				AST_CONF_DEBUG,
				"dropping frame from output buffer, channel => %s, incoming => %d, outgoing => %d\n",
				member->channel_name, member->inFramesCount, member->outFramesCount
			) ;

			// accounting: count dropped outgoing frames
			member->frames_out_dropped++ ;

			// delete the frame
			delete_conf_frame( get_outgoing_frame( member ) ) ;
			
			gettimeofday( &member->last_out_dropped, NULL ) ;
		}
	}
*/

	//
	// we have to drop frames, so we'll drop new frames
	// because it's easier ( and doesn't matter much anyway ).
	//
	if ( member->outFramesCount >= AST_CONF_MAX_QUEUE ) 
	{
		ast_log( 
			AST_CONF_DEBUG,
			"unable to queue outgoing frame, channel => %s, incoming => %d, outgoing => %d\n",
			member->channel_name, member->inFramesCount, member->outFramesCount
		) ;

		// accounting: count dropped outgoing frames
		member->frames_out_dropped++ ;

		return -1 ;
	}

	//
	// create new conf frame from passed data frame
	//
	
	conf_frame* cfr = create_conf_frame( member, member->outFrames, fr ) ;
	
	if ( cfr == NULL ) 
	{
		ast_log( LOG_ERROR, "unable to create new conf frame\n" ) ;

		// accounting: count dropped outgoing frames
		member->frames_out_dropped++ ;

		return -1 ;
	}

	// set delivery timestamp
	cfr->fr->delivery = delivery ;

	//
	// add new frame to speaking members incoming frame queue
	// ( i.e. save this frame data, so we can distribute it in conference_exec later )
	//

	if ( member->outFrames == NULL ) {
		member->outFramesTail = cfr ;
	}
	member->outFrames = cfr ;
	member->outFramesCount++ ;
	
	// return success
	return 0 ;
}

int queue_outgoing_frame( struct ast_conf_member* member, const struct ast_frame* fr, struct timeval delivery ) 
{
	// check on frame
	if ( fr == NULL ) 
	{
		ast_log( LOG_ERROR, "unable to queue null frame\n" ) ;
		return -1 ;
	}

	// check on member
	if ( member == NULL )
	{
		ast_log( LOG_ERROR, "unable to queue frame for null member\n" ) ;
		return -1 ;
	}
	
	
	if ( ( member->outPacker == NULL ) && ( member->smooth_multiple > 1 ) && ( member->smooth_size_out > 0 ) ){
		//ast_log (AST_CONF_DEBUG, "creating outPacker with size => %d \n\t( multiple => %d ) * ( size => %d )\n", member->smooth_multiple * member-> smooth_size_out, member->smooth_multiple , member->smooth_size_out);
		member->outPacker = ast_packer_new( member->smooth_multiple * member->smooth_size_out);
	}
	
	if (member->outPacker == NULL ){
		return __queue_outgoing_frame( member, fr, delivery ) ;
	} 
	else 
	{
		struct ast_frame *sfr;
		int exitval = 0;
//ast_log (AST_CONF_DEBUG, "sending fr into outPacker, datalen=>%d, samples=>%d\n",fr->datalen, fr->samples);
		ast_packer_feed( member->outPacker , fr );
		while( (sfr = ast_packer_read( member->outPacker ) ) )
		{
//ast_log (AST_CONF_DEBUG, "read sfr from outPacker, datalen=>%d, samples=>%d\n",sfr->datalen, sfr->samples);
			if ( __queue_outgoing_frame( member, sfr, delivery ) == -1 ) {
				exitval = -1;
			}
		}
		return exitval;
	}
}

//
// manager functions
//

void send_state_change_notifications( struct ast_conf_member* member )
{
	// ast_log( AST_CONF_DEBUG, "sending state change notification\n" ) ;

	// loop through list of members, sending state changes
	while ( member != NULL )
	{
		// has the state changed since last time through this loop?
		if ( member->speaking_state_notify != member->speaking_state_prev )
		{
			manager_event(
				EVENT_FLAG_CALL, 
				"ConferenceState", 
				"Channel: %s\r\n"
				"State: %s\r\n",
				member->channel_name, 
				( ( member->speaking_state_notify == 1 ) ? "speaking" : "silent" )
			) ;
#if 0
			ast_log( AST_CONF_DEBUG, "member state changed, channel => %s, state => %d, incoming => %d, outgoing => %d\n",
				member->channel_name, member->speaking_state_notify, member->inFramesCount, member->outFramesCount ) ;
#endif

			// remember current state
			member->speaking_state_prev = member->speaking_state_notify ;
			
			// we do not reset the speaking_state_notify flag here
		}

		// reset notification flag so that 
		member->speaking_state_notify = 0 ;

		// move the pointer to the next member
		member = member->next ;
	}
	
	return ;
}

//
// meta-info accessors functions
//

short memberIsPhoneClient( struct ast_conf_member* member )
{
	if ( member == NULL ) 
		return 0 ;
		
	return ( member->connection_type == 'T' ) ? 1 : 0 ;
}

short memberIsIaxClient( struct ast_conf_member* member )
{
	if ( member == NULL ) 
		return 0 ;
		
	return ( member->connection_type == 'X' ) ? 1 : 0 ;
}

short memberIsSIPClient( struct ast_conf_member* member )
{
	if ( member == NULL ) 
		return 0 ;
		
	return ( member->connection_type == 'S' ) ? 1 : 0 ;
}

short memberIsModerator( struct ast_conf_member* member )
{
	if ( member == NULL ) 
		return 0 ;
		
	return ( member->type == 'M' ) ? 1 : 0 ;
}

short memberIsListener( struct ast_conf_member* member )
{
	if ( member == NULL ) 
		return 0 ;
		
	return ( member->type == 'L' ) ? 1 : 0 ;
}


//
// ast_packer, adapted from ast_smoother
// pack multiple frames together into one packet on the wire.
//

#define PACKER_SIZE  8000
#define PACKER_QUEUE 10 // store at most 10 complete packets in the queue

struct ast_packer {
	int framesize; // number of frames per packet on the wire.
	int size;
	int packet_index;
	int format;
	int readdata;
	int optimizablestream;
	int flags;
	float samplesperbyte;
	struct ast_frame f;
	struct timeval delivery;
	char data[PACKER_SIZE];
	char framedata[PACKER_SIZE + AST_FRIENDLY_OFFSET];
	int samples;
	int sample_queue[PACKER_QUEUE];
	int len_queue[PACKER_QUEUE];
	struct ast_frame *opt;
	int len;
};

void ast_packer_reset(struct ast_packer *s, int framesize)
{
	memset(s, 0, sizeof(struct ast_packer));
	s->framesize = framesize;
	s->packet_index=0;
	s->len=0;
}

struct ast_packer *ast_packer_new(int framesize)
{
	struct ast_packer *s;
	if (framesize < 1)
		return NULL;
	s = malloc(sizeof(struct ast_packer));
	if (s)
		ast_packer_reset(s, framesize);
	return s;
}

int ast_packer_get_flags(struct ast_packer *s)
{
	return s->flags;
}

void ast_packer_set_flags(struct ast_packer *s, int flags)
{
	s->flags = flags;
}

int ast_packer_feed(struct ast_packer *s, const struct ast_frame *f)
{
	if (f->frametype != AST_FRAME_VOICE) {
		ast_log(LOG_WARNING, "Huh?  Can't pack a non-voice frame!\n");
		return -1;
	}
	if (!s->format) {
		s->format = f->subclass;
		s->samples=0;
	} else if (s->format != f->subclass) {
		ast_log(LOG_WARNING, "Packer was working on %d format frames, now trying to feed %d?\n", s->format, f->subclass);
		return -1;
	}
	if (s->len + f->datalen > PACKER_SIZE) {
		ast_log(LOG_WARNING, "Out of packer space\n");
		return -1;
	}
	if (s->packet_index >= PACKER_QUEUE ){
		ast_log(LOG_WARNING, "Out of packer queue space\n");
		return -1;
	}
	
	memcpy(s->data + s->len, f->data, f->datalen);
	/* If either side is empty, reset the delivery time */
	if (!s->len || (!f->delivery.tv_sec && !f->delivery.tv_usec) ||
			(!s->delivery.tv_sec && !s->delivery.tv_usec))
		s->delivery = f->delivery;
	s->len += f->datalen;
//packer stuff
	s->len_queue[s->packet_index]    += f->datalen;
	s->sample_queue[s->packet_index] += f->samples;
	s->samples += f->samples;

	if (s->samples > s->framesize )
		++s->packet_index;

	return 0;
}

struct ast_frame *ast_packer_read(struct ast_packer *s)
{
	struct ast_frame *opt;
	int len;
	/* IF we have an optimization frame, send it */
	if (s->opt) {
		opt = s->opt;
		s->opt = NULL;
		return opt;
	}

	/* Make sure we have enough data */
	if (s->samples < s->framesize ){
			return NULL;
	}
	len = s->len_queue[0];
	if (len > s->len)
		len = s->len;
	/* Make frame */
	s->f.frametype = AST_FRAME_VOICE;
	s->f.subclass = s->format;
	s->f.data = s->framedata + AST_FRIENDLY_OFFSET;
	s->f.offset = AST_FRIENDLY_OFFSET;
	s->f.datalen = len;
	s->f.samples = s->sample_queue[0];
	s->f.delivery = s->delivery;
	/* Fill Data */
	memcpy(s->f.data, s->data, len);
	s->len -= len;
	/* Move remaining data to the front if applicable */
	if (s->len) {
		/* In principle this should all be fine because if we are sending
		   G.729 VAD, the next timestamp will take over anyawy */
		memmove(s->data, s->data + len, s->len);
		if (s->delivery.tv_sec || s->delivery.tv_usec) {
			/* If we have delivery time, increment it, otherwise, leave it at 0 */
			s->delivery.tv_sec +=  s->sample_queue[0] / 8000.0;
			s->delivery.tv_usec += (((int)(s->sample_queue[0])) % 8000) * 125;
			if (s->delivery.tv_usec > 1000000) {
				s->delivery.tv_usec -= 1000000;
				s->delivery.tv_sec += 1;
			}
		}
	}
	int j;
	s->samples -= s->sample_queue[0];
	if( s->packet_index > 0 ){
		for (j=0; j<s->packet_index -1 ; j++){
			s->len_queue[j]=s->len_queue[j+1];
			s->sample_queue[j]=s->sample_queue[j+1];
		}
		s->len_queue[s->packet_index]=0;
		s->sample_queue[s->packet_index]=0;
		s->packet_index--;
	} else {
		s->len_queue[0]=0;
		s->sample_queue[0]=0;
	}

	
	/* Return frame */
	return &s->f;
}

void ast_packer_free(struct ast_packer *s)
{
	free(s);
}
