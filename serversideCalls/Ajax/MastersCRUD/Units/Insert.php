<?php
require_once('../../../../include/DBOperations.php');


if(isset($_POST['unitTitle'])  )
{	$parms=$_POST;
$sql="INSERT INTO units(userID,unitTitle,unitDesc) values(".check_data($_SESSION["userID"]).",'".$parms['unitTitle']."','".$parms['unitDesc']."');";
$res=$pdo->query($sql);
if($res)
{
	$sql="SELECT * FROM units";
   $userData = $pdo->query($sql)->fetchAll();
   echo json_encode($userData);
}
else
	echo $sql;
}
else echo 'Not set';