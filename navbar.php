<?PHP
// ------------------------- dev/live -----------------------------------------
if($_SERVER["HTTP_HOST"] == "127.0.0.1") 
$homeweb = "http://127.0.0.1/ROTHKAMM";
else 
$homeweb = "http://rothkamm.com";
// ----------------------------------------------------------------------------
?>


<div id="navbar" ><a 
href="<?php echo $homeweb ?>"><img src="pictures/FHRseal3D.png" HEIGHT=50  TITLE="The Royal Seal of ROTHKAMM"></a>
</div>


<script>
// When the user scrolls down 20px from the top of the document, slide down the navbar
// When the user scrolls to the top of the page, slide up the navbar (50px out of the top view)
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    document.getElementById("navbar").style.top = "0";
  } else {
    document.getElementById("navbar").style.top = "-100px";
  }
}
</script>


