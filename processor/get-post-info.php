<?php include('../includes/mysqli_connect_local.php');
include('../includes/functions.php');
if(isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT)) {

    $pid = mysqli_real_escape_string($db_connect,$_GET['id']);

	// Insert user's info into database
    $query = "SELECT * FROM post WHERE pid = {$pid}";
    $result = mysqli_query($db_connect, $query);
    if(mysqli_num_rows($result) == 1) {
        $post = mysqli_fetch_array($result, MYSQLI_ASSOC);

        //If post is posted by registered user, fetch team
        if(isset($post['uid'])) {
            $team = fetch_team($post['uid']);
        }

        echo "<div class='media'>
                    <div class='media-left'>                      
                            <img src='";
        echo isset($team['avatar']) ? $team['avatar'] : 'css/images/team-default-avatar-2.png'; 
        echo            "' style='width: 64px; height: 64px' alt='team avatar'>
                    </div>

                        <div class='media-body'>
                            <h4 class='media-heading text-success'><strong>{$post['team_name']}</strong></h4>
                            <div id='rating'>";
                                if(isset($team['rating'])) {show_rating($team['rating']);} else {show_rating(null);};                
        echo                "</div>
                        </div>
                </div><!--end div.media-->

                <p class='text' ><strong>Thể thức</strong>: {$post['type']}</p>
                <p class='text'><strong>Ngày</strong>:  <span class='text-danger'>";
        echo        date("d-m-Y", strtotime($post['match_date']));
        echo        "</span> 
                <p class='text'><strong>Giờ</strong>: <span class='text-danger'>{$post['start_time']}</span> đến <span class='text-danger'>{$post['end_time']}</span></p>
                <p class='text'><strong>Sân Thi Đấu</strong>: {$post['ground_name']}</p>
                <p class='text'><strong>Liên Hệ</strong>: {$post['phone']} - <span>{$post['contact_name']}</span></p>";

    } else {
    	echo 'NO';
    }
	
    
}



?>