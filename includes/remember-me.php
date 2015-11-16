<?php
function GenerateRandomToken($length) {
	//Create sercue token with specific length
	return bin2hex(random_bytes($length));
}

function onLogin($user) {
	//Change $db_connect scope 
	global $db_connect;

	// generate a token, should be 128 - 256 bit
    $token = GenerateRandomToken(32); 

    //Store token for user
    $query = "UPDATE user SET kep_logined = '{$token}' WHERE uid = $user LIMIT 1";
    $result = mysqli_query($db_connect, $query); confirm_query($result, $query);
    if(mysqli_affected_rows($db_connect) == 1) {
        $cookie = $user . ':' . $token;
        //Generate a key hash value
        $mac = hash_hmac('sha256', $cookie, SECRET_KEY);
        $cookie .= ':' . $mac;
        //Set cookie expired after 1 hour.
        setcookie('rememberme', $cookie, time()+3600);
    }
    
}

function rememberMe() {
    $cookie = isset($_COOKIE['rememberme']) ? $_COOKIE['rememberme'] : '';
    if ($cookie) {
        list ($user, $token, $mac) = explode(':', $cookie);
        if (timingSafeCompare(hash_hmac('sha256', $user . ':' . $token, SECRET_KEY), $mac)) {
            return false;
        }
        //Fetch user token
        $query = "SELECT keep_logined FROM user WHERE uid = $user";
        $result = mysqli_query($db_connect, $query); confirm_query($result, $query);
        if(mysqli_num_rows($result) == 1) {
            list($usertoken) = mysqli_fetch_array($result, MYSQLI_NUM);
        } else {
            $usertoken = NULL;
        }
        
        if (timingSafeCompare($usertoken, $token)) {
            //Log user in
            // Fetch user's information
            $userInfo = fetch_user($user);
            //replace the current session id with a new one
            session_regenerate_id();
            //If login success, store user's info into SESSION
            $_SESSION['uid'] = $userInfo['uid'];
            $_SESSION['first_name'] = $userInfo['first_name'];
            $_SESSION['user_level'] = $userInfo['user_level']
        }
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

    // Note that we ALWAYS iterate over the user-supplied length
    // This is to prevent leaking length information
    for ($i = 0; $i < $userLen; $i++) {
        // Using % here is a trick to prevent notices
        // It's safe, since if the lengths are different
        // $result is already non-0
        $result |= (ord($safe[$i % $safeLen]) ^ ord($user[$i]));
    }

    // They are only identical strings if $result is exactly 0...
    return $result === 0;
}
?>