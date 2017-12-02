<?php 
if ($results->num_rows > 0) {
    // output data of each row
    while($row = $results->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Name: " . $row["username"]. " " . $row["role"]. "<br>";
    }
} else {
    echo "0 results";
}
?>