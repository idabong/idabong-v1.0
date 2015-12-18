<?php session_start(); 
include('../includes/mysqli_connect_local.php');
include('../includes/functions.php');

//Check if user logged in?
is_logged_in();

if(isset($_GET['phone']) && preg_match('/^[0-9]{10,11}$/', $_GET['phone'])) {

    $phone = mysqli_real_escape_string($db_connect, trim($_GET['phone']));
    $query = "UPDATE user SET phone = '{$phone}' WHERE uid = {$_SESSION['uid']} LIMIT 1";
    $result = mysqli_query($db_connect, $query);
    if(mysqli_affected_rows($db_connect) == 1) {
        echo $phone;
    } else {
      echo 'NO';
    }

} else {
  echo 'NO';
}
?>