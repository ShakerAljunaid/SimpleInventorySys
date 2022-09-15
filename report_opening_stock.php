<!DOCTYPE html>
<html>
<head>
	<?php include('include/head.php'); ?>
	<link rel="stylesheet" type="text/css" href="src/plugins/datatables/media/css/jquery.dataTables.css">
	<link rel="stylesheet" type="text/css" href="src/plugins/datatables/media/css/dataTables.bootstrap4.css">
	<link rel="stylesheet" type="text/css" href="src/plugins/datatables/media/css/responsive.dataTables.css">
</head>
<body>
	<?php include('include/header.php'); ?>
	<?php include('include/sidebar.php'); ?>
	<?php
	
	$sql = 'select b.THID,h.TType,h.VoucherNo,h.VoucherDate,h.Comment,u.unitTitle,p.PTitle,case when h.ttype=1 or h.ttype=3 or h.ttype=5 then sum(quantity) else 0 end as qtyReceived,case when h.ttype=2 or h.ttype=4 then sum(quantity) else 0 end as qtyIssued ,case when h.TType=1 then (SELECT vname from vendors where VID=h.VID_CID) else (SELECT cname from clients where CID=h.VID_CID) end as Beneficiary,a.userName,sum(b.gross) as TotalAmount from transactionsbody b join transactionsheader h on h.THID=b.THID join products p on p.PID=b.PID join units u on u.unitID=b.unitID 
  JOIN useraccount a on a.userID=h.userID where ttype=5   GROUP by p.PID, h.THID  order by h.THID desc';
$Transactiondata = $pdo->query($sql)->fetchAll();

	echo '<script> var JsOpeningStockData='.json_encode($Transactiondata).';  </script>'; ?>
	<div class="main-container">
		<div class="pd-ltr-20 customscroll customscroll-10-p height-100-p xs-pd-20-10">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>المخزون الافتتاحي</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.php">الرئيسية</a></li>
									<li class="breadcrumb-item active" aria-current="page">المخزون الافتتاحي</li>
								</ol>
							</nav>
						</div>
						<div class="col-md-6 col-sm-12 text-right hidden">
							<div class="dropdown">
								<a class="btn btn-primary dropdown-toggle" href="#" role="button" data-toggle="dropdown">
									January 2018
								</a>
								<div class="dropdown-menu dropdown-menu-right">
									<a class="dropdown-item" href="#">Export List</a>
									<a class="dropdown-item" href="#">Policies</a>
									<a class="dropdown-item" href="#">View Assets</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<!-- Simple Datatable start -->
				<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
					
			
				<!-- multiple select row Datatable End -->
				<!-- Export Datatable start -->
				<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
					
					<div class="row">
						<table class="stripe hover multiple-select-row data-table-export nowrap" id="OpeningStock">
							
						</table>
					</div>
				</div>
				<!-- Export Datatable End -->
			</div>
			<?php include('include/footer.php'); ?>
		</div>
	</div>
	<?php include('include/script.php'); ?>
	<script src="src/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
	<script src="src/plugins/datatables/media/js/dataTables.bootstrap4.js"></script>
	<script src="src/plugins/datatables/media/js/dataTables.responsive.js"></script>
	<script src="src/plugins/datatables/media/js/responsive.bootstrap4.js"></script>
	<!-- buttons for Export datatable -->
	<script src="src/plugins/datatables/media/js/button/dataTables.buttons.js"></script>
	<script src="src/plugins/datatables/media/js/button/buttons.bootstrap4.js"></script>
	<script src="src/plugins/datatables/media/js/button/buttons.print.js"></script>
	<script src="src/plugins/datatables/media/js/button/buttons.html5.js"></script>
	<script src="src/plugins/datatables/media/js/button/buttons.flash.js"></script>
	<script src="src/plugins/datatables/media/js/button/pdfmake.min.js"></script>
	<script src="src/plugins/datatables/media/js/button/vfs_fonts.js"></script>
	<script>
		$('document').ready(function(){
			
			var buildDataTable=function(TransactionData)
			{
				$("#OpeningStock").DataTable({
				paging: false,
            "processing": true, // for show progress bar
          "serverSide": false, // for process server side
            "filter": false, // this is for disable filter (search bo
            "filter": false, // this is for disable filter (search box)
            "orderMulti": false, // for disable multiple column at once
            "data": TransactionData,

            "columns": [
                    { "title": "#", "data": "THID", "name": "THID", Width: "7%" },
				
					{
                        "title": "نوع المستند",
                        "data": "TType",
                        "name": "TType",
                        Width: "10%",
                        "render": function (data, type, row) {
                            if (data==1)
                                return 'توريد مخزني';
							else if (data==2)
                                return 'صرف مخزني';
							else if (data==3)
                                return 'زيادة مخزنية';
							else if (data==4)
                                return 'نقص مخزني';
							else if (data==5)
                                return 'مخزون افتتاحي';
                            else 
                                return null;
                        },
                    },
					 {
                        "title": "التاريخ",
                        "data": "VoucherDate",
                        "name": "VoucherDate",
                        Width: "10%",
                        "render": function (data, type, row) {
                            if (data)
                                return window.moment(data).format("MM-DD-YYYY");
                            else
                                return null;
                        },
                    },
					 { "title": "المستخدم", "data": "userName", "name": "userName", Width: "7%" },
					  { "title": "الصنف", "data": "PTitle", "name": "PTitle", Width: "7%" },
                    { "title": "الوحدة", "data": "unitTitle", "name": "unitTitle", Width: "7%" },
					{ "title": "الكمية الواردة", "data": "qtyReceived", "name": "qtyReceived", Width: "7%" },
					{ "title": "الكمية الصادرة", "data": "qtyIssued", "name": "qtyIssued", Width: "7%" },
					{ "title": "الإجمالي", "data": "TotalAmount", "name": "TotalAmount", Width: "7%" },
					
					
                    { "title": "ملاحظة", "data": "Comment", "name": "Comment", Width: "15%" },
                    
                  
                    
                    {
                        data: "THID" ,
                        'render': function (data, type, row) {
                            
                            return '<a class="badge badge-info"  target="_blank" href="form_transactions.php?TransactionId='+row['THID']+'&type='+row['TType']+'"  ><span class="fa fa-repeat"></span> </a> ';
                        },
                        "Width": "2%"
                    }

            ],
			 orderCellsTop: true,
        fixedHeader: true,
            scrollX: true,
            scrollCollapse: true,
            autoWidth: false,
            responsive: true,
            fixedColumns: true,
			scrollCollapse: true,
				autoWidth: false,
				responsive: true,
				columnDefs: [{
					targets: "datatable-nosort",
					orderable: false,
				}],
				"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
				"language": {
					"info": "_START_-_END_ of _TOTAL_ entries",
					searchPlaceholder: "Search"
				},
				dom: 'Bfrtip',
				buttons: [
				'copy', 'csv', 'pdf', 'print'
				]

        });
			};
			buildDataTable(JsOpeningStockData);
		
    
			
			var table = $('.select-row').DataTable();
			$('.select-row tbody').on('click', 'tr', function () {
				if ($(this).hasClass('selected')) {
					$(this).removeClass('selected');
				}
				else {
					table.$('tr.selected').removeClass('selected');
					$(this).addClass('selected');
				}
			});
			var multipletable = $('.multiple-select-row').DataTable();
			$('.multiple-select-row tbody').on('click', 'tr', function () {
				$(this).toggleClass('selected');
			});
		});
	</script>
</body>
</html>