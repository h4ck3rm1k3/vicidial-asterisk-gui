<?
### vtiger web api for user administration

/**
         * @return -- returns a list of all users in the system.
        function verify_data()
        {
                $usr_name = $this->column_fields["user_name"];
                global $mod_strings;

                $query = "SELECT user_name from vtiger_users where user_name=? AND id<>? AND deleted=0";
                $result =$this->db->pquery($query, array($usr_name, $this->id), true, "Error selecting possible duplicate users: ");
                $dup_users = $this->db->fetchByAssoc($result);

                $query = "SELECT user_name from vtiger_users where is_admin = 'on' AND deleted=0";
                $result =$this->db->pquery($query, array(), true, "Error selecting possible duplicate vtiger_users: ");
                $last_admin = $this->db->fetchByAssoc($result);

                $this->log->debug("last admin length: ".count($last_admin));
                $this->log->debug($last_admin['user_name']." == ".$usr_name);

                $verified = true;
                if($dup_users != null)
                {
                        $this->error_string .= $mod_strings['ERR_USER_NAME_EXISTS_1'].$usr_name.''.$mod_strings['ERR_USER_NAME_EXISTS_2'];
                        $verified = false;
                }
                if(!isset($_REQUEST['is_admin']) &&
                                count($last_admin) == 1 &&
                                $last_admin['user_name'] == $usr_name) {
                        $this->log->debug("last admin length: ".count($last_admin));

                        $this->error_string .= $mod_strings['ERR_LAST_ADMIN_1'].$usr_name.$mod_strings['ERR_LAST_ADMIN_2'];
                        $verified = false;
                }

                return $verified;
        }
*/


# require("../vtigercrm/modules/Calendar/Activity.php");

# $verified = verify_data();


/*

         * @return string encrypted password for storage in DB and comparison against DB password.
         * @param string $user_name - Must be non null and at least 2 characters
         * @param string $user_password - Must be non null and at least 1 character.
         * @desc Take an unencrypted username and password and return the encrypted password
         * Portions created by SugarCRM are Copyright (C) SugarCRM, Inc..
         * All Rights Reserved..
         * Contributor(s): ______________________________________..
        function encrypt_password($user_password, $crypt_type='')
        {
                // encrypt the password.
                $salt = substr($this->column_fields["user_name"], 0, 2);

                // Fix for: http://trac.vtiger.com/cgi-bin/trac.cgi/ticket/4923
                if($crypt_type == '') {
                        // Try to get the crypt_type which is in database for the user
                        $crypt_type = $this->get_user_crypt_type();
                }

                // For more details on salt format look at: http://in.php.net/crypt
                if($crypt_type == 'MD5') {
                        $salt = '$1$' . $salt . '$';
                } else if($crypt_type == 'BLOWFISH') {
                        $salt = '$2$' . $salt . '$';
                }

                $encrypted_password = crypt($user_password, $salt);

                return $encrypted_password;

        }
*/





##### vtiger_user.php - script used to synchronize the users from the VICIDIAL
#####                   vicidial_users table into the Vtiger system

# CHANGES
# 81231-1307 - First build
#


header ("Content-type: text/html; charset=utf-8");

require("dbconnect.php");

$PHP_AUTH_USER=$_SERVER['PHP_AUTH_USER'];
$PHP_AUTH_PW=$_SERVER['PHP_AUTH_PW'];
$PHP_SELF=$_SERVER['PHP_SELF'];


#$DB = '1';	# DEBUG override
$US = '_';
$STARTtime = date("U");
$TODAY = date("Y-m-d");
$NOW_TIME = date("Y-m-d H:i:s");
$REC_TIME = date("Ymd-His");
$FILE_datetime = $STARTtime;
$parked_time = $STARTtime;

###############################################################
##### START SYSTEM_SETTINGS VTIGER CONNECTION INFO LOOKUP #####
$stmt = "SELECT enable_vtiger_integration,vtiger_server_ip,vtiger_dbname,vtiger_login,vtiger_pass,vtiger_url FROM system_settings;";
$rslt=mysql_query($stmt, $link);
if ($DB) {echo "$stmt\n";}
$ss_conf_ct = mysql_num_rows($rslt);
if ($ss_conf_ct > 0)
	{
	$row=mysql_fetch_row($rslt);
	$enable_vtiger_integration =	$row[0];
	$vtiger_server_ip	=			$row[1];
	$vtiger_dbname =				$row[2];
	$vtiger_login =					$row[3];
	$vtiger_pass =					$row[4];
	$vtiger_url =					$row[5];
	}
##### END SYSTEM_SETTINGS VTIGER CONNECTION INFO LOOKUP #####
#############################################################

echo "<html>\n";
echo "<head>\n";
echo "<title>VICIDIAL Vtiger user synchronization utility</title>\n";
echo "<META HTTP-EQUIV=\"Content-Type\" CONTENT=\"text/html; charset=utf-8\">\n";

if ($enable_vtiger_integration < 1)
	{
	echo "<B>ERROR! - Vtiger integration is disabled in the VICIDIAL system_settings";
	exit;
	}

