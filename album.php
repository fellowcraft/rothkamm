<?php

//testing
date_default_timezone_set('America/Los_Angeles');
include('dbcon.php');
$rootpath = '/var/www/html/ROTHKAMM/';
$MP3path = "/var/www/html/MP3320/";
// ------------------------- dev/live -----------------------------------------
if($_SERVER["HTTP_HOST"] == "127.0.0.1") 
$MP3web = "http://127.0.0.1/MP3320/";
else 
$MP3web = "http://mp3.rothkamm.com/";
// ----------------------------------------------------------------------------
$RewriteQueryString = URLdecode($_SERVER['QUERY_STRING']);
$RewriteQueryString = str_replace("-"," ",$RewriteQueryString);
// --------------------------- Database ---------------------------------------
$Query = "
select * from Album
where Name COLLATE UTF8_GENERAL_CI like '".$RewriteQueryString."' 
LIMIT 1 
";
$general_Q = $mysqli->query($Query);
$general_R = $general_Q->fetch_assoc();

if(mysqli_num_rows($general_Q) < 1) exit("*** No general_R ***");


$Query = "
SELECT *
FROM Album
where Name like '".$general_R['Name']."'
";
$album_Q =  $mysqli->query($Query);
$album_R = $album_Q->fetch_assoc();

if(mysqli_num_rows($album_Q) < 1) exit("*** No album_R ***");


if($album_R['RndOrder'] > 0) $Att = "rand()"; else  $Att = "No";

$Query = "
select * from PART
where album like '%".trim($general_R['Name'])."%' ORDER BY ".$Att."
";
$tracks_Q  = $mysqli->query($Query);
/* 
Here, $tracks_Q->fetch_assoc() is used again in while() statments. 
Each call to this method advances the record pointer by 1, therefore:
mysqli_data_seek($tracks_Q,0) has to reset the pointer.
*/
if(mysqli_num_rows($tracks_Q) < 1) exit("*** No tracks_R ***");


$Query = "
select distinct city from PART
where album like '%".trim($general_R['Name'])."%'
";
$tracklocations_Q = $mysqli->query($Query);
$tracklocations_R = $tracklocations_Q->fetch_assoc();

function reset_tracklocations() 
{
global $tracklocations_Q;
mysqli_data_seek($tracklocations_Q,0);
}


$Query = "
select class,album from PART
where album like '%".$general_R['Name']."%'
";
$class_Q = $mysqli->query($Query);
$class_R = $class_Q->fetch_assoc();


$Query = "
select distinct instruments from PART
where album like '%".$general_R['Name']."%'
";
$instruments_Q = $mysqli->query($Query);


$Query = "
Select sum(length) as seconds from PART
where album like  '%".$general_R['Name']."%'
";
$TT_Q = $mysqli->query($Query);
$TT_R = $TT_Q->fetch_assoc();


$mysqli->close();
?>


<HTML>
<HEAD>

<TITLE><?php echo $album_R['Name']." (".$album_R['Composed'].") "
.$album_R['NameExt']." ".$album_R['CatalogNo']
." "." ROTHKAMM Album with Opus ";
while($row = $tracks_Q->fetch_assoc()) echo $row['ID']." "; 
?>
</TITLE>


<meta name="viewport" content="width=device-width, initial-scale=1.0">

<LINK HREF="css.css"  REL="stylesheet" TYPE="text/css">

<LINK TYPE="text/css" HREF="skin/jplayer.blue.monday.css" REL="stylesheet" />

<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="https://code.jquery.com/jquery-migrate-3.0.1.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jplayer/2.9.2/jplayer/jquery.jplayer.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jplayer/2.9.2/add-on/jplayer.playlist.min.js"></script> 

<!--
<SCRIPT TYPE="text/javascript" SRC="js/jquery.jplayer.min.js"></SCRIPT>
<SCRIPT TYPE="text/javascript" SRC="js/jplayer.playlist.min.js"></SCRIPT>
-->

<?php

