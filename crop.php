<?php
ini_set('session.use_only_cookies', true); session_start(); 

//Include functions
include('includes/functions.php');

// Database connect local
//***LOCAL***//
$db_connect = mysqli_connect('localhost', 'root', '', 'idabong');

// Database connect
//$db_connect = mysqli_connect('localhost', 'idabong_admin','DevelopVNfootball2015','idabong_database');

// If could not connect
if(!$db_connect) {
    trigger_error("Could not connect to DB: " . mysqli_connect_error());
    echo "<p class='well'>Could not connect to database</p>";
} else {
    // utf-8 for Vietnamese
    mysqli_set_charset($db_connect, 'utf-8');
}

//***********Cropper***********//
class CropAvatar {
  public $src;
  private $data;
  private $dst;
  private $type;
  private $extension;
  private $msg;

  function __construct($src, $data, $file) {
    $this -> setSrc($src);
    $this -> setData($data);
    $this -> setFile($file);
    $this -> crop($this -> src, $this -> dst, $this -> data);
  }

  private function setSrc($src) {
    if (!empty($src)) {
      $type = exif_imagetype($src);

      if ($type) {
        $this -> src = $src;
        $this -> type = $type;
        $this -> extension = image_type_to_extension($type);
        $this -> setDst();
      }
    }
  }

  private function setData($data) {
    if (!empty($data)) {
      $this -> data = json_decode(stripslashes($data));
    }
  }

  private function setFile($file) {
    $errorCode = $file['error'];

    if ($errorCode === UPLOAD_ERR_OK) {
      $type = exif_imagetype($file['tmp_name']);

      if ($type) {
        $extension = image_type_to_extension($type);
        $src = 'img/' . date('YmdHis') . '.original' . $extension;

        if ($type == IMAGETYPE_GIF || $type == IMAGETYPE_JPEG || $type == IMAGETYPE_PNG) {

          if (file_exists($src)) {
            unlink($src);
          }

          $result = move_uploaded_file($file['tmp_name'], $src);

          if ($result) {
            $this -> src = $src;
            $this -> type = $type;
            $this -> extension = $extension;
            $this -> setDst();
          } else {
             $this -> msg = 'Failed to save file';
          }
        } else {
          $this -> msg = 'Vui lòng upload hình ảnh với định dạng JPG, PNG';
        }
      } else {
        $this -> msg = 'Vui lòng upload file hình ảnh.';
      }
    } else {
      $this -> msg = $this -> codeToMessage($errorCode);
    }
  }

  private function setDst() {
    $this -> dst = 'img/' . date('YmdHis') . '.png';
  }

  private function crop($src, $dst, $data) {
    if (!empty($src) && !empty($dst) && !empty($data)) {
      switch ($this -> type) {
        case IMAGETYPE_GIF:
          $src_img = imagecreatefromgif($src);
          break;

        case IMAGETYPE_JPEG:
          $src_img = imagecreatefromjpeg($src);
          break;

        case IMAGETYPE_PNG:
          $src_img = imagecreatefrompng($src);
          break;
      }

      if (!$src_img) {
        $this -> msg = "Failed to read the image file";
        return;
      }

      $size = getimagesize($src);
      $size_w = $size[0]; // natural width
      $size_h = $size[1]; // natural height

      $src_img_w = $size_w;
      $src_img_h = $size_h;

      $degrees = $data -> rotate;

      $tmp_img_w = $data -> width;
      $tmp_img_h = $data -> height;
      $dst_img_w = 220;
      $dst_img_h = 220;

      $src_x = $data -> x;
      $src_y = $data -> y;

      if ($src_x <= -$tmp_img_w || $src_x > $src_img_w) {
        $src_x = $src_w = $dst_x = $dst_w = 0;
      } else if ($src_x <= 0) {
        $dst_x = -$src_x;
        $src_x = 0;
        $src_w = $dst_w = min($src_img_w, $tmp_img_w + $src_x);
      } else if ($src_x <= $src_img_w) {
        $dst_x = 0;
        $src_w = $dst_w = min($tmp_img_w, $src_img_w - $src_x);
      }

      if ($src_w <= 0 || $src_y <= -$tmp_img_h || $src_y > $src_img_h) {
        $src_y = $src_h = $dst_y = $dst_h = 0;
      } else if ($src_y <= 0) {
        $dst_y = -$src_y;
        $src_y = 0;
        $src_h = $dst_h = min($src_img_h, $tmp_img_h + $src_y);
      } else if ($src_y <= $src_img_h) {
        $dst_y = 0;
        $src_h = $dst_h = min($tmp_img_h, $src_img_h - $src_y);
      }

      // Scale to destination position and size
      $ratio = $tmp_img_w / $dst_img_w;
      $dst_x /= $ratio;
      $dst_y /= $ratio;
      $dst_w /= $ratio;
      $dst_h /= $ratio;

      $dst_img = imagecreatetruecolor($dst_img_w, $dst_img_h);

      // Add transparent background to destination image
      imagefill($dst_img, 0, 0, imagecolorallocatealpha($dst_img, 0, 0, 0, 127));
      imagesavealpha($dst_img, true);

      $result = imagecopyresampled($dst_img, $src_img, $dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h);

      if ($result) {
        if (!imagepng($dst_img, $dst)) {
          $this -> msg = "Failed to save the cropped image file";
        }
      } else {
        $this -> msg = "Failed to crop the image file";
      }

      imagedestroy($src_img);
      imagedestroy($dst_img);

      //Delete original uploaded file-Tran Dai added
      if (file_exists($src)) {
        unlink($src);
      }
    }
  }

  private function codeToMessage($code) {
    $errors = array(
      UPLOAD_ERR_INI_SIZE =>'The uploaded file exceeds the upload_max_filesize directive in php.ini',
      UPLOAD_ERR_FORM_SIZE =>'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
      UPLOAD_ERR_PARTIAL =>'The uploaded file was only partially uploaded',
      UPLOAD_ERR_NO_FILE =>'No file was uploaded',
      UPLOAD_ERR_NO_TMP_DIR =>'Missing a temporary folder',
      UPLOAD_ERR_CANT_WRITE =>'Failed to write file to disk',
      UPLOAD_ERR_EXTENSION =>'File upload stopped by extension',
    );

    if (array_key_exists($code, $errors)) {
      return $errors[$code];
    }

    return 'Unknown upload error';
  }

  public function getResult() {
    return !empty($this -> data) ? $this -> dst : $this -> src;
  }

  public function getMsg() {
    return $this -> msg;
  }
}

$crop = new CropAvatar(
  isset($_POST['avatar_src']) ? $_POST['avatar_src'] : null,
  isset($_POST['avatar_data']) ? $_POST['avatar_data'] : null,
  isset($_FILES['avatar_file']) ? $_FILES['avatar_file'] : null
);

$response = array(
  'state'  => 200,
  'message' => $crop -> getMsg(),
  'result' => $crop -> getResult()
);

echo json_encode($response);
//***********END Cropper***********//


//If there is no error, update database
if(empty($crop->getMsg())) {
  //Delete old avatar
  $user = fetch_user($_SESSION['uid']);
  if(isset($user['avatar'])) {
    unlink($user['avatar']);
  }

  //Update new avatar
  $avatarLink = $crop -> getResult();
  $q = "UPDATE user SET avatar = '{$avatarLink}' WHERE uid = {$_SESSION['uid']} LIMIT 1";
  $update_result = mysqli_query($db_connect, $q);
}
?>