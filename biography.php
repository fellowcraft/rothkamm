<?php

date_default_timezone_set('America/Los_Angeles');
include('dbcon.php');
$rootpath = '/var/www/html/ROTHKAMM/';

$Query = "
SELECT * FROM PART
WHERE status <> 0
ORDER BY YEAR DESC, Month DESC, Day DESC
";
$allparts_Q = $mysqli->query($Query);
$allparts_R = $allparts_Q->fetch_assoc();

$Query = "
SELECT  * from Album
";
$FluxCD_Q = $mysqli->query($Query);
$FluxCD_R = $FluxCD_Q->fetch_assoc();

$Query = "
SELECT  * from Album
where solo = 1
";
$SoloAlbum_Q = $mysqli->query($Query);
$SoloAlbum_R = $SoloAlbum_Q->fetch_assoc();

$Query = "
select DateTime,
       ID,
       text,
       album,
       tagline,
       author,
       company
       from reviews 
";
$reviews_Q = $mysqli->query($Query);
$reviews_R = $reviews_Q->fetch_assoc();

$mysqli->close();
?>

<HTML>

<HEAD>
<TITLE>LIFE since 1965 ROTHKAMM</TITLE>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<?php include("favicon.php"); ?>

<LINK HREF="css.css" REL="stylesheet" TYPE="text/css">
</HEAD>
<?php $bio  = file_get_contents('bio.txt'); ?>

<BODY>


<?php include("navbar.php"); ?>

<div id="Layer1">
<TABLE WIDTH="80%" BORDER="0" ALIGN="center" CELLPADDING="8" CELLSPACING="0"  BGCOLOR="FFFFFF">

<?php

$bio = trim($bio);
$bio = str_replace(chr(10),'<br>',$bio);
$bio = str_replace('FluxCD',mysqli_num_rows($FluxCD_Q),$bio);
$bio = str_replace('SoloAlbum',mysqli_num_rows($SoloAlbum_Q),$bio);
$bio = str_replace('allparts',mysqli_num_rows($allparts_Q),$bio);
$bio = str_replace('allreviews',mysqli_num_rows($reviews_Q),$bio);

?>

<TD CLASS="style6"><?php echo $bio ?></TD>

</TR>
</TABLE>
</div>
</BODY>

</HTML>
