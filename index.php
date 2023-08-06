<?php 

	require_once("lib/function.php");
	$db = new login_function();
	
	$email_error	=	"";
	$email			=	"";
	$password_error	=	"";
	$flag 			=	0; 
	
	if(isset($_GET['logout']))
	{
		unset($_SESSION['current_login_admin']);	
	}
	if(isset($_SESSION['current_login_admin']))
	{
		header("Location:dashboard.php");
	}
	
	if(isset($_POST['log_btn']))
	{
		$email			=		$_POST['email'];
		$password		=		$_POST['password'];
		
		if($email=="")
		{
			$email_error = "Please enter user name";
			$flag = 1;
		}
		if($password=="")
		{
			$password_error = "Please enter password";
			$flag = 1;
		}
		if($flag==0)
		{
			$result_password = $db->get_password_from_user_name($email);
		
				if($result_password=="")
				{
					$email_error = "This admin is not registered or not verified.";
				}
				else
				{
					if($password==$result_password)
					{
						$_SESSION['current_login_admin'] = $email;
						
						header("Location:dashboard.php");
						$success_flag = "Login Successfully";
					}
					else
					{
						$password_error = "Incorrect password";
					}
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
    <title>Login Page</title>
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
    <!-- PAGE LEVEL STYLES-->
<style>
.col-md-6
{
	margin:auto;
	margin-top:100px;
}

@media only screen and (max-width: 500px) {
	.col-md-6
	{
		margin:30px;
	}
}
</style>

<script>
function validateForm() {
  var x = document.forms["myForm"]["email"].value;
  var y = document.forms["myForm"]["password"].value;
  if (x == "") {
    alert("Enter Username");
    return false;
  }
  if (y == "") {
    alert("Enter Password");
    return false;
  }
}
</script>
</head>

<body class="fixed-navbar">
				<div class="col-md-4" style="width:100%; margin:auto;">
						<img src="logo_nishant.png" width="100%" height="100%" style="margin-top:100px;" >
				</div>
               <div class="row">
					<div class="col-md-6">
						<div class="ibox">
                            <form class="form-pink" method="post" action="<?php echo $_SERVER['PHP_SELF']?>" name="myForm" onsubmit="return validateForm()" autocomplete="off">
							
								<?php
								if($password_error ==1)
								{
								?>
									<div class="alert alert-danger">
									<span class="alert-link">Please!</span> Enter Correct Password.
									</div>
								<?php
								}
								?>	
								
                                <div class="ibox-head">
                                    <div class="ibox-title">LOGIN</div>
                                </div>
                                <div class="ibox-body">
                                    <div class="form-group mb-4">
                                        <div class="input-group-icon input-group-icon-left">
                                            <span class="input-icon input-icon-left"><i class="fas fa-user"></i></span>
                                            <input class="form-control form-control-air" type="text" name="email" placeholder="Enter Email ID" value="<?php echo $email; ?>" >
											<p style="color:red;"><?php echo $email_error; ?></p>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group mb-4">
                                        <div class="input-group-icon input-group-icon-left">
                                            <span class="input-icon input-icon-left"><i class="fas fa-lock"></i></span>
                                            <input class="form-control form-control-air" type="password" name="password" placeholder="Enter Password">
											<p style="color:red;"><?php echo $password_error; ?></p>
                                        </div>
                                    </div>
                                    <div class="form-group mb-0">
                                        <label class="checkbox checkbox-pink">
                                            <input type="checkbox">
                                            <span class="input-span"></span>Remember me</label>
											
											
                                    </div>
									
                                </div>
                                <div class="ibox-footer">
                                    <button class="btn btn-pink btn-air mr-2" type="submit" name="log_btn">Login</button>
                                    <button class="btn btn-secondary" type="reset">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
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
    <!-- PAGE LEVEL PLUGINS-->
    <!-- CORE SCRIPTS-->
    <script src="js/app.min.js"></script>
    <!-- PAGE LEVEL SCRIPTS-->
</body>

</html>