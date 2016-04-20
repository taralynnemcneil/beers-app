<?php ob_start();

try {
// set title
    $pageTitle = 'Register';
    require('header.php');


// initialize an empty id variable
    $user_id = null;
    $username = null;
    $password = null;

//check if we have an user ID in the querystring
    if (is_numeric($_GET['user_id'])) {

        //if we do, store in a variable
        $user_id = $_GET['user_id'];

        // connecting to the database
        require('db.php');

        //select all the data for the selected beer
        $sql = "SELECT * FROM users WHERE user_id = :user_id";
        $cmd = $conn->prepare($sql);
        $cmd->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $cmd->execute();
        $result = $cmd->fetchAll();

        //disconnect
        $conn = null;

        //store each value from the database into a variable
        foreach ($result as $row) {
            $username = $row['username'];
            $password = $row['password'];
        }
    }
    ?>

    <h1>User Registration</h1>
    <form method="post" action="save-registration.php" class="form-horizontal">
        <div class="form-group">
            <label for="username" class="col-sm-2">Username:</label>
            <input name="username" required />
        </div>
        <div class="form-group">
            <label for="password" class="col-sm-2">Password:</label>
            <input type="password" name="password" required />
        </div>
        <div class="form-group">
            <label for="confirm" class="col-sm-2">Confirm Password:</label>
            <input type="password" name="confirm" required />
        </div>
        
        <div class="g-recaptcha" data-sitekey="6LeliB0TAAAAALAnGQOmoMSpMn7Q_u2pEg4OuXmQ"></div>
        
        <div>
            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>"/>
        </div>
        <div class="col-sm-offset-2">
            <input type="submit" value="Register" class="btn btn-primary" />
        </div>
    </form>
    
    <!-- linking the recaptcha js -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>    
        
        <?php

        require('footer.php');
    }
catch (Exception $e) {
        // send ourselves the error
        mail('taralynnemcneil@gmail.com', 'Beer Store App Error', $e);

        // redirect to error page
        header('location:error.php');
    }

	ob_flush(); ?>