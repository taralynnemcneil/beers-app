<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $pageTitle; ?></title>
    <meta content="text/html; charset=utf-8" http-equiv="content-type">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
</head>
<body>

<nav class="navbar navbar-default">

    <a href="default.php" title="COMP1006 Web App" class="navbar-brand"><i class="fa fa-beer fa-2"></i> COMP1006 Web App</a>

    <ul class="nav navbar-nav navbar-right">

        <?php
        if(!empty($_SESSION['user_id'])) {
            // private links
        echo'<li><a href="beer.php" title="Add">Add Beer</a></li>
            <li><a href="beers.php" title="Beer Listings">Beer Listings</a></li>
            <li><a href="gallery.php" title="Logo Gallery">Logo Gallery</a></li>
            <li><a href="logout.php" title="Logout">Logout</a></li>';

        } else {
            // public links
            echo '<li><a href="default.php?page_id=' . $row['page_id'] . '">' . $row['header'] . '</a></li>';
            echo '<li><a href="register.php" title="Register">Register</a></li>
            <li><a href="login.php" title="Login">Login</a></li>';
        } ?>

    </ul>
</nav>

<main class="container">