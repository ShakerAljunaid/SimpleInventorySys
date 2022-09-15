	<div class="left-side-bar">
		<div class="brand-logo">
			<a href="index.php">
				<span><img src="vendors/images/logo.png" alt=""></span>
				
			</a>
		</div>
		<div class="menu-block customscroll">
			<div class="sidebar-menu">
				<ul id="accordion-menu">
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="fa fa-home"></span><span class="mtext">الرئيسية</span>
						</a>
						<ul class="submenu">
							<li><a href="blank.php">الصفحة الرئيسية</a></li>
							<?php if($UserType==2) { ?><li><a href="index.php">تقارير عامة</a></li> <?php } ?>
						</ul>
					</li>
						<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="fa fa-desktop"></span><span class="mtext"> الأدلة </span>
						</a>
						<ul class="submenu">
						<?php if($UserType==2) { ?>	<li><a href="table_users.php">المستخدمين</a></li>
						<li><a href="table_branches.php">الفروع</a></li>
							<li><a href="table_warehouses.php">المخازن</a></li>
						<?php } ?>
							<li><a href="table_units.php">الوحدات</a></li>
							<li><a href="table_products.php">الأصناف</a></li>
							
						    <li><a href="table_vendor.php">الموردين</a></li>
							<li><a href="table_clients.php">العملاء</a></li>
						
						</ul>
					</li>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="fa fa-pencil"></span><span class="mtext">العمليات</span>
						</a>
						<ul class="submenu">
							<li><a href="table_transactions.php?type=1">توريد مخزني</a></li>
							<li><a href="table_transactions.php?type=2">صرف مخزني</a></li>
							<li ><a href="table_transactions.php?type=5">المخزون الافتتاحي</a></li>
							<li ><a href="table_transactions.php?type=3">زيادة المخزون</a></li>
							<li ><a href="table_transactions.php?type=4">نقص المخزون</a></li>
							<li class="hidden"><a href="image-cropper.php">Image Cropper</a></li>
							<li class="hidden"><a href="image-dropzone.php">Image Dropzone</a></li>
						</ul>
					</li>
					<li class="dropdown" >
						<a href="javascript:;" class="dropdown-toggle">
							<span class="fa fa-table"></span><span class="mtext">التقارير </span>
						</a>
						<ul class="submenu">
						
						<li><a href="report_opening_stock.php">المخزون الافتتاحي</a></li>
							<li><a href="report_stock_ledger.php">استاذ المخزون</a></li>
							<li><a href="report_products">تقرير الاصناف</a></li>
						</ul>
					</li>
					<li class="dropdown hidden" >
						<a href="javascript:;" class="dropdown-toggle">
							<span class="fa fa-table"></span><span class="mtext">احالات الطورىْ</span>
						</a>
						<ul class="submenu">
							<li><a href="basic-table.php">المعلقة</a></li>
							<li><a href="datatable.php">المستلمة</a></li>
						</ul>
					</li>
					<li class="dropdown hidden" >
							<a href="javascript:;" class="dropdown-toggle">
							<span class="fa fa-table"></span><span class="mtext">الحماية</span>
						</a>
						<ul class="submenu">
							<li><a href="protection_service_form.php">المعلقة</a></li>
							<li><a href="protection_service_form.php">المستلمة</a></li>
						</ul>
					</li>
						<li class="dropdown hidden" >
							<a href="javascript:;" class="dropdown-toggle">
							<span class="fa fa-table"></span><span class="mtext">الاحالات القانونية</span>
						</a>
						<ul class="submenu">
							<li><a href="legal_services.php">المعلقة</a></li>
							<li><a href="legal_services.php">المستلمة</a></li>
						</ul>
					</li>
						<li class="dropdown hidden" >
							<a href="javascript:;" class="dropdown-toggle">
							<span class="fa fa-table"></span><span class="mtext">الإحالات النفسية</span>
						</a>
						<ul class="submenu">
							<li><a href="basic-table.php">المعلقة</a></li>
							<li><a href="datatable.php">المستلمة</a></li>
						</ul>
					</li>
						<li class="dropdown hidden" >
							<a href="javascript:;" class="dropdown-toggle">
							<span class="fa fa-table"></span><span class="mtext">الإحالات الايواءْ</span>
						</a>
						<ul class="submenu">
							<li><a href="basic-table.php">المعلقة</a></li>
							<li><a href="datatable.php">المستلمة</a></li>
						</ul>
					</li>
					<li class="dropdown hidden" >
							<a href="javascript:;" class="dropdown-toggle">
							<span class="fa fa-table"></span><span class="mtext">احالات المساعدات</span>
						</a>
						<ul class="submenu">
							<li><a href="basic-table.php">المعلقة</a></li>
							<li><a href="datatable.php">المستلمة</a></li>
						</ul>
					</li>
					
					<li class="dropdown hidden" >
						<a href="javascript:;" class="dropdown-toggle">
							<span class="fa fa-table"></span><span class="mtext">الخدمات</span>
						</a>
						<ul class="submenu">
							<li><a href="basic-table.php">الخدمات المقدمة</a></li>
							<li><a href="datatable.php">تقرير الخدمات</a></li>
						</ul>
					</li>
						<li class="dropdown hidden" >
						<a href="javascript:;" class="dropdown-toggle">
							<span class="fa fa-table"></span><span class="mtext">المتابعة والتقييم</span>
						</a>
						<ul class="submenu">
							<li><a href="basic-table.php">الشكاوي</a></li>
							<li><a href="datatable.php">الFeedback</a></li>
						</ul>
					</li>
					<li class="hidden">
						<a href="calendar.php" class="dropdown-toggle no-arrow">
							<span class="fa fa-calendar-o"></span><span class="mtext">Calendar</span>
						</a>
					</li>
				
					<li class="dropdown hidden" >
						<a href="javascript:;" class="dropdown-toggle">
							<span class="fa fa-paint-brush"></span><span class="mtext">Icons</span>
						</a>
						<ul class="submenu">
							<li><a href="font-awesome.php">FontAwesome Icons</a></li>
							<li><a href="foundation.php">Foundation Icons</a></li>
							<li><a href="ionicons.php">Ionicons Icons</a></li>
							<li><a href="themify.php">Themify Icons</a></li>
						</ul>
					</li>
					<li class="dropdown hidden" >
						<a href="javascript:;" class="dropdown-toggle">
							<span class="fa fa-plug"></span><span class="mtext">Additional Pages</span>
						</a>
						<ul class="submenu">
							<li><a href="video-player.php">Video Player</a></li>
							<li><a href="login.php">Login</a></li>
							<li><a href="forgot-password.php">Forgot Password</a></li>
							<li><a href="reset-password.php">Reset Password</a></li>
							<li><a href="403.php">403</a></li>
							<li><a href="404.php">404</a></li>
							<li><a href="500.php">500</a></li>
						</ul>
					</li>
					<li class="dropdown hidden" >
						<a href="javascript:;" class="dropdown-toggle">
							<span class="fa fa-pie-chart"></span><span class="mtext">Charts</span>
						</a>
						<ul class="submenu">
							<li><a href="highchart.php">Highchart</a></li>
							<li><a href="knob-chart.php">jQuery Knob</a></li>
							<li><a href="jvectormap.php">jvectormap</a></li>
						</ul>
					</li>
					<li class="dropdown hidden" >
						<a href="javascript:;" class="dropdown-toggle">
							<span class="fa fa-clone"></span><span class="mtext">Extra Pages</span>
						</a>
						<ul class="submenu">
							<li><a href="blank.php">Blank</a></li>
							<li><a href="contact-directory.php">Contact Directory</a></li>
							<li><a href="blog.php">Blog</a></li>
							<li><a href="blog-detail.php">Blog Detail</a></li>
							<li><a href="product.php">Product</a></li>
							<li><a href="product-detail.php">Product Detail</a></li>
							<li><a href="faq.php">FAQ</a></li>
							<li><a href="profile.php">Profile</a></li>
							<li><a href="gallery.php">Gallery</a></li>
							<li><a href="pricing-table.php">Pricing Tables</a></li>
						</ul>
					</li>
					<li class="dropdown hidden">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="fa fa-list"></span><span class="mtext">Multi Level Menu</span>
						</a>
						<ul class="submenu">
							<li><a href="javascript:;">Level 1</a></li>
							<li><a href="javascript:;">Level 1</a></li>
							<li><a href="javascript:;">Level 1</a></li>
							<li class="dropdown">
								<a href="javascript:;" class="dropdown-toggle">
									<span class="fa fa-plug"></span><span class="mtext">Level 2</span>
								</a>
								<ul class="submenu child">
									<li><a href="javascript:;">Level 2</a></li>
									<li><a href="javascript:;">Level 2</a></li>
								</ul>
							</li>
							<li><a href="javascript:;">Level 1</a></li>
							<li><a href="javascript:;">Level 1</a></li>
							<li><a href="javascript:;">Level 1</a></li>
						</ul>
					</li>
					<li class="hidden">
						<a href="sitemap.php" class="dropdown-toggle no-arrow">
							<span class="fa fa-sitemap"></span><span class="mtext">Sitemap</span>
						</a>
					</li>
					<li class="hidden">
						<a href="chat.php" class="dropdown-toggle no-arrow">
							<span class="fa fa-comments-o"></span><span class="mtext">Chat <span class="fi-burst-new text-danger new"></span></span>
						</a>
					</li>
					<li class="hidden">
						<a href="invoice.php" class="dropdown-toggle no-arrow">
							<span class="fa fa-map-o"></span><span class="mtext">Invoice</span>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>