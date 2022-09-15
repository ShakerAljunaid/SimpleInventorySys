<!DOCTYPE html>
<html>
<head>
<?php include('include/sessionManger.php'); ?>
	<?php include('include/head.php'); ?>
</head>
<body>
	
	
	<?php 

 
if(isset($_REQUEST["TransactionId"]) && isset($_REQUEST["type"]))
{
$TransactionId=$_REQUEST["TransactionId"];	
$DocumentType=$_REQUEST["type"];

 $sql = 'select t.*,b.BTitle,w.WTitle,a.userName,(SELECT sum(gross) from transactionsbody where THID=t.THID) as Total,case when t.TType=1 then (SELECT vname from vendors where VID=t.VID_CID) else (SELECT cname from clients where CID=t.VID_CID) end as Beneficiary from transactionsheader t join branches b on b.BID=t.BID
  JOIN useraccount a on a.userID=t.userID JOIN warehouses w on w.WID=t.WhID where t.THID='.$_REQUEST["TransactionId"].' order by THID desc';
$HeaderData = current($pdo->query($sql)->fetchAll());
$sql='select b.*,u.unitTitle,p.PTitle from transactionsbody b join products p on p.PID =b.PID
  JOIN units u on u.unitID=b.unitID  where THID=
'.$TransactionId;
	$BodyData=$pdo->query($sql)->fetchAll();
}
?>
	<div class="main-container">
		
			
			
				<div class="">
					<div class="invoice-box">
						<div class="invoice-header">
							<div class="logo text-center">
							<span><img src="vendors/images/logo.png" alt=""><p class="weight-600">ثلاجة آية</p></span>
								
								
							</div>
						</div>
						<h4 class="text-center mb-30 weight-600"><?php echo $DocumentType==1?'توريد مخزني' :'صرف مخزني'; ?></h4>
						<div class="row pb-30">
							<div class="col-md-6">
							<p class="font-14 mb-5"><?php echo $DocumentType==1?'المورد' :'العميل'; ?>: <strong class="weight-600"><?php echo $HeaderData['Beneficiary'] ; ?></strong></p>
								
								<p class="font-14 mb-5">التاريخ: <strong class="weight-600"><?php echo $HeaderData['VoucherDate'] ; ?></strong></p>
								<p class="font-14 mb-5">رقم السند: <strong class="weight-600"># <?php echo $HeaderData['VoucherNo'] ; ?>#</strong></p>
							</div>
							<div class="col-md-6">
								<div class="text-right">
									<p class="font-14 mb-5">الفرع :<strong class="weight-600"><?php echo $HeaderData['BTitle'] ; ?></strong></p>
									<p class="font-14 mb-5">المخزن:<strong class="weight-600"><?php echo $HeaderData['WTitle'] ; ?></strong></p>
								
									
								</div>
							</div>
						</div>
						<div class="invoice-desc pb-30">
							
							   <table class="table table-bordered  clearfix">
                                <thead class="invoice-desc-head">
                                   <th  >#</th>
		<th  >الصنف</th>
		<th   >الوحدة</th>
		<th  >الكمية</th>
		<th  class="hidden">السعر</th>
		<th class="hidden" >الإجمالي</th>
		
		<th   > ملاحظات</th>
                                    </tr>
                                </thead>
                                <tbody class="">
								<?php foreach($BodyData as $b) {?>
								<tr> 
								<td><?php echo $b['rowId']+1 ; ?> </td>
								<td><?php echo $b['PTitle'] ; ?> </td>
								<td><?php echo $b['unitTitle'] ; ?> </td>
								<td><?php echo $b['quantity'] ; ?> </td>
								<td class="hidden"><?php echo $b['rate'] ; ?> </td>
								<td class="hidden"><?php echo $b['gross'] ; ?> </td>
								<td><?php echo $b['narration'] ; ?> </td>
								</tr>
								<?php } ?>
										
									 
									  
                                   </table >
							<div class="invoice-desc-footer">
								<div class="invoice-desc-head clearfix">
									<div class="invoice-sub">تاريخ الطباعة</div>
									<div class="invoice-rate hidden">العملة</div>
									<div class="invoice-subtotal hidden">الإجمالي</div>
								</div>
								<div class="invoice-desc-body">
									<ul>
										<li class="clearfix">
											<div class="invoice-sub">
												<p class="font-14 mb-5">اسم المستخدم: <strong class="weight-600"><?php echo $UserName;?></strong></p>
												<p class="font-14 mb-5">التاريخ <strong class="weight-600"><?php echo date("Y-m-d H:i:s"); ?></strong></p>
											</div>
											<div class="invoice-rate font-20 weight-600 hidden">ريال يمني</div>
											<div class="invoice-subtotal hidden"><span class="weight-600 font-24 text-danger">#<?php echo $HeaderData['Total'] ; ?>#</span></div>
										</li>
									</ul>
								</div>
							</div>
						</div>
						
					</div>
				</div>
			
		
	</div>
	<?php include('include/script.php'); ?>
</body>
</html>