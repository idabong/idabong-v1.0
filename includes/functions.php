<?php
// Define absolute URL
//define('BASE_URL', 'http://idabong.com/');
//***LOCAL***//
define('BASE_URL', 'http://localhost/idabong-v1.0/');

define('LIVE', TRUE); // FALSE: Developing progress | TRUE: production
// Checking if database query is Right
function confirm_query($result, $query) {
    global $db_connect;
    if(!$result && !LIVE) {
        die("Query {$query} \n<br/> MySQL Error: " .mysqli_error($db_connect));
    } 
}

// Redirect user 
function redirect_to($page = 'index.php') {
    $url = BASE_URL . $page;
    header("Location: $url");
    exit();
}

//Check if user logined?
function is_logged_in() {
    if(!isset($_SESSION['uid'])) {redirect_to('login.php');} 
}

// prevent spam email
function clean_email($value) {
    $suspects = array('to:', 'bcc:','cc:','content-type:','mime-version:', 'multipart-mixed:','content-transfer-encoding:');
    foreach ($suspects as $s) {
        if(strpos($value, $s) !== FALSE) {
            return '';
        }
        // Tra ve gia tri cho dau xuong hang
        $value = str_replace(array('\n', '\r', '%0a', '%0d'), '', $value);
        return trim($value);
    }
}   

//Sending Email
function send_mail($from, $to, $subject, $body) {
    require_once ('includes/class.phpmailer.php');

    $mail = new PHPMailer(); // create a new object
    $mail->CharSet = "UTF-8";
    $mail->IsSMTP(); // enable SMTP
    $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; // authentication enabled
    $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 465; // or 587
    $mail->IsHTML(true);
    $mail->Username = "idabong.com@gmail.com";
    $mail->Password = "DevelopVNfootball";
    $mail->SetFrom($from);
    $mail->Subject = $subject;
    $mail->Body = $body;
    $mail->AddAddress($to);
    //$mail->AddEmbeddedImage('css/images/slogan.png', 'slogan-idabong.com');
     if($mail->Send())
        {
        return TRUE; //If email is sent 
        }
        else
        {
        return FALSE; //If email is NOT sent 
        }
}//END Sending Email

//Write activate link to test local
//***LOCAL***//
function write_file($txt) {
    $myfile = fopen("D:\project\activation.txt", "w");
    fwrite($myfile, $txt);
    if(fclose($myfile)) {
        return TRUE;
    } else {
        return FALSE;
    }
}

//Check reCaptcha by Google
function check_reCaptcha() {
    // Handle reCaptcha by Google
    if(isset($_POST['g-recaptcha-response'])) {
         $captcha = $_POST['g-recaptcha-response'];

        if(!$captcha){
          return false;
        }

        $response = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LfVfhATAAAAAH1o0VsLIYRuGrGlMxuHlFyvPOlw&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']), true);
        if($response['success'] == true)
        {
          return true;
        } else { 
            return false; 
        }
    } 
}

//Create alert message
function alert_message($success, $message) {
    if($success == true) {
        $alert = "<div class='alert-success alert alert-dismissible' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>    
            <span class='glyphicon glyphicon-ok'></span> ".$message."</div>";
    } else {
        $alert = "<div class='alert-danger alert alert-dismissible' role='alert'>   
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                <span class='glyphicon glyphicon-exclamation-sign'></span> ".$message."</div>";
    }
    return $alert;
}

//Fetch user's information
function fetch_user($user_id) {
    global $db_connect;
    $query = "SELECT * FROM user WHERE uid = {$user_id}";
    $result = mysqli_query($db_connect, $query); confirm_query($result, $query);

    if(mysqli_num_rows($result) > 0) {
        // If successfully
        return $result_set = mysqli_fetch_array($result, MYSQLI_ASSOC);
    } else {
        // If NOT successfully
        return FALSE;
    }
} // END fetch_user



//Fetch user's information
function fetch_team($user_id) {
    global $db_connect;
    $query = "SELECT * FROM team AS t INNER JOIN province AS p ON t.provinceid=p.provinceid WHERE t.uid = {$user_id}";
    $result = mysqli_query($db_connect, $query); confirm_query($result, $query);

    if(mysqli_num_rows($result) == 1) {
        // If successfully
        return $result_set = mysqli_fetch_array($result, MYSQLI_ASSOC);
    } else {
        // If NOT successfully
        return FALSE;
    }
} // END fetch_user

//Fetch posts
function fetch_post() {
    global $db_connect;
    $query = "SELECT * FROM post WHERE match_date >= CURDATE()"; //match_date >= CURDATE()
    $result = mysqli_query($db_connect, $query); confirm_query($result, $query);

    if(mysqli_num_rows($result) > 0) {
        // If successfully
        return $result_set = mysqli_fetch_array($result, MYSQLI_ASSOC);
    } else {
        // If NOT successfully
        return FALSE;
    }
}

function show_rating($team_rating) {
    if(isset($team_rating)) {
        $rating = round($team_rating);
        switch ($rating) {
            case 1:
                echo "<span class='glyphicon glyphicon-star yellow'></span>
                  <span class='glyphicon glyphicon-star-empty'></span>
                  <span class='glyphicon glyphicon-star-empty'></span>
                  <span class='glyphicon glyphicon-star-empty'></span>
                  <span class='glyphicon glyphicon-star-empty'></span>
                  ";
                break;
            case 2:
                echo "<span class='glyphicon glyphicon-star yellow'></span>
                  <span class='glyphicon glyphicon-star yellow'></span>
                  <span class='glyphicon glyphicon-star-empty'></span>
                  <span class='glyphicon glyphicon-star-empty'></span>
                  <span class='glyphicon glyphicon-star-empty'></span>
                  ";
                break;
            case 3:
                echo "<span class='glyphicon glyphicon-star yellow'></span>
                  <span class='glyphicon glyphicon-star yellow'></span>
                  <span class='glyphicon glyphicon-star yellow'></span>
                  <span class='glyphicon glyphicon-star-empty'></span>
                  <span class='glyphicon glyphicon-star-empty'></span>
                  ";
                break;

            case 4:
                echo "<span class='glyphicon glyphicon-star yellow'></span>
                  <span class='glyphicon glyphicon-star yellow'></span>
                  <span class='glyphicon glyphicon-star yellow'></span>
                  <span class='glyphicon glyphicon-star yellow'></span>
                  <span class='glyphicon glyphicon-star-empty'></span>
                  ";
                break;

            case 5:
            echo "<span class='glyphicon glyphicon-star yellow'></span>
              <span class='glyphicon glyphicon-star yellow'></span>
              <span class='glyphicon glyphicon-star yellow'></span>
              <span class='glyphicon glyphicon-star yellow'></span>
              <span class='glyphicon glyphicon-star yellow'></span>
              ";
            break;
            
        }
    } else {
        echo "<span class='glyphicon glyphicon-star-empty'></span>
                  <span class='glyphicon glyphicon-star-empty'></span>
                  <span class='glyphicon glyphicon-star-empty'></span>
                  <span class='glyphicon glyphicon-star-empty'></span>
                  <span class='glyphicon glyphicon-star-empty'></span>
                  ";
    } 
}
?>
 