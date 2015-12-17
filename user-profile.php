<?php $title = 'Thông tin tài khoản'; include 'includes/header.php';
//Check if user logged in?
is_logged_in();
if($_SERVER['REQUEST_METHOD'] == 'POST') {

if(isset($_POST['oldPassword']) && preg_match('/^\w{6,30}$/', $_POST['oldPassword'])) {
  $oldPassword = mysqli_real_escape_string($db_connect, $_POST['oldPassword']);
  $query = "SELECT email FROM user WHERE uid = {$_SESSION['uid']} AND password = SHA1('$oldPassword')";
  $result = mysqli_query($db_connect, $query); confirm_query($result, $query);
    if(mysqli_num_rows($result) == 1) {
      // Password validate
      if(isset($_POST['newPassword']) && preg_match('/^\w{6,30}$/', $_POST['newPassword'])) {
          //Check if passwords are the same
          if($_POST['newPassword'] == $_POST['confirmNewPassword']) {
              $newPassword = mysqli_real_escape_string($db_connect, $_POST['newPassword']);
              
              //Update database
              $query1 = "UPDATE user SET password = SHA1('$newPassword') WHERE uid = {$_SESSION['uid']} LIMIT 1";
              $result1 = mysqli_query($db_connect, $query1); confirm_query($result1, $query1);
            
              if(mysqli_affected_rows($db_connect) == 1) {
                  // If successfull
                  $message = alert_message(true, "Đổi mật khẩu thành công."); 
              } else {
                  // If update NOT successfully
                  $message = alert_message(false, "Đã có lỗi xảy ra.");
              } 
            } else {
                // Passwords are NOT the same
                $message = alert_message(false, "Xác nhận mật khẩu không đúng.");
            } 
      } else { //isset newPassword
          $message = alert_message(false, "Vui lòng kiểm tra mật khẩu mới.");
      }

    } else {
      $message = alert_message(false, "Mật khẩu cũ không đúng.");
    }
} 

}//End if isset POST
?>

