<?php 
require_once('lib/function.php');

$db		=	new login_function();

if(isset($_SESSION['current_login_admin']))
{
	$current_login_admin	=	$_SESSION['current_login_admin'];
}
if(!isset($_SESSION['current_login_admin']))
{	
	header("location:index.php");
}
	
	
	$flag					 = 	0;
	$amount_error			 =	"";
	$name_error				 =	"";
	$select_error			 =	"";
	$success_msg 			 =	0;
	$succ_msg				 =	0;
	$customer_name 			 =  "";
	$invoice_msg 			 =  0;
	$cust_error				 =	"";
	$service_error 			 =	"";
	$actual_amount			 =  "";
	$discount_amount		 =  "";
	$comment				 =  "";
	$bill_type				 =  "";
	
	if(isset($_POST['add_btn']))
	{
		$customer_name   = $_POST['customer_name'];
		$_SESSION['customer_name'] = $customer_name;
		$service 			 = $_POST['service'];
		$actual_amount 		 = $_POST['actual_amount'];
		$discount_amount 	 = $_POST['discount_amount'];
		$comment		 	 = $_POST['comment'];
		$bill_type			 = "";
		
		
		if($comment=="")
		{
		$comment	=	"";
		}
		if(!is_numeric($actual_amount))
		{
			$amount_error	=	"Please enter numeric Value";
			$flag				=	1;
		}
		if(!is_numeric($discount_amount))
		{
			$amount_error	=	"Please enter numeric Value";
			$flag				=	1;
		}
		if($customer_name=="select")
		{
			$name_error	=	"Please Select Customer Name";
			$flag				=	1;
		}
		if($service=="select")
		{
			$service_error	=	"Please Select Service";
			$flag				=	1;
		}
		
		if($flag == 0)
		{
			if($db->add_to_the_invoice($customer_name,$service,$actual_amount,$discount_amount,$comment,$bill_type))
			{	
				$success_msg = 1;
				$service_error ="";
				$actual_amount="";
				$discount_amount="";
				$comment="";
			}		
		}
	}
	if(isset($_GET['delete_id']))
	{
		$delete_id = $_GET['delete_id'];
		$db->delete_invoice($delete_id);
		$succ_msg = 1;
		header("Location:add-invoice.php");
	}
	
				
	$fetch_name = $db->fetch_customer_name_by_id($customer_name);
	
	if(isset($_POST['submit_btn']))
	{
		if(isset($_POST['bill_type']))
		{
			$bill_type = $_POST['bill_type'];
		}
		else
		{
			$bill_type="without_gst";
		}
		$max_invoice_no=$db->get_max_invoice_no($bill_type);
		
		if($max_invoice_no=='')
		{
			$max_invoice_no="1";
		}
		else
		{
			 $max_invoice_no=$max_invoice_no+1;
		}
		$details = $db->get_temp_invoice_info_for_display();
		
		if(!empty($details))
		{
				$count=0;
				$id						=	$details[$count][0];
				$c_id					=	$details[$count][1];
				$service_id				=	$details[$count][2];
				$actual_total_amount	=	$details[$count][3];
				$discount_total_amount	=	$details[$count][4];
				$res_comment			=	$details[$count][5];
		}
				if($insert_id = $db->insert_invoice_details($c_id,$actual_total_amount,$discount_total_amount,$res_comment,$bill_type,$max_invoice_no))
				{
					$report_details = $db->get_temp_invoice_info();
					if(!empty($report_details))
					{
						$counter =0;
						foreach($report_details as $record)
						{
							$id					=	$report_details[$counter][0];
							$c_id				=	$report_details[$counter][1];
							$service			=	$report_details[$counter][2];
							$actual_amount		=	$report_details[$counter][3];
							$discount_amount	=	$report_details[$counter][4];
							$comments			=	$report_details[$counter][5];
							
							if($db->add_to_the_invoice_cart($insert_id,$c_id,$service,$actual_amount,$discount_amount,$comments,$bill_type))
							{
									if($db->delete_invoice($id))
									{
										$invoice_msg = 1;
									}
							}
								$counter ++;
						}
						
					}
					
				}
	}
			
		
		
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>INVOICE</title>
    <!-- GLOBAL MAINLY STYLES-->
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/font-awesome.min.css" rel="stylesheet" />
    <link href="css/line-awesome.min.css" rel="stylesheet" />
    <link href="css/themify-icons.css" rel="stylesheet" />
    <link href="css/animate.min.css" rel="stylesheet" />
    <link href="css/toastr.min.css" rel="stylesheet" />
    <link href="css/bootstrap-select.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  
    <!-- THEME STYLES-->
    <link href="css/main.min.css" rel="stylesheet" />
	<link href="datatable/datatables.min.css" rel="stylesheet" />

	<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
	<script src="js/wow.min.js"></script>
	<script>
	function validateForm() {
	  var a = document.forms["myForm"]["customer_name"].value;
	  var b = document.forms["myForm"]["service"].value;
	  var d = document.forms["myForm"]["actual_amount"].value;
	  var e = document.forms["myForm"]["discount_amount"].value;
	 
	 if (a == "Select Customer") {
		alert("Please Select Customer Name");
		return false;
	  }
	 
	  if (b == "Select Service") {
		alert("Please Select Services");
		return false;
	  }
	  
	 
	  
	  if (d == "") {
		alert("Enter Actual Amount");
		return false;
	  }
	  
	  if (e == "") {
		alert("Enter Discount Amount");
		return false;
	  }
	  
	}
	</script>
	

