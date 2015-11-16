<?php $title = 'Cấp lại mật khẩu'; include 'includes/header.php';?>
<?php include('includes/mysqli_connect_local.php');?>
<?php include('includes/functions.php');?>

<div id="content">
	
<div class="row"> <!-- MAIN ROW -->
	<!-- Left Collumn -->
	<div class="col-sm-3">
	</div><!--end .col-sm-3 left collumn -->

	<div class="col-sm-6"><!-- MAIN COLLUMN-->
		<!-- Ajax status-->
		<div id="ajaxLoader" class='alert-info alert hidden' role='alert'>
		    <i class="fa fa-refresh fa-spin"></i> Vui lòng đợi hệ thống xử lý...
		</div>

		<!-- Change password status-->
		<span id="status"></span>

		<div class="panel panel-success"><!-- Form Change Password-->
		<div class="panel-heading"><strong><i class="fa fa-key fa-fw"></i> Thay đổi mật khẩu</strong></div>
		<div class="panel-body">
		<?php 
	        if(isset($_GET['email'], $_GET['hash']) && filter_var($_GET['email'], FILTER_VALIDATE_EMAIL) && strlen($_GET['hash']) == 32) {
	            // Store $_GET
	            $email = mysqli_real_escape_string($db_connect, $_GET['email']);
	            $hash = mysqli_real_escape_string($db_connect, $_GET['hash']);
	            
	            //Check if the retrieve password link is expired.
	            $query = "SELECT expired FROM user WHERE email = '{$email}' AND retrieve_pass = '{$hash}'";
	            $result = mysqli_query($db_connect, $query); confirm_query($result, $query);
	            if(mysqli_num_rows($result) == 1) {
	                //Save expired timestamp into variable
	                list($expired) = mysqli_fetch_array($result, MYSQLI_NUM);
	                //Parse into a Unix timestamp
	                $expired_time = strtotime($expired);
	                //Period of time that the Link is still valid. (in second)
	                $period = $expired_time - time();
	                if($period < 0) {
	                    //Expired link, retrieve password will be expired after 24 hours.
	                    echo $message = alert_message(false, "Link đã hết hạn! Trở lại trang <a href='retrieve-password.php'>quên mật khẩu?</a>");   
	                } else {
	                   echo "<form id='retrievePassword'>
								<div class='form-group'>
								<input type='password' class='form-control' id='newPassword' name='newPassword' placeholder='Mật khẩu mới' tabindex='1' />
								</div>

								<div class='form-group'>
								<input type='password' class='form-control' id='confirmNewPassword' name='confirmNewPassword' placeholder='Xác nhận mật khẩu mới' tabindex='2' />
								</div>

								<div class='form-group'>
								<input type='button' id='button' name='button' class='btn btn-success btn-block' value='Cập nhật' tabindex='3' />
								</div>
							</form>";
	                }//END if period < 0
	            } else {
	                 echo $message = alert_message(false, 'Đã có lỗi xảy ra. Vui lòng kiểm tra link.');    
	            }//END if the activation link is expired
	            
	        } else {
	            // If activate link is wrong, redirect to home page
	            redirect_to();
	        }
		?>
			

		</div><!-- End . panel-body -->
	</div><!--END Form Change Password-->

	</div> <!--end MAIN COLLUMN -->
		
	<!-- right collumn -->
	<div class="col-sm-3">

	</div><!--end .col-sm-3 right collumn -->
</div><!-- end MAIN ROW -->


</div><!--END #content-->
			
<?php include 'includes/footer.php';?>

<!--******** Additional Script ********-->

<!-- Custom JS -->
<script language="javascript" type="text/javascript" src="js/validate-forms.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('#button').click(function() {
	    //Show Ajax Loader 	
	    $('#ajaxLoader').removeClass('hidden');	
	    
		//Define function getUrlParameter
		var getUrlParameter = function getUrlParameter(sParam) {
	    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
	        sURLVariables = sPageURL.split('&'),
	        sParameterName,
	        i;

		    for (i = 0; i < sURLVariables.length; i++) {
		        sParameterName = sURLVariables[i].split('=');

		        if (sParameterName[0] === sParam) {
		            return sParameterName[1] === undefined ? true : sParameterName[1];
		        }
		    }
		};
		
		//Prepare variables before ajax
		var email = getUrlParameter['email'];
        var newPassword = $('#newPassword').val();
        var newConfirmPassword = $('#newConfirmPassword').val();
        
        $.ajax({
            type: "get",
            url: "change-password.php",
            data: "email="+email+"&newPassword="+newPassword+"&newConfirmPassword="+newConfirmPassword, 
            success: function(response) {
            	$('#ajaxLoader').addClass('hidden');
                if(response == true) {
                    $('#status').html("<div class='alert-success alert alert-dismissible' role='alert'>
		        		<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>	
						<span class='glyphicon glyphicon-ok'></span> Đổi mật khẩu thành công.
					</div>") ;
                } else if (response == false) {
                     $('#status').html("<div class='alert-danger alert alert-dismissible' role='alert'>	
		            		<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
							<span class='glyphicon glyphicon-exclamation-sign'></span> Vui lòng kiểm tra thông tin.
						</div>") ;
                }
            }//END success
        });
    });//END click event
});	//END ready

</script>
</body>

</html>