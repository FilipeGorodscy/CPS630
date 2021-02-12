<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cps847";

    $connectionString = "mysql:host=localhost;dbname=cps847";
    $pdo = new mysqli($servername, $username, $password, $dbname);

if ($pdo->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  } 
  
$id = rand(0, 999999);

// sql to insert into table
    if (isset($_POST["addArtwork"])) {
        $response = '';
        try {
            $sql = "INSERT INTO art_work (id, genre, art_type, specification, painting, creation_year, museum)
            VALUES ('" . $id . "', '" . $_POST['genre'] . "', '" . $_POST['type'] . "', '" . $_POST['specification'] . "', '" . $_POST['painting'] . "', '" . $_POST['year'] . "', '" . $_POST['museum'] . "')";

            if ($pdo->query($sql)) {
                $response = "RECORD CREATED";
            }
            else {
                $response = "ERROR: " . $sql . "<br>" . $pdo->error;
            }

        }
        catch (Exception $e) {
            $response = "Error while inserting record: " . $e->getMessage();
        }

       echo $response;

    }
// sql to delete from table
elseif (isset($_POST["deleteArtwork"])) {
    try {
        $sql = "DELETE FROM art_work WHERE id='".$_POST['deleterecord']."'";

        if ($pdo->query($sql)) {
            echo "RECORD DELETED";
        }
        else {
            echo "RECORD NOT DELETED: " . $pdo->error ;
        }
    }
    catch (Exception $e) {
        echo $e->getMessage();
    }
}

// sql to select from table using checkboxes
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
        if ($_POST["paintingbox"] != NULL && $counter != 1) {
            $query=$_POST["painting"];
            $sql = $sql . " WHERE painting= '" . $query. "'" ;
            $counter = $counter +1;
            
        } elseif($_POST["paintingbox"] != NULL && $counter == 1){
            $query=$_POST["painting"];
            $sql = $sql . " AND painting= '" . $query. "'" ;
            
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

        echo "<p> Query: '" . $sql . "'</p>";

    try {
        $result = $pdo->query($sql);
    }
    catch (Exception $e) {
        echo "<h3> Error while retrieving record: " . $e->getMessage() . "</h3>";
    }
        
    if (!$result) {
        echo "<h3> Error retrieving results </h3>";
    }
    else{
        $row1 = $result->fetch_assoc();
        
				$colNames = array_keys($row1);

				echo "<table border='1'>";
				echo "<tr>";
				foreach ($colNames as $colName) {
					echo "<td>" . $colName . "</td>";
				}
				echo "</tr>";
				echo "<tr>";
				foreach ($row1 as $field) {
					echo "<td>" . $field . "</td>";
				}
				echo "</tr>";
				
				while($row = $result->fetch_assoc()) {
					echo "<tr>";
					
					foreach ($row as $field) {
						echo "<td>" . $field . "</td>";
					}
					echo "</tr>";
				}
				echo "</table>";
    }

            $result = $pdo->query($sql);
        
    }
    catch (Exception $e) {
        echo $e->getMessage();
    }
}

// sql to query from table manually
elseif (isset($_POST["selectTable"])) {
    $options = trim($_POST["options"]);
    $sql = "SELECT ";
    $sql = $sql . "*";
    $sql = $sql . " FROM art_work";

    if (isset($options) && $options != '') {
        $sql = $sql . " WHERE " . $options;
    }

    echo "<p> Query: '" . $sql . "'</p>";

    try {
        $result = $pdo->query($sql);
    }
    catch (Exception $e) {
        echo "<h3> Error while retrieving record: " . $e->getMessage() . "</h3>";
    }

    if (!$result) {
        echo "<h3> Error retrieving results </h3>";
    }
    else{
        $row1 = $result->fetch_assoc();
        
				$colNames = array_keys($row1);

				echo "<table border='1'>";
				echo "<tr>";
				foreach ($colNames as $colName) {
					echo "<td>" . $colName . "</td>";
				}
				echo "</tr>";
				echo "<tr>";
				foreach ($row1 as $field) {
					echo "<td>" . $field . "</td>";
				}
				echo "</tr>";

				
				while($row = $result->fetch_assoc()) {
					echo "<tr>";
					
					foreach ($row as $field) {
						echo "<td>" . $field . "</td>";
					}
					echo "</tr>";
				}
				echo "</table>";
    }
}

$pdo = null;
?>