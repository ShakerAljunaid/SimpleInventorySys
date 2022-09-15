<?php
require_once('../../../include/dbconfig.php');
$parms=$_POST;
$filter=' where 1=1  and  ttype!=5';
if(!empty($parms['TypeId']))
	$filter .=' and h.Ttype='.$parms['TypeId'];
if(!empty($parms['ProductId']) )
	$filter .=' and b.PID='.$parms['ProductId'];
if(!empty($parms['UnitId']) )
	$filter .=' and b.unitID='.$parms['UnitId'];
if(!empty($parms['BranchId']) )
	$filter .=' and h.BID='.$parms['BranchId'];
if(!empty($parms['WarehouseId']) )
	$filter .=' and h.whid='.$parms['WarehouseId'];
	{if(!empty($parms['VendorId']) )
	$filter .=' and h.Ttype=1 and h.VID_CID='.$parms['VendorId'];
     else if(!empty($parms['ClientId']) )
		 $filter .=' and h.Ttype=2 and h.VID_CID='.$parms['ClientId'];
	}
if(!empty($parms['UserId']) )
	$filter .=' and h.userID='.$parms['UserId'];
	{if(!empty($parms['fromDate'])   && !empty($parms['toDate']) )
		 $filter .=' and h.VoucherDate>="'.$parms['fromDate'].'" and h.VoucherDate<="'.$parms['toDate'].'"';
	  else if(!empty($parms['fromDate'])   )
	   $filter .=' and h.VoucherDate="'.$parms['fromDate'].'"';
     
	}

$sql="select b.THID,h.TType,h.VoucherNo,h.VoucherDate,h.Comment,u.unitTitle,p.PTitle,
case when h.ttype=1 or h.ttype=3 or h.ttype=5 then sum(quantity) else 0 end as qtyReceived,case when h.ttype=2 or h.ttype=4 then sum(quantity) else 0 end as qtyIssued ,
case when h.TType=1 then (SELECT vname from vendors where VID=h.VID_CID) else (SELECT cname from clients where CID=h.VID_CID) end as Beneficiary,
a.userName,sum(b.gross) as TotalAmount from transactionsbody b join transactionsheader h on h.THID=b.THID join products p on p.PID=b.PID 
join units u on u.unitID=b.unitID 
  JOIN useraccount a on a.userID=h.userID  ".$filter."  GROUP by p.PID, h.THID  order by h.THID desc  ";

$res=$pdo->query($sql)->fetchAll();
if(count($res)>0)
{
	
   echo json_encode($res);
}
else
	echo $sql;
