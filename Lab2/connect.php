<?php

$user = "root";
$pass = " ";
$db = "testnew";

$db = new mysqli('localhost', $user, $pass, $db) or die("Unable to connect");

echo "nice!";

?>
