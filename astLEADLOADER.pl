#!/usr/local/ActivePerl-5.8/bin/perl -w
# astLEADLOADER.pl version 1.0      for Perl/Tk
# by Joe Johnson - joej@vicimarketing.com  10/13/2003
#
# Description:
# Desktop application that allows load leads into to asterisk list database
#
# Copyright (C) 2006  Matt Florell,Joe Johnson <vicidial@gmail.com>    LICENSE: GPLv2
#

$DB = 1; # set to 1 for debug mode

use lib ".\\",".\\libs", './', './libs', '../libs', '/usr/local/perl_TK/libs', 'C:\\AST_VICI\\libs';
use English;
use Tk;
use POSIX;
use Tk::BrowseEntry;
use Time::Local;
use Time::HiRes ('gettimeofday','usleep','sleep');  # needed to have perl sleep in increments of less than one second
use Net::MySQL;


sub SetDelimiter;
sub SetFieldValue;
sub SetFields;
sub ErrorCheckOptions;
sub CheckUserDefinedData;
sub ProcessFile;
sub CheckTitle;
sub CheckFirstName;
sub CheckLastName;
sub CheckPhone;
sub CheckAreaCode;
sub CheckAddress;
sub CheckZip;
sub CheckState;
sub CheckDateofBirth;
sub FormatRecord;

### Make sure this file is in a libs path or put the absolute path to it
require("AST_VICI_conf.pl");	# local configuration file

if (!$DB_port) {$DB_port='3306';}

sub idcheck_connect;

&idcheck_connect;	### connect and define custom variables


if ($DB) {print STDERR "DEBUG MODE\n";}

my $MW = new MainWindow(
	-background => '#CCCCCC',
	-title => 'astLEADLOADER.pl 0.1'
);

$|=1;

	$dbh = Net::MySQL->new(hostname => "$DBX_server", database => "$DBX_database", user => "$DBX_user", password => "$DBX_pass", port => "$DBX_port") 
	or 	die "Couldn't connect to database: $DBX_server - $DBX_database\n";

############################
#     GLOBAL VARIABLES     #
############################
($sec,$min,$hour,$mday,$mon,$year,$wday,$yday,$isdst) = localtime(time);
$year = ($year + 1900);
$mon++;
$yr18=$year-18;
if ($sec < 10) {$sec = "0$sec";}
if ($min < 10) {$min = "0$min";}
if ($hour < 10) {$hour = "0$hour";}
if ($mon < 10) {$mon = "0$mon";}
if ($mday < 10) {$mday = "0$mday";}

$timestamp=time();

$under18=$yr18.$mon.$mday;  # Comes into play MUCH further down.

undef $wday; undef $yday; undef $isdst;
# Use date_entered if/when list is going to be inserted into vicidial_lists table
#$date_entered="$year-$mon-$mday";
$error_message="";

# $quantity="1";
$good_records=0;
$bad_records=0;
$total_records=0;
$no_fields=0;

$fields{"vendor_lead_code"}=99;
$fields{"source_id"}=99;
#$fields{"list_id"}=99;
#$fields{"campaign_id"}=99;
$fields{"phone_number"}=99;
$fields{"title"}=99;
$fields{"first_name"}=99;
$fields{"middle_initial"}=99;
$fields{"last_name"}=99;
$fields{"address1"}=99;
$fields{"address2"}=99;
$fields{"address3"}=99;
$fields{"city"}=99;
$fields{"state"}=99;
$fields{"province"}=99;
$fields{"postal_code"}=99;
$fields{"gender"}=99;
$fields{"date_of_birth"}=99;
$fields{"alt_phone"}=99;
$fields{"email"}=99;
$fields{"security_phrase"}=99;
$fields{"comments"}=99;

$dobmask="yyyy-mm-dd";

open(ZIPCODE_INFO, "< US_zipcode_ranges.txt");
$i=0;
while ($buffer=<ZIPCODE_INFO>) {
	@state_ary=split(/\|/, $buffer);
	$us_zc_ary[$i][0]=$state_ary[0];
	$us_zc_ary[$i][1]=$state_ary[1];
	$us_zc_ary[$i][2]=$state_ary[2];
	$i++;
}
close(ZIPCODE_INFO);

open(ZIPCODE_INFO2, "< AUS_zipcode_ranges.txt");
$i=0;
while ($buffer=<ZIPCODE_INFO2>) {
	@aus_state_ary=split(/\|/, $buffer);
	$aus_zc_ary[$i][0]=$aus_state_ary[0];
	$aus_zc_ary[$i][1]=$aus_state_ary[1];
	$aus_zc_ary[$i][2]=$aus_state_ary[2];
	$i++;
}
close(ZIPCODE_INFO2);

$provinces{"A"}="NL";
$provinces{"B"}="NS";
$provinces{"C"}="PE";
$provinces{"E"}="NB";
$provinces{"G"}="QC";
$provinces{"H"}="QC";
$provinces{"J"}="QC";
$provinces{"K"}="ON";
$provinces{"L"}="ON";
$provinces{"M"}="ON";
$provinces{"N"}="ON";
$provinces{"P"}="ON";
$provinces{"R"}="MB";
$provinces{"S"}="SK";
$provinces{"T"}="AB";
$provinces{"V"}="BC";
$provinces{"X"}="NT";
$provinces{"X"}="YT";

$delim_name="tab";

$checkfirstname="N";
$checkaddress="N";
$checkpostal_code="N";
$checkstate="N";
$checkprovince="N";
$checkarea_code="N";
$checkdate_of_birth="N";
##################





$MW->geometry("650x500+0+0");

############################
#      TEXT ELEMENTS       #
############################

$MW->Label(
	-font => "{Arial} 9 {bold}",
	-background => '#CCCCCC',
	-text => "File Name:"
)->place(
	-x => '90',
	-y => '20',
	-anchor => 'e'
);

$MW->Label(
	-font => "{Arial} 9 {bold}",
	-background => '#CCCCCC',
	-text => "Delimiter:"
)->place(
	-x => '90',
	-y => '55',
	-anchor => 'e'
);

$MW->Label(
	-font => "{Arial} 9 {bold}",
	-background => '#CCCCCC',
	-text => "List ID:"
)->place(
	-x => '90',
	-y => '90',
	-anchor => 'e'
);

$MW->Label(
	-font => "{Arial} 9 {bold}",
	-background => '#CCCCCC',
	-text => "Country:"
)->place(
	-x => '250',
	-y => '90',
	-anchor => 'e'
);

$MW->Label(
	-font => "{Arial} 9 {bold}",
	-background => '#CCCCCC',
	-text => "Errata:"
)->place(
	-x => '95',
	-y => '125',
	-anchor => 'e'
);

$errata=$MW->Scrolled("Text",
	-font => "{Arial} 9 {bold}",
	-wrap => "word",
	-height => 10,
	-width => 65,
	-scrollbars => 'e',
	-spacing1 => 0
)->place(
	-x => '95',
	-y => '270',
	-anchor => 'sw'
);

$MW->Label(
	-font => "{Arial} 9 {bold}",
	-background => '#CCCCCC',
	-text => "Good records: "
)->place(
	-x => '475',
	-y => '300',
	-anchor => 'e'
);

