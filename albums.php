<?php

header('Content-Type: text/html; charset=iso-8859');
date_default_timezone_set('America/Los_Angeles');

include('dbcon.php');

$all = $mysqli->query("
select count(ID) as Parts from PART
");

$records = $mysqli->query("
SELECT  * from Album
");

$FluxCDcomposed = $mysqli->query("
SELECT  * from Album
ORDER by RIGHT(Composed,4) DESC, Released DESC 
");

$A = $mysqli->query("
select ID, Status from PART
WHERE Status <> 0
");


$mysqli->close();
?>

<HTML>

<HEAD>
<TITLE><?php echo mysqli_num_rows($records)." albums ".mysqli_num_rows($A)." works "
. "ROTHKAMM 1982-".Date("Y") ?> 
</TITLE>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<?php include("favicon.php"); ?>

<LINK HREF="css.css" REL="stylesheet" TYPE="text/css"></HEAD>

<BODY >

<?php include("navbar.php"); ?>

<DIV CLASS="Layer1" >

<TABLE  
        BORDER="0" 
        ALIGN="center" 
        CELLPADDING="0" 
        CELLSPACING="5"  
        BGCOLOR="FFFFFF"
        >

<?php $x=0; 

while($row = $FluxCDcomposed->fetch_assoc()) {

$x = $x + 1;

if(($x-1) % 3 == 0) echo "<TR>";

// $URLAlbum = str_replace($URLAlbum,'%20','+');
$URLArtist= URLencode($row["Artist"]);
$URLAlbum = URLencode($row["Name"]);

//$AlbumImage = "pictures/albumcover/small/".$URLArtist."-".$URLAlbum.".jpg"; 
$AlbumImage = "pictures/albumcover/small/".$row["Artist"]."-".$row["Name"].".jpg"; 
?>
<TD  WIDTH='33.33%'
ALIGN='CENTER' 
VALIGN='MIDDLE'
><A HREF='album.php?
<?php
echo $URLAlbum.
"'><IMG CLASS='pic' SRC='"
.$AlbumImage.
"' BORDER='0' TITLE='"
. $row["Artist"] . 
" "
. $row["Name"] .
" "
. $row["NameExt"] . 
" "
. $row["Composed"] . 
"'></A></TD>"; 

if(($x-1) % 3 == 2) echo "</TR>";

}

?>
</TABLE>
</DIV>
</BODY>
</HTML>
