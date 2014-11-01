<?php
include('project_header.php');
require_once 'db.inc.php';
require_once 'project_http_functions.inc.php';

$db = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD) or
    die ('Unable to connect. Check your connection parameters.');

mysql_select_db(MYSQL_DB, $db) or die(mysql_error($db));


?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>New User Registration</title>
</head>

<body>
<table >
<tr height="100%" >
<td width="475" height="408" background="img/registration1.jpg  "> 
<h1><b><u>Registration Form</u></b></h1>
</td>

<form action="project_transact_user.php" method="POST">
      <td width="425"  bgcolor="#996699">
<table>
<tr><td> Crete Account </td> <td></td></tr>
<tr><td> Gender :</td> <td>Male:<input type="radio" name="gender" value="male" required  />   Female:<input type="radio" name="gender" value="female"   /></td></tr>
<tr><td> User Name :</td> <td><input type="text" name="user_name" required pattern="^[a-zA-Z][a-zA-Z0-9-_\.]{1,20}$" /></td></tr>
<tr><td> Full Name :</td> <td><input type="text" name="name" required  /></td></tr>
<tr><td> Email Address :</td><td><input type="email" name="email" required /></td></tr>
<tr><td> Password :</td><td><input type="password" name="password" required pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" /></td></tr>
<tr><td> Re-enter Password :</td><td><input type="password" name="password1" required /></td></tr>
<tr><td> </td><td><input type="submit" name="action" value="Register" /></td></tr>


</table>


</td>
</form>
</tr>
</table>
<?php include('project_footer.php');?>
</body>
</html>