<?php 

require_once 'db.inc.php';
require_once 'project_http_functions.inc.php';

$db = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD) or
    die ('Unable to connect. Check your connection parameters.');

mysql_select_db(MYSQL_DB, $db) or die(mysql_error($db));

session_start();

     

       if(!isset($_SESSION['user_name'] ) && !isset($_SESSION['userid']) )
       {
       redirect('index.php');
       } 

       $user_name=$_SESSION['user_name'];
	   $userid=$_SESSION['userid'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript"
        src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
        <script type="text/javascript"
        src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
        <link rel="stylesheet" type="text/css"
        href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" />
 
        <script type="text/javascript">
                $(document).ready(function(){
                    $("#find").autocomplete({
                        source:'getautocomplete.php',
                        minLength:1
                    });
                });
        </script>	
	
	
	
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $user_name;?>'s Home Page</title>
</head>

<body style="background-color: burlywood;" >
<div style="background-color: beige; width:900px; min-height: 500px; margin-top: 30px;margin-left: auto;margin-right: auto; padding-left: 30px;padding-right: 30px;padding-top: 30px;" >

<table height="150" width="900"style="background-color: #6495ed;;">
<tr><td style="font-family: fantasy; font-size: xx-large;">
 <u>Simplified Facebook</u>
</td>
<td style="vertical-align:top;">
<form action="find_friends.php" method="post"><input type="text" id="find" name="find"><input type="submit" name="action" value="Search" ></form>
</td>
</tr>
<tr style="vertical-align: bottom;"><td>
<table>
<tr style="vertical-align: bottom;"><td style="background-color:  #99ccff; width:100px; text-align: center;"><a href="users_homepage.php" style="text-decoration: none !important;"><button type="button" style=" width: 100px; height: 35px; ">Home Page</button></a></td>
<td style="background-color:  #99ccff; width:250px; text-align: center;"><a href="update_info.php" style="text-decoration: none !important;"><button type="button" style="width: 250px; height: 35px;">Update Personal Information</button></a></td>
<td style="background-color:  #99ccff; width:100px; text-align: center;"><a href="wall.php" style="text-decoration: none !important;"><button type="button" style="width: 100px; height: 35px; ">The Wall</button></a></td>
<?php
$countNotifications=0;
$sql="SELECT COUNT(activity_id) as count from users_notifications where userid='$userid'";
$sql=mysql_query($sql,$db) or die(mysql_error($db)); 

	  while($info=mysql_fetch_array($sql))
      {
       $countNotifications=$info['count'];
      }
if($countNotifications>0)       
{
?>
<td style="background-color:  #99ccff; width:100px; text-align: center;">
<form action="notifications.php" method="post"> 
<input type="submit" value="<?php echo $countNotifications;?> New Notifications" style="text-decoration: none !important;width: 150px; height: 35px;"/>
</form>
</td>
<?php
}
?>

<td style="background-color:  #99ccff; width:100px; text-align: center;"><a href="logout.php" style="text-decoration: none !important;"><button type="button" style="width: 100px; height: 35px; ">Log Out</button></a></td></tr>
</table>
</td></tr>
</table>




