<html><body>
<?php
require_once 'db.inc.php';
require_once 'project_http_functions.inc.php';

$db = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD) or
    die ('Unable to connect. Check your connection parameters.');

mysql_select_db(MYSQL_DB, $db) or die(mysql_error($db));

if (isset($_REQUEST['action'])) {

	switch ($_REQUEST['action']) {


// User Register Section
case 'Register':
    $user_name=strip_tags($_POST['user_name']);
    $name=strip_tags($_POST['name']);
	$email=strip_tags($_POST['email']);
	$pwd=strip_tags($_POST['password']);
	$pwd1=strip_tags($_POST['password1']);
	if($pwd!=$pwd1)
	{
	echo ('Password Mismatch.... ');?>
	<a href="registration.php">Retry</a> 
	<?php	
	}
     else
	 {
	  $sql="SELECT user_name from users where user_name='$user_name'";
	  $sql=mysql_query($sql,$db) or die(mysql_error($db)); 
	  $sql1="SELECT email from users where email='$email'";
	  $sql1=mysql_query($sql1,$db) or die(mysql_error($db));
	  	  if (mysql_num_rows($sql) > 0)
	  { echo ('User Name Already Exist... ');?>
	  <a href="registration.php">Retry</a> 
	<?php	
	   }
	   
	   elseif	(mysql_num_rows($sql1) > 0)
	  { echo ('Email Already Exist... ');?>
	  <a href="registration.php">Retry</a> 
	<?php	
	   } 
	  else{ 
	   $pwd=md5($pwd);
	  $sql="INSERT INTO users (user_name,email,password) VALUES ('$user_name', '$email', '$pwd')";
	  mysql_query($sql,$db) or die(mysql_error($db));	
	  
	  $sql="SELECT userid from users where user_name='$user_name' and email='$email'";
	  $sql=mysql_query($sql,$db) or die(mysql_error($db)); 
	  while($info=mysql_fetch_array($sql))
	  {$userid=$info['userid'];}
	   if($_POST['gender']=='male')
       { 
        $sql="INSERT INTO user_info (name,user_name,userid,email,photo) VALUES ('$name','$user_name', '$userid','$email',0xffd8ffe000104a46494600010101004800480000ffe100224578696600004d4d002a00000008000101120003000000010001000000000000ffdb0043000201010201010202020202020202030503030303030604040305070607070706070708090b0908080a0807070a0d0a0a0b0c0c0c0c07090e0f0d0c0e0b0c0c0cffdb004301020202030303060303060c0807080c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0cffc00011080083008103012200021101031101ffc4001f0000010501010101010100000000000000000102030405060708090a0bffc400b5100002010303020403050504040000017d01020300041105122131410613516107227114328191a1082342b1c11552d1f02433627282090a161718191a25262728292a3435363738393a434445464748494a535455565758595a636465666768696a737475767778797a838485868788898a92939495969798999aa2a3a4a5a6a7a8a9aab2b3b4b5b6b7b8b9bac2c3c4c5c6c7c8c9cad2d3d4d5d6d7d8d9dae1e2e3e4e5e6e7e8e9eaf1f2f3f4f5f6f7f8f9faffc4001f0100030101010101010101010000000000000102030405060708090a0bffc400b51100020102040403040705040400010277000102031104052131061241510761711322328108144291a1b1c109233352f0156272d10a162434e125f11718191a262728292a35363738393a434445464748494a535455565758595a636465666768696a737475767778797a82838485868788898a92939495969798999aa2a3a4a5a6a7a8a9aab2b3b4b5b6b7b8b9bac2c3c4c5c6c7c8c9cad2d3d4d5d6d7d8d9dae2e3e4e5e6e7e8e9eaf2f3f4f5f6f7f8f9faffda000c03010002110311003f00fd34a28a2bec0f1c28a28a0028a2a4b2b49b52bd8adade292e2e266db1c51aee673ec28db7023a9b4dd36e759bb16f676f717939e7cb86332363e8057b27c3afd99218238eebc44de74bf785944f88d3fdf61cb1f65c0f7615ea9a5e8b67a1dbf93656b6f6717f7218c46be9d0579b5b32845da0aff91d50c337acb43e75d2ff0067cf166a89b8e9f15a2b0c8fb44eaa4fe0b923f102b45bf65df1304dde768c7fd9171267ff0045e2be83a2b85e6559f636faac0f99755f813e2cd25599b496b88d392d6f32499fa2e771fcab94bab696c6e5e1b88a5b79a33878e5428e9f507915f62d6578abc11a5f8d6cfc9d4eca1ba5030ae46248ff00dd61cafe06b6a79a4aff00bc5f7112c2afb2cf9328af48f8b1fb3f4de0ab27d4749927bed3a1199924c19a01ddf80032fae002bd791923cdc1cd7ad46b46a479a0724a0e2ecc28a28ad090a28a2800a28a2800a28a2802c691a54faf6ad6b636ca1ae2f25586307a658e327d8753ec0d7d41f0ff00e1ce9df0f3475b7b38d5a6600cd70ca3cc9dbd49ec393803819fa93e0ff0063593e2ee91bb9dbe730cfaf92f5f4c578b9a559732a7d2d73b70b156e60a28a2bc93ac28a28a0028a28a001943ae08c83c106be65f8d7e034f00f8e2586dd76d8de2fda6dd4748c124327fc048e3d015afa6abc6ff006b78d76787dffe5a6e9d47d3f779fe95df975471adcab6673e2229c2e78dd14515f4279e1451450014514500145145006e7c33d6c7877e2168f78cdb523ba54763fc2aff00231fc1589afab2be3665deb835f51fc2df1cc7e2ef87b67a8cf322cb1a79376cec06d9578627d33c37d18578f9a53daa2f43b30b2de274d4563cdf1074484e06a769330fe081fce7ff00be5327f4aab37c4ab403f71a7f882e9bd23d26e13f57455fd6bcbf6737d0eae646e5fea1069768d3dccd15bc31e3749238455c9c0c93c7520570badfed2be19d26768e192f3512a705ad61f97f02c541fa8c8ae0ff0068ff0019ddf882e34cb392c350d2eda3579fcabad81a66e1436159ba7cc06707e635e67d2bd3c2e5f19439ea3396ae21a7689ef09fb56e879f9b4dd687d1223ffb52b4b4dfda57c2d7dfeb67bcb33ff4dad98fea9b857ceb5369ba7cbab6a56f6b02ee9eea558631eacc428fd4d74cb2da36eabe666b1333e92baf8fbe11b40376b11b67fe79c12c9ffa0a9af21f8f9f112cfe20f88ac4e9d334d6365010ac51909918fcdc3007a2a573be39f02df7c3dd77fb3eff00c9691a312a49112d1c8a73d0900f041078edf4ac7aac3e0e941aa906d854ad36b958514515dc73851451400514514005145140057ba7eca4b0b7833545f94cc6fcef5ff67ca4dbc7d775785d74df0abe245c7c37f12c736e66d3ae1d45e46064b28dc011eebb89c77c62b971946552938c7735a32519dd9f515151dadd477b6d1cd0bac90cca1d1d4e55d48c823ea2a4af993d33cefe3efc2abbf881656775a688defec4b2189982f9d1b63b9e32a4679c705bbe2bc1758d0afbc3d7261bfb3bab3914e31346573f43d0fd46457d7d4577e1f309528f2357473d4c3a93b9f1fe9fa55e6ad2ac769677574ec7016189a427f215ecdf033e06dcf87b518f5ad69163ba8c1fb2dae43188918def8e37609c0e719c9e781eb5453c46633a91e54ac14f0ea2eef5397f8abf0cadfe26684b0b3791796c4bdacf8cf964f507d54e0647b03dabe79f197c3dd63c033aa6a96be4a48c523991c3c7291e847f500fb57d5d5e33fb5aea018e87660f399a761e98d817f9b7e55797e226a6a97416229c7979ba9e3b451457ba70051451400514514005145140050791451401f507c16d5d75af85da2c8a72d0db8b76f5063fddf3ff007ce7f1aea2bc47f654d76f7fb6f51d33706d3bc8374548e525dc8a307dd7391fec8e9ce7dbabe63194fd9d571feb53d4a32e6826145145731a05145140057ce3fb46eba358f8a171129ca69d0476c3078cf2edfabe3fe035efde2bf12dbf83fc3979a95d7fa9b48f7903ab9e8aa3dcb1007b9af93751d466d6351b8bcb86dd71772b4d211d0b3124e3db9af572ba6dc9d47d34397152d394868a28af6ce10a28a2800a28a2800a28a19b68e6800a07cd22aa82cec70aa064b1f615d57c3ff837acfc42292c31fd8f4f63cddcea7691fec2f57fc3038c6457bef80fe19695f0fb4e48ace057b8eb25d48a0cd2b6319cf61c9c01c0c9f539e2c463a14b45ab36a74252d7a185fb3ffc3997c0de1792e2f2331ea3a99592543d61419d887df924fbb63b577d4515e054a8ea49ce5d4f4231515641451456650547797b0e9d6b24f712c704318dcf248c15507a9278145e5dc7a7da4b7133ac70c286491dba2281924fd057c9be30f14dc78d7c41777d7124ccb713349146ee48857f8540e830b81c7a575e170aeb37ad9231ad57911e87fb407c62b3f155847a369130b8b52eb2dd4ebf71f1caa0f5e7049f5007ae3caa8ac19744d79be26c3a92ebd6ebe175d2e4b697453a7033497865464ba173bf2aab18910c5b0862eadb86dc37bf468c6943922704e6e4eecdea28a2b62028a28a00282702a4b5b696faea38608a49a69582a471a966624e00007b915eebf0a7f678b5f0f4716a1ae24779a8e032c07e686d8ff2761ea7807a74dc79f11898515797dc694e9ca6f43cb3c1bf07f5ff001bbc6d6d64d6f6b200c2eae418e22a7b8e32d9ff00641edd339af68f87bf00b47f0434773703fb535143b84d327c911ff613903ea727d08aeea8af12be3aa54d3647753a118ea0a368c0e00e001da8a28ae2360a28a2800a28a28033bc5be1c8fc5fe1cbbd3669ae2de1bc4f2dde160ae067903208e7a1e3904d78478e7f673d6bc2c8f3d81fed8b35e4f949b6741ee9ceeff80927d857d114574e1f153a3f0edd8cea528cf73e37236b1520ab2f5047228afa6be287c21d3fe245933b2adaea71ae21bb55f9bd95ff00bcbec791ce31ce7e6fd6f45baf0deaf71617b1986ead5f64887f3047a823041ee08af770b8a8d65a68fb1c3568b81568a28aea310a28a2803e82fd9c3c02be1bf082ea93463eddaba890311f3470ff00028ff7bef1f5c8f415e8d4d8204b581238d55238d42aa8180a07000a757c9d6a8ea4dcdf53d68c5455905145159941451450014514500145145001451450015e2dfb58787120934ad6234dad21367330fe2fe28fff006a7e9e95ed35c9fc6df0fa6bff000e750dc01fb0c325daff00bc913e3f9d74612a72555233ab1e68b47cc74503a515f50796145145007d91451457c79ec0514514005145140051451400514514005145140056478fc67c07adff00d784ff00fa2da8a2aa9fc4852d8f9357ee8fa52d1457d71e4051451401ffd9)";
	   mysql_query($sql,$db) or die(mysql_error($db));
       }
       elseif($_POST['gender']=='female')
       {
        $sql="INSERT INTO user_info (name,user_name,userid,email,photo) VALUES ('$name','$user_name', '$userid','$email',0xffd8ffe000104a46494600010101006000600000ffe100224578696600004d4d002a00000008000101120003000000010001000000000000fffe00042a00ffe2021c4943435f50524f46494c450001010000020c6c636d73021000006d6e74725247422058595a2007dc00010019000300290039616373704150504c0000000000000000000000000000000000000000000000000000f6d6000100000000d32d6c636d7300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000a64657363000000fc0000005e637072740000015c0000000b777470740000016800000014626b70740000017c000000147258595a00000190000000146758595a000001a4000000146258595a000001b80000001472545243000001cc0000004067545243000001cc0000004062545243000001cc0000004064657363000000000000000363320000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000074657874000000004642000058595a20000000000000f6d6000100000000d32d58595a20000000000000031600000333000002a458595a200000000000006fa2000038f50000039058595a2000000000000062990000b785000018da58595a2000000000000024a000000f840000b6cf63757276000000000000001a000000cb01c903630592086b0bf6103f15511b3421f1299032183b92460551775ded6b707a0589b19a7cac69bf7dd3c3e930ffffffdb0043000201010201010202020202020202030503030303030604040305070607070706070708090b0908080a0807070a0d0a0a0b0c0c0c0c07090e0f0d0c0e0b0c0c0cffdb004301020202030303060303060c0807080c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0cffc0001108010c00c803012200021101031101ffc4001f0000010501010101010100000000000000000102030405060708090a0bffc400b5100002010303020403050504040000017d01020300041105122131410613516107227114328191a1082342b1c11552d1f02433627282090a161718191a25262728292a3435363738393a434445464748494a535455565758595a636465666768696a737475767778797a838485868788898a92939495969798999aa2a3a4a5a6a7a8a9aab2b3b4b5b6b7b8b9bac2c3c4c5c6c7c8c9cad2d3d4d5d6d7d8d9dae1e2e3e4e5e6e7e8e9eaf1f2f3f4f5f6f7f8f9faffc4001f0100030101010101010101010000000000000102030405060708090a0bffc400b51100020102040403040705040400010277000102031104052131061241510761711322328108144291a1b1c109233352f0156272d10a162434e125f11718191a262728292a35363738393a434445464748494a535455565758595a636465666768696a737475767778797a82838485868788898a92939495969798999aa2a3a4a5a6a7a8a9aab2b3b4b5b6b7b8b9bac2c3c4c5c6c7c8c9cad2d3d4d5d6d7d8d9dae2e3e4e5e6e7e8e9eaf2f3f4f5f6f7f8f9faffda000c03010002110311003f00fd30a28a2beb0f1c28a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28dd400514673450014519a338a0028a3751ba800a28ce68a0028a28a0028a28a0028a28a0028a28a0028a282714001a69ff3cd2b1c0e78aebfe19fc14d53e2332dc7fc78696dd6e645c9947711af7ff7beefd6b3a952305cd22e317276471dbf2eaa32ccdc2a8e598fb0ea7e95d8f86fe0478a3c4aaaeb62b610b7224bd7f287fdf2016fd3f1af77f01fc2ed1fe1fc78b1b3ff0048db87ba970f349ff02edf41815d2ecff67dabcaab994b6a68eb8e197da3c3b4ff00d93ae9d01bad76dd7d4416e5b07eacdfd2a7b9fd93709fb9d7db77fd34b5e3f46af6ad9fe7148539e80fe15cbf5facfafe08d3d843b1f3f6a7fb2d788ad416b5bcd26f940eeef0b9fa0da47e6c2b9ed43e0978b74e1f3e8b7127fd7178e5cfe4d5f5195007dd1c7b535509eb5ac732acb72658583d8f8f753d1750d0c31bdb1beb455ead35bb228fc48c7eb54bedd115cf9b1ffdf62bed17527b9aa6da0d93dcf9cd676cd3039f30c2bbbf3c56d1cd1f5890f0aba33e45d3f4dbcd5f1f64b4bcbc5ee6085a451f8a835af0fc2ef134f1865d075521ba1f27fc48afabc0f4a6b4449fe79a9966737b4471c2c7ab3e47d53c17ade8ebbaeb49d52dd546496b662a3f1038aca497ccfbadbbd71d457d9ac9c8f99976f61deb8af8cfe05d3bc4fe0ed4ae66b7896f2d2079e2b808048854640cf520e31835a52ccaed29222785495d33e6a5eb4ea6a1cb7e14eaf58e40a28a2800a28a2800a28a2800a28a2800a6b7dea7559d13449bc4baddae9f6ffebaf2411293fc39eff872694a492bb03b9f813f0857c7376daa6a11eed2ed5f6a44c3fe3ee41dbfdd1c67d4f1eb5f41db5b79091aa858d100011470a0761ed55b41f0f5b786f41b6b1b54d96f6918441f4ee7dc9e4fb9abc89b2be6b135a556777b1ea53a6a11b0e0b8a28a2b1340a28a2800a28a2800a28a2800a28a2800ae1fe3fea6da57c2bd4b62b16b8296e481f74311927d063bfbd77154f59d1adf5cd36e2cee53ccb7ba431c887f881aaa7251926c996aac7c7a0e4d3aaff8afc333783bc4d79a6cdf335a485037fcf45eaadf8ae2a857d4c649aba3ca6acec1451453105145140051451400514507a50026ec0af45fd98b431a97c409af1d729a7dab3a9c74772147e9bbf2af3927e5af6efd92b4f51a36b175fc524f1c5f82a93ffb357263a5cb459b61d5e68f5dc7eefbf434fa451814b5f3c7a4145145001451450014514500145145001451450014c94e3f2fca9f4d97ee9fa5203e7bfda86c56dbe22db4cabb7ed161196f72aee3f96daf39af50fdab3fe476d37febcbff00676af2fafa3c1eb4627975be36145145751985145140051451400507a5141e9400d23ad7be7eca600f04dfe3fe7f4ffe82b5e099e6bde3f64f6ff8a33515feede7fec8b5c3987f07ee3a30ff0019eab451457827a0145145001451450014514500145145001451450014c93956fa53eb2fc5de248fc2be1cbed426e63b384c98cfde23a0fc4e07e345aef40f33c67f6acb3997c4da55d347b607b53106edbc31247e44579586cd7d25e2bd2e0f8d1f0944b6ea3ceb8856e6d8f78e65fe1fcf729fad7cda54c6c55976ba70411cae3b57bd80a97a7c8f7479f888da5ccb663874a281d28aee39c28a28a0028a28a00283d28a0f4a0042339fa57bc7ec9f1edf06ea2dfdebcffd9457831e3f957bd7eca009f05ea1c7cbf6c383ebf2ad70e61fc23a30df19ea9451457827a0145145001451450014514500145145001451450015c6fc73b56b8f859acedcfcb1ac9ebd181aecab89f8e7e27b5d03e1c6a4b73246b25f446de04cfcd231f41df1d6b4a7f1af5267f0b39ffd9575292e7c117d6cdb992d2ec98f27a064076fe079fc6bcafe3169b1e97f13f5a8a150a9f68326d1d8b80e7f526bda3e07e889e01f85497576cb07da035f5c337f029031ff008e81f89af03f166bcfe27f136a1a8b641bcb87940feea93c0fc06057a985f7b113947638ea6908a288e94503a515ea1ca14514500145145001499ff38a5279a61241ebeff4a0072af9876a02ccc70001c93d38afa7fe08f8424f057802d6d675d9753133cea7f819bf87f0181f5cd703fb3e7c1d324b0ebfaa438fe2b281d79e9c4ac3ff00411f8d7b4429b0b77af131f89537c913bb0f4edef12514515e71d4145145001451450014514500145145001451450015e67e25d36e3e20fc5a9347923b6fec6d2ede39ae9da056958b3161107eaa1881903b29f5af4cac1f0cdba9d6b5cba5fbd717a109cf68e18d7f9eefceaa32e5d49946fa33cb7f693f893bcffc23964d8450af7aca7f28bfa9fc05790a8c0fd3eb56b59bd9b51d6ef2e2e377da269dda4cf50d9e47e1d3f0aaf5f4787a2a9c12479b524dcae1451456e6614514500141341e45349dc3340c18e0fa57a67c0cf829ff00093c89ac6a919fecd439b7848e6e987f11ff00607a7723d3ad1f823f07e4f1eea1fda17d1bae916ac3e5c7fc7d37f747fb23bfaf4ef5f435b5b2db42aab185545d8aaa30aa0740057978dc65bdc81d5428dfde913240a98c76e952514578e7685145140051451400514514005145140051451400504e28a6b9f97f0a006f9996f6edc5711f077c551f88e3d78236e30eaf3b8ff71ce54fe60fe5537c69f8829e03f07ccc8cbf6ebe5686d573cee2082fff0001073f5c0ef5e25f057e20af807c5dbae19bec17c821b9393f273f2c9f81ce71ce18d75d1c2ca74a53fb8c275529246d7ed17e01ff008477c4dfdad6abfe85a9b1f331d229fab0ff00810391ee08af390d915f5878bbc2d6be3af0add69f315786ed328ebced6e0ab8fc7078ed5f2aeada64fa0ea37367749b2e2d2468a407b11fd2bd1c06239e3c8f7473d6a7677ee474503a515e81cc145148c79a0053d2ba4f855f0dee3e2578916dd7747636ff003dd4d8fb8bd947fb47a0fc4f6ac5d0342baf14eb7069f671f997170db54761ea4fa01d49afa8be1ef81ad3c01e1f874fb55271f34d29eb3391cb1fcb1ec315c38cc4fb38f2add9d1429f33bbd8d5d1b4b8744b08ad6da3586dedd02468bd140ff3d6add22aed18a5af04f4028a28a0028a28a0028a28a0028a28a0028a28a0028a28a002ab6ad7d0e996525c5c3ac76f0a179189fbaa3926a791987ddaf19fda6fe241312f876d64f98859af197d3aa27e3f78fe15a51a6ea4d4519cea28abb3cd7e22f8e27f885e299afa5dc2df252de23ff2ca30781e993d4fb9f6ac32327f9f140618f6f6a696c2e7f87bf6afa68c54572c4f35bbeaf73d9ff66ef8a2d215f0eea13166519b1763c903931e7f51f9543fb4ff008084735b7882dd702422daef1ddbf81ff98faedac4f823f09f54d775fb1d6268decf4db3944cb23fcaf395e4051e99ef5e81fb49789ed74af0049a7c8c8d75a93a88907555560ccff8607e75e4c9a8e293a5d773b15dd3f7cf9f17eed14a0e4515ec1c214d72430c7d338ce3d29d5b9f0d3478fc41f10b47b39955a292e54ba9e8e172c47e38c7e3533972c5c8a8abbb1ec7fb3e7c30ff00844b421aa5d4646a5a847901864c111390bf53c13f80af4cd837671cd3233f283edf4a92be62a547397333d48c545590514515050514514005145140051451400514514005145140051451401cff008f7c650f817c2f75a84fb5bc95c4484e3cd90fdd5fc4fe4057cada96a73eb1a85c5e5d4be6dc5c3992463dd8f24ff9e8057d6faef86ac7c4f65f66d42d2def20ddbb64abb803eb5e7fe33fd98b47d42da493473269b7582634de5e127d307919f515dd83c453a6fde5ab39eb5394be13c3f42f0f5f78a3528ecf4fb592eae1cfdc45fba3d49e807b9af6ef86bfb3959f870c779ac797a8df751163f7109fa7f11f73c7b56f7c19f0959f84bc1166b0c6ab77709baedf037b4a32194ffba4118f6ae17e3ffc5bd5b4cd7ee341b357d3a28d54bdc2b7ef2e15973f29fe15e71c73907a56d531153113f654f444469c611e691d57c4cf8efa7f81564b5b1f2f50d51463ca56fdd5bffbe47a7f7473f4af03f11788af3c57abcd7d7d334f7131e49fbaa3b2a8eca3d2a9a0c1ff00ebe69d5df87c2c692d3730a955c8074a28a2ba4c42ba0f84973f64f8a3a0c87fe7ed53fefacaff005ae7b77ebd3deb57c13a66a3aaf8a2c8e976b35ddcdace936235cecdac0824f4038ef5956b7b3772e9fc48fad40c0a7d353951f5feb4eaf983d50a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a280118645452a103ef66a6a6bf2cbc6693d80f32b0f1737803e30dfe897cca9a7eb922ddd9bb748a57e0afb06607fe05f5abbf1cfe17ffc27da00b9b48f76a9a78263c7fcb64ead1ff51eff005ac9fda9bc2ffda3e17b5d5235c49a6cbe5c8475f2df1d7e8db7fefa34ff00d9ff00e2e49e2eb3fec7d424dda85ac7ba1958f37283d7fda5e33ea39ec6bb5465cab110dd6e73dd5fd9c8f0543f3f4dbea3d0ff009ff3c53ebd0bf68cf0447e1af17c7a85b055b7d5833b2018d928fbd8f63907eb9af3daf728d45520a68e19c5c5d98514515a12755f087e174df1375e74676b7b0b501ae6503e639e88bee79e4f41ef5f46785fc2361e11d2d6cf4db68ada15c6768e5cfab1eac7eb5c4fecb368a9f0e66907de96fa42c7d70a8a3f41fa9af4a45da2be7b195a53a8d3d91e9518251b8a8bb5714b4515c86c1451450014514500145145001451450014514500145145001451450014d67da7eb4ea0ae68039ff899a5aeb3e02d6add97779965215ff7829653f8100fe15e0bfb3b4125c7c55b131ffcb28a57723fbbb48fe647e95f495fdbadddb490b7dd910a1fc462bc37e1569775f0ded7c78f345e5ea5a4daac51b91c8e1c823d8e11bdf8aedc2ced4a70feb5d0c2a46f252653fda5bc611ebbe32874eb760d1e931959187795bef0ff00808007d49af39a6ab348e59999d9be6666392c4f7a757b7469aa70505d0e0a927295d8514515a127d15fb32c0b07c2c85bfe7bdcccff00f8f63fa57a10e95c2fecf11791f0af4b1fde695bf376aeeabe62bff165ea7ab4fe141451456458514514005145140051451400514514005145140051451400514514005145140085031e95e41f1e7c6d0785750d52c7ec72492eb9a6469e6290a06d771cfae0376af60af29fda7bc1e758f0b5beab12e66d2df12607de89b83f936d3f89adf0bcbed5736c655afc9a1e0e9c629d4d4233fd69d5f4a798145145007d65e0bf0d2f85342d3f4f47dc967008f38e1dbf89bf13d3f1adaa6aa6d34eaf937abbb3d85a68828a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a002a9eaba5c3aae9b716b70be641731b47229eea460fe86ae54732923f0c5007c87e2af0ecde12f12de69b3ff00acb390a671f797f85bf11835441afa3be31fc1d87e21d8fdaadd6383578062393a09d7fb8e7f91edf4cd7ceb7b673697792db5cc5241716ee5248dc6195875afa1c1e25558dba9e6d5a7cafc86d140e94575989f660e0514c8a5f340230437208f4a7d7c99ec051451400514514005145140051451400514514005145140051451400514514005145140051451400c994b6d18c8ef5e71f1cfe0f278d6c9f50b08d5757b54ce07fcbd28fe03fed0ec7f035e92c3245453c25f386c376247f9f7fceaa9d49425cd12651525667c71ca1da5581538208e9f5a2bd07f68ff00052f86fc6a2fe05db6fab032918e165180ff009f07eac68afa6c3d6538291e5d48b8cac7d16142f418a5a28af973d60a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a08cd14679a00f27fdaa6059bc1363363e78751541ec1a2727f90a2a0fdab3558e2f0d69b62b8f32e2f3ed279e8ab1b2f3f52e28af7b2eb7b2f78e0c45b9cf5fa291db6ae681d6bc13bc5a42dc714b513b6d8cffbb9a00797c628de7b579efc34f88da978afe24f8d34bba687ec9a1dc4515a848f6b004ca0e4f7fb8b5de46db8afbe6aa51684992f99cd064e2b9ef88fafdcf867c01ab6a168ca975676b24b192bb8061d38ef573c21aa4dac78434cbdb860d3dd5a4534840c02cc809e3ea6928bb5c2fa9ac1c9a0b10df85467e5602b8bf84de37d43c6173e268efa48dd749d62e2ca02a814f968d85071d4fbd3e5761731dc86e39a370aaab2b73f37dd38faf19a5f35b2a371f9867e953a94580ec4f6a379238c6eaae2561e673f7471f966bc5f40f8ebe20bfd604324d6ec8da15cea38f21462547982fe0020e3eb551a6e5b12e56d4f6e694a9e94bbce3b5725f07fc5b7be32f875a76a57ce925d5c6fde5502838660381f4aabf09fc6fa878bf54f145bdec91b2693ac4f656fb502911ab1001f53ef53caf5f20e647701891fca82fcfb579afed13f13755f86be1fd3ae34b9218e4b8bbf29fcc8f782bb49c54d77f12353b5f881e2bb0dd0bda68da4adedba347ff2d3603c91c9193d33551a72b5c39b5b1e89bfff00af4a1b26be7cf0e7ed1be25d5fe19eb7a9c9259ade585edbc313ac03015e475604671d107e67db1eadf0efc5d7be25f1678a2dee5a3f274bb98e0815500c029b8927a924d12a6e3b8292675d4514549436493cb154f56d5a1d26c66bab9923b7b7850bcb23b6d5451d4d5c9143a9079e2bc57f6b0beb888e8968934a96b32cccf0ab61199766d27d48dc719e2b4a34fda4d408a92e58dcf3ff008abe3d6f889e3092f943259c43c9b442082a8307247624e49fc07bd15cf01c515f4d4e318c5451e649b6eecfffd9)";
      mysql_query($sql,$db) or die(mysql_error($db));
       }
      
	    
	  redirect('index.php'	); 
	  }
	 }
     break;
	 
	 
	 
// User Login Section	 
case 'Login': 
        $email=$_POST['email'];
		$password=md5($_POST['password']);
		$sql = "SELECT
                userid, user_name
            FROM
                users
            WHERE
                email = '$email' AND
                password = '$password'";
        $result = mysql_query($sql, $db) or die(mysql_error($db));
        if (mysql_num_rows($result) > 0) {
            $row = mysql_fetch_array($result);
            extract($row);
            session_start();
            $_SESSION['userid'] = $userid;
            $_SESSION['user_name'] = $user_name;
            redirect('users_homepage.php');
			   
			
		}
        else
		{
		  ?>
		  <html>
		  <body>
		  <h1><font color="#FF0000">User Name Or Password Mismatch.....</font></h1>
		  <a href="index.php">Go Back</a>
		  </body>
		  </html>
		  <?php
		}
		mysql_free_result($result);
        break;
        
        
// Upload User Information Section
case 'Update': 

       session_start();
       $user_name=strip_tags($_SESSION['user_name']);
	   $userid=strip_tags($_SESSION['userid']);
	   $name=strip_tags($_POST['name']);
	   $sex=strip_tags($_POST['sex']);if($sex=="Mr."){$sex="Male";}else{$sex="Female";}
	   $status=strip_tags($_POST['status']);
	   $interest=strip_tags($_POST['interest']);
	   
	   $city=strip_tags($_POST['city']);
	   $state=strip_tags($_POST['state']);
	   $inst12=strip_tags($_POST['inst12']);
	   $instgrad=strip_tags($_POST['instgrad']);
	   $year12=strip_tags($_POST['year12']);
	   $yeargrad=strip_tags($_POST['yeargrad']);
	   $current_status=strip_tags($_POST['current_status']);
       $workexp=strip_tags($_POST['workexp']);
	   $contact =strip_tags($_POST['contact']);
       $dob=$_POST['dob'];
       


$imageName = mysql_real_escape_string($_FILES["image"]["name"]);
$imageData = mysql_real_escape_string(file_get_contents($_FILES["image"]["tmp_name"]));
$imageType = mysql_real_escape_string($_FILES["image"]["type"]);

$sql="SELECT COUNT(activity_id ) as count from users_activity";
	  $sql=mysql_query($sql,$db) or die(mysql_error($db)); 
	  while($info=mysql_fetch_array($sql))
	  {
	   $count=$info['count'];
	  }
      $count++;
      $actid='IMG'.$count;


if(substr($imageType,0,5)=="image")
{
    mysql_query("INSERT INTO users_activity (user_name,userid,activity_id) VALUES ('$user_name','$userid','$actid')") or die(mysql_error($db));

    if(strlen($dob)>0)
    {
    mysql_query("UPDATE user_info SET dob='$dob',name='$name',sex='$sex',status='$status',interest='$interest',city='$city',state='$state',inst12='$inst12',instgrad='$instgrad',year12='$year12',yeargrad='$yeargrad',current_status='$current_status',workexp='$workexp',contact='$contact',name='$name',photo_name='$imageName',photo='$imageData' where user_name='$user_name' and userid='$userid'") or die(mysql_error($db));
    
	}
    else
    {
     mysql_query("UPDATE user_info SET name='$name',sex='$sex',status='$status',interest='$interest',city='$city',state='$state',inst12='$inst12',instgrad='$instgrad',year12='$year12',yeargrad='$yeargrad',current_status='$current_status',workexp='$workexp',contact='$contact',name='$name',photo_name='$imageName',photo='$imageData' where user_name='$user_name' and userid='$userid'") or die(mysql_error($db));
                         
    }
    $sql="SELECT * from users_images where imagetype='profile' and userid='$userid' ";
	  $sql=mysql_query($sql,$db) or die(mysql_error($db)); 
	
      while($info=mysql_fetch_array($sql))
	  {
	   
	   $actid1=mysql_real_escape_string($info['activity_id']);
       $image=mysql_real_escape_string($info['image']);
       
       $date=mysql_real_escape_string($info['datetime']);
	  }
      
    if(strlen($image)>0)
    {
      
      mysql_query("UPDATE users_images SET userid='$userid',activity_id='$actid',image='$imageData',caption='Updated the Profile Pic',imagetype='profile1' where activity_id='$actid1'" )or die(mysql_error($db));
      mysql_query("INSERT INTO users_images (userid,activity_id,datetime,image,caption,imagetype) VALUES ('$userid','$actid1','$date','$image','Changed the Profile Pic!!','') ") or die(mysql_error($db));
    }
    else
    {
      mysql_query("INSERT INTO users_images (userid,activity_id, image,caption,imagetype) VALUES ('$userid','$actid','$imageData','Updated the Profile Pic','profile') ") or die(mysql_error($db));  
    }
    
     
    
    redirect('users_homepage.php');   
}
else //if(strlen($imageName)==0)
{
     
     if(strlen($dob)>0)
    {
    mysql_query("UPDATE user_info SET dob='$dob',name='$name',sex='$sex',status='$status',interest='$interest',city='$city',state='$state',inst12='$inst12',instgrad='$instgrad',year12='$year12',yeargrad='$yeargrad',current_status='$current_status',workexp='$workexp',contact='$contact',name='$name' where user_name='$user_name' and userid='$userid'") or die(mysql_error($db));
    
	}
    else
    {
     mysql_query("UPDATE user_info SET name='$name',sex='$sex',status='$status',interest='$interest',city='$city',state='$state',inst12='$inst12',instgrad='$instgrad',year12='$year12',yeargrad='$yeargrad',current_status='$current_status',workexp='$workexp',contact='$contact',name='$name' where user_name='$user_name' and userid='$userid'") or die(mysql_error($db));
                         
    }
  //  echo ('Only Images are Allowed...!!');
    redirect('users_homepage.php');
}
break;






// Update Status Section
case 'Post':
      
      session_start();
      $user_name=$_SESSION['user_name'];
	  $userid=$_SESSION['userid'];
	  $access_type=$_POST['access_type']; 
      $status=strip_tags($_POST['status']);
      $sql="SELECT COUNT(activity_id ) as count from users_activity";
	  $sql=mysql_query($sql,$db) or die(mysql_error($db)); 
	  while($info=mysql_fetch_array($sql))
	  {
	   $count=$info['count'];
	  }
      $count++;
      $actid='STS'.$count;
      
      mysql_query("INSERT INTO users_activity (user_name,userid,activity_id,access_type) VALUES ('$user_name','$userid','$actid','$access_type')");
      mysql_query("INSERT INTO users_status (  status,userid,activity_id) VALUES ('$status', '$userid','$actid')") or die(mysql_error($db));
      redirect('users_homepage.php');
break;



// Upload Image Section
case 'Upload':
      
      session_start();
      $user_name=$_SESSION['user_name'];
	  $userid=$_SESSION['userid'];
	   
      $image=mysql_real_escape_string(file_get_contents($_FILES["photo"]["tmp_name"]));
      $caption=strip_tags($_POST['caption']);
      
      $access_type=$_POST['access_type']; 
      
      $sql="SELECT COUNT(activity_id ) as count from users_activity";
	  $sql=mysql_query($sql,$db) or die(mysql_error($db)); 
	  while($info=mysql_fetch_array($sql))
	  {
	   $count=$info['count'];
	  }
      $count++;
      $actid='IMG'.$count;
      
      
      
      
            
      $imageType = mysql_real_escape_string($_FILES["photo"]["type"]);

if(substr($imageType,0,5)=="image")
{
      mysql_query("INSERT INTO users_activity (user_name,userid,activity_id,access_type) VALUES ('$user_name','$userid','$actid','$access_type')");
      mysql_query("INSERT INTO users_images (  image,userid,activity_id,caption) VALUES ('$image', '$userid','$actid','$caption')") or die(mysql_error($db));
      redirect('users_homepage.php');
      }
else
redirect('users_homepage.php');
break;


// Comment Section

case 'Comment':
      
      session_start();
      $user_name=$_SESSION['user_name'];
	  $userid=$_SESSION['userid'];
	  $userid1=mysql_real_escape_string($_POST['id']);
      $actid=$_POST['actid1'];
    $sql="SELECT * from user_info where userid='$userid' ";
	  $sql=mysql_query($sql,$db) or die(mysql_error($db)); 
	  while($info=mysql_fetch_array($sql))
	  {
	   $name=$info['name'];
      }
      
       
      $comment=strip_tags($_POST['comment']);
      
      
      mysql_query("INSERT INTO users_comments (  comments,commenter_id,activity_id) VALUES ('$comment', '$userid','$actid')") or die(mysql_error($db));
      $notf=$name.' commented on your post.';
      if($userid1==$userid)
      {
        
      }
      else
      {
      mysql_query("INSERT INTO users_notifications (notification,userid,activity_id) VALUES ('$notf','$userid1','$actid')");
      }
      mysql_query("UPDATE users_activity SET comments='YES' where activity_id='$actid' ");
      if(isset($_POST["url"]))
      {
                redirect($_POST["url"]);
      }
      elseif($_POST["redir"])
      {
              redirect('wall.php');
      }
      else
      redirect('users_homepage.php');
break;





// Add Friends Section
case 'Add Friend':
      
      session_start();
      $user_name=$_SESSION['user_name'];
	  $userid=$_SESSION['userid'];
	  $userid1=mysql_real_escape_string($_POST['userid1']);
      $sql="SELECT * from user_info where userid='$userid' ";
	  $sql=mysql_query($sql,$db) or die(mysql_error($db)); 
	  while($info=mysql_fetch_array($sql))
	  {
	   $name=$info['name'];
      }
        $notf=$name.' sent you a friend request.';
      $actid='FRD'.$userid1.''.$userid;
      mysql_query("INSERT INTO users_friends ( userid,friends_id,friendship_status) VALUES ('$userid', '$userid1','REQUESTED')") or die(mysql_error($db));
      mysql_query("INSERT INTO users_friends ( userid,friends_id,friendship_status) VALUES ('$userid1', '$userid','GOTREQUEST')") or die(mysql_error($db));
      mysql_query("INSERT INTO users_notifications ( userid,notification,activity_id) VALUES ('$userid1', '$notf','$actid')") or die(mysql_error($db));
      if(isset($_POST["url"]))
      {
                redirect($_POST["url"]);
      }
      else
      redirect('users_homepage.php');
break;




// Accept Friends Request
case 'Accept Friend Request':
      
      session_start();
      $user_name=$_SESSION['user_name'];
	  $userid=$_SESSION['userid'];
	  $userid1=mysql_real_escape_string($_POST['userid1']);
      $sql="SELECT * from user_info where userid='$userid' ";
	  $sql=mysql_query($sql,$db) or die(mysql_error($db)); 
	  while($info=mysql_fetch_array($sql))
	  {
	   $name=$info['name'];
      }
        $notf=$name.' accepted your friend request.';
      $actid='ACC'.$userid.''.$userid1;
      
      mysql_query("UPDATE users_friends SET friendship_status='FRIENDS' where userid='$userid' and friends_id='$userid1'") or die(mysql_error($db));
      mysql_query("UPDATE users_friends SET friendship_status='FRIENDS' where userid='$userid1' and friends_id='$userid'") or die(mysql_error($db));
      mysql_query("INSERT INTO users_notifications ( userid,notification,activity_id) VALUES ('$userid1', '$notf','$actid')") or die(mysql_error($db));
      if(isset($_POST["url"]))
      {
                redirect($_POST["url"]);
      }
      else
      redirect('users_homepage.php');
break;



	}


}
else
{ echo('action not set');
	}







?>

</body></html>
