<?php

$sName = "localhost";
$username = "root";
$password = "";
$dbname = "knot-us";

$cxn = mysqli_connect($sName, $username, $password, $dbname);

if (!$cxn) {
    echo "Connection failed!";
}
