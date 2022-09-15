<?php
require_once('../../dbconfig.php');

if(isset($_POST['PID']) )
{	$parms=$_POST;
$sql="update patient
   set PName='".$parms['PName']."'
    ,PAddress='".$parms['PAddress']."',PNumber='".$parms['PNumber']."'
	,dateOfBirth='".$parms['dateOfBirth']."',gender='".$parms['gender']."',ModifiedOn=now(), ModifiedBy=1 
	where PID=".$parms['PID'];

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