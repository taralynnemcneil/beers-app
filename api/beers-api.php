<?php
// connect to database
require('../db.php');

/* this would be used if you only wanted authorized personelle to access the app 
$access_token = $_GET['access_token'];
$sql = "SELECT * FROM clients WHERE access_token = :access_token";
*/

// execute the sql query to get the beer data, store the results
$sql = "SELECT * FROM beers";

if (!empty($_GET['name'])) {
    $name = $_GET['name'];
    $sql .= " WHERE name = :name";
}

$cmd=$conn->prepare($sql);

if (!empty($name)) {
    $cmd->bindParam(':name', $name, PDO::PARAM_STR);
}

$cmd->execute();
$beers = $cmd->fetchAll();

// convert php array to json
$json_obj = json_encode($beers);

// render all the json out
echo $json_obj;

// disconnect
$conn = null;
?>