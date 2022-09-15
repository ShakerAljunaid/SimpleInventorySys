<?php
require_once('../../../../include/DBOperations.php');


if(isset($_POST['cname'])  )
{	$parms=$_POST;
$sql="INSERT INTO clients(userID,cname,phone,	address,status) values(".check_data($_SESSION["userID"]).",'".$parms['cname']."','".$parms['phone']."','".$parms['address']."',".$parms['status'].");";
$res=$pdo->query($sql);
if($res)
{
	$sql="SELECT * FROM clients";
   $userData = $pdo->query($sql)->fetchAll();
   echo json_encode($userData);
}
else
	echo $sql;
}
else echo 'Not set';