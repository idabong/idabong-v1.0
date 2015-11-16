<?php $title = 'Đăng nhập'; include 'includes/header.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Form Handling
    $errors = array();

    //Validate Email
    if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $email = mysqli_real_escape_string($db_connect, $_POST['email']);
    } else {
        $errors[] = 'email';
    }
    
    //Validate password by regex
    if(preg_match('/^[\w\'.-]{6,30}$/', trim($_POST['password']))) {
        $password = mysqli_real_escape_string($db_connect, trim($_POST['password']));
    } else {
        $errors[] = 'password';
    }
    
	if(empty($errors)) {
		// Connect to database to get user's info
		$query = "SELECT uid, first_name, user_level FROM user WHERE email = '{$email}' AND password = SHA1('$password') AND COALESCE(active, '') = ''";
		$result = mysqli_query($db_connect, $query); confirm_query($result, $query);

		if(mysqli_num_rows($result) == 1) {
			//replace the current session id with a new one
			session_regenerate_id();
			//If login success, store user's info into SESSION
			list($uid, $first_name, $user_level) = mysqli_fetch_array($result, MYSQLI_NUM);
			$_SESSION['uid'] = $uid;
			$_SESSION['first_name'] = $first_name;
			$_SESSION['user_level'] = $user_level;
			                
			redirect_to('user-profile.php');
		} else {
			//Wrong account
		 	$message = alert_message(false, 'Email hoặc mật khẩu không đúng.'); 
		}
	} else {
		//Email or password syntax errors.
		$message = alert_message(false, 'Vui lòng kiểm tra thông tin.'); 
	}
}// END main IF
?>
<div id="content">
	
	<div class="row"> <!-- MAIN ROW -->
		<!-- Left Collumn -->
		<div class="col-sm-3">
		</div><!--end .col-sm-3 left collumn -->

		<div class="col-sm-6"><!-- MAIN COLLUMN-->

			<!-- REGISTER FORM -->
			<div class="panel panel-success">
				<?php //Alert login message
			 		if(!empty($message)) echo $message; 
				?>
				<div class="panel-body">
					<!-- ALERT STATUS -->
					<div id="alert" class="hidden alert">	
					</div>
					<!-- END STATUS -->

					<form id="login-form" action="login.php" method="post">

					<!-- EMAIL -->
					<div class="form-group">
						<input type="email" class="form-control" name="email" id="email" placeholder="Email" maxlength="80" tabindex='1'/>
					</div>

					<!-- PASSWORD -->
					<div class="form-group">
						<input type="password" class="form-control" id="password" name="password" placeholder="Mật khẩu" tabindex='2' />
					</div>

					<!-- KEEP USER LOGIN -->
					<div class="checkbox">
					    <label>
					      <input type="checkbox" tabindex='3'> Duy trì đăng nhập
					    </label>
					</div>

					<div class="form-group"><!-- Submit button -->
					  <button type="submit" name="submit" class="btn btn-success btn-block" tabindex='4'>Đăng Nhập</button>
					</div>
					</form>	
					<p class="text-primary"><a href="forgot-password.php" tabindex='5'>Quên mật khẩu?</a></p>
					<!--Social Login -->
					<a class="btn btn-block btn-social btn-facebook">
						<i class="fa fa-facebook"></i>Đăng Nhập Bằng Facebook
					</a>
					<a class="btn btn-block btn-social btn-google">
						<i class="fa fa-google"></i>Đăng Nhập Bằng Google
					</a>

					

				</div>
			</div><!--END REGISTER FORM-->
		
		</div> <!--end MAIN COLLUMN -->
			
		<!-- right collumn -->
		<div class="col-sm-3">

		</div><!--end .col-sm-3 right collumn -->
	</div><!-- end MAIN ROW -->

	
</div><!--END #content-->
			
<?php include 'includes/footer.php';?>

<!--******** Additional Scrip ********-->

<!-- Custom JS -->
<script language="javascript" type="text/javascript" src="js/validate-forms.js"></script>

</body>

</html>
