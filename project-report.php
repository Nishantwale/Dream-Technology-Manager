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
		 $db->delete_client_project($del_id);
		
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
    <title>Project List</title>
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


		if($customer_name=="select")
		{
			$customer_name ="";
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
	
	<div class="ibox-head">
		<div class="ibox-title"><i class="fas fa-list" style="margin-right:10px;"></i>Project Report</div>
		
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
				<th>Project Title</th>
				<th>Project Place</th>
				<th>Project Deadline</th>
				<th>Project Amount</th>
				<th>Project Description</th>
				<th>View Agreement</th>
				<th>View Agreement With Header</th>
				<th>Action</th>
				<th>Update</th>
            </tr>
		</thead>
		<tbody>
		<?php
									
			$report_details = $db->get_project_information($customer_name);
			if(!empty($report_details))
			{	$total = 0;
				$counter =0;$total1=0;
				foreach($report_details as $record)
				{
					$id					=	$report_details[$counter][0];
					$cust_id			=	$report_details[$counter][1];
					$project_title		=	$report_details[$counter][2];
					$deadline_date		=	$report_details[$counter][3];
					$quotation_id		=	$report_details[$counter][4];
					$project_description=	$report_details[$counter][5];
					$date				=	$report_details[$counter][6];
					$time				=	$report_details[$counter][7];
					$project_place		=	$report_details[$counter][8];
					$cust_name 			= 	$db->fetch_customer_name_by_id($cust_id);
					$da=$db->get_quotation_details_by_qu_id($quotation_id);
					if(!empty($da))
					{
						$q_id				=	$da[0];
						$cust_id			=	$da[1];
						$actual_amount		=	$da[2];
						$discount_amount	=	$da[3];
						$bill_type			=	$da[4];
						$quotation_no		=	$da[5];
					}
					
					
		?>
			<tr class="odd gradeX">
				<td><?php echo $counter+1; ?></td>
				<td><?php echo $cust_name; ?></td>
				<td><?php echo $project_title; ?></td>
				<td><?php echo $project_place; ?></td>
				<td><?php echo $deadline_date; ?></td>
				<td><?php echo $actual_amount; ?></td>
				<td><?php echo $project_description; ?></td>
				<td><a href="view-agreement.php?c_id=<?php echo $id; ?>" style="color:green; font-weight:bold; text-align:center;">VIEW</a></td>
				<td><a href="view-agreement.php?c_id=<?php echo $id; ?>&hdr" style="color:green; font-weight:bold; text-align:center;">VIEW</a></td>
				<td><a href="project-report.php?delete_id=<?php echo $id;?>" onclick="return confirm('Are you sure?');"><i class="fas fa-trash-alt" style="color:red;margin-left:20px;"></i></a></td>
				<td><a href="update_project.php?edit_id=<?php echo $id; ?>"><i class="fas fa-edit"style="color:red;margin-left:20px;"></i></td>

			</tr>
			
			<?php
				$total=$total+$actual_amount;
				$counter++;
				}
				?>
				
			<tr>
				<td><?php echo $counter+1; ?></td>
				<td></td>
				<td></td>
				<td></td>
				<td><b><?php  echo "TOTAL "; ?></b></td>
				
				<td><b><?php echo $total; ?></b></td>
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