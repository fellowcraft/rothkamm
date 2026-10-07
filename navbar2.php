<?PHP
// ------------------------- dev/live -----------------------------------------
if($_SERVER["HTTP_HOST"] == "127.0.0.1") 
$homeweb = "http://127.0.0.1/ROTHKAMM";
else 
$homeweb = "http://rothkamm.com";
// ----------------------------------------------------------------------------

include __DIR__ . '/../dbcon.php';

$Query = "
select ID, Status from PART
WHERE Status <> 0
";
$all_R          = $mysqli->query($Query);
$all_rowcount   = mysqli_num_rows($all_R);


$Query = "
SELECT  * from Album where active = 1 and FileUnder like '%solo piano%' 
";
$piano_R          = $mysqli->query($Query);
$piano_rowcount   = mysqli_num_rows($piano_R);


$Query = "
SELECT  * from Album where active = 1
";
$records_R          = $mysqli->query($Query);
$records_rowcount   = mysqli_num_rows($records_R);


$Query = "
SELECT  * from Album where active = 1
ORDER by RIGHT(Composed,4) DESC, Released DESC
";
$FluxCDcomposed_R           = $mysqli->query($Query);
$FluxCDcomposed_rowcount    = mysqli_num_rows($FluxCDcomposed_R);


$Query = "
select ID from reviews
";
$AllReviews_R = $mysqli->query($Query);
$AllReviews_rowcount = mysqli_num_rows($AllReviews_R);


$Query = "
SELECT AlbumID FROM Album where active = 1
";
$album_R = $mysqli->query($Query);
$album_rowcount = mysqli_num_rows($album_R);


$Query = "
SELECT ID  FROM PART
"; 
$track_R = $mysqli->query($Query);
$track_rowcount = mysqli_num_rows($track_R);


$mysqli->close();
?>        


<style>

.sidenav {
    display: none;
    height: 100%;
    width: 310px;
    position: fixed;
    z-index: 101;
    top: 0;
    left: 0;
    background-color: #00FF00;
    overflow-x: hidden;
/*   padding-top: 60px; */
}

/*
.sidenav a {
    padding: 8px 8px 8px 32px;
    text-decoration: none;
    font-size: 20px;
    color: #818181;
    display: block;
}
*/

.sidenav a:hover {
    color: #f1f1f1;
}

.sidenav .closebtn {
    position: absolute;
    top: 0;
    right: 10px;
    font-size: 36px;
    margin-left: 50px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
</style>

<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
<!--
  <a href="albums.php">Albums</a>
  <a href="works.php">Works</a>
  <a href="press.php">Press</a>
  <a href="biography.php">Biography</a>
-->
<TABLE ID="LayerE" WIDTH="280" CELLPADDING="10" CELLSPACING="10" >

<TR>
<TD ALIGN="right" 
valign="buttom" 
CLASS="style2"><span class="style6"><A HREF="albums.php"><?php echo $album_rowcount ?> ALBUMS</A></span></TD><!--<TD class="style6" nowrap ><A HREF="albums.php?text">TEXT</A> <IMG WIDTH="10" IGN="middle" SRC="pictures/triangle.png"> <A HREF="albums.php?image">IMAGE</A></TD>--> 
</TR>


<TR>
<TD ALIGN="right" 
valign="buttom" 
CLASS="style2"><A HREF="works.php"><span class="style6"><?php echo $track_rowcount ?> WORKS</span></A></TD>
</TR>


<TR>
<TD ALIGN="right" 
valign="buttom" 
CLASS="style2"><A HREF="press.php" ><span class="style6"><?php echo $AllReviews_rowcount ?> REVIEWS</span></A></TD>
</TR>


<TR>
<TD ALIGN="right" 
valign="buttom" 
CLASS="style2"><A HREF="biography.php" ><span class="style6">1 BIOGRAPHY</span></A></TD>
</TR>


<TR>
<TD ALIGN="center" 
    valign="buttom" 
    CLASS="style2"
    >
<a href="https://www.youtube.com/channel/UCxXM8NaAs5lF0g-ueiZwHqw"><IMG SRC="pictures/icons/icon-youtube-b.png" WIDTH="31" HSPACE=10 VSPACE=2></a>
<a href="https://www.facebook.com/rothkamm"><IMG SRC="pictures/icons/icon-facebook-b.png" WIDTH="31" HSPACE=10 VSPACE=2></a>
<a href="https://github.com/fellowcraft"><IMG SRC="pictures/icons/icon_GitHub-Mark.png" WIDTH="31" HSPACE=10 VSPACE=2></a>
<a href="https://twitter.com/rothkamm"><IMG SRC="pictures/icons/twitter.jpg" WIDTH="31" HSPACE=10 VSPACE=2></a>
<a href="https://play.google.com/store/music/artist?id=Avxn4ftlroneg4hradcznfcivlu"><IMG SRC="pictures/icons/icon_google_play.jpg"  WIDTH="31" HSPACE=10 VSPACE=2></a>
<a href="http://frankrothkamm.bandcamp.com"><IMG SRC="pictures/icons/bandcamp_60x60_black.jpg" WIDTH="31" HSPACE=10 VSPACE=2></a></TD>
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
	<label for="mce-EMAIL">Enter <b>Email</b> to receive new releases for free <i>NO Ads, NO Third Parties</i><!--<span class="asterisk">*</span>-->
</label>
	<input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
</div>
<div id="mce-responses" class="clear">
		<div class="response" id="mce-error-response" style="display:none"></div>
		<div class="response" id="mce-success-response" style="display:none"></div>
	</div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
    <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_50f5ee81acb6d99647f3b9269_d6e8a8620e" tabindex="-1" value=""></div>
<div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
<!-- <p align=center >ROTHKAMM &#176; 2520 Cimarron Street &#176; Los Angeles, CA 90018 &#176; USA <br>
<img src="pictures/Frank-Rothkamm-001.jpg" WIDTH=100 VSPACE=10 TITLE="Frank Rothkamm"><br>
frank [at] rothkamm [dot] com
</p> -->
</div>
</form>
</div>
<!--End mc_embed_signup-->
</TD>
</TR>


</TABLE>





</div>
<!--
<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; open</span>
-->
<script>
function openNav() {
    document.getElementById("mySidenav").style.display = "block";
}

function closeNav() {
    document.getElementById("mySidenav").style.display = "none";
}
</script>
     
     
<div id="navbar" ><span 
onclick="openNav()"><img src="pictures/menu.png" HEIGHT=50  TITLE="Start"></span></a>
</div>

