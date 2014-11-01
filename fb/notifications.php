<?php
include('user_header.php');


require_once 'db.inc.php';
require_once 'project_http_functions.inc.php';

$db = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD) or
    die ('Unable to connect. Check your connection parameters.');

mysql_select_db(MYSQL_DB, $db) or die(mysql_error($db));


echo ('You are currently logged in as :'.$user_name);

$sql="SELECT * from user_info where user_name='$user_name' and userid='$userid'";
$sql=mysql_query($sql,$db) or die(mysql_error($db)); 
	  while($info=mysql_fetch_array($sql))
      {
        $name=$info['name'];
        $workexp=$info['workexp'];
        $instgrad=$info['instgrad'];
        $city=$info['city'];
        $current_status=$info['current_status'];
        $status=$info['status'];
        $dob=mysql_real_escape_string($info['dob']);
        $state=$info['state']; 
      }


?>
<div>
<table width="100%" cellspacing="5">
<tr><td width="10%">
<div style="background-color: ivory; height:270px">
<img src="download.php?userid=<?php echo $userid;?>&user_name=<?php echo $user_name;?>" border="2" width="100%" height="250">
    <br><b>
<?php echo $name;?></b>
</div>
</td>
<td width="48%" style="vertical-align: top;">
<div style="background-color: ivory; height:270px">
What's On Your Mind!!<br />
<form action="project_transact_user.php" method="post">
<textarea name="status" rows="5" cols="1"  style="width:85% ;" required></textarea>
<br />
<select name="access_type"><option value="PUBLIC">Public</option><option value="PRIVATE">Private</option>    </select>
<input type="submit" name="action" value="Post" style="width: 100px; font-size: medium; background-color: mediumaquamarine;" />
</form>
<form action="project_transact_user.php" enctype="multipart/form-data" method="post">
<table style="width: 100%;">
<tr><td>
<input type="file" name="photo" required/>

</td></tr>
<tr><td>

Caption: <textarea name="caption" rows="1" cols="1"  style="width:75% ;" required></textarea>
<br />
<select name="access_type"><option value="PUBLIC">Public</option><option value="PRIVATE">Private</option>    </select>
<input type="submit" name="action" value="Upload" style="width: 100px; font-size: medium; background-color: mediumaquamarine;" />
</td></tr></table>
</form>

</div>
</td>
</tr>
</table>
<table>
<tr>
<td width="300" style="vertical-align: top;">
<table style=" vertical-align: top; background-color: burlywood; ">
<tr width="300" style="background-color:azure;  text-align: center;vertical-align: top; font-family: cursive; font-size: large; font-stretch: extra-expanded "><td width="300">
 About
</td></tr>
<tr style="vertical-align: central;">
<td><br />
<b></b> <?php echo $current_status; ?>
</td>
</tr>
<tr><td style="background-color: gray; height: 0.3px;"></td></tr>
<tr style="vertical-align: central;">
<td><br />
<b>Worked At</b> <?php echo $workexp; ?>
</td>
</tr>
<tr><td style="background-color: gray; height: 0.3px;"></td></tr>
<tr>
<td>
<br />
<b>Studied From</b> <?php echo $instgrad; ?>
</td>
</tr>
<tr><td style="background-color: gray; height: 0.3px;"></td></tr>
<tr>
<td><br />
<b>Lives In </b><?php echo $city; ?>
</td>
</tr>
</table>
<br />

<table style=" vertical-align: top; background-color: burlywood; ">
<tr width="300" style="background-color:azure;  text-align: center;vertical-align: top; font-family: cursive; font-size: large; font-stretch: extra-expanded "><td width="300">
 Personal Details
</td></tr>
<tr style="vertical-align: central;">
<td><br />
<b>Relationship Status </b> <?php echo $status; ?>
</td>
</tr>
<tr><td style="background-color: gray; height: 0.3px;"></td></tr>
<tr style="vertical-align: central;">
<td><br />
<b>Date Of Birth </b> <?php echo $dob; ?>
</td>
</tr>
<tr><td style="background-color: gray; height: 0.3px;"></td></tr>
<tr style="vertical-align: central;">
<td><br />
<b>From </b> <?php echo $state; ?>
</td>
</tr>
<tr><td style="background-color: gray; height: 0.3px;"></td></tr><tr>
</tr>
</table>
</td>

    
<td style="width: 600px;">
<?php
$sql="SELECT * from users_notifications where userid='$userid'";
$sql=mysql_query($sql,$db) or die(mysql_error($db)); 
      $timer=0;
	  while($info=mysql_fetch_array($sql))
      {
       $notification[$timer]=$info['notification'];
       $actid_notf[$timer]=$info['activity_id'];
       $timer++;
      }
      
for($loop=0;$loop<$timer;$loop++)
{
    ?>
    
    <table height="150" cellspacing="20" style="width:100%;background-color: #e5e5e5;vertical-align: top;"  >
       <tr ><td style="vertical-align: top;">
      <form action="viewnotification.php" method="POST">
      <input type="hidden" name="url" value="<?php echo $actid_notf[$loop]; ?>"/>
      <input type="submit" name="action" value="<?php echo $notification[$loop]; ?>"/> 
      
      </form>
       
       
       </td></tr>
      </table> 
    
    <?php
    
}


    
?>



</td></tr>
</table>

</div>





<?php
include('project_footer.php');
?>

