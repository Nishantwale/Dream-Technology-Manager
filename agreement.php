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
	
	if(isset($_GET['insert_id']))
	{
		 $insert_id	=	$_GET['insert_id'];
		 $_SESSION['current_update_id'] = $insert_id;
	}
	  else if(isset($_SESSION['current_update_id']))
	{
		$insert_id	= $_SESSION['current_update_id'];
	}
	$details = $db->get_all_customer_info_for_agreement($insert_id);
	$counter = 0;
	if(!empty($details))
	{
		$id					=	$details[$counter][0];
		$name				=	$details[$counter][1];
		$shop_name			=	$details[$counter][2];
		$email				=	$details[$counter][3];
		$address			=	$details[$counter][4];
		$primary_contact	=	$details[$counter][5];
		$other_contact		=	$details[$counter][6];
		$logo				=	$details[$counter][7];
		
	}
	
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
				width:70%;
				min-height:1800px ! Important;
				margin:auto;
				border:1px solid black;
				font-family:cambria;
			}
			.header-contain
			{
				display:inline-table;
				float:left;
				padding:10px;
			}
			.data
			{
				margin:30px;
			}
			h3
			{
				text-align:center;
				text-transform:uppercase;
			}
			.name-data
			{
				font-weight:bold;
				font-size:17;
			}
			.para
			{
				text-indent:60px;
				line-height:22px;
			}
			.footer-data
			{
				text-transform:uppercase;
				font-weight:bold;
				margin-left:50px;
				line-height:22px;
				font-size:14;
	
			}
			.middle-data
			{
				font-size:17;
			}
			@media screen and (max-width: 680px) {
			  .mid-section {
				width:100%;
				min-height:2600px ! Important;
			  }
			}
		</style>

<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
<script src="js/wow.min.js"></script>
</head>
<body style="background-color:white;">

<div class="mid-section" style="">
			<div class="header-contain">
				<h3>Agreement</h3>
			<div style="margin-top:20px;">
				<p class="name-data">Service Provider Company :</p>
				<p class="name-data">Company Name - Dream Technology</p>
				<p class="name-data">Address - 52,Opp.Balaji Sarovar Hotel,Asra Hotgi Road, Solapur - 413003,</p>
				<p class="name-data">Phone - 0217-2603060, +91 9595775120</p>
				<p class="name-data">Email Id- dream-technology@outlook.com </p>
				<hr />
				<p class="name-data">Client Details</p>
				<p class="middle-data">Client Company - <?php echo $shop_name; ?></p>
				<p class="middle-data">Client Name - <?php echo $name; ?></p>
				<p class="middle-data">Address - <?php echo $address; ?></p>
				<p class="middle-data">Contact No - <?php echo $primary_contact; ?></p>
				<p class="middle-data">Email - <?php echo $email; ?></p>
				<hr />
				<p class="para">1.	DEVELOPER'S DUTIES.  The Client hereby engages the Developer and the Developer hereby agrees to be engaged by the Client to develop the Software in accordance with the specifications attached hereto as Exhibit A (the "Specifications").</p>
				<p class="para">a. The Developer shall complete the development of the Software according to the milestones described on the form attached hereto as Exhibit B. In accordance with such milestones, the final product shall be delivered to the Client by Estimated Date [FINAL DELIVERY DATE] (the "Delivery Date").</p>
				<p class="para">b. For a period of [TIME FRAME] after delivery of the final product, the Developer shall provide the Client attention to answer any questions or assist solving any problems with regard to the operation of the Software up to [NUMBER] of hours free of charge and billed to the Client at a rate of [RATE] per hour for any assistance thereafter. The Developer agrees to respond to any reasonable request for assistance made by the Client regarding the Software within [TIME FRAME] of the request.</p>
				<p class="para">c. Except as expressly provided in this Software Development Agreement, the Client shall not be obligated under this Agreement to provide any other support or assistance to the Developer.</p>
				<p class="para">d. The Developer shall provide to the Client after the Delivery Date, a cumulative [TIME FRAME] of training with respect to the operation of the Software if requested by the Client.</p>
				<p class="para">2.	DELIVERY.  The Software shall function in accordance with the Specifications on or before the Delivery Date.</p>
				<p class="para">a. If the Software as delivered does not conform with the Specifications, the Client shall within [TIME FRAME] of the Delivery Date notify the Developer in writing of the ways in which it does not conform with the Specifications. The Developer agrees that upon receiving such notice, it shall make reasonable efforts to correct any non-conformity.</p>
				<p class="para">b. The Client shall provide to the Developer written notice of its finding that the Software conforms to the Specifications within [TIME FRAME] days of the Delivery Date (the "Acceptance Date") unless it finds that the Software does not conform to the Specifications as described in Section 2(A) herein.</p>
				<p class="para">3.	COMPENSATION.  In consideration for the Service, the Client shall pay the Company at the rate of [RATE] per hour (the "Hourly Rate"), with a maximum total fee for all work under this Software Development Agreement of [MAXIMUM TOTAL FEE]. Fees billed under the Hourly Rate shall be due and payable upon the Developer providing the Client with an invoice.  Invoices will be provided for work completed by the developer once every [PAY PERIOD].</p>
				<p class="para">4.	INTELLECTUAL PROPERTY RIGHTS IN THE SOFTWARE. The Parties acknowledge and agree that the Client will hold all intellectual property rights in the Software including, but not limited to, copyright and trademark rights and developer will not disclose/provide software/project coding to client, Client can ask only for setup file of project. The Developer agrees not to claim any such ownership in the Software's intellectual property at any time prior to or after the completion and delivery of the Software to the Client. </p>
				<p class="para">CHANGE IN SPECIFICATIONS AFTER SUCCESSFUL DELIVERY OF PROJECT - If client want any new updates in software/project, Developer will do this updates in software/project by applying charges as per task/work.</p>
				<p class="para">CONFIDENTIALITY. The Developer shall not disclose to any third party the business of the Client, details regarding the Software, including, without limitation any information regarding the Software's code, the Specifications, or the Client's business (the "Confidential Information"), (ii) make copies of any Confidential Information or any content based on the concepts contained within the Confidential Information for personal use or for distribution unless requested to do so by the Client, or (iii) use Confidential Information other than solely for the benefit of the Client.</p>
				<p class="para">7.	DEVELOPER WARRANTIES.  The Developer represents and warrants to the Client the following:</p>
				<p class="para">a. Development and delivery of the Software under this Agreement are not in violation of any other agreement that the Developer has with another party.</p>
				<p class="para">b. The Software will not violate the intellectual property rights of any other party.</p>
				<p class="para">c. For a period of [TIME FRAME] after the Delivery Date, the Software shall operate according to the Specifications. If the Software malfunctions or in any way does not operate according to the Specifications within that time, then the Developer shall take any reasonably necessary steps to fix the issue and ensure the Software operates according to the Specifications.</p>

				<p class="para">NO MODIFICATION UNLESS IN WRITING. No modification of this Agreement shall be valid unless in writing and agreed upon by both Parties.</p>
				<p class="para">APPLICABLE LAW. This Software Development Agreement and the interpretation of its terms shall be governed by and construed in accordance with the laws of the State of [STATE] and subject to the exclusive jurisdiction of the federal and state courts located in [COUNTY], [STATE].</p>

			</div>
			</div>
		</div

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
