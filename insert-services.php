<?php
require_once('lib/function.php');
$db		=	new login_function();
$success="";

		if(isset($_POST['submitData']))
		{
		
			$service 	= $_POST['service'];
			
			if($db->create_services($service))
			{
				$success	= 1;					
			}
			else
			{
				$success	= 2;
			}

		}
echo json_encode($success);
?>