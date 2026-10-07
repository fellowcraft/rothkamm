<?php 

header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set('America/Los_Angeles');
include __DIR__ . '/../dbcon.php';
include __DIR__ . '/../mp3sign.php';
$rootpath = '/var/www/html/ROTHKAMM/';


$Query = "
select count(ID) as Parts from PART
WHERE Status <> 0
";
$all_Q = $mysqli->query($Query);

if (isset($_GET['opus'])) {
$Query = "
select * from PART
where ID =".substr($_GET['opus'],0,4);

} else {
$Query = "
select * from PART
ORDER BY year DESC, month DESC, day DESC, No DESC, ID DESC
";
}
//print($Query); 
$tracks_Q = $mysqli->query($Query);


$Query = "
select sum(length) as SumTotal from PART
WHERE Status <> 0
";
$Sum_Q = $mysqli->query($Query);


$mysqli->close();
?>

<HTML>

<HEAD>
<TITLE><?php 
$Q = $all_Q->fetch_assoc();
echo $Q["Parts"]." tracks Frank Rothkamm 1982-".date("Y"); 
?></TITLE>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<LINK HREF="css.css" REL="stylesheet" TYPE="text/css">
</HEAD>

<BODY>  

<?php include("navbar.php"); ?>

<DIV ID="Layer1">
<TABLE 
WIDTH="75%"
BORDER="0" 
ALIGN="center" 
CELLPADDING="5" 
CELLSPACING="5"  
BGCOLOR="FFFFFF">

<TR>
<TD 
COLSPAN="4" 
HEIGHT="16" 
VALIGN="middle" 
CLASS="style1" 
ALIGN="CENTER" 
><STRONG CLASS="styleTiny"><?php 
if(!isset($_GET['opus'])) { 
mysqli_data_seek($all_Q,0);
$Q = $all_Q->fetch_assoc();
echo $Q['Parts']." tracks - ";
$Q = $Sum_Q->fetch_assoc();
echo intval(($Q['SumTotal']/60)/60/24,0)  ." days "
.intval($Q['SumTotal']/60/60%24,0)    ." hours "
.intval($Q['SumTotal']/60%60,0)    ." minutes "
.sprintf('%02d', $Q["SumTotal"]%60)." seconds"; 
} ?></STRONG></TD>
</TR>

<TR>
<TD VALIGN="top" BGCOLOR="FFFFFF"  CLASS="style2b" ALIGN="RIGHT">album</TD>
<TD VALIGN="top" BGCOLOR="FFFFFF"  CLASS="style2b">date/city</TD>
<TD VALIGN="top" BGCOLOR="FFFFFF"  CLASS="style2b">opus</TD>
<TD VALIGN="top" BGCOLOR="FFFFFF"  CLASS="style2b">title/artist/instruments --MP3</TD>
<!--<TD VALIGN="top" BGCOLOR="FFFFFF"  CLASS="style2b">city</TD>-->
</TR>


<?php
//mysqli_data_seek($tracks_Q,0);
while($row = $tracks_Q->fetch_assoc()) 
{ 

$MP3s = "/var/www/html/MP3320/";
$MP3name = "";

for ($i=0; $i <= 99; $i++)
{
$MP3file = $MP3s.sprintf("%04d",$row["ID"]).sprintf("%02d",$i).'.mp3';
  
if(file_exists($MP3file))
{
$MP3name = mp3_signed_url(sprintf("%04d",$row["ID"]).sprintf("%02d",$i).'.mp3');
}
}

$WorkLength = intval($row["length"]/60,0).":".sprintf("%02d",$row["length"]%60);

if ($row["length"] > 3599)
{
$WorkLength = intval($row["length"]/3600).":". 
sprintf("%02d",($row["length"]%3600)/60).":". 
sprintf("%02d", $row["length"]%60);
}
?>


<TR>
<TD 
ALIGN="RIGHT"
VALIGN="top" 
CLASS="style2fade"
><?php if(trim($row["album"]) != '') 
{
$array = explode(",",$row["album"]);
foreach($array as $value)
{
$WebName = str_replace(" ","+",trim($value));
echo "<A HREF='album?".$WebName."'>".$value.
" <br />"; 
} 
}
echo '</TD>';


echo '<TD VALIGN="top" CLASS="style2cfade">';
if($row["month"] != '') 
{
echo $row["month"]."/".$row["day"]."/";
}
echo $row["year"].
'<br>'
.str_replace(",","<br>",$row["city"]).
'</TD>


<TD ALIGN="CENTER" VALIGN="middle" BGCOLOR="00FF00" 
><STRONG>'.$row["ID"].'</STRONG></TD>


<TD VALIGN="top" CLASS="style3c">';

if($MP3name != '') echo '<a href="'.$MP3name.'">'; 
// if($MP3name != '') echo '<a href="'.$MP3name.'">'; 

echo '<B>'
.$row["Name"]
.'</B> <SPAN CLASS="style2cfade">'
.$WorkLength
.'</SPAN><br><span class="style2cfade">'
.$row["artist"];

if($row["sample"] != '') echo ' (sample by: '.$row["sample"].')';
if($row["instruments"] != '') echo '<br><B>'.$row["instruments"].'</br>';

echo '</span></TD>' 

// <TD VALIGN="top" CLASS="style2cfade"  >'
//.str_replace(",","<br>",$row["city"])
//.'</TD>

.'</TR>';

} 
?>

</TR>
</TABLE>

</DIV> 


</BODY>


</HTML>
