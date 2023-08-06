<style>
.table-responsive
{
	font-size:11px !important;
}
tr th
{
	background-color:#0DEBF6 !important;
	color:#000606 !important;
	font-size:12px;
}
tr td
{
	color:#0325FD !important;
	font-size:12px;
}
.company_logo
{
	color:#DE04FC !important;
	font-size:12px !important;
	width:200px !important;
}
.company_logo:hover
{
	text-decoration:underline;
	color:red !important;
}
.label_marg
{
	margin-bottom:4px !important;
	font-size:12px;
	color:#DE04FC;
	text-transform:uppercase;
}
.form-control
{
	color:#333 !important;
	text-transform:uppercase;
}
.ibox-title
{
	font-size:22px !important;
	color:#FE2204 !important;
}
.content-wrapper
{
	padding-top:65px !important;
	background-image:url('images/back6.jpg');
	background-size:100% 100%;
	background-repeat: no-repeat;
	min-height:1000px !important;
}
.ibox .ibox-head {
	border-bottom: 1px dotted #f75a5f !important;
}
.mb-4
{
	margin-bottom:4px !important;
	font-size:12px;
	color:#FF8F00;
}
.mb6
{
	margin-bottom:4px !important;
	font-size:12px;
	color:red;
}
hr 
{
	
	border-bottom: 1px dotted #FF8F00 !important;

}
</style>
<header class="header">
	<div class="page-brand" style="background-color:#333;">
		<a href="index.html">
			<span class="brand" style="font-size:20px;">DT - Manager</span>
			<span class="brand">[DT]</span>
		</a>
	</div>
	<div class="flexbox flex-1">
		<!-- START TOP-LEFT TOOLBAR-->
		<ul class="nav navbar-toolbar">
			<li>
				<a class="nav-link sidebar-toggler js-sidebar-toggler" href="javascript:;">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
			</li>
			
		</ul>
		
	</div>
