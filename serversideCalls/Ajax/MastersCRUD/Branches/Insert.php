<?php
require_once('../../../../include/DBOperations.php');


if(isset($_POST['BTitle'])  )
{	$parms=$_POST;
$sql="INSERT INTO branches(userID,BTitle,address) values(".check_data($_SESSION["userID"]).",'".$parms['BTitle']."','".$parms['address']."');";
$res=$pdo->query($sql);
if($res)
{
	$sql="SELECT * FROM branches";
   $userData = $pdo->query($sql)->fetchAll();
   echo json_encode($userData);
}
else
	echo $sql;
}
else echo 'Not set';