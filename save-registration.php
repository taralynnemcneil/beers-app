<?php
$pageTitle = 'Saving your Registration...';
require_once('header.php');

// store the form inputs in a variable
$username = $_POST['username'];
$password = $_POST['password'];
$confirm = $_POST['confirm'];
$ok = true;

// validation
if (empty($username)) {
    echo 'Username is required<br />';
    $ok = false;
}

if (empty($password)) {
    echo 'Password is required<br />';
    $ok = false;
}

if ($password != $confirm) {
    echo 'Passwords must match<br />';
    $ok = false;
}

// check recaptcha
// set up curl request call to the recaptcha api
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);

// add the values to the curl request
$post_data = array();
$post_data['secret'] = "6LeliB0TAAAAAIEL90DJ4G63oc9xpy35VggtS3PD";
$post_data['response'] = $_POST['g-recaptcha-response'];
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);

// execute the curl request and store the results that google returns
$results = curl_exec($ch);
curl_close($ch);
$result_array = json_decode($results, true);
// echo $result_array['success'];

if($result_array['success'] != ture) {
    echo 'Are you human?';
    $ok = false;
}


// if the form is ok
if ($ok == true) {
    require_once('db.php'); // connect to db

    $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";

    // hash the password
    $hashedPassword = hash('sha512', $password);

    $cmd = $conn->prepare($sql);
    $cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
    $cmd->bindParam(':password', $hashedPassword, PDO::PARAM_STR, 128);
    $cmd->execute();

    // disconnect
    $conn = null;

    echo '<div class="jumbotron">Your registration has been saved. Click to <a href="login.php" title="Login"><i class="fa fa-sign-in"></i>&nbsp;Login</a></div>';

}

require('footer.php'); ?>