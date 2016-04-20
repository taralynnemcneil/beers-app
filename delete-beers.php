<?php ob_start();

// auth
$pageTitle = 'Delete Beers';
require_once('header.php');
require_once('auth.php');

try {
// identity the record the user wants to delete
    $beer_id = null;
    $beer_id = $_GET['beer_id'];

    if (is_numeric($beer_id)) {
        // connecting to the database
        require('db.php');

        // get the logo if there is one from the beers table so we know which image to delete
        $sql = "SELECT logo FROM beers WHERE beer_id = :beer_id";
        $cmd = $conn->prepare($sql);
        $cmd->bindParam(':beer_id', $beer_id, PDO::PARAM_INT);
        $cmd->execute();
        $logo = $cmd->fetchColumn();

        // delete the image file if one in found in out query
        if (!empty($logo)) {
            unlink("images/$logo");
        }

        // set up SQL Delete command
        $sql = "DELETE FROM beers WHERE beer_id = :beer_id";

        // execute deletion
        $cmd = $conn->prepare($sql);
        $cmd->bindParam(':beer_id', $beer_id, PDO::PARAM_INT);
        $cmd->execute();

        // disconnect from db
        $conn = null;

        // redirect to updated beers page
        header('location:beers.php');
    }
}
catch (Exception $e) {
    // send ourselves the error
    mail('taralynnemcneil@gmail.com', 'Beer Store App Error'. $e);

    // redirect to error page
    header('location:error.php');
}

ob_flush(); ?>