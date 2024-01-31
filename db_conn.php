<?php

$sName = "localhost";
$username = "root";
$password = "";
$dbname = "knotus_reserve";

$cxn = mysqli_connect($sName, $username, $password, $dbname);

if (!$cxn) {
    echo "Connection failed!";
}
