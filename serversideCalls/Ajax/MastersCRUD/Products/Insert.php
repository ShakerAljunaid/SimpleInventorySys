<?php
require_once('../../../../include/DBOperations.php');


if(isset($_POST['PTitle'])  )
{	$parms=$_POST;
$sql="INSERT INTO products(userID,PTitle,company) values(".check_data($_SESSION["userID"]).",'".$parms['PTitle']."','".$parms['company']."');";
$res=$pdo->query($sql);
if($res)
{
	$sql="SELECT * FROM products";
   $userData = $pdo->query($sql)->fetchAll();
   echo json_encode($userData);
}
else
	echo $sql;
}
else echo 'Not set';