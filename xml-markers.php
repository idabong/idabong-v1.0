<?php header("Content-type: text/xml");
include('../includes/mysqli_connect_local.php');
include('../includes/functions.php');


function parseToXML($htmlStr)
{
$xmlStr=str_replace('<','&lt;',$htmlStr);
$xmlStr=str_replace('>','&gt;',$xmlStr);
$xmlStr=str_replace('"','&quot;',$xmlStr);
$xmlStr=str_replace("'",'&#39;',$xmlStr);
$xmlStr=str_replace("&",'&amp;',$xmlStr);
return $xmlStr;
}

//Fetch all posts
$query = "SELECT * FROM post WHERE match_date >= CURDATE()";
$result = mysqli_query($db_connect, $query); confirm_query($result, $query);
// Start XML file, echo parent node
echo '<markers>';
if(mysqli_num_rows($result) > 0) {
    // Iterate through the rows, printing XML nodes for each
	while ( $post = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
	  // ADD TO XML DOCUMENT NODE
	  echo '<marker ';
	  echo 'id="'.$post['pid'].'" ';
	  echo 'name="' . parseToXML($post['team_name']) . '" ';
	  echo 'lat="' . $post['latitude'] . '" ';
	  echo 'lng="' . $post['longitude'] . '" ';
	  echo '/>';
	}
} 

// End XML file
echo '</markers>';
?>