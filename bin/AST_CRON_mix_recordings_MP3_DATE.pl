#!/usr/bin/perl
#
# AST_CRON_mix_recordings_MP3_DATE.pl
# runs every 5 minutes and mixes the call recordings in the monitor together
# and puts the resulting ALL file into the DONE directory in the "monitor" dir
# and converts the ALL file to GSM format to save space.
# 
# soxmix is REQUIRED to use this script, soxmix is available only as part of 
# the sox audio package, and only in newer versions. Make sure you have soxmix
# installed properly and in your path
# 
# put an entry into the cron of of your asterisk machine to run this script 
# every 5 minutes or however often you desire
#
# make sure that the following directories exist:
# /var/spool/asterisk/monitor		# default Asterisk recording directory
# /var/spool/asterisk/monitor/DONE	# where the combined files are put
# /var/spool/asterisk/monitor/ORIG	# where the original in/out files are put
# 
# This program assumes that recordings are saved as .wav
# should be easy to change this code if you use .gsm instead
# 
# This program also sends the ALL combined file to an FTP server for archival
# purposes, you can comment out the Net::Ping and Net::FTP lines as well as the
# file transfer section of the code to deactivate remote copying of the
# recording files
#
# MODIFIED BY MAGMA NETWORKS: FTP Server has new folder created daily for archiving
# recordings. If the directory does not exist, this script creates the directory in
# YYYYMMDD format.
#
#
# VERY IMPORTANT !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
# You must be saving recordings as FULLDATE_CUSTPHONE_CAMPAIGN_AGENT
# and save files to dated-directories or this script will not work properly
#
#
# Copyright (C) 2006  Matt Florell <vicidial@gmail.com>    LICENSE: GPLv2
# Contributions by Mike Lord <mike@channelblend.com>
# Contributions by Magma Networks LLC <atarsha@magmanetworks.com>
#
# 51021-1058 - Added quotes around CLI executed commands
# 51122-1455 - Added soxmix and sox binary path check
# 60616-1027 - Modified to convert to MP3 format
#            - Creates Directory on target FTP server based on <Todays Date>.

#verbose
$v=0;
#test
$T=0;

# Customize variables for FTP
$FTP_host = '192.168.0.8';
$FTP_user = 'recordings';
$FTP_pass = 'recordings';
$FTP_dir  = '/var/www/html/RECORDINGS';
$FTP_port = '21';

### directory where in/out recordings are saved to by Asterisk
$dir1 = '/var/spool/asterisk/monitor';

# get current date in the format YYYYMMDD for use in directory name on the storage server
($sec,$min,$hour,$mday,$mon,$year,$wday,$yday,$isdst) = localtime(time);
my $today = sprintf("%d%02d%02d", $year + 1900, $mon + 1, $mday);

$soxmixbin = '';
if ( -e ('/usr/bin/soxmix')) {$soxmixbin = '/usr/bin/soxmix';}
else 
	{
	if ( -e ('/usr/local/bin/soxmix')) {$soxmixbin = '/usr/local/bin/soxmix';}
	else
		{
		print "Can't find soxmix binary! Exiting...\n";
		exit;
		}
	}
$lamebin = '';
if ( -e ('/usr/bin/lame')) {$lamebin = '/usr/bin/lame';}
else 
	{
	if ( -e ('/usr/local/bin/lame')) {$lamebin = '/usr/local/bin/lame';}
	else
		{
		print "Can't find lame binary! Exiting...\n";
		exit;
		}
	}

use Net::Ping;
use Net::FTP;


 opendir(FILE, "$dir1/");
 @FILES = readdir(FILE);

$i=0;
foreach(@FILES)
   {
	$size1 = 0;
	$size2 = 0;

	if ( (length($FILES[$i]) > 4) && (!-d $FILES[$i]) )
		{

		$size1 = (-s "$dir1/$FILES[$i]");
		if ($v) {print "$FILES[$i] $size1\n";}
		sleep(1);
		$size2 = (-s "$dir1/$FILES[$i]");
		if ($v) {print "$FILES[$i] $size2\n\n";}


		if ( ($FILES[$i] !~ /out\.wav/i) && ($size1 eq $size2) && (length($FILES[$i]) > 4))
			{
			$INfile = $FILES[$i];
			$OUTfile = $FILES[$i];
			$OUTfile =~ s/-in\.wav/-out.wav/gi;
			$ALLfile = $FILES[$i];
			$ALLfile =~ s/-in\.wav/-all.wav/gi;
			$MP3file = $ALLfile;
			$MP3file =~ s/-all\.wav/-all.mp3/gi;

		if ($v) {print "|$INfile|    |$OUTfile|     |$ALLfile|\n\n";}

			`$soxmixbin "$dir1/$INfile" "$dir1/$OUTfile" "$dir1/$ALLfile"`;
		if ($v) {print "|$INfile|    |$OUTfile|     |$ALLfile|\n\n";}
			if (!$T)
				{
				`mv -f "$dir1/$INfile" "$dir1/ORIG/$INfile"`;
				`mv -f "$dir1/$OUTfile" "$dir1/ORIG/$OUTfile"`;
				`mv -f "$dir1/$ALLfile" "$dir1/DONE/$ALLfile"`;
				}
			else
				{
				`cp -f "$dir1/$ALLfile" "$dir1/DONE/$ALLfile"`;
				}

			`$lamebin -b 16 -m m --silent "$dir1/DONE/$ALLfile" "$dir1/DONE/$MP3file"`;


			if($DB){print STDERR "\n|/usr/bin/sox $live_folder/$filename[$k]$WAV $arch_folder/$filename[$k]$GSM|\n";}
		chmod 0755, "$dir1/DONE/$MP3file";

	### BEGIN Remote file transfer
	#		$p = Net::Ping->new();
	#		$ping_good = $p->ping("$FTP_host");

	#		if ($ping_good)
	#			{
				$ftp = Net::FTP->new("$FTP_host", Port => $FTP_port, Debug => ($v? 1 : 0),  Passive => 1);
				$ftp->login("$FTP_user","$FTP_pass");
				#$ftp->cwd("$FTP_dir");
				$ftp->mkdir("$FTP_dir/$today", 1);
				$ftp->cwd("$FTP_dir/$today");
				$ftp->binary();
				$ftp->put("$dir1/DONE/$MP3file", "$MP3file");
				$ftp->quit;
	#			}
	### END Remote file transfer
	
			# clean up
			if (!$T)
				{
				`rm -f "$dir1/ORIG/$INfile"`;
				`rm -f "$dir1/ORIG/$OUTfile"`;
				`rm -f "$dir1/DONE/$ALLfile"`;
				`rm -f "$dir1/DONE/$MP3file"`;
				}

			}
		}
	$i++;
	}

if ($v) {print "DONE... EXITING\n\n";}

exit;
