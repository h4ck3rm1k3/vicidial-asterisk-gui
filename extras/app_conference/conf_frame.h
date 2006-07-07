
// $Id: conf_frame.h,v 1.3 2005/10/26 21:02:07 stevek Exp $

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

#ifndef _APP_CONF_STRUCTS_H
#define _APP_CONF_STRUCTS_H

//
// includes
//

#include "app_conference.h"
#include "common.h"

//
// struct declarations
//

typedef struct conf_frame 
{
	// frame audio data
	struct ast_frame* fr ;
	
	// array of converted versions for listeners
	struct ast_frame* converted[ AC_SUPPORTED_FORMATS ] ;
	
	// pointer to the frame's owner
	struct ast_conf_member* member ; // who sent this frame
	
	// frame meta data
//	struct timeval timestamp ;
//	unsigned long cycleid ;
//	int priority ;
	
	// linked-list pointers
	struct conf_frame* next ;
	struct conf_frame* prev ;
	
	// should this frame be preserved
	short static_frame ;
	
	// pointer to mixing buffer
	char* mixed_buffer ;
} conf_frame ;


#endif
