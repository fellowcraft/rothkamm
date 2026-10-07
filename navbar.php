<?PHP
// ------------------------- dev/live -----------------------------------------
if($_SERVER["HTTP_HOST"] == "127.0.0.1") 
$homeweb = "http://127.0.0.1/ROTHKAMM";
else 
$homeweb = "http://rothkamm.com";
// ----------------------------------------------------------------------------

// $fi    = new FilesystemIterator('/var/www/html/MP3320', FilesystemIterator::SKIP_DOTS);
// $MP3no = iterator_count($fi);

$fi    = new FilesystemIterator('/var/www/html/ROTHKAMM/pdf', FilesystemIterator::SKIP_DOTS);
$PDFno = intval( (iterator_count($fi)-2) /2 );

include __DIR__ . '/../dbcon.php';

$Query = "
select ID, Status from PART
WHERE Status <> 0
";
$all_R          = $mysqli->query($Query);
$all_rowcount   = mysqli_num_rows($all_R);

/*
$Query = "
SELECT  * from Album 
where active = 1 
and FileUnder like '%solo piano%'
and solo = 1
";
$piano_R        = $mysqli->query($Query);
$piano_rowcount = mysqli_num_rows($piano_R);


$Query = "
SELECT  * from Album 
where active = 1 
and FileUnder like '%csound%'
and solo = 1
";
$csound_R        = $mysqli->query($Query);
$csound_rowcount = mysqli_num_rows($csound_R);


$Query = "
SELECT  * from Album 
where active = 1 
and FileUnder like '%iformm%'
and solo = 1
";
$iformm_R        = $mysqli->query($Query);
$iformm_rowcount = mysqli_num_rows($iformm_R);



$Query = "
SELECT  * from Album 
where active = 1 
and FileUnder like '%electronic%'
and solo = 1
";
$electronic_R        = $mysqli->query($Query);
$electronic_rowcount =  mysqli_num_rows($electronic_R);
 */

$Query = "
SELECT  * from Album where active = 1 and solo <> 1 
";
$Albums_R          = $mysqli->query($Query);
$Albums_rowcount   = mysqli_num_rows($Albums_R);


$Query = "
SELECT  * from Album where active = 1 and solo <> 1 
";
$legacy_R          = $mysqli->query($Query);
$legacy_rowcount   = mysqli_num_rows($legacy_R);


$Query = "
SELECT  * from Album where active = 1;
";
$Albums_R          = $mysqli->query($Query);
$Albums_rowcount   = mysqli_num_rows($Albums_R);

/*
$Query = "
select ProjectID from news
where ProjectID > 0
";
$AllReviews_R = $mysqli->query($Query);
$AllReviews_rowcount = mysqli_num_rows($AllReviews_R);
*/

$Query = "
SELECT AlbumID FROM Album where active = 1 and solo = 1
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
    width: 285px;
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

.sidenav a:hover {
    color: #f1f1f1;
}

.sidenav .closebtn {
    position: absolute;
    top: 5;
    right: 10px;
    font-size: 36px;
    margin-left: 50px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}

*/

</style>

<div id="mySidenav" class="sidenav">

<span 
onclick="closeNav()"><img src="pictures/menu.png" HEIGHT=50  TITLE="Start"></span>

<TABLE ID="LayerE" WIDTH="280" CELLPADDING="3" CELLSPACING="9" WIDTH="90%" >
<!--
<TR>
<TD ALIGN="right" CELLSPACING="0" CELLPADDING="0" ><a href="javascript:void(0)" class="closebt" onclick="closeNav()"><img src="pictures/close.png" WIDTH="30" BORDER="0" ></a></TD>
</TR>
-->
<TR>
<TD ALIGN="right" 
valign="buttom" 
CLASS="style2"><?php echo $Albums_rowcount ?><A HREF="albums"><span class="style6"> ALBUMs</span></A></TD>
</TR>

<TR>
<TD ALIGN="right" 
valign="buttom" 
CLASS="style2"><?php echo $track_rowcount ?><A HREF="tracks"><span class="style6"> TRACKs</span></A></TD>
</TR>


<TR>
<TD ALIGN="right" 
valign="buttom" 
CLASS="style2"><?php echo $PDFno ?><A HREF="pdfs" ><span class="style6"> PDFs</span></A></TD>
</TR>

<TR>
<TD ALIGN="right" 
valign="buttom" 
CLASS="style2">1<A HREF="bio" ><span class="style6"> BIO</span></A></TD>
</TR>

