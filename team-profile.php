<?php $title = 'Đội bóng'; include 'includes/header.php';
//Check if user logged in?
is_logged_in();
//Fetch team data
$team = fetch_team($_SESSION['uid']);


//Edit team's info hanlding
if($_SERVER['REQUEST_METHOD'] == 'POST') {
  //Create error flag
  $errors = array();

  if(isset($_POST['teamName']) && preg_match('/^[a-z0-9A-Z_ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ&. \'-]{2,60}$/u', trim($_POST['teamName']))) {
    $teamName = mysqli_real_escape_string($db_connect, $_POST['teamName']);
  } else {
    $errors[] = 'teamName';
  }

  if(isset($_POST['type']) && filter_var($_POST['type'], FILTER_VALIDATE_INT)) {
    $type = mysqli_real_escape_string($db_connect, $_POST['type']);
  } else {
    $errors[] = 'type';
  }
  
  if(isset($_POST['province']) && preg_match('/^[0-9]{2}$/', $_POST['province'])) {
    $province = mysqli_real_escape_string($db_connect, $_POST['province']);
  } else {
    $errors[] = 'province';
  }


  if(empty($errors)) {
    if(isset($team['tid'])) {
      //UPDATE Database
      $query = "UPDATE team SET tname = '{$teamName}', team_type = '{$type}', provinceid = '{$province}' WHERE tid = {$team['tid']} LIMIT 1";
      $result = mysqli_query($db_connect, $query); confirm_query($result, $query);
      if(mysqli_affected_rows($db_connect) == 1) {
        $message = alert_message(true, 'Cập nhật thành công.');

        //Update team info
        $team = fetch_team($_SESSION['uid']);
      } else {
        $message = alert_message(false, 'Đã có lỗi xảy ra. Vui lòng thử lại sau.');
      }
    } else {
      //INSERT database, create team
      $query = "INSERT INTO team (tname, team_type, provinceid, uid, create_time) VALUES ('{$teamName}', '{$type}', '{$province}', {$_SESSION['uid']}, NOW())";
      $result = mysqli_query($db_connect, $query); confirm_query($result, $query);
      if(mysqli_affected_rows($db_connect) == 1) {
        $message = alert_message(true, 'Đội bóng đã được tạo.');
        //Update team info
        $team = fetch_team($_SESSION['uid']);
      } else {
        $message = alert_message(false, 'Đã có lỗi xảy ra.');
      }
    }
  } else {
    $message = alert_message(false, 'Vui lòng kiểm tra thông tin.');
  }
  
}//End if isset POST
?>

