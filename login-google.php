<?php
if ( isset($_POST["gName"]) && isset($_POST["gImage"]) && isset($_POST["gEmail"]) ) {

    include('includes/mysqli_connect_local.php');
    // Assign names to $_POST values and avoid rejections of SQL
    $gName = mysqli_real_escape_string($db_connect, $_POST['gName']);
    $gImage = mysqli_real_escape_string($db_connect, $_POST['gImage']);
    $gEmail = mysqli_real_escape_string($db_connect, $_POST['gEmail']);

    if ( !empty($gName) && !empty($gImage) && !empty($gEmail) ) {

        // Check if this is the firt time of Google Login
        $query = "SELECT uid FROM user WHERE email = '{$gEmail}'";
        $result = mysqli_query($db_connect, $query);
        if ( mysqli_num_rows($result) == 1 ) {
            // If not the first time, redirect to transactions.php page
            echo "transactions.php";

        } else {
            // For the first time of Google Login,
            // Insert new user to page own database idabong_database
            $gDefaultPassword = '123456';
            $query1 = "INSERT INTO user (first_name, email, password, avatar, registration_time)
                        VALUES ('{$gName}','{$gEmail}',SHA1('$gDefaultPassword'),'{$gImage}', NOW())";
            $result1 = mysqli_query($db_connect, $query1); //confirm_query($result1, $query1);

            // Redirect to user-profile.php page
            if (mysqli_affected_rows($db_connect) == 1) {
                echo "my-team.php";
            } else {
                //If insert database NOT successfully
                echo "<div class='alert-danger alert alert-dismissible' role='alert'> 
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                            <span class='glyphicon glyphicon-exclamation-sign'></span> Không thể tạo cơ sở dữ liệu cho thành viên mới. Vui lòng thử lại sau.
                        </div>";
            }
        }
    }
}
?>
