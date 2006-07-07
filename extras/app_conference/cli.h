
// $Id: cli.h,v 1.3 2005/10/26 21:02:07 stevek Exp $

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

#ifndef _APP_CONF_CLI_H
#define _APP_CONF_CLI_H

//
// includes
//

#include "app_conference.h"
#include "common.h"

//
// function declarations
//

int conference_show_stats( int fd, int argc, char *argv[] ) ;
int conference_show_stats_name( int fd, const char* name ) ;


int conference_debug( int fd, int argc, char *argv[] ) ;
int conference_no_debug( int fd, int argc, char *argv[] ) ;

int conference_play_sound( int fd, int argc, char *argv[] ) ;
int conference_stop_sounds( int fd, int argc, char *argv[] ) ;

void register_conference_cli( void ) ;
void unregister_conference_cli( void ) ;


#endif
