#!/usr/bin/perl
#
# VICIDIAL_IN_new_leads_file.pl version 0.4   *DBI-version*
#
# DESCRIPTION:
# script lets you insert leads into the vicidial_list table from a TAB-delimited
# lead file that is in the proper format. (for format see --help)
#
# It is recommended that you run this program on the local Asterisk machine
#
# Copyright (C) 2006  Matt Florell <vicidial@gmail.com>    LICENSE: GPLv2
#
#
# CHANGES
# 60615-1543 - Added gmt_offset_now lookup for each lead
#            - Added option to force a gmt value(field after COMMENTS field)
# 60616-0958 - Added listID override feature to force all leads into same list
# 60807-1003 - Changed to DBI
#

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
$inSD = $pulldate0;
$dsec = ( ( ($hour * 3600) + ($min * 60) ) + $sec );


print "\n\n\n\n\n\n\n\n\n\n\n\n-- VICIDIAL_IN_new_leads_file.pl --\n\n";
print "This program is designed to take a tab delimited file and import it into the VICIDIAL system. \n\n";

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
	print "allowed run time options:\n  [-q] = quiet\n  [-t] = test\n  [-forcegmt] = forces gmt value of column after comments column\n  [-debug] = debug output\n  [-forcelistid=1234] = overrides the listID given in the file with the 1234\n  [-h] = this help screen\n\n";
	print "This script takes in lead files in the following order when they are placed in the /home/cron/VICIDIAL/LEADS_IN directory to be imported into the vicidial_list table:\n\n";
	print "vendor_lead_code|source_code|list_id|phone_code|phone_number|title|first_name|middle|last_name|address1|address2|address3|city|state|province|postal_code|country|gender|date_of_birth|alt_phone|email|security_phrase|COMMENTS\n\n";
	print "3857822|31022|105|01144|1625551212|MRS|B||BURTON|249 MUNDON ROAD|MALDON|ESSEX||||CM9 6PW|UK||||||COMMENTS\n\n";
	}
	else
	{
		if ($args =~ /--debug/i)
		{
		$DB=1;
		print "\n-----DEBUGGING -----\n\n";
		}
		if ($args =~ /--debugX/i)
		{
		$DBX=1;
		print "\n----- SUPER-DUPER DEBUGGING -----\n\n";
		}
		if ($args =~ /-q/i)
		{
		$q=1;
		}
		if ($args =~ /-t/i)
		{
		$T=1;
		$TEST=1;
		print "\n----- TESTING -----\n\n";
		}
		if ($args =~ /-forcegmt/i)
		{
		$forcegmt=1;
		print "\n----- FORCE GMT -----\n\n";
		}
		if ($args =~ /--forcelistid=/i)
		{
		@data_in = split(/--forcelistid=/,$args);
			$forcelistid = $data_in[1];
		print "\n----- FORCE LISTID OVERRIDE: $forcelistid -----\n\n";
		}
		else
			{$forcelistid = '';}
	}
}
else
{
print "no command line options set\n";
}
### end parsing run-time options ###


$suf = '.txt';
$people_packages_id_update='';
$dir1 = '/home/cron/VICIDIAL/LEADS_IN';
$dir2 = '/home/cron/VICIDIAL/LEADS_IN/DONE';


 opendir(FILE, "$dir1/");
 @FILES = readdir(FILE);

