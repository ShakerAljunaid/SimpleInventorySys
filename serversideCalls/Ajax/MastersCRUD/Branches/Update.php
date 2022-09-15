<?php
require_once('../../../../include/dbconfig.php');

if(isset($_POST['BID']) )
{	$parms=$_POST;
$sql="update branches
   set BTitle='".$parms['BTitle']."'
    ,address='".$parms['address']."'
	
	where BID=".$parms['BID'];

$res=$pdo->query($sql);
if($res)
{
	$sql="SELECT * FROM branches";
   $DocData = $pdo->query($sql)->fetchAll();
   echo json_encode($DocData);
}
else
	echo $sql;
}
else echo 'Not set';