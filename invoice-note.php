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
	
	
	$flag 					= 	0;
	$amount_error			=	"";
	$name_error				=	"";
	$select_error			=	"";
	$success_msg			=	0;
	$succ_msg				=	0;
	$customer_name 			= 	"";
	$invoice_msg 			= 	0;
	$cust_id 				= 	"";
	$services_id 			= 	"";
	$total_actual  			= 	"";
	$c_id 					= 	"";
	$discount_total_amount 	= 	"";
	$t_id					=	"";
	$total_discount			=	0;
	$actual_total_amount	=	0;
	$fetch_actual_amount	=	0;
	$fetch_discount_amount	=	0;
	$total_actual			=	0;
	$total_discount			=	0;
	
	if(isset($_GET['note_id']))
	{
		$update_id	=	$_GET['note_id'];
		$_SESSION['note_id'] = $update_id;
	}
	else if(isset($_SESSION['note_id']))
	{
		$update_id	= $_SESSION['note_id'];
	}
	
	
    $fetch_invoice_id=$db->fetch_invoice_no_by_id($update_id);
    //$fetch_invoice_id = $db->fetch_invoice_id_by_cust_id($update_id);
	$cust_id=$db->fetch_customer_id_from_invoice($update_id);									
	$fetch_name		 = 	$db->fetch_customer_name_by_id($cust_id);	
	$services_name 	 =	$db->fetch_service_name($services_id);
	
	
	if(isset($_POST['comment']))
	{
	    $note_notice    =   $_POST['comment'];
	    
	    $db->update_note_for_invoice($note_notice,$update_id);
	}
	
	$note_notice    =   $db->get_notice_comment_of_invoice($update_id);
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
	  var c = document.forms["myForm"]["comment"].value;
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
			Invoice Generated Successfully 
		</div>
		<?php
		}
		?>
</div>
<div class="ibox" style="border-radius:5px; padding:7px;">
<form class="form-pink" method="post" action="<?php echo $_SERVER['PHP_SELF']?>" name="myForm" onsubmit="return validateForm()" autocomplete="off" enctype="multipart/form-data">
<div class="ibox-head">
	<div class="ibox-title"><i class="fas fa-plus" style="margin-right:10px;"></i>INVOICE NOTE (#<?php echo $fetch_invoice_id; ?> - <?php echo $fetch_name; ?>)</div>
</div>
<div class="ibox-body">
	<div class="row">
		
		<div class="col-sm-12 col-md-12 col-lg-12 form-group mb-6">
			<label class="form-group mb-4 set-row label_marg"><b>Invoice Note/Receipt :</b></label>
			<div class="input-group-icon input-group-icon-left  set-row">
				<span class="input-icon input-icon-left"><i class="fas fa-arrow-alt-circle-right"></i></span>
				<textarea class="form-control form-control-air" placeholder="Enter Commnt " name="comment" style="height:400px;" required><?php echo $note_notice; ?></textarea>
			</div>
		</div>
		<div class="col-sm-12 col-md-12 col-lg-12 form-group mb-6" style="text-align:center; padding-left:0px; padding-right:0px; margin-top:30px;">
			<button class="btn btn-pink btn-air" type="submit" name="add_btn" style="width:20%;">SUBMIT</button>
		</div>
		</div>
	</div>
</div>
</form>

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