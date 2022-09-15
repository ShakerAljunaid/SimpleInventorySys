<!DOCTYPE html>
<html>
<head>
	<?php include('include/head.php'); ?>
	<link rel="stylesheet" href="vendors/styles/excel-table.css">
</head>
<body>
	<?php include('include/header.php'); ?>
	<?php include('include/sidebar.php'); ?>
	<?php
	$DocumentStatus=1;
	$DocumentType=$_REQUEST["type"];
	if(isset($_REQUEST["TransactionId"]))
	{
		$sql = "select * from transactionsheader where THID =".$_REQUEST["TransactionId"]; 
		 $HeaderData = $pdo->query($sql)->fetchAll();
		 $sql = "select * from transactionsbody where THID =".$_REQUEST["TransactionId"]; 
		 $bodyData = $pdo->query($sql)->fetchAll();
		 $DocumentStatus=2;
		  echo '<script> var JsHeaderData='.json_encode($HeaderData).';var JsBodyData='.json_encode($bodyData).';</script>';
		 
		 
	}
	echo '<script> var JsDocumentStatus='.$DocumentStatus.';var JsDocumentType='.$DocumentType.'</script>';
	
	?>
	<div class="main-container">
		<div class="pd-ltr-20 customscroll customscroll-10-p height-100-p xs-pd-20-10">
		
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4><?php  switch($DocumentType) {case 1: echo 'توريد مخزني'; break; case 2: echo 'صرف مخزني'; break; case 3 : echo 'زيادة المخزون'; break;case 4:  echo 'نقص المخزون'; break; default: echo 'المخزون الافتتاحي';} ?></h4>
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
				<form id="transactionForm">
				<!-- Default Basic Forms Start -->
				<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
					
					<input type="hidden" class="form-control" id="THID" name="THID" value=0>
					<div class="row">
					  <div class="col-sm-4">
						<div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">الرقم</label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control" id="VoucherNo" name="VoucherNo" readonly>
							</div>
						</div>
						</div>
						<div class="col-sm-4">
						<div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">التاريخ</label>
							<div class="col-sm-12 col-md-10">
									<input type="date" class="form-control vld" id="VoucherDate" name="VoucherDate" required>
							</div>
						</div>
						</div>
						 <div class="col-sm-4">
						<div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">الفرع</label>
							<div class="col-sm-12 col-md-10">
								<select class="form-control vld" id="BID" name="BID"  required></select>
							</div>
						</div>
						</div>
					</div>
					<div class="row">
					 
						<div class="col-sm-4">
						<div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">المخزن</label>
							<div class="col-sm-12 col-md-10">
									<select class="form-control vld" id="WhID" name="WhID"  required></select>
							</div>
						</div>
						</div>
						 <div class="col-sm-4 <?php echo $DocumentType!=1 && $DocumentType!=2 ? 'hidden':''; ?>" >
						<div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label"><?php echo $DocumentType==1?  'المورد' :'العميل'; ?></label>
							<div class="col-sm-12 col-md-10">
								<select class="form-control vld" id="VID_CID" name="VID_CID"  required></select>
							</div>
						</div>
						</div>
						<div class="col-sm-4">
						<div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">ملاحظات</label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control" id="Comment" name="Comment" />
							</div>
						</div>
						</div>
					</div>
				
				
					
					
				</div>
				<!-- Default Basic Forms End -->

				<!-- horizontal Basic Forms Start -->
		        	
				
					
				
						<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
							
							
					 <div class="table-responsive" style="max-height:20%">
                                    <table class="table table-bordered excel-table " id="exceltableRows">
                                        <thead>
                                            <tr>
                                                <th width="2%" class="hidebtn"><em class="fa fa-cog"></em></th>
                                                <th>م</th>
                                                <th width="12%">  العنصر    </th>
                                                <th width="12%" >  الوحدة      </th>
                                                <th width="12%">  الكمية       </th>
                                                <th width="12%" class="hidden">  المبلغ       </th>
												 <th width="12%" class="hidden">  الإجمالي       </th>
                                                <th>  ملاحظات      </th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                                <div class="panel-footer"><small>الإجمالي<span id="TableTotal"></span> </small></div>
					
				
				</div>
				<div class="row">
				<div class="col-sm-5"></div>
				<div class="col-sm-4">
				<div class="col-sm-3">	<button  type="submit" id="submitTransaction" class="btn btn-outline-dark" >حفظ </button></div>
		       <div class="col-sm-3 hidden"><button  type="button" class="btn btn-outline-dark ">تهيئة</button></div>
			      </div>
				</div>
				</form>
				<!-- horizontal Basic Forms End -->

			
			
			<?php include('include/footer.php'); ?>
		</div>
	</div>
	<?php include('include/script.php'); ?>
	<script src="vendors/scripts/excel-table.js"></script>
	<script src="src/plugins/sweetalert2/sweetalert2.all.js"></script>
	<link rel="stylesheet" type="text/css" href="src/plugins/sweetalert2/sweetalert2.css">

	<script>
	var valid=true;
	$(document).ready(function(){
		
		var getCurrentDate=function(){
			var now = new Date();

var day = ("0" + now.getDate()).slice(-2);
var month = ("0" + (now.getMonth() + 1)).slice(-2);

var today = now.getFullYear()+"-"+(month)+"-"+(day) ;
return today;
		};
		
		var getDate4OpeningStock=function(){
			var now = new Date();
             var FirsttDay = now.getFullYear()+"-01-01" ;
              return FirsttDay;
		};
		
		
		 var rows = "", TlInsTbl = 0;;
            for (let row = 0; row < 10; row++) {
                rows += "<tr >";
                rows += '<td class="hidden"><input type="hidden" name="rowId[]" value='+row+' /></td><td  onclick="removeRow(' + row + ')"  align="center" class="deleteRow dsblWnAprv hidebtn" > <a ><em class="fa fa-trash"></em></a>  </td><td>' + (row + 1) + '</td><td  ><select   class="form-control editable dsblWnAprv slcProducts checkQty " name="PID[]" ></select></td><td ><select   class="form-control editable dsblWnAprv slcUnits removeRedColor checkQty" name="unitID[]" onchange="setDefaultQty('+row+')" ></select></td><td><input type="number"  class="form-control editable dsblWnAprv removeRedColor checkQty"  name="quantity[]" onchange="calGross('+row+')"></td><td  class="hidden" ><input type="number" onchange="calGross('+row+')" value=1  class="form - control editable dsblWnAprv removeRedColor hidden" name="rate[]"></td><td name="gross[]"  class="hidden"></td><td><input type="text"  class="form - control editable dsblWnAprv" name="narration[]" ></td>';
                rows += "</tr>";
            }

            $(".excel-table tbody").html(rows);


            $(".excel-table").exceltable();
			
			
			$.post('serversideCalls/Ajax/MastersCRUD/List/',{ScreenType:JsDocumentType},function(v){
				var vendors=(JsDocumentType!=1 || JsDocumentType!=2)?'<option value=""> -------------------</option>':'<option value=0> -------------------</option>';
				var products='<option value="">-------------------</option>';
				var units='<option value="">-------------------</option>';
				var warehouses='<option value="" >-------------------</option>';
				var branches='<option value="">-------------------</option>';
				var masters=JSON.parse(v);
				console.log(masters);
				$.each(masters,function(k,i){
					if(i.type=='b')
						branches +='<option value='+i.id+'>'+i.title+'</option>';
					else if(i.type=='v' || i.type=='c')
						vendors +='<option value='+i.id+'>'+i.title+'</option>';
					else if(i.type=='n')
						vendors='<option value=0>'+i.title+'</option>';
					else if(i.type=='u')
						units +='<option value='+i.id+'>'+i.title+'</option>';
					else if(i.type=='w')
						warehouses +='<option value='+i.id+'>'+i.title+'</option>';
					else if(i.type=='p')
						products +='<option value='+i.id+'>'+i.title+'</option>';
					
						
					
				});
				$('.slcProducts').html(products);
				$('.slcUnits').html(units);
				$('#BID').html(branches);
				$('#WhID').html(warehouses);
				$('#VID_CID').html(vendors);
				
				
		if(JsDocumentStatus==2)
		{
			$.each(JsHeaderData,function(k,i){
				$('#THID').val(i.THID);
				$('#VoucherNo').val(i.VoucherNo);
				$('#VoucherDate').val(i.VoucherDate);
				if(JsDocumentType==5)
					$('#VoucherDate').attr('readonly',true);
				$('#BID').val(i.BID);
				$('#WhID').val(i.WhID);
				$('#VID_CID').val(i.VID_CID);
				$('#Comment').val(i.Comment);
				
			});
			console.log(JsBodyData);
			  $.each(JsBodyData, function (k, i) {
                            $('select[name="PID[]"]').eq(i.rowId).val(i.PID);
                            $('select[name="unitID[]"]').eq(i.rowId).val(i.unitID);
                            $('input[name="quantity[]"]').eq((i.rowId)).val(i.quantity);
                            $('input[name="rate[]"]').eq((i.rowId)).val(i.rate);
                            $('td[name="gross[]"]').eq(i.rowId).html(i.gross);
                            $('input[name="narration[]"]').eq((i.rowId)).val(i.narration);
							
                        });
			
		}
		else 
		{
			if(JsDocumentType==5)
			   $('#VoucherDate').val(getDate4OpeningStock()).attr('readonly',true);
			else 
			   $('#VoucherDate').val(getCurrentDate());
			
			   $('#BID').val(1);
				$('#WhID').val(1);
			
		}
				
				
	});
          $('.removeRedColor').on('keydown',function(e){
			  $(this).css('border','none');
		  });
       $('#transactionForm').on('submit',function(e){
		   e.preventDefault();
		
		 
		 var body=[];
		 $('select[name="PID[]"]').each(function(k,i){
			 if ($(this).val() !=0) {
                    if (!$('input[name="quantity[]"]').eq(k).val() ) { valid = false; $('input[name="quantity[]"]').eq(k).css("border", "1px solid red"); }
                    else if(!$('input[name="rate[]"]').eq(k).val() ) { valid = false; $('input[name="rate[]"]').eq(k).css("border", "1px solid red"); }
					else if(!$('select[name="unitID[]"]').eq(k).val()) { valid = false; $('input[name="unitID[]"]').eq(k).css("border", "1px solid red"); }
					
					else {
						body.push({"PID":$(this).val(),"rowId":$('input[name="rowId[]"]').eq(k).val(),"unitID":$('select[name="unitID[]"]').eq(k).val(),"quantity":$('input[name="quantity[]"]').eq(k).val(),"rate":$('input[name="rate[]"]').eq(k).val(),"gross":$('td[name="gross[]"]').eq(k).html(),"narration":$('input[name="narration[]"]').eq(k).val()});
						valid=true;
					}
                }
				
		 });
		  var dataS=  $('#transactionForm').serializeArray();
		   dataS.push({'name':'type','value':JsDocumentType})
		  dataS.push({'name':'body','value':JSON.stringify(body)})
		
		 if(body.length==0)
		 {  swal(
                {
                    type: 'error',
                    title: 'خطأ',
                    text: 'الرجاء اضافة صنف واحد على الأقل!',
                }
            )
			
			 valid=false;
		 }
		 else 
		 { $('.vld').each(function( i ) {
			 // alert($(this).val());
			 if($(this).val()!=null)
				 valid=true;
				else 
				{ swal(
                {
                    type: 'error',
                    title: 'خطأ',
                    text: 'الرجاء تعبئة الحقول الإجبارية!',
                }
            );
			
				valid=false;}
    
		     });
		 }
		 
		
		 
		
		 
		 if(valid)
		 {
			  console.log(dataS);
			  
		 $.post('serversideCalls/Ajax/TransactionsCRUD/'+(JsDocumentStatus==1?"Insert":"Update")+'/',dataS,function(r){
			 
			 if(r>0)
			 {swal(
                {
                    title: 'تم!',
                    text: 'تم الحفظ بنجاح!',
                    type: 'success',
                    showCancelButton: false,
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger'
                }
				
					
            );
			setTimeout(function() { window.location.href = "/inventorySys/table_transactions.php?type="+<?php echo $DocumentType; ?>;; }, 2000); 
			 }
			else 
				swal(
                {
                    type: 'error',
                    title: 'خطأ',
                    text: r,
                }
            )
			
			 
		 });
		 }
		 
		 
		 
		   
	   });
       
		$('input[name="DispalcedState"]').on('change',function(e){
			if($('#customRadio3').is(":checked"))
			$('#DisplacedDiv').css('display','block');
		else 
		$('#DisplacedDiv').css('display','none');
	}).trigger('change');;
	
	
	
	//Fill the fields if the document is created 
	if(JsDocumentStatus==2)
		{
			$.each(JsHeaderData,function(k,i){
				$('#THID').val(i.THID);
				$('#VoucherNo').val(i.VoucherNo);
				$('#VoucherDate').val(i.VoucherDate);
				$('#BID').val(i.BID);
				$('#BID').val(i.BID);
				$('#VID_CID').val(i.VID_CID);
				$('#Comment').val(i.Comment);
				
			});
			
		}
	});
	function setDefaultQty(rowId)
	{
		$('input[name="quantity[]"]').eq(rowId).val(1)
	}
		function calGross(rowId){
			if($('select[name="PID[]"]').eq(rowId).val()!=0 && $('select[name="unitID[]"]').eq(rowId).val()!=0  )
			{if( $('input[name="quantity[]"]').eq(rowId).val() && $('input[name="rate[]"]').eq(rowId).val())
			  $('td[name="gross[]"]').eq(rowId).html(parseFloat($('input[name="quantity[]"]').eq(rowId).val()) *parseFloat($('input[name="rate[]"]').eq(rowId).val()));
		         valid=true;
			}
			else {alert('الرجاء اختيار الصنف والوحدة'); 
			valid=false;
			}
			
		
		      
			
			
			
			
		};
		
	
		
	</script>
</body>
</html>