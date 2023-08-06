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
$flag = 0;
	$amount_error="";
	$success_msg =0;
	$name_error="";
	$select_error="";
	$p_name	="";
	$amount="";
	if(!isset($_SESSION['current_login_admin']))
	{
		header("Location:/index.php");
	}
	if(isset($_SESSION['current_login_admin']))
	{
		$email	=	$_SESSION['current_login_admin'];
	}
	if(isset($_GET['update_id']))
	{
		 $update_id	=	$_GET['update_id'];
		 $_SESSION['current_update_id'] = $update_id;
	}
	  else if(isset($_SESSION['current_update_id']))
	{

		$update_id	= $_SESSION['current_update_id'];
	}
	if(isset($_POST['add_btn']))
	{
		$customer_name   = $_POST['customer_name'];
		$service 		= $_POST['service'];
		$p_name 		 = $_POST['p_name'];
		$amount 		 = $_POST['amount'];
	
		if(!is_numeric($amount))
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
			$select_error	=	"Please Select Service Name";
			$flag				=	1;
		}
		
		
	
		if($flag==0)
		{
			$db->update_service_information($update_id,$customer_name,$service,$p_name,$amount);
			$success_msg = 1;
		}
	}
	
	$login_details	=	$db->get_all_service_info($update_id);
	$counter = 0;
		if(!empty($login_details))
		{		
			$id					=	$login_details[$counter][0];
			$customer_name		=	$login_details[$counter][1];
			$service			=	$login_details[$counter][2];
			$p_name				=	$login_details[$counter][3];
			$amount				=	$login_details[$counter][4];
										
		}
	
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>SERVICES</title>
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
table,th,td
{
	text-align:center;
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
.my-custom-scrollbar {
position: relative;
height: 400px;
overflow: auto;
}
.table-wrapper-scroll-y {
display: block;
}
	

	
</style>

<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
<script src="js/wow.min.js"></script>
</head>
<body class="fixed-navbar">

<div class="page-wrapper" style="height:900px;">

<?php include('header.php'); ?>
<?php include('side-bar.php'); ?>

<div class="content-wrapper">


		<?php
			if($success_msg == 1)
			{?>
			<div class="alert alert-success">

			Services Added Successfully.
			</div>
			<?php
			}
			?>
	<div class="ibox" style="border-radius:5px; padding:7px;margin-top:10px;">
	 <form class="form-pink" method="post" action="<?php echo $_SERVER['PHP_SELF']?>" name="myForm" onsubmit="return validateForm()" autocomplete="off" enctype="multipart/form-data">
		
		<div class="ibox-head">
			<div class="ibox-title"><i class="fas fa-user-tie" style="margin-right:10px;"></i>UPDATE SERVICES</div>
		</div>
		
		<div class="ibox-body">
			<div class="row">
				<div class="col-sm-4 col-md-4 col-lg-4 form-group mb-6">
					<label class="form-group mb-4 set-row label_marg"><b>Select Customer</b></label>
					<div class="input-group-icon input-group-icon-left  set-row">
						<span class="input-icon input-icon-left"><i class="fas fa-user"></i></span>
						<select name="customer_name" class="form-control form-control-air" id="name">
						<?php 
							$cust_name = $db->fetch_cust_name($customer_name);
							if($customer_name!= "" )
							{	
							?>
							<option value ="<?php echo $customer_name; ?>"><?php echo $cust_name; ?></option>
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
						<span style="color:red"><?php echo $name_error; ?></span>
					</div>
				</div>
				<div class="col-sm-4 col-md-4 col-lg-4 form-group mb-6">
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
						<span style="color:red"><?php echo $select_error; ?></span>
					</div>
				</div>
				<div class="col-sm-4 col-md-4 col-lg-4 form-group mb-6">
					<label class="form-group mb-4 set-row label_marg"><b>Project Name</b></label>
					<div class="input-group-icon input-group-icon-left  set-row">
						<span class="input-icon input-icon-left"><i class="fas fa-user"></i></span>
						<input class="form-control form-control-air" placeholder="Enter Project Name" name="p_name" value="<?php echo $p_name; ?>">
						
					</div>
				</div>
				<div class="col-sm-4 col-md-4 col-lg-4 form-group mb-6">
					<label class="form-group mb-4 set-row label_marg"><b>Service Amount</b></label>
					<div class="input-group-icon input-group-icon-left  set-row">
						<span class="input-icon input-icon-left"><i class="fas fa-user"></i></span>
						<input class="form-control form-control-air" placeholder="Enter Project Name" name="amount" value="<?php echo $amount; ?>">
						<span style="color:red"><?php echo $amount_error; ?></span>
						
					</div>
				</div>
				
				<div class="col-sm-4 col-md-4 col-lg-4 form-group mb-6" style="text-align:center;"><br />
					<button class="btn btn-pink btn-air" type="submit" name="add_btn" style="width:100%;padding:10px;">UPDATE SERVICES</button>
				</div>
			</div>
		</div>
		<center><a href="service-report.php" style="color:red;text-align:center;">Back To List</a></center>
	</form>
	</div>
	</div>	

</div>
</div>
	</div>
</div>

		<?php include('footer.php'); ?>
	
<?php //include('search.php'); ?>
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
<?php //include('right-side-bar.php'); ?>
<script src="js/jquery.min.js"></script>

<script type="text/javascript">
function submitData()
{	
	if($('#service').val()=="")
	{
	alert("Please Enter Service");
	}
	else
	{
	//alert('hii');
	var service = $("#service").val();
			
	 $.ajax({
            type:'POST',
            url:'insert-services.php',
            data:'submitData=1&service='+service,
			
			success:function(msg)
                {
                   
                   if(msg == '1')
                    {	
						$('#modalPush').modal('hide');
						alert("Services Added Successfully...!!!");
						location.reload(true);
                                               
                    }
                    
                }
            });
			}
				
}

 
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
		pageLength: 10,
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
