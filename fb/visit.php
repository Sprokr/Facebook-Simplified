



<?php
include('user_header.php');
require_once 'db.inc.php';
require_once 'project_http_functions.inc.php';

$db = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD) or
    die ('Unable to connect. Check your connection parameters.');

mysql_select_db(MYSQL_DB, $db) or die(mysql_error($db));


echo ('You are currently logged in as :'.$user_name);
$userid1=$_GET['userid1'];
if($userid1==$userid){
    redirect('users_homepage.php');
}
//$user_name1=$_GET['user_name1'];
$sql="SELECT * from user_info where userid='$userid1'";
$sql=mysql_query($sql,$db) or die(mysql_error($db)); 
	  while($info=mysql_fetch_array($sql))
      {
        $user_name1=$info['user_name'];
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
<img src="download.php?userid=<?php echo $userid1;?>&user_name=<?php echo $user_name1;?>" border="2" width="100%" height="240">
<br>
<table width="100%"><tr><td><b><?php echo $name;?></b></td>
<td style="text-align: right;">
<?php 
$isFriend=0;
//$isFriends=0 => Not Friends
//$isFriends=1 => Friends
//$isFriends=2 => Another Person Requested
//$isFriends=3 => User Requested
$sql="SELECT * from users_friends where userid='$userid1' and friends_id='$userid'";
$sql=mysql_query($sql,$db) or die(mysql_error($db)); 
	  while($info=mysql_fetch_array($sql))
      {
       $fstatus=$info['friendship_status'];
       if($fstatus=='FRIENDS')
       {
        $isFriend=1;
       }
       elseif($fstatus=='REQUESTED')
       {
        $isFriend=2;
       }
       elseif($fstatus=='GOTREQUEST')
       {
        $isFriend=3;
       }
      }
$sql="SELECT * from users_friends where userid='$userid' and friends_id='$userid1'";
$sql=mysql_query($sql,$db) or die(mysql_error($db)); 
	  while($info=mysql_fetch_array($sql))
      {
       $fstatus=$info['friendship_status'];
       if($fstatus=='FRIENDS')
       {
        $isFriend=1;
       }
       elseif($fstatus=='REQUESTED')
       {
        $isFriend=3;
       }
       elseif($fstatus=='GOTREQUEST')
       {
        $isFriend=2;
       }
      
      }
            
      
 if($isFriend==0)
 {     
?>

<form action="project_transact_user.php" method="post">
<input type="hidden" name="userid1" value="<?php echo $userid1;?>"/>
<input type="hidden" name="url" value="<?php echo substr($_SERVER["REQUEST_URI"],4);?>"/>
<input type="submit" name="action" style=" width: 100px; height: 25px; text-decoration: none !important;" value="Add Friend">
</form>
<?php
}
elseif($isFriend==1)
{

?>
<button style=" width: 100px; height: 25px; text-decoration: none !important;" > Friends </button>
<?php
}
elseif($isFriend==2)
{

?>
<form action="project_transact_user.php" method="post">
<input type="hidden" name="userid1" value="<?php echo $userid1;?>"/>
<input type="hidden" name="url" value="<?php echo substr($_SERVER["REQUEST_URI"],4);?>"/>
<input type="submit" name="action" style=" width: 250px; height: 25px; text-decoration: none !important;" value="Accept Friend Request">
</form>
<?php
}
elseif($isFriend==3)
{

?>
<button style=" width: 250px; height: 25px; text-decoration: none !important;" >Friend Request Sent </button>
<?php
}
?>
</td></tr></table>



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

<br />


<?php //  Friends Pics ?>
<table style=" vertical-align: top; background-color: burlywood; ">
<tr width="300" style="background-color:azure;  text-align: center;vertical-align: top; font-family: cursive; font-size: large; font-stretch: extra-expanded "><td width="300">
 Friends
</td></tr>
<?php  

$sql="SELECT * from users_friends where userid='$userid1' and friendship_status='FRIENDS'";
$sql=mysql_query($sql,$db) or die(mysql_error($db)); 
	  $fcounter=0;
?>
<tr style="vertical-align: central;">
<?php
      while($info=mysql_fetch_array($sql))
      {
        $friends_id[$fcounter]=$info['friends_id'];
        $fcounter++;
      }
       $div=0;
       for($loop=0;$loop<$fcounter;$loop++)
       {
         $sql1="SELECT * from user_info where userid='$friends_id[$loop]'";
         $sql1=mysql_query($sql1,$db) or die(mysql_error($db)); 
	  
           while($info1=mysql_fetch_array($sql1))
           {
              $friends_name=$info1['name'];
              $friends_user_name=$info1['user_name'];
              $friends_id_e=$info1['userid'];
              
              
           }


               ?>
               <td><a href="visit.php?userid1=<?= $friends_id_e; ?>"><button>
               <img src="download.php?userid=<?= $friends_id_e; ?>&user_name=<?= $friends_user_name; ?>" height="150" width="130"/><br />
               <?php echo $friends_name; ?></a>
               </button>
               </td>              
              
              <?php
              $div++;
              if($div=='2' || $div=='4'|| $div=='6'|| $div=='8'|| $div=='10')
              {
                ?>
                </tr>
                 <tr style="vertical-align: central;">
                <?php
              } 
         
         
       }       
 ?>



</tr>
</table>



</td>


    
<td style="width: 600px;">
<?php
$status='';
$i=0;


$sql="SELECT * from users_activity where user_name='$user_name1' and userid='$userid1' and access_type='PUBLIC' and (activity_id LIKE 'IMG%' or activity_id LIKE 'STS%') ORDER BY datetime DESC";
	  $sql=mysql_query($sql,$db) or die(mysql_error($db)); 
	  while($info=mysql_fetch_array($sql))
	  {
	   $actid[$i]=$info['activity_id'];

       $i++;
       
      }

for($j=0;$j<$i;$j++)
{
    $acttype=substr($actid[$j],0,3);
    
    $sql="SELECT * from users_activity where activity_id='$actid[$j]' and userid='$userid1'  ";
	  $sql=mysql_query($sql,$db) or die(mysql_error($db)); 
	  while($info=mysql_fetch_array($sql))
	  {
	   $user_namex[$j]=$info['user_name'];
       $existcomments[$j]=$info['comments'];
       $access_type[$j]=$info['access_type']; 
      }
    $sql="SELECT * from user_info where userid='$userid1' ";
	  $sql=mysql_query($sql,$db) or die(mysql_error($db)); 
	  while($info=mysql_fetch_array($sql))
	  {
	   $name1[$j]=$info['name'];
      }
      

      
    if($acttype=='IMG')
    {
            $sql="SELECT * from users_images where activity_id='$actid[$j]' and userid='$userid1' ";
	  $sql=mysql_query($sql,$db) or die(mysql_error($db)); 
	 $status[$j]='0';
      while($info=mysql_fetch_array($sql))
	  {
	   $image[$j]=$info['image'];
  
       $caption[$j]=$info['caption'];
  
       $datetime[$j]=$info['datetime'];
        
      }
      
      
    }  
      elseif($acttype=='STS')
    {
     
      $sql="SELECT * from users_status where activity_id='$actid[$j]' and userid='$userid1' ";
	  $sql=mysql_query($sql,$db) or die(mysql_error($db)); 
	  $image[$j]='0';
      while($info=mysql_fetch_array($sql))
	  {
	   $status[$j]=$info['status'];
       $datetime[$j]=$info['datetime'];
       
      } 

    }
}




for($j=0;$j<$i;$j++)
{
  ?>
       
       <table height="100" cellspacing="10" style="width:100%;background-color: #e5e5e5;"  >
       <tr ><td style="vertical-align: top;"><table>
       <tr><td><img src="download.php?userid=<?php echo $userid1; ?>&user_name=<?php echo $user_namex[$j]; ?>" width="40" height="50"/>
       </td><td><table><tr><td><?php echo $name1[$j]; ?><br />
       </td></tr><tr><td> Posted On <?php echo $datetime[$j]; ?>
       </td></tr></table></td></tr></table> </td></tr>
       <tr><td> <?php  if ($image[$j]=='0') {echo $status[$j];}   elseif($status[$j]=='0') {  ?> 
       
       <img src="download_wall.php?userid=<?php echo $userid1; ?>&user_name=<?php echo $user_namex[$j]; ?>&activity_id=<?php echo $actid[$j]; ?>" width="400" height="250"/>  <br /><?php echo $caption[$j]; } ?>
       </td></tr>
       <?php
            if($existcomments[$j]=='YES')
        {
            $s=0;
            
            $sql="SELECT * from users_comments where activity_id='$actid[$j]' ORDER BY datetime DESC  ";
	           $sql=mysql_query($sql,$db) or die(mysql_error($db));
        while($info=mysql_fetch_array($sql))
       {
	   $cmt[$s]=$info['comments'];
       $commenter_id[$s]=$info['commenter_id'];
       $s++;
       }     
       for($w=0;$w<$s;$w++) 
        {
            
            $sql="SELECT name from user_info where userid='$commenter_id[$w]'";
	           $sql=mysql_query($sql,$db) or die(mysql_error($db));
        while($info=mysql_fetch_array($sql))
       {
        $commentername=$info['name'];
        }
          ?>
          
          <tr ><td><b><?php echo $commentername; ?> </b> : <?php echo $cmt[$w] ?></td></tr>
            
         <?php   
        }
            
            
        }
        
        
      
       ?>
       <tr><td> 
       <form action="project_transact_user.php" method="post">
<textarea name="comment" rows="2" cols="1"  style="width:85% ;" required></textarea>
<br />
<input type="hidden" name="id" value="<?php echo $userid1;?>"/>
<input type="hidden" name="url" value="<?php echo substr($_SERVER["REQUEST_URI"],4);?>"/>
 
<input type="hidden" name="actid1" value="<?php echo $actid[$j];?>"/>
<input type="submit" name="action" value="Comment" style="width: 100px; font-size: medium; background-color: mediumaquamarine;" />
</form>
       
       
       </td></tr>
       
       </table>
      <br />
       <?php
     
//echo $status[$i];

}


?>


</td></tr>
</table>

</div>





<?php
include('project_footer.php');
?>

