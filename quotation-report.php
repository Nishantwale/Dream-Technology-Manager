<?php 
	require_once("lib/function.php");
	$db = new login_function();
	
	$flag = 0;
	$contact_no_error="";
	$success_msg=0;
	$c_name="";
	$date_to="";
	$date_from="";
	$service="";
	if(!isset($_SESSION['current_login_admin']))
	{
		header("Location:index.php");
	}
	if(isset($_SESSION['current_login_admin']))
	{
		$email	=	$_SESSION['current_login_admin'];
	}
	if(isset($_GET['delete_id']))
	{
		 $del_id	=	$_GET['delete_id'];
		 $db->delete_quotation($del_id);
		 $db->delete_quotation_cart($del_id);
		 $success_msg	=	1;
	}
	if($date_to == "")
	{
		$date_to 	=	Date("Y-m-d");
	}
	if($date_from == "")
	{
		$date_from 	=	Date("Y-m-d");
	}
	$cust_error	=	"";
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>Quotation List</title>
    <!-- GLOBAL MAINLY STYLES-->
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/font-awesome.min.css" rel="stylesheet" />
    <link href="css/line-awesome.min.css" rel="stylesheet" />
    <link href="css/themify-icons.css" rel="stylesheet" />
    <link href="css/animate.min.css" rel="stylesheet" />
    <link href="css/toastr.min.css" rel="stylesheet" />
    <link href="css/bootstrap-select.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  
    <!-- PLUGINS STYLES-->
    <!-- THEME STYLES-->
    <link href="css/main.min.css" rel="stylesheet" />
	 <link href="datatable/datatables.min.css" rel="stylesheet" />
    <!-- PAGE LEVEL STYLES-->
<style>
.col-md-12
{
	width:100%;
	margin:auto;
	margin-top:20px;
}
table,th
{
	text-align:center;
	text-transform:uppercase;
}
table,td
{
	text-align:left;
	text-transform:uppercase;
}
@media only screen and (max-width: 600px) {
	.col-md-12
	{
		width:100%;
	}
	.alert
	{
		width:100%;
	}
	.side-row
	{
		width:49%;
		display:inline-table;
	}
}
.content-wrapper {
    position: relative;
    background-color: #f2f3fa;
    margin-left: 230px;
    padding: 0 15px 60px 15px;
    -webkit-transition: margin .2s ease-in-out;
    -o-transition: margin .2s ease-in-out;
    transition: margin .2s ease-in-out;
    min-height: 1400px; 
}
.txt
{
	text-align:left;
	color:#232B99;
	font-size:12px;
	margin-right:10px;
	font-weight:bold;
	height:40px;
}
</style>

<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
<script src="js/wow.min.js"></script>
</head>
<body class="fixed-navbar">

<div class="page-wrapper">

<?php include('header.php'); ?>
<?php include('side-bar.php'); ?>

<div class="content-wrapper">
<div class="page-content fade-in-up">

 <?php
	if($success_msg == 1)
	{?>
		<div class="alert alert-danger">
			<span style="color:white;">Deleted Successfully.</span>
		</div>
	<?php
	}
 ?>

<div class="ibox" style="border-radius:5px; padding:7px;">
<div class="ibox-body" style="padding:7px; padding-top:0px;">

<?php
	$customer_name		="";
	$bill_type			="";				


	if(isset($_POST['add_btn1']))
	{
		$customer_name 		= $_POST['customer_name'];
		$bill_type 			= $_POST['bill_type'];


		if($customer_name=="select")
		{
			$customer_name ="";
		}
		if($bill_type=="select")
		{
			$bill_type ="";
		}

	}

