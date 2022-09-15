<!DOCTYPE html>
<html dir="rtl">
<head>
	<?php include('include/head.php'); ?>
</head>
<body >
	<?php include('include/header.php'); ?>
	<?php include('include/sidebar.php'); ?>
	<?php 
	$sql = 'SELECT * FROM Products';
$Productata = $pdo->query($sql)->fetchAll();

 echo '<script> var JsProductData='.json_encode($Productata).'; </script>'; ?>
	<div class="main-container">
		<div class="pd-ltr-20 customscroll customscroll-10-p height-100-p xs-pd-20-10">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.php">الأدلة</a></li>
									<li class="breadcrumb-item active" aria-current="page">الأصناف</li>
								</ol>
							</nav>
						</div>
						
					</div>
				</div>
				<!-- basic table  Start -->
				<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
					<div class="clearfix mb-20">
						
						<div class="pull-right">
							<a href="#basic-table" id="btnAddNew" class="btn btn-primary btn-sm scroll-click" rel="content-y"  data-toggle="collapse" role="button"><i class="fa fa-plus"></i> جديد</a>
						</div>
					</div>
					<table class="table" id="ProductTabla" data-toggle="table" >
						<thead>
							<tr>
								 <th  data-field="PID" data-width="3%"  data-sortable="true">م</th>
								 <th  data-field="PTitle"  data-sortable="true">الصنف</th>
								 <th  data-field="company"  data-sortable="true">الشركة </th>
								 
							    <th data-formatter="EditProductFormatter" >تعديل</th>
								
							</tr>
						</thead>
						<tbody>
						
						</tbody>
					</table>
			<div class="modal fade" id="ProductRegModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <form id="ProductForm">
	  <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <center><h4 class="modal-title" >بيانات المستخدم</h4></center>
            </div>
			
            <div class="modal-body" >
			          <input type="hidden" class="form-control" id="PID" value=0  name="PID"  />
	                 <div class="form-group"> <label >الصنف <span class="rqd">*</span> :</label><input type="text" class="form-control" id="PTitle"  name="PTitle"  required /></div>
				      <div class="form-group"> <label >الشركة <span class="rqd">*</span> :</label><input type="text" class="form-control" id="company"  name="company"  /></div>
					
                     
                      
					
				 </div>
            <div class="modal-footer">
                <button type="submit" id="btnSubmit" class="btn btn-primary" >حفظ</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>
               
                </div>     
            </div>
          </div>
        </form>
    </div>
			</div>
			<?php include('include/footer.php'); ?>
		</div>
	</div>
	<?php include('include/script.php'); ?>
	<script>


$(function(){
console.log(JsProductData);
	$('#ProductTabla').bootstrapTable('load',JsProductData);
	$('#ProductForm').on('submit',function(e){
		e.preventDefault();
		
	   let dataS=$('#ProductForm').serializeArray();
	   console.log(dataS);
		if($('#PID').val()>0)
		{
			$.post('serversideCalls/Ajax/MastersCRUD/Products/Update.php',dataS,function(r){
				if(r!='failed')
		       $('#ProductTabla').bootstrapTable('load',JSON.parse(r));
			 $('#ProductRegModal').modal('hide');
			});
		}
		else
		{
			$.ajax({url:'serversideCalls/Ajax/MastersCRUD/Products/Insert.php',type:"post",data:dataS,success:function(r){
			if(r!='failed')
		       $('#ProductTabla').bootstrapTable('load',JSON.parse(r));
			 $('#ProductRegModal').modal('hide');
			 
			 
		    }});
		}
		
		
		
	});
	
   $('#btnAddNew').on('click',function(e){
	    $('input[type="text"],input[type="number"]').val('');
		
       
	    $('#PID').val(0);
    $('#ProductRegModal').modal('show');
   });

});
   function setData4Edit(qstdt)
    {
        var ProductData = JSON.parse(decodeURIComponent(qstdt));
	

        $('#PID').val(ProductData.PID);$('#PTitle').val(ProductData.PTitle);$('#company').val(ProductData.company); 
		
        
        $('#ProductRegModal').modal('show');
		 
    }

 function EditProductFormatter(value, row, index) {
        return [
            '<a class="like btnEditDataElement"  title="Like" href="javascript:void(0)" onclick="setData4Edit(\'' + encodeURIComponent(JSON.stringify(row)) + '\');">',
            '<i class="fa fa-edit"></i> <span class="label label-primary">تعديل</span>',
            '</a>'


        ].join('');


    }
	
	function setDataFormData4Delete(qstdt)
    {
       
		r = confirm("هل انت متأكد من حذف هذا السجل؟");
        if (r == true) {

        var ProductData = JSON.parse(decodeURIComponent(qstdt));
		
	   $.post('Ajax/PatientCRUD/Delete.php',ProductData,function(r){
			console.log((r));
			if(r!='failed')
		       $('#ProductTabla').bootstrapTable('load',JSON.parse(r));
			
			
		});
		}
		 
    }

	
</script>
</body>
</html>