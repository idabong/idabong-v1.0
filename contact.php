<?php $title = 'Liên hệ'; include 'includes/header.php';?>
<div id="content">

	<div class="row"> <!-- MAIN ROW -->
		<!-- Left Collumn -->
		<div class="col-sm-3">

		</div><!--end .col-sm-3 left collumn -->

		<div class="col-sm-6"><!-- MAIN COLLUMN-->
		<?php 
			// Form Handling
			if($_SERVER['REQUEST_METHOD'] == 'POST') {
			    // Create form error flag
			    $errors = array();
			    
			    // Prevent spam
			    $clean = array_map('clean_email', $_POST);
			  
			    // Email Validation
			    if(!preg_match('/^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$/', $clean['email'])) {
			        $errors[] = 'email';
			    }
			    
			    // Comment validation
			    if(empty($clean['comment'])) {
			        $errors[] = 'comment';
			    }
			    
			    // Handle reCaptcha by Google
			    if(isset($_POST['g-recaptcha-response'])) {
			    	 $captcha = $_POST['g-recaptcha-response'];

				    if(!$captcha){
				      $errors[] = 'reCaptcha';
				    }

				    $response = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LfVfhATAAAAAH1o0VsLIYRuGrGlMxuHlFyvPOlw&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']), true);
				    if($response['success'] == false)
				    {
				      $errors[] = 'reCaptcha';
				    }
			    } 

			    //If there is no error, send mail by phpmailer and google smtp server
			    if(empty($errors)) {
			    	
			    	//Prepare 4 variables $from, $to, $subject, $body in order to send mail
			    	$from = $clean['email'];
			    	$to = "hotro.idabong@gmail.com";
			    	$subject = "idabong.com: Feed back from ".$clean['email'];
			        $body = "Comment:\n ". strip_tags($clean['comment']);
			        $body = wordwrap($body, 70);

			        //Send mail by custom php function
					if(!send_mail($from, $to, $subject, $body)) {
						$message = alert_message(false, '<strong>Xin lỗi!</strong> email của bạn không thể gửi được. Vui lòng thử lại sau.');
					} else {
					    $message = alert_message(true, "Email đã được gửi. Cám ơn ý kiến của bạn!"); 
						//Erase global variable $_POST
			            $_POST = array();
					}
			            
			    } else {
			        // Neu co loi trong bien errors, do nguoi dung quen nhap vao truong
			        $message = alert_message(false, 'Vui lòng kiểm tra thông tin.'); 
			    }

			    //Inform message 
			    echo $message;
			} // END Main submit if
		//END Form Handling
		?>
			<div class="panel panel-success">
			  <div class="panel-heading"><strong><i class="fa fa-commenting"></i> Hãy giúp idabong.com phục vụ bạn tốt hơn nữa!</strong></div>
			  <div class="panel-body">

			    <form id="contact-form" action="" method="post">

		        	<div class="form-group"><!-- Email Field -->
		                <input type="text" name="email" id="email" class="form-control" placeholder="Email" maxlength="80" tabindex="1" />
		            </div>

		            <div class="form-group"><!-- Comment Field -->
		                <div id="comment">
		                <textarea name="comment" rows="5" class="form-control" placeholder="Ý kiến" tabindex="2"></textarea>
		                </div>
		            </div>

		            <!-- reCaptcha by Google -->
	       			<div id="reCaptcha" class="form-group g-recaptcha" data-sitekey="6LfVfhATAAAAAEq70OdwolfhL_Yvtp8RmZc7VYIe"></div>

				    <div class="form-group"><!-- Submit button -->
				    	<input type="submit" name="submit" class="btn btn-success btn-block" value="Gửi mail" tabindex="3" />
				    </div>

				    

				</form>

			  </div><!--end .panel-body -->
			</div><!--end .panel -->
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

</body>

</html>