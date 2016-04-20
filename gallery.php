<?php ob_start();

require_once('auth.php');

$pageTitle = 'Beer Logo Gallery';
require('header.php');

// connect to db and run query to get the logo
require_once ('db.php');
$sql = "SELECT beer_id, name, logo FROM beers WHERE logo IS NOT NULL ORDER BY name";
$cmd = $conn->prepare($sql);
$cmd->execute();
$results = $cmd->fetchAll();

echo '<h1>Beer\'s Logo Gallery</h1>';
foreach ($results as $row) {
    echo '<div class="col-md-4"><a href="beer.php?beer_id=' . $row['beer_id'] . '" class="thumbnail">
            <img src="images/' . $row['logo'] . '"title="Beer Logo" />
        </a></div>';
}

// disconnect
$conn = null;

// footer
require ('footer.php');
ob_flush(); ?>