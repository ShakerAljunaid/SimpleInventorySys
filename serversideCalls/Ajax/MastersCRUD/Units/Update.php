<?php
require_once('../../../../include/dbconfig.php');

if(isset($_POST['unitID']) )
{	$parms=$_POST;
$sql="update units
   set unitTitle='".$parms['unitTitle']."'
    ,unitDesc='".$parms['unitDesc']."'
	
	where unitID=".$parms['unitID'];

$res=$pdo->query($sql);
if($res)
{
	$sql="SELECT * FROM units";
   $DocData = $pdo->query($sql)->fetchAll();
   echo json_encode($DocData);
}
else
	echo $sql;
}
else echo 'Not set';