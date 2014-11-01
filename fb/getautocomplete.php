<?php
require_once 'db.inc.php';
require_once 'project_http_functions.inc.php';

$db = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD) or
    die ('Unable to connect. Check your connection parameters.');

mysql_select_db(MYSQL_DB, $db) or die(mysql_error($db));

 
 $term=$_GET["term"];
 
 $query=mysql_query("SELECT * FROM user_info where name like '".$term."%' order by name ");
 $json=array();
 
    while($friendfinder=mysql_fetch_array($query)){
         $json[]=array(
                    'value'=> $friendfinder["name"],
                    'label'=>$friendfinder["name"]
                        );
    }
 
 echo json_encode($json);
 
?>