<!--
<TR>
<TD ALIGN="right" 
valign="buttom" 
CLASS="style2"><A HREF="http://mp3.rothkamm.com"><span class="style6"><?php echo $MP3no ?> MP3s</span></A></TD>
</TR>
<TR>
<TD ALIGN="right" 
valign="buttom" 
CLASS="style2"><span class="style6"><A HREF="random">9 <i>RANDOM</i></A>&nbsp;</TD>
</TR>

<TR>
<TD ALIGN="right" 
valign="buttom" 
CLASS="style2"><span class="style6"><A HREF="latest">12 <i>LATEST</i></A>&nbsp;</TD>
</TR>

<TR>
<TD ALIGN="right" 
valign="buttom" 
CLASS="style2"><span class="style6"><A HREF="group"><?php echo $legacy_rowcount ?> <i>GROUP</i></A>&nbsp;</span></TD>
</TR>

<TR>
<TD ALIGN="right" 
valign="buttom" 
CLASS="style2"><span class="style6"><A HREF="solo"><?php echo $album_rowcount ?> <i>SOLO</i></A>&nbsp;</span></TD>
</TR>

<TR>
<TD ALIGN="right" 
valign="buttom" 
CLASS="style2"><span class="style6"><A HREF="piano"><?php echo $piano_rowcount ?> <i>PIANO</i></A>&nbsp;</span></TD>
</TR>


<TR>
<TD ALIGN="right" 
valign="buttom" 
CLASS="style2"><span class="style6"><A HREF="electronic"><?php echo $electronic_rowcount ?> <i>ELECTRONIC</i></A>&nbsp;</span></TD>
</TR>

<TR>
<TD ALIGN="right" 
valign="buttom" 
CLASS="style2"><span class="style6"><A HREF="iformm"><?php echo $iformm_rowcount ?> <i>IFORMM</i></A>&nbsp;</span></TD>
</TR>


<TR>
<TD ALIGN="right" 
valign="buttom" 
CLASS="style2"><span class="style6"><A HREF="csound"><?php echo $csound_rowcount ?> <i>CSOUND</i></A>&nbsp;</span></TD>
</TR>
-->

<TR>
<TD ALIGN="center" 
    valign="buttom" 
    CLASS="style2"
    >
<a href="https://www.youtube.com/channel/UCxXM8NaAs5lF0g-ueiZwHqw"><IMG SRC="pictures/icons/icon-youtube-b.png" WIDTH="25" HSPACE=9 VSPACE=2></a>
<a href="https://www.facebook.com/rothkamm"><IMG SRC="pictures/icons/icon-facebook-b.png" WIDTH="25" HSPACE=9 VSPACE=2></a>
<a href="https://github.com/fellowcraft"><IMG SRC="pictures/icons/icon_GitHub-Mark.png" WIDTH="25" HSPACE=9 VSPACE=2></a>
<!-- <a href="https://twitter.com/rothkamm"><IMG SRC="pictures/icons/twitter.jpg" WIDTH="25" HSPACE=9 VSPACE=2></a> -->
<!--<a href="https://play.google.com/store/music/artist?id=Avxn4ftlroneg4hradcznfcivlu"><IMG SRC="pictures/icons/icon_google_play.jpg"  WIDTH="25" HSPACE=5 VSPACE=2></a>-->
<a href="http://rothkamm.bandcamp.com"><IMG SRC="pictures/icons/bandcamp_60x60_black.jpg" WIDTH="25" HSPACE=9 VSPACE=2></a></TD>
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
	<label for="mce-EMAIL">Enter your <b>Email</b> to receive <i>new</i> releases:
</label>
	<input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
</div>
<div id="mce-responses" class="clear">
		<div class="response" id="mce-error-response" style="display:none"></div>
		<div class="response" id="mce-success-response" style="display:none"></div>
	</div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
    <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_50f5ee81acb6d99647f3b9269_d6e8a8620e" tabindex="-1" value=""></div>
<div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div></div></form></div><!--End mc_embed_signup--></TD>
</TR>

<TR>
<TD><p align=center ><script>document.write('Frank' + '@' + 'Rothkamm' + "." + "c" + "om");</script>
<BR> &#176; 5352 Village Grn &#176; <br>Los Angeles, CA 90016 &#176; USA <br><br>
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

// Close the panel when clicking anywhere outside it (and its toggle).
document.addEventListener("click", function (e) {
    var nav = document.getElementById("mySidenav");
    if (nav.style.display === "block"
        && !e.target.closest("#mySidenav")
        && !e.target.closest("#navbar")) {
        closeNav();
    }
});
</script>
     
     
<div id="navbar" ><span 
onclick="openNav()"><img src="pictures/menu.png" HEIGHT=50  TITLE="Start"></span></a>
</div>

