<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<?php 
include('user_header.php');
require_once 'db.inc.php';
require_once 'project_http_functions.inc.php';

$db = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD) or
    die ('Unable to connect. Check your connection parameters.');

mysql_select_db(MYSQL_DB, $db) or die(mysql_error($db));


echo ('You are currently logged in as :'.$user_name);
echo($userid);

$query= mysql_query("select * from user_info where user_name='$user_name' and userid='$userid'");
    while($row = mysql_fetch_assoc($query))
    {
        $name = $row['name'];
        $sex= $row['sex'];
        $status = $row['status'];
        $interest = $row['interest'];
        $inst12 = $row['inst12'];
        $instgrad = $row['instgrad'];
        $year12 = $row['year12'];
        $yeargrad = $row['yeargrad'];
        $city = $row['city'];
        $state = $row['state'];
        $workexp = $row['workexp'];
        $current_status = $row['current_status'];
        $contact = $row['contact'];
       
    }
?>
<form action="project_transact_user.php" ENCTYPE="multipart/form-data" method="post">
<table style="padding-top: 20px;">
<tr>
<td>
Full Name :
</td>
<td><select name="sex">
<?php if($sex=="Female"){echo '<option >Ms.</option> <option>Mr.</option><option>Mrs.</option>';} elseif($sex=="Male") {echo '<option>Mr.</option><option >Ms.</option> <option>Mrs.</option>';} else{ ?>

<option > Mr. </option>
<option> Ms. </option>
<option> Mrs. </option>
<?php } ?>
</select>
<?php if(strlen($name)>0){?><input type="text" name="name" value="<?php echo $name; ?>" required /><?php } else { ?>
<input type="text" name="name" value required />
<?php } ?>
</td>
</tr>
<tr>
<td>Date Of Birth:</td>
<td><input type="date" name="dob" > </td></tr>
<tr>
<td>
Relationship Status :
</td>
<td>
<select name="status">
<?php if($status=="Single"){echo '<option >Single</option>
 <option>Complicated</option><option>In a Relationship</option>';}
  elseif($status=="Complicated") {echo '<option>Complicated</option><option >Single</option> <option>In a Relationship</option>';}
    elseif($status=="In a Relationship") {echo '<option>In a Relationship</option><option >Single</option> <option>Complicated</option>';}
     else{ ?>
<option>Single</option>
<option>Complicated</option>
<option>In a Relationship</option>
<?php } ?>
</select>
</td>
</tr>
<tr>
<td>
Interested in :
</td>
<td>
<select name="interest">
<?php if($interest=="Women"){echo '<option >Women</option> <option>Men</option>';} elseif($interst=="Men") {echo '<option>Men</option><option >women</option> ';} else{ ?><option>Men</option>
<option>Women</option>
<?php } ?>
</select>
</td>
</tr>


<tr>
<td>
Profile Pic:
</td>
<td>
<input type="file" name="image" />
</td>
</tr>
<tr>
<td>
City :
</td>
<td>
<?php if(strlen($city)>0){?><input type="text" name="city" value="<?php echo $city; ?>" pattern="[a-zA-Z]+" required /><?php } else { ?>
<input type="text" name="city" pattern="[a-zA-Z]+" required />
<?php } ?>

</td>
</tr>
<tr>
<td>
State:
</td>
<td>
<?php if(strlen($state)>0){?><input type="text" name="state" pattern="[a-zA-Z]+" value="<?php echo $state; ?>" required /><?php } else { ?>
<input type="text" name="state" pattern="[a-zA-Z]+" required />
<?php } ?>


</td>
</tr>
<tr>
<td>
Studied at:
</td>
<td>

<?php if(strlen($inst12)>0){?><input type="text" name="inst12" value="<?php echo $inst12; ?>" required /><?php } else { ?>
<input type="text" name="inst12" required />*
<?php } ?>


</td>
<td>
class of :
</td>
<td>

<?php if(strlen($year12)>0){?><input type="text" name="year12" value="<?php echo $year12; ?>" pattern="[0-9]+" required /><?php } else { ?>
<input type="text" name="year12" pattern="[0-9][0-9][0-9][0-9]"required />*
<?php } ?>


</td>
</tr>
<tr>
<td>
Graduated From:
</td>
<td>

<?php if(strlen($instgrad)>0){?><input type="text" name="instgrad" value="<?php echo $instgrad; ?>" required /><?php } else { ?>
<input type="text" name="instgrad" required />*
<?php } ?>


</td>
<td>
class of :
</td>
<td>

<?php if(strlen($yeargrad)>0){?><input type="text" name="yeargrad" value="<?php echo $yeargrad; ?>" pattern="[0-9]+" required /><?php } else { ?>
<input type="text" name="yeargrad" pattern="[0-9][0-9][0-9][0-9]"required />*
<?php } ?>


</td>
</tr>
<tr>
<td>
Current Status:
</td>
<td>

<?php if(strlen($current_status)>0){?><input type="text" name="current_status" value="<?php echo $current_status; ?>" required /><?php } else { ?>
<input type="text" name="current_status" required />*
<?php } ?>


</td>
</tr>
<tr>
<td>
Work Experience:
</td>
<td>

<?php if(strlen($workexp)>0){?><input type="text" name="workexp" value="<?php echo $workexp; ?>" required /><?php } else { ?>
<input type="text" name="workexp" required />*
<?php } ?>


</td>
</tr>
<tr>
<td>
Contact:
</td>
<td>

<?php if(strlen($contact)>0){?><input type="text" name="contact" value="<?php echo $contact; ?>" required /><?php } else { ?>
<input type="text" name="contact" pattern="[0-9]+" />
<?php } ?>


</td>
</tr>
<tr>

<tr>
<td>

</td>
<td>
<input type="submit" name="action" value="Update"/>
</td>
</tr>
<tr>
</table>
</form>

<table><tr><td></td><td><a href="users_homepage.php">Cancel</a></td></tr></table>
</body>
</html>