##### grab the existing users in the vicidial_users table
$stmt="SELECT user,pass,full_name,user_level,active FROM vicidial_users;";
$rslt=mysql_query($stmt, $link);
if ($DB) {echo "$stmt\n";}
$VD_users_ct = mysql_num_rows($rslt);
$i=0;
while ($i < $VD_users_ct)
	{
	$row=mysql_fetch_row($rslt);
	$user[$i] =			$row[0];
	$pass[$i] =			$row[1];
	$full_name[$i] =	$row[2];   while (strlen($full_name[$i])>30) {$full_name[$i] = eregi_replace(".$",'',$full_name[$i]);}
	$user_level[$i] =	$row[3];
	$active[$i] =		$row[4];
	$i++;
	}


### connect to your vtiger database
$linkV=mysql_connect("$vtiger_server_ip", "$vtiger_login","$vtiger_pass");
if (!$linkV) {die("Could not connect: $vtiger_server_ip|$vtiger_dbname|$vtiger_login|$vtiger_pass" . mysql_error());}
echo 'Connected successfully';
mysql_select_db("$vtiger_dbname", $linkV);


$i=0;
while ($i < $VD_users_ct)
	{
	$user_name =		$user[$i];
	$user_password =	$pass[$i];
	$last_name =		$full_name[$i];
	$is_admin =			'off';
	$roleid =			'H5';
	$status =			'Active';
	$groupid =			'1';
		if ($user_level[$i] >= 8) {$roleid = 'H4';}
		if ($user_level[$i] >= 9) {$roleid = 'H2';}
		if ($user_level[$i] >= 9) {$is_admin = 'on';}
		if (ereg('N',$active[$i])) {$status = 'Inactive';}
	$salt = substr($user_name, 0, 2);
	$salt = '$1$' . $salt . '$';
	$encrypted_password = crypt($user_password, $salt);
	$i++;

	$stmt="SELECT count(*) from vtiger_users where user_name='$user_name';";
	$rslt=mysql_query($stmt, $linkV);
	if ($DB) {echo "$stmt\n";}
	if (!$rslt) {die('Could not execute: ' . mysql_error());}
	$row=mysql_fetch_row($rslt);
	$found_count = $row[0];

	### user exists in vtiger, update it
	if ($found_count > 0)
		{
		$stmt="SELECT id from vtiger_users where user_name='$user_name';";
		$rslt=mysql_query($stmt, $linkV);
		if ($DB) {echo "$stmt\n";}
		if (!$rslt) {die('Could not execute: ' . mysql_error());}
		$row=mysql_fetch_row($rslt);
		$userid = $row[0];

		$stmtA = "UPDATE vtiger_users SET user_password='$encrypted_password',last_name='$last_name',is_admin='$is_admin',status='$status' where id='$userid';";
		if ($DB) {echo "|$stmtA|\n";}
		$rslt=mysql_query($stmtA, $linkV);
		if (!$rslt) {die('Could not execute: ' . mysql_error());}

		$stmtB = "UPDATE vtiger_user2role SET roleid='$roleid' where userid='$userid';";
		if ($DB) {echo "|$stmtB|\n";}
		$rslt=mysql_query($stmtB, $linkV);
		if (!$rslt) {die('Could not execute: ' . mysql_error());}

		echo "$user_name: $userid<BR>\n";
		echo "$stmtA<BR>\n";
		echo "$stmtB<BR>\n";
		echo "<BR>\n";

		}

	### user doesn't exist in vtiger, insert it
	else
		{
		#### BEGIN CREATE NEW USER RECORD IN VTIGER
		$stmtA = "INSERT INTO vtiger_users SET user_name='$user_name',user_password='$encrypted_password',last_name='$last_name',is_admin='$is_admin',status='$status',date_format='yyyy-mm-dd',first_name='',reports_to_id='',description='',title='',department='',phone_home='',phone_mobile='',phone_work='',phone_other='',phone_fax='',email1='',email2='',yahoo_id='',signature='',address_street='',address_city='',address_state='',address_country='',address_postalcode='',user_preferences='',imagename='';";
		if ($DB) {echo "|$stmtA|\n";}
		$rslt=mysql_query($stmtA, $linkV);
		if (!$rslt) {die('Could not execute: ' . mysql_error());}
		$userid = mysql_insert_id($linkV);
	
		$stmtB = "INSERT INTO vtiger_user2role SET userid='$userid',roleid='$roleid';";
		if ($DB) {echo "|$stmtB|\n";}
		$rslt=mysql_query($stmtB, $linkV);
		if (!$rslt) {die('Could not execute: ' . mysql_error());}

		$stmtC = "INSERT INTO vtiger_users2group SET userid='$userid',groupid='$groupid';";
		if ($DB) {echo "|$stmtC|\n";}
		$rslt=mysql_query($stmtC, $linkV);
		if (!$rslt) {die('Could not execute: ' . mysql_error());}

		$stmtD = "UPDATE vtiger_users_seq SET id='$userid';";
		if ($DB) {echo "|$stmtD|\n";}
		$rslt=mysql_query($stmtD, $linkV);
		if (!$rslt) {die('Could not execute: ' . mysql_error());}

		echo "$user_name:<BR>\n";
		echo "$stmtA<BR>\n";
		echo "$stmtB<BR>\n";
		echo "$stmtC<BR>\n";
		echo "$stmtD<BR>\n";
		echo "<BR>\n";
		#### END CREATE NEW USER RECORD IN VTIGER
		}


	}





echo "DONE\n";

exit;


