<?php

require_once('../../../include/DBOperations.php');


$param = $_REQUEST;
if(isset($param['PID']) && isset($param['unitID']))
{$sql="select sum(case when h.ttype=1 or h.ttype=3 or h.ttype=5 then (quantity) else  (-1*quantity)  end ) Balance  from transactionsbody b join transactionsheader h on h.THID=b.THID join products p on p.PID=b.PID join units u on u.unitID=b.unitID where  b.unitID=".$param['unitID'].' and b.PID='.$param['PID'];
   $RemainingQty = current($pdo->query($sql)->fetchAll());
 if(  $param['quantity']<$RemainingQty)
   echo 0;
else echo 1;

}
echo $param['PID'];