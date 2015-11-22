<?php $title = 'Thông tin tài khoản'; include 'includes/header.php';?>
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
            <div  class="media-left">
               <div id="crop-avatar">
                <!-- Current avatar -->
                <div class="media-object avatar-view">
                  <img class="thumbnail" src="css/images/default-avatar-64x64.png" alt="user-Avatar">
                  <p class="btn btn-block"><span class="badge"><span class="glyphicon glyphicon-picture"></span></span></p>
                </div>

                <!-- Cropping modal -->
                <div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <form class="avatar-form" action="crop.php" enctype="multipart/form-data" method="post">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <div class="modal-title" id="avatar-modal-label">
                              <input id="avatarInput" type="file" class="avatar-input filestyle" name="avatar_file" data-classButton="btn btn-success"  data-buttonBefore="true" data-iconName="glyphicon glyphicon-picture" data-buttonText="Chọn ảnh" data-placeholder="Định dạng jpg/png">
                          </div>
                        </div>

                        <div class="modal-body">
                          <div class="avatar-body">

                            <!-- Upload image and data -->
                            <div class="avatar-upload">
                              <input type="hidden" class="avatar-src" name="avatar_src">
                              <input type="hidden" class="avatar-data" name="avatar_data">
                            </div>

                            <!-- Crop and preview -->
                            <div class="row">
                              <div class="col-md-10">
                                <div class="avatar-wrapper"></div>
                              </div>
                              <div class="col-md-2">
                                <div class="avatar-preview preview-md"></div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="avatar-btns modal-footer">
                          <button type="submit" class="btn btn-success btn-block avatar-save">Cập nhật</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div><!-- /.modal -->

                <!-- Loading state -->
                <div class="loading" aria-label="Loading" role="img" tabindex="-1"></div>
              </div><!-- END #crop-avatar -->
              
            </div><!-- END .media-left -->
            
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

<!--Filestyle -->
<script type="text/javascript" src="js/bootstrap-filestyle.min.js"> </script>

<!-- Cropper -->
<script src="https://cdn.rawgit.com/fengyuanchen/cropper/v2.0.1/dist/cropper.min.js"></script>
<script src="js/cropper.js"></script>

<!-- Custom JS -->
<script language="javascript" type="text/javascript" src="js/validate-forms.js"></script>

</body>

</html>

