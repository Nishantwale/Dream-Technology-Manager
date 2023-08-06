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
	$name				=	"";
	$shop_name			=	"";
	$address			=	"";
	$primary_contact	=	"";
	$other_contact		=	"";
	$password			=	"";
	$logo				=	"";
	$c_email			=	"";
	
	
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
	
	if(isset($_GET['i_1']))
	{
		$i_1 = $_GET['i_1'];
		$db->update_logo($update_id);
		unlink('logo/'.$i_1);
		header("Location:update-info.php");
	}
	
	
	if(isset($_POST['add_btn1']))
	{
		$valid_formats = array("jpg","png","gif","bmp","jpeg","pdf","JPEG","JPG","BMP","PNG","GIF","PDF");
	
		if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
		{	
			$name 				= 	$_FILES['logo']['name'];
			$size 				= 	$_FILES['logo']['size'];

			if(strlen($name))
				{				
					list($txt, $ext) = explode(".", $name);
					
					if(in_array($ext,$valid_formats))
					{
						$files	=	array();

						function generateRandomString4($length = 10) {
							$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
							$charactersLength = strlen($characters);
							$randomString = '';
							for ($i = 0; $i < $length; $i++) 
							{
								$randomString .= $characters[rand(0, $charactersLength - 1)];
							}
							return $randomString;
						}
						
						$current_random_string = generateRandomString4();
						
						$logo = $current_random_string.".".strtolower($ext);						

						$tmp = $_FILES['logo']['tmp_name'];
						
						$img_Dir = "logo/";
						
						if(!file_exists($img_Dir))
						{
							mkdir($img_Dir);
						}
						
						if(move_uploaded_file($tmp,$img_Dir.$logo))
						{
							
						}
						else
						{
							$image_error4	=	"failed" ;
							$flag				=	1;
						}	
					}
					else
					{
						$image_error4	= "Invalid file format";
						$flag				=	1;	
					}	
				}	
		}
		if($flag == 0)
		{
				$image_name = $db->get_logo_name_by_id($update_id);
				if($image_name!="")
				{
					$db->update_logo_image_by_id($update_id,$logo);
					unlink('logo/'.$image_name);
				}else
				{
					$db->update_logo_image_by_id($update_id,$logo);
				}
				$flag = 1 ;
			}
	
	}
		if(isset($_POST['add_btn']))
		{
		$name  			 = $_POST['name'];
		$shop_name 		 = $_POST['shop_name'];
		$c_email 		 = $_POST['c_email'];
		$address 		 = $_POST['address'];
		$primary_contact = $_POST['primary_contact'];
		$other_contact 	= $_POST['other_contact'];
		$password	 	= $_POST['password'];
		
		if(strlen($primary_contact)!=10)
		{
			
			$contact_no_error="Please Enter 10 Digit Mobile Number";
			$flag = 1;
		}
		/*if(!is_numeric($primary_contact))
		{
			$contact_no_error	=	"Please enter numeric contact no";
			$flag				=	1;
		}
		else if(strlen($primary_contact)<10 OR strlen($primary_contact)>10)
		{
			$contact_no_error	=	"Please enter valid 10 digit contact no";
			$flag				=	1;
		}
		if(!is_numeric($other_contact))
		{
			$contact_no_error	=	"Please enter numeric contact no";
			$flag				=	1;
		}
		else if(strlen($other_contact)<10 OR strlen($other_contact)>10)
		{
			$contact_no_error	=	"Please enter valid 10 digit contact no";
			$flag				=	1;
		}*/
		if($flag==0)
		{
			$db->update_product_information($update_id,$name,$shop_name,$c_email,$address,$primary_contact,$other_contact,$password);
			$success_msg = 1;
		}
	}
	
	$login_details	=	$db->get_all_product_info($update_id);
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
    <title>Update Customer</title>
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
					<div class="alert alert-success">

					Updated Successfully.
					</div>
					<?php
					}
				?>
