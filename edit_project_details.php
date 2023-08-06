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
	
	if(isset($_GET['delete_id']))
	{
		 $delete_id=$_GET['delete_id'];
		 
		 $db->delete_registration_record($delete_id);
		 
		 $succ_flag = 1;
	}
	
	if(isset($_GET['edit_id']))
	{
		$edit_id				=	$_GET['edit_id'];
		$_SESSION['edit_id']	= 	$edit_id;
	}
	else if(isset($_SESSION['edit_id']))
	{
		$edit_id				=	$_SESSION['edit_id'];
		
	}
	$flag=0;
	$contact_no_error="";
	$succ_flag = 0;
	
	
	if(isset($_GET['detail_id']))
	{
		$detail_id				=	$_GET['detail_id'];
		$_SESSION['detail_id']	= 	$detail_id;
	}
	else if(isset($_SESSION['detail_id']))
	{
		$detail_id				=	$_SESSION['detail_id'];
		
	}
	
	
	
	if(isset($_POST['add_btn']))
	{
		$update_title			=	$_POST['update_title'];
		$description	=	$_POST['description'];
		
		if($db->update_project_details($update_title,$description,$detail_id))
		{
			$succ_flag		=	1;
		}
		else
		{
			$succ_flag		=	2;
		}
	}
	
	
	
	$project_details	= $db->get_project_details_by_id($detail_id);
	$counter			=	0;
	if(!empty($project_details))
	{
		$id				=	$project_details[$counter][0];
		$update_title	=	$project_details[$counter][1];
		$description	=	$project_details[$counter][2];
		$status			=	$project_details[$counter][3];
		$completed_by	=	$project_details[$counter][4];
		$date			=	$project_details[$counter][5];
		$time			=	$project_details[$counter][6];
	}
	
	
	$data	=	array();
	$data	=	$db->update_project_by_id($edit_id);
	if(!empty($data))
	{
		$id						=	$data[0];
		$cust_id				=	$data[1];
		$project_title			=	$data[2];
		$deadline_date			=	$data[3];
		$quotation_id			=	$data[4];
		$project_description	=	$data[5];
		$date					=	$data[6];
		$time					=	$data[7];
		$project_place			=	$data[8];
		
	}
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>Project Details</title>
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
<div class="ibox" style="border-radius:5px; padding:7px;">
	 <form class="form-pink" method="post" action="<?php echo $_SERVER['PHP_SELF']?>" name="myForm" onsubmit="return validateForm()" autocomplete="off" enctype="multipart/form-data">
		
		<div class="ibox-head">
			<div class="ibox-title"><i class="fas fa-user-tie" style="margin-right:10px;"></i>Project Name:<?php echo $project_title;?></div>
		</div>
		
		<div class="ibox-body">
		<?php
		if($succ_flag == 1)
		{
		?>
		<div class="alert alert-success">

			Project Details updated. Successfully....!
			</div>
		<?php
		}
		?>
			<?php
		if($succ_flag == 2)
		{
		?>
		<div class="alert alert-warning">

			Fail To Add
			</div>
		<?php
		}
		?>
		<?php
		if($succ_flag == 3)
		{
		?>
		<div class="alert alert-danger">your Record Deleted successfully!!!!!</div>
		<?php
		}
		?>
			<div class="row">
				
				<div class="col-sm-6 col-md-6 col-lg-6 form-group mb-12">
					<label class="form-group mb-4 set-row label_marg"><b>Update Title</b></label>
					<div class="input-group-icon input-group-icon-left  set-row">
						<span class="input-icon input-icon-left"><i class="fas fa-user"></i></span>
						<input type="text" name="update_title" id="title" value = "<?php echo $update_title; ?>" class="form-control form-control-air" />
					</div>
				</div>
				<div class="col-sm-6 col-md-6 col-lg-6 form-group mb-12">
					<label class="form-group mb-4 set-row label_marg"><b>Description</b></label>
					<div class="input-group-icon input-group-icon-left  set-row">
						<span class="input-icon input-icon-left"><i class="fas fa-user"></i></span>
						<input type="text" name="description" id="description"  value = "<?php echo $description; ?>"class="form-control form-control-air" />
					</div>
				</div>
				<div class="col-sm-12 form-group mb-12" style="text-align:center; padding-left:0px; padding-right:0px; padding-top:20px;">
					<div class="col-sm-4 form-group mb-4" style="margin:auto;">
						<button class="btn btn-pink btn-air" type="submit" name="add_btn" style="width:100%;">Submit</button>
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