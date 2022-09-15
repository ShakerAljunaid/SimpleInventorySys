<!DOCTYPE html>
<html dir="rtl">
<head>
	<?php include('include/head.php'); ?>
</head>
<body >
	<?php include('include/header.php'); ?>
	<?php include('include/sidebar.php'); ?>
	<?php 
	$sql = 'SELECT * FROM vendors';
$vendorata = $pdo->query($sql)->fetchAll();

 echo '<script> var JsvendorData='.json_encode($vendorata).'; </script>'; ?>
	<div class="main-container">
		<div class="pd-ltr-20 customscroll customscroll-10-p height-100-p xs-pd-20-10">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.php">الأدلة</a></li>
									<li class="breadcrumb-item active" aria-current="page">الموردين</li>
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
					<table class="table" id="vendorTabla" data-toggle="table" >
						<thead>
							<tr>
								 <th  data-field="VID" data-width="3%"  data-sortable="true">م</th>
								 <th  data-field="vname"  data-sortable="true">الإسم</th>
								  <th  data-field="phone"  data-sortable="true">رقم الجوال </th>
								 <th  data-field="address"  data-sortable="true">العنوان </th>
								  <th  data-field="status"  data-sortable="true">الحالة </th>
								 
							    <th data-formatter="EditvendorFormatter" >تعديل</th>
								
							</tr>
						</thead>
						<tbody>
						
						</tbody>
					</table>
			<div class="modal fade" id="vendorRegModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <form id="vendorForm">
	  <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <center><h4 class="modal-title" >بيانات المورد</h4></center>
            </div>
			
            <div class="modal-body" >
			          <input type="hidden" class="form-control" id="VID" value=0  name="VID"  />
	                 <div class="form-group"> <label >الاسم <span class="rqd">*</span> :</label><input type="text" class="form-control" id="vname"  name="vname"  required /></div>
				      <div class="form-group"> <label >رقم الجوال <span class="rqd"></span> :</label><input type="number" class="form-control" id="phone"  name="phone"  /></div>
					<div class="form-group"> <label >العنوان <span class="rqd"></span> :</label><input type="text" class="form-control" id="address"  name="address"  /></div>
                       <div>
                           <input type="radio" id="active" name="status" value="1" checked />
                      <label for="active">نشط</label><br>
                      <input type="radio" id="disactive" name="status" value="0" /> 
                      <label for="disactive">موقف</label><br>
                    </div>
                      
					
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
console.log(JsvendorData);
	$('#vendorTabla').bootstrapTable('load',JsvendorData);
	$('#vendorForm').on('submit',function(e){
		e.preventDefault();
		
	   let dataS=$('#vendorForm').serializeArray();
	   console.log(dataS);
		if($('#VID').val()>0)
		{
			$.post('serversideCalls/Ajax/MastersCRUD/Vendors/Update.php',dataS,function(r){
				if(r!='failed')
		       $('#vendorTabla').bootstrapTable('load',JSON.parse(r));
			 $('#vendorRegModal').modal('hide');
			});
		}
		else
		{
			$.ajax({url:'serversideCalls/Ajax/MastersCRUD/Vendors/Insert.php',type:"post",data:dataS,success:function(r){
			if(r!='failed')
		       $('#vendorTabla').bootstrapTable('load',JSON.parse(r));
			 $('#vendorRegModal').modal('hide');
			 
			 
		    }});
		}
		
		
		
	});
	
   $('#btnAddNew').on('click',function(e){
	    $('input[type="text"],input[type="number"]').val('');
		
       
	    $('#VID').val(0);
    $('#vendorRegModal').modal('show');
   });

});
   function setData4Edit(qstdt)
    {
        var vendorData = JSON.parse(decodeURIComponent(qstdt));
	

        $('#VID').val(vendorData.VID);$('#vname').val(vendorData.vname);$('#phone').val(vendorData.phone); 
		$('#address').val(vendorData.address); $('#status').val(vendorData.status);  
		
		
        $('#vendorRegModal').modal('show');
		 
    }

 function EditvendorFormatter(value, row, index) {
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

        var vendorData = JSON.parse(decodeURIComponent(qstdt));
		
	   $.post('Ajax/PatientCRUD/Delete.php',vendorData,function(r){
			console.log((r));
			if(r!='failed')
		       $('#vendorTabla').bootstrapTable('load',JSON.parse(r));
			
			
		});
		}
		 
    }

	
</script>
</body>
</html>