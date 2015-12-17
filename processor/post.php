<?php include('../includes/mysqli_connect_local.php');
include('../includes/functions.php');
if(isset($_POST['json'])) {
	//Decode json data
	$data = json_decode($_POST['json']);

	//Create error flag
	$errors = array();

	//Validate groundName
    if(preg_match('/^[a-z0-9A-Z_ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ \'-]{2,60}$/u', $data->groundName)) {
        $groundName = mysqli_real_escape_string($db_connect, $data->groundName);
    } else {
        $errors[] = 'groundName';
    }

    //Validate teamName
    if(preg_match('/^[a-z0-9A-Z_ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ \'-]{2,60}$/u', $data->teamName)) {
        $teamName = mysqli_real_escape_string($db_connect, $data->teamName);
    } else {
        $errors[] = 'groundName';
    }

	//Validate type
    if(filter_var($data->type, FILTER_VALIDATE_INT)) {
        $type = mysqli_real_escape_string($db_connect, $data->type);
    } else {
        $errors[] = 'type';
    }

    //Validate date
    if(preg_match('/^[0-9]{2}\/[0-9]{2}\/[0-9]{4}$/', $data->date)) {
        $originDate = mysqli_real_escape_string($db_connect, $data->date);
	    //Convert date format to store in database
		list($date, $month, $year) = explode('/', $originDate);
		$match_date = $year.'-'.$month.'-'.$date;
    } else {
        $errors[] = 'date';
    }

	//Validate start time
    if(preg_match('/^[0-9]{2}:[0-9]{2}$/', $data->start_time)) {
        $start_time = mysqli_real_escape_string($db_connect, $data->start_time);
	    //Convert date format to store in database
		$start_time = $start_time.':00';
    } else {
        $errors[] = 'start_time';
    }

    //Validate end time
    if(preg_match('/^[0-9]{2}:[0-9]{2}$/', $data->end_time)) {
        $end_time = mysqli_real_escape_string($db_connect, $data->end_time);
	    //Convert date format to store in database
		$end_time = $end_time.':00';
    } else {
        $errors[] = 'end_time';
    }

    //Validate teamName
    if(preg_match('/^[a-z0-9A-Z_ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ \'-]{2,60}$/u', $data->contactName)) {
        $contactName = mysqli_real_escape_string($db_connect, $data->teamName);
    } else {
        $errors[] = 'contactName';
    }

    //Validate tel
    if(filter_var($data->tel, FILTER_VALIDATE_INT)) {
        $tel = mysqli_real_escape_string($db_connect, $data->tel);
    } else {
        $errors[] = 'tel';
    }

    //Validate latitude
    if(filter_var($data->latitude, FILTER_VALIDATE_FLOAT)) {
        $latitude = mysqli_real_escape_string($db_connect, $data->latitude);
    } else {
        $errors[] = 'latitude';
    }

    //Validate longitude
    if(filter_var($data->longitude, FILTER_VALIDATE_FLOAT)) {
        $longitude = mysqli_real_escape_string($db_connect, $data->longitude);
    } else {
        $errors[] = 'longitude';
    }

    if(empty($errors)) {
    	// Insert user's info into database
	   $query = "INSERT INTO post (ground_name, team_name, type, match_date, start_time, end_time, contact_name, phone, latitude, longitude, post_time)
	        VALUES ('{$groundName}','{$teamName}', '{$type}', '{$match_date}', '{$start_time}', '{$end_time}', '{$contactName}', '{$tel}', {$latitude}, {$longitude}, NOW())";
	    $result = mysqli_query($db_connect, $query); confirm_query($result, $query);
	    if(mysqli_affected_rows($db_connect) == 1) {
	        echo 'YES';
	    } else {
	        echo 'NO';
	    }
    } else {
    	echo 'NO';
    }
	
    
}



?>