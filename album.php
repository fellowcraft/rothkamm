<?php

//header('Content-Type: text/html; charset=iso-8859');
//header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set('America/Los_Angeles');
include('dbcon.php');
$rootpath = '/var/www/html/ROTHKAMM/';

$Query = "
select * from Album
where Name COLLATE UTF8_GENERAL_CI like '".URLdecode(trim($_SERVER['QUERY_STRING']))."' 
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

if ($album_R['RndOrder'] > 0) { $Att = "rand()"; }
else { $Att = "No"; }

$Query = "
select * from PART
where album like '%".trim($general_R['Name'])."%' ORDER BY ".$Att."
";
$tracks_Q  = $mysqli->query($Query);
//$tracks_R  = $tracks_Q->fetch_assoc();

if(mysqli_num_rows($tracks_Q) < 1) exit("*** No tracks_R ***");

$Query = "
select distinct city from PART
where album like '".trim($general_R['Name'])."'
";
$tracklocations_Q = $mysqli->query($Query);
$tracklocations_R = $tracklocations_Q->fetch_assoc();

function reset_tracklocations() {
global $tracklocations_Q;
mysqli_data_seek($tracklocations_Q,0);
}

$Query = "
select distinct instruments from PART
where album like '".$general_R['Name']."'
";
$instruments_Q = $mysqli->query($Query);
$instruments_R = $instruments_Q->fetch_assoc();


$Query = "
Select sum(length) as seconds from PART
where album like  '".$general_R['Name']."'
";
$TT_Q = $mysqli->query($Query);
$TT_R = $TT_Q->fetch_assoc();


$mysqli->close();
?>

<HTML>


<HEAD>
<?php include("favicon.php") ?>

<TITLE><?php echo $album_R['Name']." (".$album_R['Composed'].") "
.$album_R['NameExt']." ".$album_R['CatalogNo']
." "." ROTHKAMM Album with Opus ";
while($row = $tracks_Q->fetch_assoc()) { echo $row['ID']." "; }
?>
</TITLE>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<LINK HREF="css.css" REL="stylesheet" TYPE="text/css">

<LINK TYPE="text/css" HREF="skin/jplayer.blue.monday.css" REL="stylesheet" />

<script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>
<script src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

<SCRIPT TYPE="text/javascript" SRC="js/jquery.jplayer.min.js"></SCRIPT>
<SCRIPT TYPE="text/javascript" SRC="js/jplayer.playlist.min.js"></SCRIPT>


<?php

echo'<SCRIPT TYPE="text/javascript">
//<![CDATA[
$(document).ready(function(){

	new jPlayerPlaylist({
		jPlayer: "#jquery_jplayer_1",
		cssSelectorAncestor: "#jp_container_1"
	}, [
';

$FirstMP3 = '';
$currentrow=1;

$MP3s = "/var/www/html/MP3320/";

// ------------------------- dev/live -----------------------------------------
if($_SERVER["HTTP_HOST"] == "127.0.0.1") { 
$MP3web = "http://127.0.0.1/MP3320/";
} else {
$MP3web = "http://mp3.rothkamm.com/";
}
// ----------------------------------------------------------------------------

mysqli_data_seek($tracks_Q,0);

while($row = $tracks_Q->fetch_assoc()) { 

$loc = "";
$newname = "";
$msg = "";
$Version = "-1";

//echo $MP3s;

for ($i=0; $i <= 99; $i++) {

$MP3file = $MP3s.sprintf("%04d",$row["ID"]).sprintf("%02d",$i).'.mp3';
  
  if(file_exists($MP3file)) { 

$newname = $MP3web
.sprintf("%04d",$row["ID"]).sprintf("%02d",$i).'.mp3'; 

$Version = sprintf("%02d",$i);
  }
 }

$locMP3  = $newname; 

if ($locMP3 == "") { $msg = "[file missing]"; } 

//TrackName = REReplace(tracks.name,"(#chr(10)#|#chr(13)#)"," ","ALL");
//TrackName = REReplace(TrackName,"'","`","All");

$minutes = intval($row['length'] / 60);
$seconds = intval($row['length'] % 60);

echo "{	title:'<b>["
.$currentrow.
"] opus "
.$row['ID'].
"."
.$Version.
" ("
.$row['year'].
")</b/><br/><i>"
.$minutes.
":"
.sprintf('%02d',$seconds).
"</i><br/>"
.str_replace(chr(10)," ",str_replace("'","`",$row['Name'])).
"<br/>".$msg."<br>',  mp3:'"
.$locMP3.
"',   },";

if( $FirstMP3 == '' ) { $FirstMP3 = $locMP3; }

++$currentrow;
}

echo '], {
        playlistOptions: {  autoPlay: false },
		swfPath: "/js",
		supplied: "mp3",
        volume: "100",
		smoothPlayBar: true,
		keyEnabled: false,
	});

$("#jplayer_inspector_1").jPlayerInspector({jPlayer:$("#jquery_jplayer_1")});

});