foreach(@FILES)
   {
	$size1 = 0;
	$size2 = 0;
	$person_id_delete = '';
	$transaction_id_delete = '';

	if (length($FILES[$i]) > 4)
		{

		$size1 = (-s "$dir1/$FILES[$i]");
		if (!$q) {print "$FILES[$i] $size1\n";}
		sleep(2);
		$size2 = (-s "$dir1/$FILES[$i]");
		if (!$q) {print "$FILES[$i] $size2\n\n";}


		if ( ($FILES[$i] !~ /^TRANSFERRED/i) && ($size1 eq $size2) && (length($FILES[$i]) > 4))
			{
			$GOODfname = $FILES[$i];
			$FILES[$i] =~ s/ /_/gi;
			$FILES[$i] =~ s/\(|\)|\||\\|\/|\'|\"|//gi;
			rename("$dir1/$GOODfname","$dir1/$FILES[$i]");
			$FILEname = $FILES[$i];

			$Routfile = "ERR_$source$FILES[$i]";
			$Soutfile = "STS_$source$FILES[$i]";
			$Toutfile = "SQL_$source$FILES[$i]";
			$Doutfile = "DEL_$source$FILES[$i]";

			`cp -f $dir1/$FILES[$i] $dir2/$source$FILES[$i]`;

	### open the in file for reading ###
	open(infile, "$dir2/$source$FILES[$i]")
			|| die "Can't open $source$FILES[$i]: $!\n";

	### open the error out file for writing ###
	open(Rout, ">>$dir2/$Routfile")
			|| die "Can't open $Routfile: $!\n";

	### open the error out file for writing ###
	open(Tout, ">>$dir2/$Toutfile")
			|| die "Can't open $Toutfile: $!\n";

	### open the error out file for writing ###
	open(Dout, ">>$dir2/$Doutfile")
			|| die "Can't open $Doutfile: $!\n";


### Make sure this file is in a libs path or put the absolute path to it
require("/home/cron/AST_SERVER_conf.pl");	# local configuration file

if (!$DB_port) {$DB_port='3306';}

use DBI;	  

$dbhA = DBI->connect("DBI:mysql:$DB_database:$DB_server:$DB_port", "$DB_user", "$DB_pass")
 or die "Couldn't connect to database: " . DBI->errstr;

### Grab Server values from the database
$stmtA = "SELECT local_gmt FROM servers where server_ip = '$server_ip';";
$sthA = $dbhA->prepare($stmtA) or die "preparing: ",$dbhA->errstr;
$sthA->execute or die "executing: $stmtA ", $dbhA->errstr;
@aryA = $sthA->fetchrow_array;
$DBSERVER_GMT		=		$aryA[0];
if (length($DBSERVER_GMT)>0)	{$SERVER_GMT = $DBSERVER_GMT;}
$sthA->finish();

	$LOCAL_GMT_OFF = $SERVER_GMT;
	$LOCAL_GMT_OFF_STD = $SERVER_GMT;

if ($isdst) {$LOCAL_GMT_OFF++;} 
if ($DB) {print "SEED TIME  $secX      :   $year-$mon-$mday $hour:$min:$sec  LOCAL GMT OFFSET NOW: $LOCAL_GMT_OFF\n";}








	print "\n\n SQL inserts will be put in $Toutfile\n\n";

	$a=0;	### each line of input file counter ###
	$b=0;	### status of 'APPROVED' counter ###
	$c=0;	### status of 'DECLINED' counter ###
	$d=0;	### status of 'REFERRED' counter ###
	$e=0;	### status of 'ERROR' counter ###
	$f=0;	### number of modified packages ###
	$g=0;	### number of credits ###

	$multi_insert_counter=0;
	$multistmt='';

	while (<infile>)
	{

#		print "$a| $number\n";
		$number = $_;
		chomp($number);
#		$number =~ s/,/\|/gi;
		$number =~ s/\t/\|/gi;
		$number =~ s/\'|\t|\r|\n|\l//gi;
		$number =~ s/\'|\t|\r|\n|\l//gi;
		$number =~ s/\",,,,,,,\"/\|\|\|\|\|\|\|/gi;
		$number =~ s/\",,,,,,\"/\|\|\|\|\|\|/gi;
		$number =~ s/\",,,,,\"/\|\|\|\|\|/gi;
		$number =~ s/\",,,,\"/\|\|\|\|/gi;
		$number =~ s/\",,,\"/\|\|\|/gi;
		$number =~ s/\",,\"/\|\|/gi;
		$number =~ s/\",\"/\|/gi;
		$number =~ s/\"//gi;
	@m = split(/\|/, $number);

# This is the format for the lead files
#3857822|31022|105|01144|1625551212|MRS|B||BURTON|249 MUNDON ROAD|MALDON|ESSEX||||CM9 6PW|UK||||||COMMENTS


		$vendor_lead_code =		$m[0];		chomp($vendor_lead_code);
		$source_code =			$m[1];		chomp($source_code); $source_id = $source_code;
		$list_id =				$m[2];		chomp($list_id);
		$phone_code =			$m[3];		chomp($phone_code);	$phone_code =~ s/\D//gi;
		$phone_number =			$m[4];		chomp($phone_number);	$phone_number =~ s/\D//gi;
			$USarea = 			substr($phone_number, 0, 3);
		$title =				$m[5];		chomp($title);
		$first_name =			$m[6];		chomp($first_name);
		$middle_initial =		$m[7];		chomp($middle_initial);
		$last_name =			$m[8];		chomp($last_name);
		$address1 =				$m[9];		chomp($address1);
		$address2 =				$m[10];		chomp($address2);
		$address3 =				$m[11];		chomp($address3);
		$city =					$m[12];		chomp($city);
		$state =				$m[13];		chomp($state);
		$province =				$m[14];		chomp($province);
		$postal_code =			$m[15];		chomp($postal_code);
		$country =				$m[16];		chomp($country);
		$gender =				$m[17];
		$date_of_birth =		$m[18];
		$alt_phone =			$m[19];
		$email =				$m[20];
		$security_phrase =		$m[21];
		$comments =				$m[22];


		if (length($phone_number)>8)
			{
			# set default values
			$entry_date =			"$pulldate0";
			$modify_date =			"";
			$status =				"NEW";
			$user =					"";
			$called_since_last_reset='N';
			$gmt_offset =			'0';

			if (length($forcelistid) > 0)
				{
				$list_id =	$forcelistid;		# set list_id to override value
				}
			if ($forcegmt > 0)
				{
				$gmt_offset =	$m[23];		# set GMT offset value to 24th field value
				}
			else
				{
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
						$NEW_campaign_leads_to_call = "$aryA[0]";
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
						$NEW_campaign_leads_to_call = "$aryA[0]";
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
						$NEW_campaign_leads_to_call = "$aryA[0]";
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
						$NEW_campaign_leads_to_call = "$aryA[0]";
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

				}
			if ($multi_insert_counter > 8)
				{
				### insert good deal into pending_transactions table ###
				$stmtZ = "INSERT INTO vicidial_list values$multistmt('','$entry_date','$modify_date','$status','$user','$vendor_lead_code','$source_id','$list_id','$gmt_offset','$called_since_last_reset','$phone_code','$phone_number','$title','$first_name','$middle_initial','$last_name','$address1','$address2','$address3','$city','$state','$province','$postal_code','$country_code','$gender','$date_of_birth','$alt_phone','$email','$security_phrase','$comments','0');";
						if($DB){print STDERR "\n|$stmtZ|\n";}
						if (!$T) {$affected_rows = $dbhA->do($stmtA); } #  or die  "Couldn't execute query: |$stmtA|\n";

				$multistmt='';
				$multi_insert_counter=0;
				$c++;
				}
			else
				{
				$multistmt .= "('','$entry_date','$modify_date','$status','$user','$vendor_lead_code','$source_id','$list_id','$gmt_offset','$called_since_last_reset','$phone_code','$phone_number','$title','$first_name','$middle_initial','$last_name','$address1','$address2','$address3','$city','$state','$province','$postal_code','$country_code','$gender','$date_of_birth','$alt_phone','$email','$security_phrase','$comments','0'),";
				$multi_insert_counter++;
				}

			$b++;
			}
		else
			{
			print "BAD Home_Phone: $phone|$vendor_id";
			$e++;
			}
		
		$a++;

		if ($a =~ /100$/i) {print STDERR "0     $a\r";}
		if ($a =~ /200$/i) {print STDERR "+     $a\r";}
		if ($a =~ /300$/i) {print STDERR "|     $a\r";}
		if ($a =~ /400$/i) {print STDERR "\\     $a\r";}
		if ($a =~ /500$/i) {print STDERR "-     $a\r";}
		if ($a =~ /600$/i) {print STDERR "/     $a\r";}
		if ($a =~ /700$/i) {print STDERR "|     $a\r";}
		if ($a =~ /800$/i) {print STDERR "+     $a\r";}
		if ($a =~ /900$/i) {print STDERR "0     $a\r";}
		if ($a =~ /000$/i) {print "$a|$b|$c|$d|$e|$phone_number|\n";}

	}

			if (length($multistmt) > 10)
				{
				chop($multistmt);
				### insert good deal into pending_transactions table ###
				$stmtZ = "INSERT INTO vicidial_list values$multistmt;";
						if($DB){print STDERR "\n|$stmtZ|\n";}
						if (!$T) {$affected_rows = $dbhA->do($stmtA); } #  or die  "Couldn't execute query: |$stmtA|\n";

				$multistmt='';
				$multi_insert_counter=0;
				$c++;
				}

	### open the stats out file for writing ###
	open(Sout, ">>/$dir2/$Soutfile")
			|| die "Can't open $Soutfile: $!\n";


	### close file handler and DB connections ###
	print "\n\nTOTALS FOR $FILEname:\n";
	print "Transactions sent:$a\n";
	print "INSERTED:         $b\n";
	print "INSERT STATEMENTS:$c\n";
	print "ERROR:            $e\n";
#	print "Modified PAID NS: $f\n";
#	print "Credits:          $g\n\n";

	print Sout "\nTOTALS FOR $FILEname:\n";
	print Sout "Transactions sent:$a\n";
	print Sout "INSERTED:         $b\n";
	print Sout "INSERT STATEMENTS:$c\n";
	print Sout "ERROR:            $e\n";
#	print Sout "Modified PAID NS: $f\n";
#	print Sout "Credits:          $g\n\n";

	close(infile);
	close(Rout);
	chmod 0777, "$dir2/$Routfile";
	close(Sout);
	chmod 0777, "$dir2/$Soutfile";
	close(Tout);
	chmod 0777, "$dir2/$Toutfile";
	close(Dout);
	chmod 0777, "$dir2/$Doutfile";

			if (!$T) {`mv -f $dir1/$FILEname $dir2/$FILEname`;}

			}
		}
		$i++;
}


$dbhA->disconnect();

### calculate time to run script ###
$secY = time();
$secZ = ($secY - $secX);
$secZm = ($secZ /60);

print "script execution time in seconds: $secZ     minutes: $secZm\n";

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
