<?php
require_once('../../../../include/dbconfig.php');

if(isset($_POST['WID']) )
{	$parms=$_POST;
$sql="update warehouses
   set 	WTitle='".$parms['WTitle']."'
    ,BID='".$parms['BID']."'
	
	where WID=".$parms['WID'];

$res=$pdo->query($sql);
if($res)
{
	$sql="SELECT * FROM warehouses";
   $DocData = $pdo->query($sql)->fetchAll();
   echo json_encode($DocData);
}
else
	echo $sql;
}
else echo 'Not set';