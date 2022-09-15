<?php

require_once('../../../include/DBOperations.php');


$param = $_REQUEST;
$errorMsg='';
if(isset($param["BID"]) && isset($param["WhID"]) && isset($param["VID_CID"]) && isset($param["VoucherDate"]))
{$someArray = json_decode($param['body'], true);
$valid=true;
 
for($i=0;$i<count($someArray);$i++)
 { 

if($param["type"]==2 || $param["type"]==4)
{ if(!chekQuantity(check_data($someArray[$i]["PID"]),check_data($someArray[$i]["unitID"]),check_data($param["WhID"]),check_data($someArray[$i]["quantity"])))
	 {
       $valid=false;
	    $errorMsg .='الكمية المتبقية من الصنف رقم '.$someArray[$i]["PID"].' غير كافية للصرف ;';
	 }
}
	 if($valid)
	 {
		 $fields=array(":vuserID",":bID",":whID",":vID_CID",":vtType",":voucherDate",":vcomment","@Result");
          $values=array( check_data($_SESSION["userID"]),check_data($param["BID"]),check_data($param["WhID"]),check_data($param["VID_CID"]),check_data($param["type"]),check_data($param["VoucherDate"]),check_data($param["Comment"]));
          $result=bind_fields_new('AddTranscationHeader',$fields,$values);
            $fields=array(":THID",":rowId",":userID",":PID",":unitID",":quantity",":rate",":gross",":narration");		 
		 for($i=0;$i<count($someArray);$i++)
            { $rate=empty(check_data($someArray[$i]["rate"]))?1:check_data($someArray[$i]["rate"]);
              $values=array( check_data($result),check_data($someArray[$i]["rowId"]),check_data($_SESSION["userID"]),check_data($someArray[$i]["PID"]),check_data($someArray[$i]["unitID"]),check_data($someArray[$i]["quantity"]),$rate,empty(check_data($someArray[$i]["gross"]))?($rate*check_data($someArray[$i]["quantity"])):check_data($someArray[$i]["gross"]),check_data($someArray[$i]["narration"]));
               echo bind_fields('AddTransactionBody',$fields,$values);
	     
	 
           }
		  
		  
	 }
	 else 
		 echo $errorMsg;
	 
 }
   
}
else 

$errorMsg='الرجاء تعبئة الحقول الرئيسية';	


   
function chekQuantity($pid,$uid,$whId,$quantity)
{
	$sql="select sum(case when h.ttype=1 or h.ttype=3 or h.ttype=5 then (quantity) else  (-1*quantity)  end ) Balance  from transactionsbody b join transactionsheader h on h.THID=b.THID join products p on p.PID=b.PID join units u on u.unitID=b.unitID where  b.unitID=".$uid.' and b.PID='.$pid.' and WhID='.$whId;
   $RemainingQty = current($GLOBALS['pdo']->query($sql)->fetchAll());
 
 return $RemainingQty['Balance']>$quantity? True:false;
	
}