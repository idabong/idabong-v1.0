<?php session_start(); 
include('../includes/mysqli_connect_local.php');
include('../includes/functions.php');


if($_SERVER['REQUEST_METHOD'] == 'GET') {
	
    if(isset($_GET['email']) && filter_var($_GET['email'], FILTER_VALIDATE_EMAIL)) {
    	
        $email = mysqli_real_escape_string($db_connect, trim($_GET['email']));
        //Check if user registered yet
        $query = "SELECT * FROM user WHERE email = '{$email}'";
        $result = mysqli_query($db_connect, $query); confirm_query($result, $query);
        if(mysqli_num_rows($result) == 1) {
        	$userinfo = mysqli_fetch_array($result, MYSQLI_ASSOC); 
        	//Registered user, then log user in
        	$_SESSION['uid'] = $userinfo['uid'];
        	$_SESSION['first_name'] = $userinfo['first_name'];
        	$_SESSION['user_level'] = $userinfo['user_level'];

        	//Ajax announcement
        	echo "YES";
        } else {
        	$first_name = mysqli_real_escape_string($db_connect, trim($_GET['first_name']));
        	$last_name = mysqli_real_escape_string($db_connect, trim($_GET['last_name']));
        	$avatar = mysqli_real_escape_string($db_connect, trim($_GET['avatar']));
        	// Create an back-up password
            $back_up_password = substr(md5(uniqid(rand(), true)), 4, 6);
        	//Insert database new user
        	$query1 = "INSERT INTO user (first_name, last_name, email, avatar, password, registration_time)
                VALUES ('{$first_name}', '{$last_name}', '{$email}', '{$avatar}', SHA1('$back_up_password'),  NOW())";
            $result1 = mysqli_query($db_connect, $query1);
            confirm_query($result1, $query1);
            if(mysqli_affected_rows($db_connect) == 1) {
                // If insert successfully, send activation emmail
                //Prepare 4 variables $from, $to, $subject, $body in order to send Activation mail
		    	$from = 'idabong.com@gmail.com';
		    	$to = $email;
		    	$subject = "Đăng ký tài khoản tại idabong.com";
                $body = 
                "<p>Xin chào <strong>".$first_name."</strong></p>
                <p>Cảm ơn bạn đã đăng ký làm thành viên tại <a href='idabong.com'>idabong.com</a></p>
                <p>Mật khẩu dự phòng trong trường hợp không đăng nhập được bằng facebook hoặc google :</p>".$back_up_password." \n\n ";
                $body .="<div>-------------------</div>
                		<p><i>Nhóm phát triển <a href='http://idabong.com' target='_blank'>idabong.com</a></i></p>
                		<p><i>Email: hotro.idabong@gmail.com</i></p>
                		<p><i>ĐT1 (+84) 971 499 715 - Đại</i></p>
            			<p><i>ĐT2 (+84) 901 188 672 - Văn</i></p>";

                //Create an retrieve to test in Localhost
            	
            	$password_local = "Mật khẩu dự phòng của bạn là: ".$back_up_password;

                //Send mail by custom php function
				if(	
					write_file($password_local)
					//send_mail($from, $to, $subject, $body)
				) { 
                //if email is sent successfully
                	$query2 = "SELECT * FROM user WHERE email = '{$email}'";
        			$result2 = mysqli_query($db_connect, $query2); confirm_query($result2, $query2);
       				if(mysqli_num_rows($result2) == 1) {
			        	$userinfo = mysqli_fetch_array($result2, MYSQLI_ASSOC); 
			        	//Registered user, then log user in
			        	$_SESSION['uid'] = $userinfo['uid'];
			        	$_SESSION['first_name'] = $userinfo['first_name'];
			        	$_SESSION['user_level'] = $userinfo['user_level'];

	        			//Ajax announcement
	        			echo "YES";
        			}
                } else { 
            	//if email was NOT sent
               		echo "NO";
                }
            } else {
	            //If insert database NOT successfully
	          	echo "NO";
            }
        }//End else 
        
    } else {
        echo 'NO';
    }
    
}// END IF GET
?>