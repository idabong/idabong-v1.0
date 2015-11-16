<?php 
$title = 'Kích hoạt tài khoản'; include 'includes/header.php';
include 'includes/mysqli_connect_local.php';
include 'includes/functions.php';
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
        $query = "SELECT active FROM user WHERE email = '{$email}'";
        $result = mysqli_query($db_connect, $query);
        confirm_query($result, $query);
        if(mysqli_num_rows($result) == 1) {
            list($active) = mysqli_fetch_array($result, MYSQLI_NUM);
            if(strlen($active) == 32) {
		        // Create an Activation Key
		        $active_code = md5(uniqid(rand(), true));
		        
		        
		        //Prepare 4 variables $from, $to, $subject, $body in order to send Activation mail
		    	$from = 'idabong.com@gmail.com';
		    	$to = $email;
		    	$subject = "Kích hoạt tài khoản tại idabong.com";
		        $body = 
		        "<p>Xin chào <strong>".$first_name."</strong></p>
		        <p>Cảm ơn bạn đã đăng ký làm thành viên tại <a href='idabong.com'>idabong.com</a></p>
		        <p>Để kích hoạt tài khoản, bạn vui lòng click vào nút dưới đây:</p> \n\n ";
		        $body .= "<button style='background: #009900'><a style='color: #ffffff; text-decoration: none; font-weight: bold' href=".BASE_URL."activate.php?email=".urlencode($email)."&hash={$active_code}>Kích hoạt</a></button>";
		        $body .="<div>-------------------</div>
		        		<p><i>Nhóm phát triển <a href='http://idabong.com' target='_blank'>idabong.com</a></i></p>
		        		<p><i>Email: hotro.idabong@gmail.com</i></p>
		        		<p><i>ĐT (+84) 971 499 715</i></p>";

		        //Create an activation link to test in Localhost
		        $active_local = BASE_URL."activate.php?email=".urlencode($email)."&hash={$active_code}";

		        //Send mail by custom php function
		        //write_file($active_local)
				if(//***LOCAL***//
					write_file($active_local)
					//send_mail($from, $to, $subject, $body)
				) 
				{ 
			        //if email is sent successfully
					//Update database
					$query1 = "UPDATE user SET active = '$active_code', expired = NOW() + INTERVAL 1 DAY
								WHERE  email = '{$email}' LIMIT 1";
					$result1 = mysqli_query($db_connect, $query1);
        			confirm_query($result1, $query1);
        			if(mysqli_affected_rows($db_connect) == 1) {
        				$message = alert_message(true, 'Vui lòng kiểm tra email và kích hoạt tài khoản để đăng nhập.');
						
        			} else {
        				$message = alert_message(false, 'Đã có lỗi hệ thống. Vui lòng thử lại sau.'); 
        			}				  
		        } 
		        else { 
		    	//if email was NOT sent
		        $message =  alert_message(false, 'Mã kích hoạt không gửi được. Vui lòng thử lại sau.');
		        }
		    //END if activation code is 32 characters.
            } else {
            	$message =  alert_message(false, 'Tài khoản đã kích hoạt.');
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
            <div class="panel-heading"><strong><i class="fa fa-envelope-o"></i> Gửi link kích hoạt</strong></div>
            <div class="panel-body">

            <form id="resendActivationCode" action="resend-activation-code.php" method="post">
				<!-- EMAIL -->
				<div class="form-group">
				<input type="email" class="form-control" name="email" id="email" placeholder="Email" maxlength="80" tabindex='1'/>
				</div>

		    	<!-- reCaptcha by Google -->
	       		<div id="reCaptcha" class="form-group g-recaptcha" data-sitekey="6LfVfhATAAAAAEq70OdwolfhL_Yvtp8RmZc7VYIe"></div>

		        <div class="form-group"><!-- Submit button -->
		    		<input type="submit" name="submit" class="btn btn-success btn-block" value="Gửi link kích hoạt" tabindex="2" />
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
