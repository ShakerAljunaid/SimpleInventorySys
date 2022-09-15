<?php
require_once('../../../../include/dbconfig.php');

if(isset($_POST['CID']) )
{	$parms=$_POST;
$sql="update clients
   set cname='".$parms['cname']."'
    ,phone='".$parms['phone']."'
	,address='".$parms['address']."'
	,status='".$parms['status']."'
	
	where CID=".$parms['CID'];

$res=$pdo->query($sql);
if($res)
{
	$sql="SELECT * FROM clients";
   $DocData = $pdo->query($sql)->fetchAll();
   echo json_encode($DocData);
}
else
	echo $sql;
}
else echo 'Not set';