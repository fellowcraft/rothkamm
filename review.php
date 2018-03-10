<?php 
//header('Content-Type: text/html; charset=iso-8859-1');
date_default_timezone_set('America/Los_Angeles');
include('dbcon.php');

$Query = "
select * from reviews
where ID = ".$_GET['ID']
;
$review = $mysqli->query($Query);
$review_R = $review->fetch_assoc();

$Query = "
select * from links
where CompanyName like '%".$review_R['company']."%'"
;
$author = $mysqli->query($Query);

?>

<HTML>

<HEAD>
<TITLE>review of ROTHKAMM</TITLE>
</HEAD>
<BODY>

<div id="Layer1"><!-- CONTENT -->
<?php echo 
"Album: <a href='/album.php?".str_replace(' ','+',$review_R['album'])."'>"
.$review_R['album']."</a><br>
Author: ".$review_R['author']."<br>
Publication: ".$review_R['company']."<br>
Date: ".date_format(date_create($review_R['datetime']),'m/d/Y')."
<br><br>
".preg_replace('(Chr\(13\)Chr\(10\)| chr\(10\))','<br>',$review_R['text'])."
<br><br>
[ Permalink: http://".$_SERVER['HTTP_HOST']."?review.php?ID=".$review_R['ID']." ]"
; ?>
</div>
</BODY>
</HTML>
