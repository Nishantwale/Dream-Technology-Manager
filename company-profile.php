<?php
	require_once('lib/function.php');

$db		=	new login_function();

	

?>
<html>
	<head>
		<title>Company Profile</title>
		<style>
			@media print {
			  @page { margin: 0; }
			  body { margin: 0.6cm; }
			}
			.mid-section
			{
				min-height:700px;
				width:750px;
				border:1px solid black;
				margin:auto;	
				font-family:cambria;
				margin-top:50px;
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
			
			tbody
			{
				text-align:center;
				font-size:16px;
				border:1px solid black;
				
			}
			tbody tr td
			{
				padding:7px;
			}
			thead 
			{
				text-align:center;
				font-size:16px;
				background:#DFDFDF;
			}
			thead tr th
			{
				padding:7px;
			}
			.para
			{
				
				text-indent:60px;
				line-height:22px;
			}
			.para1
			{
				font-weight:bold;
				text-align:center;
				font-size:14px;
			}
		</style>
	</head>
	<body>
		<div class="mid-section">
			<div class="header-contain">
			<!--<img src="/images/image1.png" style="">
			<div style="float:right;margin-left:150;margin-top:20px;">
				<span>Addr - 52,Opp.Balaji Sarovar Hotel,Asra</span><br />
				<span>Hotgi Road, Solapur - 413003,</span><br />
				<span>Phone - 0217-2603060, +91 9595775120</span><br />
				<span>Email : dream-technology@outlook.com </span><br />
				<span>Website : www.dream-technology.in</span>
			</div>
			<hr />-->
			<div class="data">
			
			<h3>Company Profile</h3>
			<p class="para">"Dream Technology" is the leader company in solapur city, for any type of software services. Company is established in year 2015 with intelligent, expert and experienced developers. We have worked on many Website applications, Android applications and Windows/Desktop applications. Our main goal is to make our every client satisfied with our best and quality work. We at Dream Technology treat every contract as a relationship and put in a little extra efforts to nurture it to provide our clients something which they haven't asked.. something which makes them happy. Our team is committed to provide IT Services with - Quality, Technology, Innovation and Support. We always focus on quality work and client satisfaction.</p>
				<b>Our Services :</b>
				<ul type="circle" style="line-height:20px;">
				<li> Website Application Development</li>
				<li> Desktop Software Development</li>
				<li> Android Application Development</li>
				<li> E-Commerce Solutions</li>
				<li> Enterprise CMS Development</li>
				<li> Graphic & Multimedia Solutions</li>
				<li> Bulk SMS & Email Provider</li>
				<li> Software Installations</li>
				<li> Online Backup System Provider</li>
				<li> Maintenance & Support For Websites, Android Applications and Windows Applications</li>
				<li> Search Engine Optimization</li>
				</ul>
				</p>
				We have listed some products below which are powered by us <br/><br/>
						<div class="panel-body">
                            <table width="100%" border=1 style="border-collapse:collapse">
                                <thead>
                                    <tr>
										<th>Sr.No</th>
										<th>Services </th>
										<th>Project Name</th>
										

                                    </tr>
                                </thead>
                                <tbody>
								<?php
								
											
									$report_details = $db->get_all_service_information_for_display();
									if(!empty($report_details))
									{
										$counter =0;
										foreach($report_details as $record)
										{
											$id				=	$report_details[$counter][0];
											$name			=	$report_details[$counter][1];
											$services		=	$report_details[$counter][2];
											$p_name			=	$report_details[$counter][3];
											$amount			=	$report_details[$counter][4];
											$status			=	$report_details[$counter][5];
											
											$cust_name = $db->fetch_cust_name($name);
											$service = $db->fetch_service_name_by_id($services);
								?>
                                    <tr>
										 <td><?php echo $counter+1; ?></td>
										
										
                                        <td style="text-align:left;"><?php echo $service; ?></td>
										<td style="text-align:left;"><?php echo $p_name; ?></td>
                                      
									
									<?php
										
										$counter++;
										}
										?>
										
									<?php
									}else
									{
									?>
										<td colspan="3"> No Data Found....</td>
                                    <?php
									}
									
									?>
                                   </tbody>
                            </table>
			
			</div><br /><br />
			<p class="para1"><i>"Like to make client satisfied with our best output and quality service."</i></p>
				
		</div>
	

	</body>
</html>