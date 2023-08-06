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
	
	$flag 				= 0;
	$success_msg 		=0;
	$suc_msg			=0;
	$succ_msg			=0;
	$invoice_msg 		= 0;
	$customer_name		=	"";
	$project_title		=	"";
	$deadline_date		=	"";
	$select_quotation	=	"";
	$project_description=	"";
	$cust_error			=	"";
	$cust_id			=	"";
	$select_quotation_error	=	"";
	$project_place		=	"";
	if(!isset($_SESSION['current_login_admin']))
	{
		header("Location:index.php");
	}
	if(isset($_SESSION['current_login_admin']))
	{
		$email	=	$_SESSION['current_login_admin'];
	}
	
	if(isset($_POST['add_btn']))
	{
		
		$cust_id 		 = $_POST['customer_name'];
		$_SESSION['customer_name'] = $cust_id;
		$project_title 		= $_POST['project_title'];
		$deadline_date 		= $_POST['deadline_date'];
		$select_quotation 	= $_POST['select_quotation'];
		$project_description = $_POST['project_description'];
		$project_place		=$_POST['project_place'];	
		if($cust_id == "select")
		{
			$cust_error = "Please Select Customer Name";
			$flag		=	1;
		}
		if($select_quotation == "All")
		{
			$select_quotation_error = "Please Select Quotation";
			$flag		=	1;
		}
		
		if($flag == 0)
		{		
				//$customer_name = $db->fetch_cust_name_by_id($cust_id);
				
				$db_id=$db->get_project_id($select_quotation);	
				if($db_id=='')
				{
					if($db->add_project_info($cust_id,$project_title,$deadline_date,$select_quotation,$project_description,$project_place))
					{
						$success_msg = 1;
						$cust_id			=	"";
						$project_title		=	"";
						$deadline_date		=	"";
						$select_quotation	=	"";
						$project_description=	"";
						$project_place		=	"";
					}
				}
				else
				{
					$success_msg = 2;
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
    <title>Add Project</title>
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
<div class="alert alert-success">
Project Added Successfully.

</div>
<?php
}
?>
<?php
if($success_msg == 1)
{
?>
<div class="alert alert-success" style="width:100%; text-align:center;font-weight:bold; font-size:16px;">

Project Added Successfully .
</div>
<?php
}
?>
<?php
if($success_msg == 2)
{
?>
<div class="alert alert-danger" style="width:100%; text-align:center;font-weight:bold; font-size:16px;">

Project Quatation Alerady Exist .
</div>
<?php
}
?>
</div>
<div class="ibox" style="border-radius:5px; padding:7px;">
<form class="form-pink" method="post" action="<?php echo $_SERVER['PHP_SELF']?>" name="myForm" onsubmit="return validateForm()" autocomplete="off" enctype="multipart/form-data">
<div class="ibox-head">
<div class="ibox-title"><i class="fas fa-plus" style="margin-right:10px;"></i>ADD PROJECT</div>
</div>
<div class="ibox-body">
<div class="row">
<div class="col-sm-6 col-md-6 col-lg-6 form-group mb-6">
<label class="form-group mb-4 set-row label_marg"><b>Select Customer Name</b></label>
<div class="input-group-icon input-group-icon-left  set-row">
<span class="input-icon input-icon-left"><i class="fas fa-user"></i></span>
	<select name="customer_name" class="form-control" id="cust_id" >
			
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
		
			<option value ="<?php echo $c_id; ?>"  <?php if($cust_id==$c_id) { ?>Selected <?php } ?>><?php echo $name;?></option>
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
<label class="form-group mb-4 set-row label_marg"><b>Project Title </b></label>
<div class="input-group-icon input-group-icon-left  set-row">
<span class="input-icon input-icon-left"><i class="fas fa-list"></i></span>

<input type="text" class="form-control form-control-air" placeholder="Enter Project Title" name="project_title" value="<?php echo $project_title; ?>" required >


</div>
</div>
<div class="col-sm-6 col-md-6 col-lg-6 form-group mb-6">
<label class="form-group mb-4 set-row label_marg"><b>Project Place </b></label>
<div class="input-group-icon input-group-icon-left  set-row">
<span class="input-icon input-icon-left"><i class="fas fa-list"></i></span>

<input type="text" class="form-control form-control-air" placeholder="Enter Project Place" name="project_place" value="<?php echo $project_place; ?>" required >


</div>
</div>
<div class="col-sm-6 col-md-6 col-lg-6 form-group mb-6">
<label class="form-group mb-4 set-row label_marg"><b>Deadline Date </b></label>
<div class="input-group-icon input-group-icon-left  set-row">
<span class="input-icon input-icon-left"><i class="fas fa-list"></i></span>

<input type="text" class="form-control form-control-air" placeholder="Enter Deadline Date " name="deadline_date" value="<?php echo $deadline_date; ?>" id="deadline_date" required >

</div>
</div>

<div class="col-sm-6 col-md-6 col-lg-6 form-group mb-6" >
<label class="form-group mb-4 set-row label_marg"><b>Select Quotation </b></label>
<div class="input-group-icon input-group-icon-left  set-row">
<span class="input-icon input-icon-left"><i class="fas fa-list"></i></span>

	<select name="select_quotation" class="form-control" id="qu_id" >
		
		<option value="All">Select Quotation</option>
		
	</select>
	<span style="color:red;"><?php echo $select_quotation_error; ?> </span>

</div>
</div>

<div class="col-sm-12 col-md-12 col-lg-12 form-group mb-12">
<label class="form-group mb-4 set-row label_marg"><b>Project Description</b></label>
<div class="input-group-icon input-group-icon-left  set-row">
<span class="input-icon input-icon-left"><i class="fas fa-arrow-alt-circle-right"></i></span>

<textarea class="form-control form-control-air" placeholder="Enter Project Description " name="project_description" required ><?php echo $project_description; ?></textarea>

</div>
</div>



<div class="col-sm-12 form-group mb-12" style="text-align:center; padding-left:0px; padding-right:0px; padding-top:20px;">
<div class="col-sm-4 form-group mb-4" style="margin:auto;">
<button class="btn btn-pink btn-air" type="submit" name="add_btn" style="width:100%;">SUBMIT PROJECT DETAILS</button>
</div>
</div>
</div>
</div>
</form>
</div>


				
<?php include('footer.php'); ?>
<?php //include('search.php'); ?>

<div class="sidenav-backdrop backdrop"></div>
<div class="preloader-backdrop">
<div class="page-preloader">Loading</div>
</div>

<script src="js/jquery.min.js"></script>
 <script type="text/javascript">
 
	$(document).ready(function(){
		
		$("#cust_id").change(function() {
				
				var selected_cust_id = $("#cust_id").val();
				
				var formData = {
					'res_sc_id': selected_cust_id
					
				};
				
				$.ajax({
					url: "get_quotation_details.php",
					type: "post",
					data: formData,
					success: function(res_sc_id) 
					{		
							 
							var res_sc_id = $.parseJSON(res_sc_id);
							
							var options = '';
							
							options += '<option value="All">Select Quotation</option>';
							if(res_sc_id=="")
							{
								options += '<option value="All">Select Quotation </option>';
							}
							else{
								for (var i = 0; i < res_sc_id.length; i++) {
									options += '<option value="' + res_sc_id[i][0] + '">' +'QuNo:-' +res_sc_id[i][5] +', QuAmount :-'+ res_sc_id[i][2] + '</option>';
								
								}
							}
							
						  $("#qu_id").html(options);
						  
						}
				});
			});
	 });
	</script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
 <script>
 $(document).ready(function() {
 
    $( "#deadline_date" ).datepicker({ dateFormat: 'dd-mm-yy' });
  } );
 </script>
	
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