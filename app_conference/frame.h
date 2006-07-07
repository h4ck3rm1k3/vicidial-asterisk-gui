
// $Id: frame.h,v 1.6 2005/10/26 21:02:07 stevek Exp $

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

#ifndef _APP_CONF_FRAME_H
#define _APP_CONF_FRAME_H

//
// includes
//

#include "app_conference.h"
#include "common.h"

//
// function declarations
//

// mixing 
conf_frame* mix_frames( conf_frame* frames_in, int speaker_count, int listener_count ) ;

conf_frame* mix_multiple_speakers( conf_frame* frames_in, int speakers, int listeners ) ;
conf_frame* mix_single_speaker( conf_frame* frames_in ) ;

// frame creation and deletion
conf_frame* create_conf_frame( struct ast_conf_member* member, conf_frame* next, const struct ast_frame* fr ) ;
conf_frame* delete_conf_frame( conf_frame* cf ) ;
conf_frame* copy_conf_frame( conf_frame* src ) ;

// convert frame functions
struct ast_frame* convert_frame_to_slinear( struct ast_trans_pvt* trans, struct ast_frame* fr ) ;
struct ast_frame* convert_frame_from_slinear( struct ast_trans_pvt* trans, struct ast_frame* fr ) ;
struct ast_frame* convert_frame( struct ast_trans_pvt* trans, struct ast_frame* fr ) ;

// slinear frame functions
struct ast_frame* create_slinear_frame( char* data ) ;
void mix_slinear_frames( char* dst, const char* src, int samples ) ;

// silent frame functions
conf_frame* get_silent_frame( void ) ;
struct ast_frame* get_silent_slinear_frame( void ) ;

// set delivery timestamp for frames
void set_conf_frame_delivery( conf_frame* frame, struct timeval time ) ;

#endif
