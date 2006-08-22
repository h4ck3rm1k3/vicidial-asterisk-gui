#!/usr/bin/perl

### listloader_super.pl   version 0.2   *DBI-version*
### 
### Copyright (C) 2006  Matt Florell,Joe Johnson <vicidial@gmail.com>    LICENSE: GPLv2
###
#
#
# CHANGES
# 60616-1548 - Added listID override feature to force all leads into same list
#            - Added gmt_offset_now lookup for each lead
# 60811-1232 - Changed to DBI
# 60811-1329 - changed to use /etc/astguiclient.conf for configs
#

### begin parsing run-time options ###
if (length($ARGV[0])>1)
{
	$i=0;
	while ($#ARGV >= $i)
	{
	$args = "$args $ARGV[$i]";
	$i++;
	}

	if ($args =~ /--help|-h/i)
	{
	print "allowed run time options:\n  [-forcelistid=1234] = overrides the listID given in the file with the 1234\n  [-h] = this help screen\n\n";
	}
	else
	{
		if ($args =~ /--forcelistid=/i)
		{
		@data_in = split(/--forcelistid=/,$args);
			$forcelistid = $data_in[1];
			$forcelistid =~ s/ .*//gi;
		print "\n----- FORCE LISTID OVERRIDE: $forcelistid -----\n\n";
		}
		else
			{$forcelistid = '';}
		if ($args =~ /--lead-file=/i)
		{
		@data_in = split(/--lead-file=/,$args);
			$lead_file = $data_in[1];
			$lead_file =~ s/ .*//gi;
	#	print "\n----- LEAD FILE: $lead_file -----\n\n";
		}
		else
			{$lead_file = './vicidial_temp_file.xls';}
	}
}
### end parsing run-time options ###

use Spreadsheet::ParseExcel;
use Time::Local;
use DBI;	  


# default path to astguiclient configuration file:
$PATHconf =		'/etc/astguiclient.conf';

open(conf, "$PATHconf") || die "can't open $PATHconf: $!\n";
@conf = <conf>;
close(conf);
$i=0;
foreach(@conf)
	{
	$line = $conf[$i];
	$line =~ s/ |>|\n|\r|\t|\#.*|;.*//gi;
	if ( ($line =~ /^PATHhome/) && ($CLIhome < 1) )
		{$PATHhome = $line;   $PATHhome =~ s/.*=//gi;}
	if ( ($line =~ /^PATHlogs/) && ($CLIlogs < 1) )
		{$PATHlogs = $line;   $PATHlogs =~ s/.*=//gi;}
	if ( ($line =~ /^PATHagi/) && ($CLIagi < 1) )
		{$PATHagi = $line;   $PATHagi =~ s/.*=//gi;}
	if ( ($line =~ /^PATHweb/) && ($CLIweb < 1) )
		{$PATHweb = $line;   $PATHweb =~ s/.*=//gi;}
	if ( ($line =~ /^PATHsounds/) && ($CLIsounds < 1) )
		{$PATHsounds = $line;   $PATHsounds =~ s/.*=//gi;}
	if ( ($line =~ /^PATHmonitor/) && ($CLImonitor < 1) )
		{$PATHmonitor = $line;   $PATHmonitor =~ s/.*=//gi;}
	if ( ($line =~ /^VARserver_ip/) && ($CLIserver_ip < 1) )
		{$VARserver_ip = $line;   $VARserver_ip =~ s/.*=//gi;}
	if ( ($line =~ /^VARDB_server/) && ($CLIDB_server < 1) )
		{$VARDB_server = $line;   $VARDB_server =~ s/.*=//gi;}
	if ( ($line =~ /^VARDB_database/) && ($CLIDB_database < 1) )
		{$VARDB_database = $line;   $VARDB_database =~ s/.*=//gi;}
	if ( ($line =~ /^VARDB_user/) && ($CLIDB_user < 1) )
		{$VARDB_user = $line;   $VARDB_user =~ s/.*=//gi;}
	if ( ($line =~ /^VARDB_pass/) && ($CLIDB_pass < 1) )
		{$VARDB_pass = $line;   $VARDB_pass =~ s/.*=//gi;}
	if ( ($line =~ /^VARDB_port/) && ($CLIDB_port < 1) )
		{$VARDB_port = $line;   $VARDB_port =~ s/.*=//gi;}
	$i++;
	}

# Customized Variables
$server_ip = $VARserver_ip;		# Asterisk server IP

if (!$VARDB_port) {$VARDB_port='3306';}

$dbhA = DBI->connect("DBI:mysql:$VARDB_database:$VARDB_server:$VARDB_port", "$VARDB_user", "$VARDB_pass")
 or die "Couldn't connect to database: " . DBI->errstr;


$vars=$ARGV[0];
@xls_fields=split(/\,/, $vars);

$|=0;
$secX = time();

($sec,$min,$hour,$mday,$mon,$year,$wday,$yday,$isdst) = localtime(time);
$year = ($year + 1900);
$mon++;
if ($hour < 10) {$hour = "0$hour";}
if ($min < 10) {$min = "0$min";}
if ($sec < 10) {$sec = "0$sec";}
if ($mon < 10) {$mon = "0$mon";}
if ($mday < 10) {$mday = "0$mday";}
$pulldate0 = "$year-$mon-$mday $hour:$min:$sec";
$pulldate="$year-$mon-$mday $hour:$min:$sec";
$inSD = $pulldate0;
$dsec = ( ( ($hour * 3600) + ($min * 60) ) + $sec );


	### Grab Server values from the database
	$stmtA = "SELECT local_gmt FROM servers where server_ip = '$server_ip';";
	$sthA = $dbhA->prepare($stmtA) or die "preparing: ",$dbhA->errstr;
	$sthA->execute or die "executing: $stmtA ", $dbhA->errstr;
	$sthArows=$sthA->rows;
	$rec_count=0;
	while ($sthArows > $rec_count)
		{
		@aryA = $sthA->fetchrow_array;
		$DBSERVER_GMT		=		"$aryA[0]";
		if ($DBSERVER_GMT)				{$SERVER_GMT = $DBSERVER_GMT;}
		$rec_count++;
		}
	$sthA->finish();

	$LOCAL_GMT_OFF = $SERVER_GMT;
	$LOCAL_GMT_OFF_STD = $SERVER_GMT;

if ($isdst) {$LOCAL_GMT_OFF++;} 
if ($DB) {print "SEED TIME  $secX      :   $year-$mon-$mday $hour:$min:$sec  LOCAL GMT OFFSET NOW: $LOCAL_GMT_OFF\n";}



$total=0; $good=0; $bad=0;
open(STMT_FILE, "> $PATHlogs/listloader_stmts.txt");

$oBook = Spreadsheet::ParseExcel::Workbook->Parse("$lead_file");
my($iR, $iC, $oWkS, $oWkC);

foreach $oWkS (@{$oBook->{Worksheet}}) {
	for($iR = 0 ; defined $oWkS->{MaxRow} && $iR <= $oWkS->{MaxRow} ; $iR++) {

		$entry_date =			"$pulldate";
		$modify_date =			"";
		$status =				"NEW";
		$user =					"";
		$oWkC = $oWkS->{Cells}[$iR][$xls_fields[0]];
		if ($oWkC) {$vendor_lead_code=$oWkC->Value; }
		$oWkC = $oWkS->{Cells}[$iR][$xls_fields[1]];
		if ($oWkC) {$source_code=$oWkC->Value; }
		$source_id=$source_code;
		$oWkC = $oWkS->{Cells}[$iR][$xls_fields[2]];
		if ($oWkC) {$list_id=$oWkC->Value; }
		$gmt_offset =			'0';
		$called_since_last_reset='N';
		$oWkC = $oWkS->{Cells}[$iR][$xls_fields[3]];
		if ($oWkC) {$phone_code=$oWkC->Value; }
		$phone_code=~s/[^0-9]//g;
		$oWkC = $oWkS->{Cells}[$iR][$xls_fields[4]];
		if ($oWkC) {$phone_number=$oWkC->Value; }
		$phone_number=~s/[^0-9]//g;
			$USarea = 			substr($phone_number, 0, 3);
		$oWkC = $oWkS->{Cells}[$iR][$xls_fields[5]];
		if ($oWkC) {$title=$oWkC->Value; }
		$oWkC = $oWkS->{Cells}[$iR][$xls_fields[6]];
		if ($oWkC) {$first_name=$oWkC->Value; }
		$oWkC = $oWkS->{Cells}[$iR][$xls_fields[7]];
		if ($oWkC) {$middle_initial=$oWkC->Value; }
		$oWkC = $oWkS->{Cells}[$iR][$xls_fields[8]];
		if ($oWkC) {$last_name=$oWkC->Value; }
		$oWkC = $oWkS->{Cells}[$iR][$xls_fields[9]];
		if ($oWkC) {$address1=$oWkC->Value; }
		$oWkC = $oWkS->{Cells}[$iR][$xls_fields[10]];
		if ($oWkC) {$address2=$oWkC->Value; }
		$oWkC = $oWkS->{Cells}[$iR][$xls_fields[11]];
		if ($oWkC) {$address3=$oWkC->Value; }
		$oWkC = $oWkS->{Cells}[$iR][$xls_fields[12]];
		if ($oWkC) {$city=$oWkC->Value; }
		$oWkC = $oWkS->{Cells}[$iR][$xls_fields[13]];
		if ($oWkC) {$state=$oWkC->Value; }
		$oWkC = $oWkS->{Cells}[$iR][$xls_fields[14]];
		if ($oWkC) {$province=$oWkC->Value; }
		$oWkC = $oWkS->{Cells}[$iR][$xls_fields[15]];
		if ($oWkC) {$postal_code=$oWkC->Value; }
		$oWkC = $oWkS->{Cells}[$iR][$xls_fields[16]];
		if ($oWkC) {$country_code=$oWkC->Value; }
		$oWkC = $oWkS->{Cells}[$iR][$xls_fields[17]];
		if ($oWkC) {$gender=$oWkC->Value; }
		$oWkC = $oWkS->{Cells}[$iR][$xls_fields[18]];
		if ($oWkC) {$date_of_birth=$oWkC->Value; }
		$oWkC = $oWkS->{Cells}[$iR][$xls_fields[19]];
		if ($oWkC) {$alt_phone=$oWkC->Value; }
		$oWkC = $oWkS->{Cells}[$iR][$xls_fields[20]];
		if ($oWkC) {$email=$oWkC->Value; }
		$oWkC = $oWkS->{Cells}[$iR][$xls_fields[21]];
		if ($oWkC) {$security_phrase=$oWkC->Value; }
		$oWkC = $oWkS->{Cells}[$iR][$xls_fields[22]];
		if ($oWkC) {$comments=$oWkC->Value; }
		$comments=~s/^\s*(.*?)\s*$/$1/;

		if (length($phone_number)>6) {
			if (length($forcelistid) > 0)
				{
				$list_id =	$forcelistid;		# set list_id to override value
				}

				$PC_processed=0;
				### UNITED STATES ###
				if ($phone_code =~ /^1$/)
					{
					$stmtA = "select * from vicidial_phone_codes where country_code='$phone_code' and areacode='$USarea';";
						if($DBX){print STDERR "\n|$stmtA|\n";}
					$sthA = $dbhA->prepare($stmtA) or die "preparing: ",$dbhA->errstr;
					$sthA->execute or die "executing: $stmtA ", $dbhA->errstr;
					$sthArows=$sthA->rows;
					$rec_count=0;
					while ($sthArows > $rec_count)
						{
						@aryA = $sthA->fetchrow_array;
						$gmt_offset =	$aryA[4];  $gmt_offset =~ s/\+| //gi;
						$dst =			$aryA[5];
						$dst_range =	$aryA[6];
						$PC_processed++;
						$rec_count++;
						}
					$sthA->finish();
					}
				### MEXICO ###
				if ($phone_code =~ /^52$/)
					{
					$stmtA = "select * from vicidial_phone_codes where country_code='$phone_code' and areacode='$USarea';";
						if($DBX){print STDERR "\n|$stmtA|\n";}
					$sthA = $dbhA->prepare($stmtA) or die "preparing: ",$dbhA->errstr;
					$sthA->execute or die "executing: $stmtA ", $dbhA->errstr;
					$sthArows=$sthA->rows;
					$rec_count=0;
					while ($sthArows > $rec_count)
						{
						@aryA = $sthA->fetchrow_array;
						$gmt_offset =	$aryA[4];  $gmt_offset =~ s/\+| //gi;
						$dst =			$aryA[5];
						$dst_range =	$aryA[6];
						$PC_processed++;
						$rec_count++;
						}
					$sthA->finish();
					}
				### AUSTRALIA ###
				if ($phone_code =~ /^61$/)
					{
					$stmtA = "select * from vicidial_phone_codes where country_code='$phone_code' and state='$state';";
						if($DBX){print STDERR "\n|$stmtA|\n";}
					$sthA = $dbhA->prepare($stmtA) or die "preparing: ",$dbhA->errstr;
					$sthA->execute or die "executing: $stmtA ", $dbhA->errstr;
					$sthArows=$sthA->rows;
					$rec_count=0;
					while ($sthArows > $rec_count)
						{
						@aryA = $sthA->fetchrow_array;
						$gmt_offset =	$aryA[4];  $gmt_offset =~ s/\+| //gi;
						$dst =			$aryA[5];
						$dst_range =	$aryA[6];
						$PC_processed++;
						$rec_count++;
						}
					$sthA->finish();
					}
				### ALL OTHER COUNTRY CODES ###
				if (!$PC_processed)
					{
					$stmtA = "select * from vicidial_phone_codes where country_code='$phone_code';";
						if($DBX){print STDERR "\n|$stmtA|\n";}
					$sthA = $dbhA->prepare($stmtA) or die "preparing: ",$dbhA->errstr;
					$sthA->execute or die "executing: $stmtA ", $dbhA->errstr;
					$sthArows=$sthA->rows;
					$rec_count=0;
					while ($sthArows > $rec_count)
						{
						@aryA = $sthA->fetchrow_array;
						$gmt_offset =	$aryA[4];  $gmt_offset =~ s/\+| //gi;
						$dst =			$aryA[5];
						$dst_range =	$aryA[6];
						$PC_processed++;
						$rec_count++;
						}
					$sthA->finish();
					}

				### Find out if DST to raise the gmt offset ###
				$AC_GMT_diff = ($gmt_offset - $LOCAL_GMT_OFF_STD);
				$AC_localtime = ($secX + (3600 * $AC_GMT_diff));
				($sec,$min,$hour,$mday,$mon,$year,$wday,$yday,$isdst) = localtime($AC_localtime);
				$year = ($year + 1900);
				$mon++;
				if ($mon < 10) {$mon = "0$mon";}
				if ($mday < 10) {$mday = "0$mday";}
				if ($hour < 10) {$hour = "0$hour";}
				if ($min < 10) {$min = "0$min";}
				if ($sec < 10) {$sec = "0$sec";}
				$dsec = ( ( ($hour * 3600) + ($min * 60) ) + $sec );
				
				$AC_processed=0;
				if ( (!$AC_processed) && ($dst_range =~ /FSA-LSO/) )
					{
					if ($DBX) {print "     First Sunday April to Last Sunday October\n";}
					&USA_dstcalc;
					if ($DBX) {print "     DST: $USA_DST\n";}
					if ($USA_DST) {$gmt_offset++;}
					$AC_processed++;
					}
				if ( (!$AC_processed) && ($dst_range =~ /LSM-LSO/) )
					{
					if ($DBX) {print "     Last Sunday March to Last Sunday October\n";}
					&GBR_dstcalc;
					if ($DBX) {print "     DST: $GBR_DST\n";}
					if ($GBR_DST) {$gmt_offset++;}
					$AC_processed++;
					}
				if ( (!$AC_processed) && ($dst_range =~ /LSO-LSM/) )
					{
					if ($DBX) {print "     Last Sunday October to Last Sunday March\n";}
					&AUS_dstcalc;
					if ($DBX) {print "     DST: $AUS_DST\n";}
					if ($AUS_DST) {$gmt_offset++;}
					$AC_processed++;
					}
				if ( (!$AC_processed) && ($dst_range =~ /FSO-LSM/) )
					{
					if ($DBX) {print "     First Sunday October to Last Sunday March\n";}
					&AUST_dstcalc;
					if ($DBX) {print "     DST: $AUST_DST\n";}
					if ($AUST_DST) {$gmt_offset++;}
					$AC_processed++;
					}
				if ( (!$AC_processed) && ($dst_range =~ /FSO-TSM/) )
					{
					if ($DBX) {print "     First Sunday October to Third Sunday March\n";}
					&NZL_dstcalc;
					if ($DBX) {print "     DST: $NZL_DST\n";}
					if ($NZL_DST) {$gmt_offset++;}
					$AC_processed++;
					}
				if (!$AC_processed)
					{
					if ($DBX) {print "     No DST Method Found\n";}
					if ($DBX) {print "     DST: 0\n";}
					$AC_processed++;
					}

			if ($multi_insert_counter > 8) {
				### insert good deal into pending_transactions table ###
				$stmtZ = "INSERT INTO vicidial_list values$multistmt('','$entry_date','$modify_date','$status','$user','$vendor_lead_code','$source_id','$list_id','$gmt_offset','$called_since_last_reset','$phone_code','$phone_number','$title','$first_name','$middle_initial','$last_name','$address1','$address2','$address3','$city','$state','$province','$postal_code','$country_code','$gender','$date_of_birth','$alt_phone','$email','$security_phrase','$comments',0);";
				$affected_rows = $dbhA->do($stmtZ);
				print STMT_FILE $stmtZ."\r\n";
				$multistmt='';
				$multi_insert_counter=0;

			} else {
				$multistmt .= "('','$entry_date','$modify_date','$status','$user','$vendor_lead_code','$source_id','$list_id','$gmt_offset','$called_since_last_reset','$phone_code','$phone_number','$title','$first_name','$middle_initial','$last_name','$address1','$address2','$address3','$city','$state','$province','$postal_code','$country_code','$gender','$date_of_birth','$alt_phone','$email','$security_phrase','$comments',0),";
				$multi_insert_counter++;
			}

			$good++;
		} else {
			if ($bad < 10) {print "<BR></b><font size=1 color=red>record $total BAD- PHONE: $phone_number ROW: |$row[0]|</font><b>\n";}
			$bad++;
		}
		$total++;
		if ($total%100==0) {
			print "<script language='JavaScript1.2'>ShowProgress($good, $bad, $total)</script>";
			sleep(1);
#			flush();
		}
	}
}

if ($multi_insert_counter > 0) {
	$stmtZ = "INSERT INTO vicidial_list values ".substr($multistmt, 0, -1).";";
	$affected_rows = $dbhA->do($stmtZ);
	print STMT_FILE $stmtZ."\r\n";
}

print "<BR><BR>Done</B> GOOD: $good &nbsp; &nbsp; &nbsp; BAD: $bad &nbsp; &nbsp; &nbsp; TOTAL: $total</font></center>";

exit;






sub USA_dstcalc {
#**********************************************************************
# FSA-LSO
#     This is returns 1 if Daylight Savings Time is in effect and 0 if 
#       Standard time is in effect.
#     Based on first Sunday in April and last Sunday in October at 2 am.
#     INPUTS:
#       mm              INTEGER       Month.
#       dd              INTEGER       Day of the month.
#       ns              INTEGER       Seconds into the day.
#       dow             INTEGER       Day of week (0=Sunday, to 6=Saturday)
#     OPTIONAL INPUT:
#       timezone        INTEGER       hour difference UTC - local standard time
#                                      (DEFAULT is blank)
#                                     make calculations based on UTC time, 
#                                     which means shift at 10:00 UTC in April
#                                     and 9:00 UTC in October
#     OUTPUT: 
#                       INTEGER       1 = DST, 0 = not DST
#**********************************************************************
    
	$USA_DST=0;
	$mm = $mon;
	$dd = $mday;
	$ns = $dsec;
	$dow= $wday;

    if ($mm < 4 || $mm > 10) {
	$USA_DST=0;   return 0;
    } elsif ($mm >= 5 && $mm <= 9) {
	$USA_DST=1;   return 1;
    } elsif ($mm == 4) {
	if ($dd > 7) {
	    $USA_DST=1;   return 1;
	} elsif ($dd >= ($dow+1)) {
	    if ($timezone) {
		if ($dow == 0 && $ns < (7200+$timezone*3600)) {
		    $USA_DST=0;   return 0;
		} else {
		    $USA_DST=1;   return 1;
		}
	    } else {
		if ($dow == 0 && $ns < 7200) {
		    $USA_DST=0;   return 0;
		} else {
		    $USA_DST=1;   return 1;
		}
	    }
	} else {
	    $USA_DST=0;   return 0;
	}
    } elsif ($mm == 10) {
	if ($dd < 25) {
	    $USA_DST=1;   return 1;
	} elsif ($dd < ($dow+25)) {
	    $USA_DST=1;   return 1;
	} elsif ($dow == 0) {
	    if ($timezone) { # UTC calculations
		if ($ns < (7200+($timezone-1)*3600)) {
		    $USA_DST=1;   return 1;
		} else {
		    $USA_DST=0;   return 0;
		}
	    } else { # local time calculations
		if ($ns < 7200) {
		    $USA_DST=1;   return 1;
		} else {
		    $USA_DST=0;   return 0;
		}
	    }
	} else {
	    $USA_DST=0;   return 0;
	}
    } # end of month checks
} # end of subroutine dstcalc




sub GBR_dstcalc {
#**********************************************************************
#     This is returns 1 if Daylight Savings Time is in effect and 0 if 
#       Standard time is in effect.
#     Based on last Sunday in March and last Sunday in October at 1 am.
#**********************************************************************
    
	$GBR_DST=0;
	$mm = $mon;
	$dd = $mday;
	$ns = $dsec;
	$dow= $wday;

    if ($mm < 3 || $mm > 10) {
	$GBR_DST=0;   return 0;
    } elsif ($mm >= 4 && $mm <= 9) {
	$GBR_DST=1;   return 1;
    } elsif ($mm == 3) {
	if ($dd < 25) {
	    $GBR_DST=0;   return 0;
	} elsif ($dd < ($dow+25)) {
	    $GBR_DST=0;   return 0;
	} elsif ($dow == 0) {
	    if ($timezone) { # UTC calculations
		if ($ns < (3600+($timezone-1)*3600)) {
		    $GBR_DST=0;   return 0;
		} else {
		    $GBR_DST=1;   return 1;
		}
	    } else { # local time calculations
		if ($ns < 3600) {
		    $GBR_DST=0;   return 0;
		} else {
		    $GBR_DST=1;   return 1;
		}
	    }
	} else {
	    $GBR_DST=1;   return 1;
	}
    } elsif ($mm == 10) {
	if ($dd < 25) {
	    $GBR_DST=1;   return 1;
	} elsif ($dd < ($dow+25)) {
	    $GBR_DST=1;   return 1;
	} elsif ($dow == 0) {
	    if ($timezone) { # UTC calculations
		if ($ns < (3600+($timezone-1)*3600)) {
		    $GBR_DST=1;   return 1;
		} else {
		    $GBR_DST=0;   return 0;
		}
	    } else { # local time calculations
		if ($ns < 3600) {
		    $GBR_DST=1;   return 1;
		} else {
		    $GBR_DST=0;   return 0;
		}
	    }
	} else {
	    $GBR_DST=0;   return 0;
	}
    } # end of month checks
} # end of subroutine dstcalc




sub AUS_dstcalc {
#**********************************************************************
#     This is returns 1 if Daylight Savings Time is in effect and 0 if 
#       Standard time is in effect.
#     Based on last Sunday in October and last Sunday in March at 1 am.
#**********************************************************************
    
	$AUS_DST=0;
	$mm = $mon;
	$dd = $mday;
	$ns = $dsec;
	$dow= $wday;

    if ($mm < 3 || $mm > 10) {
	$AUS_DST=1;   return 1;
    } elsif ($mm >= 4 && $mm <= 9) {
	$AUS_DST=0;   return 0;
    } elsif ($mm == 3) {
	if ($dd < 25) {
	    $AUS_DST=1;   return 1;
	} elsif ($dd < ($dow+25)) {
	    $AUS_DST=1;   return 1;
	} elsif ($dow == 0) {
	    if ($timezone) { # UTC calculations
		if ($ns < (3600+($timezone-1)*3600)) {
		    $AUS_DST=1;   return 1;
		} else {
		    $AUS_DST=0;   return 0;
		}
	    } else { # local time calculations
		if ($ns < 3600) {
		    $AUS_DST=1;   return 1;
		} else {
		    $AUS_DST=0;   return 0;
		}
	    }
	} else {
	    $AUS_DST=0;   return 0;
	}
    } elsif ($mm == 10) {
	if ($dd < 25) {
	    $AUS_DST=0;   return 0;
	} elsif ($dd < ($dow+25)) {
	    $AUS_DST=0;   return 0;
	} elsif ($dow == 0) {
	    if ($timezone) { # UTC calculations
		if ($ns < (3600+($timezone-1)*3600)) {
		    $AUS_DST=0;   return 0;
		} else {
		    $AUS_DST=1;   return 1;
		}
	    } else { # local time calculations
		if ($ns < 3600) {
		    $AUS_DST=0;   return 0;
		} else {
		    $AUS_DST=1;   return 1;
		}
	    }
	} else {
	    $AUS_DST=1;   return 1;
	}
    } # end of month checks
} # end of subroutine dstcalc





sub AUST_dstcalc {
#**********************************************************************
#   TASMANIA ONLY
#     This is returns 1 if Daylight Savings Time is in effect and 0 if 
#       Standard time is in effect.
#     Based on first Sunday in October and last Sunday in March at 1 am.
#**********************************************************************
    
	$AUST_DST=0;
	$mm = $mon;
	$dd = $mday;
	$ns = $dsec;
	$dow= $wday;

    if ($mm < 3 || $mm > 10) {
	$AUST_DST=1;   return 1;
    } elsif ($mm >= 4 && $mm <= 9) {
	$AUST_DST=0;   return 0;
    } elsif ($mm == 3) {
	if ($dd < 25) {
	    $AUST_DST=1;   return 1;
	} elsif ($dd < ($dow+25)) {
	    $AUST_DST=1;   return 1;
	} elsif ($dow == 0) {
	    if ($timezone) { # UTC calculations
		if ($ns < (3600+($timezone-1)*3600)) {
		    $AUST_DST=1;   return 1;
		} else {
		    $AUST_DST=0;   return 0;
		}
	    } else { # local time calculations
		if ($ns < 3600) {
		    $AUST_DST=1;   return 1;
		} else {
		    $AUST_DST=0;   return 0;
		}
	    }
	} else {
	    $AUST_DST=0;   return 0;
	}
    } elsif ($mm == 10) {
	if ($dd > 7) {
	    $AUST_DST=1;   return 1;
	} elsif ($dd >= ($dow+1)) {
	    if ($timezone) {
		if ($dow == 0 && $ns < (7200+$timezone*3600)) {
		    $AUST_DST=0;   return 0;
		} else {
		    $AUST_DST=1;   return 1;
		}
	    } else {
		if ($dow == 0 && $ns < 3600) {
		    $AUST_DST=0;   return 0;
		} else {
		    $AUST_DST=1;   return 1;
		}
	    }
	} else {
	    $AUST_DST=0;   return 0;
	}
    } # end of month checks
} # end of subroutine dstcalc





sub NZL_dstcalc {
#**********************************************************************
#     This is returns 1 if Daylight Savings Time is in effect and 0 if 
#       Standard time is in effect.
#     Based on first Sunday in October and third Sunday in March at 1 am.
#**********************************************************************
    
	$NZL_DST=0;
	$mm = $mon;
	$dd = $mday;
	$ns = $dsec;
	$dow= $wday;

    if ($mm < 3 || $mm > 10) {
	$NZL_DST=1;   return 1;
    } elsif ($mm >= 4 && $mm <= 9) {
	$NZL_DST=0;   return 0;
    } elsif ($mm == 3) {
	if ($dd < 14) {
	    $NZL_DST=1;   return 1;
	} elsif ($dd < ($dow+14)) {
	    $NZL_DST=1;   return 1;
	} elsif ($dow == 0) {
	    if ($timezone) { # UTC calculations
		if ($ns < (3600+($timezone-1)*3600)) {
		    $NZL_DST=1;   return 1;
		} else {
		    $NZL_DST=0;   return 0;
		}
	    } else { # local time calculations
		if ($ns < 3600) {
		    $NZL_DST=1;   return 1;
		} else {
		    $NZL_DST=0;   return 0;
		}
	    }
	} else {
	    $NZL_DST=0;   return 0;
	}
    } elsif ($mm == 10) {
	if ($dd > 7) {
	    $NZL_DST=1;   return 1;
	} elsif ($dd >= ($dow+1)) {
	    if ($timezone) {
		if ($dow == 0 && $ns < (7200+$timezone*3600)) {
		    $NZL_DST=0;   return 0;
		} else {
		    $NZL_DST=1;   return 1;
		}
	    } else {
		if ($dow == 0 && $ns < 3600) {
		    $NZL_DST=0;   return 0;
		} else {
		    $NZL_DST=1;   return 1;
		}
	    }
	} else {
	    $NZL_DST=0;   return 0;
	}
    } # end of month checks
} # end of subroutine dstcalc