?>
<form class="form-pink" method="post" action="<?php echo $_SERVER['PHP_SELF']?>" autocomplete="off" enctype="multipart/form-data">
<div class="ibox-body">
<div class="row">
<div class="col-sm-4 col-md-4 col-lg-4 form-group mb-6">
<label class="form-group mb-4 set-row label_marg"><b>Select Customer Name</b></label>
<div class="input-group-icon input-group-icon-left  set-row">
<span class="input-icon input-icon-left"><i class="fas fa-user"></i></span>
	<select name="customer_name" class="form-control" >
		<option value="select">Select Customer</option>
		<?php
			
			$report_details	=	$db->only_customers();
			if(!empty($report_details))
			{
				$counter	=	0;
				foreach($report_details as $record)
				{	
					 $c_id		=	$report_details[$counter][0];
					 $name		=	$report_details[$counter][1];
		?>
		
			<option value ="<?php echo $c_id; ?>" <?php if($customer_name==$c_id) {?> Selected <?php } ?>><?php echo $name;?></option>
		<?php	
			$counter++;
				}
			}
		?>
	</select>
<span style="color:red"><?php echo $cust_error; ?></span>
</div>
</div>
<div class="col-sm-4 col-md-4 col-lg-4 form-group mb-6">
<label class="form-group mb-4 set-row label_marg"><b>Select Customer Name</b></label>
<div class="input-group-icon input-group-icon-left  set-row">
<span class="input-icon input-icon-left"><i class="fas fa-user"></i></span>
	<select name="bill_type" class="form-control" >
	 <option value="select">Select Bill Type</option>
	 <option value="gst" <?php if($bill_type=="gst") { ?> Selected <?php } ?>>GST</option>
	 <option value="without_gst" <?php if($bill_type=="without_gst") { ?> Selected <?php } ?>>No GST</option>	 
	</select>
<span style="color:red"><?php echo $cust_error; ?></span>
</div>
</div>

<div class="col-sm-12 form-group mb-12" style="text-align:center; padding-left:0px; padding-right:0px; padding-top:20px;">
<div class="col-sm-4 form-group mb-4" style="margin:auto;">
<button class="btn btn-pink btn-air" type="submit" name="add_btn1" style="width:100%;">SEARCH</button>
</div>
</div>
</div>
</div>
</form>
</div>
<div class="ibox-body" style="padding:7px; padding-top:0px;">
	<?php
		if(isset($_POST['add_btn']))
		{
			$c_name 	= $_POST['cname'];
			$date_to = $_POST['date_to'];
			$date_from = $_POST['date_from'];
			$service = $_POST['service'];
		}
		
	?>
	<div class="ibox-head">
		<div class="ibox-title"><i class="fas fa-list" style="margin-right:10px;"></i>Quotation Report</div>
		
	</div>
	
	<br />
		
	<div class="flexbox mb-4">
		<div class="input-group-icon input-group-icon-left mr-3">
			<span class="input-icon input-icon-right font-16"><i class="fas fa-search"></i></span>
			<input class="form-control form-control-rounded form-control-solid" id="key-search" type="text" placeholder="Search ...">
		</div>
	</div>
	
