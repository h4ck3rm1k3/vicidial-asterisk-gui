#!/usr/bin/perl

#
# Copyright (C) 2006  Matt Florell <vicidial@gmail.com>    LICENSE: GPLv2
#

print "\nStarting Asterisk...n";

`/usr/bin/screen -L -d -m -S asterisk /usr/sbin/asterisk -vvvvvvvvvvvvvvvvvvvvvgc`;

print "Asterisk started\n";

sleep(10);

