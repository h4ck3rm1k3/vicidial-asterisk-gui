<?
define ('ADAY', (60*60*24));
$CdayARY = getdate();
$Cmon = $CdayARY['mon'];
$Cyear = $CdayARY['year'];
$CTODAY = date("Y-m");
$CTODAYmday = date("j");
$CINC=0;

$Cmonths = Array('January','February','March','April','May','June',
				'July','August','September','October','November','December');
$Cdays = Array('Sun','Mon','Tue','Wed','Thu','Fri','Sat');


$CCAL_OUT = '';

$CCAL_OUT .= "<table border=0 cellpadding=2 cellspacing=2>";

while ($CINC < 12)
{
if ( ($CINC == 0) || ($CINC == 4) ||($CINC == 8) )
	{$CCAL_OUT .= "<tr>";}

$CCAL_OUT .= "<td valign=top>";

$CYyear = $Cyear;
$Cmonth=	($Cmon + $CINC);
if ($Cmonth > 12)
	{
	$Cmonth = ($Cmonth - 12);
	$CYyear++;
	}
$Cstart= mktime(0,0,0,$Cmonth,1,$CYyear);
$CfirstdayARY = getdate($Cstart);
#echo "|$Cmon|$Cmonth|$CINC|\n";
$CPRNTDAY = date("Y-m", $Cstart);

$CCAL_OUT .= "<table border=1 cellpadding=1 bordercolor=\"000000\" cellspacing=\"0\">";
$CCAL_OUT .= "<tr>";
$CCAL_OUT .= "<td colspan=7 bordercolor=\"#ffffff\" bgcolor=\"#FFFFCC\">";
$CCAL_OUT .= "<div align=center><font color=\"#000066\"><b><font face=\"Arial, Helvetica, sans-serif\" size=2>";
$CCAL_OUT .= "$CfirstdayARY[month] $CfirstdayARY[year]";
$CCAL_OUT .= "</font></b></font></div>";
$CCAL_OUT .= "</td>";
$CCAL_OUT .= "</tr>";

foreach($Cdays as $Cday)
{
	$CDCLR="#ffffff";

$CCAL_OUT .= "<td bordercolor=\"$CDCLR\">";
$CCAL_OUT .= "<div align=center><font color=\"#000066\"><b><font face=\"Arial, Helvetica, sans-serif\" size=1>";
$CCAL_OUT .= "$Cday";
$CCAL_OUT .= "</font></b></font></div>";
$CCAL_OUT .= "</td>";
}

for( $Ccount=0;$Ccount<(6*7);$Ccount++)
{
	$Cdayarray = getdate($Cstart);
	if((($Ccount) % 7) == 0)
	{
		if($Cdayarray['mon'] != $CfirstdayARY['mon'])
			break;
		$CCAL_OUT .= "</tr><tr>";
	}
	if($Ccount < $CfirstdayARY['wday'] || $Cdayarray['mon'] != $Cmonth)
	{
		$CCAL_OUT .= "<td bordercolor=\"#ffffff\"><font color=\"#000066\"><b><font face=\"Arial, Helvetica, sans-serif\" size=\"1\">&nbsp;</font></b></font></td>";
	}
	else
	{
		if( ($Cdayarray['mday'] == $CTODAYmday) and ($CPRNTDAY == $CTODAY) )
		{
		$CPRNTmday = $Cdayarray['mday'];
		if ($CPRNTmday < 10) {$CPRNTmday = "0$CPRNTmday";}
		$CBL = "<a href=\"#\" onclick=\"CB_date_pick('$CPRNTDAY-$CPRNTmday');return false;\">";
		$CEL = "</a>";

		$CCAL_OUT .= "<td bgcolor=\"#CCFFCC\" bordercolor=\"#CCFFCC\">";
		$CCAL_OUT .= "<div align=center><font face=\"Arial, Helvetica, sans-serif\" size=1>";
		$CCAL_OUT .= "$CBL$Cdayarray[mday]$CEL";
		$CCAL_OUT .= "</font></div>";
		$CCAL_OUT .= "</td>";
			$Cstart += ADAY;
		}
		else
		{
	$CDCLR="#ffffff";
	if ( ($Cdayarray['mday'] < $CTODAYmday) and ($CPRNTDAY == $CTODAY) )
		{
		$CDCLR="#CCCCCC";
		$CBL = '';
		$CEL = '';
		}
	else
		{
		$CPRNTmday = $Cdayarray['mday'];
		if ($CPRNTmday < 10) {$CPRNTmday = "0$CPRNTmday";}
		$CBL = "<a href=\"#\" onclick=\"CB_date_pick('$CPRNTDAY-$CPRNTmday');return false;\">";
		$CEL = "</a>";
		}

	$CCAL_OUT .= "<td bgcolor=\"$CDCLR\" bordercolor=\"#ffffff\">";
	$CCAL_OUT .= "<div align=center><font face=\"Arial, Helvetica, sans-serif\" size=1>";
	$CCAL_OUT .= "$CBL$Cdayarray[mday]$CEL";
	$CCAL_OUT .= "</font></div>";
	$CCAL_OUT .= "</td>";
		$Cstart += ADAY;
		}
	}
}
$CCAL_OUT .= "</tr>";
$CCAL_OUT .= "</table>";
$CCAL_OUT .= "</td>";

if ( ($CINC == 3) || ($CINC == 7) ||($CINC == 11) )
	{$CCAL_OUT .= "</tr>";}
$CINC++;
}

$CCAL_OUT .= "</table>";

echo "$CCAL_OUT\n";

