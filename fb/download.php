<?php

require_once 'db.inc.php';
require_once 'project_http_functions.inc.php';
$db = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD) or
die ('Unable to connect. Check your connection parameters.');

mysql_select_db(MYSQL_DB, $db) or die(mysql_error($db));

$userid = $_GET['userid'];
$user_name = $_GET['user_name'];
  
  if(isset($_GET['userid']) && isset($_GET['user_name']))
  {
    $userid=mysql_real_escape_string($_GET['userid']);
    $query= mysql_query("select * from user_info where user_name='$user_name' and userid='$userid'");
    while($row = mysql_fetch_assoc($query))
    {
        $imageData = $row["photo"];
    }
    header('content-type: image/jpeg');
    echo $imageData;
  }
  else
  {
   echo ('Error!!'); 
  }






?>





