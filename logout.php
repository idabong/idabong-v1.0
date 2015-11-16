<?php $title = 'Đăng xuất'; 

include('includes/functions.php');

 if(isset($_SESSION['first_name'])) {
    // If user has logined already
    $_SESSION = array(); // Delete all SESSION
    session_destroy(); // Destroy session
    setcookie(session_name(),'', time()-36000); // Erase cookie on browser
    // Logout successful
	$message = alert_message(true, 'Bạn đã đăng xuất thành công.'); 
} 
?>

<!DOCTYPE html>
<html>

<head>
	<!-- Website Title & Description for Search Engine purposes -->
	<title>idabong.com - <?php echo (isset($title)) ? $title : ""; ?></title>
	<meta name="description" content="Tìm kiếm đội bóng" />
	<meta charset='UTF-8' />

	<!-- Add favicon to website -->
	<link href="css/images/favicon.ico" rel="shortcut icon" type="image/x-icon">

	<!--Mobile viewport optimized-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	
	<!-- Bootstrap css -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">

	<link rel="stylesheet" type="text/css" href="css/bootstrap-social.css">

	<!-- Font Awesome css -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

	<!-- Custom css -->
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
	
	
	<div class="container" id="main">
		<!-- Bootstrap navbar -->
		<div class="navbar navbar-default navbar-fixed-top">
			<!-- .Container is displayed different with .Container-fluid -->
			<div class="container">
				 <!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<!-- button is used as the toggle for collapsed navbar content -->
				    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#ToggleNavbar">
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>                        
				    </button>

				    <!-- Logo idabong.com -->
				    <a class="navbar-brand" href="index.php"><img src="css/images/logo-dabong.png" alt="idabong.com" /></a>
			    </div>

			     <!-- Collect the nav links, forms, and other content for toggling -->
			    <div class="collapse navbar-collapse" id="ToggleNavbar">

			    	<!-- SearchForm idabong.com -->
			    	<form class="navbar-form navbar-left" role="search">

			    		<div class="input-group">
			    			<input type="text" class="form-control" placeholder="Tìm kiếm đội bóng..." id="searchInput">
							<span class="input-group-btn">
								<button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
							</span>
					    </div><!-- /input-group -->
			    	</form><!-- END navbar SearchForm -->

			      	<!-- navbar Left -->
			    	<ul class="nav navbar-nav navbar-right">
			    	<?php 
			    		if (isset($_SESSION['user_level'])) {
			    			switch ($_SESSION['user_level']) {
			    				case 0: //Register user access
			    					echo "<li><a href='transactions.php'><span class='glyphicon glyphicon-fire'></span> Cáp Kèo</a></li>

			    						<li class='dropdown'>
										    <a href='#' class='dropdown-toggle' data-toggle='dropdown'>
										    <img src='css/images/default-avatar-18x18.jpg' class=''> {$_SESSION['first_name']}<b class='caret'></b></a>
										    <ul class='dropdown-menu'>
										        <li><a href='".BASE_URL."my-team.php'><i class='fa fa-futbol-o'></i> Đội bóng</a></li>
										        <li class=divider></li>
										        <li><a href='".BASE_URL."user-profile.php'><i class='fa fa-cog'></i> Cài đặt</a></li>
										        <li class=divider></li>
										        <li><a href='".BASE_URL."logout.php'><i class='fa fa-sign-out'></i> Đăng xuất</a></li>
										    </ul>
										</li>
			    					";
			    					break;

			    				case 2:
			    					echo "
			    						<li class='dropdown'>
										    <a href='#' class='dropdown-toggle' data-toggle='dropdown'>
										    <img src='' class='profile-image img-circle'> Username <b class='caret'></b></a>
										    <ul class='dropdown-menu'>
										        <li><a href='#'><i class='fa fa-cog'></i> Account</a></li>
										        <li class=divider></li>
										        <li><a href='#'><i class='fa fa-sign-out'></i> Sign-out</a></li>
										    </ul>
										</li>
			    					";
			    					break;
			    				default:
			    					echo "<li><a href='transactions.php'><span class='glyphicon glyphicon-fire'></span> Cáp Kèo</a></li>

		        						<li><a href='login.php'><span class='glyphicon glyphicon-user'></span> Đăng Nhập</a></li>";
			    					break;
			    			}
			    		}
			    	?>
			    	</ul><!-- END navbar Right -->

			    </div><!-- END nav Collapse -->

			</div><!-- END .containter-fluid -->

		</div><!--END navbar-->
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
