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
    if (isset($_POST["addArtwork"])) {

$sql = "INSERT INTO art_work 
(id, genre, art_type, specification, painting, creation_year, museum)
VALUES 
($id, ?,?,?,?,?,?)";

$statement = $pdo->prepare($sql);
$statement->execute(array($_POST['genre'],$_POST['type'],$_POST['specification'],$_POST['painting'],$_POST['year'],$_POST['museum']));

if($statement) {
    echo "Record inserted successfully!";
} else {
    echo "Error with insertion.";
}
    }
elseif (isset($_POST["deleteArtwork"])) {
    try {
        $sql = "DELETE FROM art_work WHERE id='".$_POST['deleterecord']."'";

        if ($pdo->query($sql)) {
            echo "RECORD DELETED";
        }
        else {
            echo "RECORD NOT DELETED: " . $conn->error ;
        }
    }
    catch (Exception $e) {
        echo $e->getMessage();
    }
} 
elseif (isset($_POST["queryArtwork"])) {
    try {
        if ($_POST['genrebox'] != NULL) {
            echo "Hello";
        }
        else {
            echo "Well";
        }
        $sql = "SELECT * FROM art_work WHERE
        genre LIKE 
        CASE
            WHEN '".$_POST['genrebox']."' != NULL
            THEN '".$_POST[$_POST['genrebox']]."'
            ELSE '%'
        END";

        #$sql = "SELECT * FROM art_work WHERE genre='".$_POST[$_POST['genrebox']]."'";


#{genre='".$_POST[$_POST['genrebox']]."'";
        if ($pdo->query($sql)) {
            echo $sql;
        }
        else {
            echo "RECORD NOT QUERIED: " . $conn->error ;
        }
    }
    catch (Exception $e) {
        echo $e->getMessage();
    }
}
/*else{
    try {
        if(!$_POST['painting']){
            $sql = "DELETE FROM art_work WHERE genre='".$_POST['genre']. "' AND art_type='" . $_POST['type'] . "' AND specification='" . $_POST['specification'] . "' AND creation_year='" . $_POST['year'] . "' AND museum='" . $_POST['museum'] . "'";
        }
        else{
            $sql = "DELETE FROM art_work WHERE genre='".$_POST['genre']. "' AND art_type='" . $_POST['type'] . "' AND specification='" . $_POST['specification'] . "' AND painting='" . $_POST['painting'] . "' AND creation_year='" . $_POST['year'] . "' AND museum='" . $_POST['museum'] . "'";
        }
        
       
        if ($pdo->query($sql)) {
            echo "RECORD DELETED";
        }
        else {
            echo "RECORD NOT DELETED: " . $conn->error ;
        }
    }
    catch (Exception $e) {
        echo $e->getMessage();
    }
 }*/




$pdo = null;
?>