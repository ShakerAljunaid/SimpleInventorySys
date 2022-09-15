<!DOCTYPE html>
<html dir="rtl">
<head>
	<?php include('include/head.php'); ?>
</head>
<body >
	<?php include('include/header.php'); ?>
	<?php include('include/sidebar.php'); ?>
	<?php 
	$sql = 'SELECT * FROM warehouses';
$Warehousedata = $pdo->query($sql)->fetchAll();

$sql='SELECT * FROM branches;';
$branchesdata = $pdo->query($sql)->fetchAll();
 echo '<script> var JsWarehouseData='.json_encode($Warehousedata).'; var JsBranchesData='.json_encode($branchesdata).'; </script>'; ?>
	<div class="main-container">
		<div class="pd-ltr-20 customscroll customscroll-10-p height-100-p xs-pd-20-10">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.php">الأدلة</a></li>
									<li class="breadcrumb-item active" aria-current="page">المخازن</li>
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
					<table class="table" id="WarehouseTabla" data-toggle="table" >
						<thead>
							<tr>
								 <th  data-field="WID" data-width="3%"  data-sortable="true">م</th>
								 <th  data-field="WTitle"  data-sortable="true">المخزن</th>
								 <th  data-field="BID"  data-sortable="true">الفرع </th>
								 
							    <th data-formatter="EditWarehouseFormatter" >تعديل</th>
								
							</tr>
						</thead>
						<tbody>
						
						</tbody>
					</table>
			<div class="modal fade" id="WarehouseRegModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <form id="WarehouseForm">
	  <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <center><h4 class="modal-title" >بيانات المخزن</h4></center>
            </div>
			
            <div class="modal-body" >
			          <input type="hidden" class="form-control" id="WID" value=0  name="WID"  />
	                 <div class="form-group"> <label >المخزن <span class="rqd">*</span> :</label><input type="text" class="form-control" id="WTitle"  name="WTitle"  required /></div>
				      <div class="form-group"> <label >الفرع <span class="rqd"></span> :</label><select  class="form-control" id="BID"  name="BID"  required ></select></div>
					
                     
                      
					
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
console.log(JsWarehouseData);
var branches='<option value=0>--------</option>';
	$('#WarehouseTabla').bootstrapTable('load',JsWarehouseData);
	
	$.each(JsBranchesData,function(k,i){branches+='<option value='+i.BID+'>'+i.BTitle+'</option>'});
	$('#BID').html(branches);
	$('#WarehouseForm').on('submit',function(e){
		e.preventDefault();
		
	   let dataS=$('#WarehouseForm').serializeArray();
	   console.log(dataS);
		if($('#WID').val()>0)
		{
			$.post('serversideCalls/Ajax/MastersCRUD/Warehouses/Update.php',dataS,function(r){
				if(r!='failed')
		       $('#WarehouseTabla').bootstrapTable('load',JSON.parse(r));
			 $('#WarehouseRegModal').modal('hide');
			});
		}
		else
		{
			$.ajax({url:'serversideCalls/Ajax/MastersCRUD/Warehouses/Insert.php',type:"post",data:dataS,success:function(r){
			if(r!='failed')
		       $('#WarehouseTabla').bootstrapTable('load',JSON.parse(r));
			 $('#WarehouseRegModal').modal('hide');
			 
			 
		    }});
		}
		
		
		
	});
	
   $('#btnAddNew').on('click',function(e){
	    $('input[type="text"],input[type="number"]').val('');
		
       
	    $('#WID').val(0);
    $('#WarehouseRegModal').modal('show');
   });

});
   function setData4Edit(qstdt)
    {
        var WarehouseData = JSON.parse(decodeURIComponent(qstdt));
	

        $('#WID').val(WarehouseData.WID);$('#WTitle').val(WarehouseData.WTitle);$('#BID').val(WarehouseData.BID); 
		
        
        $('#WarehouseRegModal').modal('show');
		 
    }

 function EditWarehouseFormatter(value, row, index) {
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

        var WarehouseData = JSON.parse(decodeURIComponent(qstdt));
		
	   $.post('Ajax/PatientCRUD/Delete.php',WarehouseData,function(r){
			console.log((r));
			if(r!='failed')
		       $('#WarehouseTabla').bootstrapTable('load',JSON.parse(r));
			
			
		});
		}
		 
    }

	
</script>
</body>
</html>