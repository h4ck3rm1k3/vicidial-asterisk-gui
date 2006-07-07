#!/usr/bin/perl

### AST_VICI_conf.pl
### 
### Copyright (C) 2006  Matt Florell <vicidial@gmail.com>    LICENSE: GPLv2
###

### Customized Variables
$SIP_user = 'SIP/cc100';		# your phone id
$server_ip = '10.10.10.15';		# Asterisk server IP
$DB_server = '10.10.10.15';		# MySQL server IP
$DB_database = 'asterisk';		# MySQL database name
$DB_user = 'idcheck';			# MySQL user
$DB_pass = '1234';			# MySQL pass
$DB_port = '3306';			# MySQL connection port

### Constants
$record_channel='';
$filename='';
$recording_id='';
$US = '_';
$MT[0] = '';

return 1;


# this subroutine is to be used with the callerID function to customize the
# variables that are passed in the URL string and the way that they are passed,
# these are the variables you have to work with:
#   $callerID_areacode
#   $callerID_prefix
#   $callerID_last4
#   $callerID_Time
#   $callerID_Channel
#   $callerID_uniqueID
#   $callerID_phone_ext
#	$callerID_server_ip
#	$callerID_extension
#	$callerID_inbound_number
#	$callerID_comment_a
#	$callerID_comment_b
#	$callerID_comment_c
#	$callerID_comment_d
#	$callerID_comment_e

sub create_callerID_local_query_string
{
$local_web_callerID_QUERY_STRING ='';
$local_web_callerID_QUERY_STRING.="?callerID_areacode=$callerID_areacode";
$local_web_callerID_QUERY_STRING.="&callerID_prefix=$callerID_prefix";
$local_web_callerID_QUERY_STRING.="&callerID_last4=$callerID_last4";
$local_web_callerID_QUERY_STRING.="&callerID_Time=$callerID_Time";
$local_web_callerID_QUERY_STRING.="&callerID_Channel=$callerID_Channel";
$local_web_callerID_QUERY_STRING.="&callerID_uniqueID=$callerID_uniqueID";
$local_web_callerID_QUERY_STRING.="&callerID_phone_ext=$callerID_phone_ext";
$local_web_callerID_QUERY_STRING.="&callerID_server_ip=$callerID_server_ip";
$local_web_callerID_QUERY_STRING.="&callerID_extension=$callerID_extension";
$local_web_callerID_QUERY_STRING.="&callerID_inbound_number=$callerID_inbound_number";
$local_web_callerID_QUERY_STRING.="&callerID_comment_a=$callerID_comment_a";
$local_web_callerID_QUERY_STRING.="&callerID_comment_b=$callerID_comment_b";
$local_web_callerID_QUERY_STRING.="&callerID_comment_c=$callerID_comment_c";
$local_web_callerID_QUERY_STRING.="&callerID_comment_d=$callerID_comment_d";
$local_web_callerID_QUERY_STRING.="&callerID_comment_e=$callerID_comment_e";
}

# $lead_id	
# $vendor_id
# $list_id
# $phone_code	
# $phone_number
# $title
# $first_name	
# $middle_initial
# $last_name
# $address1
# $address2
# $address3
# $city	
# $state
# $province	
# $postal_code	
# $country_code
# $gender	
# $date_of_birth
# $alt_phone
# $email	
# $security	
# $comments
# $user
# $pass
# $fronter
# $closer
# $campaign
# $group
# $SQLdate
# $epoch
# $uniqueid
# $customer_zap_channel
# $server_ip
# $SIPexten

sub create_VICIDIAL_query_string
{
$VICIDIAL_web_QUERY_STRING ='';
$VICIDIAL_web_QUERY_STRING.="?lead_id=$lead_id";
$VICIDIAL_web_QUERY_STRING.="&vendor_id=$vendor_id";
$VICIDIAL_web_QUERY_STRING.="&list_id=$list_id";
$VICIDIAL_web_QUERY_STRING.="&phone_code=$phone_code";
$VICIDIAL_web_QUERY_STRING.="&phone_number=$phone_number";
$VICIDIAL_web_QUERY_STRING.="&title=$title";
$VICIDIAL_web_QUERY_STRING.="&first_name=$first_name";
$VICIDIAL_web_QUERY_STRING.="&middle_initial=$middle_initial";
$VICIDIAL_web_QUERY_STRING.="&last_name=$last_name";
$VICIDIAL_web_QUERY_STRING.="&address1=$address1";
$VICIDIAL_web_QUERY_STRING.="&address2=$address2";
$VICIDIAL_web_QUERY_STRING.="&address3=$address3";
$VICIDIAL_web_QUERY_STRING.="&city=$city";
$VICIDIAL_web_QUERY_STRING.="&state=$state";
$VICIDIAL_web_QUERY_STRING.="&province=$province";
$VICIDIAL_web_QUERY_STRING.="&postal_code=$postal_code";
$VICIDIAL_web_QUERY_STRING.="&country_code=$country_code";
$VICIDIAL_web_QUERY_STRING.="&gender=$gender";
$VICIDIAL_web_QUERY_STRING.="&date_of_birth=$date_of_birth";
$VICIDIAL_web_QUERY_STRING.="&alt_phone=$alt_phone";
$VICIDIAL_web_QUERY_STRING.="&email=$email";
$VICIDIAL_web_QUERY_STRING.="&security=$security";
$VICIDIAL_web_QUERY_STRING.="&comments=$comments";
$VICIDIAL_web_QUERY_STRING.="&user=$user";
$VICIDIAL_web_QUERY_STRING.="&pass=$userpass";
$VICIDIAL_web_QUERY_STRING.="&fronter=$fronter";
$VICIDIAL_web_QUERY_STRING.="&closer=$user";
$VICIDIAL_web_QUERY_STRING.="&campaign=$campaign";
$VICIDIAL_web_QUERY_STRING.="&group=$group";
$VICIDIAL_web_QUERY_STRING.="&channel_group=$channel_group";
$VICIDIAL_web_QUERY_STRING.="&SQLdate=$SQLdate";
$VICIDIAL_web_QUERY_STRING.="&epoch=$secX";
$VICIDIAL_web_QUERY_STRING.="&uniqueid=$uniqueid";
$VICIDIAL_web_QUERY_STRING.="&customer_zap_channel=$customer_zap_channel";
$VICIDIAL_web_QUERY_STRING.="&server_ip=$server_ip";
$VICIDIAL_web_QUERY_STRING.="&SIPexten=$SIPexten";
$VICIDIAL_web_QUERY_STRING.="&session_id=$session_id";
$VICIDIAL_web_QUERY_STRING.="&phone=$phone_number";
$VICIDIAL_web_QUERY_STRING.="&parked_by=$lead_id";
$VICIDIAL_web_QUERY_STRING =~ s/ /+/gi;
$VICIDIAL_web_QUERY_STRING =~ s/\`|\~|\:|\;|\#|\'|\"|\{|\}|\(|\)|\*|\^|\%|\$|\!|\%|\r|\t|\n//gi;
}