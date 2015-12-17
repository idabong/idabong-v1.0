<?php $title = 'Đăng ký'; include 'includes/header.php';


if($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Form Handling
    $errors = array();
    //Validate first_name
    if(preg_match('/^[a-z0-9A-Z_ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ \'-]{2,40}$/u', trim($_POST['first_name']))) {
        $first_name = mysqli_real_escape_string($db_connect, trim($_POST['first_name']));
    } else {
        $errors[] = 'first_name';
    }

    //Validate Email
    if(isset($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $email = mysqli_real_escape_string($db_connect, trim($_POST['email']));
    } else {
        $errors[] = 'email';
    }
    
    //Validate password by regex
    if(preg_match('/^[\w\'.-]{6,30}$/', trim($_POST['password']))) {
        if($_POST['password'] == $_POST['confirm_password']) {
            // Save password if the confirmed password is right.
            $password = mysqli_real_escape_string($db_connect, trim($_POST['password']));
        } else {
            // If the confirmed password is wrong
            $errors[] = "password not match";
        }
    } else {
    	// If the password does not match the regex
        $errors[] = 'password';
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
        if(mysqli_num_rows($result) == 0) {
            // If the email have not registered yet.
            // Create an Activation Key
            $active_code = md5(uniqid(rand(), true));
            
            // Insert user's info into database
            $query1 = "INSERT INTO user (first_name, email, password, active, registration_time, expired)
                VALUES ('{$first_name}', '{$email}', SHA1('$password'), '{$active_code}', NOW(), NOW() + INTERVAL 1 DAY)";
            $result1 = mysqli_query($db_connect, $query1);
            confirm_query($result1, $query1);
            
            if(mysqli_affected_rows($db_connect) == 1) {
                // If insert successfully, send activation emmail
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
                		<p><i>ĐT1 (+84) 971 499 715 - Đại</i></p>
            			<p><i>ĐT2 (+84) 901 188 672 - Văn</i></p>";

                //Create an activation link to test in Localhost
               	//***LOCAL***//
                $active_local = BASE_URL."activate.php?email=".urlencode($email)."&hash={$active_code}";

                //Send mail by custom php function
				if(	//***LOCAL***//
					write_file($active_local)
					//send_mail($from, $to, $subject, $body)
				) 
				{ 
                //if email is sent successfully
                $message = alert_message(true, "<strong>Cám ơn!</strong> Vui lòng kiểm tra email và kích hoạt tài khoản để đăng nhập."); 
                } 
                else { 
            	//if email was NOT sent
                $message = alert_message(false, '<strong> Xin lỗi!</strong> Mã kích hoạt không gửi được. Vui lòng thử lại sau.');
                }
            } else {
	            //If insert database NOT successfully
	          	$message = alert_message(false, 'Đã có lỗi hệ thống. Vui lòng thử lại sau.');
            }
            
        } else {
            // Existed email on idabong.com system
            $message = alert_message(false, 'Email này đã đăng ký. Vui lòng thử email khác.'); 
        }
    } else {
        // If $errors is NOT empty
         $message = alert_message(false, 'Vui lòng kiểm tra thông tin.'); 
    }
}// END IF Post
?>

	<div id="content">
		
		<div class="row"> <!-- MAIN ROW -->
			<!-- Left Collumn -->
			<div class="col-sm-3">
			</div><!--end .col-sm-3 left collumn -->

			<div class="col-sm-6"><!-- MAIN COLLUMN-->
			
				<div class="carousel slide" id="myCarousel" data-ride="carousel">

					<!-- Indicators -->
					<ol class="carousel-indicators">
						<li class="active" data-slide-to="0" data-target="#myCarousel"></li>
						<li data-slide-to="1" data-target="#myCarousel"></li>
						<li data-slide-to="2" data-target="#myCarousel"></li>
					</ol>
				
					<!-- Wrapper for slides -->
					<div class="carousel-inner">
						<div class="item active" id="slide1">
							<img src="css/images/carousel-passion.png" class="img-responsive" alt="carousel-passion">
						</div><!-- end item -->
						
						<div class="item" id="slide2">
							<img src="css/images/carousel-team.png" class="img-responsive" alt="carousel-team">
						</div><!-- end item -->
						
						<div class="item" id="slide3">
							<img src="css/images/carousel-connect.png" class="img-responsive" alt="carousel-connect">
						</div><!-- end item -->
					</div><!-- carousel-inner -->
		
					<!-- Controls -->
					<a class="left carousel-control" data-slide="prev" href="#myCarousel"><span class="icon-prev"></span></a>
					<a class="right carousel-control" data-slide="next" href="#myCarousel"><span class="icon-next"></span></a>
			
				</div><!-- end myCarousel -->

				<?php //Alert $message
			 	if(!empty($message)) echo $message; 
				?>

				<!-- REGISTER FORM -->
				<div class="panel panel-success">

					<div class="panel-body">
						<!-- ALERT STATUS -->
						<div id="alert" class="hidden alert">	
						</div>
						<!-- END STATUS -->

						<form id="register-form" action="index.php" method="post">
							<!-- NAME -->
							<div class="form-group">
								<input type="text" class="form-control" name="first_name" id="first_name" placeholder="Tên hoặc nickname" maxlength="80" tabindex='1'/>
							</div>

							<!-- EMAIL -->
							<div class="form-group">
								<input type="email" class="form-control" name="email" id="email" placeholder="Email" maxlength="80" tabindex='1'/>
							</div>

							<!-- PASSWORD -->
							<div class="form-group">
								<input type="password" class="form-control" id="password" name="password" placeholder="Mật khẩu" tabindex='2' />
							</div>

							<!-- CONFIRM PASSOWD -->
							<div class="form-group">
								<input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Xác nhận mật khẩu" tabindex='3' />
							</div>

						  	<!-- reCaptcha by Google -->
							<div id="reCaptcha" class="form-group g-recaptcha" data-sitekey="6LfVfhATAAAAAEq70OdwolfhL_Yvtp8RmZc7VYIe"></div>

						  <div class="form-group"><!-- Submit button -->
						  	<button type="submit" name="submit" class="btn btn-success btn-block" tabindex='4'>Đăng Ký</button>
						  </div>

						</form>	
						  <!--Social Login -->
						<button id='facebookLogin' class="btn btn-block btn-social btn-facebook">
							<i class="fa fa-facebook"></i>Đăng ký bằng Facebook
						</button>
						<button class="btn btn-block btn-social btn-google">
							<i class="fa fa-google"></i>Đăng ký bằng Google
						</button>

						

					</div>
				</div><!--END REGISTER FORM-->
			
			</div> <!--end MAIN COLLUMN -->
				
			<!-- right collumn -->
			<div class="col-sm-3">

			</div><!--end .col-sm-3 right collumn -->
		</div><!-- end MAIN ROW -->

		
	</div><!--END #content-->
			
<?php include 'includes/footer.php';?>

<!--******** Additional Script ********-->
<!-- Vietnamese reCaptcha by Google-->
<script src='https://www.google.com/recaptcha/api.js?hl=vi'></script>

<!-- Custom JS -->
<script language="javascript" type="text/javascript" src="js/validate-forms.js"></script>
<script language="javascript" type="text/javascript" src="js/facebook-login.js"></script>

</body>

</html>
