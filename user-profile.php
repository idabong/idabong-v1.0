<?php $title = 'Thông tin tài khoản'; include 'includes/header.php';?>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      	<div class="modal-header">
      		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

      		<!-- modal-title -->
      		<div id="myModalLabel" class="modal-title">
				<!-- Input form -->
				<form class="form-group">
					<input id="inputImage" type="file" class="filestyle" data-classButton="btn btn-success"  data-buttonBefore="true" data-iconName="glyphicon glyphicon-picture" data-buttonText="Chọn ảnh" data-placeholder="Định dạng jpg/png">
				</form> 
				<!-- END input form -->
			</div><!--END modal-title-->
	        
    	</div><!-- END .modal-header -->

		<div class="modal-body">
          	<!-- Place for edit image -->
			<img id='editImage' class='img-responsive' src='css/images/default-avatar-64x64.png' alt='edit-image'>
		</div>

      <div class="modal-footer">    	
			<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
        	<button id="cropButton" type="button" class="btn btn-success">Cập nhật</button>
      </div>
    </div><!-- END .modal-content -->
  </div><!-- END #modal-dialog -->
</div><!-- END #myModal -->
	
<div id="content">
	
	<div class="row"> <!-- MAIN ROW -->
		<!-- Left Collumn -->
		<div class="col-sm-3">

		</div><!--end .col-sm-3 left collumn -->

		<div class="col-sm-6"><!-- MAIN COLLUMN-->
			<div class="panel panel-success"><!--Team Avatar Form-->
				<div class="panel-heading"><strong><span class="glyphicon glyphicon-user"></span> Thông tin cá nhân</strong></div>
				<div class="panel-body">
					<div class="media">
						<div class="media-left">
							<!-- trigger modal -->
							<a href="#" data-toggle="modal" data-target="#myModal">
							  <img class="media-object" src="css/images/default-avatar-64x64.png" alt="user-avatar">
							  <p class="btn btn-block"><span class="badge"><span class="glyphicon glyphicon-picture"></span></span></p>
							</a>
						</div>

						<div class="media-body">
							<form>
								<div class="form-group">
								    <input type="text" name="last_name" class="form-control" id="last_name" size="20" maxlength="80"  placeholder="Họ" value="<?php if(isset($user['last_name'])) echo $user['last_name']; ?>" tabindex="4">
							    </div>

								<div class="form-group">
								    <input type="text" name="first_name" class="form-control" id="first_name" size="20" maxlength="80"  placeholder="Tên" value="<?php if(isset($user['first_name'])) echo $user['first_name']; ?>" tabindex="4">
							    </div>
								 

							    <div class="form-group">
								    <input type="tel" name="tel" id="tel" class="form-control" size="20" maxlength="80"  placeholder="Điện thoại di động" value="<?php if(isset($user['phone'])) echo $user['phone']; ?>" tabindex="5">
							    </div>
							</form>
						</div><!-- End .media body -->
						<a href="#" target="_blank" class="btn btn-success btn-block" tabindex="6">Cập Nhật</a>
					</div><!-- End .media -->
				</div><!-- End .panel-body -->
			</div><!--END Team Avatar Form-->

			<div class="panel panel-success"><!-- Form Change Password-->
				<div class="panel-heading"><strong><i class="fa fa-key fa-fw"></i> Thay đổi mật khẩu</strong></div>
				<div class="panel-body">
					<form>
						<!-- OLD PASSWORD -->
						  <div class="form-group">
						    <input type="password" class="form-control" id="oldPassword" name="oldPassword" placeholder="Mật khẩu cũ" value="<?php if(isset($_POST['oldPassword'])) echo $_POST['oldPassword']; ?>" tabindex='7' />
						  </div>

						<!-- NEW PASSWORD -->
						  <div class="form-group">
						    <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="Mật khẩu mới" value="<?php if(isset($_POST['newPassword'])) echo $_POST['newPassword']; ?>" tabindex='8' />
						  </div>

						  <!-- CONFIRM NEW PASSOWD -->
						  <div class="form-group">
						    <input type="password" class="form-control" id="confirmNewPassword" name="confirmNewPassword" placeholder="Xác nhận mật khẩu mới" value="<?php if(isset($_POST['confirmNewPassword'])) echo $_POST['confirmNewPassword']; ?>" tabindex='9' />
						  </div>

						<a href="#" target="_blank" class="btn btn-success btn-block" tabindex='10'>Cập Nhật</a>
					</form>

				</div><!-- End . panel-body -->
			</div><!--END Form Change Password-->
		
		</div> <!--end MAIN COLLUMN -->
			
		<!-- right collumn -->
		<div class="col-sm-3">
			
		</div><!--end .col-sm-3 right collumn -->
	</div><!-- end MAIN ROW -->


</div><!--END #content-->
			
<?php include 'includes/footer.php';?>

<!--******** Additional Scrip ********-->
<!-- Vietnamese reCaptcha by Google-->
<script src='https://www.google.com/recaptcha/api.js?hl=vi'></script>


<!--Filestyle -->
<script type="text/javascript" src="js/bootstrap-filestyle.min.js"> </script>

<!-- Cropper -->
<script src="https://cdn.rawgit.com/fengyuanchen/cropper/v2.0.1/dist/cropper.min.js"></script>

<!-- Custom JS -->
<script language="javascript" type="text/javascript" src="js/validate-forms.js"></script>
<script language="javascript" type="text/javascript" src="js/avatar-processor.js"></script>
</body>

</html>