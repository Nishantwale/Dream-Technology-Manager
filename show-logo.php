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
	
	$flag=0;
	$contact_no_error="";
	$b_name="";
	$acc_name = "";
	$acc_no = "";
	$ifsc_code = "";
	$branch_name = "";
	$other_info = "";
	$succ_flag = 0;
	
	
	if(isset($_POST['add_btn']))
	{
		$b_name  	 	 = $_POST['b_name'];
		$acc_name 		 = $_POST['acc_name'];
		$acc_no 		 = $_POST['acc_no'];
		$ifsc_code 		 = $_POST['ifsc_code'];
		$branch_name 	 = $_POST['branch_name'];
		$other_info 	 = $_POST['other_info'];
		
		if(!is_numeric($acc_no))
		{
			$contact_no_error	=	"Please enter numeric Value";
			$flag				=	1;
		}
		
		
		
		if($flag==0)
		{
			$db->add_bank_details($b_name,$acc_name,$acc_no,$ifsc_code,$branch_name,$other_info);
			$succ_flag = 1 ;
			$b_name="";
			$acc_name = "";
			$acc_no = "";
			$ifsc_code = "";
			$branch_name = "";
			$other_info = "";
		}
	}
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>Bank Details</title>
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
	  var a = document.forms["myForm"]["b_name"].value;
	  var b = document.forms["myForm"]["acc_name"].value;
	  var c = document.forms["myForm"]["acc_no"].value;
	  var d = document.forms["myForm"]["ifsc_code"].value;
	  var e = document.forms["myForm"]["branch_name"].value;
	  var f = document.forms["myForm"]["other_info"].value;
	 
	 if (a == "") {
		alert("Enter Bank Name");
		return false;
	  }
	 
	  if (b == "") {
		alert("Enter Bank Account Name");
		return false;
	  }
	  
	  if (c == "") {
		alert("Enter Bank Account Number");
		return false;
	  }
	  
	  if (d == "") {
		alert("Enter IFSC CODE");
		return false;
	  }
	  
	  if (e == "") {
		alert("Enter Bank Name");
		return false;
	  }
	  if (f == "") {
		alert("Enter Other Information");
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
					if($succ_flag == 1)
					{
					?>
					<div class="alert alert-success">

						Information Successfully.
						</div>
					<?php
					}
				?>
<div class="ibox" style="border-radius:5px; padding:7px;">
	 <form class="form-pink" method="post" action="<?php echo $_SERVER['PHP_SELF']?>" name="myForm" onsubmit="return validateForm()" autocomplete="off" enctype="multipart/form-data">
		
		<div class="ibox-head">
			<div class="ibox-title"><i class="fas fa-user-tie" style="margin-right:10px;"></i>ADD BANK DETAILS</div>
		</div>
		
		<div class="ibox-body">
			<div class="row">
				
				<div class="col-sm-6 col-md-6 col-lg-6 form-group mb-6">
					<label class="form-group mb-4 set-row label_marg"><b>Enter Bank Name</b></label>
					<div class="input-group-icon input-group-icon-left  set-row">
						<span class="input-icon input-icon-left"><i class="fas fa-user"></i></span>
						<input type="text" name="b_name" id="b_name" class="form-control form-control-air" value="<?php echo $b_name; ?>" placeholder="Enter Bank Name"  required />
					</div>
				</div>
				<div class="col-sm-6 col-md-6 col-lg-6 form-group mb-6">
					<label class="form-group mb-4 set-row label_marg"><b>Enter Account Name</b></label>
					<div class="input-group-icon input-group-icon-left  set-row">
						<span class="input-icon input-icon-left"><i class="fas fa-phone"></i></span>
						<input type="text" name="acc_name" id="acc_name" class="form-control form-control-air" value="<?php echo $acc_name; ?>" placeholder="Enter Account Name"   required />
						<span style="color:red;"><?php echo $contact_no_error; ?></span>
					</div>
				</div>
				<div class="col-sm-6 col-md-6 col-lg-6 form-group mb-6">
					<label class="form-group mb-4 set-row label_marg"><b>Enter Account Number</b></label>
					<div class="input-group-icon input-group-icon-left  set-row">
						<span class="input-icon input-icon-left"><i class="fas fa-building"></i></span>
						<input type="number" name="acc_no" id="acc_no" class="form-control form-control-air" value="<?php echo $acc_no; ?>" placeholder="Enter Account Number"   />
						<p style="color:red;"><?php echo $contact_no_error; ?></p>
					</div>
				</div>
				<div class="col-sm-6 col-md-6 col-lg-6 form-group mb-6">
					<label class="form-group mb-4 set-row label_marg"><b>IFSC Code</b></label>
					<div class="input-group-icon input-group-icon-left  set-row">
						<span class="input-icon input-icon-left"><i class="fas fa-building"></i></span>
						<input type="text" name="ifsc_code" id="ifsc_code" class="form-control form-control-air" value="<?php echo $ifsc_code; ?>"  placeholder="Enter IFSC Code"   />
					</div>
				</div>
				 
				 <div class="col-sm-6 col-md-6 col-lg-6 form-group mb-6">
					<label class="form-group mb-4 set-row label_marg"><b>Branch Name</b></label>
					<div class="input-group-icon input-group-icon-left  set-row">
						<span class="input-icon input-icon-left"><i class="fas fa-phone"></i></span>
						<input type="text" name="branch_name" id="branch_name" class="form-control form-control-air" value="<?php echo $branch_name; ?>" placeholder="Enter Branch Name"   />
					</div>
				</div>
				<div class="col-sm-6 col-md-6 col-lg-6 form-group mb-6">
					<label class="form-group mb-4 set-row label_marg"><b>Enter Other Information</b></label>
					<div class="input-group-icon input-group-icon-left  set-row">
						<span class="input-icon input-icon-left"><i class="fas fa-info"></i></span>
						<input type="text" name="other_info" id="other_info" class="form-control form-control-air" value="<?php echo $other_info; ?>" placeholder="Other Info"   />
					</div>
				</div>
				
				
				<div class="col-sm-12 form-group mb-12" style="text-align:center; padding-left:0px; padding-right:0px; padding-top:20px;">
					<div class="col-sm-4 form-group mb-4" style="margin:auto;">
						<button class="btn btn-pink btn-air" type="submit" name="add_btn" style="width:100%;">SAVE BANK DETAILS</button>
					</div>
				</div>
			</div>
			<!--<center><a href="" style="color:red;font-weight:bold;">Back To List</a></center>-->
		</div>
	</form>
	</div>
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