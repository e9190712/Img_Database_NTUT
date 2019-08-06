<?php
require('config.php');

// Check for a cookie, if none go to login page
if (!isset($_COOKIE['session_id']))
{
    header('Location: login.php?refer='. urlencode(getenv('REQUEST_URI')));
}

// Try to find a match in the database
$guid = $_COOKIE['session_id'];
$db = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

$query = "SELECT userid FROM susers WHERE guid = '$guid'";
$result = mysqli_query($db, $query);

if (!mysqli_num_rows($result))
{
    // No match for guid
header('Location: login.php?refer='. urlencode(getenv('REQUEST_URI')));
}
?>