<?php
require_once('../../../../include/DBOperations.php');


if(isset($_POST['vname'])  )
{	$parms=$_POST;
$sql="INSERT INTO vendors(userID,vname,phone,	address,status) values(".check_data($_SESSION["userID"]).",'".$parms['vname']."','".$parms['phone']."','".$parms['address']."',".$parms['status'].");";
$res=$pdo->query($sql);
if($res)
{
	$sql="SELECT * FROM vendors";
   $userData = $pdo->query($sql)->fetchAll();
   echo json_encode($userData);
}
else
	echo $sql;
}
else echo 'Not set';