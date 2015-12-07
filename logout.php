
<?php
// Initialize the session.
// If you are using session_name("something"), don't forget it now!
session_start();

include('includes/mysqli_connect_local.php');
include('includes/functions.php');

if(isset($_SESSION['uid'])) {
	$query = "UPDATE user SET remember_me = NULL WHERE uid = {$_SESSION['uid']}";
	$result = mysqli_query($db_connect, $query); confirm_query($result, $query);

    // If user has logined already
    $_SESSION = array(); // Unset all of the session variables.

    // If it's desired to kill the session, also delete the session cookie.
	// Note: This will destroy the session, and not just the session data!
	if (ini_get("session.use_cookies")) {
	    $params = session_get_cookie_params();
	    setcookie(session_name(), '', time() - 42000,
	        $params["path"], $params["domain"],
	        $params["secure"], $params["httponly"]
	    );

	    setcookie('rememberme', '', time() - 42000);

	}
	// Finally, destroy the session.
	session_destroy();

    // Logout successfully
    $message = alert_message(false, 'Bạn đã đăng xuất.');
} else {
	//If user has NOT logined
	redirect_to('login.php');
}

?>
<!DOCTYPE html>
<html>

<head>
	<!-- Website Title & Description for Search Engine purposes -->
	<title>idabong.com - Đăng xuất ?></title>
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
			    		<li><a href='transactions.php'><span class='glyphicon glyphicon-fire'></span> Cáp Kèo</a></li>
						<li><a href='login.php'><span class='glyphicon glyphicon-user'></span> Đăng Nhập</a></li>
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

			<!-- LOGIN FORM -->
			<div class="well">
				<?php //Alert login message
			 		if(!empty($message)) echo $message; 
				?>
			</div><!--END LOGIN FORM-->
		
		</div> <!--END MAIN COLLUMN -->
			
		<!-- right collumn -->
		<div class="col-sm-3">

		</div><!--end .col-sm-3 right collumn -->
	</div><!-- END MAIN ROW -->

	
</div><!--END #content-->
			
<?php include 'includes/footer.php';?>

<!--******** Additional Scrip ********-->

<!-- Custom JS -->
<script language="javascript" type="text/javascript" src="js/validate-forms.js"></script>

</body>

</html>
