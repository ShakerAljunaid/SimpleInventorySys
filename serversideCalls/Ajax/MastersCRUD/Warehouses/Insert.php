<?php
require_once('../../../../include/DBOperations.php');


if(isset($_POST['BID']) &&isset($_POST['WTitle'])  )
{	$parms=$_POST;
$sql="INSERT INTO warehouses(userID,BID,WTitle) values(".$_SESSION["userID"].",".$parms['BID'].",'".$parms['WTitle']."');";
$res=$pdo->query($sql);
if($res)
{
	$sql="SELECT * FROM warehouses";
   $userData = $pdo->query($sql)->fetchAll();
   echo json_encode($userData);
}
else
	echo $sql;
}
else echo 'Not set';