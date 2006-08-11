#!/usr/bin/perl

### listloader_rowdisplay.pl   version 0.2   *DBI-version*
### 
### Copyright (C) 2006  Matt Florell,Joe Johnson <vicidial@gmail.com>    LICENSE: GPLv2
###
#
# CHANGES
# 
# 60811-1232 - Changed to DBI
#

use Spreadsheet::ParseExcel;
use Time::Local;
use DBI;	  

### Make sure this file is in a libs path or put the absolute path to it
require("/home/cron/AST_SERVER_conf.pl");	# local configuration file

if (!$DB_port) {$DB_port='3306';}

$dbhA = DBI->connect("DBI:mysql:$DB_database:$DB_server:$DB_port", "$DB_user", "$DB_pass")
 or die "Couldn't connect to database: " . DBI->errstr;


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


$stmtA = "select vendor_lead_code, source_id, list_id, phone_code, phone_number, title, first_name, middle_initial, last_name, address1, address2, address3, city, state, province, postal_code, country_code, gender, date_of_birth, alt_phone, email, security_phrase, comments from vicidial_list limit 1;";
$sthA = $dbhA->prepare($stmtA) or die "preparing: ",$dbhA->errstr;
$sthA->execute or die "executing: $stmtA ", $dbhA->errstr;
$sthArows=$sthA->rows;
$rec_count=0;
while ($sthArows > $rec_count)
	{
	my $names = $sthA->{'NAME'};
	  my $numFields = $sthA->{'NUM_OF_FIELDS'};
	  for (my $i = 0;  $i < $numFields;  $i++) 
		{
	#	printf("%s%s", $i ? "," : "", $$names[$i]);
	#	printf("%s%s", $i ? "," : "", $$ref[$i]);

		$field_name=uc($$names[$i]);
		$field_name=~s/\_/ /g;
		print "  <tr bgcolor=#D9E6FE>\r\n";
		print "    <th><font class=standard>".$field_name.": </font></td>\r\n";
		print "    <th><select name='".$$names[$i]."_field'>\r\n";
		print "     <option value=''>---------------------</option>\r\n";

		for ($j=0; $j<scalar(@xls_row); $j++) 
			{
			$xls_row[$j]=~s/\"//g;
			print "     <option value='$j'>\"$xls_row[$j]\"</option>\r\n";
			}

		print "    </select></td>\r\n";
		print "  </tr>\r\n";
		}
	$rec_count++;
	}
$sthA->finish();

exit;
