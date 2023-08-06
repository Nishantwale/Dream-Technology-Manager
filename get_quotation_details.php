<?php
require_once('lib/function.php');
$db			=	new login_function();

$qu_data	=	array();
if(isset($_POST['res_sc_id']))
{
	$res_sc_id		=	$_POST['res_sc_id'];
	
	$qu_data		=	$db->get_quotation_details_by_cust_id($res_sc_id);
	
	echo json_encode($qu_data);
		
}			

?>