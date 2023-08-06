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
    if(isset($_GET['hdr']))
	{
		 $hdr	=	$_GET['hdr'];
		 $_SESSION['hdr'] = $hdr;
	}
	 else if(isset($_SESSION['hdr']))
	{
		$hdr	= $_SESSION['hdr'];
	}
	$agreement_data=$db->get_agreement_information_by_id($i_id);
	if(!empty($agreement_data))
	{
		$id					=	$agreement_data[0];
		$cust_id			=	$agreement_data[1];
		$project_title		=	$agreement_data[2];
		$deadline_date		=	$agreement_data[3];
		$quotation_id		=	$agreement_data[4];
		$project_description=	$agreement_data[5];
		$date				=	$agreement_data[6];
		$time				=	$agreement_data[7];
		$project_place		=	$agreement_data[8];
	}
	$cust_name 			= 	$db->fetch_customer_name_by_id($cust_id);
	$da=$db->get_quotation_details_by_qu_id($quotation_id);
	if(!empty($da))
	{
		$q_id				=	$da[0];
		$cust_id			=	$da[1];
		$actual_amount		=	$da[2];
		$discount_amount	=	$da[3];
		$bill_type			=	$da[4];
		$quotation_no		=	$da[5];
	}
		$res_date= strtotime($date);
		
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
p
{
	font-size:13px;
	font-style:cambria;
	
}
.main_div
{
	width:900px;
	margin:auto;
	border:1px solid #dfdfdf;
	min-height:1000px;
	padding:20px;
	line-height:20px;
}
.sub_div
{
	//margin-top:100px;
}
b
{
font-weight:bold;
font-size:18px;
}
.dynamic
{
	font-weight:bold;

}
</style>
<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
<script src="js/wow.min.js"></script>
</head>
<body style="background-color:white;">
<div class="main_div">
<div class="sub_div">
<?php
 if(isset($_GET['hdr']))
{
?>
<img src="logo/company-header.jpg">
<span style="font-size:13px;">Addr.: 52, Near SB Vihar, Opp. Balaji Sarovar Hotel, Asra, Hotgi Road, Solapur- 413 003</span>
<hr style="margin-bottom:2px; margin-top:3px !important; border:1px dashed black;" />
<?php
}
?>

<p><span style="float:right;">
Agreement No: <?php echo $id; ?><br />
Date: <?php echo date('d-m-Y', $res_date); ?> </span></p>

<br /> <br /> <br /> <br />
<p>
&nbsp &nbsp  This Software Development Agreement (referred to as the “Agreement” or “Software Development Agreement” throughout) states the terms and conditions that shall govern the contractual agreement between DREAM TECHNOLOGY (the “Developer”), having its principal place of business at 52, Asra Chowk, Hotgi Road, Solapur 413003, and <span class="dynamic"> <?php echo $cust_name; ?> </span> (the “Client”), having its principal place of business at <span class="dynamic"> <?php echo $project_place; ?> </span>, who agrees to be bound by the terms of the Agreement. <br /> <br />
&nbsp &nbsp  The Client has conceptualized the deliverables (the Software) - which are described in further detail onin Exhibit A - and the Developer is a contractor with whom the Client has come to an agreement to develop the Software.
In consideration of the mutual covenants and promises made by both parties regarding this Software Development Agreement, the Developer and the Client (individually, a “Party”, and collectively, “Parties”) agree to the following terms:<br /> <br />

<b>1. Developer s Duties</b> <br /> <br />
The Client hereby engages the Developer and the Developer agrees to be engaged by the Client to develop the Software in accordance with the specifications attached hereto as Exhibit A (the “Specifications”).<br /> <br />
1.	The Developer shall complete the development of the Software according to the milestones described on the form attached hereto as Exhibit B. In accordance with such milestones, the final product shall be delivered to the Client by <span class="dynamic"> <?php echo $deadline_date; ?>  </span> (the “Delivery Date”).<br /> <br />
2.	For a period of 6 Months after delivery of the final product, the Developer shall provide the Client with answers to any questions or assist in solving any problems with regard to the operation of the Software free of charge and billed to the Client at a rate of 4000 per Annual Year As Maintenance Charges thereafter. The Developer agrees to respond to any reasonable request for assistance made by the Client regarding the Software within 48 Hours of the request.<br /> <br />
3.	The Client may terminate this Software Development Agreement at any time upon material breach of the terms herein and failure to resolve such a breach within 1 Week of notification of such a breach. Without any breach from developer side Client can't terminate or cancel the project. If it’s late from client side to provide required material or data for project, at that time this is not considered as breach, developer can extend development time period then.<br /> <br />
4.	The Developer shall provide to the Client after the Delivery Date 1-2 hours of training with respect to the operation of the Software if requested by the Client.<br /> <br />

