<?php
include('user_header.php');

?>

<table width="100%" cellspacing="5">
<tr><td width="10%">
<div style="background-color: ivory; height:270px">
<img src="download.php?userid=<?php echo $userid;?>&user_name=<?php echo $user_name;?>" border="2" width="100%" height="250">
<br><b>
<?php echo $user_name;?></b>
</div>
</td>
<td width="48%" style="vertical-align: top;">
<div style="background-color: ivory; height:270px">


<?php

$find=strip_tags($_POST['find']);
$sql1="SELECT photo,user_name,userid,name from user_info where name LIKE '$find%' and userid NOT LIKE '$userid'";
	  $sql1=mysql_query($sql1,$db) or die(mysql_error($db));
	  $i=0;
	  if (mysql_num_rows($sql1) > 0)
	  { 
		while($info=mysql_fetch_array($sql1))
		{
			$uname[$i]=$info['user_name'];
			$uid[$i]=$info['userid'];
			$nm[$i]=$info['name'];
            $i++;
		}
		?>
		<br />
		<br />

		<br />
		<br />
		<b>Found Results For '<?php echo $find; ?>'</b>
		<br/>
		</div>
</td>
</tr>
<
</table>
<table width="900" cellspacing="5">



		<?php
		for($j=0;$j<$i;$j++)
		{
		
		
		?>

<tr><td width="150">
<div style="background-color: ivory;">

</div>
</td>

<div style="background-color: ivory; vertical-align:top; ">
	<td width="110" style="vertical-align: top;">
		<a href="visit.php?userid1=<?php echo $uid[$j]; ?>">
		<img src="download.php?userid=<?php echo $uid[$j];?>&user_name=<?php echo $uname[$j];?>" border="2" width="100" height="150"></a>
		</td>
		<td>
		<a href="visit.php?userid1=<?php echo $uid[$j]; ?>">
		<?php echo $nm[$j];
	  
	?>
	</a>
	</td>
	</div>
	</tr>
	<?php
}
?>
	</table>
	
	<?php
	  }
      else
      {
		 ?>
		 <br />
		<br />

		<br />
		<br />
		<b>No Matching Results!!</b>
		<br/>
		</div>
</td>
</tr>
<
</table>
		 
		  
	  <?php
	  }




?>

<?php
include('project_footer.php');
?>
