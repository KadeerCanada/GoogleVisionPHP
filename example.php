<?php
require_once ("const.php");
require_once ("gVision.php");

$imgURL = "http://home.cse.ust.hk/~hunkim/images/SungkimBio.png";
$response = doGoogleVisionRquest($imgURL, "FACE_DETECTION");
echo($response);

?>