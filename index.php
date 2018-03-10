<?php

//header('Content-Type: text/html; charset=iso-8859');

include('dbcon.php');

$Query          = "select ID, Status from PART
                   WHERE Status <> 0";
$all_R          = $mysqli->query($Query);
$all_rowcount   = mysqli_num_rows($all_R);

$Query              = "SELECT  * from Album";
$records_R          = $mysqli->query($Query);
$records_rowcount   = mysqli_num_rows($records_R);

date_default_timezone_set('America/Los_Angeles');

$Query   = "SELECT  * from Album
            ORDER by RIGHT(Composed,4) DESC, Released DESC ";
$FluxCDcomposed_R           = $mysqli->query($Query);
$FluxCDcomposed_rowcount    = mysqli_num_rows($FluxCDcomposed_R);

$Query   = "select ID from reviews";
$AllReviews_R = $mysqli->query($Query);
$AllReviews_rowcount = mysqli_num_rows($AllReviews_R);

$Query = "SELECT AlbumID FROM Album";
$album_R = $mysqli->query($Query);
$album_rowcount = mysqli_num_rows($album_R);

$Query = "SELECT ID  FROM PART"; 
$track_R = $mysqli->query($Query);
$track_rowcount = mysqli_num_rows($track_R);

$Query = "select DateTime,
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
ORDER by DateTime Desc";
$reviews_R = $mysqli->query($Query);
$reviews_rowcount = mysqli_num_rows($reviews_R);

$mysqli->close();
?>        

<HTML>

<HEAD>
<TITLE><?php echo $records_rowcount." albums ".$all_rowcount." works " . $AllReviews_rowcount." reviews 1 bio ROTHKAMM 1982-".Date("Y"); ?></TITLE>

<!--<meta http-equiv="Content-type" content="text/html; charset=utf-8" />-->

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<?php
//header('Content-type: text/plain; charset=utf-8');
include('favicon.php')
?>

<LINK HREF="css.css" REL="stylesheet" TYPE="text/css"></HEAD>

<BODY>
<TABLE ID="LayerE" WIDTH="50%" CELLPADDING="10" CELLSPACING="10" BGCOLOR="EBCD29" >
<TR>
<TD><br />
</TD> 
</TR>
<TR>
<TD ALIGN="right" 
    valign="buttom" 
    CLASS="style2"><A HREF="albums.php"><span class="style6"><?php echo $album_rowcount ?> ALBUMS</span></a></TD> 


</TR>
<TR>

<TD ALIGN="right" 
    valign="buttom" 
    CLASS="style2"><A HREF="works.php"><span class="style6"><?php echo $track_rowcount ?> WORKS</span></A></TD>

</TR>
<TR>

<TD ALIGN="right" 
    valign="buttom" 
    CLASS="style2"><A HREF="press.php" ><span class="style6"><?php echo $reviews_rowcount ?> REVIEWS</span></A></TD>

</TR>
<TR>

<TD ALIGN="right" 
    valign="buttom" 
    CLASS="style2"><A HREF="biography.php" ><span class="style6">1 BIOGRAPHY</span></A></TD>

</TR>
<TD ALIGN="right" 
    valign="buttom" 
    CLASS="style2">
<a href="https://www.youtube.com/channel/UCxXM8NaAs5lF0g-ueiZwHqw"><IMG SRC="pictures/icons/icon-youtube-b.png" WIDTH="31" HSPACE=10 VSPACE=2></a><a href="https://www.facebook.com/rothkamm"><IMG SRC="pictures/icons/icon-facebook-b.png" WIDTH="31" HSPACE=10 VSPACE=2></a><a href="https://github.com/fellowcraft/rheingold"><IMG SRC="pictures/icons/icon_GitHub-Mark.png" WIDTH="31" HSPACE=10 VSPACE=2></a><a href="https://twitter.com/rothkamm"><IMG SRC="pictures/icons/twitter.jpg" WIDTH="31" HSPACE=10 VSPACE=2></a><!--<a href="https://play.google.com/store/music/artist?id=Avxn4ftlroneg4hradcznfcivlu"><IMG SRC="pictures/icons/icon_google_play.jpg"  WIDTH="31" HSPACE=10 VSPACE=2></a>--><a href="http://frankrothkamm.bandcamp.com"><IMG SRC="pictures/icons/bandcamp_60x60_black.jpg" WIDTH="31" HSPACE=10 VSPACE=2></a></TD>
</TR>




<TR>
<TD ALIGN="right" 
    valign="buttom" 
    CLASS="style2">

<!-- Begin MailChimp Signup Form -->
<link href="//cdn-images.mailchimp.com/embedcode/classic-081711.css" rel="stylesheet" type="text/css">
<style type="text/css">
#mc_embed_signup{
background:#fff; 
clear:left; 
font:10px Helvetica,Arial,sans-serif; 
}
/* Add your own MailChimp form style overrides in your site stylesheet or in this style block.
	   We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
</style>
<div id="mc_embed_signup">
<form action="//lfus.us11.list-manage.com/subscribe/post?u=50f5ee81acb6d99647f3b9269&amp;id=d6e8a8620e" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
<div class="mc-field-group">
	<label for="mce-EMAIL">Email Address  <span class="asterisk">*</span>
</label>
	<input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
</div>
<div id="mce-responses" class="clear">
		<div class="response" id="mce-error-response" style="display:none"></div>
		<div class="response" id="mce-success-response" style="display:none"></div>
	</div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
    <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_50f5ee81acb6d99647f3b9269_d6e8a8620e" tabindex="-1" value=""></div>
<div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
<p align=center >FluxRecord &#176; 2520 Cimarron Street &#176; Los Angeles, CA 90018 &#176; USA<br>
<img src="pictures/FHRseal3D.png" WIDTH=100 VSPACE=10 TITLE="The Royal Seal of the FHR Editions">
</p>
</div>
</form>
</div>
<!--End mc_embed_signup-->
</TD>
</TR>

<TR>
<TD><br />
<br />
<br />
</TD> 
</TR>

</TABLE>
</BODY>
</HTML>
