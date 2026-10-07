<?php

header('Content-Type: text/html; charset=latin-1');
date_default_timezone_set('America/Los_Angeles');
include __DIR__ . '/../dbcon.php';
$rootpath = '/var/www/html/ROTHKAMM/';

$fi    = new FilesystemIterator('/var/www/html/ROTHKAMM/pdfs', FilesystemIterator::SKIP_DOTS);
$PDFno = iterator_count($fi);

$Query = "
select DateTime,
       ID,
       text,
       album,
       tagline,
       author,
       company
       from reviews 
ORDER by DateTime Desc
";
$reviews_Q = $mysqli->query($Query);

$Query = "
select ReleaseDate as 'DateTime',
       ID,
       body as 'text',    
       keywords as 'album',
       Headline as 'tagline',  
       ProjectID as 'author',
       links as 'company'
       from news 
where ProjectID > 0
ORDER by DateTime Desc
";
$Flux_Q = $mysqli->query($Query);

//$reviews_R = $reviews_Q->fetch_assoc();

$Query = "
select ID from reviews
";
$AllReviews_Q = $mysqli->query($Query);
$AllReviews_R = $AllReviews_Q->fetch_assoc();

$Query = "
select ID from reviews where Album like '%,%';
";
$dupAlbums_Q = $mysqli->query($Query);
$dupAlbums_R = $dupAlbums_Q->fetch_assoc();

$Query = "
SELECT distinct(Album) 
FROM reviews
";
$maxAlbums_Q = $mysqli->query($Query);
$maxAlbums_R = $maxAlbums_Q->fetch_assoc();


$ReviewedAlbums = mysqli_num_rows($maxAlbums_Q)-mysqli_num_rows($dupAlbums_Q);


$mysqli->close();
?>

<HTML>

<HEAD>
<TITLE><?php echo mysqli_num_rows($AllReviews_Q); ?> ROTHKAMM reviews </TITLE>
<LINK HREF="css.css" REL="stylesheet" TYPE="text/css">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

</HEAD>
<BODY>

<?php include("navbar.php"); ?>

<DIV ID="Layer1"><!-- CONTENT -->
<TABLE WIDTH="75%" BORDER="0" ALIGN="CENTER" CELLPADDING="1" CELLSPACING="0"  BGCOLOR="ffffff">

<!--
<TR>
<TD COLSPAN=2 
    ALIGN="center"
    BGCOLOR="00FF00"><BR>FLUX RECORDS PRESS RELEASES<BR>.</TD>
</TR>
-->

<?php 
$dirname = $rootpath."pdfs";
$dir     = new DirectoryIterator($dirname);
$JPG     = 'false';
// ----------- test -----------------------------------------------------------
foreach ($dir as $fileinfo) 
{        
if(strpos($fileinfo->getFilename(),$album_R["Name"])) $PDF="true";



?>

<TR >
<TD CLASS="style2cTrans"><A HREF="<?php echo $PDFlink; ?>"><IMG SRC="pdfs/<?php $fileinfo->getFilename(); ?>." WIDTH="200" ></A></TD>          
<TD VALIGN="middle" CLASS="tiny" ALIGN="center"><A HREF="<?php echo $PDFlink.'">'.$JPGtitle.'</A></TD>
</TR>'
;
}

?>


</TABLE>
</DIV>
</BODY>
</HTML>