<div class="table-responsive row">
	<table class="table table-bordered table-hover" id="example" style="overflow-x:auto;overflow-y:auto;" cellpadding=0 cellspacing=0>
		<thead class="thead-default thead-lg">
			<tr>
			    <th>Sr No</th>
				<th>Customer Name</th>
				<th>Service Name</th>
				<th>Actual Amount</th>
				<th>Discount Amount</th>
				<th>Bill Type</th>
				<th>Quotation No</th>
				<th>View</th>
				<th>View</th>
				<th>Action</th>
				<th>Action</th>
            </tr>
		</thead>
		<tbody>
		<?php
									
			$report_details = $db->get_quotation_information($customer_name,$bill_type);
			if(!empty($report_details))
			{	$total = 0;
				$counter =0;$total1=0;
				foreach($report_details as $record)
				{
					$id				=	$report_details[$counter][0];
					$cust_id		=	$report_details[$counter][1];
					$actual_amount	=	$report_details[$counter][2];
					$discount_amount=	$report_details[$counter][3];
					$bill_type		=	$report_details[$counter][4];
					$quotation_no	=	$report_details[$counter][5];
					
					$cust_name 			= 	$db->fetch_customer_name_by_id($cust_id);
				
		?>
			<tr class="odd gradeX">
				<td><?php echo $counter+1; ?></td>
				<td><?php echo $cust_name; ?></td>
				<td>
						<?php
							$fetch_service_id 		=	$db->fetch_quotation_services_id_by_cust_id($id);
							if(!empty($fetch_service_id))
							{	$count = 0;	
								foreach($fetch_service_id as $record)
								{
									 $service		= 	$fetch_service_id[$count][0];
									
									if($count>0)
									{
										echo ",".$service_name 	=	$db->fetch_service_name($service);
									}
									else
									{
										echo $service_name 	=	$db->fetch_service_name($service);
									}
						?>
						
						<?php
									$count++;
								}
						}
						
						?>
					
					</td>
				<td><?php echo $actual_amount; ?></td>
				<td><?php echo $discount_amount; ?></td>
				<td><?php echo $bill_type; ?></td>
				<td><?php echo $quotation_no; ?></td>
				<td><a href="show-quotation.php?c_id=<?php echo $id; ?>" target="_blank" style="color:green;">View</a></td>
                <td><a href="show-quotation.php?c_id=<?php echo $id; ?>&hdr" target="_blank" style="color:green;">PRINT WITH HEADER</a></td>

				<td><a href="update-quotation-report.php?update_id=<?php echo $id;?>"><i class="fas fa-edit" style="color:blue;margin-left:20px;"></i></a></td>

                <td><a href="quotation-report.php?delete_id=<?php echo $id;?>" onclick="return confirm('Are you sure?');"><i class="fas fa-trash-alt" style="color:red;margin-left:20px;"></i></a></td>

			</tr>
			<?php $total=$total+ $actual_amount; ?>
			<?php $total1=$total1+ $discount_amount; ?>
			<?php
			
				$counter++;
				}
				?>
				
			<tr>
				<td><?php echo $counter+1; ?></td>
				<td></td>
				<td><b><?php  echo "TOTAL "; ?></b></td>
				
				<td><b><?php echo $total; ?></b></td>
				<td><b><?php echo $total1; ?></b></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				
			</tr>
				<?php
				}else
				{
				?>
				<td colspan="11">No Data Found....</td>
				<?php
				}	
			?>
			
		</tbody>
	</table>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
		
	</div>
</div>

<!-- END SEARCH PANEL-->
<!-- BEGIN THEME CONFIG PANEL-->

<!-- END THEME CONFIG PANEL-->
<!-- BEGIN PAGA BACKDROPS-->
<div class="sidenav-backdrop backdrop"></div>
<div class="preloader-backdrop">
<div class="page-preloader">Loading</div>
</div>
<!-- END PAGA BACKDROPS-->
<!-- New question dialog-->


<!-- End New question dialog-->
<!-- QUICK SIDEBAR-->

<script src="js/jquery.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		
<script>

$( function()  {
		$( "#from_date" ) .datepicker({ dateFormat: 'dd-mm-yy'   }) ;
		$( "#to_date" ) .datepicker({ dateFormat: 'dd-mm-yy'   }) ;
		
}  ) ;
		


</script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/metisMenu.min.js"></script>
<script src="js/jquery.slimscroll.min.js"></script>
<script src="js/idle-timer.min.js"></script>
<script src="js/toastr.min.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script src="js/bootstrap-select.min.js"></script>
<!-- PAGE LEVEL PLUGINS-->
<!-- CORE SCRIPTS-->
<script src="datatable/datatables.min.js"></script>
<script src="js/app.min.js"></script>
<script>
$(function() {
	$('#example').DataTable({
		pageLength: 5,
		fixedHeader: true,
		responsive: true,
		"sDom": 'rtip',
		columnDefs: [{
			targets: 'no-sort',
			orderable: false
		}]
	});

	var table = $('#example').DataTable();
	$('#key-search').on('keyup', function() {
		table.search(this.value).draw();
	});
  
});

</script>


	
    <!-- PAGE LEVEL SCRIPTS-->
</body>

</html>