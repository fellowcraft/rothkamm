<?php 

header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set('America/Los_Angeles');
include('dbcon.php');
$rootpath = '/var/www/html/ROTHKAMM/';

$Query = "
select count(ID) as Parts from PART
WHERE Status <> 0
";
$all_Q = $mysqli->query($Query);
$all_R = $all_Q->fetch_assoc();

$Query = "
select * from PART
ORDER BY year DESC, month DESC, day DESC, No DESC
";
$tracks_Q = $mysqli->query($Query);
//$tracks_R = $tracks_Q->fetch_assoc();

$Query = "
select sum(length) as SumTotal from PART
WHERE Status <> 0
";
$A_Q = $mysqli->query($Query);
$A_R = $A_Q->fetch_assoc();

$mysqli->close();
?>

<HTML>

<HEAD>
<TITLE><?php echo $all_R["Parts"]." works 1982-2018 ROTHKAMM" ?></TITLE>

<meta name="viewport" content="width=800">

<LINK HREF="css.css" REL="stylesheet" TYPE="text/css">
</HEAD>

<BODY>  
<div id="margin-left:auto; margin-right:auto;">

<DIV ID="Layer1"><!-- CONTENT -->
<TABLE WIDTH="800" BORDER="0" ALIGN="center" CELLPADDING="1" CELLSPACING="0"  BGCOLOR="FFFFFF">
<TR>
 <TD VALIGN="TOP" BGCOLOR="FFFFFF"><TABLE WIDTH="100%" BORDER="0" CELLPADDING="0" CELLSPACING="5" BGCOLOR="FFFFFF">


<TR>
<TD COLSPAN="9" HEIGHT="16" VALIGN="middle" BGCOLOR="FFFFFF"  CLASS="style1" ALIGN="CENTER" ><STRONG CLASS="styleTiny"><?php echo $all_R['Parts']." works  - ".round(($A_R['SumTotal']/60)/60,0)." hours ".round($A_R['SumTotal']/60%60,0)." minutes ".sprintf('%02d', $A_R["SumTotal"]%60)." seconds"; ?></STRONG></TD>
</TR>

<TR>
<TD VALIGN="top" BGCOLOR="FFFFFF"  CLASS="style2b">album</TD>
<TD VALIGN="top" BGCOLOR="FFFFFF"  CLASS="style2b">year</TD>
<TD VALIGN="top" BGCOLOR="FFFFFF"  CLASS="style2b">opus</TD>
<TD VALIGN="top" BGCOLOR="FFFFFF"  CLASS="style2b">work</TD>
<TD VALIGN="top" BGCOLOR="FFFFFF"  CLASS="style2b">city</TD>
</TR>

<?php
//mysqli_data_seek($tracks_Q,0);
while($row = $tracks_Q->fetch_assoc()) { 

$MP3s = "/var/www/html/ROTHKAMM/MP3320/";
$MP3name = "";

for ($i=0; $i <= 99; $i++) {

$MP3file = $MP3s.sprintf("%04d",$row["ID"]).sprintf("%02d",$i).'.mp3';
  
if(file_exists($MP3file)) { 

$MP3name = 'http://'.$_SERVER["HTTP_HOST"].'/MP3320/'
.sprintf("%04d",$row["ID"]).sprintf("%02d",$i).'.mp3'; 

}
}

$WorkLength = round($row["length"]/60,0).":".sprintf("%02d",$row["length"]%60);

if ($row["length"] > 3599) {
$WorkLength = round($row["length"]/3600).":". 
	sprintf("%02d",($row["length"]%3600)/60).":". 
	sprintf("%02d", $row["length"]%60);
}
?>
<TR>
<TD ALIGN="RIGHT" VALIGN="top" CLASS="style2fade" >
<?php if(trim($row["album"]) != '') {

$array = explode(",",$row["album"]);
foreach($array as $value) {

$WebName = str_replace(" ","+",trim($value));
echo "<A HREF='album.php?".$WebName."'>".$value.
" <br />"; 

} 
}

echo '</TD>';

echo '<TD VALIGN="top" NOWRAP   CLASS="style2">'.$row["year"].
'<IMG SRC="pictures/shim.gif" WIDTH="1" HEIGHT="12" ALIGN="TOP"></TD>

<TD ALIGN="CENTER" VALIGN="top" CLASS="style2"><STRONG>'.$row["ID"].'</STRONG></TD>

<TD VALIGN="top" CLASS="style3c">';

if($MP3name != '') { echo '<a href="'.$MP3name.'">'; }

echo '<B>'.$row["Name"].'</B> <SPAN CLASS="style2cfade">'.$WorkLength.'</SPAN><br>
    <span class="style2cfade">'.$row["artist"];

if($row["sample"] != '') { echo '( sample by: '.$row["sample"].')'; }
echo '</span>      </TD> 
<TD VALIGN="top" CLASS="style2cfade"  >'.str_replace(",","<br>",$row["city"]).'</TD>
</TR>';

} ?>

<TR>
 <TD COLSPAN="9"><IMG SRC="pictures/shim.gif" WIDTH="10" HEIGHT="5"></TD>
</TR> 
</TABLE></TD>
</TR>
</TABLE></TD></TR></TABLE>

</DIV> 
</BODY>


</HTML>
