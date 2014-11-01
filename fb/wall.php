


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

<?php

$sql="SELECT * from users_friends where friendship_status='FRIENDS' and userid='$userid'";
$sql=mysql_query($sql,$db) or die(mysql_error($db));
$friendsCounter=0; 
	  while($info=mysql_fetch_array($sql))
      {
        $friends_id[$friendsCounter]=$info['friends_id'];
        $friendsCounter++;
         





      }
      
$urlquery='';
for($a=0;$a<$friendsCounter;$a++)
{
$urlquery=$urlquery." userid='".$friends_id[$a]."' OR ";    
}

$urlquery = preg_replace( "/\s[a-z:]+\s$/i", "", $urlquery );
if($friendsCounter==0)
{}
elseif($friendsCounter>=1)
{
$sql="SELECT * FROM users_activity where (".$urlquery.") and access_type='PUBLIC' ORDER BY datetime DESC";
$sql=mysql_query($sql,$db) or die(mysql_error($db));
$count=0;
while($info=mysql_fetch_array($sql)  )
{
    $userid_wall[$count]=$info['userid'];
    $user_name_wall[$count]=$info['user_name'];
    $activity_id_wall[$count]=$info['activity_id'];
    $datetime_wall[$count]=$info['datetime']; 
    $count++;
    
}


for($count_wall=0; $count_wall<$count;$count_wall++)
{
    
    $actid_wall=substr($activity_id_wall[$count_wall],0,3);
    if($actid_wall=='IMG')
{
   
 $sql="SELECT * from users_images where activity_id='$activity_id_wall[$count_wall]'";
 $sql=mysql_query($sql,$db) or die(mysql_error($db)); 
      
	  while($info=mysql_fetch_array($sql))
      {
        
       $image=$info['image'];
       $caption=$info['caption'];
      }
      
 $sql="SELECT * from users_comments where activity_id='$activity_id_wall[$count_wall]' ORDER BY datetime DESC";
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
      
 $sql="SELECT name from user_info where userid='$userid_wall[$count_wall]'";
 $sql=mysql_query($sql,$db) or die(mysql_error($db)); 
      
	  while($info5=mysql_fetch_array($sql))
      {
       $name_wall=$info5['name'];  
      }        
   ?>
   <table height="100" cellspacing="10" style="width:100%;background-color: #e5e5e5;"  >
       <tr ><td style="vertical-align: top;"><table>
       <tr><td><img src="download.php?userid=<?php echo $userid_wall[$count_wall]; ?>&user_name=<?php echo $user_name_wall[$count_wall]; ?>" width="40" height="50"/>
       </td><td><table><tr><td><?php echo $name_wall; ?><br />
       </td></tr>
       <tr><td> Posted On <?php echo $datetime_wall[$count_wall]; ?>       </td></tr>
       </table></td></tr></table> </td></tr>
       <tr><td> 
       <img src="download_wall.php?userid=<?php echo $userid_wall[$count_wall]; ?>&user_name=<?php echo $user_name_wall[$count_wall]; ?>&activity_id=<?php echo $activity_id_wall[$count_wall]; ?>" width="400" height="250"/>  <br /><?php echo $caption;  ?>
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
<input type="hidden" name="id" value="<?php echo $userid_wall[$count_wall];?>"/>

<input type="hidden" name="actid1" value="<?php echo $activity_id_wall[$count_wall];?>"/>
<input type="hidden" name="redir" value="redir"/>
<input type="submit" name="action" value="Comment" style="width: 100px; font-size: medium; background-color: mediumaquamarine;" />
</form>
       
       
       </td></tr>
       
</table>  <?php
}



   elseif($actid_wall=='STS')
{
   
 $sql="SELECT * from users_status where activity_id='$activity_id_wall[$count_wall]'";
 $sql=mysql_query($sql,$db) or die(mysql_error($db)); 
      
	  while($info=mysql_fetch_array($sql))
      {
        
       $status=$info['status'];
       
      }
      
 $sql="SELECT * from users_comments where activity_id='$activity_id_wall[$count_wall]' ORDER BY datetime DESC";
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
      
 $sql="SELECT name from user_info where userid='$userid_wall[$count_wall]'";
 $sql=mysql_query($sql,$db) or die(mysql_error($db)); 
      
	  while($info5=mysql_fetch_array($sql))
      {
       $name_wall=$info5['name'];  
      }        
   ?>
   <table height="100" cellspacing="10" style="width:100%;background-color: #e5e5e5;"  >
       <tr ><td style="vertical-align: top;"><table>
       <tr><td><img src="download.php?userid=<?php echo $userid_wall[$count_wall]; ?>&user_name=<?php echo $user_name_wall[$count_wall]; ?>" width="40" height="50"/>
       </td><td><table><tr><td><?php echo $name_wall; ?><br />
       </td></tr>
       <tr><td> Posted On <?php echo $datetime_wall[$count_wall]; ?>       </td></tr>
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
<input type="hidden" name="id" value="<?php echo $userid_wall[$count_wall];?>"/>
<input type="hidden" name="redir" value="redir"/>
<input type="hidden" name="actid1" value="<?php echo $activity_id_wall[$count_wall];?>"/>
<input type="submit" name="action" value="Comment" style="width: 100px; font-size: medium; background-color: mediumaquamarine;" />
</form>
       
       
       </td></tr>
       
</table>  <?php
}
    
    
    
 }   
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}
?>


    
<table style="width:850px; min-height:500px; vertical-align: top;">
<tr style="vertical-align: top;">
<td>
       
       
       
       
       
       

</td>

</tr>


</table>





















</td></tr>
</table>

</div>





<?php
include('project_footer.php');
?>

