<?php

header('Content-Type: text/html; charset=latin-1');
date_default_timezone_set('America/Los_Angeles');
include __DIR__ . '/../dbcon.php';
$rootpath = '/var/www/html/ROTHKAMM/';

$fi    = new FilesystemIterator('/var/www/html/ROTHKAMM/pdf', FilesystemIterator::SKIP_DOTS);
$PDFno = intval( (iterator_count($fi)-2) /2 );
?>

<HTML>

<HEAD>
<TITLE><?php echo $PDFno ?> PDFs ROTHKAMM</TITLE>
<LINK HREF="css.css" REL="stylesheet" TYPE="text/css">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

</HEAD>
<BODY>

<?php include("navbar.php"); ?>

<DIV ID="Layer1"><!-- CONTENT -->
<TABLE  
BORDER="0" 
ALIGN="center" 
CELLPADDING="0" 
CELLSPACING="5"  
BGCOLOR="FFFFFF"
>
<?php 

$dirname = $rootpath."pdf";
$dir = array_diff(scandir($dirname), array('..', '.'));

usort($dir, function($a, $b) { //from: gschoppe.com
// explode name a by spaces
$parts_a = explode('_', $a);
// remove the last name from the end of the array
$last_a  = array_pop($parts_a);
// and shove it on the front
array_unshift($parts_a, $last_a);
// then re-implode into a string
$a = implode('_', $parts_a);
// repeat the process for name b
$parts_b = explode('_', $b);
$last_b  = array_pop($parts_b);
array_unshift($parts_b, $last_b);
$b = implode('_', $parts_b);
// perform a case insensitive string comparison
return strcasecmp($b, $a);
});
?>

<?php
$x=0; 

foreach ($dir as $fn) 
{
if(strpos($fn,"jpg"))
{
$JPGtitle = substr($fn,0,strpos($fn,"_"));
$LinkName = substr($fn,0,strlen($fn)-3)."pdf"; 
$x += 1;
// every 3rd column a new row 
if(($x-1) % 3 == 0) echo "<TR>";
?>
<TD 
WIDTH="280"
ALIGN='CENTER' 
VALIGN='MIDDLE'
>
<A HREF="pdf/<?php echo $LinkName ?>"><IMG SRC="pdf/<?php echo $fn ?>" CLASS="Pic" ></A>          

<?php
echo 
"<span CLASS='styleTiny'><br><A 
HREF='pdf/" .$LinkName. "'>"
. str_replace("-"," ",trim(substr($JPGtitle,0,85))) .
" <br>("
.substr($fn,strlen($fn)-8,4).
")</A></span></TD>"; 


if(($x-1) % 3 == 2) echo "</TR>";

}
}

?>


</TABLE>
</DIV>
</BODY>
</HTML>