echo'<SCRIPT TYPE="text/javascript">
//<![CDATA[
$(document).ready(function(){

new jPlayerPlaylist({
jPlayer: "#jquery_jplayer_1",
cssSelectorAncestor: "#jp_container_1" }, [
';


$Version = "-1";

function newestMP3($MP3_ID) 
{
Global $MP3web;
Global $MP3path;
Global $Version;
$newestMP3 = "";

for ($i=0; $i <= 99; $i++)
{
$MP3file = $MP3path.sprintf("%04d",$MP3_ID).sprintf("%02d",$i).'.mp3';
  
if(file_exists($MP3file))
{ 
$newestMP3 = $MP3web.sprintf("%04d",$MP3_ID).sprintf("%02d",$i).'.mp3'; 
$Version = sprintf("%02d",$i);
}
}
return $newestMP3;
}


$currentrow=1;

mysqli_data_seek($tracks_Q,0);

while($row = $tracks_Q->fetch_assoc())
{ 
$loc = "";
$newname = "";
$msg = "";

$locMP3  = newestMP3($row['ID']);

if ($locMP3 == "")  $msg = "[file missing]";

$minutes = intval($row['length'] / 60);
$seconds = intval($row['length'] % 60);

echo "{	title:'["
.$currentrow.
"] opus "
.$row['ID'].
"."
.$Version.
" ("
.$row['year'].
")<br/><i>"
.$minutes.
":"
.sprintf('%02d',$seconds).
"</i><br/><b>"
.str_replace(chr(10)," ",str_replace("'","`",$row['Name'])).
"</b><br/>".$msg."<br>',  mp3:'"
.$locMP3.
"',   }, 
";

++$currentrow;
}


echo '], {
playlistOptions: {  autoPlay: false },
loop: false,
swfPath: "http://www.jplayer.org/latest/js/Jplayer.swf",
supplied: "mp3",
volume: "100",
smoothPlayBar: true,
keyEnabled: false
});

$("#jplayer_inspector_1").jPlayerInspector({jPlayer:$("#jquery_jplayer_1")});

});

//]]>

</SCRIPT>
';
?> 


<?php include("favicon.php") ?>

<?php 
$cover_folder ="pictures/albumcover/";
$cover_image = $album_R["Artist"]."-".$album_R["Name"].".jpg";
$cover_image = str_replace(" ","%20",$cover_image);
$URLAlbum    = URLencode(trim($album_R["Name"]));
?>

<meta property="fb:app_id" content="367367553687587">
<meta property='og:title' content='<?php echo $album_R["Name"]." ".$album_R["Composed"]." ".$album_R["NameExt"]; ?> '> 
<meta property="og:type" content="music.album">
<meta property="og:site_name" content="ROTHKAMM">
<meta property="og:description" content='<?php echo $album_R["Artist"]." (sound artist) ".$album_R["VisualArt"]." (visual artist)"; ?> '>
<meta property="og:image" content="http://rothkamm.com/<?php echo $cover_folder.$cover_image; ?>">
<meta property="og:url" content="<?php echo "http://rothkamm.com/album.php?".$URLAlbum; ?>">


<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="ROTHKAMM">
<meta name="twitter:title" content='<?php echo $album_R["Artist"]." - ".$album_R["Name"]; ?>'>
<meta name="twitter:description" content="Album by <?php echo $album_R['Artist'].' - '.$album_R['Name'];?>">
<meta name="twitter:image" content="http://rothkamm.com/<?php echo $cover_folder.$cover_image;?>">

</HEAD>


<BODY>


<?php include("navbar.php"); ?>


<!-- Album Cover -->

<script>
if(window.innerWidth > window.innerHeight) { 
var ImageSize = 'HEIGHT="' + window.innerHeight 
} else { 
var ImageSize  = 'WIDTH="' + window.innerWidth 
}

document.write('<CENTER><IMG SRC="<?php echo $cover_folder.$cover_image ?>" BORDER=0 ' + ImageSize + '"></CENTER>' ) 
</script> 


<?php 
// -------------------------- PDF & MIDI Icons---------------------------------
$dirname = $rootpath."pdf";
$dir     = new DirectoryIterator($dirname);
$PDF     = 'false';
$MidiFile = "midi/rothkamm-".trim($album_R["Name"]).".mid";
// ----------- test -----------------------------------------------------------
foreach ($dir as $fileinfo) 
{        
if(strpos($fileinfo->getFilename(),$album_R["Name"])) $PDF="true";
}
// ----------- PDF in Dir -----------------------------------------------------
if($PDF !== 'false' or file_exists($rootpath.$MidiFile))
{
?>    
<TABLE ALIGN="CENTER">
<TR>
<TD VALIGN="TOP">
<?php
foreach ($dir as $fileinfo)
{        
if(strpos($fileinfo->getFilename(),$album_R["Name"])) 
{       
echo 
'<A HREF="pdf/'.$fileinfo->getFilename().
'" TARGET="_blank" ><IMG 
SRC="pictures/pdf-512.png" 
WIDTH="50" 
VSPACE="20" 
HSPACE="20" 
ALIGN="MIDDLE"></A>';
}
}


// ------------------------- MIDI ---------------------------------------------

if(file_exists($rootpath.$MidiFile)) 
{ 
?>
<A HREF='<?PHP
echo $MidiFile
?>' TARGET="_blank"><IMG 
SRC="pictures/midi-512.png" 
VSPACE="20" 
HSPACE="20" 
WIDTH="50" 
ALIGN="MIDDLE" ></A>
<?PHP 
} 


echo
'</TD>
</TR>
</TABLE>';
}
?>

