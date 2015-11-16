<?php 
include('includes/mysqli_connect_local.php');
include('includes/functions.php');

//Handling form
if($_SERVER['REQUEST_METHOD'] == 'GET') {
// Create error flag
$errors = array();

//Validate Email
if(isset($_GET['email']) && filter_var($_GET['email'], FILTER_VALIDATE_EMAIL)) {
    $email = mysqli_real_escape_string($db_connect, $_GET['email']);
} else {
    $errors[] = 'email';
}

// Password validate
if(isset($_GET['newPassword']) && preg_match('/^\w{6,30}$/', $_GET['newPassword'])) {
    //Check if passwords are the same
    if($_GET['newPassword'] == $_GET['confirmNewPassword']) {
        $newPassword = mysqli_real_escape_string($db_connect, $_GET['newPassword']);
        
        //Update database
        $query = "UPDATE user SET password = SHA1('$newPassword'), retrieve_pass = NULL, expired = NULL WHERE email= '{$email}' LIMIT 1";
        $result = mysqli_query($db_connect, $query1); confirm_query($result1, $query1);
      
        if(mysqli_affected_rows($db_connect) == 1) {
            // If successfull
            echo true;
        } else {
            // If update NOT successfully
            echo false;
        } 
    else {
        // Passwords are NOT the same
        echo false
    } 
}//END main if
?>
