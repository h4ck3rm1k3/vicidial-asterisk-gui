#!/usr/bin/perl

### listloader_rowdisplay.pl
### 
### Copyright (C) 2006  Matt Florell,Joe Johnson <vicidial@gmail.com>    LICENSE: GPLv2
###

use Spreadsheet::ParseExcel;
use Time::Local;
use Net::MySQL;

### Make sure this file is in a libs path or put the absolute path to it
require("/home/cron/AST_SERVER_conf.pl");	# local configuration file

if (!$DB_port) {$DB_port='3306';}

$dbhA = Net::MySQL->new(hostname => "$DB_server", database => "$DB_database", user => "$DB_user", password => "$DB_pass", port => "$DB_port") 
	or 	die "Couldn't connect to database: $DB_server - $DB_database\n";


$oBook = Spreadsheet::ParseExcel::Workbook->Parse("./vicidial_temp_file.xls");
my($iR, $iC, $oWkS, $oWkC);
$var_str="";

foreach $oWkS (@{$oBook->{Worksheet}}) {
	for(my $iC = $oWkS->{MinCol} ; defined $oWkS->{MaxCol} && $iC <= $oWkS->{MaxCol} ; $iC++) {
		$oWkC = $oWkS->{Cells}[0][$iC];
		if ($oWkC) {
			$var_str.=$oWkC->Value."|"; 
		} else {
			$var_str.="|"; 
		}
	}
}

@xls_row=split(/\|/, $var_str);


$dbhA->query("select vendor_lead_code, source_id, list_id, phone_code, phone_number, title, first_name, middle_initial, last_name, address1, address2, address3, city, state, province, postal_code, country_code, gender, date_of_birth, alt_phone, email, security_phrase, comments from vicidial_list limit 1");

if ($dbhA->has_selected_record) {
	$rslt = $dbhA->create_record_iterator();
	my @row = $rslt->get_field_names();
	for ($i=0; $i<scalar(@row); $i++) {
		# print "$i: $row[$i]\n";
		$field_name=uc($row[$i]);
		$field_name=~s/\_/ /g;
		print "  <tr bgcolor=#D9E6FE>\r\n";
		print "    <th><font class=standard>".$field_name.": </font></td>\r\n";
		print "    <th><select name='".$row[$i]."_field'>\r\n";
		print "     <option value=''>---------------------</option>\r\n";

		for ($j=0; $j<scalar(@xls_row); $j++) {
			$xls_row[$j]=~s/\"//g;
			print "     <option value='$j'>\"$xls_row[$j]\"</option>\r\n";
		}

		print "    </select></td>\r\n";
		print "  </tr>\r\n";
	}
}

