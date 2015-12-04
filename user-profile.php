<?php $title = 'Thông tin tài khoản'; include 'includes/header.php';
//Check if user logged in?
is_logged_in();

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Form Handling
    //Errors flag
    $errors = array();
    //update flag
    $updates = array(); 
    //Validate first_name
    if(!empty($_POST['first_name'])) {
      if(preg_match('/^[a-z0-9A-Z_ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ \'-]{2,40}$/u', trim($_POST['first_name']))) {
        $first_name = mysqli_real_escape_string($db_connect, trim($_POST['first_name']));
        $query = "UPDATE user SET first_name = '{$first_name}' WHERE uid = '{$_SESSION['uid']}' LIMIT 1";
        $result = mysqli_query($db_connect, $query); confirm_query($result, $query);
        if(mysqli_affected_rows($db_connect) == 1) {
           //if updated successfully
            $message = alert_message(true, "Cập nhật thành công."); 
        } else {
            //NOT successfully.
            $message = alert_message(false, 'Lỗi hệ thống. Vui lòng thử lại sau.');
        }
      } else {
        $errors[] = 'first_name';
      }
    }
      
    //Validate last_name
    if(!empty($_POST['last_name'])) {
      if(preg_match('/^[a-z0-9A-Z_ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ \'-]{2,40}$/u', trim($_POST['last_name']))) {
        $last_name = mysqli_real_escape_string($db_connect, trim($_POST['last_name']));
        $query = "UPDATE user SET last_name = '{$last_name}' WHERE uid = '{$_SESSION['uid']}' LIMIT 1";
        $result = mysqli_query($db_connect, $query); confirm_query($result, $query);
        if(mysqli_affected_rows($db_connect) == 1) {
           //if updated successfully
            $message = alert_message(true, "Cập nhật thành công."); 
        } else {
            //NOT successfully.
            $message = alert_message(false, 'Lỗi hệ thống. Vui lòng thử lại sau.');
        }
      } else {
        $errors[] = 'last_name';  
      }
    } 

    //Validate Vietnam mobile phone number
    if(!empty($_POST['tel'])) {
      if(preg_match('/^0[19][0-9]{8,9}$/', trim($_POST['tel']))) {
        $phone = mysqli_real_escape_string($db_connect, trim($_POST['tel']));
        $query = "UPDATE user SET phone = '{$phone}' WHERE uid = '{$_SESSION['uid']}' LIMIT 1";
        $result = mysqli_query($db_connect, $query); confirm_query($result, $query);
        if(mysqli_affected_rows($db_connect) == 1) {
           //if updated successfully
            $message = alert_message(true, "Cập nhật thành công."); 
        } else {
            //NOT successfully.
            $message = alert_message(false, 'Lỗi hệ thống. Vui lòng thử lại sau.');
        }
      } else {
        $errors[] = 'phone';
      }
    } 

    if(!empty($errors)) {        
        // If $errors is NOT empty
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
      <div id="alert"></div>
      <div class="panel panel-success"><!--Team Avatar Form-->
        <div class="panel-heading"><strong><span class="glyphicon glyphicon-user"></span> Thông tin cá nhân</strong></div>
        
        <div class="panel-body">
          <div class="media">
            <div  class="media-left">
               <div id="crop-avatar">
                <!-- Current avatar -->
                <div class="media-object avatar-view">
                  <img class="thumbnail" src="<?php echo isset($user['avatar']) ? $user['avatar'] : 'css/images/default-avatar-100x100.png'; ?>" alt="user-Avatar">
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
                </div><!-- /.modal -->

                <!-- Loading state -->
              <div class="loading" aria-label="Loading" role="img" tabindex="-1"></div>
              </div><!-- END #crop-avatar -->
              
            </div><!-- END .media-left -->
            
            <div class="media-body">
              <form id="user-info-form" method="post">
                <div class="form-group">
                    <input type="text" name="last_name" class="form-control" id="last_name" size="20" maxlength="80"  placeholder="Họ" value="<?php if(isset($user['last_name'])) echo $user['last_name']; ?>" tabindex="4">
                  </div>

                <div class="form-group">
                    <input type="text" name="first_name" class="form-control" id="first_name" size="20" maxlength="80"  placeholder="Tên" value="<?php if(isset($user['first_name'])) echo $user['first_name']; ?>" tabindex="4">
                </div>
                 

                <div class="form-group">
                  <input type="tel" name="tel" id="tel" class="form-control" size="20" maxlength="80"  placeholder="Điện thoại di động" value="<?php if(isset($user['phone'])) echo $user['phone']; ?>" tabindex="5">
                </div>
                <button  id="user-button" type="button" class="btn btn-success btn-block" tabindex="6">Cập Nhật</button>
              </form>
            </div><!-- End .media body -->
            
          </div><!-- End .media -->
        </div><!-- End .panel-body -->
      </div><!--END Team Avatar Form-->

      

      <div class="panel panel-success"><!-- Form Change Password-->
        <div class="panel-heading"><strong><i class="fa fa-key fa-fw"></i> Thay đổi mật khẩu</strong></div>
        <div class="panel-body">
          <form>
            <!-- OLD PASSWORD -->
              <div class="form-group">
                <input type="password" class="form-control" id="oldPassword" name="oldPassword" placeholder="Mật khẩu cũ" tabindex='7' />
              </div>

            <!-- NEW PASSWORD -->
              <div class="form-group">
                <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="Mật khẩu mới"  tabindex='8' />
              </div>

              <!-- CONFIRM NEW PASSOWD -->
              <div class="form-group">
                <input type="password" class="form-control" id="confirmNewPassword" name="confirmNewPassword" placeholder="Xác nhận mật khẩu mới" tabindex='9' />
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
<script language="javascript" type="text/javascript" src="js/user-handling.js"></script>

</body>

</html>