<DIV  align="center" CLASS="style2c" > 


<!-- jplayer instance -->
<DIV ID="jquery_jplayer_1" CLASS="jp-jplayer"></DIV>
<DIV ID="jp_container_1" CLASS="jp-audio" ALIGN="CENTER" >
<DIV CLASS="jp-type-playlist" >
<DIV CLASS="jp-gui jp-interface" >

<UL CLASS="jp-controls" >
<LI><A HREF="javascript:;" CLASS="jp-play" TABINDEX="1" >play</A></LI>
<LI><A HREF="javascript:;" CLASS="jp-pause" TABINDEX="1" >pause</A></LI>
</UL>

<DIV CLASS="jp-progress"> 
<DIV CLASS="jp-seek-bar">
<DIV CLASS="jp-play-bar">
</DIV>
</DIV>
</DIV>

<DIV CLASS="jp-current-time"></DIV>
</DIV>

<DIV CLASS="jp-playlist"  >
<UL><LI></LI></UL>
</DIV>
		
<DIV CLASS="jp-no-solution">
<?php
mysqli_data_seek($tracks_Q,0);

while($row = $tracks_Q->fetch_assoc()) 
{ 
echo '<a href="'.newestMP3($row["ID"]).'">'
.$row["Name"].' opus '.$row["ID"].'.mp3</a><br>';
} 
?>
</DIV>
</DIV>
</DIV>


<?php
//-------------------------- CD -----------------------------------------------
if( file_exists('/var/www/html/ROTHKAMM/pictures/CD/'.$album_R["Name"].'.jpg')) 
{ 
echo '<IMG SRC="pictures/CD/'.$album_R["Name"].'.jpg" CLASS="pic" ALIGN="middle">';
} 
?>


<!-- Title  -->

<DIV ALIGN="center" VALIGN="middle" CLASS="style2cc" ><BR><BR><STRONG><?php echo $album_R["Artist"]." [ ".$album_R["Name"]; ?> ]</STRONG><BR><BR></DIV>


<?php
if( file_exists('/var/www/html/ROTHKAMM/linernotes/'.trim($general_R["Name"]).'.htm')) 
{ 
echo '<TABLE WIDTH="75%" ALIGN="CENTER">
<TR>
<TD  CLASS="style3r" ALIGN="justify">'; 
echo file_get_contents("linernotes/".trim($general_R["Name"]).".htm"); 
echo '</TD>
</TR>
</TABLE>';
}
?>

<?php
$linerFile = 'linernotes/'.trim($general_R["AlbumID"]).'.txt';

if( file_exists($rootpath.$linerFile))
{ 
?>
<TABLE WIDTH="75%" ALIGN="CENTER">
<TR>
<TD  CLASS="style3r" ALIGN="justify"><?php 
$TXT = file_get_contents('linernotes/'.trim($general_R["AlbumID"]).'.txt');
$TXT = str_replace("\n","<br>",$TXT);
$TXT = preg_replace("/\r\n|\r/","<br>",$TXT);
echo $TXT;
?></TD>
</TR>
</TABLE>
<?php
}
?>

<?php
$linerFile = 'linernotes/'.trim($general_R["AlbumID"]).'.htm';

if( file_exists($rootpath.$linerFile))
{ 
?>
<TABLE WIDTH="75%" ALIGN="CENTER">
<TR>
<TD  CLASS="style3r" ALIGN="justify"><?php 
echo file_get_contents('linernotes/'.trim($general_R["AlbumID"]).'.htm');
?></TD>
</TR>
</TABLE>
<?php
}
?>

<BR>
<BR>


<!-- _____________________________INFOBOX___________________________________ -->
<TABLE WIDTH="75%" 
       ALIGN="CENTER" 
       CELLPADDING="3" 
       CELLSPACING="0" 
       CLASS="style2bTrans"  
       BGCOLOR="#FFFFFF">

