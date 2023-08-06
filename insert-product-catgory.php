<?php
require_once('lib/functions.php');
$db		=	new login_function();
$success="";

		if(isset($_POST['submitData']))
		{
		
			$title 	= $_POST['til'];
			
			$db_category_id 		= $db->get_product_category_details($title);
		  
			if($db_category_id=="")
			{
				if($db->create_product_category($title))
				{
					$success	= 1;					
				}
			}
			else
				{
				$success	= 2;
				}

		}
echo json_encode($success);
?>