//]]>

</SCRIPT>
';

include('favicon.php');

?> 

<meta property="fb:app_id" content="367367553687587">

<meta property='og:title' content='<?php echo $album_R["Name"]." ".$album_R["Composed"]." ".$album_R["NameExt"]; ?> '> 
<meta property="og:type" content="music.album">
<meta property="og:site_name" content="ROTHKAMM">
<meta property="og:description" content='<?php echo $album_R["Artist"]." (sound artist) ".$album_R["VisualArt"]." (visual artist)"; ?> '>

<?php $cover_image = "pictures/albumcover/".$album_R["Artist"]."-".$album_R["Name"].".jpg";


$URLAlbum = URLencode(trim($album_R["Name"]));

?>

<link rel="image_src"        href="http://rothkamm.com/<?php echo $cover_image; ?>">
<meta property="og:image" content="http://rothkamm.com/<?php echo $cover_image; ?>">
<meta property="og:url"   content="<?php echo "http://rothkamm.com/album.php?".$URLAlbum; ?>">

<!--
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="@chr174">
<meta name="twitter:title" content="<cfoutput>#album.Name# (#album.Composed#) #album.NameExt#</cfoutput>">
<meta name="twitter:description" content="Album by <cfoutput>#V#</cfoutput> (visual artist) ">
<meta name="twitter:image" content="http://<cfoutput>#cgi.server_name#</cfoutput>/pictures/albumcover/<cfoutput>#URLencodedFormat(album.Artist)#-#URLencodedFormat(album.Name)#</cfoutput>.jpg">
-->

</HEAD>

<BODY>
<!-- Album Cover -->
<script>
if(window.innerWidth >> window.innerHeight) { var Nheight = window.innerHeight } else { var Nheight = window.innerWidth }
</script>
<?php 

$ImageHTML = '<CENTER><IMG CLASS="picBig" SRC="'.$cover_image.'" BORDER="0" title="'.$album_R["Name"].' - '.$album_R["Artist"].' (sound artist) - '.$album_R["VisualArt"].' (visual artist)"></CENTER>';

echo "<script>document.write('$ImageHTML');
      </script>";

?>

<!-- jplayer instance -->
<DIV ID="jquery_jplayer_1" CLASS="jp-jplayer"></DIV>
<!--<A NAME="contentPlayer"> </A> -->
<DIV  align="center" CLASS="style2c"  >
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

while($row = $tracks_Q->fetch_assoc()) { 

echo $row["Name"].' opus '.$row["ID"].'<br>';

}
?>
</DIV>
</DIV>
</DIV>

<?php
//-------------------------- CD -----------------------------------------------
if( file_exists('/var/www/html/ROTHKAMM/pictures/CD/'.$album_R["Name"].'.jpg')) { 
echo '<IMG SRC="pictures/CD/'.$album_R["Name"].'.jpg" CLASS="pic" ALIGN="middle">';
} ?>

<!-- Title  -->

<DIV ALIGN="center" VALIGN="middle" CLASS="style2cfade" ><BR><BR><STRONG><?php echo $album_R["Artist"]." [ ".$album_R["Name"]; ?> ]</STRONG><BR><BR></DIV>


<?php
if( file_exists('/var/www/html/ROTHKAMM/linernotes/'.trim($general_R["Name"]).'.htm')) { 
echo '<TABLE WIDTH="75%" ALIGN="CENTER">
<TR>
<TD  CLASS="style3r" ALIGN="justify">'; 
readfile("linernotes/".trim($general_R["Name"]).".htm"); 
echo '</TD>
</TR>
</TABLE>';
}
?>

<?php
$linerFile = 'linernotes/'.trim($general_R["AlbumID"]).'.htm';

