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

$success_msg	=	"";
$service="";

	if(isset($_POST['add']))
	{
		$service 		 = $_POST['service'];

		if($db->add_services($service))
		{
			$success_msg = 1;
			$service ="";
		}
	}
	 if(isset($_GET['delete_id']))
	{
		 $del_id	=	$_GET['delete_id'];
		 $db->delete_services($del_id);
		 $succ_msg	=	2;
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
			<div class="ibox-title"><i class="fas fa-plus" style="margin-right:10px;"></i>ADD SERVICES</div>
		</div>
		
		<div class="ibox-body">
			<div class="row">
				<div class="col-sm-6 col-md-6 col-lg-6 form-group mb-6">
					<label class="form-group mb-4 set-row label_marg"><b>Enter Services</b></label>
					<div class="input-group-icon input-group-icon-left  set-row">
						<span class="input-icon input-icon-left"><i class="fas fa-user"></i></span>
						<input type="text" name="service" class="form-control form-control-air" value="<?php echo $service; ?>" placeholder="Enter Service"  required />
					</div>
				</div>
				
				<div class="col-sm-6 col-md-6 col-lg-6 form-group mb-6" style="text-align:center; padding-left:0px; padding-right:0px; padding-top:20px;">
					<div class="col-sm-4 form-group mb-4" style="margin:auto;">
						<button class="btn btn-pink btn-air" type="submit" name="add" style="width:100%;">SAVE SERVICES</button>
					</div>
				</div>
			</div>
		</div>
	</form>
	</div>	
	<div class="ibox" style="border-radius:5px; padding:7px;margin-top:10px;">	
	<div class="flexbox mb-4" style="margin-left:20px;margin-right:20px;">
		<div class="input-group-icon input-group-icon-left mr-3">
			<span class="input-icon input-icon-right font-16"><i class="fas fa-search"></i></span>
			<input class="form-control form-control-rounded form-control-solid" id="key-search" type="text" placeholder="Search ...">
		</div>
			
	</div>
	<div class="table-wrapper-scroll-y my-custom-scrollbar">
	<div class="ibox-head">
		<div class="ibox-title">Services List</div>
	</div>
	<div class="table-responsive" id="table_response" style="height:100%; width:100%; overflow:auto;">
		<table class="table table-bordered table-hover" id="example" >
			<thead class="thead-default thead-lg">
				<tr>
					<th>Sr.No</th>
					<th>Title</th> 
					<th>Action</th> 
					<th>Action</th> 
					
				</tr>
			</thead>
			<tbody>
			<?php
				$report_details = $db->get_all_service();
				if(!empty($report_details))
				{
					$counter =0;
					foreach($report_details as $record)
					{
						$id				=	$report_details[$counter][0];
						$name			=	$report_details[$counter][1];
			?>
				<tr>
					<td><?php echo $counter+1; ?></td>
					<td><?php echo $name; ?></td>
					<td><a href="update-service-info.php?update_id=<?php echo $id;?>"><i class="far fa-edit" style="color:blue; padding:5px;"></i></a></td>
					<td><a href="add-service.php?delete_id=<?php echo $id;?>" onclick="return confirm('Are you sure?');"><i class="fas fa-trash-alt"style="color:red; padding:5px;"></i></a></td>
				</tr>
			   <?php
				$counter ++;
					}
				}
			   
			   ?>
				
			</tbody> 
		</table> 
	</div>
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