<?php 
$AlbumIcon = 'pictures/albumcover/small/'
.trim($album_R["Artist"]).'-'.trim($album_R["Name"]).'.jpg';
?>


<TR>
<TD VALIGN="TOP" BGCOLOR="#00FF00" CLASS="styleTiny" width="50%">&nbsp;</TD>
<TD BGCOLOR="#00FF00"> &nbsp</TD>
</TR>


<?php if ( trim($album_R["CatalogNo"]) !== '') 
{ 
?>   
<TR>
<TD ALIGN="RIGHT" VALIGN="TOP" CLASS="styleTiny">Catalog No:</TD>
<TD VALIGN="TOP"><?php echo trim($album_R["CatalogNo"])." (LN".$album_R["AlbumID"].")"; ?></TD>
</TR>
<?php 
} 
?>


<TR>
<TD ALIGN="RIGHT" VALIGN="TOP" CLASS="styleTiny"  >Title:</TD>
<TD VALIGN="TOP"  ><?php echo "<STRONG>".$album_R["Name"]."</STRONG>";
if (trim($album_R["NameExt"]) !== '') 
echo "<br><i>(".$album_R["NameExt"].")</i>"; 
?></TD>
</TR>


<TR>
<TD ALIGN="RIGHT" VALIGN="TOP" CLASS="styleTiny">Sound Artist:</TD>
<TD VALIGN="TOP"><?php echo "<STRONG>".$album_R["Artist"];
if (trim($album_R["Other"] != '')) 
echo "<br><i>".$album_R["Other"]."<br></i>"; 
?></TD>
</TR>


<?php if($album_R["VisualArt"] != '')
{ 
?>
<TR>
<TD ALIGN="RIGHT" VALIGN="TOP" CLASS="styleTiny">Visual Artist:</TD>
<TD VALIGN="TOP"><?php echo str_replace(",","<br>",$album_R["VisualArt"]) ?></TD>
</TR>
<?php 
} 
?>


<TR>
<TD ALIGN="RIGHT" VALIGN="TOP" CLASS="styleTiny">Label:</TD>
<TD VALIGN="TOP"><?php
$Label = $album_R["Label"];
if(strpos($Label,".")) echo '<a href="http://'.$Label.'">';                        ;
echo $album_R["Label"]; 
?></a></TD>
</TR>


<?php
//mysqli_data_seek($TT_Q,0);


if ($TT_R["seconds"] >= 3600) 
{
$TimeLength =  intval($TT_R["seconds"]/60/60%60,0) .":".
sprintf("%02d",intval($TT_R["seconds"]/60%60,0)).":".
sprintf("%02d",intval($TT_R["seconds"]%60   ,0)); 
} 
else 
{
$TimeLength =  intval($TT_R["seconds"]/60%60,0).":". 
sprintf("%02d",intval($TT_R["seconds"]%60,0));
}
?>


<TR>
<TD ALIGN="RIGHT" VALIGN="TOP" CLASS="styleTiny">Length:</TD>
<TD VALIGN="TOP"><?php echo $TimeLength." (".$TT_R["seconds"]."s)"; ?></TD>
</TR>


<?php if (trim($album_R["Composed"] != '')) 
{ 
?>
<TR>
<TD ALIGN="RIGHT" VALIGN="TOP" nowrap CLASS="styleTiny"  >Composed:</TD>
<TD VALIGN="TOP"  ><?PHP echo $album_R["Composed"]; ?></TD>
</TR>
<?php 
}
?>


<?php
reset_tracklocations();

if(mysqli_num_rows($tracklocations_Q) > 0) 
{
echo 
'<TR>
<TD ALIGN="RIGHT" VALIGN="TOP" nowrap CLASS="styleTiny"  >Location:</TD>
<TD VALIGN="TOP"  >'
;
while($row = $tracklocations_Q->fetch_assoc())
{
echo 
$row["city"]."<BR>";
} 
echo 
"</TD>
</TR>"
;
}
?>


<?PHP if($class_R["class"] != '') 
{ 
echo "<TR>";
//.mysqli_num_rows($class_Q).$class_R["class"];
$array = explode(",",$class_R["class"]);
?>
<TD ALIGN="RIGHT" VALIGN="TOP" CLASS="style2b">Class:</TD>
<TD VALIGN="TOP"><?php
foreach($array as $value)
{
echo $value."<br>";
}
?></TD>
</TR>
<?PHP 
}
?>