if( file_exists($rootpath.$linerFile)) { 

?>
<TABLE WIDTH="75%" ALIGN="CENTER">
<TR>
<TD  CLASS="style3r" ALIGN="justify"><?php 
//mb_convert_encoding(readfile('linernotes/'.trim($general_R["AlbumID"]).'.htm'),
//'utf-8','ISO-8859-1'
//readfile('linernotes/'.trim($general_R["AlbumID"]).'.htm')
$linerFile  = file_get_contents('linernotes/'.trim($general_R["AlbumID"]).'.htm');
//$linerFile2 = mb_convert_encoding($linerFile,'ISO-8859-1','utf-8');
echo $linerFile;
?></TD>
</TR>
</TABLE>
<?php
}
?>

<BR>
<BR>


<!-- infobox -->
<TABLE WIDTH="75%" ALIGN="CENTER" CELLPADDING="3" CELLSPACING="0" CLASS="style2bTrans"  BGCOLOR="#FFFFFF">
    
<TR>
      <TD VALIGN="TOP" BGCOLOR="#EBCD29" CLASS="styleTiny" width="50%">&nbsp;</TD>

<?php 
$AlbumIcon = 'pictures/albumcover/small/'
.trim($album_R["Artist"]).'-'.trim($album_R["Name"]).'.jpg';
?>


<TD BGCOLOR="#EBCD29"> &nbsp</TD>
</TR>
<?php if ( trim($album_R["CatalogNo"]) !== '') { ?>   
<TR>
      <TD ALIGN="RIGHT" VALIGN="TOP" CLASS="styleTiny">Catalog No:</TD>
      <TD VALIGN="TOP"><?php echo trim($album_R["CatalogNo"]).".".$album_R["AlbumID"]; ?></TD>
</TR>
<?php } ?>
<TR>
 <TD ALIGN="RIGHT" VALIGN="TOP" CLASS="styleTiny"  >Title:</TD>
 <TD VALIGN="TOP"  ><?php echo "<STRONG>".$album_R["Name"]."</STRONG>";
  if (trim($album_R["NameExt"]) !== '') { 
  echo "<br><i>(".$album_R["NameExt"].")</i>"; 
  } ?></TD>
</TR>


<TR>
<TD ALIGN="RIGHT" VALIGN="TOP" CLASS="styleTiny">Sound Artist:</TD>
<TD VALIGN="TOP"><?php echo "<STRONG>".$album_R["Artist"];
if (trim($album_R["Other"] != '')) { 
echo "<br><i>".$album_R["Other"]."<br></i>"; 
} ?></TD>
</TR>
<?php if($album_R["VisualArt"] != '') { ?>
<TR>
<TD ALIGN="RIGHT" VALIGN="TOP" CLASS="styleTiny">Visual Artist:</TD>
<TD VALIGN="TOP"><?php echo str_replace(",","<br>",$album_R["VisualArt"]) ?></TD>
</TR>
<?php } ?>

<TR>
<TD ALIGN="RIGHT" VALIGN="TOP" CLASS="styleTiny">Label:</TD>
<TD VALIGN="TOP"><?php
$Label = $album_R["Label"];
if(strpos($Label,".")) echo '<a href="http://'.$Label.'">';                        ;
echo $album_R["Label"]; ?></a></TD>
</TR>

<?php
if ($TT_R["seconds"] >= 3600) {

$TimeLength =  intval($TT_R["seconds"]/60/60%60,0) .":".
sprintf("%02d",intval($TT_R["seconds"]/60%60,0)).":".
sprintf("%02d",intval($TT_R["seconds"]%60   ,0)); 

} else {

$TimeLength =  intval($TT_R["seconds"]/60%60,0).":". 
sprintf("%02d",intval($TT_R["seconds"]%60,0));

}
?>
<TR>
    <TD ALIGN="RIGHT" VALIGN="TOP" CLASS="styleTiny">Length:</TD>
    <TD VALIGN="TOP"><?php echo $TimeLength." (".$TT_R["seconds"]."s)"; ?></TD>
</TR>
<?php if (trim($album_R["Composed"] != '')) { ?>
<TR>
    <TD ALIGN="RIGHT" VALIGN="TOP" nowrap CLASS="styleTiny"  >Composed:</TD>
    <TD VALIGN="TOP"  ><?PHP echo $album_R["Composed"]; ?></TD>
  </TR>
<?php } ?>
<TR>
    <TD ALIGN="RIGHT" VALIGN="TOP" nowrap CLASS="styleTiny"  >Location:</TD>
    <TD VALIGN="TOP"  ><?php

   // mysqli_data_seek($tracklocations_Q,0);
    reset_tracklocations();

    while($row = $tracklocations_Q->fetch_assoc()) {
    echo $row["city"]."<BR>";
    } ?></TD>
