<?php
require('project_http_functions.inc.php');




session_start();

       if(isset($_SESSION['user_name'] ) && isset($_SESSION['userid']) )
       {
       $user_name=$_SESSION['user_name'];
       $userid=$_SESSION['userid'];
       redirect('users_homepage.php');
       } 
          

 ?>
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Simplified Facebook</title>
</head>

<body style="background-color: burlywood;" >
<div style="background-color: beige; width:900px; min-height: 500px; margin-top: 30px;margin-left: auto;margin-right: auto; padding-left: 30px;padding-right: 30px;padding-top: 30px;" >
<table height="150" width="900"style="background-color: #6495ed;;">
<tr><td style="font-family: fantasy; font-size: xx-large;">
 <u>Simplified Facebook</u>
</td></tr>
<tr style="vertical-align: bottom;"><td>
<table>
<tr style="vertical-align: bottom;"><td style="background-color:  #99ccff; width:100px; text-align: center;"><a href="index.php" style="text-decoration: none !important;"><button type="button" style=" width: 100px; height: 35px; ">Home Page</button></a></td>
</table>
</td></tr>
</table>




