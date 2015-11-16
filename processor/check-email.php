<?php include('../includes/mysqli_connect_local.php');?>
<?php include('../includes/functions.php');?>
<?php
    if(isset($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $email = mysqli_real_escape_string($db_connect, $_POST['email']);
        
        // Checking if the email from $_POST is available in database
        $query = "SELECT uid FROM user WHERE email = '{$email}'";
        $result = mysqli_query($db_connect, $query); confirm_query($result, $query);
        if(mysqli_num_rows($result) == 1) {
            echo 'false'; // not available
        } 
        else 
        {
        echo 'true'; // email avalialbe
        }
    } 
    else 
    {
    echo "false"; //invalid post var
    }
?>