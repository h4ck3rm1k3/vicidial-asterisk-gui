
// $Id: common.h,v 1.3 2005/10/26 21:02:07 stevek Exp $

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

#ifndef _APP_CONF_COMMON_H
#define _APP_CONF_COMMON_H

// typedef includes
#include "conf_frame.h"

// function includesee
#include "conference.h"
#include "member.h"
#include "frame.h"
#include "cli.h"


/* Utility functions */

/* LOG the time taken to execute a function (like lock acquisition */
#if 1
#define TIMELOG(func,min,message) \
	do { \
		struct timeval t1, t2; \
		int diff; \
		gettimeofday(&t1,NULL); \
		func; \
		gettimeofday(&t2,NULL); \
		if((diff = usecdiff(&t2, &t1)) > min) \
			ast_log( AST_CONF_DEBUG, "TimeLog: %s: %d ms\n", message, diff); \
	} while (0)
#else
#define TIMELOG(func,min,message) func
#endif

#endif
