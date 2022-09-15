<?php
require_once('../../../../include/dbconfig.php');

if(isset($_POST['VID']) )
{	$parms=$_POST;
$sql="update vendors
   set vname='".$parms['vname']."'
    ,phone='".$parms['phone']."'
	,address='".$parms['address']."'
	,status='".$parms['status']."'
	
	where VID=".$parms['VID'];

$res=$pdo->query($sql);
if($res)
{
	$sql="SELECT * FROM vendors";
   $DocData = $pdo->query($sql)->fetchAll();
   echo json_encode($DocData);
}
else
	echo $sql;
}
else echo 'Not set';