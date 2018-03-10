<?php

//header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set('America/Los_Angeles');
include('dbcon.php');
$rootpath = '/var/www/html/ROTHKAMM/';

$Query = "
select DateTime,
       ID,
       text,
       album,
       tagline,
       author,
       company
       from reviews 
UNION
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
$reviews_Q = $mysqli->query($Query);
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
<DIV ID="Layer1"><!-- CONTENT -->
<TABLE WIDTH="75%" BORDER="0" ALIGN="CENTER" CELLPADDING="1" CELLSPACING="0"  BGCOLOR="ffffff">

<?php 
while($row=$reviews_Q->fetch_assoc()) { 
?>
<TR>
<TD CLASS="style2" HEIGHT="20" COLSPAN="2"> <SPAN CLASS="style2cfade"><?php echo date_format(date_create($row["DateTime"]),"m/Y") ?></SPAN></TD>
</TR>

<?php 
if($row["album"] != '') {
$array = explode(",",$row['album']);
?>
<TR>
<TD CLASS="style3r" VALIGN="TOP" COLSPAN="2">
<?php foreach($array as $value) { echo 
'<a href="http://'.$_SERVER["HTTP_HOST"].'/album.php?'.urlencode($value).'">[+]</A>'.
'<SPAN CLASS="subT1"> '.$value.'</SPAN> '; 
}

//$taglineCON = iconv(mb_detect_encoding($row["tagline"], mb_detect_order(), true), "UTF-8", $row["tagline"]);

?>
<BR>
<A HREF='review.php?ID=<?PHP echo $row["ID"]."'>".$row["tagline"]."</A>"; ?>
<BR>
<?php echo $row["author"]." <EM>".strtoupper($row["company"])."</EM></TD>"; ?>
</TR>


<?php  } else { 

if(file_exists($rootpath."press/FluxRecords[".sprintf('%02d',$row['ID'])."].pdf")) {
$PDFlink = "press/FluxRecords[".$row['ID']."].pdf";
} else {
$PDFlink =  $row["ID"];
}
?>
<TR onMouseOver="this.style.backgroundColor='EBCD29'" onMouseOut='this.style.backgroundColor=""' >
<TD CLASS="style2cTrans"><A HREF="<?php echo $PDFlink; ?>"><IMG SRC="press/FluxRecords[<?php echo sprintf('%02d',$row['ID']); ?>].pdf.png"></A></TD>          
<TD VALIGN="middle" CLASS="tiny" ALIGN="center"><A HREF="<?php echo $PDFlink.'">'.$row["tagline"].'</A><BR>
  <BR>
  Flux Record PDF No. <EM>'.$row["ID"].'</EM>|'.date_format(date_create($row["DateTime"]),"m/d/Y").'</SPAN></TD>
</TR>'
;
}
} 
?>


</TABLE>
</DIV>
</BODY>
</HTML>