</head>
<body class="fixed-navbar">
  
<div class="page-wrapper" style="min-height:500px;">
<?php include('header.php'); ?>
<?php include('side-bar.php'); ?>
<div class="content-wrapper">
<div class="row" style="padding:0px; margin:0px; margin-top:15px; border-radius:15px;">
<?php
	if($success_msg == 1)
	{?>
	<div class="alert alert-success" style="width:100%; text-align:center;font-weight:bold; font-size:16px;">

	Invoice Added Successfully.
	</div>
	<?php
	}
	?>
	<?php
	if($succ_msg == 1)
	{
	?>
	<div class="alert alert-danger" style="width:100%; text-align:center;font-weight:bold; font-size:16px;">
		<span style="color:red">Invoice Information Deleted Successfully.
	</div>
	<?php
	}
	?>
	<?php
	if($invoice_msg == 1)
	{
	?>
	<div class="alert alert-success" style="width:100%; text-align:center;font-weight:bold; font-size:16px;">
		Invoice Generated Successfully <a href="show-invoice.php?c_id=<?php echo $insert_id; ?>" target="_blank"> View </a><a href="show-invoice.php?c_id=<?php echo $insert_id; ?>" target="_blank">Print</a>
	</div>
	<?php
	}
	?>
</div>
<div class="ibox" style="border-radius:5px; padding:7px;">
<form class="form-pink" method="post" action="<?php echo $_SERVER['PHP_SELF']?>" name="myForm" onsubmit="return validateForm()" autocomplete="off" enctype="multipart/form-data">
<div class="ibox-head">
<div class="ibox-title"><i class="fas fa-plus" style="margin-right:10px;"></i>ADD INVOICE</div>
</div>
<div class="ibox-body">
<div class="row">
	<div class="col-sm-3 col-md-3 col-lg-3 form-group mb-6">
		<label class="form-group mb-4 set-row label_marg"><b>Enter Customer Name</b></label>
			<div class="input-group-icon input-group-icon-left  set-row">
				<span class="input-icon input-icon-left"><i class="fas fa-user"></i></span>
					<select name="customer_name" class="form-control" onchange="mySelectFunction()">
					<?php 
						if($customer_name!= "" )
						{	
						?>
						<option value ="<?php echo $customer_name; ?>"><?php echo $fetch_name; ?></option>
						<?php
						}
						
						?>
				<option value="select" style="padding:10px 30px">Select Customer</option>
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
				
					<option value ="<?php echo $c_id; ?>"><?php echo $name;?></option>
				<?php	
					$counter++;
						}
					}
				?>
				</select>
					<p style="color:red;"><?php echo $name_error; ?></p>	
			</div>
	</div>
	
	<div class="col-sm-3 col-md-3 col-lg-3 form-group mb-6">
		<label class="form-group mb-4 set-row label_marg"><b>Enter Services</b></label>
			<div class="input-group-icon input-group-icon-left  set-row">
				<span class="input-icon input-icon-left"><i class="fas fa-user"></i></span>
					<select name="service" class="form-control form-control-air">
					  <?php 
					  $service_name = $db->fetch_service_name_by_id($service);
						if($service!= "" )
						{	
						?>
						<option value ="<?php echo $service; ?>"><?php echo $service_name; ?></option>
						<?php
						}
						
						?>
						<option value="select" style="padding:10px 30px">Select Service</option>
						<?php
							$report_details	=	$db->only_services();
							if(!empty($report_details))
							{
								$counter	=	0;
								foreach($report_details as $record)
								{	
									$id		=	$report_details[$counter][0];
									$s_name	=	$report_details[$counter][1];
						?>
							<option value ="<?php echo $id; ?>"><?php echo $s_name;?></option>
						<?php	
							$counter++;
								}
							}
						?>
					</select>
				<span style="color:red"><?php echo $service_error; ?></span>
			</div>
	</div>
	
	<div class="col-sm-3 col-md-3 col-lg-3 form-group mb-6">
		<label class="form-group mb-4 set-row label_marg"><b>Actual Amount</b></label>
		<div class="input-group-icon input-group-icon-left  set-row">
			<span class="input-icon input-icon-left"><i class="fas fa-rupee"></i></span>
			
			<input type="number" class="form-control form-control-air" placeholder="Enter Amount" name="actual_amount" value="<?php //echo $actual_amount; ?>">
			
			<span style="color:red"><?php echo $amount_error; ?></span>
	
		</div>
	</div>
	<div class="col-sm-3 col-md-3 col-lg-3 form-group mb-6">
		<label class="form-group mb-4 set-row label_marg"><b>Discount Amount</b></label>
		<div class="input-group-icon input-group-icon-left  set-row">
			<span class="input-icon input-icon-left"><i class="fas fa-rupee"></i></span>
			<input type="number" name="discount_amount" class="form-control form-control-air" value="<?php// echo $discount_amount; ?>" placeholder="Enter Discount Amount"   />
			<span style="color:red"><?php echo $amount_error; ?></span>
		</div>
	</div>
	<div class="col-sm-6 col-md-6 col-lg-6 form-group mb-6">
		<label class="form-group mb-4 set-row label_marg"><b>Comment</b></label>
		<div class="input-group-icon input-group-icon-left  set-row">
			<span class="input-icon input-icon-left"><i class="fas fa-arrow-alt-circle-right"></i></span>
			
			<textarea class="form-control form-control-air" placeholder="Enter Comment " name="comment"><?php echo $comment; ?></textarea>
	
		</div>
	</div>
	
	<div class="col-sm-6 col-md-6 col-lg-6 form-group mb-6" style="text-align:center; padding-left:0px; padding-right:0px; margin-top:30px;">
		<button class="btn btn-pink btn-air" type="submit" name="add_btn" style="width:40%; font-weight:bold;">Add to Cart</button>
	</div>
