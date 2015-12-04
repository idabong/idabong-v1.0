<?php 
include('includes/mysqli_connect_local.php');
include('includes/functions.php');

//Check if user logged in?
//is_logged_in();

if($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Form Handling
    //Errors flag
    $errors = array();
    //update flag
    $updates = array(); 
    //Validate fn
    if(!empty($_GET['fn'])) {
      if(preg_match('/^[a-z0-9A-Z_ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ \'-]{2,40}$/u', trim($_GET['fn']))) {
        $fn = mysqli_real_escape_string($db_connect, trim($_GET['fn']));
        $query = "UPDATE user SET fn = '{$fn}' WHERE uid = '{$_SESSION['uid']}' LIMIT 1";
        $result = mysqli_query($db_connect, $query); confirm_query($result, $query);
        if(mysqli_affected_rows($db_connect) != 1) {
            //NOT successfully.
           $errors[] = 'database';
        }
      } else {
        $errors[] = 'fn';
      }
    }
      
    //Validate ln
    if(!empty($_GET['ln'])) {
      if(preg_match('/^[a-z0-9A-Z_ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ \'-]{2,40}$/u', trim($_GET['ln']))) {
        $ln = mysqli_real_escape_string($db_connect, trim($_GET['ln']));
        $query = "UPDATE user SET ln = '{$ln}' WHERE uid = '{$_SESSION['uid']}' LIMIT 1";
        $result = mysqli_query($db_connect, $query); confirm_query($result, $query);
        if(mysqli_affected_rows($db_connect) != 1) {
            //NOT successfully.
           $errors[] = 'database';
        }
      } else {
        $errors[] = 'ln';  
      }
    } 

    //Validate Vietnam mobile phone number
    if(!empty($_GET['tel'])) {
      if(preg_match('/^0[19][0-9]{8,9}$/', trim($_GET['tel']))) {
        $phone = mysqli_real_escape_string($db_connect, trim($_GET['tel']));
        $query = "UPDATE user SET phone = '{$phone}' WHERE uid = '{$_SESSION['uid']}' LIMIT 1";
        $result = mysqli_query($db_connect, $query); confirm_query($result, $query);
         if(mysqli_affected_rows($db_connect) != 1) {
            //NOT successfully.
           $errors[] = 'database';
        }
      } else {
        $errors[] = 'phone';
      }
    } 

    echo (empty($errors)) ? TRUE : FALSE;
}// END main IF
?>