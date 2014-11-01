<?php

require_once 'db.inc.php';
require_once 'project_http_functions.inc.php';
$db = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD) or
die ('Unable to connect. Check your connection parameters.');

mysql_select_db(MYSQL_DB, $db) or die(mysql_error($db));

$userid = $_GET['userid'];
$user_name = $_GET['user_name'];
$activity_id=$_GET['activity_id'];
  
  if(isset($_GET['userid']) && isset($_GET['user_name'])&& isset($_GET['activity_id']))
  {
    $userid=mysql_real_escape_string($_GET['userid']);
    $activity_id=mysql_real_escape_string($_GET['activity_id']);
    $query= mysql_query("select * from users_images where userid='$userid' and activity_id='$activity_id'");
    while($row = mysql_fetch_assoc($query))
    {   
        $imageData = $row["image"];
    }
    header('content-type: image/jpeg');
    echo $imageData;
  }
  else
  {
   echo ('Error!!'); 
  }






?>





