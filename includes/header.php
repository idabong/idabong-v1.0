<?php 
ini_set('session.use_only_cookies', true); session_start(); 
include('includes/mysqli_connect_local.php');
include('includes/functions.php');
// If user logined, fetch user's data
if(isset($_SESSION['uid'])) { 
	fetch_user($_SESSION['uid']);
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
										    <img src='css/images/default-avatar-20x20.png' class=''> {$_SESSION['first_name']}<b class='caret'></b></a>
										    <ul class='dropdown-menu'>
										        <li><a href='my-team.php'><i class='fa fa-futbol-o'></i> Đội bóng</a></li>
										        
										        <li><a href='user-profile.php'><i class='fa fa-cog'></i> Cài đặt</a></li>
										        
										        <li><a href='logout.php'><i class='fa fa-sign-out'></i> Đăng xuất</a></li>
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
			    		} else {
			    			echo "<li><a href='transactions.php'><span class='glyphicon glyphicon-fire'></span> Cáp Kèo</a></li>

		        				<li><a href='login.php'><span class='glyphicon glyphicon-user'></span> Đăng Nhập</a></li>";
			    		}
			    	?>
			    	</ul><!-- END navbar Right -->

			    </div><!-- END nav Collapse -->

			</div><!-- END .containter-fluid -->

		</div><!--END navbar-->