$MW->Label(
	-font => "{Arial} 9 {bold}",
	-background => '#CCCCCC',
	-text => "Bad records: "
)->place(
	-x => '475',
	-y => '340',
	-anchor => 'e'
);

$MW->Label(
	-font => "{Arial} 9 {bold}",
	-background => '#CCCCCC',
	-text => "Total records: "
)->place(
	-x => '475',
	-y => '380',
	-anchor => 'e'
);

$MW->Label(
	-background => '#CCCCCC',
	-text => "Version 1.yo-mama - Written by Joseph Johnson\n<joej\@vicimarketing.com>"
 )->place(
	-x => '300',
	-y => '480',
	-anchor => 'center'
 );

############################
#         BUTTONS          #
############################
# $BrowseButton=
$MW->Button(
	-font => "{Arial} 8 {bold}",
	-text => "BROWSE",
	-width => "10",
	-borderwidth => "3",
	-relief => 'groove',
	-background => '#FF0000',
	-activebackground => '#FFCCCC',
	-foreground => '#FFFFFF',
	-command => sub{$file_name=$MW->getOpenFile(); $SetFieldsButton->configure(-state => 'normal');}
)->place(
	-x => "500",
	-y => "20",
	-anchor => 'center'
);

$SetFieldsButton=$MW->Button(
	-font => "{Arial} 8 {bold}",
	-text => "SET FIELDS",
	-width => "10",
	-borderwidth => "3",
	-relief => 'groove',
	-background => '#FF0000',
	-activebackground => '#FFCCCC',
	-foreground => '#FFFFFF',
	-state => 'disabled',
	-command => sub{&SetDelimiter; &SetFields;}
)->place(
	-x => "500",
	-y => "55",
	-anchor => 'center'
);

# $ErrorChecksButton=
$MW->Button(
	-font => "{Arial} 8 {bold}",
	-text => "ERROR CHECKS",
	-width => "12",
	-borderwidth => "3",
	-relief => 'groove',
	-background => '#FF0000',
	-activebackground => '#FFCCCC',
	-foreground => '#FFFFFF',
	# -state => 'disabled',
	-command => sub{&ErrorCheckOptions;}
)->place(
	-x => "400",
	-y => "90",
	-anchor => 'center'
);

$StartButton=$MW->Button(
	-font => "{Arial} 8 {bold}",
	-text => "START PROCESSING",
	-width => "18",
	-background => '#009900',
	-activebackground => '#99FF99',
	-foreground => '#FFFFFF',
	-state => 'disabled',
	-command => sub {&CheckUserDefinedData;}
)->place(
	-x => "95",
	-y => "300",
	-anchor => 'w'
);

$StopButton=$MW->Button(
	-font => "{Arial} 8 {bold}",
	-text => "CANCEL PROCESSING",
	-width => "18",
	-background => '#FF3333',
	-activebackground => '#FF9999',
	-foreground => '#FFFFFF',
	-state => 'disabled',
	-command => sub{$stop_records=1;}
)->place(
	-x => "95",
	-y => "340",
	-anchor => 'w'
);


$MW->Button(
	-font => "{Arial} 8 {bold}",
	-text => "EXIT",
	-width => "18",
	-background => '#0000FF',
	-activebackground => '#CCCCFF',
	-foreground => '#FFFFFF',
	-command => sub{exit}
)->place(
	-x => "95",
	-y => "380",
	-anchor => 'w'
);

$x=90;
foreach(qw/tab comma qc pipe(|) other/) {
	$MW->Radiobutton(
		-background => '#CCCCCC',
		-activebackground => '#CCCCCC',
		-text => $_,
		-variable => \$delim_name,
		-value => $_,
		-command => sub{&SetDelimiter;}
	)->place(
		-x => $x,
		-y => "55",
		-anchor => 'w'
	);
	$x+=70;
}

############################
#       ENTRY FIELDS       #
############################

## Login
$MW->Entry(
	-font => "{Arial} 9 {bold}",
	-background => "#FFFFFF",
	-textvariable => \$file_name,
	-width => 50
)->place(
	-x => "95",
	-y => "20",
	-anchor => 'w'
);

$MW->Entry(
	-font => "{Arial} 9 {bold}",
	-background => "#FFFFFF",
	-textvariable => \$other_delim,
	-width => 2
)->place(
	-x => "450",
	-y => "55",
	-anchor => 'e'
);

$MW->Entry(
	-font => "{Arial} 9 {bold}",
	-background => "#FFFFFF",
	-textvariable => \$list_id,
	-width => 10
)->place(
	-x => "95",
	-y => "90",
	-anchor => 'w'
);

$GoodRecords=$MW->Entry(
	-font => "{Arial} 9 {bold}",
	-background => "#FFFFFF",
#	-textvariable => \$good_records,
	-width => 10
)->place(
	-x => "550",
	-y => "300",
	-anchor => 'e'
);

$BadRecords=$MW->Entry(
	-font => "{Arial} 9 {bold}",
	-background => "#FFFFFF",
#	-textvariable => \$bad_records,
	-width => 10
)->place(
	-x => "550",
	-y => "340",
	-anchor => 'e'
);

$TotalRecords=$MW->Entry(
	-font => "{Arial} 9 {bold}",
	-background => "#FFFFFF",
#	-textvariable => \$total_records,
	-width => 10
)->place(
	-x => "550",
	-y => "380",
	-anchor => 'e'
);
#############################
#      BROWSEENTRY FIELDS   #
#############################

$CountryListbox=$MW->BrowseEntry(
	-font => "{Arial} 9 {bold}",
	-background => '#CCCCCC',
	-variable => \$list_country,
	-width => 5
)->place(
	-x => "250",
	-y => "80",
);
$CountryListbox->insert('end', "USA");
$CountryListbox->insert('end', "CAN");
$CountryListbox->insert('end', "UK");
$CountryListbox->insert('end', "AUS");

sub SetDelimiter {
	if ($delim_name eq "tab") {
		$delimiter="\\t";
	} elsif ($delim_name eq "comma") {
		$delimiter="\,";
	} elsif ($delim_name=~/pipe/i) {
		$delimiter="\\|";
	} elsif ($delim_name eq "qc") {
		$delimiter="\\|";
	} else {
		$delimiter=$other_delim;
	}
}

sub SetFieldValue() {
	open(CALLBUFFER, "> ./input.log");
	# $instructions="";
	for ($j=0; $j<$no_fields; $j++) {
		$fieldvar="field".$j."_value";
		if (length($$fieldvar)>0 && $$fieldvar!~/\s/i) {
			$fields{"$$fieldvar"}=$j;
		} else {
			$fields{"$$fieldvar"}=99;
		}
	}
	
	foreach $item (keys %fields) {
		print CALLBUFFER sprintf("%-20s", $item).": ".$fields{$item}."\t\t\n";
	}
	close(CALLBUFFER);
}

# sub CountRecords() {
#	`copy $file_name count.txt`;
#	$total_records=`wc -l < count.txt`;
#	print "wc -l < $file_name";
#	chomp($total_records);
#	$TotalRecords->delete(0, 'end');
#	$TotalRecords->insert(0, "$total_records");
# }

