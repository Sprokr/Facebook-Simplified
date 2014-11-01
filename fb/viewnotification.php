<?php
require_once 'db.inc.php';
require_once 'project_http_functions.inc.php';

$db = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD) or
    die ('Unable to connect. Check your connection parameters.');

mysql_select_db(MYSQL_DB, $db) or die(mysql_error($db));

if (isset($_REQUEST['action'])) 
{
  $url=$_POST['url'];
  ?>
  
  
  <?php
include('user_header.php');





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
$url1=substr($url,0,3);
if($url1=='IMG')
{
 $sql="SELECT * from users_images where activity_id='$url'";
 $sql=mysql_query($sql,$db) or die(mysql_error($db)); 
      
	  while($info=mysql_fetch_array($sql))
      {
        
       $image=$info['image'];
       $caption=$info['caption'];
      }
      
 $sql="SELECT * from users_comments where activity_id='$url' ORDER BY datetime DESC";
 $sql=mysql_query($sql,$db) or die(mysql_error($db)); 
      $comment_counter=0;
	  while($info=mysql_fetch_array($sql))
      {
       $comments[$comment_counter]=$info['comments'];
       $commenter_id[$comment_counter]=$info['commenter_id'];
       $sql1="SELECT name from user_info where userid='$commenter_id[$comment_counter]'";
       $sql1=mysql_query($sql1,$db) or die(mysql_error($db));
        while($info2=mysql_fetch_array($sql1))
        {
            $commenter_name[$comment_counter]=$info2['name'];
        }
             
       $comment_counter++;
      }
   ?>
   <table height="100" cellspacing="10" style="width:100%;background-color: #e5e5e5;"  >
       <tr ><td style="vertical-align: top;"><table>
       <tr><td><img src="download.php?userid=<?php echo $userid; ?>&user_name=<?php echo $user_name; ?>" width="40" height="50"/>
       </td><td><table><tr><td><?php echo $name; ?><br />
       </td></tr>
       </table></td></tr></table> </td></tr>
       <tr><td> 
       <img src="download_wall.php?userid=<?php echo $userid; ?>&user_name=<?php echo $user_name; ?>&activity_id=<?php echo $url; ?>" width="400" height="250"/>  <br /><?php echo $caption;  ?>
       </td></tr>
<?php   
for($loop=0;$loop<$comment_counter;$loop++)
{
    ?>
    
       <tr ><td style="vertical-align: top;">
       
       <b><?php echo $commenter_name[$loop]; ?> </b> : <?php echo $comments[$loop]; ?>
       </td></tr>
      
    
    <?php
    
}
?> 
<tr><td> 
       <form action="project_transact_user.php" method="post">
<textarea name="comment" rows="2" cols="1"  style="width:85% ;" required></textarea>
<br />
<input type="hidden" name="id" value="<?php echo $userid;?>"/>

<input type="hidden" name="actid1" value="<?php echo $url;?>"/>
<input type="submit" name="action" value="Comment" style="width: 100px; font-size: medium; background-color: mediumaquamarine;" />
</form>
       
       
       </td></tr>
       
</table>  <?php
}
// If status


elseif($url1=='STS')
{
 $sql="SELECT * from users_status where userid='$userid' and activity_id='$url'";
 $sql=mysql_query($sql,$db) or die(mysql_error($db)); 
      
	  while($info=mysql_fetch_array($sql))
      {
       $status=$info['status'];
       
      }
 $sql="SELECT * from users_comments where activity_id='$url' ORDER BY datetime DESC";
 $sql=mysql_query($sql,$db) or die(mysql_error($db)); 
      $comment_counter=0;
	  while($info=mysql_fetch_array($sql))
      {
       $comments[$comment_counter]=$info['comments'];
       $commenter_id[$comment_counter]=$info['commenter_id'];
       $sql1="SELECT name from user_info where userid='$commenter_id[$comment_counter]'";
       $sql1=mysql_query($sql1,$db) or die(mysql_error($db));
        while($info2=mysql_fetch_array($sql1))
        {
            $commenter_name[$comment_counter]=$info2['name'];
        }
             
       $comment_counter++;
      }
   ?>
   <table height="100" cellspacing="10" style="width:100%;background-color: #e5e5e5;"  >
       <tr ><td style="vertical-align: top;"><table>
       <tr><td><img src="download.php?userid=<?php echo $userid; ?>&user_name=<?php echo $user_name; ?>" width="40" height="50"/>
       </td><td><table><tr><td><?php echo $name; ?><br />
       </td></tr>
       </table></td></tr></table> </td></tr>
       <tr><td> 
       <br /><?php echo $status;  ?>
       </td></tr>
<?php   
for($loop=0;$loop<$comment_counter;$loop++)
{
    ?>
    
       <tr ><td style="vertical-align: top;">
       
       <b><?php echo $commenter_name[$loop]; ?> </b> : <?php echo $comments[$loop]; ?>
       </td></tr>
      
    
    <?php
    
}
?>
<tr><td> 
       <form action="project_transact_user.php" method="post">
<textarea name="comment" rows="2" cols="1"  style="width:85% ;" required></textarea>
<br />
<input type="hidden" name="id" value="<?php echo $userid;?>"/>

<input type="hidden" name="actid1" value="<?php echo $url;?>"/>
<input type="submit" name="action" value="Comment" style="width: 100px; font-size: medium; background-color: mediumaquamarine;" />
</form>
       
       
       </td></tr>
       
</table> 
<?php
}

elseif($url1=='FRD')
{
    $id=substr($url,4,1);
    $link='visit.php?userid1='.$id;
    ?>
    <script type="text/javascript"> window.location.href = "<?= $link;  ?>"; </script>
    <?php
    
}

elseif($url1=='ACC')
{
    $id=substr($url,3,1);
    $link='visit.php?userid1='.$id;
    ?>
    <script type="text/javascript"> window.location.href = "<?= $link;  ?>"; </script>
    <?php
    
}





    
?>



</td></tr>
</table>

</div>





<?php
mysql_query("DELETE FROM users_notifications WHERE activity_id='$url' and userid='$userid'") or die(mysql_error($db));



include('project_footer.php');
?>

  
    
    
    
    
    
    
    
    
    
    
    
    
    
<?php    

}
?>    