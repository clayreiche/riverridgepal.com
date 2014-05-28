<?php
//query facebook
$wpPath = $_GET['path'];
require_once( $wpPath . '/wp-config.php' );
global $wpdb;
$table_name = $wpdb->prefix . "options";
//Get Access token
$query = "
	SELECT option_value
	FROM $table_name
	WHERE option_name='cff_access_token'
	";
$result = mysql_query($query) or die(mysql_error());
while ($row = mysql_fetch_assoc( $result)) {
    $access_token = $row['option_value'];
}
//Get Post ID
$post_id = $_GET['id'];
//Which meta type should we query?
$metaType = $_GET['type'];
if ($metaType == 'likes'){
    $row = 'like_info';
    $cell = 'like_count';
} else if ($metaType == 'comments'){
    $row = 'comment_info';
    $cell = 'comment_count';
}
$json_object = cff_fetchUrl("https://graph.facebook.com/fql?q=SELECT%20" . $row . "%20FROM%20stream%20WHERE%20post_id='" . $post_id . "'%20&access_token=" . $access_token);
$FBdata = json_decode($json_object);
foreach ($FBdata->data as $news ){
	echo $news->$row->$cell;
}
?>