<div class="ibox" style="border-radius:5px; padding:7px;">
			<div class="ibox-head">
				<div class="ibox-title"><i class="fas fa-user-tie" style="margin-right:10px;"></i>UPDATE  	CUSTOMER</div>
			</div>
		 <form class="form-pink" method="post" action="<?php echo $_SERVER['PHP_SELF']?>" name="myForm" onsubmit="return validateForm()" autocomplete="off" enctype="multipart/form-data">
		
		
		<div class="ibox-body">
			<div class="row">
				
				<div class="col-sm-6 col-md-6 col-lg-6 form-group mb-6">
					<label class="form-group mb-4 set-row label_marg"><b>Enter Customer Name</b></label>
					<div class="input-group-icon input-group-icon-left  set-row">
						<span class="input-icon input-icon-left"><i class="fas fa-user"></i></span>
						<input type="text" name="name" class="form-control form-control-air" value="<?php echo $name; ?>" placeholder="Enter Customer Name"  required />
					</div>
				</div>
				<div class="col-sm-6 col-md-6 col-lg-6 form-group mb-6">
					<label class="form-group mb-4 set-row label_marg"><b>Enter Mobile Number</b></label>
					<div class="input-group-icon input-group-icon-left  set-row">
						<span class="input-icon input-icon-left"><i class="fas fa-phone"></i></span>
						<input type="number" name="primary_contact" class="form-control form-control-air" value="<?php echo $primary_contact; ?>" placeholder="Enter Mobile Number"   required />
						<span style="color:red;"><?php echo $contact_no_error; ?></span>
					</div>
				</div>
				<div class="col-sm-6 col-md-6 col-lg-6 form-group mb-6">
					<label class="form-group mb-4 set-row label_marg"><b>Enter Company/Shop Name</b></label>
					<div class="input-group-icon input-group-icon-left  set-row">
						<span class="input-icon input-icon-left"><i class="fas fa-building"></i></span>
						<input type="text" name="shop_name" class="form-control form-control-air" value="<?php echo $shop_name; ?>" name="shop_name" placeholder="Enter Company/Shop Name"   />
					</div>
				</div>
				<div class="col-sm-6 col-md-6 col-lg-6 form-group mb-6">
					<label class="form-group mb-4 set-row label_marg"><b>Enter Address</b></label>
					<div class="input-group-icon input-group-icon-left  set-row">
						<span class="input-icon input-icon-left"><i class="fas fa-building"></i></span>
						<input type="text" name="address" class="form-control form-control-air" value="<?php echo $address; ?>" name="address" placeholder="Enter Address"   />
					</div>
				</div>
				 
				 <div class="col-sm-6 col-md-6 col-lg-6 form-group mb-6">
					<label class="form-group mb-4 set-row label_marg"><b>Enter Other Mobile Number</b></label>
					<div class="input-group-icon input-group-icon-left  set-row">
						<span class="input-icon input-icon-left"><i class="fas fa-phone"></i></span>
						<input type="number" name="other_contact" class="form-control form-control-air" value="<?php echo $other_contact; ?>" placeholder="Enter Other Mobile Number"   />
					</div>
				</div>
				<div class="col-sm-6 col-md-6 col-lg-6 form-group mb-6">
					<label class="form-group mb-4 set-row label_marg"><b>Enter Email Id</b></label>
					<div class="input-group-icon input-group-icon-left  set-row">
						<span class="input-icon input-icon-left"><i class="fas fa-info"></i></span>
						<input type="email" name="c_email" class="form-control form-control-air" value="<?php echo $c_email; ?>" placeholder="Enter Email ID"   />
					</div>
				</div>
				
				<div class="col-sm-6 col-md-6 col-lg-6 form-group mb-6">
					<label class="form-group mb-4 set-row label_marg"><b>Password</b></label>
					<div class="input-group-icon input-group-icon-left  set-row">
						<span class="input-icon input-icon-left"><i class="fas fa-address-book"></i></span>
						<input type="password" name="password" class="form-control form-control-air" value="<?php echo $password; ?>" placeholder="Enter Password"   />
					</div>
				</div>
				
				<!--<div class="col-sm-3 col-md-3 col-lg-3 form-group mb-6">
					<label class="form-group mb-4 set-row label_marg"><b>Shop Image (1)</b></label>
					<div class="input-group-icon input-group-icon-left  set-row">
						<span class="input-icon input-icon-left"><i class="fas fa-check"></i></span>
						<input type="file" name="shop_image1" class="form-control form-control-air"  />
					</div>
				</div>
				
				<div class="col-sm-3 col-md-3 col-lg-3 form-group mb-6">
					<label class="form-group mb-4 set-row label_marg"><b>Shop Image (2)</b></label>
					<div class="input-group-icon input-group-icon-left  set-row">
						<span class="input-icon input-icon-left"><i class="fas fa-check"></i></span>
						<input type="file" name="shop_image2" class="form-control form-control-air"  />
					</div>
				</div>
				<div class="col-sm-3 col-md-3 col-lg-3 form-group mb-6">
					<label class="form-group mb-4 set-row label_marg"><b>Shop Image (3)</b></label>
					<div class="input-group-icon input-group-icon-left  set-row">
						<span class="input-icon input-icon-left"><i class="fas fa-check"></i></span>
						<input type="file" name="shop_image3" class="form-control form-control-air"  />
					</div>
				</div>
				<div class="col-sm-3 col-md-3 col-lg-3 form-group mb-6">
					<label class="form-group mb-4 set-row label_marg"><b>Shop Image (4)</b></label>
					<div class="input-group-icon input-group-icon-left  set-row">
						<span class="input-icon input-icon-left"><i class="fas fa-check"></i></span>
						<input type="file" name="shop_image4" class="form-control form-control-air"  />
					</div>
				</div>-->
				<div class="col-sm-12 form-group mb-12" style="text-align:center; padding-left:0px; padding-right:0px; padding-top:20px;">
					<div class="col-sm-4 form-group mb-4" style="margin:auto;">
						<button class="btn btn-pink btn-air" type="submit" name="add_btn" style="width:100%;">UPDATE CUSTOMER DETAILS</button>
					</div>
				</div>
			</div>
		</div>
	</form>
	<form role="form" method="post" enctype="multipart/form-data">
		<div class="ibox-head">
				<div class="ibox-title">
				<i class="fas fa-user-tie" style="margin-right:10px;"></i>UPDATE LOGO</div>
			</div>
				<br /><br />
			<div class="ibox-body">
			<div class="row">
				
				<div class="col-sm-2 col-md-2 col-lg-2 form-group mb-2">
				<?php
					if($logo != "")
					{
				?>
					<a href="logo/<?php echo $logo; ?>" target="_blank"><img src="logo/<?php echo $logo; ?>" height="60px" width="60px"></a><br /><br />
					<a href="update-info.php?i_1=<?php echo $logo; ?>">Remove Image</a>
				<br />
				<?php
					}else
					{												
				?>
					<img src="logo/no-image.png" height="60px" width="40px"  style="float:right;"><br />

				<?php
					}
				?>
				<br />
				</div>
				<div class="col-sm-4 col-md-4 col-lg-4 form-group mb-4">
					<input class="form-control" type="file" name="logo" required>
					<br />
				</div>
				<span style="color:red;"><?php echo $image_error; ?></span>
				<div class="col-sm-4 col-md-4 col-lg-4 form-group mb-4">		
					<button type="submit" class="btn btn-pink btn-air" name="add_btn1" style="">Update</button>
				</div>
			</div>
		</div>
		<br />
		<br />
	</form>
	<center><a href="customer-list.php" style="color:red;font-weight:bold;">Back To List</a></center>
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