<div id="content">
  
  <div class="row"> <!-- MAIN ROW -->
    <!-- Left Collumn -->
    <div class="col-sm-3">

    </div><!--end .col-sm-3 left collumn -->

    <div class="col-sm-6"><!-- MAIN COLLUMN-->

      <!-- Alert Area-->
      <div class='hidden alert-success alert alert-dismissible' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>    
        <span class='glyphicon glyphicon-ok'></span> Cập nhật thành công.
      </div>

      <div class='hidden alert-danger alert alert-dismissible' role='alert'>   
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <span class='glyphicon glyphicon-exclamation-sign'></span> Đã có lỗi xảy ra. Vui lòng kiểm tra thông tin.
      </div>
      <!-- End Alert Area-->

      <!-- last name modal -->
        <div class="modal fade" id="lastNameModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel1">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="ModalLabel1">Họ</h4>
              </div>
              <div class="modal-body">
                <form id="lastNameForm">
                  <input type="text" name="last_name" class="form-control" id="last_name" size="20" maxlength="80"  placeholder="Họ" value="<?php if(isset($user['last_name'])) echo $user['last_name']; ?>" tabindex="4">
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                <button id="lastNameSave" type="button" class="btn btn-success" data-dismiss="modal">Lưu lại</button>
              </div>
            </div>
          </div>
        </div><!-- end last name modal -->

      <!-- first name modal -->
      <div class="modal fade" id="firstNameModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel2">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="ModalLabel2">Tên</h4>
            </div>
            <div class="modal-body">
              <form id="firstNameForm">
                 <input type="text" name="first_name" class="form-control" id="first_name" size="20" maxlength="80"  placeholder="Tên" value="<?php if(isset($user['first_name'])) echo $user['first_name']; ?>" tabindex="4">
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
              <button id="firstNameSave" type="button" class="btn btn-success" data-dismiss="modal">Lưu lại</button>
            </div>
          </div>
        </div>
      </div><!-- End first name modal -->
      

      <!-- phone modal -->     
      <div class="modal fade" id="phoneModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel3">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="ModalLabel3">Số ĐTDĐ</h4>
            </div>
            <div class="modal-body">
              <form id="phoneForm">
                 <input type="tel" name="tel" id="tel" class="form-control" size="20" maxlength="80"  placeholder="Điện thoại di động" value="<?php if(isset($user['phone'])) echo $user['phone']; ?>" tabindex="5">
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
              <button id="phoneSave" type="button" class="btn btn-success" data-dismiss="modal">Lưu lại</button>
            </div>
          </div>
        </div>
      </div><!-- End phone modal -->
      

      <div class="panel panel-success"> <!-- user info -->
        <div class="panel-heading"><strong><span class="glyphicon glyphicon-user"></span> Thông tin cá nhân</strong></div>
        
        <div class="panel-body">
          <div class="media">
            <div  class="media-left">
               <div id="crop-avatar">
                <!-- Current avatar -->
                <div class="media-object avatar-view" style="position: relative">
                  <img class="thumbnail" src="<?php echo isset($user['avatar']) ? $user['avatar'] : 'css/images/default-avatar-100x100.png'; ?>" alt="user-Avatar" style="position: relative; z-index: 1;">
                  <span class="badge fa fa-camera" style="position: absolute; left:5px; bottom: 5px; z-index: 10; opacity: .5;" >
                </div>

                <!-- Cropping modal -->
                <div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                      <form class="avatar-form" action="crop-user-avatar.php" enctype="multipart/form-data" method="post">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <div class="modal-title" id="avatar-modal-label">
                              <input id="avatarInput" type="file" class="avatar-input filestyle" name="avatar_file" data-buttonBefore="true" data-iconName="glyphicon glyphicon-picture" data-buttonText="Chọn ảnh" data-placeholder="Định dạng jpg/png, dung lượng không quá 10M">
                          </div>
                        </div>

                        <div class="modal-body">
                          <div class="avatar-body">

                            <!-- Upload image and data -->
                            <div class="avatar-upload">
                              <input type="hidden" class="avatar-src" name="avatar_src">
                              <input type="hidden" class="avatar-data" name="avatar_data">
                              <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
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
                </div><!-- /.modal --><!-- Crop avatar -->

              </div><!-- END #crop-avatar -->
              
            </div><!-- END .media-left -->
            
            <div class="media-body">

                  <p>
                    <span id="displayLn">Họ: <strong class="text-success"><?php if(isset($user['last_name'])) echo $user['last_name'];?></span></strong>
                    <span style='cursor: pointer' data-toggle="modal" data-target="#lastNameModal" class="label label-success pull-right">
                      <i title="Thay đổi" class="fa fa-pencil-square-o"></i> <small>Thay đổi</small>
                    </span>
                  </p>

                  <p>
                    <span id="displayFn">Tên: <strong class="text-success"><?php if(isset($user['first_name'])) echo $user['first_name'];?></span></strong>
                    <span style='cursor: pointer' data-toggle="modal" data-target="#firstNameModal" class="label label-success pull-right">
                    <i title="Thay đổi" class="fa fa-pencil-square-o"></i> <small>Thay đổi</small>
                    </span>
                  </p>

                  <p>
                    <span id="displayPhone">Số ĐTDĐ: <strong class="text-success"><?php if(isset($user['phone'])) echo $user['phone'];?></span></strong>
                    <span style='cursor : pointer' data-toggle="modal" data-target="#phoneModal" class="label label-success pull-right">
                    <i title="Thay đổi" class="fa fa-pencil-square-o"></i> <small>Thay đổi</small>
                    </span>
                  </p>
    
            </div><!-- End .media body -->
            
          </div><!-- End .media -->
        </div><!-- End .panel-body -->
      </div><!-- End user info -->

      <?php if(isset($message)) echo $message;?>

      <div class="panel panel-success"><!-- Form Change Password-->
        <div class="panel-heading"><strong><i class="fa fa-key fa-fw"></i> Thay đổi mật khẩu</strong></div>
        <div class="panel-body">
          <form id="changePassword" action="user-profile.php" method="post">
            <!-- OLD PASSWORD -->
              <div class="form-group">
                <input type="password" class="form-control" id="oldPassword" name="oldPassword" placeholder="Mật khẩu cũ" tabindex='1' />
              </div>

            <!-- NEW PASSWORD -->
              <div class="form-group">
                <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="Mật khẩu mới"  tabindex='2' />
              </div>

              <!-- CONFIRM NEW PASSOWD -->
              <div class="form-group">
                <input type="password" class="form-control" id="confirmNewPassword" name="confirmNewPassword" placeholder="Xác nhận mật khẩu mới" tabindex='3' />
              </div>

            <button type="submit" class="btn btn-success btn-block" tabindex='4'>Cập Nhật</button>
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
<script src="js/crop-user-avatar.js"></script>

<!-- Custom JS -->
<script language="javascript" type="text/javascript" src="js/validate-forms.js"></script>
<script language="javascript" type="text/javascript" src="js/user-handling.js"></script>
 <!-- Loading state -->
<div class="loading" aria-label="Loading" role="img" tabindex="-1"></div>
</body>

</html>

