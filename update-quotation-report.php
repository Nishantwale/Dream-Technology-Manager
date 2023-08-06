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
	$f_comment="";
	$f_actual_amount="";
	$f_discount_amount="";
	$flag = 0;
	$amount_error="";
	$customer_name="";
	$success_msg =0;
	$service="";
	$comment="";
	$amount="";
	$d_amount="";
	$amount_error1="";
	$cust_error="";
	$service_error="";
	$c_name="";
	$date_to="";
	$date_from="";
	$service="";
	$c_email="";
	$suc_msg=0;
	$succ_msg=0;
	$invoice_msg = 0;
	$select_error = "";
	$bill_type	  = "";
	$actual_total_amount	=	0;
	$fetch_actual_amount	=	0;
	$fetch_discount_amount	=	0;
	$total_actual			=	0;
	$total_discount			=	0;
	if(!isset($_SESSION['current_login_admin']))
	{
		header("Location:index.php");
	}
	if(isset($_SESSION['current_login_admin']))
	{
		$email	=	$_SESSION['current_login_admin'];
	}
	
	if(isset($_GET['update_id']))
	{
		 $up_id	=	$_GET['update_id'];
		 $_SESSION['current_update_id'] = $up_id;
	}
	 else if(isset($_SESSION['current_update_id']))
	{
		$up_id	= $_SESSION['current_update_id'];
	}
	if(isset($_GET['delete_id']))
	{
		$del_id	=	$_GET['delete_id'];
		$fetch_data = $db->fetch_qutotation_cart_data_for_update($del_id);
		
		if(!empty($fetch_data))
		{$count =0 ;
			$id					=	$fetch_data[$count][0];
			$t_id				=	$fetch_data[$count][1];
			$cust_id			=	$fetch_data[$count][2];
			$service_id			=	$fetch_data[$count][3];
			$total_actual		=	$fetch_data[$count][4];
			$total_discount		=	$fetch_data[$count][5];	
		}
		
		
		$fetch_actual_amount 	=  $db->fetch_actual_qutotation_amount_by_id($up_id);
		$actual_total_amount = $fetch_actual_amount - $total_actual;
		$fetch_discount_amount 	=  $db->fetch_discount_qutotation_amount_by_id($up_id);
		$discount_total_amount = $fetch_discount_amount - $total_discount;
		$db->update_amount_in_quotation_details($up_id,$actual_total_amount,$discount_total_amount);
		$db->delete_quotation_cart_by_id($del_id);
		$success_msg	=	1;
		//header("Location:update-quotation-report.php");
	}
	if(isset($_POST['add_btn']))
	{
		$cust_id 		 	= $_POST['customer_name'];
		$new_service 		= $_POST['service'];
		$f_comment 			= $_POST['comment'];
		$f_actual_amount 	= $_POST['amount'];
		$f_discount_amount	= $_POST['d_amount'];
		if(isset($_POST['bill_type']))
		{
			$bill_type = $_POST['bill_type'];
		}
		else
		{
			$bill_type="without_gst";
		}
		if($cust_id == "select")
		{
			$cust_error = "Please Select Customer Name";
			$flag		=	1;
		}
		if($new_service == "select service")
		{
			$service_error = "Please Select Service ";
			$flag		=	1;
		}
		if(!is_numeric($f_actual_amount))
		{
			$amount_error	=	"Please enter numeric Value";
			$flag				=	1;
		}
		if(!is_numeric($f_discount_amount))
		{
			$amount_error1	=	"Please enter numeric Value";
			$flag				=	1;
		}
		if($flag == 0)
		{		
				
				$customer_name = $db->fetch_cust_name_by_id($cust_id);
				
				$report_details = $db->fetch_quotationcart__information($up_id);
				if(!empty($report_details))
				{	
					$count =0;
					$id				=	$report_details[$count][0];
					$cust_id		=	$report_details[$count][1];
					$cust_name		=	$report_details[$count][2];
					$service_no		=	$report_details[$count][3];
					$service_name	=	$report_details[$count][4];
					$comment		=	$report_details[$count][5];
					$total_actual	=	$report_details[$count][6];
					$total_discount =	$report_details[$count][7];
				}
				 $cust_id		=	$db->fetch_customer_id_from_quotation($up_id);
				 $cust_name		=	$db->fetch_cust_name($cust_id);	
				 
				 
				 $actual_total_amount = $total_actual + $f_actual_amount;
				 $discount_total_amount = $total_discount + $f_discount_amount;
				 $new_service_name =$db->fetch_service_name_by_id($new_service);
				if($db->update_quotation_info1($up_id,$actual_total_amount,$discount_total_amount,$bill_type))
				{
					if($db->add_quotation_cart($up_id,$cust_id,$cust_name,$new_service,$new_service_name,$f_comment,$f_actual_amount,$f_discount_amount,$bill_type))
					{
							$success_msg = 1;
							$f_comment = "";
							$f_actual_amount="";
							$f_discount_amount="";
					}
				}
		}
	}
	$report_details = $db->get_all_quotation_information_by_id($up_id);
	if(!empty($report_details))
	{	
		$counter =0;
		$id				=	$report_details[$counter][0];
		$customer_name	=	$report_details[$counter][1];
		$cust_name		=	$report_details[$counter][2];
		$service_no		=	$report_details[$counter][3];
		$service_name	=	$report_details[$counter][4];
		$comment		=	$report_details[$counter][5];
		$amount			=	$report_details[$counter][6];
		$d_amount		=	$report_details[$counter][7];
	}
		$customer_name=$db->fetch_customer_id_from_quotation($up_id);									
		$data	=	$db->fetch_cust_name($customer_name);
		
			
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>Update Quotation</title>
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
	  var c = document.forms["myForm"]["comment"].value;
	  var d = document.forms["myForm"]["amount"].value;
	  var e = document.forms["myForm"]["d_amount"].value;
	 
	 if (a == "Select Customer") {
		alert("Please Select Customer Name");
		return false;
	  }
	 
	  if (b == "Select Service") {
		alert("Please Select Services");
		return false;
	  }
	  
	  if (c == "") {
		alert("Enter Comments");
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
				if($invoice_msg == 1)
				{
				?>
				<div class="alert alert-success" style="width:100%; text-align:center;font-weight:bold; font-size:16px;">

					Quotation Generated Successfully.<a href="show-quotation.php?c_id=<?php echo $insert_id; ?>" target="_blank"> View </a><a href="show-quotation.php?c_id=<?php echo $insert_id; ?>" target="_blank">Print</a>
				</div>
				<?php
				}
				?>
				<?php
					if($success_msg == 1)
					{
					?>
					<div class="alert alert-success" style="width:100%; text-align:center;font-weight:bold; font-size:16px;">

					Qutotation Updated Successfully.
					</div>
					<?php
					}
					?>
				<?php
				if($suc_msg == 1)
				{
				?>
				<div class="alert alert-success">

				Mail send successfully.
				</div>
				<?php
				}
				?>
		</div>
	<div class="ibox" style="border-radius:5px; padding:7px;">
		<form class="form-pink" method="post" action="<?php echo $_SERVER['PHP_SELF']?>" name="myForm" onsubmit="return validateForm()" autocomplete="off" enctype="multipart/form-data">
			<div class="ibox-head">
				<div class="ibox-title"><i class="fas fa-plus" style="margin-right:10px;"></i>UPDATE QUOTATION</div>
			</div>
			<div class="ibox-body">
				<div class="row">
					<div class="col-sm-6 col-md-6 col-lg-6 form-group mb-6">
						<label class="form-group mb-4 set-row label_marg"><b>Enter Customer Name</b></label>
							<div class="input-group-icon input-group-icon-left  set-row">
								<span class="input-icon input-icon-left"><i class="fas fa-user"></i></span>
									<select name="customer_name" class="form-control" >
									<?php
											if($customer_name!="")
											{
												
										?>
											<option value="<?php echo $data; ?>"><?php echo $data; ?></option>
										<?php
											}
										?>			
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
								
									<option value ="<?php echo $c_id; ?>"><?php echo $name;?></option>
								<?php	
									$counter++;
										}
									}
								?>
								</select>
								<span style="color:red"><?php echo $cust_error; ?></span>

						</div>
					</div>
					
					<div class="col-sm-6 col-md-6 col-lg-6 form-group mb-6">
						<label class="form-group mb-4 set-row label_marg"><b>Enter Services</b></label>
							<div class="input-group-icon input-group-icon-left  set-row">
								<span class="input-icon input-icon-left"><i class="fas fa-user"></i></span>
									<select name="service" class="form-control">
									<!--<?php
										if($service_name != "")
										{
									?>
									<option value="<?php echo $service_name; ?>"><?php echo $service_name; ?></option>
									<?php
										}		
									?>-->
										<option value="select service">Select Service</option>
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
					<div class="col-sm-6 col-md-6 col-lg-6 form-group mb-6">
						<label class="form-group mb-4 set-row label_marg"><b>Comment</b></label>
						<div class="input-group-icon input-group-icon-left  set-row">
							<span class="input-icon input-icon-left"><i class="fas fa-arrow-alt-circle-right"></i></span>
							
							<textarea class="form-control form-control-air" placeholder="Enter Comment " name="comment"><?php echo $f_comment; ?></textarea>
					
						</div>
					</div>
					<div class="col-sm-3 col-md-3 col-lg-3 form-group mb-6">
						<label class="form-group mb-4 set-row label_marg"><b>Actual Amount</b></label>
						<div class="input-group-icon input-group-icon-left  set-row">
							<span class="input-icon input-icon-left"><i class="fas fa-rupee"></i></span>
							
							<input type="number" class="form-control form-control-air" placeholder="Enter Amount" name="amount" value="<?php echo $f_actual_amount; ?>">
							
							<span style="color:red"><?php echo $amount_error; ?></span>
					
						</div>
					</div>
					<div class="col-sm-3 col-md-3 col-lg-3 form-group mb-6">
						<label class="form-group mb-4 set-row label_marg"><b>Discount Amount</b></label>
						<div class="input-group-icon input-group-icon-left  set-row">
							<span class="input-icon input-icon-left"><i class="fas fa-rupee"></i></span>
							<input type="number" name="d_amount" class="form-control form-control-air" value="<?php echo $f_discount_amount; ?>" placeholder="Enter Discount Amount"   />
							<span style="color:red"><?php echo $amount_error; ?></span>
						</div>
					</div>
					<div class="col-sm-6 col-md-6 col-lg-6 form-group mb-6">
					<label class="form-group mb-4 set-row label_marg"><b></b></label>
					<br /> <br />
					<label style="font-size:18px; font-weight:bold; margin-right:100px;"><input type="checkbox" name="bill_type" value="gst" class="gst_check" style="width:20px; height:20px; margin-right:10px;" checked>GST BILL	</label>
					</div>
					<div class="col-sm-12 form-group mb-12" style="text-align:center; padding-left:0px; padding-right:0px; padding-top:20px;">
						<div class="col-sm-4 form-group mb-4" style="margin:auto;">
						<button class="btn btn-pink btn-air" type="submit" name="add_btn" style="width:100%;">UPDATE</button>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
	
	<div class="page-content fade-in-up" style="min-height:800px ! Important;">

	<div class="ibox" style="border-radius:5px; padding:7px;">

	<div class="ibox-body" style="padding:7px; padding-top:0px;">
	
		<?php
								  
			if(isset($_POST['add_btn1']))
			{
				$c_name 	= $_POST['cname'];
				$date_to = $_POST['date_to'];
				$date_from = $_POST['date_from'];
				$service = $_POST['service'];
			}
			if($date_to == "")
			{
				$date_to 	=	Date("Y-m-d");
			}
			if($date_from == "")
			{
				$date_from 	=	Date("Y-m-d");
			}
			
		?>
		
	</div>
	<div class="ibox-body" style="padding:7px;padding-top:0px;">
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
				<th>Comment</th>
				<th>Actual Amount</th>
				<th>Discount Amount</th>
				<th>Bill Type</th>
				<th>Date</th>
				<th>Time</th>
				<th>Action</th>
            </tr>
		</thead>
		<tbody>
		<?php
									
			$report_details = $db->get_all_quotation_information_by_id($up_id);
			if(!empty($report_details))
			{	$total = 0;
				$counter =0;$total1=0;
				foreach($report_details as $record)
				{
					$id				=	$report_details[$counter][0];
					
					$cust_id		=	$report_details[$counter][1];
					$cust_name		=	$report_details[$counter][2];
					$service_no		=	$report_details[$counter][3];
					$service_name	=	$report_details[$counter][4];
					$comment		=	$report_details[$counter][5];
					$actual_amount	=	$report_details[$counter][6];
					$discount_amount=	$report_details[$counter][7];
					
					$date			=	$report_details[$counter][8];
					$time			=	$report_details[$counter][9];
					$bill_type		=	$report_details[$counter][10];
					$fetch_email =$db->fetch_email_by_id($cust_id);
				
		?>
			<tr class="odd gradeX">
				<td><?php echo $counter+1; ?></td>
				<td><?php echo $cust_name; ?></td>
				<td><?php echo $service_name; ?></td>
				<td><?php echo $comment; ?></td>
				<td><?php echo $actual_amount; ?></td>
				<td><?php echo $discount_amount; ?></td>
				<td><?php echo $bill_type; ?></td>
				<td><?php echo $date = date("d-m-Y",strtotime($date)); ?></td>
				<td><?php echo $time; ?></td>
				
				<td><a href="update-quotation-report.php?delete_id=<?php echo $id;?>" onclick="return confirm('Are you sure?');"><i class="fas fa-trash-alt" style="color:red;margin-left:20px;"></i></a></td>
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
				<td></td>
				<td><b><?php  echo "TOTAL "; ?></b></td>
				
				<td><b><?php echo $total; ?></b></td>
				<td><b><?php echo $total1; ?></b></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				
			</tr>
				<?php
				}else
				{
				?>
				<td colspan="14">No Data Found....</td>
				<?php
				}	
			?>
			
		</tbody>
	</table>
	<br />
	
	<br />
	<br />
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