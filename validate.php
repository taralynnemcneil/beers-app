<?php ob_start();
include('header.php');

// variables
$username = $_POST['username'];
$password = hash('sha512', $_POST['password']);

// connect
require('db.php');

// set up sql query
$sql = "SELECT user_id FROM users WHERE username = :username AND password = :password";

// prepare
$cmd = $conn->prepare($sql);
$cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
$cmd->bindParam(':password', $password, PDO::PARAM_STR, 128);
$cmd->execute();
$users = $cmd->fetchAll();


$count = $cmd->rowCount();

// disconnect
$conn = null;

// validate
if ($count == 0) {
    echo 'Invalid Login';
    // exit();
}
else {
    session_start();
    foreach  ($users as $user) {

        $_SESSION['user_id'] = $user['user_id'];

        header('Location:beers.php');
    }
}

include('footer.php');
ob_flush(); ?>
