<?php 
require_once('lib/function.php');

$db		=	new login_function();

	$flag=0;
	$contact_no_error="";
	$succ_flag = 0;

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
		 
		 $succ_flag = 3;
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
	
	
	
	if(isset($_POST['add_btn']))
	{
		$title			=	$_POST['title'];
		$description	=	$_POST['description'];
		
		if($db->add_project($title,$description))
		{
			$succ_flag		=	1;
		}
		else
		{
			$succ_flag		=	2;
		}
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

			Project Details added. Successfully....!
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
		
			<div class="row">
				
				<div class="col-sm-6 col-md-6 col-lg-6 form-group mb-12">
					<label class="form-group mb-4 set-row label_marg"><b>Project Title</b></label>
					<div class="input-group-icon input-group-icon-left  set-row">
						<span class="input-icon input-icon-left"><i class="fas fa-user"></i></span>
						<input type="text" name="title" id="title" class="form-control form-control-air" />
					</div>
				</div>
				<div class="col-sm-6 col-md-6 col-lg-6 form-group mb-12">
					<label class="form-group mb-4 set-row label_marg"><b>Description</b></label>
					<div class="input-group-icon input-group-icon-left  set-row">
						<span class="input-icon input-icon-left"><i class="fas fa-user"></i></span>
						<input type="text" name="description" id="description" class="form-control form-control-air" />
					</div>
				</div>
				<div class="col-sm-12 form-group mb-12" style="text-align:center; padding-left:0px; padding-right:0px; padding-top:20px;">
					<div class="col-sm-4 form-group mb-4" style="margin:auto;">
						<button class="btn btn-pink btn-air" type="submit" name="add_btn" style="width:100%;">Submit</button>
					</div>
				</div>
				<div class="ibox-body" style="padding:7px; padding-top:0px;width:100%;">
	<?php
		if($succ_flag == 3)
		{
		?>
		<div class="alert alert-danger">Your Record Deleted successfully!!!!!</div>
		<?php
		}
		?>
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
	
<div class="table-responsive row" style="width:100%;">
	<table class="table table-bordered table-hover" id="example" style="overflow-x:auto;overflow-y:auto;" cellpadding=0 cellspacing=0>
		<thead class="thead-default thead-lg">
			<tr>
			    <th>Sr No</th>
				<th>Project Title</th>
				<th>Description</th>
				<th>Status</th>
				<th>Completed By</th>
				<th>Date</th>
				<th>Time</th>
				<th>Delete</th>
				<th>Edit</th>
            </tr>
		</thead>
		<tbody>
			<?php
				$report_details = array();
				$report_details = $db->get_all_project_details();
				if(!empty($report_details))
				{
					$counter = 0;
					foreach($report_details as $record)
					{
						$id				=	$record[0];
						$update_title	=	$record[1];
						$description	=	$record[2];
						$status			=	$record[3];
						$completed_by	=	$record[4];
						$date			=	$record[5];
						$time			=	$record[6];
						?>
					<tr class="odd gradeX">
						<td><?php echo $counter+1; ?></td>
						<td><?php echo $update_title; ?></td>
						<td><?php echo $description; ?></td>
						<td><?php echo $status; ?></td>
						<td><?php echo $completed_by; ?></td>
						<td><?php echo $date; ?></td>
						<td><?php echo $time; ?></td>
						<td><a href="update_project.php?delete_id=<?php echo $id;?>" onclick="return confirm('Are you sure?');"><i class="fas fa-trash-alt" style="color:red;margin-left:20px;"></i></a></td>
						<td><a href="edit_project_details.php?detail_id=<?php echo $id; ?>"><i class="fas fa-edit"style="color:red;margin-left:20px;"></i></td>
					</tr>						
						<?php
						
						$counter++;
					}
				}
				else
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