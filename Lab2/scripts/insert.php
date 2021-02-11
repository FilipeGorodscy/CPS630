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
    $sql = "Select * FROM art_work";
    $query="";
    $counter=0;
    try {
        if ($_POST['genrebox'] != NULL && $counter != 1) {
            $query=$_POST["genre"];
            $sql = $sql . " WHERE genre= '" . $query. "'" ;
            $counter = $counter +1;
            
        }
        if ($_POST["typebox"] != NULL && $counter != 1) {
            $query=$_POST["type"];
            $sql = $sql . " WHERE art_type= '" . $query. "'" ;
            $counter = $counter +1;
            
        } elseif($_POST["typebox"] != NULL && $counter == 1){
            $query=$_POST["type"];
            $sql = $sql . " AND art_type= '" . $query. "'" ;
            
        }
        if ($_POST["specificationbox"] != NULL && $counter != 1) {
            $query=$_POST["specification"];
            $sql = $sql . " WHERE specification= '" . $query. "'" ;
            $counter = $counter +1;
            
        } elseif($_POST["specificationbox"] != NULL && $counter == 1){
            $query=$_POST["specification"];
            $sql = $sql . " AND specification= '" . $query. "'" ;
            
        }
        if ($_POST["yearbox"] != NULL && $counter != 1) {
            $query=$_POST["year"];
            $sql = $sql . " WHERE creation_year= '" . $query. "'" ;
            $counter = $counter +1;
            
        } elseif($_POST["yearbox"] != NULL && $counter == 1){
            $query=$_POST["year"];
            $sql = $sql . " AND creation_year= '" . $query. "'" ;
            
        }
        if ($_POST["museumbox"] != NULL && $counter != 1) {
            $query=$_POST["museum"];
            $sql = $sql . " WHERE museum= '" . $query. "'" ;
            $counter = $counter +1;
            
        } elseif($_POST["museumbox"] != NULL && $counter == 1){
            $query=$_POST["museum"];
            $sql = $sql . " AND museum= '" . $query. "'" ;
            
        }

        echo $sql;

        #$sql = "SELECT * FROM art_work WHERE genre='".$_POST[$_POST['genrebox']]."'";


#{genre='".$_POST[$_POST['genrebox']]."'";
        
            $result = $pdo->query($sql);
            $row1 = $result->fetch_assoc();
            echo "hi";
            echo ( $row1["genre"] . $row1["art_type"]);
        
        
           // echo "RECORD NOT QUERIED: " . $conn->error ;
        
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

/* if ($_POST['genrebox'] != NULL) {
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
        END"; */


$pdo = null;
?>