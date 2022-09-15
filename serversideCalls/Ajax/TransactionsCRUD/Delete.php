<?php
require_once('../../dbconfig.php');

if(isset($_POST['PID']) )
{	$parms=$_POST;
$sql="DELETE FROM patient 	where PID=".$parms['PID'];
$res=$pdo->query($sql);
if($res)
{
	$sql="SELECT * FROM patient";
   $DocData = $pdo->query($sql)->fetchAll();
   echo json_encode($DocData);
}
else
	echo $sql;
}
else echo 'Not set';