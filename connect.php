<?php
/*
 * set var
 */
$Host = "localhost";
$User = "root";
$Password = "";
$Database = "ther";

/*
 * connection mysql
 */
$sqlConnect = mysqli_connect($Host, $User, $Password, $Database) or die("Error conncetion mysql");
mysqli_query($sqlConnect,"SET NAMES UTF8");
?>
