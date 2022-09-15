<!DOCTYPE html>
<html dir="rtl">
<head>
	<?php include('include/head.php'); ?>
</head>
<body >
	<?php include('include/header.php'); ?>
	<?php include('include/sidebar.php'); ?>
	<?php 
	if(isset($_REQUEST["type"]))
	{$DocumentType=$_REQUEST["type"];
		$sql = 'select t.*,b.BTitle,w.WTitle,a.userName,(SELECT sum(gross) from transactionsbody where THID=t.THID) as Total,case when t.TType=1 then (SELECT vname from vendors where VID=t.VID_CID) else (SELECT cname from clients where CID=t.VID_CID) end as Beneficiary from transactionsheader t join branches b on b.BID=t.BID
  JOIN useraccount a on a.userID=t.userID JOIN warehouses w on w.WID=t.WhID where t.ttype='.$_REQUEST["type"].' order by THID desc';
$Transactiondata = $pdo->query($sql)->fetchAll();

	echo '<script> var JsTransactionData='.json_encode($Transactiondata).';  </script>';} ?>
	<div class="main-container">
		<div class="pd-ltr-20 customscroll customscroll-10-p height-100-p xs-pd-20-10">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>العمليات</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.php">الرئيسية</a></li>
									<li class="breadcrumb-item active" aria-current="page"><?php  switch($DocumentType) {case 1: echo 'توريد مخزني'; break; case 2: echo 'صرف مخزني'; break; case 3 : echo 'زيادة المخزون'; break;case 4:  echo 'نقص المخزون'; break; default: echo 'المخزون الافتتاحي';} ?></li>
								</ol>
							</nav>
						</div>
						
					</div>
				</div>
				<!-- basic table  Start -->
				<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
					<div class="clearfix mb-20">
						
						<div class="pull-right">
							<a href="form_transactions?type=<?php echo $_REQUEST["type"]; ?>" id="btnAddNew" class="btn btn-primary btn-sm scroll-click" rel="content-y"  ><i class="fa fa-plus"></i>جديد</a>
						</div>
					</div>
					<table class="table" id="TransactionTabla" data-toggle="table"  data-filter-control="true" 
  data-show-pagination-switch="true" data-pagination="true" data-id-field="VoucherNo" data-page-size="50"  data-side-pagination="client"					>
						<thead>
							<tr>
								  <th  data-field="VoucherNo" data-filter-control="input" data-width="3%"  data-sortable="true">#</th>
								  <th  data-field="Year" data-filter-control="select" data-sortable="true">السنة</th>
								
								 
								  <th  data-field="VoucherDate" data-filter-control="input"  data-sortable="true">التاريخ </th>
								   <?php  echo $DocumentType==1 || $DocumentType==2?  ' <th  data-field="Beneficiary" data-filter-control="select" data-sortable="true">'.( $DocumentType==1?'المورد' :'العميل' ).'</th>' :  ''; ?>
								  <th  data-field="BTitle" data-filter-control="select" data-sortable="true">الفرع </th>
								  <th  data-field="WTitle" data-filter-control="select" data-sortable="true">المخزن </th>
								   <th  data-field="Total" data-filter-control="input" data-sortable="true">الإجمالي </th>
								  <th  data-field="userName" data-filter-control="select"  data-sortable="true">المستخدم </th>
								  <th  data-field="Comment"  data-sortable="true">ملاحظات </th>
									
								 
							    <th data-formatter="EditTransactionFormatter" >تعديل</th>
								 <th data-formatter="PrintTransactionFormatter" >طباعة</th>
								
							</tr>
						</thead>
						<tbody>
						
						</tbody>
					</table>
			
			</div>
			<?php include('include/footer.php'); ?>
		</div>
	</div>
	<?php include('include/script.php'); ?>
	<script src="vendors/scripts/bootstrap-table-filter-control.js"></script>
	<script src="vendors/scripts/bootstrap-table-export.js"></script>
	<script src="vendors/scripts/tableExport.js"></script>
	
	<script>


$(function(){
console.log(JsTransactionData);
var branches='<option value=0>--------</option>';
	$('#TransactionTabla').bootstrapTable('load',JsTransactionData);
	
   

});
  

 function EditTransactionFormatter(value, row, index) {
        return [
            '<a class="like btnEditDataElement"  title="Like" href="form_transactions?type='+row.TType+'&TransactionId='+row.THID+'" >',
            '<i class="fa fa-edit"></i> <span class="label label-primary">تعديل</span>',
            '</a>'


        ].join('');


    }
	function PrintTransactionFormatter(value, row, index) {
        return [
            '<a class="like btnEditDataElement"  title="Like" target="_blank" href="print_transactions?type='+row.TType+'&TransactionId='+row.THID+'" >',
            '<i class="fa fa-print"></i> <span class="label label-primary">طباعة</span>',
            '</a>'


        ].join('');


    }
	
	
	
	

	
</script>
</body>
</html>