<?php

$user = "root";
$pass = " ";
$db = "test-db";

$db = new mysqli('localhost', $user, $pass, $db) or die("Unable to connect");

$Spec = $_POST('test');

$sql = "INSERT INTO testPerson (Spec) VALUES ('$Spec')";
echo "live";

?>
