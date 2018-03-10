<?php

$location = 'http://'.$_SERVER["HTTP_HOST"].'/album.php?'.$_SERVER["QUERY_STRING"];

header("Location: ".$location);
die();
?>