<?PHP if(mysqli_num_rows($instruments_Q) !=  0) 
{
/* ----------------------------------------------------------------------------- 
Each DB cell contains a comma seperated list of instruments that is NOT comma 
terminated: Create a string with comma seperated instruments.
----------------------------------------------------------------------------- */
$instrument_str = '';
while($row = $instruments_Q->fetch_array())
{
$instrument_str .= $row[0].","; 
}
/* ----------------------------------------------------------------------------- 
from: https://stackoverflow.com/questions/5134176
Take string, remove duplicates, (but here) return Array:
----------------------------------------------------------------------------- */
$instrument_str = array_keys(array_flip(explode(',', $instrument_str)));

echo "<TR>";
?>
<TD ALIGN="RIGHT" VALIGN="TOP" CLASS="styleTiny">Instruments:</TD>
<TD VALIGN="TOP"><?php
foreach($instrument_str as $value)
{
if(trim($value) != "") 
{
echo $value."<br>";
}
}
?></TD>
</TR>
<?PHP 
}
?>


<TR>
<TD ALIGN="RIGHT" VALIGN="TOP" nowrap CLASS="styleTiny"  >Release Date:</TD>
<TD VALIGN="TOP"  ><?php
echo date_format(date_create($album_R["Released"]),"m/d/Y"); 
?></TD>
</TR>


<?PHP if($album_R["Edition"] != "") 
{
?> 
<TR>
    <TD ALIGN="RIGHT" VALIGN="TOP" nowrap CLASS="styleTiny"  >Edition Size:</TD>
    <TD VALIGN="TOP"  ><?php echo $album_R["Edition"]; ?></TD>
</TR>
<?PHP 
}
?>


<TR>
<TD ALIGN="RIGHT" VALIGN="TOP" CLASS="styleTiny">Format:</TD>
<TD VALIGN="TOP"><?php echo str_replace(",","<br>",$album_R["Format"]); ?></TD>
</TR>


<?php if($album_R["Parts"] != '') 
{
?>
<TR>
<TD ALIGN="RIGHT" VALIGN="TOP" CLASS="styleTiny">Parts:</TD>
<TD VALIGN="TOP"><?php echo str_replace(",","<br>",$album_R["Parts"]); ?></TD>
 </TR>
<?PHP 
}
?>


<?php if($album_R["UPC"] != '') 
{
?>
<TR>
<TD ALIGN="RIGHT" VALIGN="TOP" CLASS="styleTiny"  >UPC:</TD>
<TD VALIGN="TOP"  ><?php echo $album_R["UPC"]; ?></TD>
</TR>
<?php 
} 


if($album_R["FileUnder"] != '') 
{
?>
<TR>
<TD ALIGN="RIGHT" VALIGN="TOP" CLASS="styleTiny" >File Under:</TD>
<TD VALIGN="TOP" ><?php echo $album_R["FileUnder"]; ?></TD>
</TR>
<?php 
}
?>


<?php 
// -------------------------- PDF ---------------------------------------------
$dirname = $rootpath."pdf";
$dir     = new DirectoryIterator($dirname);
$PDF     = 'false';
// ----------- test -----------------------------------------------------------
foreach ($dir as $fileinfo) 
{        
if(strpos($fileinfo->getFilename(),$album_R["Name"])) $PDF="true";
}
// ----------- PDF in Dir -----------------------------------------------------
if($PDF !== 'false')
{
?>    
<TR>
<TD  ALIGN="RIGHT" VALIGN="TOP" CLASS="styleTiny">PDF:</TD>
<TD VALIGN="TOP">
<?php
foreach ($dir as $fileinfo)
{        
if(strpos($fileinfo->getFilename(),$album_R["Name"])) 
{       
echo 
'<A HREF="pdf/'.$fileinfo->getFilename().
'" TARGET="_blank" >'
.$fileinfo->getFilename().'</A><BR>';
}
}
echo
'</TD>
</TR>';
}
?>


<?php
// ------------------------- MIDI ---------------------------------------------
$MidiFile = "midi/rothkamm-".trim($album_R["Name"]).".mid";

if(file_exists($rootpath.$MidiFile)) 
{ 
?>
<TR>
<TD  ALIGN="RIGHT" VALIGN="TOP" CLASS="styleTiny">MIDI:</STRONG> </TD>
<TD VALIGN="TOP"><A HREF='<?PHP
echo $MidiFile;
?>' TARGET="_blank"><?PHP 
echo $album_R["Name"];
?>.mid</TD>
</TR>
<?PHP 
} 
?>

</TABLE>

</TABLE>

</DIV>

</BODY>

</HTML>
