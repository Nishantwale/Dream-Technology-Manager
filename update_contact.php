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
	
	$flag 				= 	0;
	$success_msg		=	"";
	$contact_no_error	=	"";
	$image_error		=	"";
	$succ_flag 			= 	0;
	$customer_name		=	"";
	$shop_name			=	"";
	$address			=	"";
	$primary_contact	=	"";
	$other_contact		=	"";
	$password			=	"";
	$logo				=	"";
	$c_email			=	"";
	$mobile_no			=	"";
	$dob				=	"";
	
	
	
	if(!isset($_SESSION['current_login_admin']))
	{
		header("Location:/index.php");
	}
	if(isset($_SESSION['current_login_admin']))
	{
		$email	=	$_SESSION['current_login_admin'];
	}
	
		if(isset($_GET['delete_id']))
	{
		 $del_id	=	$_GET['delete_id'];
		 $db->delete_customer($del_id);
		
		 $success_msg	=	2;
	}
	
	
	if(isset($_GET['select_id']))
	{
		 $select_id	=	$_GET['select_id'];
		 $_SESSION['select_id'] = $select_id;
	}
	  else if(isset($_SESSION['select_id']))
	{
		$select_id	= $_SESSION['select_id'];
	}
	
	
	
	
	
		if(isset($_GET['contact_id']))
	{
		 $contact_id	=	$_GET['contact_id'];
		  $_SESSION['contact_id'] = $contact_id;
	}
	  else if(isset($_SESSION['contact_id']))
	{
		$contact_id	= $_SESSION['contact_id'];
	}
	
	
	if(isset($_POST['add_btn']))
	{
		$customer_name   	= $_POST['customer_name'];
		$dob   				= $_POST['dob'];
		$mobile_no 			= $_POST['mobile_no'];
		
		if(strlen($mobile_no)!=10)
		{
			
			$contact_no_error="Please Enter 10 Digit Mobile Number";
			$flag = 1;
		}
		
		if($flag==0)
		{
			$db->update_contact_info($customer_name,$dob,$mobile_no,$contact_id);
			$success_msg = 1;
		}
	}
	
	$contact_details =	$db->get_all_contact($contact_id);
	$counter	=	0;
	if(!empty($contact_id))
	{
		$id				=	$contact_details[$counter][0];
		$customer_name	=	$contact_details[$counter][1];
		$dob			=	$contact_details[$counter][2];
		$mobile_no		=	$contact_details[$counter][3];
		$date			=	$contact_details[$counter][4];
		$time			=	$contact_details[$counter][5];
	}
	
	$login_details	=	$db->get_all_customer_info($select_id);
	$counter = 0;
		if(!empty($login_details))
		{		
			$id					=	$login_details[$counter][0];
			$name				=	$login_details[$counter][1];
			$shop_name			=	$login_details[$counter][2];
			$c_email			=	$login_details[$counter][3];
			$address			=	$login_details[$counter][4];
			$primary_contact	=	$login_details[$counter][5];
			$other_contact		=	$login_details[$counter][6];
			$logo				=	$login_details[$counter][7];
			$password			=	$login_details[$counter][8];			
		}
		
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>Update Contact To Customer</title>
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
					<div class="alert alert-success" style="width:100%;">

					Updated Successfully.
					</div>
					<?php
					}
				?>
				
<div class="ibox" style="border-radius:5px; padding:7px;">
			<div class="ibox-head">
				<div class="ibox-title"><i class="fas fa-user-tie" style="margin-right:10px;"></i>Update Contact To Customer - <?php echo $name; ?></div>
			</div>
		 <form class="form-pink" method="post" action="<?php echo $_SERVER['PHP_SELF']?>" name="myForm" onsubmit="return validateForm()" autocomplete="off" enctype="multipart/form-data">
		
		
		<div class="ibox-body">
			<div class="row">
				
				<div class="col-sm-6 col-md-6 col-lg-6 form-group mb-6">
					<label class="form-group mb-4 set-row label_marg"><b>Enter Customer Name</b></label>
					<div class="input-group-icon input-group-icon-left  set-row">
						<span class="input-icon input-icon-left"><i class="fas fa-user"></i></span>
						<input type="text" name="customer_name" class="form-control form-control-air" value="<?php echo $customer_name; ?>" placeholder="Enter Customer Name"  required />
					</div>
				</div>
				<div class="col-sm-6 col-md-6 col-lg-6 form-group mb-6">
					<label class="form-group mb-4 set-row label_marg"><b>Date of Birth</b></label>
					<div class="input-group-icon input-group-icon-left  set-row">
						<span class="input-icon input-icon-left"><i class="fas fa-user"></i></span>
						<input type="date" name="dob" class="form-control form-control-air" value="<?php echo $dob; ?>" placeholder="Enter Customer Name"  required />
					</div>
				</div>
				<div class="col-sm-6 col-md-6 col-lg-6 form-group mb-6">
					<label class="form-group mb-4 set-row label_marg"><b>Enter Mobile Number</b></label>
					<div class="input-group-icon input-group-icon-left  set-row">
						<span class="input-icon input-icon-left"><i class="fas fa-phone"></i></span>
						<input type="number" name="mobile_no" class="form-control form-control-air"  placeholder="Enter Mobile Number"  value="<?php echo $mobile_no; ?>" required />
						<span style="color:red;"><?php echo $contact_no_error; ?></span>
					</div>
				</div>
				<div class="col-sm-12 form-group mb-12" style="text-align:center; padding-left:0px; padding-right:0px; padding-top:20px;">
					<div class="col-sm-4 form-group mb-4" style="margin:auto;">
						<button class="btn btn-pink btn-air" type="submit" name="add_btn" style="width:100%;">Update Contact</button>
					</div>
				</div>
				<div class="col-sm-12 form-group mb-12" style="text-align:center; padding-left:0px; padding-right:0px; padding-top:20px;">
					<div class="col-sm-4 form-group mb-4" style="margin:auto;">
						
					</div>
				</div>
				
				

			</div>
		</div>
	</form>
	
</div>
</div>


</div>
</div>
<?php include('footer.php'); ?>
</div>
    </div>
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
	
</body>
</html>