<div id="content">
  
  <div class="row"> <!-- MAIN ROW -->
    <!-- Left Collumn -->
    <div class="col-sm-3">

    </div><!--end .col-sm-3 left collumn -->

    <div class="col-sm-6"><!-- MAIN COLLUMN-->

      <!-- team modal -->
        <div class="modal fade" id="teamModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel1">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-success" id="ModalLabel1"><span class="fa fa-futbol-o"></span> <?php echo (isset($team['tid'])) ? 'Thay đổi' : 'Thành lập đội bóng' ?></h4>
              </div>

              <form id="teamForm" action="team-profile.php" method="post">
              <div class="modal-body">
                
                  <label class="text-success" for="type">Tên đội bóng</label>
                  <div class="form-group">
                      <input type="text" name="teamName" class="form-control" id="teamName" size="20" maxlength="80" tabindex="1" placeholder="Tên đội bóng" value="<?php if(isset($team['tname'])) echo $team['tname']; ?>">
                  </div>
                   
                  <div class="form-group">
                      <label class="text-success" for="type">Thể thức</label>
                      <div>
                        <select name="type" class="form-control">
                        <?php 
                          $selected_type = isset($team['team_type']) ? $team['team_type'] : 5;
                          for($i=5; $i<=11; $i++) {
                            echo "<option value='{$i}'";
                            if($i == $selected_type) {echo "selected='selected'";}
                            echo ">{$i} người</option>";
                          }
                        ?>
                         </select>
                      </div>  
                  </div>

                  <div class="form-group">
                    <label class="text-success" for="province">Tỉnh/Thành Phố</label>
                    <div>
                    <select class="form-control" name="province" tabindex="6">
                      <?php
                        $query = "SELECT * FROM province ORDER BY name";
                        $result = mysqli_query($db_connect, $query); confirm_query($db_connect, $query);
                        if(mysqli_num_rows($result) > 0) {
                          //default province
                          $selected_province = isset($team['provinceid']) ? $team['provinceid'] : 79;
                          while($provinces = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                            echo "<option value='{$provinces['provinceid']}'";
                            if($provinces['provinceid'] == $selected_province) {echo "selected='selected'";}
                            echo ">{$provinces['name']}</option>";
                          }
                        }
                      ?>
                    </select>
                    </div>
                  </div>  
                
              </div> <!-- End .modal-body -->
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                <button id="lastNameSave" type="submit" class="btn btn-success">Cập nhật</button>
              </div>
              </form>
            </div>

          </div>
        </div>
      <!-- team modal -->

      <?php if(isset($message)) echo $message;?>
      <div class="panel panel-success"> <!-- user info -->
        <div class="panel-heading"><strong><span class="fa fa-futbol-o"></span> Đội bóng</strong></div>
        
        <div class="panel-body">
          <div class="media">
            <div  class="media-left">
               <div id="crop-avatar">
                <!-- Current avatar -->
                <div class="media-object avatar-view" style="position: relative">
                  <img class="thumbnail" src="<?php echo isset($team['tavatar']) ? $team['tavatar'] : 'css/images/team-default-avatar-2.png'; ?>" alt="user-Avatar" style="position: relative; z-index: 1;">
                  <span class="badge fa fa-camera" style="position: absolute; left:5px; bottom: 5px; z-index: 10; opacity: .5;" >
                </div>

                <!-- Cropping modal -->
                <div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                      <form class="avatar-form" action="crop-team-avatar.php" enctype="multipart/form-data" method="post">
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
                  
              <p class="text-success"><strong><?php echo (isset($team['tname'])) ? $team['tname'] : 'Tên đội bóng';?></strong> 
              </p>
              <div id='rating'>
                <?php 
                  show_rating($team['rating']);
                ?>
              </div>
              
            </div><!-- End .media body -->
            
          </div><!-- End .media -->

          <ul class="list-group">
            <li class="list-group-item">
              <span id="displayFn">Thể thức: <strong class="text-success"><?php if(isset($team['team_type'])) echo $team['team_type']." người" ;?></span></strong>
            </li>

            <li class="list-group-item">
              <span id="displayPhone">Tỉnh/TP: <strong class="text-success"><?php if(isset($team['name'])) echo $team['name'];?></span></strong>
            </li>

             <li class="list-group-item">
              <span id="displayPhone">Tên người liên hệ: <strong class="text-success"><?php if(isset($user['first_name'])) echo $user['first_name'];?></span></strong>
            </li>

             <li class="list-group-item">
              <span id="displayPhone">Số ĐTDĐ: <strong class="text-success"><?php if(isset($user['phone'])) echo $user['phone'];?></span></strong>
              </span>
            </li>
          </ul>
          <button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#teamModal"><?php echo (isset($team['tid'])) ? 'Thay đổi' : 'Thành lập đội bóng' ?></button>
        </div><!-- End .panel-body -->
      </div><!-- End user info -->

      

    </div> <!--end MAIN COLLUMN -->
      
    <!-- right collumn -->
    <div class="col-sm-3">
      
    </div><!--end .col-sm-3 right collumn -->
  </div><!-- end MAIN ROW -->


</div><!--END #content-->
      
<?php include 'includes/footer.php';?>

<!--******** Additional Scrip ********-->
<!--Bootstrap rating -->
<script language="javascript" type="text/javascript" src="js/bootstrap-rating.min.js"></script>

<!--Filestyle -->
<script type="text/javascript" src="js/bootstrap-filestyle.min.js"> </script>

<!-- Cropper -->
<script src="https://cdn.rawgit.com/fengyuanchen/cropper/v2.0.1/dist/cropper.min.js"></script>
<script src="js/crop-team-avatar.js"></script>

<!-- Custom JS -->
<script language="javascript" type="text/javascript" src="js/team-handling.js"></script>

 <!-- Loading state -->
<div class="loading" aria-label="Loading" role="img" tabindex="-1"></div>
</body>

</html>

  