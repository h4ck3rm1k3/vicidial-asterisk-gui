
// $Id: conference.h,v 1.6 2005/10/26 21:02:07 stevek Exp $

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

#ifndef _APP_CONF_CONFERENCE_H
#define _APP_CONF_CONFERENCE_H

//
// includes
//

#include "app_conference.h"
#include "common.h"

//
// struct declarations
//

typedef struct ast_conference_stats
{
	// conference name ( copied for ease of use )
	char name[128] ; 

	// type of connection
	unsigned short phone ;
	unsigned short iaxclient ;
	unsigned short sip ;
	
	// type of users
	unsigned short moderators ;
	unsigned short listeners ;
	
	// accounting data
	unsigned long frames_in ;
	unsigned long frames_out ;
	unsigned long frames_mixed ;

	struct timeval time_entered ; 

} ast_conference_stats ;


struct ast_conference 
{
	// conference name
	char name[128] ; 
	
	// single-linked list of members in conference
	struct ast_conf_member* memberlist ;
	int membercount ;
	
	// conference thread id
	pthread_t conference_thread ;

	// conference data mutex
	ast_mutex_t lock ;
	
	// pointer to next conference in single-linked list
	struct ast_conference* next ;
	
	// pointer to translation paths
	struct ast_trans_pvt* from_slinear_paths[ AC_SUPPORTED_FORMATS ] ;
	
	// conference stats
	ast_conference_stats stats ;
	
	// keep track of current delivery time
	struct timeval delivery_time ;

	// 1 => on, 0 => off
	short debug_flag ;	
} ;

//
// function declarations
//

struct ast_conference* start_conference( struct ast_conf_member* member ) ;

void conference_exec( struct ast_conference* conf ) ;

struct ast_conference* find_conf( const char* name ) ;
struct ast_conference* create_conf( char* name, struct ast_conf_member* member ) ;
void remove_conf( struct ast_conference* conf ) ;

// find a particular member, locking if requested.
struct ast_conf_member *find_member ( char *chan, int lock) ;


int queue_frame_for_listener( struct ast_conference* conf, struct ast_conf_member* member, conf_frame* frame ) ;
int queue_frame_for_speaker( struct ast_conference* conf, struct ast_conf_member* member, conf_frame* frame ) ;
int queue_silent_frame( struct ast_conference* conf, struct ast_conf_member* member ) ;

void add_member( struct ast_conf_member* member, struct ast_conference* conf ) ;
int remove_member( struct ast_conf_member* member, struct ast_conference* conf ) ;
int count_member( struct ast_conf_member* member, struct ast_conference* conf, short add_member ) ;

// called by app_confernce.c:load_module()
void init_conference( void ) ;

int get_conference_count( void ) ;
int get_conference_stats( ast_conference_stats* stats, int requested ) ;
int get_conference_stats_by_name( ast_conference_stats* stats, const char* name ) ;

int set_conference_debugging( const char* name, int state ) ;

#endif
