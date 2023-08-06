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
	
	if(isset($_GET['c_id']))
	{
		 $i_id	=	$_GET['c_id'];
		 $_SESSION['c_id'] = $i_id;
	}
	  else if(isset($_SESSION['c_id']))
	{
		$i_id	= $_SESSION['c_id'];
	}

	$fetch_invoice_id = $db->fetch_quotation_id_by_cust_id($i_id);
	$display_quotation_no=$db->fetch_quotation_no_by_id($i_id);
	$login_details	=	$db->get_all_product_info($fetch_invoice_id);
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
		}
	$date_of_letter = date("Y-m-d");
	$yrdata= strtotime($date_of_letter);
    $bill_type=$db->fetch_bill_type_from_quotation($i_id);
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>Agreement</title>
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
			.mid-section
			{
				min-height:450px;
				width:500px;
				margin:auto;
				font-family:cambria;
				margin-top:100px;
				border:0px solid;
			}
			.header-contain
			{
				display:inline-table;
				float:left;
				padding:10px;
			}
			
			h3
			{
				text-align:center;
				text-transform:uppercase;
			}
			.name-data
			{
				font-weight:bold;
				font-size:13px;
				
			}
			
			.footer-data
			{
				text-transform:uppercase;				
				line-height:22px;
				font-size:14px;
				float:right;	
				margin-right:20px;
				text-align:center;
			}
			.label-data
			{
				font-weight:bold;
				font-size:13px;
				display:inline-table;
			}
			table
			{
				font-size:15px;
			}
			th
			{
				
				padding:3px;
				text-align:center;
				border:1px solid black;
			}
			td
			{
				padding:5px;
				border:1px solid black;
			}
			.info
			{
				display:inline-table;
				width:75px;
				margin-right:5px;
			}
			@media print {
			  @page { margin: 0; }
			  body { margin: 0.6cm; }
			}
		</style>
<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
<script src="js/wow.min.js"></script>
</head>
<body style="background-color:white;">
<div class="mid-section">
			<span style="font-size:13px;">Addr.: 52, Near SB Vihar, Opp. Balaji Sarovar Hotel, Asra, Hotgi Road, Solapur- 413 003</span>
			
			<?php
			if($bill_type=="gst")
			{
			?>
			<span style="font-size:13px;"><center>GST NO:27CRGPK5205E1Z1</center></span>
			<?php
			}
			?>
		<hr style="margin-bottom:2px; margin-top:3px !important; border:1px dashed black;" />
			<h3 style="margin-bottom:0px; margin-top:10px;"><center>Quotation</center></h3>
			<div style="height:30px;margin-bottom:0px;float:right; margin-top:10px;">
				<div class="label-data">Quotation No - <?php echo $display_quotation_no; ?></div> <br />
				<div class="label-data" style="margin-top:0px;" >Date - <?php echo date('d-M-Y', $yrdata); ?></div>	
			</div>
			<div class="data" style="margin:0px;">
				 
				<p class="name-data">
				<div class="info">To </div> - <?php echo $name; ?><br />
				<div class="info">Address </div> - <?php echo $address; ?><br />
				<div class="info">Mo./Phone </div>-  <?php echo $primary_contact; ?></p>
			
			</div>
		
			<div style="height:300px;margin-bottom:0px; ">
			 <table border="1" style="border-collapse:collapse;width:100%;font-size:12px;">
                <tr>
					<th width="20" rowspan="2">Sr.No</th>
					<th width="3500" rowspan="2" >Title</th>
                    <th width="40" rowspan="2"> Amount</th>
					<th width="50" rowspan="2">Discount</th>
					<?php
					if($bill_type=="gst")
					{
					?>
					<th width="140" colspan="2">GST</th>	
					<?php
					}
					?>	
					<th width="10" rowspan="2">Total</th>					
                </tr>
				 <tr>
					<?php
					if($bill_type=="gst")
					{
					?>
					<th width="70" >CGST  <br />(9 %) </th>
					<th width="70" >SGST <br /> (9 %) </th>	
					<?php
					}
					?>
				</tr>                   
			<?php
				$actual_total 			= 	0;
				$discount_total			=	0;
				$cgst_amount_total		=	0;
				$sgst_amount_total		=	0;
				$total_amount_total		=	0;
				$details = $db->fetch_quotation_cart_data_by_cust_id($i_id);
				if(!empty($details))
				{	$count = 0;
					foreach($details as $record)
					{
						$invoice_id		=	$details[$count][0];
						$t_id			=	$details[$count][1];
						$c_id			=	$details[$count][2];
						$service		=	$details[$count][3];
						$comment		=	$details[$count][4];
						$actual_amount	=	$details[$count][5];
						$discount_amount=	$details[$count][6];
						
						//$bill_type		=	$details[$count][7];
						
						
						
						
						$final_amount	=	0;
						$cgst_amount	=	0;
						$sgst_amount	=	0;
						$total_amount	=	0;
						$final_amount	=	$actual_amount-$discount_amount;
						$cgst_amount	=	($final_amount*9)/100;
						$sgst_amount	=	($final_amount*9)/100;
						$total_amount	=	$final_amount+$cgst_amount+$sgst_amount;
						if($bill_type!="gst")
						{
							$cgst_amount	=	0;
							$sgst_amount	=	0;
							$total_amount	=	$final_amount;

						}
						
						
						$actual_total	= $actual_total  + $actual_amount; 
						$discount_total	= $discount_total+ $discount_amount; 
						$cgst_amount_total=$cgst_amount_total+ $cgst_amount; 
						$sgst_amount_total=$sgst_amount_total+ $sgst_amount; 
						$total_amount_total=$total_amount_total+ $total_amount; 
						
						$service_name 	=	$db->fetch_service_name($service);

			?>	
				<tr>
                    <td style="text-align:center;"><?php echo $count+1; ?></td>
					<td style="font-size:12px !important;"><?php echo $service_name; ?><br /><span style="font-size:14px;"><?php echo $comment; ?></span></td>
					<td style="text-align:center;"><?php echo $actual_amount; ?>/-</td>
					<td style="text-align:center;"><?php echo $discount_amount; ?>/-</td>

					<?php
					if($bill_type=="gst")
					{
					?>
					<td style="text-align:center;"><?php echo $cgst_amount; ?>/-</td>
					<td style="text-align:center;"><?php echo $sgst_amount; ?>/-</td>
					<?php
					}
					?>
					<td style="text-align:center;"><?php echo $total_amount; ?>/-</td>

				</tr>			
			<?php
					
						$count++;
					}
					?>
						<tr>
							<td style="text-align:center; padding:15px;" colspan="2"><b>Total Amount -</b></td>
							<td style="text-align:center;"><b><?php echo $actual_total; ?>/-</b></td>
							<td style="text-align:center;"><b><?php echo $discount_total; ?>/-</b></td>
							<?php
							if($bill_type=="gst")
							{
							?>
							<td style="text-align:center;"><b><?php echo $cgst_amount_total; ?></b></td>
							<td style="text-align:center;"><b><?php echo $sgst_amount_total; ?></b></td>
							<?php
								}
							?>
							<td style="text-align:center;"><b><?php echo $total_amount_total; ?>/-</b></td>

						</tr>
					<?php	
				}
			?>
			</table>
			
			
			</div>
			<br /><br />
			<p class="footer-data"><b>DREAM TECHNOLOGY</b><br />
			<label style="font-size:12px;">Seal & Singnature .</label></p><br />
			
			
			
			</div>
		</div>
	

	</body>
</html>