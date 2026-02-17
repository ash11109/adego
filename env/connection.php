<?php
date_default_timezone_set("Asia/Calcutta");

// =================================================================================================

// ash

$server = "localhost";
$dbusername = "root";
$dbpassword = "";
$database = "srs_adego";

// nishi

// $server = "localhost:3308";
// $dbusername = "root";
// $dbpassword = "";
// $database = "srs_adego";

// =================================================================================================

$con = mysqli_connect($server, $dbusername , $dbpassword, $database);

if (!$con) {
    die("Error" . mysqli_connect_error());
}
