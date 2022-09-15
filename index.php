<!DOCTYPE html>
<html>
<head>
	<?php include('include/head.php'); ?>
</head>
<body>
	<?php include('include/header.php'); ?>
	<?php include('include/sidebar.php'); ?>
	<?php 
	$sql="select count(*) NoOfTransactions ,TType,DAYNAME(VoucherDate) Day from   transactionsheader 
  where (CURDATE() -VoucherDate  )<7   group  by VoucherDate, TType;";
  $transactionDates=$pdo->query($sql)->fetchAll();
   $sql=" select  * from ProductsBalance   where balance<11 or balance is null order by balance desc limit 5;";
   $ProductsBalances=$pdo->query($sql)->fetchAll();
    $sql="  select u.userName,( select  count(*) from transactionsheader where  userID=u.userID) as NoOfTranactions from useraccount u";
   $UsersTransactions=$pdo->query($sql)->fetchAll();
  
  $sql="select count(*) noOf,'c' type from clients
  union   
select count(*) noOf,'v' type from vendors
  UNION 
  select count(*) noOf,'p' type from products
  union 
  select count(*) noOf,'t' type from transactionsheader";
  $Counts=$pdo->query($sql)->fetchAll();
  
  $sql='select w.WTitle,(select count(*) from transactionsheader where WhID=w.WID) NoOfTransactions  from warehouses w';
  $WarehouseTranactions=$pdo->query($sql)->fetchAll();
  
 
  echo '<script> var JsTransactionDates='.json_encode($transactionDates).';var JsProductsBalances='.json_encode($ProductsBalances).';var JsUsersTransactions='.json_encode($UsersTransactions).';var JsCounts='.json_encode($Counts).';var JsWarehouseTransactions='.json_encode($WarehouseTranactions).';</script>';
  ?>
  
	<div class="main-container">
		<div class="pd-ltr-20 customscroll customscroll-10-p height-100-p xs-pd-20-10">
			<div class="row clearfix progress-box">
				<div class="col-lg-3 col-md-6 col-sm-12 mb-30">
					<div class="bg-white pd-20 box-shadow border-radius-5 height-100-p">
						<div class="project-info clearfix">
							<div class="project-info-left">
								<div class="icon box-shadow bg-blue text-white">
									<i class="fa fa-briefcase"></i>
								</div>
							</div>
							<div class="project-info-right">
								<span class="no text-blue weight-500 font-24 NoOfTranactions" >40</span>
								<p class="weight-400 font-18">عدد العمليات</p>
							</div>
						</div>
						<div class="project-info-progress">
							<div class="row clearfix">
								<div class="col-sm-6 text-muted weight-500"></div>
								<div class="col-sm-6 text-right weight-500 font-14 text-muted NoOfTranactions">40</div>
							</div>
							<div class="progress" style="height: 10px;">
								<div class="progress-bar bg-blue progress-bar-striped progress-bar-animated" role="progressbar" style="width: 40%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 col-sm-12 mb-30">
					<div class="bg-white pd-20 box-shadow border-radius-5 height-100-p">
						<div class="project-info clearfix">
							<div class="project-info-left">
								<div class="icon box-shadow bg-light-green text-white">
									<i class="fa fa-handshake-o"></i>
								</div>
							</div>
							<div class="project-info-right">
								<span class="no text-light-green weight-500 font-24 NoOfProductsNoOfProducts" ></span>
								<p class="weight-400 font-18">عدد الاصناف</p>
							</div>
						</div>
						<div class="project-info-progress">
							<div class="row clearfix">
								<div class="col-sm-6 text-muted weight-500"></div>
								<div class="col-sm-6 text-right weight-500 font-14 text-muted NoOfProducts">50</div>
							</div>
							<div class="progress" style="height: 10px;">
								<div class="progress-bar bg-light-green progress-bar-striped progress-bar-animated" role="progressbar" style="width: 50%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 col-sm-12 mb-30">
					<div class="bg-white pd-20 box-shadow border-radius-5 height-100-p">
						<div class="project-info clearfix">
							<div class="project-info-left">
								<div class="icon box-shadow bg-light-orange text-white">
									<i class="fa fa-list-alt"></i>
								</div>
							</div>
							<div class="project-info-right">
								<span class="no text-light-orange weight-500 font-24 NoOfVendors"></span>
								<p class="weight-400 font-18">عدد الموردين</p>
							</div>
						</div>
						<div class="project-info-progress">
							<div class="row clearfix">
								<div class="col-sm-6 text-muted weight-500"></div>
								<div class="col-sm-6 text-right weight-500 font-14 text-muted"></div>
							</div>
							<div class="progress" style="height: 10px;">
								<div class="progress-bar bg-light-orange progress-bar-striped progress-bar-animated" role="progressbar" style="width: 80%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 col-sm-12 mb-30">
					<div class="bg-white pd-20 box-shadow border-radius-5 margin-5 height-100-p">
						<div class="project-info clearfix">
							<div class="project-info-left">
								<div class="icon box-shadow bg-light-purple text-white">
									<i class="fa fa-podcast"></i>
								</div>
							</div>
							<div class="project-info-right">
								<span class="no text-light-purple weight-500 font-24 NoOfClients"></span>
								<p class="weight-400 font-18 ">عدد العملاء</p>
							</div>
						</div>
						<div class="project-info-progress">
							<div class="row clearfix">
								<div class="col-sm-6 text-muted weight-500"></div>
								<div class="col-sm-6 text-right weight-500 font-14 text-muted"></div>
							</div>
							<div class="progress" style="height: 10px;">
								<div class="progress-bar bg-light-purple progress-bar-striped progress-bar-animated" role="progressbar" style="width: 75%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="bg-white pd-20 box-shadow border-radius-5 mb-30">
				<h4 class="mb-30">العمليات</h4>
				<div class="row">
					<div class="col-sm-12 col-md-8 col-lg-9 xs-mb-20">
						<div id="areaspline-chart" style="min-width: 210px; height: 400px; margin: 0 auto"></div>
					</div>
					<div class="col-sm-12 col-md-4 col-lg-3">
						<h5 class="mb-30 weight-500">الاصناف قريبة النفاذ</h5>
						<div id="near2EndProducts"></div>
					</div>
				</div>
			</div>
			<div class="row clearfix">
				<div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 mb-30">
					<div class="bg-white pd-20 box-shadow border-radius-5 height-100-p">
						<h4 class="mb-30">عدد العمليات حسب المستخدمين</h4>
						<div class="device-manage-progress-chart">
							<ul  id='UserTransactions'>
								
							</ul>
						</div>
					</div>
				</div>
				<div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-30">
					<div class="bg-white pd-20 box-shadow border-radius-5 height-100-p">
						<h4 class="mb-30">المخازن حسب العمليات</h4>
						<div class="clearfix device-usage-chart">
							<div class="width-50-p pull-left">
								<div id="device-usage" style="min-width: 180px; height: 200px; margin: 0 auto"></div>
							</div>
							<div class="width-50-p pull-left">
								<table style="width: 100%;">
									<thead>
										<tr>
											<th class="weight-500"><p>المخزن</p></th>
											<th class="text-right weight-500"><p>نسبة العمليات</p></th>
										</tr>
									</thead>
									<tbody id="WarehouseTranactions">
										
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-30">
					<div class="bg-white pd-20 box-shadow border-radius-5 height-100-p">
						<h4 class="mb-30">عدد العمليات السنوية</h4>
						<div class="clearfix device-usage-chart">
							<div class="width-50-p pull-left">
								<div id="ram" style="min-width: 160px; max-width: 180px; height: 200px; margin: 0 auto"></div>
							</div>
							<div class="width-50-p pull-left">
								<div id="cpu" style="min-width: 160px; max-width: 180px; height: 200px; margin: 0 auto"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		
				
			</div>
			<?php include('include/footer.php'); ?>
		</div>
	</div>
	<?php include('include/script.php'); ?>
	<script src="src/plugins/highcharts-6.0.7/code/highcharts.js"></script>
	<script src="src/plugins/highcharts-6.0.7/code/highcharts-more.js"></script>
	<script type="text/javascript">
	
	$(function(){
		var dayTransactions=[];
		var colors=[{name:'yellow',code:'#ecc72f'},{name:'green',code:'#46be8a'},{name:'orange-50',code:'#f2a654'},{name:'blue-50',code:'#62a8ea'},{name:'red-50',code:'#e14e50'}];
		var days=[{'ArbName':'السبت' ,'EngName':'Saturday'},{'ArbName':'الأحد' ,'EngName':'Sunday'},
		{'ArbName':'الاثنين' ,'EngName':'Monday'},{'ArbName':'الثلاثاء' ,'EngName':'Tuesday'},
		{'ArbName':'الاربعاء' ,'EngName':'Wednesday'},{'ArbName':'الخميس' ,'EngName':'Thursday'},
		{'ArbName':'الجمعة' ,'EngName':'Friday'}];
		
	var documentTypes=[{'Id':1,'Name':'توريد مخزني','color': '#f5956c'},{'Id':2,'Name':'صرف مخزني','color': '#f56767'},{'Id':3,'Name':'زيادة المخزون','color': '#a683eb'}
		,{'Id':4,'Name':'نقص مخزني','color': '#41ccba'},{'Id':5,'Name':'مخزون افتتاحي','color': '#ffff'}];
		
		
		$('.NoOfTranactions').html(JsCounts[3].noOf);
		$('.NoOfProducts').html(JsCounts[2].noOf);
		$('.NoOfClients').html(JsCounts[1].noOf);
		$('.NoOfVendors').html(JsCounts[0].noOf);
		$.each(days,function(k,d){
			
			$.each(documentTypes,function(kt,dt){
				
				 var p = JsTransactionDates.find(p => {
                            return (p.Day==d.EngName && p.TType==dt.Id);
                        });
					p?dayTransactions.push({'Day':d.ArbName,'DoumentTypeName':dt.Name,'NoOfTransactions':p.NoOfTransactions,'color':dt.color}):dayTransactions.push({'Day':d.ArbName,'DoumentTypeName':dt.Name,'NoOfTransactions':0,'color':dt.color});
				
			});
		});
		var chartData=[];
		
			$.each(documentTypes,function(kd,id)
			{ var NoOfTransactions=[];
				$.each(dayTransactions,function(kt,it){
				
				if(it.DoumentTypeName==id.Name)
				NoOfTransactions.push(parseInt(it.NoOfTransactions));
				
				});
				chartData.push({name:id.Name,data:NoOfTransactions,color:id.color});
				
				
			});
				
				
			//Line chart
		console.log(chartData);
		Highcharts.chart('areaspline-chart', {
			chart: {
				type: 'areaspline'
			},
			title: {
				text: ''
			},
			legend: {
				layout: 'vertical',
				align: 'left',
				verticalAlign: 'top',
				x: 70,
				y: 20,
				floating: true,
				borderWidth: 1,
				backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
			},
			xAxis: {
				categories: ['السبت','الأحد','الاثنين','الثلاثاء','الاربعاء','الخميس','الجمعة'],
				plotBands: [{
					from: 4.5,
					to: 6.5,
				}],
				gridLineDashStyle: 'longdash',
                gridLineWidth: 1,
                crosshair: true
			},
			yAxis: {
				title: {
					text: ''
				},
				gridLineDashStyle: 'longdash',
			},
			tooltip: {
				shared: true,
				valueSuffix: ' عملية'
			},
			credits: {
				enabled: false
			},
			plotOptions: {
				areaspline: {
					fillOpacity: 0.6
				}
			},
			series: chartData
		});
		
		//Near to end products
		var near2EndProducts='';
		
		$.each(JsProductsBalances,function(k,i){
			
			near2EndProducts+='<div class="mb-30">'+
							'<p class="mb-5 font-18">'+i.ptitle+'</p>'+
							'<div class="progress border-radius-0" style="height: 10px;">'+
							'<div class="progress-bar bg-'+((i.Balance>7 && i.Balance<=10)?"light-green":(i.Balance>5 && i.Balance<=7)?"light-purple":(i.Balance>3 && i.Balance<=5)?"light-orange":"orange")+'" role="progressbar" style="width: '+(i.Balance?i.Balance*10:0)+'%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>'+
							'</div></div>';
			
		});
		$('#near2EndProducts').html(near2EndProducts);
		//User Transactions
		 var usersTransactions='';
		
		$.each(JsUsersTransactions,function(k,i)
		{
			usersTransactions+='	<li class="clearfix">'+
									'<div class="device-name">'+i.userName+'</div>'+
									'<div class="device-progress">'+
									'<div class="progress">'+
									'<div class="progress-bar window border-radius-8" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: '+(i.NoOfTranactions?i.NoOfTranactions*10:0)+'%;">'+
									'</div></div></div><div class="device-total">'+(i.NoOfTranactions?i.NoOfTranactions:0)+'</div></li>';
									
			
		});
		$('#UserTransactions').html(usersTransactions);
		//Warehouse Tranactions
		var warehouseTrasnactions='';
		 var warehouseTransactionsChart=[];
		$.each(JsWarehouseTransactions,function(k,i){
			warehouseTransactionsChart.push({name:i.WTitle,y:parseInt(i.NoOfTransactions),color:colors[k].code});
			warehouseTrasnactions+='<tr><td width="70%"><p class="weight-500 mb-5"><i class="fa fa-square text-'+(colors[k].name)+'"></i> '+i.WTitle+'</p></td>'+
	                                 '<td class="text-right weight-400">'+((i.NoOfTransactions/JsCounts[3].noOf)*100)+'%</td></tr>'
			
		});
		$('#WarehouseTranactions').html(warehouseTrasnactions);
		// Device Usage chart
		console.log(warehouseTransactionsChart);
		Highcharts.chart('device-usage', {
			chart: {
				type: 'pie'
			},
			title: {
				text: ''
			},
			subtitle: {
				text: ''
			},
			credits: {
				enabled: false
			},
			plotOptions: {
				series: {
					dataLabels: {
						enabled: false,
						format: '{point.name}: {point.y:.1f}%'
					}
				},
				pie: {
					innerSize: 127,
					depth: 45
				}
			},

			tooltip: {
				headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
				pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
			},
			series: [{
				name: 'Brands',
				colorByPoint: true,
				data: warehouseTransactionsChart
			}]
		});

	});
		


		
		// gauge chart
		Highcharts.chart('ram', {

			chart: {
				type: 'gauge',
				plotBackgroundColor: null,
				plotBackgroundImage: null,
				plotBorderWidth: 0,
				plotShadow: false
			},
			title: {
				text: ''
			},
			credits: {
				enabled: false
			},
			pane: {
				startAngle: -150,
				endAngle: 150,
				background: [{
					borderWidth: 0,
					outerRadius: '109%'
				}, {
					borderWidth: 0,
					outerRadius: '107%'
				}, {
				}, {
					backgroundColor: '#fff',
					borderWidth: 0,
					outerRadius: '105%',
					innerRadius: '103%'
				}]
			},

			yAxis: {
				min: 0,
				max: 200,

				minorTickInterval: 'auto',
				minorTickWidth: 1,
				minorTickLength: 10,
				minorTickPosition: 'inside',
				minorTickColor: '#666',

				tickPixelInterval: 30,
				tickWidth: 2,
				tickPosition: 'inside',
				tickLength: 10,
				tickColor: '#666',
				labels: {
					step: 2,
					rotation: 'auto'
				},
				title: {
					text: 'RAM'
				},
				plotBands: [{
					from: 0,
					to: 120,
					color: '#55BF3B'
				}, {
					from: 120,
					to: 160,
					color: '#DDDF0D'
				}, {
					from: 160,
					to: 200,
					color: '#DF5353'
				}]
			},

			series: [{
				name: 'Speed',
				data: [80],
				tooltip: {
					valueSuffix: '%'
				}
			}]
		});
		Highcharts.chart('cpu', {

			chart: {
				type: 'gauge',
				plotBackgroundColor: null,
				plotBackgroundImage: null,
				plotBorderWidth: 0,
				plotShadow: false
			},
			title: {
				text: ''
			},
			credits: {
				enabled: false
			},
			pane: {
				startAngle: -150,
				endAngle: 150,
				background: [{
					borderWidth: 0,
					outerRadius: '109%'
				}, {
					borderWidth: 0,
					outerRadius: '107%'
				}, {
				}, {
					backgroundColor: '#fff',
					borderWidth: 0,
					outerRadius: '105%',
					innerRadius: '103%'
				}]
			},

			yAxis: {
				min: 0,
				max: 200,

				minorTickInterval: 'auto',
				minorTickWidth: 1,
				minorTickLength: 10,
				minorTickPosition: 'inside',
				minorTickColor: '#666',

				tickPixelInterval: 30,
				tickWidth: 2,
				tickPosition: 'inside',
				tickLength: 10,
				tickColor: '#666',
				labels: {
					step: 2,
					rotation: 'auto'
				},
				title: {
					text: 'CPU'
				},
				plotBands: [{
					from: 0,
					to: 120,
					color: '#55BF3B'
				}, {
					from: 120,
					to: 160,
					color: '#DDDF0D'
				}, {
					from: 160,
					to: 200,
					color: '#DF5353'
				}]
			},

			series: [{
				name: 'Speed',
				data: [120],
				tooltip: {
					valueSuffix: ' %'
				}
			}]
		});
	</script>
</body>
</html>