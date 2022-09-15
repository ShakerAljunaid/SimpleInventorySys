<?php
require_once('../../../include/dbconfig.php');

if(isset($_POST['ScreenType']) )
{	$parms=$_POST['ScreenType'];


if($parms==1)
{$sql="select Bid id,Btitle as title ,'b' as type from branches
union ALL 
select wid id,wtitle as title ,'w' as type from warehouses
union ALL 
select pid id,ptitle as title ,'p' as type from products
union ALL 
select unitid id,unittitle as title ,'u' as type from units
union ALL 
select vid id,vname as title ,'v' as type from vendors ";
}
else if($parms==2)
{$sql="select Bid id,Btitle as title ,'b' as type from branches
union ALL 
select wid id,wtitle as title ,'w' as type from warehouses
union ALL 
select pid id,ptitle as title ,'p' as type from products
union ALL 
select unitid id,unittitle as title ,'u' as type from units
union ALL 
select cid id,cname as title ,'c' as type from clients ";
}
else if ($parms==100)
{$sql="select Bid id,Btitle as title ,'b' as type from branches
union ALL 
select wid id,wtitle as title ,'w' as type from warehouses
union ALL 
select pid id,ptitle as title ,'p' as type from products
union ALL 
select unitid id,unittitle as title ,'u' as type from units
union ALL 
select cid id,cname as title ,'c' as type from clients 
union ALL 
select vid id,vname as title ,'v' as type from vendors 
union ALL 
select userID id,userName as title ,'z' as type from useraccount";
}	
else 
{
	$sql="select Bid id,Btitle as title ,'b' as type from branches
union ALL 
select wid id,wtitle as title ,'w' as type from warehouses
union ALL 
select pid id,ptitle as title ,'p' as type from products
union ALL 
select unitid id,unittitle as title ,'u' as type from units
union ALL 
select 0 id,'none' as title ,'n' as type  ";
}
	
$res=$pdo->query($sql)->fetchAll();

if(count($res)>0)
{
	
   echo json_encode($res);
}
else
	echo $sql;
}
else echo 'Not set';