sub SetFields{
  if (length($delim_name)>0) {
	open(SOURCE_FILE, "< $file_name");
	if (!Exists($tL)){

		$buffer=<SOURCE_FILE>;
		$pattern='","';
		$pt2='",,"';
		$pt3='",,,"';
		$pt4='",,,,"';
		$buffer=~s/$pattern/|/g;
		$buffer=~s/$pt2/||/g;
		$buffer=~s/$pt3/|||/g;
		$buffer=~s/$pt4/||||/g;
		$buffer=~s/[\*\"\'\\\\]//g;

		@row=split(/$delimiter/, $buffer);
		$no_fields=scalar(@row);
		$rows=ceil($no_fields/2);
		$winheight=20+(40*$rows)+40;

		$tL = $MW->Toplevel();
		$tL->title("SET FIELDS TO POINT TO THE PROPER DATA");
		$tL->geometry("600x$winheight+20+80");

		$canvas=$tL->Canvas(
			-background => '#CCCCCC',
			-width => "600",
			-height => "$winheight"
		)->place(
			-x => "0",
			-y => "0"
		);

		for ($i=0; $i<scalar(@row); $i++) {
			if ($i<$rows) {
				$xcoord="10";
			} else {
				$xcoord="310";
			}
			$ycoord=20+(40*($i%$rows));
			$row[$i]=substr($row[$i], 0, 24);
			$row[$i]=~s/^\s*(.*?)\s*$/$1/;

			$canvas->createRectangle($xcoord-2,$ycoord-15,$xcoord+285,$ycoord+15, -fill => '#999999');

			$tL->Label(
				-font => "{Courier} 9 {bold}",
				-background => '#999999',
				-text => "$row[$i]"
			)->place(
				-x => $xcoord,
				-y => $ycoord,
				-anchor => 'w'
			);
			
			$xcoord+=175;
			$boxname="field".$i;
			$boxvar="field".$i."_value";
			$$boxname=$tL->BrowseEntry(
				-font => "{Arial} 9 {bold}",
				-background => '#999999',
				-variable => \$$boxvar,
				-command => sub{&SetFieldValue;},
				-width => 10
			)->place(
				-x => $xcoord,
				-y => ($ycoord-10),
			);
			$$boxname->insert('end', " ");
			$$boxname->insert('end', "vendor_lead_code");
			$$boxname->insert('end', "source_id");
#			$$boxname->insert('end', "list_id");
#			$$boxname->insert('end', "campaign_id");
			$$boxname->insert('end', "phone_number");
			$$boxname->insert('end', "title");
			$$boxname->insert('end', "first_name");
			$$boxname->insert('end', "middle_initial");
			$$boxname->insert('end', "last_name");
			$$boxname->insert('end', "address1");
			$$boxname->insert('end', "address2");
			$$boxname->insert('end', "address3");
			$$boxname->insert('end', "city");
			$$boxname->insert('end', "state");
			$$boxname->insert('end', "province");
			$$boxname->insert('end', "postal_code");
			$$boxname->insert('end', "gender");
			$$boxname->insert('end', "date_of_birth");
			$$boxname->insert('end', "alt_phone");
			$$boxname->insert('end', "email");
			$$boxname->insert('end', "security_phrase");
			$$boxname->insert('end', "comments");
			$$boxvar=" ";
		}
		$ycoord=30+(40*($rows));
		$xcoord=300;
		$tL->Button(
			-font => "{Arial} 8 {bold}",
			-text => "ACCEPT THESE VALUES",
			-width => "24",
			-background => '#009900',
			-activebackground => '#99FF99',
			-foreground => '#FFFFFF',
			-command => sub  {
				$StartButton->configure(-state => 'normal');
				$MW->configure(-takefocus => 1); # doesn't make it modal
				$tL->destroy;
			}
		)->place(
			-x => "$xcoord",
			-y => "$ycoord",
			-anchor => 'c'
		);

	} else {
		$tL->deiconify();
		$tL->raise();
	}
	$MW->configure(-takefocus => 0); # doesn't make it modal
	$tL->transient($MW);	 # doesn't make it modal
	$tL->group($MW); # doesn't make it modal
	$tL->grab	# makes modal!
	;
  }
}

sub ErrorCheckOptions{
  if (length($delim_name)>0) {
	if (!Exists($tL)){


		$tL = $MW->Toplevel();
		$tL->title("SELECT ERROR CHECKS");
		$tL->geometry("440x400+100+80");

		$canvas=$tL->Canvas(
			-background => '#CCCCCC',
			-width => "440",
			-height => "400"
		)->place(
			-x => "0",
			-y => "0"
		);

		$canvas->createRectangle(20,2,420,28, -fill => '#999999');

		$tL->Label(
			-font => "{Arial} 10 {bold}",
			-foreground => '#FFFFFF',
			-background => '#999999',
			-text => "SELECT ERROR CHECKS TO PERFORM"
		)->place(
			-x => '220',
			-y => '15',
			-anchor => 'center'
		);

		$tL->Label(
			-font => "{Arial} 9 {bold}",
			-background => '#CCCCCC',
			-text => "First name must exist: "
		)->place(
			-x => '340',
			-y => '50',
			-anchor => 'e'
		);
		$tL->Radiobutton(
			-background => '#CCCCCC',
			-activebackground => '#CCCCCC',
			-text => "Y",
			-variable => \$checkfirstname,
			-value => "Y"
		)->place(
			-x => "350",
			-y => "50",
			-anchor => 'w'
		);
		$tL->Radiobutton(
			-background => '#CCCCCC',
			-activebackground => '#CCCCCC',
			-text => "N",
			-variable => \$checkfirstname,
			-value => "N"
		)->place(
			-x => "390",
			-y => "50",
			-anchor => 'w'
		);

		$tL->Label(
			-font => "{Arial} 9 {bold}",
			-background => '#CCCCCC',
			-text => "Minimal address required: "
		)->place(
			-x => '340',
			-y => '70',
			-anchor => 'e'
		);
		$tL->Radiobutton(
			-background => '#CCCCCC',
			-activebackground => '#CCCCCC',
			-text => "Y",
			-variable => \$checkaddress,
			-value => "Y"
		)->place(
			-x => "350",
			-y => "70",
			-anchor => 'w'
		);
		$tL->Radiobutton(
			-background => '#CCCCCC',
			-activebackground => '#CCCCCC',
			-text => "N",
			-variable => \$checkaddress,
			-value => "N"
		)->place(
			-x => "390",
			-y => "70",
			-anchor => 'w'
		);

		$tL->Label(
			-font => "{Arial} 9 {bold}",
			-background => '#CCCCCC',
			-text => "Valid postal code required: "
		)->place(
			-x => '340',
			-y => '90',
			-anchor => 'e'
		);
		$tL->Radiobutton(
			-background => '#CCCCCC',
			-activebackground => '#CCCCCC',
			-text => "Y",
			-variable => \$checkpostal_code,
			-value => "Y"
		)->place(
			-x => "350",
			-y => "90",
			-anchor => 'w'
		);
		$tL->Radiobutton(
			-background => '#CCCCCC',
			-activebackground => '#CCCCCC',
			-text => "N",
			-variable => \$checkpostal_code,
			-value => "N"
		)->place(
			-x => "390",
			-y => "90",
			-anchor => 'w'
		);

		$tL->Label(
			-font => "{Arial} 9 {bold}",
			-background => '#CCCCCC',
			-text => "State required (US & Australia): "
		)->place(
			-x => '340',
			-y => '110',
			-anchor => 'e'
		);
		$tL->Radiobutton(
			-background => '#CCCCCC',
			-activebackground => '#CCCCCC',
			-text => "Y",
			-variable => \$checkstate,
			-value => "Y"
		)->place(
			-x => "350",
			-y => "110",
			-anchor => 'w'
		);
		$tL->Radiobutton(
			-background => '#CCCCCC',
			-activebackground => '#CCCCCC',
			-text => "N",
			-variable => \$checkstate,
			-value => "N"
		)->place(
			-x => "390",
			-y => "110",
			-anchor => 'w'
		);

		$tL->Label(
			-font => "{Arial} 9 {bold}",
			-background => '#CCCCCC',
			-text => "Province required (Canada): "
		)->place(
			-x => '340',
			-y => '130',
			-anchor => 'e'
		);
		$tL->Radiobutton(
			-background => '#CCCCCC',
			-activebackground => '#CCCCCC',
			-text => "Y",
			-variable => \$checkprovince,
			-value => "Y"
		)->place(
			-x => "350",
			-y => "130",
			-anchor => 'w'
		);
		$tL->Radiobutton(
			-background => '#CCCCCC',
			-activebackground => '#CCCCCC',
			-text => "N",
			-variable => \$checkprovince,
			-value => "N"
		)->place(
			-x => "390",
			-y => "130",
			-anchor => 'w'
		);

		$tL->Label(
			-font => "{Arial} 9 {bold}",
			-background => '#CCCCCC',
			-text => "Valid date of birth required (mask:                                       ): "
		)->place(
			-x => '340',
			-y => '150',
			-anchor => 'e'
		);

		$DOBListBox=$tL->BrowseEntry(
			-font => "{Arial} 8 {bold}",
			-background => '#CCCCCC',
			-variable => \$dobmask,
			-width => 12
		)->place(
			-x => "325",
			-y => "150",
			-anchor => 'e'
		);
		$DOBListBox->insert('end', "mm/dd/yyyy");
		$DOBListBox->insert('end', "dd/mm/yyyy");
		$DOBListBox->insert('end', "yyyy/mm/dd");
		$DOBListBox->insert('end', "yyyy/dd/mm");
		$DOBListBox->insert('end', "mm/dd/yy");
		$DOBListBox->insert('end', "dd/mm/yy");
		$DOBListBox->insert('end', "yy/mm/dd");
		$DOBListBox->insert('end', "yy/dd/mm");
		$DOBListBox->insert('end', "mm-dd-yyyy");
		$DOBListBox->insert('end', "dd-mm-yyyy");
		$DOBListBox->insert('end', "yyyy-mm-dd");
		$DOBListBox->insert('end', "yyyy-dd-mm");
		$DOBListBox->insert('end', "mm-dd-yy");
		$DOBListBox->insert('end', "dd-mm-yy");
		$DOBListBox->insert('end', "yy-mm-dd");
		$DOBListBox->insert('end', "yy-dd-mm");
		$DOBListBox->insert('end', "mmddyyyy");
		$DOBListBox->insert('end', "ddmmyyyy");
		$DOBListBox->insert('end', "yyyymmdd");
		$DOBListBox->insert('end', "yyyyddmm");
		$DOBListBox->insert('end', "mmddyy");
		$DOBListBox->insert('end', "ddmmyy");
		$DOBListBox->insert('end', "yymmdd");
		$DOBListBox->insert('end', "yyddmm");
		
		$tL->Radiobutton(
			-background => '#CCCCCC',
			-activebackground => '#CCCCCC',
			-text => "Y",
			-variable => \$checkdate_of_birth,
			-value => "Y"
		)->place(
			-x => "350",
			-y => "150",
			-anchor => 'w'
		);
		$tL->Radiobutton(
			-background => '#CCCCCC',
			-activebackground => '#CCCCCC',
			-text => "N",
			-variable => \$checkdate_of_birth,
			-value => "N"
		)->place(
			-x => "390",
			-y => "150",
			-anchor => 'w'
		);

		$tL->Label(
			-font => "{Arial} 9 {bold}",
			-background => '#CCCCCC',
			-text => "Area code must match state/prov (US/CAN): "
		)->place(
			-x => '340',
			-y => '170',
			-anchor => 'e'
		);
		$tL->Radiobutton(
			-background => '#CCCCCC',
			-activebackground => '#CCCCCC',
			-text => "Y",
			-variable => \$checkarea_code,
			-value => "Y"
		)->place(
			-x => "350",
			-y => "170",
			-anchor => 'w'
		);
		$tL->Radiobutton(
			-background => '#CCCCCC',
			-activebackground => '#CCCCCC',
			-text => "N",
			-variable => \$checkarea_code,
			-value => "N"
		)->place(
			-x => "390",
			-y => "170",
			-anchor => 'w'
		);

		$tL->Button(
			-font => "{Arial} 8 {bold}",
			-text => "ACCEPT THESE VALUES",
			-width => "24",
			-background => '#009900',
			-activebackground => '#99FF99',
			-foreground => '#FFFFFF',
			-command => sub  {
				$MW->configure(-takefocus => 1); # doesn't make it modal
				$tL->destroy;
			}
		)->place(
			-x => "220",
			-y => "220",
			-anchor => 'c'
		);

	} else {
		$tL->deiconify();
		$tL->raise();
	}
	$MW->configure(-takefocus => 0); # doesn't make it modal
	$tL->transient($MW);	 # doesn't make it modal
	$tL->group($MW); # doesn't make it modal
	$tL->grab	# makes modal!
	;
  }
}

sub CheckUserDefinedData {
	if ($DB) {print STDERR "Checking data\n";}

	$baduserdata=" ";
	if ($fields{"phone_number"}==99) {
		$baduserdata.="You must define a phone_number field\n";
	}
	if ($fields{"last_name"}==99) {
		$baduserdata.="You must define a last_name field\n";
	}
	if ($list_country eq "") {
		$baduserdata.="You must choose what country this list will be dialing to\n";
	}
	$list_id=~s/[^0-9]//g;
	if ($list_id eq "") {
		$baduserdata.="You must enter a list ID# for the dialer\n";
	}
	if (length($baduserdata)>1) {
		$baduserdata.="\n\nFix the above problems before the list can be processed.";
		if (!Exists($tError)){


			$tError = $MW->Toplevel();
			$tError->title("ERROR");
			$tError->geometry("400x200+150+125");

			$canvas=$tError->Canvas(
				-background => '#CCCCCC',
				-width => "400",
				-height => "200"
			)->place(
				-x => "0",
				-y => "0"
			);

			$tError->Label(
				-font => "{Arial} 10 {bold}",
				-background => '#CCCCCC',
				-text => "$baduserdata"
			)->place(
				-x => 200,
				-y => 0,
				-anchor => 'n'
			);

			$tError->Button(
				-font => "{Arial} 8 {bold}",
				-text => "OK",
				-width => "24",
				-background => '#009900',
				-activebackground => '#99FF99',
				-foreground => '#FFFFFF',
				-command => sub  {
					$MW->configure(-takefocus => 1); # doesn't make it modal
					$tError->destroy;
				}
			)->place(
				-x => "200",
				-y => "150",
				-anchor => 'c'
			);
		}

	} else {
		&ProcessFile;
	}
}

sub ProcessFile {

	if ($DB) {print STDERR "Processing File\n";}

	$stop_records=0;
	$StopButton->configure(-state => 'normal');
	# $errata->delete(0, 'end');

	$i=0;
	$bad_records=0; $good_records=0; $total_records=0;
	
	$error_log="error_log_listid_".$list_id."_".$timestamp.".txt";
	open(ERROR_LOG, "> $error_log");


	$mktbl="create table vicidial_temporary_phone_list(phone varchar(20) primary key)";
	$dbh->query($mktbl);
	
	$timestamp1=time();

	&SetDelimiter;
	
	open(RECORDS, "< $file_name");
	while ($buffer=uc(<RECORDS>)) {
		$total_records++;
		if ($total_records%10==0) {
		}
		
		$pattern='","';
		$pt2='",,"';
		$pt3='",,,"';
		$pt4='",,,,"';
		$buffer=~s/$pattern/|/g;
		$buffer=~s/$pt2/||/g;
		$buffer=~s/$pt3/|||/g;
		$buffer=~s/$pt4/||||/g;
		$i++;
		# if ($i%5000==0) {print "\n######## ".sprintf("%-6s", $i)." RECORDS PARSED ########\n\n";}

		#### SPLIT THE ROW BASED ON YOUR ENTRIES ####
		$buffer=~s/[\*\"\'\\\\]//g;
		@row=split(/$delimiter/, $buffer);
		$row[99]=" ";
		$vendor_lead_code=$row[$fields{"vendor_lead_code"}];
		$source_id=$row[$fields{"source_id"}];
#		$campaign_id=$row[$fields{"campaign_id"}];
		$phone_number=$row[$fields{"phone_number"}];
		$title=$row[$fields{"title"}];
		$first_name=$row[$fields{"first_name"}];
		$middle_initial=$row[$fields{"middle_initial"}];
		$last_name=$row[$fields{"last_name"}];
		$address1=$row[$fields{"address1"}];
		$address2=$row[$fields{"address2"}];
		$address3=$row[$fields{"address3"}];
		$city=$row[$fields{"city"}];
		$state=$row[$fields{"state"}];
		$province=$row[$fields{"province"}];
		$postal_code=$row[$fields{"postal_code"}];
		$gender=$row[$fields{"gender"}];
		$date_of_birth=$row[$fields{"date_of_birth"}];
		$alt_phone=$row[$fields{"alt_phone"}];
		$email=$row[$fields{"email"}];
		$security_phrase=$row[$fields{"security_phrase"}];
		$comments=$row[$fields{"comments"}];


		#######################################
		#          TIDY UP THE DATA           #
		#######################################

		$vendor_lead_code=~s/^\s*(.*?)\s*$/$1/;
		$vendor_lead_code=substr($vendor_lead_code, 0, 20);
		$source_id=~s/^\s*(.*?)\s*$/$1/;
		$source_id=substr($source_id, 0, 6);
		$list_id=~s/^\s*(.*?)\s*$/$1/;
		$list_id=~s/[^0-9]//g;
		$list_id=substr($list_id, 0, 8);
#		$campaign_id=~s/^\s*(.*?)\s*$/$1/;
#		$campaign_id=substr($campaign_id, 0, 8);
		$phone_number=~s/^\s*(.*?)\s*$/$1/;
		$phone_number=~s/[^0-9]//g;
		$title=~s/^\s*(.*?)\s*$/$1/;
		$title=~s/[^A-Z]//g;
		$title=substr($title, 0, 4);
		$first_name=~s/^\s*(.*?)\s*$/$1/;
		$first_name=~s/[^A-Z\-\s\.\,]//g;
		$first_name=substr($first_name, 0, 30);
		$middle_initial=~s/^\s*(.*?)\s*$/$1/;
		$middle_initial=~s/[^A-Z]//g;
		$middle_initial=substr($middle_initial, 0, 1);
		$last_name=~s/^\s*(.*?)\s*$/$1/;
		$last_name=~s/[^A-Z\-\s\.\,]//g;
		$last_name=substr($last_name, 0, 30);
		$address1=~s/^\s*(.*?)\s*$/$1/;
		$address1=substr($address1, 0, 100);
		$address2=~s/^\s*(.*?)\s*$/$1/;
		$address2=substr($address2, 0, 100);
		$address3=~s/^\s*(.*?)\s*$/$1/;
		$address3=substr($address3, 0, 100);
		$city=~s/^\s*(.*?)\s*$/$1/;
		$city=substr($city, 0, 50);
		$state=~s/^\s*(.*?)\s*$/$1/;
		$state=~s/[^A-Z]//g;
		$state=substr($state, 0, 2);
		$province=~s/^\s*(.*?)\s*$/$1/;
		$province=~s/[^A-Z\s\-]//g;
		$province=substr($province, 0, 50);
		$postal_code=~s/^\s*(.*?)\s*$/$1/;
		$gender=~s/^\s*(.*?)\s*$/$1/;
		$gender=~s/[^MF]//g;
		$gender=substr($gender, 0, 1);
		$date_of_birth=~s/^\s*(.*?)\s*$/$1/;
		$date_of_birth=~s/[^0-9\-\/]//g;
		$date_of_birth=substr($date_of_birth, 0, 10);
		$alt_phone=~s/^\s*(.*?)\s*$/$1/;
		$alt_phone=~s/[^0-9]//g;
		$email=~s/^\s*(.*?)\s*$/$1/;
		$email=substr($email, 0, 70);
		$security_phrase=~s/^\s*(.*?)\s*$/$1/;
		$security_phrase=substr($security_phrase, 0, 100);
		$comments=~s/^\s*(.*?)\s*$/$1/;
		$comments=substr($comments, 0, 255);

		if ($list_country eq "CAN") {
			if (length($state)==0) {
				$state=$province;
			} elsif (length($state)==2 && length($province)==0) {
				$province=$state;
			}
		}

		CheckTitle();
	}

	$GoodRecords->delete(0, 'end');
	$GoodRecords->insert('end', "$good_records");
	$BadRecords->delete(0, 'end');
	$BadRecords->insert('end', "$bad_records");
	$TotalRecords->delete(0, 'end');
	$TotalRecords->insert('end', "$total_records");
	$droptbl="drop table vicidial_temporary_phone_list";
	$dbh->query($droptbl);
	$StopButton->configure(-state => 'disabled');
	$timestamp2=time();
	$total_time=$timestamp2-$timestamp1;
	print ERROR_LOG "Total time: $total_time\n";
	close(ERROR_LOG);
	close(RECORDS);
}

sub CheckTitle() {
	if ($DB) {print STDERR "Checking title\n";}
  if ($fields{"title"}!=99 && $fields{"gender"}==99) {
	if ($title=~/^mrs|^miss|^ms|^lady|^madam/i) {
		$gender="F";
	} elsif ($title=~/^mr|^sir|^baron|^rev|^rabbi|^past/i) {
		$gender="M";
	} else {
		$gender="";
	}
  }
  CheckFirstName();
}

sub CheckFirstName() {
		if ($DB) {print STDERR "Checking firstname\n";}
  if ($fields{"first_name"}!=99 && $checkfirstname eq "Y") {
		if (length($first_name)==0) {
			$errata->insert('end', "FIRST NAME MISSING IN RECORD ".$i."\n");
			print ERROR_LOG "FIRST NAME MISSING IN RECORD ".$i."\n";
			$bad_records++;
		} else {
			CheckLastName();
		}

  } else {
	CheckLastName();
  }
}

sub CheckLastName() {
		if ($DB) {print STDERR "Checking lastname\n";}
  if ($fields{"last_name"}!=99) {
		if (length($last_name)==0) {
			$errata->insert('end', "LAST NAME MISSING IN RECORD ".$i."\n");
			print ERROR_LOG "LAST NAME MISSING IN RECORD ".$i."\n";
			$bad_records++;
		} else {
			CheckPhone();
		}

  } else {
	CheckPhone();
  }
}

sub CheckPhone() {
		if ($DB) {print STDERR "Checking phone\n";}
	$q=0;
	while (substr($phone_number, $q, 1) eq "0") {
		$q++;
	}
	$phone_number=substr($phone_number, $q);
	$phone_number=substr($phone_number, -10);
	if (($list_country eq "USA" && length($phone_number)==10 && $phone_number>2010000000 && $phone_number<9900000000 && $phone_number!~/0{7}/ && $phone_number!~/1{7}/ && $phone_number!~/2{7}/ && $phone_number!~/3{7}/ && $phone_number!~/4{7}/ && $phone_number!~/5{7}/ && $phone_number!~/6{7}/ && $phone_number!~/7{7}/ && $phone_number!~/8{7}/ && $phone_number!~/9{7}/) || ($list_country eq "AUS" && length($phone_number)==9 && $phone_number=~/^[23478]/) || ($list_country eq "UK" && length($phone_number)==10 && $phone_number=~/^[1237]/ && $phone_number!~/0{7}/ && $phone_number!~/1{7}/ && $phone_number!~/2{7}/ && $phone_number!~/3{7}/ && $phone_number!~/4{7}/ && $phone_number!~/5{7}/ && $phone_number!~/6{7}/ && $phone_number!~/7{7}/ && $phone_number!~/8{7}/ && $phone_number!~/9{7}/) || ($list_country eq "CAN" && length($phone_number)==10 && $phone_number>2040000000 && $phone_number<9060000000 && $phone_number!~/0{7}/ && $phone_number!~/1{7}/ && $phone_number!~/2{7}/ && $phone_number!~/3{7}/ && $phone_number!~/4{7}/ && $phone_number!~/5{7}/ && $phone_number!~/6{7}/ && $phone_number!~/7{7}/ && $phone_number!~/8{7}/ && $phone_number!~/9{7}/)) {
		$stmt="select count(*) from vicidial_temporary_phone_list where phone='$phone_number'";
		$dbh->query("$stmt") or die "ERROR: $!\n";
		if ($dbh->has_selected_record) {
#			print "Has selected record.\n";
			$rslt = $dbh->create_record_iterator();
			while (my $row = $rslt->each) {
				if ($row->[0]>0) {
					$bad_records++;	
					$errata->insert('end', "DUPLICATE PHONE IN RECORD ".$i.": ".$phone_number."\n");
					print ERROR_LOG "DUPLICATE PHONE IN RECORD ".$i."\n";
				} else {
#					print "Record is fine.\n";
					$area_code=substr($phone_number, 0, 3);
					$prefix=substr($phone_number, 3, 3);
					if ($list_country=~/^USA|CAN/i) {
						CheckAreaCode();
					} else {
						CheckAddress();
					}
				}
			}
		} else {
#			print "No selected record.\n";
			$area_code=substr($phone_number, 0, 3);
			$prefix=substr($phone_number, 3, 3);
			if ($list_country=~/^USA|CAN/i) {
				CheckAreaCode();
			} else {
				CheckAddress();
			}
		}
	} elsif (length($phone_number)==0) {
		$bad_records++;	
		$errata->insert('end', "NO PHONE IN RECORD ".$i.": ".$phone_number."\n");
		print ERROR_LOG "NO PHONE IN RECORD ".$i."\n";
	} else {
		$bad_records++;	
		$errata->insert('end', "BAD PHONE IN RECORD ".$i.": ".$phone_number."\n");
		print ERROR_LOG "BAD PHONE IN RECORD ".$i."\n";
	}
}

sub CheckAreaCode() {
		if ($DB) {print STDERR "Checking areacode\n";}
	$stmt="select areacode, state from vicidial_phone_codes where areacode='$area_code' and country='$list_country' limit 1";
	$dbh->query("$stmt") or die "ERROR: $!\n";
	if ($dbh->has_selected_record) {
		# print "Has selected record.\n";
		$rslt = $dbh->create_record_iterator();
		my $row = $rslt->each;
		$row->[0]+=0;
		if ($row->[0]>0) {
			if ($checkarea_code eq "Y") {
				$alt_state=$row->[1];
				# print "$i)\t$area_code - $state - $alt_state\t";
				if ($list_country eq "CAN") {
					if ($province==$alt_state) {
						CheckAddress();
					} else {
						$errata->insert('end', "PROVINCE/AREA CODE MISMATCHED IN RECORD $i\n");
						print ERROR_LOG "PROVINCE/AREA CODE MISMATCHED IN RECORD ".$i."\n";
						$bad_records++;
					}
				} elsif ($list_country eq "USA") {
					if ($state eq $alt_state) {
						CheckAddress();
					} else {
						$errata->insert('end', "STATE/AREA CODE MISMATCHED IN RECORD $i\n");
						print ERROR_LOG "STATE/AREA CODE MISMATCHED IN RECORD ".$i."\n";
						$bad_records++;
					}
				} else {
					die "The script should not have reached this point, since the country should have been CANADA or USA to do this check, and should have been skipped otherwise.\n";
				}
			} else {
				CheckAddress();
			}
		} else {
			$errata->insert('end', "BAD AREA CODE IN RECORD $i: $area_code\n");
			print ERROR_LOG "BAD AREA CODE IN RECORD $i: $area_code\n";
			$bad_records++;
		}
#		}
	} else {
		die "This should have returned something.\n";
	}
}

sub CheckAddress() {
		if ($DB) {print STDERR "Checking address\n";}
  if ($fields{"address1"}!=99 && $checkaddress eq "Y") {
	$fulladdress=$address1.$address2.$address3;
	if (length($fulladdress)<5) {
		$errata->insert('end', "INSUFFICIENT ADDRESS INFO IN RECORD $i\n");
		print ERROR_LOG "INSUFFICIENT ADDRESS INFO IN RECORD $i\n";
		$bad_records++;
	} else {
		CheckZip();
	}
  } else {
	  CheckZip();
  }
}

sub CheckZip() {
		if ($DB) {print STDERR "Checking postal\n";}
  if ($fields{"postal_code"}!=99 && $checkpostal_code eq "Y") {
	if ($list_country eq "USA") {
		$pccheck=$postal_code;
		$pccheck=~s/[^0-9]//g;
		if ((length($pccheck)!=5 && length($pccheck)!=9) || $pccheck<1001) {
			$errata->insert('end', "BAD POSTAL CODE IN RECORD $i: $postal_code\n");
			print ERROR_LOG "BAD POSTAL CODE IN RECORD $i: $postal_code\n";
			$bad_records++;
		} else {
			CheckState();
		}
	} elsif ($list_country eq "AUS") {
		$postal_code=~s/[^0-9]//g;
		if (length($postal_code)!=4 || $postal_code<101) {
			$errata->insert('end', "BAD POSTAL CODE IN RECORD $i: $postal_code\n");
			print ERROR_LOG "BAD POSTAL CODE IN RECORD $i: $postal_code\n";
			$bad_records++;
		} else {
			CheckState();
		}
	} elsif ($list_country eq "UK") {
		$pccheck=$postal_code;
		$pccheck=~s/[^0-9A-Z]//g;
		if ($postal_code=~/\s{2,3}/i) {
			$postal_code=~s/\s{2,3}/ /g;
		}
		if (length($pccheck)>7 || length($pccheck)<5 || $postal_code!~/[A-Z]{1,2}\d{1,2}[A-Z]{0,1}\s\d[A-Z]{2}/i) {
			$errata->insert('end', "BAD POSTAL CODE IN RECORD $i: $postal_code\n");
			print ERROR_LOG "BAD POSTAL CODE IN RECORD $i: $postal_code\n";
			$bad_records++;
		} else {
			CheckState();
		}
	} else {
		$pccheck=$postal_code;
		$pccheck=~s/[^0-9A-Z]//g;
		if ($postal_code=~/\s{2,3}/i) {
			$postal_code=~s/\s{2,3}/ /g;
		}
		if (length($pccheck)!=6 || $pccheck!~/[A-Z]\d[A-Z]\d[A-Z]\d/i) {
			$errata->insert('end', "BAD POSTAL CODE IN RECORD $i: $postal_code\n");
			print ERROR_LOG "BAD POSTAL CODE IN RECORD $i: $postal_code\n";
			$bad_records++;
		} else {
			if ($fields{"province"}==99 || length($province)==0) {
				$province=$provinces{substr($postal_code, 0, 1)};
				if (length($state)==0) {
					$state=$province;
				} 
			}
			CheckState();
			print "\n";
		}
	}

  } else {
	CheckState();	
  }
}

sub CheckState() {
		if ($DB) {print STDERR "Checking state\n";}
  if (($fields{"state"}!=99 && $checkstate eq "Y")) {
		if ($list_country eq "USA") {
			$_="CT,DE,DC,FL,GA,IN,KY,ME,MD,MA,MI,NH,NJ,NY,NC,OH,PA,RI,SC,TN,VT,VA,WV,AL,AR,IL,IA,KS,LA,MN,MS,MO,NE,ND,OK,SD,TX,WI,AZ,CO,ID,MT,NM,OR,UT,WY,CA,NV,WA,AK,HI";
			$pccheck=$postal_code;
			$pccheck=~s/[^0-9]//g;
			if(/$state/ && length($state)==2) {
				CheckDateofBirth();
			} elsif ((length($pccheck)==5 || length($pccheck)==9) && $pccheck>1000) {
				$pccheck=substr($pccheck, 0, 5);
				for ($q=0; $q<scalar(@us_zc_ary); $q++) {
					if ($pccheck>=$us_zc_ary[$q][1] && $pccheck<=$us_zc_ary[$q][2]) {
						$state=$us_zc_ary[$q][0];
					}
				}
				CheckDateofBirth();
			} else {
				$errata->insert('end', "MISSING STATE INFO IN RECORD $i\n");
				print ERROR_LOG "MISSING STATE INFO IN RECORD $i\n";
				$bad_records++;
			}
		} elsif ($list_country eq "AUS") {
			$state=~s/[^A-Z]//g;		
			$_="ACT,NT,NSW,VIC,QLD,SA,WA,TAS";

			$pccheck=$postal_code;
			$pccheck=~s/[^0-9]//g;
			if(/$state/ && (length($state)==2 || length($state)==3)) {
				CheckDateofBirth();
			} elsif (length($pccheck)==4 && $pccheck>=200) {
				$pccheck=substr($pccheck, 0, 4);
				for ($q=0; $q<scalar(@aus_zc_ary); $q++) {
					if ($pccheck>=$aus_zc_ary[$q][1] && $pccheck<=$aus_zc_ary[$q][2]) {
						$state=$aus_zc_ary[$q][0];
					}
				}
				CheckDateofBirth();
			} else {
				$errata->insert('end', "MISSING STATE INFO IN RECORD $i\n");
				print ERROR_LOG "MISSING STATE INFO IN RECORD $i\n";
				$bad_records++;
			}
		}
  } else {
	CheckDateofBirth();
  }
}

sub CheckDateofBirth() {
		if ($DB) {print STDERR "Checking dob\n";}
  if ($fields{"date_of_birth"}!=99 && $checkdate_of_birth eq "Y") {
		%pos=();
		if (length($date_of_birth)>=6 && length($date_of_birth)<=10) {
			if ($dobmask=~/\-/) {
				$pos{index($dobmask, "y")}="doby";
				$pos{index($dobmask, "m")}="dobm";
				$pos{index($dobmask, "d")}="dobd";
				$x=0;
				@dob_ary=split(/\-/, $date_of_birth);
				foreach $position (sort(keys(%pos))) {
					$varname=$pos{$position};
					$$varname=$dob_ary[$x];
					$x++;
				}
			} elsif ($dobmask=~/\//) {
				$pos{index($dobmask, "y")}="doby";
				$pos{index($dobmask, "m")}="dobm";
				$pos{index($dobmask, "d")}="dobd";
				$x=0;
				@dob_ary=split(/\//, $date_of_birth);
				foreach $position (sort(keys(%pos))) {
					$varname=$pos{$position};
					$$varname=$dob_ary[$x];
					$x++;
				}
			} else {
				$ypos=index($dobmask, "y");
				$mpos=index($dobmask, "m");
				$dpos=index($dobmask, "d");
				$yend=rindex($dobmask, "y");
				$mend=rindex($dobmask, "m");
				$dend=rindex($dobmask, "d");
				$doby=substr($date_of_birth, $ypos, (($yend+1)-$ypos));
				$dobm=substr($date_of_birth, $mpos, (($mend+1)-$mpos));
				$dobd=substr($date_of_birth, $dpos, (($dend+1)-$dpos));
			}
			$dobd=substr("0".$dobd, -2);
			$dobm=substr("0".$dobm, -2);
			if ($dobmask!~/yyyy/i) {
				$doby=substr("19".$doby, -4);
			}
			$date_of_birth="$doby-$dobm-$dobd";

			if ($date_of_birth!~/^(\d){4}\-(\d){2}\-(\d){2}$/i || $dobm>12 || $dobm<1 || $dobd<1 || $dobd>31) {
				$errata->insert('end', "INVALID DATE OF BIRTH IN RECORD ".$i.": ".$date_of_birth."\n");
				print ERROR_LOG "INVALID DATE OF BIRTH IN RECORD ".$i.": ".$date_of_birth."\n";
				$bad_records++;
			} elsif ($under18<$doby.$dobm.$dobd) {
				$errata->insert('end', "CUSTOMER UNDER 18 - RECORD ".$i.": ".$date_of_birth."\n");
				print ERROR_LOG "CUSTOMER UNDER 18 - RECORD ".$i.": ".$date_of_birth."\n";
				$bad_records++;
			} else {
				FormatRecord();
			}
		} else {
			$errata->insert('end', "INVALID DATE OF BIRTH IN RECORD ".$i.": ".$date_of_birth."\n");
			print ERROR_LOG "INVALID DATE OF BIRTH IN RECORD ".$i.": ".$date_of_birth."\n";
			$bad_records++;
		}
  } else {
	FormatRecord();
  }
}

sub FormatRecord() {
		if ($DB) {print STDERR "Formatting record\n";}
	($sec,$min,$hour,$mday,$mon,$year,$wday,$yday,$isdst) = localtime(time);
	$year = ($year + 1900);
	$mon++;
	if ($sec < 10) {$sec = "0$sec";}	
	if ($min < 10) {$min = "0$min";}
	if ($hour < 10) {$hour = "0$hour";}
	if ($mon < 10) {$mon = "0$mon";}
	if ($mday < 10) {$mday = "0$mday";}
	undef $wday; undef $yday; undef $isdst;
	$entry_date="$year-$mon-$mday $hour:$min:$sec";
	$phone_code=1;
	if ($list_country eq "AUS") {
		$phone_code="01161";
	} elsif ($list_country eq "UK") {
		$phone_code="01144";
	}

	if ($i%50==0) {
		$GoodRecords->delete(0, 'end');
		$GoodRecords->insert(0, "$good_records");
		$BadRecords->delete(0, 'end');
		$BadRecords->insert(0, "$bad_records");
		$TotalRecords->delete(0, 'end');
		$TotalRecords->insert(0, "$total_records");
		print STDERR "$total_records\n";
		usleep(1*900*1000);
	}

	$error_message="";
	$good_records++;	
	$stmt="insert into vicidial_temporary_phone_list VALUES ('$phone_number')";
	$dbh->query($stmt) or die "Temporary table error: $!\n";
	$stmt="insert into vicidial_list(entry_date, status, vendor_lead_code, source_id, list_id, phone_code, phone_number, title, first_name, middle_initial, last_name, address1, address2, address3, city, state, province, postal_code, country_code, gender, date_of_birth, alt_phone, email, security_phrase, comments) VALUES('$entry_date', 'NEW', '$vendor_lead_code', '$source_id', '$list_id', '$phone_code', '$phone_number', '$title', '$first_name', '$middle_initial', '$last_name', '$address1', '$address2', '$address3', '$city', '$state', '$province', '$postal_code', '$list_country', '$gender', '$date_of_birth', '$alt_phone', '$email', '$security_phrase', '$comments')";
	$dbh->query($stmt) or die "Vicidial_list table error: $!";
}
# $errata->insert('end', "#######################################");



##########################################
##########################################
### connect to idcheck database and fill in variables
##########################################
##########################################
sub idcheck_connect {

	$SIP_abb = $SIP_user;
	$SIP_abb =~ s/SIP\/|IAX2\/|Zap\///gi;


$dbhA = Net::MySQL->new(hostname => "$DB_server", database => "$DB_database", user => "$DB_user", password => "$DB_pass", port => "$DB_port") 
		or 	die "Couldn't connect to database: $DB_server - $DB_database\n";

if ($DB) {print STDERR "connecting to DB: $DB_server - $DB_database\n";}

   $dbhA->query("SELECT * FROM phones where server_ip = '$server_ip' and extension = '$SIP_abb';");
   if ($dbhA->has_selected_record)
	{
   $iterA=$dbhA->create_record_iterator;
	 $rec_countA=0;
	   while ($recordA = $iterA->each)
		{
		   if($DB){print STDERR $recordA->[0],"|", $recordA->[1],"\n";}

			$LOCAL_GMT = "$recordA->[17]";
			$ASTmgrUSERNAME	 = "$recordA->[18]";
			$ASTmgrSECRET = "$recordA->[19]";
			$login_user = "$recordA->[20]";
			$login_pass = "$recordA->[21]";
			$login_campaign = "$recordA->[22]";
			$park_on_extension = "$recordA->[23]";
			$conf_on_extension = "$recordA->[24]";
			$VICIDIAL_park_on_extension = "$recordA->[25]";
			$VICIDIAL_park_on_filename = "$recordA->[26]";
			$monitor_prefix = "$recordA->[27]";
			$recording_exten = "$recordA->[28]";
			$voicemail_exten = "$recordA->[29]";
			$voicemail_dump_exten = "$recordA->[30]";
			$ext_context = "$recordA->[31]";
			$dtmf_send_extension = "$recordA->[32]";
			$call_out_number_group = "$recordA->[33]";
			$client_browser = "$recordA->[34]";
			$install_directory = "$recordA->[35]";
			$local_web_callerID_URL = "$recordA->[36]";
			$VICIDIAL_web_URL = "$recordA->[37]";
			$AGI_call_logging_enabled = "$recordA->[38]";
			$user_switching_enabled = "$recordA->[39]";
			$conferencing_enabled = "$recordA->[40]";
			$admin_hangup_enabled = "$recordA->[41]";
			$admin_hijack_enabled = "$recordA->[42]";
			$admin_monitor_enabled = "$recordA->[43]";
			$call_parking_enabled = "$recordA->[44]";
			$updater_check_enabled = "$recordA->[45]";
			$AFLogging_enabled = "$recordA->[46]";
			$QUEUE_ACTION_enabled = "$recordA->[47]";
			$CallerID_popup_enabled = "$recordA->[48]";
			$voicemail_button_enabled = "$recordA->[49]";
			$enable_fast_refresh = "$recordA->[50]";
			$fast_refresh_rate = "$recordA->[51]";
			$enable_persistant_mysql = "$recordA->[52]";
			$auto_dial_next_number = "$recordA->[53]";
			$VDstop_rec_after_each_call = "$recordA->[54]";
			$DBX_server = "$recordA->[55]";
			$DBX_database = "$recordA->[56]";
			$DBX_user = "$recordA->[57]";
			$DBX_pass = "$recordA->[58]";
			$DBX_port = "$recordA->[59]";
			$DBY_server = "$recordA->[60]";
			$DBY_database = "$recordA->[61]";
			$DBY_user = "$recordA->[62]";
			$DBY_pass = "$recordA->[63]";
			$DBY_port = "$recordA->[64]";

		if (length($DBX_server)<4) {$DBX_server = $DB_server;}
		if (length($DBX_database)<2) {$DBX_database = $DB_database;}
	   $rec_countA++;
		} 
	}

	$dbhA->close;

}





MainLoop;