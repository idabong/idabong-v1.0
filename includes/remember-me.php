<?php
function onLogin($user) {
	//Change $db_connect scope 
	global $db_connect;

	// generate a token, should be 128 - 256 bit
    $token = md5(uniqid(rand(), true)); 

    //Store token for user
    $query = "UPDATE user SET remember_me = '{$token}' WHERE uid = {$user} LIMIT 1";
    $result = mysqli_query($db_connect, $query);
    if(mysqli_affected_rows($db_connect) == 1) {
        $cookie = $user . ':' . $token;
        //Generate a key hash value
        $mac = hash_hmac('sha256', $cookie, 'OJ3p2qoKDNjG48N0ku4JSpor4v7o0iGn');
        $cookie .= ':' . $mac;
        //Set cookie expired after 1 hour.
        setcookie('rememberme', $cookie, time()+31536000);
    }
    
}

/**
 * A timing safe equals comparison
 *
 * To prevent leaking length information, it is important
 * that user input is always used as the second parameter.
 *
 * @param string $safe The internal (safe) value to be checked
 * @param string $user The user submitted (unsafe) value
 *
 * @return boolean True if the two strings are identical.
 */
function timingSafeCompare($safe, $user) {
    // Prevent issues if string length is 0
    $safe .= chr(0);
    $user .= chr(0);

    $safeLen = strlen($safe);
    $userLen = strlen($user);

    // Set the result to the difference between the lengths
    $result = $safeLen - $userLen;

    if($result != 0) {
        // Note that we ALWAYS iterate over the user-supplied length
        // This is to prevent leaking length information
        for ($i = 0; $i < $userLen; $i++) {
            // Using % here is a trick to prevent notices
            // It's safe, since if the lengths are different
            // $result is already non-0
            return $result |= (ord($safe[$i % $safeLen]) ^ ord($user[$i]));
        }
    } else {
        // They are only identical strings if $result is exactly 0...
        return $result === NULL;
    }

}


function rememberMe() {
    
    //Change $db_connect scope 
    global $db_connect;

    if(isset($_COOKIE['rememberme'])) {
        $cookie = $_COOKIE['rememberme'];

    } else {
        $cookie = NULL;
    }

    if ($cookie) {
        list ($user, $token, $mac) = explode(':', $cookie);
        

        if (timingSafeCompare(hash_hmac('sha256', $user . ':' . $token, 'OJ3p2qoKDNjG48N0ku4JSpor4v7o0iGn'), $mac)) {
            //Fetch user token         
            return false;
        }   

        $query1 = "SELECT remember_me FROM user WHERE uid = '{$user}'";
        $result1 = mysqli_query($db_connect, $query1); 
        if(mysqli_num_rows($result1) == 1) {
            list($usertoken) = mysqli_fetch_array($result1, MYSQLI_NUM);
            
        } else {
            $usertoken = NULL;
        }
        
        if (!timingSafeCompare($usertoken, $token)) {
            
            //Log user in
            // Fetch user's information
            return $userInfo = fetch_user($user);
            //replace the current session id with a new one
            session_regenerate_id();

        }
    }
}


?>