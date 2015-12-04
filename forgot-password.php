<?php 
$title = 'Quên mật khẩu'; include 'includes/header.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Form Handling
    $errors = array();

    //Validate Email
    if(isset($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $email = mysqli_real_escape_string($db_connect, trim($_POST['email']));
    } else {
        $errors[] = 'email';
    }
    
    // Handle reCaptcha by Google
    if(!check_reCaptcha()) {
        $errors[] = 'reCaptcha'; 
    }

    
    // If there is no error, connect to database
    if(empty($errors)) {
        
        // Checking if the email exist.
        $query = "SELECT uid FROM user WHERE email = '{$email}'";
        $result = mysqli_query($db_connect, $query);
        confirm_query($result, $query);
        if(mysqli_num_rows($result) == 1) {
            list($uid) = mysqli_fetch_array($result, MYSQLI_NUM);
            // Create an temporary password
            $temp_password = substr(md5(uniqid(rand(), true)), 4, 6);

            //Prepare 4 variables $from, $to, $subject, $body in order to send Activation mail
            $from = 'idabong.com@gmail.com';
            $to = $email;
            $subject = "Yêu cầu cấp lại mật khẩu tại idabong.com";
            $body = "<p>Xin chào!</p>
            <p>Mật khẩu tạm thời của bạn là: <strong style='color: red'>".$temp_password."</strong></p> 
            <p>Vui lòng <a href='http://idabong.com/login.php'>đăng nhập</a> để đổi mật khẩu.</p>
            <div>-------------------</div>
            <p><i>Nhóm phát triển <a href='http://idabong.com' target='_blank'>idabong.com</a></i></p>
            <p><i>Email: hotro.idabong@gmail.com</i></p>
            <p><i>ĐT1 (+84) 971 499 715 - Đại</i></p>
            <p><i>ĐT2 (+84) 901 188 672 - Văn</i></p>";

            //Create an retrieve to test in Localhost
            $retrieve_local = "Mật khẩu tạm thời của bạn là: ".$temp_password;

            //Update database, retrieve password will be expired after 24 hours.
            $query1 = "UPDATE user SET password = SHA1('$temp_password') WHERE uid = {$uid} LIMIT 1";
            $result1 = mysqli_query($db_connect, $query1);
            confirm_query($result1, $query1);
            if(mysqli_affected_rows($db_connect) == 1) {
                //Send mail by custom php function
                //write_file($retrieve_pass_local)
                if(//***LOCAL***//
                    write_file($retrieve_local)
                    //send_mail($from, $to, $subject, $body)
                ) 
                { 
                    //if email is sent successfully  
                   $message = alert_message(true, 'Vui lòng kiểm tra email để lấy lại mật khẩu.'); 
                } else { 
                //if email was NOT sent
                    $message = alert_message(false, 'Email không gửi được. Vui lòng thử lại sau.');
                }
            } else { //Database problem
              $message = alert_message(false, 'Đã có lỗi hệ thống. Vui lòng thử lại sau.');
            }      
            
        } else {
            // email is NOT exist on idabong.com system
            $message =  alert_message(false, "Email chưa <a href='index.php'>đăng ký</a>.");
        }
    } else {
        // If $errors is NOT empty
        $message =  alert_message(false, 'Vui lòng kiểm tra thông tin.');
    }
}// END main IF
?>
<div id="content">
    
    <div class="row"> <!-- MAIN ROW -->
        <!-- Left Collumn -->
        <div class="col-sm-3">
        </div><!--end .col-sm-3 left collumn -->

        <div class="col-sm-6"><!-- MAIN COLLUMN-->
            <?php //Alert $message
                if(!empty($message)) echo $message; 
            ?>
            <div class="panel panel-success">
            <div class="panel-heading"><strong><i class="fa fa-key fa-fw"></i> Quên mật khẩu</strong></div>
            <div class="panel-body">

            <form id="forgotPassword" action="forgot-password.php" method="post">
                <!-- EMAIL -->
                <div class="form-group">
                <input type="email" class="form-control" name="email" id="email" placeholder="Email" maxlength="80" tabindex='1'/>
                </div>

                <!-- reCaptcha by Google -->
                <div id="reCaptcha" class="form-group g-recaptcha" data-sitekey="6LfVfhATAAAAAEq70OdwolfhL_Yvtp8RmZc7VYIe"></div>

                <div class="form-group"><!-- Submit button -->
                    <input type="submit" name="submit" class="btn btn-success btn-block" value="Cấp lại mật khẩu" tabindex="2" />
                </div>
            </form>
            
            </div><!--end .panel-body -->
        </div><!--end .panel -->
        
        </div> <!--end MAIN COLLUMN -->
            
        <!-- right collumn -->
        <div class="col-sm-3">
        </div><!--end .col-sm-3 right collumn -->

    </div><!-- end MAIN ROW -->
</div><!--end content-->

<?php include 'includes/footer.php';?>

<!--******** Additional Scrip ********-->
<!-- Vietnamese reCaptcha by Google-->
<script src='https://www.google.com/recaptcha/api.js?hl=vi'></script>

<!-- Custom JS -->
<script language="javascript" type="text/javascript" src="js/validate-forms.js"></script>

</body>

</html>