</TR>

<?PHP if(mysqli_num_rows($instruments_Q) > 0) { 
echo "<TR>";
$array = explode(",",$instruments_R["instruments"]);
?>
    <TD ALIGN="RIGHT" VALIGN="TOP" CLASS="styleTiny">Instruments:</TD>
    <TD VALIGN="TOP"><?php
    foreach($array as $value) {
    echo $value."<br>";
    } ?></TD>
</TR>
<?PHP } ?>
<TR>
    <TD ALIGN="RIGHT" VALIGN="TOP" nowrap CLASS="styleTiny"  >Release Date:</TD>
    <TD VALIGN="TOP"  ><?php
    echo date_format(date_create($album_R["Released"]),"m/d/Y"); ?></TD>
</TR>

<?PHP if($album_R["Edition"] != "") { ?> 
<TR>
    <TD ALIGN="RIGHT" VALIGN="TOP" nowrap CLASS="styleTiny"  >Edition Size:</TD>
    <TD VALIGN="TOP"  ><?php echo $album_R["Edition"]; ?></TD>
</TR>
<?PHP } ?>

<TR>
 <TD ALIGN="RIGHT" VALIGN="TOP" CLASS="styleTiny">Format:</TD>
 <TD VALIGN="TOP"><?php echo str_replace(",","<br>",$album_R["Format"]); ?></TD>
</TR>

<?php if($album_R["Parts"] != '') { ?>
<TR>
    <TD ALIGN="RIGHT" VALIGN="TOP" CLASS="styleTiny">Parts:</TD>
    <TD VALIGN="TOP"><?php echo str_replace(",","<br>",$album_R["Parts"]); ?></TD>
 </TR>
<?PHP } ?>
<?php if($album_R["UPC"] != '') { ?>
  <TR>
    <TD ALIGN="RIGHT" VALIGN="TOP" CLASS="styleTiny"  >UPC:</TD>
    <TD VALIGN="TOP"  ><?php echo $album_R["UPC"]; ?></TD>
  </TR>
<?php } 
if($album_R["FileUnder"] != '') { ?>
  <TR>
    <TD ALIGN="RIGHT" VALIGN="TOP" CLASS="styleTiny" >File Under:</TD>
    <TD VALIGN="TOP" ><?php echo $album_R["FileUnder"]; ?></TD>
  </TR>
<?php } ?>

<?php 
// -------------------------- PDF ---------------------------------------------
$dirname = $rootpath."pdf";
$dir     = new DirectoryIterator($dirname);
$PDF     = 'false';
// ----------- test -----------------------------------------------------------
foreach ($dir as $fileinfo) {        
if(strpos($fileinfo->getFilename(),$album_R["Name"])) $PDF="true";
//echo "PDF".$PDF;
}
// ----------- PDF in Dir -----------------------------------------------------
if($PDF !== 'false'){ ?>    
<TR>
<TD  ALIGN="RIGHT" VALIGN="TOP" CLASS="styleTiny">PDF:</STRONG> </TD>
<TD VALIGN="TOP">
<?php
foreach ($dir as $fileinfo) {        
if(strpos($fileinfo->getFilename(),$album_R["Name"])) {       
echo 
'<A HREF="pdf/'.$fileinfo->getFilename().
'"><IMG SRC="pictures/pdf-512.png" WIDTH="50" VALIGN="MIDDLE"> '
.$fileinfo->getFilename().'</A><BR> <BR>';
}
}
echo '</TD>
</TR>';
}
?>

<?php
// ------------------------- MIDI ---------------------------------------------
$MidiFile = "midi/rothkamm-".trim($album_R["Name"]).".mid";

if(file_exists($rootpath.$MidiFile)) { ?>
<TR>
<TD  ALIGN="RIGHT" VALIGN="TOP" CLASS="styleTiny">MIDI:</STRONG> </TD>
<TD VALIGN="TOP"><A HREF='<?PHP echo $MidiFile ?>' TARGET=""><IMG SRC="pictures/midi-512.png" WIDTH="50" VALIGN="MIDDLE" ><?PHP echo $album_R["Name"] ?></TD>
</TR>
<?PHP } ?>

</TABLE>

</TABLE>

</DIV>

</BODY>
</HTML>
