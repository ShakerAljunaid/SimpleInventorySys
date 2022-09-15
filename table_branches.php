<!DOCTYPE html>
<html dir="rtl">
<head>
	<?php include('include/head.php'); ?>
</head>
<body >
	<?php include('include/header.php'); ?>
	<?php include('include/sidebar.php'); ?>
	<?php 
	$sql = 'SELECT * FROM branches';
$branchata = $pdo->query($sql)->fetchAll();

 echo '<script> var JsbranchData='.json_encode($branchata).'; </script>'; ?>
	<div class="main-container">
		<div class="pd-ltr-20 customscroll customscroll-10-p height-100-p xs-pd-20-10">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.php">الأدلة</a></li>
									<li class="breadcrumb-item active" aria-current="page">الفروع</li>
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
					<table class="table" id="branchTabla" data-toggle="table" >
						<thead>
							<tr>
								 <th  data-field="BID" data-width="3%"  data-sortable="true">م</th>
								 <th  data-field="BTitle"  data-sortable="true">الفرع</th>
								 <th  data-field="address"  data-sortable="true">العنوان </th>
								 
							    <th data-formatter="EditbranchFormatter" >تعديل</th>
								
							</tr>
						</thead>
						<tbody>
						
						</tbody>
					</table>
			<div class="modal fade" id="branchRegModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <form id="branchForm">
	  <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <center><h4 class="modal-title" >بيانات الفرع</h4></center>
            </div>
			
            <div class="modal-body" >
			          <input type="hidden" class="form-control" id="BID" value=0  name="BID"  />
	                 <div class="form-group"> <label >الفرع <span class="rqd">*</span> :</label><input type="text" class="form-control" id="BTitle"  name="BTitle"  required /></div>
				      <div class="form-group"> <label >العنوان <span class="rqd"></span> :</label><input type="text" class="form-control" id="address"  name="address"  /></div>
					
                     
                      
					
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
console.log(JsbranchData);
	$('#branchTabla').bootstrapTable('load',JsbranchData);
	$('#branchForm').on('submit',function(e){
		e.preventDefault();
		
	   let dataS=$('#branchForm').serializeArray();
	   console.log(dataS);
		if($('#BID').val()>0)
		{
			$.post('serversideCalls/Ajax/MastersCRUD/Branches/Update.php',dataS,function(r){
				if(r!='failed')
		       $('#branchTabla').bootstrapTable('load',JSON.parse(r));
			 $('#branchRegModal').modal('hide');
			});
		}
		else
		{
			$.ajax({url:'serversideCalls/Ajax/MastersCRUD/Branches/Insert.php',type:"post",data:dataS,success:function(r){
			if(r!='failed')
		       $('#branchTabla').bootstrapTable('load',JSON.parse(r));
			 $('#branchRegModal').modal('hide');
			 
			 
		    }});
		}
		
		
		
	});
	
   $('#btnAddNew').on('click',function(e){
	    $('input[type="text"],input[type="number"]').val('');
		
       
	    $('#BID').val(0);
    $('#branchRegModal').modal('show');
   });

});
   function setData4Edit(qstdt)
    {
        var branchData = JSON.parse(decodeURIComponent(qstdt));
	

        $('#BID').val(branchData.BID);$('#BTitle').val(branchData.BTitle);$('#address').val(branchData.address); 
		
        
        $('#branchRegModal').modal('show');
		 
    }

 function EditbranchFormatter(value, row, index) {
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

        var branchData = JSON.parse(decodeURIComponent(qstdt));
		
	   $.post('Ajax/PatientCRUD/Delete.php',branchData,function(r){
			console.log((r));
			if(r!='failed')
		       $('#branchTabla').bootstrapTable('load',JSON.parse(r));
			
			
		});
		}
		 
    }

	
</script>
</body>
</html>