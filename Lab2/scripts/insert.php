<?php
//$servername = "localhost";
try {
    $username = "root";
    $password = "";
    //$dbname = "cps847";
    $connectionString = "mysql:host=localhost;dbname=cps847";
    $pdo = new PDO($connectionString, $username, $password);

}
// Create connection
//$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
/* if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} */
catch (PDOException $e) {
    die($e->getMessage());
}
$id = rand(0, 999999);

// sql to create table
$sql = "INSERT INTO art_work 
(id, genre, art_type, specification, painting, creation_year, museum)
VALUES 
($id, ?,?,?,?,?,?)";

$statement = $pdo->prepare($sql);
$statement->execute(array($_POST['genre'],$_POST['type'],$_POST['specification'],$_POST['painting'],$_POST['year'],$_POST['museum']));

$pdo = null;
?>