</header>
<nav class="page-sidebar" id="sidebar" style="background-color:#333333;">
	<div id="sidebar-collapse">
		<ul class="side-menu metismenu">
		    <li>
				<a href="dashboard.php"><i class="sidebar-item-icon fas fa-home"></i>
				<span class="nav-label">Dashboard</span></a>
			</li>
			<li>
				<a href="customer-list.php"><i class="sidebar-item-icon fas fa-users-cog"></i>
				<span class="nav-label">Customer</span></a>
			</li>
			<li>
				<a href="add-expenses.php"><i class="sidebar-item-icon fas fa-users-cog"></i>
				<span class="nav-label">Expenses Management</span></a>
			</li>
			<li>
			<a href="javascript:;"><i class="sidebar-item-icon fas fa-sliders-h"></i>
				<span class="nav-label">Services</span><i class="fas fa-angle-left arrow"></i></a>
			<ul class="nav-2-level collapse">
				
				<li>
					<a href="add-service.php"><i class="sidebar-item-icon far fa-arrow-alt-circle-right"></i>
					<span class="nav-label">Service List</span></a>
				</li>
				<!-- <li>
					<a href="set-service.php"><i class="sidebar-item-icon fas fa-chalkboard "></i>
					<span class="nav-label">Set Services</span></a>
				</li>
				<li>
					<a href="service-report.php"><i class="sidebar-item-icon fas fa-chalkboard "></i>
					<span class="nav-label">Service Report</span></a>
				</li> -->
				
				</ul>
			</li>
			<li>
			<a href="javascript:;"><i class="sidebar-item-icon fas fa-sliders-h"></i>
				<span class="nav-label">Quotation</span><i class="fas fa-angle-left arrow"></i></a>
			<ul class="nav-2-level collapse">
				
				<li>
					<a href="add-quotation.php"><i class="sidebar-item-icon far fa-arrow-alt-circle-right"></i>
					<span class="nav-label">Add Quotation</span></a>
				</li>
				<li>
					<a href="quotation-report.php"><i class="sidebar-item-icon fas fa-chalkboard "></i>
					<span class="nav-label">Quotation Report</span></a>
				</li>
				
				</ul>
			</li>
			<!-- <li>
			<a href="javascript:;"><i class="sidebar-item-icon fas fa-sliders-h"></i>
				<span class="nav-label">Project</span><i class="fas fa-angle-left arrow"></i></a>
			<ul class="nav-2-level collapse">
				
				<li>
					<a href="add-project.php"><i class="sidebar-item-icon far fa-arrow-alt-circle-right"></i>
					<span class="nav-label">Add Project</span></a>
				</li>
				<li>
					<a href="project-report.php"><i class="sidebar-item-icon fas fa-chalkboard "></i>
					<span class="nav-label">Project Report</span></a>
				</li>
				
				</ul>
			</li> -->
			<li>
			<a href="javascript:;"><i class="sidebar-item-icon fas fa-sliders-h"></i>
				<span class="nav-label">Invoice</span><i class="fas fa-angle-left arrow"></i></a>
			<ul class="nav-2-level collapse">
				
				<li>
					<a href="add-invoice.php"><i class="sidebar-item-icon far fa-arrow-alt-circle-right"></i>
					<span class="nav-label">Add Invoice</span></a>
				</li>
				<li>
					<a href="invoice-report.php"><i class="sidebar-item-icon fas fa-chalkboard "></i>
					<span class="nav-label">Invoice Report</span></a>
				</li>
				
				</ul>
			</li>
			
			<!-- <li>
			<a href="javascript:;"><i class="sidebar-item-icon fas fa-sliders-h"></i>
				<span class="nav-label">Bank Account Details</span><i class="fas fa-angle-left arrow"></i></a>
			<ul class="nav-2-level collapse">
				
				<li>
					<a href="bank-details.php"><i class="sidebar-item-icon far fa-arrow-alt-circle-right"></i>
					<span class="nav-label">Account Details</span></a>
				</li>
				<li>
					<a href="bank-details-report.php"><i class="sidebar-item-icon fas fa-chalkboard "></i>
					<span class="nav-label">Details Report</span></a>
				</li>
				
				</ul>
			</li> -->
			<li>
				<a href="company-profile.php"><i class="sidebar-item-icon fas fa-chalkboard-teacher"></i>
				<span class="nav-label">Company Profile</span></a>
			</li>
			<!-- <li>
				<a href="sms-panel.php"><i class="sidebar-item-icon fas fa-comment"></i>
				<span class="nav-label">SMS Panel</span></a>
			</li> -->
			
		
			<!--<li>
			<a href="javascript:;"><i class="sidebar-item-icon fas fa-users"></i>
				<span class="nav-label">Employees</span><i class="fas fa-angle-left arrow"></i></a>
			<ul class="nav-2-level collapse">
				
				<li>
					<a href="add-department.php"><i class="sidebar-item-icon fas fa-user"></i>
					<span class="nav-label">Designation Master</span></a>
				</li>
				<li>
					<a href="employee.php"><i class="sidebar-item-icon fas fa-chalkboard "></i>
					<span class="nav-label">Employee List</span></a>
				</li>
				
				</ul>
			</li>
			
			<li>
			<a href="javascript:;"><i class="sidebar-item-icon fas fa-pie-chart"></i>
				<span class="nav-label">Product & Services</span><i class="fas fa-angle-left arrow"></i></a>
			<ul class="nav-2-level collapse">
				<li>
					<a href="product-category.php"><i class="sidebar-item-icon far fa-arrow-alt-circle-right"></i>
					<span class="nav-label">Product Category List</span></a>
				</li>
				<li>
					<a href="product.php"><i class="sidebar-item-icon fas fa-box"></i>
					<span class="nav-label">Product List</span></a>
				</li>
				</ul>
			</li>
			<li>
			<a href="javascript:;"><i class="sidebar-item-icon fas fa-shopping-cart"></i>
				<span class="nav-label">Purchase</span><i class="fas fa-angle-left arrow"></i></a>
			<ul class="nav-2-level collapse">
				<li>
					<a href="purchase-product.php"><i class="sidebar-item-icon fas fa-shopping-cart"></i>
					<span class="nav-label">Purchase Product</span></a>
				</li>
				<li>
					<a href="purchase-product-report.php"><i class="sidebar-item-icon fas fa-list"></i>
					<span class="nav-label">Purchase Product Report</span></a>
				</li>
				</ul>
			</li>
			<li>
				<a href="javascript:;"><i class="sidebar-item-icon fas fa-shopping-cart"></i>
					<span class="nav-label">INVOICE</span><i class="fas fa-angle-left arrow"></i></a>
				<ul class="nav-2-level collapse">
					<li>
						<a href="create-invoice.php"><i class="sidebar-item-icon fas fa-shopping-cart"></i>
						<span class="nav-label">CREATE INVOICE</span></a>
					</li>
					<li>
						<a href="my-invoice.php"><i class="sidebar-item-icon fas fa-list"></i>
						<span class="nav-label">INVOICE Report</span></a>
					</li>
					</ul>
			</li>
			<li>
				<a href="discount-invoice-list.php"><i class="sidebar-item-icon far fa-arrow-alt-circle-right"></i>
				<span class="nav-label">DISCOUNT INVOICE</span></a>
			</li>
			<li>
				<a href="less-stock-indicator.php"><i class="sidebar-item-icon fas fa-list"></i>
				<span class="nav-label">Less Stock Indicator</span></a>
			</li>
		<!--<li>
		<a href="pending-invoice-list-cashier.php"><i class="sidebar-item-icon fas fa-list"></i>
		<span class="nav-label">PENDING INVOICE LIST</span></a>
		</li>
		<li>
			<a href="db-paid-invoice-cashier.php"><i class="sidebar-item-icon fas fa-list"></i>
			<span class="nav-label">PAID INVOICE LIST</span></a>
		</li>-->
		<!--<li>
			<a href="payment-report.php"><i class="sidebar-item-icon fas fa-inr"></i>
			<span class="nav-label">PAYMENT REPORT</span></a>
		</li>
		<li>
		<a href="statement.php"><i class="sidebar-item-icon fas fa-balance-scale"></i>
		<span class="nav-label">Closing Report</span></a>
		</li>
		<li>
			<a href="company-setting.php"><i class="sidebar-item-icon fas fa-cog"></i>
			<span class="nav-label">Setting</span></a>
		</li>-->
	
		<div class="sidebar-footer" style="background-color:#000;">
			<a href="index.php?logout"><i class="fas fa-power-off"></i></a>
	
		</div>
	</div>
</nav>