</div>
</div>
</form>
</div>

<div class="page-content fade-in-up" style="min-height:800px ! Important;">

<div class="ibox" style="border-radius:5px; padding:7px;">

<div class="ibox-body" style="padding:7px; padding-top:0px;margin:20px;">

<div class="flexbox mb-4">
<div class="input-group-icon input-group-icon-left mr-3">
<span class="input-icon input-icon-right font-16"><i class="fas fa-search"></i></span>
<input class="form-control form-control-rounded form-control-solid" id="key-search" type="text" placeholder="Search ...">
</div>
</div>
<form class="form-pink" method="post" action="<?php echo $_SERVER['PHP_SELF']?>" autocomplete="off" enctype="multipart/form-data">
<div class="table-responsive row">
<table class="table table-bordered table-hover" id="example" style="overflow-x:auto;overflow-y:auto;" cellpadding=0 cellspacing=0>
<thead class="thead-default thead-lg">
	<tr>
		<th>Sr.No</th>
		<th>Customer Name</th>
		<th>Services No</th>
		<th>Services Name</th>
		<th>Description</th>
		<th>Actual Amount</th>
		<th>Discount Amount</th>
		<th>Action</th>
	</tr>
</thead>
<tbody>
<?php
	$total=0;$total1=0;
	$report_details = $db->get_temp_invoice_info();
	if(!empty($report_details))
	{
		$counter =0;
		foreach($report_details as $record)
		{
			$id					=	$report_details[$counter][0];
			$c_id				=	$report_details[$counter][1];
			$service			=	$report_details[$counter][2];
			$actual_amount		=	$report_details[$counter][3];
			$discount_amount	=	$report_details[$counter][4];
			$res_comment		=	$report_details[$counter][5];
			
			
			$service_name 		=	$db->fetch_service_name($service);
			
			$cust_name 			= 	$db->fetch_customer_name_by_id($c_id);
?>
	<tr>
		<td><?php echo $counter+1; ?></td>
		<td><?php echo $cust_name; ?></td>
		<td><?php echo $service; ?></td>
		<td><?php echo $service_name; ?></td>
		<td><?php echo $res_comment; ?></td>
		<td style="text-align:center;"><?php echo $actual_amount; ?></td>
		<td style="text-align:center;"><?php echo $discount_amount; ?></td>
		
		<td><a href="add-invoice.php?delete_id=<?php echo $id;?>" onclick="return confirm('Are you sure?');"><i class="fas fa-trash-alt" style="color:red;margin-left:20px;"></i></a></td>
	</tr>
	<span><?php $total=$total+ $actual_amount; ?></span>
	<span><?php $total1=$total1+ $discount_amount; ?></span>
  <?php
	$counter ++;
		}?>
		<tr>
			<td><?php echo $counter+1; ?></td>
			<td></td>
			<td></td>
			<td></td>
			<td><b>Total -</b></td>
			<td style="text-align:center;"><b><?php echo $total; ?></b></td>
			<td style="text-align:center;"><b><?php echo $total1; ?></b></td>
			<td></td>
			
		</tr>
<?php	
}else
{
?>
<td></td>
<td></td>
<td>No Data Found...</td>
<td></td>
<td></td>
<td></td>
<td></td>
<?php	
}
   
   ?>
</tbody>
</table>
 <div class="col-sm-6 col-md-6 col-lg-6 form-group mb-6">
<label class="form-group mb-4 set-row label_marg"><b></b></label>
<br /> <br />
<label style="font-size:18px; font-weight:bold; margin-right:100px;"><input type="checkbox" name="bill_type" value="gst" class="gst_check" style="width:20px; height:20px; margin-right:10px;" checked>GST BILL	</label>
</div> 
 <div class="col-sm-12 col-md-12 col-lg-12 form-group mb-12">
 <center>
<button type="submit" class="btn btn-success"  name="submit_btn">Create Invoice</button>
</center>
</div>
</form>
</div>
	
</div>


</div>
</div>

                                
<?php include('footer.php'); ?>
<?php //include('search.php'); ?>
   
    <div class="sidenav-backdrop backdrop"></div>
    <div class="preloader-backdrop">
        <div class="page-preloader">Loading</div>
    </div>
    
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/metisMenu.min.js"></script>
    <script src="js/jquery.slimscroll.min.js"></script>
    <script src="js/idle-timer.min.js"></script>
    <script src="js/toastr.min.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/bootstrap-select.min.js"></script>
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