2. Delivery
The Software shall function in accordance with the Specifications on or before the Delivery Date.
1.	If the Software as delivered does not conform with the Specifications, the Client shall within 2 days of the Delivery Date notify the Developer in writing of the ways on which it does not conform with the Specifications. The Developer agrees that upon receiving such notice, it shall make reasonable efforts to correct any non-conformity.<br /> <br />
2.	The Client shall provide to the Developer written notice of its finding that the Software conforms to the Specifications within 10 days of the Delivery Date (the “Acceptance Date”) unless it finds that the Software does not conform to the Specifications as described in Section 2.1 herein.<br /> <br />
3.	The Software delivery includes the successful running executable software, not software coding.<br /> <br />

<b>3. Compensation</b><br /> <br />
As compensation for the Service, the Client shall pay to Developer the rate fixed for project as per decided milestones. <br /> <br />

<b>4. Intellectual property rights in the software</b><br /> <br />
The Parties acknowledge and agree that the Client will hold all intellectual property rights to the Software including, but not limited to, copyright and trademark rights. The Developer agrees not to claim any such ownership in the Software’s intellectual property at any time prior to or after the completion and delivery of the Software to the Client.<br /> <br />


<b>5. Change in specifications</b><br /> <br />
The Client may request that reasonable changes be made to the Specifications and tasks associated with the implementation of the Specifications. If the Client requests such a change, the Developer will use its best efforts to implement the requested change at no additional expense to the Client.
In the event that the proposed change will, in the view of the Developer, require a delay in the delivery of the Software or would result in additional expense to the Client, then the Client and the Developer shall confer and the Client may either withdraw the proposed change or require the Developer to deliver the Software with the proposed change and subject to the delay and/or additional expense. The Client agrees and acknowledges that the judgment regarding any delay or additional expense shall be made solely by the Developer.<br /> <br />

<b>6. Confidentiality</b><br /> <br />
The Developer shall not (i) disclose to any third party the business of the Client, details regarding the Software, including any information regarding the Software’s code, the Specifications, or the Client’s business (the “Confidential Information”), (ii) make copies of any Confidential Information or any content based on the concepts contained within the Confidential Information for personal use unless requested to do so by the Client.<br /> <br />

<b>7. Developer warranties</b><br /> <br />
1.	For a period of 5 Year after the Delivery Date, the Software shall operate according to the Specifications. If the Software malfunctions or in any way does not operate according to the Specifications within that time, then the Developer shall take any reasonably necessary steps to fix the issue and ensure the Software operates according to the Specifications.<br /> <br />

<b>9. No modification unless in writing</b><br /> <br />
No modification of this Agreement shall be valid unless in writing and agreed upon by both Parties.<br /> <br />

<b>8. Applicable law</b><br /> <br />
This Software Development Agreement and the interpretation of its terms shall be governed by and construed in accordance with the laws of the State of Maharashtra and subject to the exclusive jurisdiction of the federal and courts located in India, Maharashtra, Solapur.<br /> <br />

<b>9. External Particulars.</b><br /> <br />
If client want any extra third party services to include in software like Bulk SMS, Bulk Email, Domain Name, Hosting Server, SSL Certificate, Site Lock etc. then client need to bear the price of this particulars.<br /> <br />

<b>10. Renewal Of Services </b><br /> <br />
In case of, If Project requires any periodically renewals for Third party services or developer side services, client need to do renewal payment to Developer Company before 15 days of its expiry date. If client not pay the renewal charges before expiry date of services and if services get stop or any project data lost, then the developer company will not be responsible for it.<br /> <br />

<b>IN WITNESS WHEREOF</b>, each of the Parties has executed this Software Development Agreement, both Parties by its duly authorized officer, as of the day and year set forth below.
<br /> <br /> <br /> <br />
<div style="float:left; font-weight:bold; text-align:center;">
[Client] <br /><?php echo $project_title; ?><br /><?php echo $cust_name; ?>
</div>

<div style="float:right;font-weight:bold;text-align:center;">
[Developer Company] <br />DREAM TECHNOLOGY<br />Mr. Shrikant Kadam [MD]
</div>
 <br /> <br />  <br /> <br />  <br /> <br />
<div style="text-align:center; font-weight:bold; font-weight:bold;">
Exhibit A <br />
PROJECT REQUIREMENTS/SPECIFICATION
</div>


<div style="text-align:center; font-weight:bold; font-weight:bold;">
Exhibit B<br />
Milestone schedule


</div>

</p>
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
	

</body>
</html>