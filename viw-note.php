<?php 
require_once('lib/function.php');

$db		=	new login_function();
	$display_invoice_no	=	"";
	if(isset($_SESSION['current_login_admin']))
	{
		$current_login_admin	=	$_SESSION['current_login_admin'];
	}
	if(!isset($_SESSION['current_login_admin']))
	{	
		header("location:index.php");
	}
	
	if(isset($_GET['note_id']))
	{
		 $i_id	=	$_GET['note_id'];
		 $_SESSION['note_id'] = $i_id;
	}
	  else if(isset($_SESSION['note_id']))
	{
		$i_id	= $_SESSION['note_id'];
	}
	$fetch_invoice_id = $db->fetch_invoice_id_by_cust_id($i_id);
	$display_invoice_no=$db->fetch_invoice_no_by_id($i_id);
	
	$invoice_date   =   $db->fetch_invoice_date_by_cust_id($i_id);
	
	$date_data	=	explode("-",$invoice_date);
	$invoice_date	=	$date_data[2]."-".$date_data[1]."-".$date_data[0];
	
	$login_details	=	array();
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
	$bill_type=$db->fetch_bill_type_from_invoice($i_id);
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
				width:80px;
				font-weight:bold;
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
            <?php
             if(isset($_GET['hdr']))
        	{
            ?>
            <img src="logo/company-header.jpg">
            <?php
        	}
            ?>
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
			<h3 style="margin-bottom:0px; margin-top:10px;"><center>RECEIPT</center></h3>
			<div style="height:30px;margin-bottom:0px;float:right; margin-top:10px;">
				<div class="label-data">Ref.Invoice No. - <?php echo $display_invoice_no; ?></div> <br />
				<div class="label-data" style="margin-top:0px;" >Ref. Inv. Date - <?php echo $invoice_date; ?></div>	
			</div>
			<div class="data" style="margin:0px;">
				 
				<p class="name-data">
				<div class="info">To </div> - <?php echo $name; ?><br />
				<div class="info">Address </div> - <?php echo $address; ?><br />
				
				
			    </p>
			</div>
		
			<div style="height:310px;margin-bottom:0px; text-align:justify; font-size:14px;">
			 
			<?php
			   echo $note_notice    =   $db->get_notice_comment_of_invoice($i_id);
			?>
			
			</div>
			<br /><br />
			<p class="footer-data"><b>DREAM TECHNOLOGY</b><br />
			<label style="font-size:12px;">Seal & Singnature .</label></p><br />
			 <?php
             if(isset($_GET['hdr']))
        	{
            ?>
            <img src="logo/comapny-footer.jpg">
            <?php
        	}
            ?>
			
			
			</div>
		</div>
	<script type="text/javascript">
//<![CDATA[
        bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
  //]]>
  </script>
	
	

	</body>
</html>