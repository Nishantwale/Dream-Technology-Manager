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
	$expenses  = "";
	$amount = "";
	
	$title="";$date_to="";$date_from="";
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
		$expenses 		 = $_POST['expenses'];
		$amount 		 = $_POST['amount'];
		if(!is_numeric($amount))
		{
			$amount_error	=	"Please enter numeric Value";
			$flag				=	1;
		}

		if($flag==0)
		{
			$db->update_expenses($update_id,$expenses,$amount);
			$success_msg = 1;
		}
	}
	$log_details =$db->fetch_exepense_data($update_id);
	$counter = 0;
	if(!empty($log_details))
	{
		$id = $log_details[$counter][0];
		$title = $log_details[$counter][1];
		$amount = $log_details[$counter][2];
		$date = $log_details[$counter][3];
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

	Expenses Updated Successfully.
	</div>
	<?php
	}
?>

	<div class="ibox" style="border-radius:5px; padding:7px;margin-top:10px;">
	<form class="form-pink" method="post" action="<?php echo $_SERVER['PHP_SELF']?>" name="myForm" onsubmit="return validateForm()" autocomplete="off" enctype="multipart/form-data">
		
		<div class="ibox-head">
			<div class="ibox-title"><i class="fas fa-plus" style="margin-right:10px;"></i>Update Expenses Details</div>
		</div>
		
		<div class="ibox-body">
			<div class="row">
				<div class="col-sm-4 col-md-4 col-lg-4 form-group mb-6">
					<label class="form-group mb-4 set-row label_marg"><b>Enter Title</b></label>
					<div class="input-group-icon input-group-icon-left  set-row">
						<span class="input-icon input-icon-left"><i class="fas fa-edit"></i></span>
						<input type="text" name="expenses" id="expenses" class="form-control form-control-air" value="<?php echo $title; ?>" placeholder="Enter Title"  required />
					</div>
				</div>
				<div class="col-sm-4 col-md-4 col-lg-4 form-group mb-6">
					<label class="form-group mb-4 set-row label_marg"><b>Enter Amount</b></label>
					<div class="input-group-icon input-group-icon-left  set-row">
						<span class="input-icon input-icon-left"><i class="fas fa-rupee"></i></span>
						<input type="number" name="amount" id="amount" class="form-control form-control-air" value="<?php echo $amount; ?>" placeholder="Enter Amount"  required />
					</div>
				</div>
				
				<div class="col-sm-4 col-md-4 col-lg-4 form-group mb-6" style="text-align:center; padding-left:0px; padding-right:0px; padding-top:23px;">
					<button class="btn btn-pink btn-air" type="submit" name="add_btn" style="width:100%;">UPDATE DETAILS</button>
				</div>
			</div>
			
		</div>
		<center><a href="add-expenses.php" style="color:red;font-weight:bold;">Back To List</a></center>
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
