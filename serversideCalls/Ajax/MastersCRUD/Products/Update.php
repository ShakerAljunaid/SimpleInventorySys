<?php
require_once('../../../../include/dbconfig.php');

if(isset($_POST['PID']) )
{	$parms=$_POST;
$sql="update products
   set PTitle='".$parms['PTitle']."'
    ,company='".$parms['company']."'
	
	where PID=".$parms['PID'];

$res=$pdo->query($sql);
if($res)
{
	$sql="SELECT * FROM products";
   $DocData = $pdo->query($sql)->fetchAll();
   echo json_encode($DocData);
}
else
	echo $sql;
}
else echo 'Not set';