<?php
	session_start();
	date_default_timezone_set('Asia/Kolkata');
	
		class login_function
		{
			private $con;
			
			function __construct()
			{
				$this->con = new mysqli("localhost","dreamte2_dtmanag","**77**8878spassss","dreamte2_dtmanager");
			}
			
			function get_password_from_user_name($email)
			{
				if($stmt_select = $this->con->prepare("Select `password` from `admin` where `admin_name` = ? "))
				{	
					$stmt_select->bind_param("s",$email);
				
					$stmt_select->bind_result($result_password);
				
					if($stmt_select->execute())
					{
						if($stmt_select->fetch())
						{
							return $result_password;
						}
					}
							return false;
				}
			}
			function new_customer($name,$shop_name,$c_email,$address,$primary_contact,$other_contact,$logo,$password)
			{							
				$date = date("Y-m-d");
				$time = date("H-i-s A");
				if($stmt_insert = $this->con->prepare("INSERT INTO `customers`(`name`, `office_name`,`email`, `address`, `primary_contact_no`,`other_contact_no` ,`logo`, `password`, `date`, `time`) VALUES (?,?,?,?,?,?,?,?,?,?)"))
				{
					$stmt_insert->bind_param("ssssssssss",$name,$shop_name,$c_email,$address,$primary_contact,$other_contact,$logo,$password,$date,$time);
					
					if($stmt_insert->execute())
					{
						return true;
					}
						return false;
				} 	
			}
			function get_all_user_information()
			{	
				if($stmt_insert = $this->con->prepare("SELECT `id`,`name`, `office_name`,`email`, `address`, `primary_contact_no`, `other_contact_no`,`logo`,`password` FROM `customers`"))
				{	
					$stmt_insert->bind_result($id,$name,$office_name,$email,$address,$primary_contact_no,$other_contact_no,$logo,$password);
					
					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$name;
							$details[$counter][2]	=	$office_name;
							$details[$counter][3]	=	$email;
							$details[$counter][4]	=	$address;
							$details[$counter][5]	=	$primary_contact_no;
							$details[$counter][6]	=	$other_contact_no;
							$details[$counter][7]	=	$logo;
							$details[$counter][8]	=	$password;
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			function get_all_product_info($id)
			{	
				if($stmt_insert = $this->con->prepare("SELECT `id`,`name`, `office_name`,`email`, `address`, `primary_contact_no`, `other_contact_no`,`logo`,`password` FROM `customers` where `id` = ?"))
				{	
					$stmt_insert->bind_param("i",$id);
					
					$stmt_insert->bind_result($id,$name,$shop_name,$email,$address,$primary_contact,$other_contact,$logo,$password);

					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$name;
							$details[$counter][2]	=	$shop_name;
							$details[$counter][3]	=	$email;
							$details[$counter][4]	=	$address;
							$details[$counter][5]	=	$primary_contact;
							$details[$counter][6]	=	$other_contact;
							$details[$counter][7]	=	$logo;
							$details[$counter][8]	=	$password;
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			function update_product_information($up_id,$name,$shop_name,$email,$address,$primary_contact,$other_contact,$password)
			{
				$date = date("Y-m-d");
				$time = date("H:i:s A");
						
				if($stmt_select = $this->con->prepare("update `customers` set `name`= ?,`office_name`= ?,`email`=?,`address`= ?,`primary_contact_no`= ? ,`other_contact_no` = ?,`password` = ? where `id` = ?"))
				{
					$stmt_select->bind_param("sssssssi",$name,$shop_name,$email,$address,$primary_contact,$other_contact,$password,$up_id);				
							
					if($stmt_select->execute())
					{					
						return true;
					}
						return false;
				}
				
			}
			function delete_user_info($del_id)
			{
				if($stmt_select = $this->con->prepare("Delete from `customers` where `id`=?"))
				{
					$stmt_select->bind_param("i",$del_id);
				
					if($stmt_select->execute())
					{					
							return true;
					}
						return false;
				}
			}
			function only_customers()
			{
				if($stmt_insert = $this->con->prepare("SELECT `id`, `name` FROM `customers`"))
				{
					$stmt_insert->bind_result($id,$name);
				
					if($stmt_insert->execute())
					{
						$counter	=	0;
						$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$name;
							$counter++;
						}
					if(!empty($details))	
					{
						return $details;
					}
					return false;
					}	
				}
		
			}
			function new_services($customer_name,$service,$p_name,$amount,$status)
			{							
				$date = date("Y-m-d");
				$time = date("H-i-s A");
				if($stmt_insert = $this->con->prepare("INSERT INTO `customer_services`(`customer_name`, `service`, `project_name`, `amount` ,`status`, `date`, `time`) VALUES (?,?,?,?,?,?,?)"))
				{
					$stmt_insert->bind_param("sssssss",$customer_name,$service,$p_name,$amount,$status,$date,$time);
					
					if($stmt_insert->execute())
					{
						return true;
					}
						return false;
				} 	
			}
			function get_all_service_information()
			{	
				if($stmt_insert = $this->con->prepare("SELECT `id`,`customer_name`, `service`, `project_name`,`amount`,`status` FROM `customer_services`"))
				{	
					$stmt_insert->bind_result($id,$customer_name,$service,$p_name,$amount,$status);
					
					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$customer_name;
							$details[$counter][2]	=	$service;
							$details[$counter][3]	=	$p_name;
							$details[$counter][4]	=	$amount;
							$details[$counter][5]	=	$status;
					
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			function delete_service_info($del_id)
			{
				if($stmt_select = $this->con->prepare("Delete from `customer_services` where `id`=?"))
				{
					$stmt_select->bind_param("i",$del_id);
				
					if($stmt_select->execute())
					{					
							return true;
					}
						return false;
				}
			}
			function get_all_service_info($id)
			{	
				if($stmt_insert = $this->con->prepare("SELECT `id`,`customer_name`, `service`, `project_name`,`amount` FROM `customer_services` where `id` = ?"))
				{	
					$stmt_insert->bind_param("i",$id);
					
					$stmt_insert->bind_result($id,$customer_name,$service,$p_name,$amount);

					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$customer_name;
							$details[$counter][2]	=	$service;
							$details[$counter][3]	=	$p_name;
							$details[$counter][4]	=	$amount;
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			function update_service_information($up_id,$customer_name,$service,$p_name,$amount)
			{
				$date = date("Y-m-d");
				$time = date("H:i:s A");
						
				if($stmt_select = $this->con->prepare("update `customer_services` set `customer_name`= ?,`service`= ?,`project_name` = ?,`amount`= ? where `id` = ?"))
				{
					$stmt_select->bind_param("ssssi",$customer_name,$service,$p_name,$amount,$up_id);				
							
					if($stmt_select->execute())
					{					
						return true;
					}
						return false;
				}
				
			}
			function add_services($service)
			{							
				$date = date("Y-m-d");
				$time = date("H-i-s A");
				if($stmt_insert = $this->con->prepare("INSERT INTO `services`(`services`) VALUES (?)"))
				{
					$stmt_insert->bind_param("s",$service);
					
					if($stmt_insert->execute())
					{
						return true;
					}
						return false;
				} 	
			}
			function only_services()
			{
				if($stmt_insert = $this->con->prepare("SELECT `id`,`services` FROM `services`"))
				{
					$stmt_insert->bind_result($id,$name);
				
					if($stmt_insert->execute())
					{
						$counter	=	0;
						$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$name;
							$counter++;
						}
					if(!empty($details))	
					{
						return $details;
					}
					return false;
					}	
				}
		
			}
			function get_all_service()
			{	
				if($stmt_insert = $this->con->prepare("SELECT `id`,`services` FROM `services`"))
				{	
					$stmt_insert->bind_result($id,$service);
					
					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$service;
							
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			function services($id)
			{	
				if($stmt_insert = $this->con->prepare("SELECT `id`,`services` FROM `services` where `id` = ?"))
				{	
					$stmt_insert->bind_param("i",$id);
					
					$stmt_insert->bind_result($id,$service);

					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$service;
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			function updates_services($up_id,$service)
			{
				$date = date("Y-m-d");
				$time = date("H:i:s A");
						
				if($stmt_select = $this->con->prepare("update `services` set `services`= ? where `id` = ?"))
				{
					$stmt_select->bind_param("si",$service,$up_id);				
							
					if($stmt_select->execute())
					{					
						return true;
					}
						return false;
				}
				
			}
			function delete_services($del_id)
			{
				if($stmt_select = $this->con->prepare("Delete from `services` where `id`=?"))
				{
					$stmt_select->bind_param("i",$del_id);
				
					if($stmt_select->execute())
					{					
							return true;
					}
						return false;
				}
			}
			function fetch_amount($id)
			{	
				if($stmt_insert = $this->con->prepare("SELECT `id`,`customer_name`,`service`,`amount` FROM `customer_services` where `customer_name` = ?"))
				{	
					$stmt_insert->bind_param("s",$id);
					
					$stmt_insert->bind_result($id,$customer_name,$service,$amount);

					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$customer_name;
							$details[$counter][2]	=	$service;
							$details[$counter][3]	=	$amount;
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			function fetch_service_name($service)
			{
				if($stmt_select = $this->con->prepare("Select `services` from `services` where `id` = ? "))
				{	
					$stmt_select->bind_param("i",$service);
				
					$stmt_select->bind_result($result_service);
				
					if($stmt_select->execute())
					{
						if($stmt_select->fetch())
						{
							return $result_service;
						}
					}
							return false;
				}
			}
			function add_payment_info($service_no,$cust_id,$customer_name,$service,$service_name,$p_name,$amount,$sms,$email,$status)
			{							
				$date = date("Y-m-d");
				$time = date("H-i-s A");
				if($stmt_insert = $this->con->prepare("INSERT INTO `payment_report`(`services_id`,`cust_id`,`cust_name`, `service_no`, `service_name`,`project_name`,`paid_amount` ,`sms`,`email`, `status`, `date`, `time`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)"))
				{
					$stmt_insert->bind_param("ssssssssssss",$service_no,$cust_id,$customer_name,$service,$service_name,$p_name,$amount,$sms,$email,$status,$date,$time);
					
					if($stmt_insert->execute())
					{
						return true;
					}
						return false;
				} 	
			}
			function get_all_payment_information($c_name,$date_to,$date_from,$service)
			{	
				if($service=="select")
				{
					$service ="";
				}
			
				if($stmt_insert = $this->con->prepare("SELECT `id`, `services_id`, `cust_id`, `cust_name`, `service_no`, `service_name`,`project_name`, `opening_amount`, `paid_amount`, `bal_amount`,`status`, `date`, `time` FROM `payment_report` WHERE `cust_name` LIKE '%$c_name%' AND `date` BETWEEN '$date_from' AND '$date_to' AND `service_name` LIKE '%$service%'"))
				{	
					$stmt_insert->bind_result($id,$services_id,$cust_id,$cust_name,$service_no,$service_name,$p_name,$opening_amount,$paid_amount,$bal_amount,$status,$date,$time);
					
					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$services_id;
							$details[$counter][2]	=	$cust_id;
							$details[$counter][3]	=	$cust_name;
							$details[$counter][4]	=	$service_no;
							$details[$counter][5]	=	$service_name;
							$details[$counter][6]	=	$p_name;
							$details[$counter][7]	=	$opening_amount;
							$details[$counter][8]	=	$paid_amount;
							$details[$counter][9]	=	$bal_amount;
							$details[$counter][10]	=	$status;
							$details[$counter][11]	=	$date;
							$details[$counter][12]	=	$time;
						
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			function delete_payment_info($del_id)
			{
				if($stmt_select = $this->con->prepare("Delete from `payment_report` where `id`=?"))
				{
					$stmt_select->bind_param("i",$del_id);
				
					if($stmt_select->execute())
					{					
							return true;
					}
						return false;
				}
			}
			function fetch_cust_name($customer_name)
			{
				if($stmt_select = $this->con->prepare("Select `name` from `customers` where `id` = ? "))
				{	
					$stmt_select->bind_param("i",$customer_name);
				
					$stmt_select->bind_result($result_service);
					
					if($stmt_select->execute())
					{
						if($stmt_select->fetch())
						{
							 return $result_service;
						}
					}
							return false;
				}
			}
			function fetch_cust_id($customer_name)
			{
				if($stmt_select = $this->con->prepare("Select `id` from `customers` where `name` = ? "))
				{	
					$stmt_select->bind_param("s",$customer_name);
				
					$stmt_select->bind_result($result_service);
					
					if($stmt_select->execute())
					{
						if($stmt_select->fetch())
						{
							 return $result_service;
						}
					}
							return false;
				}
			}
			function fetch_service_name_by_id($service_id)
			{
				if($stmt_select = $this->con->prepare("Select `services` from `services` where `id` = ? "))
				{	
					$stmt_select->bind_param("s",$service_id);
				
					$stmt_select->bind_result($result_service);
					
					if($stmt_select->execute())
					{
						if($stmt_select->fetch())
						{
							 return $result_service;
						}
					}
							return false;
				}
			}
			function fetch_service_no_by_cust_id($cust_id,$service)
			{
				if($stmt_select = $this->con->prepare("Select `id` from `customer_services` where `customer_name` = ? AND `service` = ?"))
				{	
					$stmt_select->bind_param("ss",$cust_id,$service);
				
					$stmt_select->bind_result($result_id);
					
					if($stmt_select->execute())
					{
						if($stmt_select->fetch())
						{
							 return $result_id;
						}
					}
							return false;
				}
			}
			function add_expenses($expenses,$amount)
			{							
				$date = date("Y-m-d");
				$time = date("H-i-s A");
				if($stmt_insert = $this->con->prepare("INSERT INTO `expenses_mgt`(`expenses`,`amount`,`date`,`time`) VALUES (?,?,?,?)"))
				{
					$stmt_insert->bind_param("ssss",$expenses,$amount,$date,$time);
					
					if($stmt_insert->execute())
					{
						return true;
					}
						return false;
				} 	
			}
			function get_all_expenses($title,$date_from,$date_to)
			{	
				
				if($stmt_insert = $this->con->prepare("SELECT `id`,`expenses`,`amount`,`date` FROM `expenses_mgt` Where `expenses` LIKE '%$title%' AND `date` BETWEEN '$date_from' AND '$date_to'"))
				{	
					$stmt_insert->bind_result($id,$expenses,$amount,$date);
					
					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$expenses;
							$details[$counter][2]	=	$amount;
							$details[$counter][3]	=	$date;
							
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			function delete_expenses($del_id)
			{
				if($stmt_select = $this->con->prepare("Delete from `expenses_mgt` where `id`=?"))
				{
					$stmt_select->bind_param("i",$del_id);
				
					if($stmt_select->execute())
					{					
							return true;
					}
						return false;
				}
			}
			function fetch_exepense_data($id)
			{	
				if($stmt_insert = $this->con->prepare("SELECT `id`,`expenses`,`amount`,`date` FROM `expenses_mgt` where `id` = ?"))
				{	
					$stmt_insert->bind_param("i",$id);
					
					$stmt_insert->bind_result($id,$expenses,$amount,$date);

					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$expenses;
							$details[$counter][2]	=	$amount;
							$details[$counter][3]	=	$date;
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			function update_expenses($up_id,$title,$amount)
			{
				$date = date("Y-m-d");
				$time = date("H:i:s A");
						
				if($stmt_select = $this->con->prepare("update `expenses_mgt` set `expenses`= ?,`amount`= ? where `id` = ?"))
				{
					$stmt_select->bind_param("ssi",$title,$amount,$up_id);				
							
					if($stmt_select->execute())
					{					
						return true;
					}
						return false;
				}
				
			}
			function fetch_services($c_id)
			{
				if($stmt_insert = $this->con->prepare("SELECT `id`, `service` FROM `customer_services` Where `customer_name` =?"))
				{
					$stmt_insert->bind_param("s",$c_id);
				
					$stmt_insert->bind_result($id,$services);
				
					if($stmt_insert->execute())
					{
						$counter	=	0;
						$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$services;
							$counter++;
						}
					if(!empty($details))	
					{
						return $details;
					}
					return false;
					}	
				}
		
			}
			function add_to_the_invoice($c_id,$service,$actual_amount,$discount_amount)
			{						
			    $invoice_note   =    "";
			    $other_details  =   "";
				$date = date("Y-m-d");
				$time = date("H-i-s A");
				if($stmt_insert = $this->con->prepare("INSERT INTO `tmp_invoice`(`customer_id`, `service`, `actual_amount`, `discount_amount`,`invoice_note`,`other_details`) VALUES (?,?,?,?,?,?)"))
				{
					$stmt_insert->bind_param("ssssss",$c_id,$service,$actual_amount,$discount_amount,$invoice_note,$other_details);
					
					if($stmt_insert->execute())
					{
						return true;
					}
						return false;
				} 	
			}
			function change_user_password($email,$password)
			{ 
				$date = date("Y-m-d");
				$time = date("H:i:s A");
			
				if($stmt_select = $this->con->prepare("update `admin` set `password`='".$password."' where `admin_name` = ?"))
				{
					$stmt_select->bind_param("s",$email);				
				
					if($stmt_select->execute())
					{					
						return true;
					}
						return false;
				}
			}
			function get_temp_invoice_info()
			{	
				if($stmt_insert = $this->con->prepare("SELECT `id`,`customer_id`,`service`,`actual_amount`,`discount_amount` FROM `tmp_invoice`"))
				{	
					$stmt_insert->bind_result($id,$c_id,$service,$actual_amount,$discount_amount);
					
					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$c_id;
							$details[$counter][2]	=	$service;
							$details[$counter][3]	=	$actual_amount;
							$details[$counter][4]	=	$discount_amount;
							
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			function delete_invoice($del_id)
			{
				if($stmt_select = $this->con->prepare("Delete from `tmp_invoice` where `id`=?"))
				{
					$stmt_select->bind_param("i",$del_id);
				
					if($stmt_select->execute())
					{					
							return true;
					}
						return false;
				}
			}
			function new_employee($full_name,$email,$primary_contact,$address,$gender,$dob,$city,$state,$country,$pincode,$aadhar_no,$photo,$addhar_attachment,$attachment1,$attachment2,$attachment3,$designation,$joining_date,$technology,$salary,$remark,$location)
			{							
				$date = date("Y-m-d");
				$time = date("H-i-s A");
				if($stmt_insert = $this->con->prepare("INSERT INTO `employees`(`full_name`, `email`, `contact`, `address`, `gender`, `dob`, `city`, `state`, `country`, `pincode`, `aadhar_no`, `id_size_photo`, `aadhar_attachment`, `attachment1`, `attachment2`, `attachment3`, `designation`, `joining_date`, `working_technology`, `salary`, `remark`,`job_location`, `date`, `time`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)"))
				{
					$stmt_insert->bind_param("ssssssssssssssssssssssss",$full_name,$email,$primary_contact,$address,$gender,$dob,$city,$state,$country,$pincode,$aadhar_no,$photo,$addhar_attachment,$attachment1,$attachment2,$attachment3,$designation,$joining_date,$technology,$salary,$remark,$location,$date,$time);
					
					if($stmt_insert->execute())
					{
						return true;
					}
						return false;
				} 	
			}
			function get_all_employee_information($name,$emp_id)
			{	
				if($stmt_insert = $this->con->prepare("SELECT `id`,`full_name`, `email`, `contact`, `address`, `gender`, `dob`, `city`, `state`, `country`, `pincode`, `aadhar_no`, `id_size_photo`, `aadhar_attachment`, `attachment1`, `attachment2`, `attachment3`, `designation`, `joining_date`, `working_technology`, `salary`, `remark`,`job_location` FROM `employees` WHERE `full_name` LIKE '%$name%' AND `id` LIKE '%$emp_id%'"))
				{	
					$stmt_insert->bind_result($id,$full_name,$email,$primary_contact,$address,$gender,$dob,$city,$state,$country,$pincode,$aadhar_no,$photo,$addhar_attachment,$attachment1,$attachment2,$attachment3,$designation,$joining_date,$technology,$salary,$remark,$location);
					
					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$full_name;
							$details[$counter][2]	=	$email;
							$details[$counter][3]	=	$primary_contact;
							$details[$counter][4]	=	$address;
							$details[$counter][5]	=	$gender;
							$details[$counter][6]	=	$dob;
							$details[$counter][7]	=	$city;
							$details[$counter][8]	=	$state;
							$details[$counter][9]	=	$country;
							$details[$counter][10]	=	$pincode;
							$details[$counter][11]	=	$aadhar_no;
							$details[$counter][12]	=	$photo;
							$details[$counter][13]	=	$addhar_attachment;
							$details[$counter][14]	=	$attachment1;
							$details[$counter][15]	=	$attachment2;
							$details[$counter][16]	=	$attachment3;
							$details[$counter][17]	=	$designation;
							$details[$counter][18]	=	$joining_date;
							$details[$counter][19]	=	$technology;
							$details[$counter][20]	=	$salary;
							$details[$counter][21]	=	$remark;
							$details[$counter][22]	=	$location;
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			function delete_employee_info($del_id)
			{
				if($stmt_select = $this->con->prepare("Delete from `employees` where `id`=?"))
				{
					$stmt_select->bind_param("i",$del_id);
				
					if($stmt_select->execute())
					{					
							return true;
					}
						return false;
				}
			}
			function get_all_employee_information_by_id($up_id)
			{	
				if($stmt_insert = $this->con->prepare("SELECT `id`,`full_name`, `email`, `contact`, `address`, `gender`, `dob`, `city`, `state`, `country`, `pincode`, `aadhar_no`, `id_size_photo`, `aadhar_attachment`, `attachment1`, `attachment2`, `attachment3`, `designation`, `joining_date`, `working_technology`, `salary`, `remark`,`job_location` FROM `employees` WHERE `id` = ?"))
				{	
					$stmt_insert->bind_param("i",$up_id);
					
					$stmt_insert->bind_result($id,$full_name,$email,$primary_contact,$address,$gender,$dob,$city,$state,$country,$pincode,$aadhar_no,$photo,$addhar_attachment,$attachment1,$attachment2,$attachment3,$designation,$joining_date,$technology,$salary,$remark,$location);
					
					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$full_name;
							$details[$counter][2]	=	$email;
							$details[$counter][3]	=	$primary_contact;
							$details[$counter][4]	=	$address;
							$details[$counter][5]	=	$gender;
							$details[$counter][6]	=	$dob;
							$details[$counter][7]	=	$city;
							$details[$counter][8]	=	$state;
							$details[$counter][9]	=	$country;
							$details[$counter][10]	=	$pincode;
							$details[$counter][11]	=	$aadhar_no;
							$details[$counter][12]	=	$photo;
							$details[$counter][13]	=	$addhar_attachment;
							$details[$counter][14]	=	$attachment1;
							$details[$counter][15]	=	$attachment2;
							$details[$counter][16]	=	$attachment3;
							$details[$counter][17]	=	$designation;
							$details[$counter][18]	=	$joining_date;
							$details[$counter][19]	=	$technology;
							$details[$counter][20]	=	$salary;
							$details[$counter][21]	=	$remark;
							$details[$counter][22]	=	$location;
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			function update_employee($up_id,$full_name,$email,$primary_contact,$address,$gender,$dob,$city,$state,$country,$pincode,$aadhar_no,$designation,$joining_date,$technology,$salary,$remark,$location)
			{							
				$date = date("Y-m-d");
				$time = date("H-i-s A");
				if($stmt_insert = $this->con->prepare("Update `employees` set `full_name` = ?, `email` = ?, `contact` = ?, `address` = ?, `gender` = ?, `dob` = ?, `city` = ?, `state` = ?, `country` = ?, `pincode` = ?, `aadhar_no` = ? ,`designation` = ?, `joining_date` = ?, `working_technology` = ?, `salary` = ?, `remark` = ?, `job_location` = ? Where `id` = ?"))
				{
					$stmt_insert->bind_param("sssssssssssssssssi",$full_name,$email,$primary_contact,$address,$gender,$dob,$city,$state,$country,$pincode,$aadhar_no,$designation,$joining_date,$technology,$salary,$remark,$location,$up_id);
					
					if($stmt_insert->execute())
					{
						return true;
					}
						return false;
				} 	
			}
			
			function update_note_for_invoice($note_notice,$update_id)
			{							
			    echo $note_notice,$update_id;
				$date = date("Y-m-d");
				$time = date("H-i-s A");
				$other_details  =   "";
				if($stmt_insert = $this->con->prepare("UPDATE `invoice` SET `invoice_note`=?,`other_details`=? WHERE `id`=?"))
				{
					$stmt_insert->bind_param("ssi",$note_notice,$other_details,$update_id);
					
					if($stmt_insert->execute())
					{
						return true;
					}
						return false;
				} 	
			}
			
			function update_id_photo($up_id)
			{							
				$id_size_photo = "";
				
				if($stmt_insert = $this->con->prepare("Update `employees` set `id_size_photo` = ? Where `id` =?"))
				{
					$stmt_insert->bind_param("si",$id_size_photo,$up_id);
					
					if($stmt_insert->execute())
					{
						return true;
					}
						return false;
				} 	
			}
			function get_id_photo_name_by_id($id)
			{
				if($stmt_select = $this->con->prepare("Select `id_size_photo` from `employees` where `id` = ? "))
				{	
					$stmt_select->bind_param("i",$id);
				
					$stmt_select->bind_result($result_password);
				
					if($stmt_select->execute())
					{
						if($stmt_select->fetch())
						{
							return $result_password;
						}
					}
							return false;
				}
			}
			function update_id_size_photo_by_id($up_id,$id_size_photo)
			{									
				if($stmt_insert = $this->con->prepare("Update `employees` set `id_size_photo` = ? Where `id` =?"))
				{
					$stmt_insert->bind_param("si",$id_size_photo,$up_id);
					
					if($stmt_insert->execute())
					{
						return true;
					}
						return false;
				} 	
			}
			function update_aadhar_photo($up_id)
			{							
				$id_size_photo = "";
				
				if($stmt_insert = $this->con->prepare("Update `employees` set `aadhar_attachment` = ? Where `id` =?"))
				{
					$stmt_insert->bind_param("si",$id_size_photo,$up_id);
					
					if($stmt_insert->execute())
					{
						return true;
					}
						return false;
				} 	
			}
			function get_aadhar_photo_name_by_id($id)
			{
				if($stmt_select = $this->con->prepare("Select `aadhar_attachment` from `employees` where `id` = ? "))
				{	
					$stmt_select->bind_param("i",$id);
				
					$stmt_select->bind_result($result_password);
				
					if($stmt_select->execute())
					{
						if($stmt_select->fetch())
						{
							return $result_password;
						}
					}
							return false;
				}
			}
			function update_aadhar_photo_by_id($up_id,$id_size_photo)
			{									
				if($stmt_insert = $this->con->prepare("Update `employees` set `aadhar_attachment` = ? Where `id` =?"))
				{
					$stmt_insert->bind_param("si",$id_size_photo,$up_id);
					
					if($stmt_insert->execute())
					{
						return true;
					}
						return false;
				} 	
			}
			function update_attachment1_photo($up_id)
			{							
				$id_size_photo = "";
				
				if($stmt_insert = $this->con->prepare("Update `employees` set `attachment1` = ? Where `id` =?"))
				{
					$stmt_insert->bind_param("si",$id_size_photo,$up_id);
					
					if($stmt_insert->execute())
					{
						return true;
					}
						return false;
				} 	
			}
			function get_attachment1_photo_name_by_id($id)
			{
				if($stmt_select = $this->con->prepare("Select `attachment1` from `employees` where `id` = ? "))
				{	
					$stmt_select->bind_param("i",$id);
				
					$stmt_select->bind_result($result_password);
				
					if($stmt_select->execute())
					{
						if($stmt_select->fetch())
						{
							return $result_password;
						}
					}
							return false;
				}
			}
			function update_attachment1_photo_by_id($up_id,$id_size_photo)
			{									
				if($stmt_insert = $this->con->prepare("Update `employees` set `attachment1` = ? Where `id` =?"))
				{
					$stmt_insert->bind_param("si",$id_size_photo,$up_id);
					
					if($stmt_insert->execute())
					{
						return true;
					}
						return false;
				} 	
			}
			function update_attachment2_photo($up_id)
			{							
				$id_size_photo = "";
				
				if($stmt_insert = $this->con->prepare("Update `employees` set `attachment2` = ? Where `id` =?"))
				{
					$stmt_insert->bind_param("si",$id_size_photo,$up_id);
					
					if($stmt_insert->execute())
					{
						return true;
					}
						return false;
				} 	
			}
			function get_attachment2_photo_name_by_id($id)
			{
				if($stmt_select = $this->con->prepare("Select `attachment2` from `employees` where `id` = ? "))
				{	
					$stmt_select->bind_param("i",$id);
				
					$stmt_select->bind_result($result_password);
				
					if($stmt_select->execute())
					{
						if($stmt_select->fetch())
						{
							return $result_password;
						}
					}
							return false;
				}
			}
			function update_attachment2_photo_by_id($up_id,$id_size_photo)
			{									
				if($stmt_insert = $this->con->prepare("Update `employees` set `attachment2` = ? Where `id` =?"))
				{
					$stmt_insert->bind_param("si",$id_size_photo,$up_id);
					
					if($stmt_insert->execute())
					{
						return true;
					}
						return false;
				} 	
			}
			function update_attachment3_photo($up_id)
			{							
				$id_size_photo = "";
				
				if($stmt_insert = $this->con->prepare("Update `employees` set `attachment3` = ? Where `id` =?"))
				{
					$stmt_insert->bind_param("si",$id_size_photo,$up_id);
					
					if($stmt_insert->execute())
					{
						return true;
					}
						return false;
				} 	
			}
			function get_attachment3_photo_name_by_id($id)
			{
				if($stmt_select = $this->con->prepare("Select `attachment3` from `employees` where `id` = ? "))
				{	
					$stmt_select->bind_param("i",$id);
				
					$stmt_select->bind_result($result_password);
				
					if($stmt_select->execute())
					{
						if($stmt_select->fetch())
						{
							return $result_password;
						}
					}
							return false;
				}
			}
			function update_attachment3_photo_by_id($up_id,$id_size_photo)
			{									
				if($stmt_insert = $this->con->prepare("Update `employees` set `attachment3` = ? Where `id` =?"))
				{
					$stmt_insert->bind_param("si",$id_size_photo,$up_id);
					
					if($stmt_insert->execute())
					{
						return true;
					}
						return false;
				} 	
			}
			function get_employee_name()
			{
				if($stmt_select = $this->con->prepare("Select `id`, `full_name` from `employees` "))
				{	
					$stmt_select->bind_result($id,$full_name);
				
					if($stmt_select->execute())
					{		
						$data = array();
						$counter = 0;
						while($stmt_select->fetch())
						{
							$data[$counter][0] 	=	$id;
							$data[$counter][1] 	=	$full_name;
							$counter ++;
						}if(!empty($data))
						{
							return $data;
						}
					}
							return false;
				}
			}
			function fetch_designation_by_id($id)
			{
				if($stmt_select = $this->con->prepare("Select `designation` from `employees` where `id` = ? "))
				{	
					$stmt_select->bind_param("i",$id);
				
					$stmt_select->bind_result($result_password);
				
					if($stmt_select->execute())
					{
						if($stmt_select->fetch())
						{
							return $result_password;
						}
					}
							return false;
				}
			}
			function fetch_name_by_id($id)
			{
				if($stmt_select = $this->con->prepare("Select `full_name` from `employees` where `id` = ? "))
				{	
					$stmt_select->bind_param("i",$id);
				
					$stmt_select->bind_result($result_password);
				
					if($stmt_select->execute())
					{
						if($stmt_select->fetch())
						{
							return $result_password;
						}
					}
							return false;
				}
			}
			function new_experience_letter_data($full_name,$fetch_name,$exp_date,$duration_from,$duration_to,$text1,$text2,$photo)
			{							
				$date = date("Y-m-d");
				$time = date("H-i-s A");
				if($stmt_insert = $this->con->prepare("INSERT INTO `experience_certificate`(`emp_id`,`emp_name`, `date_of_letter`, `duration_from`, `duration_to`, `text1`, `text2`, `letter_attachment`, `date`, `time`) VALUES (?,?,?,?,?,?,?,?,?,?)"))
				{
					$stmt_insert->bind_param("ssssssssss",$full_name,$fetch_name,$exp_date,$duration_from,$duration_to,$text1,$text2,$photo,$date,$time);
					
					if($stmt_insert->execute())
					{
						return $stmt_insert->insert_id;
					}
						return false;
				} 	
			}
			function fetch_data_by_id($up_id)
			{	
				if($stmt_insert = $this->con->prepare("SELECT `id`,`emp_id`,`emp_name`, `date_of_letter`, `duration_from`, `duration_to`, `text1`, `text2` FROM `experience_certificate` WHERE `id` = ?"))
				{	
					$stmt_insert->bind_param("i",$up_id);
					
					$stmt_insert->bind_result($id,$emp_id,$emp_name,$date_of_letter,$duration_from,$duration_to,$text1,$text2);
					
					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$emp_id;
							$details[$counter][2]	=	$emp_name;
							$details[$counter][3]	=	$date_of_letter;
							$details[$counter][4]	=	$duration_from;
							$details[$counter][5]	=	$duration_to;
							$details[$counter][6]	=	$text1;
							$details[$counter][7]	=	$text2;
							
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			function fetch_cerificate_data($emp_id,$emp_name)
			{	
				if($stmt_insert = $this->con->prepare("SELECT `id`,`emp_id`, `date_of_letter`, `duration_from`, `duration_to`, `text1`, `text2` FROM `experience_certificate` Where `emp_id` LIKE '%$emp_id%' AND `emp_name` LIKE '%$emp_name%'"))
				{	
					$stmt_insert->bind_result($id,$emp_name,$date_of_letter,$duration_from,$duration_to,$text1,$text2);
					
					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$emp_name;
							$details[$counter][2]	=	$date_of_letter;
							$details[$counter][3]	=	$duration_from;
							$details[$counter][4]	=	$duration_to;
							$details[$counter][5]	=	$text1;
							$details[$counter][6]	=	$text2;
							
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			function fetch_name_by_id_for_display($id)
			{
				if($stmt_select = $this->con->prepare("Select `full_name` from `employees` where `id` = ? "))
				{	
					$stmt_select->bind_param("i",$id);
				
					$stmt_select->bind_result($result_password);
				
					if($stmt_select->execute())
					{
						if($stmt_select->fetch())
						{
							return $result_password;
						}
					}
							return false;
				}
			}
			function delete_experience_data($del_id)
			{
				if($stmt_select = $this->con->prepare("Delete from `experience_certificate` where `id`=?"))
				{
					$stmt_select->bind_param("i",$del_id);
				
					if($stmt_select->execute())
					{					
							return true;
					}
						return false;
				}
			}
			function update_experience_letter_data($up_id,$full_name,$exp_date,$duration_from,$duration_to,$text1,$text2)
			{	
				if($stmt_insert = $this->con->prepare("Update `experience_certificate` set `emp_name` = ?, `date_of_letter` = ?, `duration_from` = ?, `duration_to` = ?, `text1` = ?, `text2` = ? Where `id` = ?"))
				{
					$stmt_insert->bind_param("ssssssi",$full_name,$exp_date,$duration_from,$duration_to,$text1,$text2,$up_id);
					
					if($stmt_insert->execute())
					{
						return $stmt_insert->insert_id;
					}
						return false;
				} 	
			}
			function fetch_data_by_id_for_display($up_id)
			{	
				if($stmt_insert = $this->con->prepare("SELECT `id`,`emp_id`,`emp_name`, `date_of_letter`, `duration_from`, `duration_to`, `text1`, `text2` ,`letter_attachment` FROM `experience_certificate` WHERE `id` = ?"))
				{	
					$stmt_insert->bind_param("i",$up_id);
					
					$stmt_insert->bind_result($id,$emp_id,$emp_name,$date_of_letter,$duration_from,$duration_to,$text1,$text2,$letter_attachment);
					
					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$emp_id;
							$details[$counter][2]	=	$emp_name;
							$details[$counter][3]	=	$date_of_letter;
							$details[$counter][4]	=	$duration_from;
							$details[$counter][5]	=	$duration_to;
							$details[$counter][6]	=	$text1;
							$details[$counter][7]	=	$text2;
							$details[$counter][8]	=	$letter_attachment;
							
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			function update_letter_attachment($up_id)
			{							
				$id_size_photo = "";
				
				if($stmt_insert = $this->con->prepare("Update `experience_certificate` set `letter_attachment` = ? Where `id` =?"))
				{
					$stmt_insert->bind_param("si",$id_size_photo,$up_id);
					
					if($stmt_insert->execute())
					{
						return true;
					}
						return false;
				} 	
			}
			function get_letter_attachment_name_by_id($id)
			{
				if($stmt_select = $this->con->prepare("Select `letter_attachment` from `experience_certificate` where `id` = ? "))
				{	
					$stmt_select->bind_param("i",$id);
				
					$stmt_select->bind_result($result_password);
				
					if($stmt_select->execute())
					{
						if($stmt_select->fetch())
						{
							return $result_password;
						}
					}
							return false;
				}
			}
			function update_letter_attachment_photo_by_id($up_id,$id_size_photo)
			{									
				if($stmt_insert = $this->con->prepare("Update `experience_certificate` set `letter_attachment` = ? Where `id` =?"))
				{
					$stmt_insert->bind_param("si",$id_size_photo,$up_id);
					
					if($stmt_insert->execute())
					{
						return true;
					}
						return false;
				} 	
			}
			function add_salary($full_name,$fetch_name,$payment,$payment_date,$mode,$photo)
			{							
				$date = date("Y-m-d");
				$time = date("H-i-s A");
				if($stmt_insert = $this->con->prepare("INSERT INTO `salary`(`emp_id`, `emp_name`, `payment`, `payment_date`, `payment_mode`, `attachment`, `date`, `time`) VALUES (?,?,?,?,?,?,?,?)"))
				{
					$stmt_insert->bind_param("ssssssss",$full_name,$fetch_name,$payment,$payment_date,$mode,$photo,$date,$time);
					
					if($stmt_insert->execute())
					{
						return $stmt_insert->insert_id;
					}
						return false;
				} 	
			}
			function get_all_salary_data($emp_id,$emp_name)
			{			
				if($stmt_insert = $this->con->prepare("SELECT `id`,`emp_id`, `emp_name`, `payment`, `payment_date`, `payment_mode`, `attachment` FROM `salary` Where `emp_id` LIKE '%$emp_id%' AND `emp_name` LIKE '%$emp_name%'"))
				{	
					$stmt_insert->bind_result($id,$emp_id,$emp_name,$payment,$payment_date,$payment_mode,$attachment);
					
					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$emp_id;
							$details[$counter][2]	=	$emp_name;
							$details[$counter][3]	=	$payment;
							$details[$counter][4]	=	$payment_date;
							$details[$counter][5]	=	$payment_mode;
							$details[$counter][6]	=	$attachment;
							
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			function delete_salary_data($del_id)
			{
				if($stmt_select = $this->con->prepare("Delete from `salary` where `id`=?"))
				{
					$stmt_select->bind_param("i",$del_id);
				
					if($stmt_select->execute())
					{					
							return true;
					}
						return false;
				}
			}
			function get_all_salary_data_by_id($up_id)
			{			
				if($stmt_insert = $this->con->prepare("SELECT `id`,`emp_id`, `emp_name`, `payment`, `payment_date`, `payment_mode`, `attachment` FROM `salary` Where `id` = ?"))
				{	
					$stmt_insert->bind_param("i",$up_id);
					
					$stmt_insert->bind_result($id,$emp_id,$emp_name,$payment,$payment_date,$payment_mode,$attachment);
					
					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$emp_id;
							$details[$counter][2]	=	$emp_name;
							$details[$counter][3]	=	$payment;
							$details[$counter][4]	=	$payment_date;
							$details[$counter][5]	=	$payment_mode;
							$details[$counter][6]	=	$attachment;
							
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			function update_salary($up_id,$full_name,$payment,$payment_date,$mode)
			{							
				
				if($stmt_insert = $this->con->prepare("update `salary` set  `emp_name` = ?, `payment` = ?, `payment_date` = ?, `payment_mode` = ? Where `id` = ?"))
				{
					$stmt_insert->bind_param("ssssi",$full_name,$payment,$payment_date,$mode,$up_id);
					
					if($stmt_insert->execute())
					{
						return $stmt_insert->insert_id;
					}
						return false;
				} 	
			}
			function update_payment_attachment($up_id)
			{							
				$id_size_photo = "";
				
				if($stmt_insert = $this->con->prepare("Update `salary` set `attachment` = ? Where `id` =?"))
				{
					$stmt_insert->bind_param("si",$id_size_photo,$up_id);
					
					if($stmt_insert->execute())
					{
						return true;
					}
						return false;
				} 	
			}
			function get_payment_attachment_name_by_id($id)
			{
				if($stmt_select = $this->con->prepare("Select `attachment` from `salary` where `id` = ? "))
				{	
					$stmt_select->bind_param("i",$id);
				
					$stmt_select->bind_result($result_password);
				
					if($stmt_select->execute())
					{
						if($stmt_select->fetch())
						{
							return $result_password;
						}
					}
							return false;
				}
			}
			function update_payment_attachment_photo_by_id($up_id,$id_size_photo)
			{									
				if($stmt_insert = $this->con->prepare("Update `salary` set `attachment` = ? Where `id` =?"))
				{
					$stmt_insert->bind_param("si",$id_size_photo,$up_id);
					
					if($stmt_insert->execute())
					{
						return true;
					}
						return false;
				} 	
			}
			function fetch_payment_by_id($id)
			{
				if($stmt_select = $this->con->prepare("Select `salary` from `employees` where `id` = ? "))
				{	
					$stmt_select->bind_param("i",$id);
				
					$stmt_select->bind_result($result_password);
				
					if($stmt_select->execute())
					{
						if($stmt_select->fetch())
						{
							return $result_password;
						}
					}
							return false;
				}
			}
			function new_projects($project_name,$languages,$college_name,$fees,$s_name1,$s_email1,$s_contact1,$s_name2,$s_email2,$s_contact2,$s_name3,$s_email3,$s_contact3,$s_name4,$s_email4,$s_contact4,$s_name5,$s_email5,$s_contact5,$r_date)
			{							
				$date = date("Y-m-d");
				$time = date("H-i-s A");
				if($stmt_insert = $this->con->prepare("INSERT INTO `projects`(`project_name`, `language`, `c_name`, `fees`, `student1_name`, `student1_email`, `student1_contact`, `student2_name`, `student2_email`, `student2_contact`, `student3_name`, `student3_email`, `student3_contact`, `student4_name`, `student4_email`, `student4_contact`, `student5_name`, `student5_email`, `student5_contact`, `reg_date`, `date`, `time`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)"))
				{
					$stmt_insert->bind_param("ssssssssssssssssssssss",$project_name,$languages,$college_name,$fees,$s_name1,$s_email1,$s_contact1,$s_name2,$s_email2,$s_contact2,$s_name3,$s_email3,$s_contact3,$s_name4,$s_email4,$s_contact4,$s_name5,$s_email5,$s_contact5,$r_date,$date,$time);
					
					if($stmt_insert->execute())
					{
						return $stmt_insert->insert_id;
					}
						return false;
				} 	
			}
			function get_all_project_information($p_name,$p_id,$date_from,$date_to)
			{	
				 $date_from	= Date ("Y-m-d", strtotime($date_from));
				 $date_to	= Date ("Y-m-d", strtotime($date_to));				
				
				if($stmt_insert = $this->con->prepare("SELECT `id`,`project_name`, `language`, `c_name`, `fees`, `student1_name`, `student1_email`, `student1_contact`, `student2_name`, `student2_email`, `student2_contact`, `student3_name`, `student3_email`, `student3_contact`, `student4_name`, `student4_email`, `student4_contact`, `student5_name`, `student5_email`, `student5_contact`, `reg_date` FROM `projects` Where `project_name` LIKE '%$p_name%' AND `id` LIKE '%$p_id%' AND `date` BETWEEN '$date_from' AND '$date_to'"))
				{	
					$stmt_insert->bind_result($id,$project_name,$language,$c_name,$fees,$student1_name,$student1_email,$student1_contact,$student2_name,$student2_email,$student2_contact,$student3_name,$student3_email,$student3_contact,$student4_name,$student4_email,$student4_contact,$student5_name,$student5_email,$student5_contact,$reg_date);
					
					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$project_name;
							$details[$counter][2]	=	$language;
							$details[$counter][3]	=	$c_name;
							$details[$counter][4]	=	$fees;
							$details[$counter][5]	=	$student1_name;
							$details[$counter][6]	=	$student1_email;
							$details[$counter][7]	=	$student1_contact;
							$details[$counter][8]	=	$student2_name;
							$details[$counter][9]	=	$student2_email;
							$details[$counter][10]	=	$student2_contact;
							$details[$counter][11]	=	$student3_name;
							$details[$counter][12]	=	$student3_email;
							$details[$counter][13]	=	$student3_contact;
							$details[$counter][14]	=	$student4_name;
							$details[$counter][15]	=	$student4_email;
							$details[$counter][16]	=	$student4_contact;
							$details[$counter][17]	=	$student5_name;
							$details[$counter][18]	=	$student5_email;
							$details[$counter][19]	=	$student5_contact;
							$details[$counter][20]	=	$reg_date;
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			function delete_college_info($del_id)
			{
				if($stmt_select = $this->con->prepare("Delete from `projects` where `id`=?"))
				{
					$stmt_select->bind_param("i",$del_id);
				
					if($stmt_select->execute())
					{					
							return true;
					}
						return false;
				}
			}
			function update_experience_certificate_name($emp_id,$full_name)
			{	
				if($stmt_insert = $this->con->prepare("Update `experience_certificate` set `emp_name` = ? Where `emp_id` = ?"))
				{
					$stmt_insert->bind_param("ss",$full_name,$emp_id);
					
					if($stmt_insert->execute())
					{
						return $stmt_insert->insert_id;
					}
						return false;
				} 	
			}
			function update_emp_name_in_salary($emp_id,$full_name)
			{	
				if($stmt_insert = $this->con->prepare("Update `salary` set `emp_name` = ? Where `emp_id` = ?"))
				{
					$stmt_insert->bind_param("ss",$full_name,$emp_id);
					
					if($stmt_insert->execute())
					{
						return $stmt_insert->insert_id;
					}
						return false;
				} 	
			}
			function get_all_project_information_for_display($up_id)
			{	
				if($stmt_insert = $this->con->prepare("SELECT `id`,`project_name`, `language`, `c_name`, `fees`, `student1_name`, `student1_email`, `student1_contact`, `student2_name`, `student2_email`, `student2_contact`, `student3_name`, `student3_email`, `student3_contact`, `student4_name`, `student4_email`, `student4_contact`, `student5_name`, `student5_email`, `student5_contact`, `reg_date` FROM `projects` Where `id` = ?"))
				{	
					$stmt_insert->bind_param("i",$up_id);
					
					$stmt_insert->bind_result($id,$project_name,$language,$c_name,$fees,$student1_name,$student1_email,$student1_contact,$student2_name,$student2_email,$student2_contact,$student3_name,$student3_email,$student3_contact,$student4_name,$student4_email,$student4_contact,$student5_name,$student5_email,$student5_contact,$reg_date);
					
					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$project_name;
							$details[$counter][2]	=	$language;
							$details[$counter][3]	=	$c_name;
							$details[$counter][4]	=	$fees;
							$details[$counter][5]	=	$student1_name;
							$details[$counter][6]	=	$student1_email;
							$details[$counter][7]	=	$student1_contact;
							$details[$counter][8]	=	$student2_name;
							$details[$counter][9]	=	$student2_email;
							$details[$counter][10]	=	$student2_contact;
							$details[$counter][11]	=	$student3_name;
							$details[$counter][12]	=	$student3_email;
							$details[$counter][13]	=	$student3_contact;
							$details[$counter][14]	=	$student4_name;
							$details[$counter][15]	=	$student4_email;
							$details[$counter][16]	=	$student4_contact;
							$details[$counter][17]	=	$student5_name;
							$details[$counter][18]	=	$student5_email;
							$details[$counter][19]	=	$student5_contact;
							$details[$counter][20]	=	$reg_date;
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			function update_projects($up_id,$project_name,$languages,$college_name,$fees,$s_name1,$s_email1,$s_contact1,$s_name2,$s_email2,$s_contact2,$s_name3,$s_email3,$s_contact3,$s_name4,$s_email4,$s_contact4,$s_name5,$s_email5,$s_contact5,$r_date)
			{	
				if($stmt_insert = $this->con->prepare("Update `projects` set `project_name` = ?, `language` = ?, `c_name` = ?, `fees` = ?, `student1_name` = ?, `student1_email` = ?, `student1_contact` = ?, `student2_name` = ?, `student2_email` = ?, `student2_contact` = ?, `student3_name` = ?, `student3_email` = ?, `student3_contact` = ?, `student4_name` = ?, `student4_email` = ?, `student4_contact` = ?, `student5_name` = ?, `student5_email` = ?, `student5_contact` = ?, `reg_date` = ? Where `id` =?"))
				{
					$stmt_insert->bind_param("ssssssssssssssssssssi",$project_name,$languages,$college_name,$fees,$s_name1,$s_email1,$s_contact1,$s_name2,$s_email2,$s_contact2,$s_name3,$s_email3,$s_contact3,$s_name4,$s_email4,$s_contact4,$s_name5,$s_email5,$s_contact5,$r_date,$up_id);
					
					if($stmt_insert->execute())
					{
						return true;
					}
						return false;
				} 	
			}
			function get_project_name()
			{
				if($stmt_select = $this->con->prepare("Select `id`, `project_name` from `projects` "))
				{	
					$stmt_select->bind_result($id,$full_name);
				
					if($stmt_select->execute())
					{		
						$data = array();
						$counter = 0;
						while($stmt_select->fetch())
						{
							$data[$counter][0] 	=	$id;
							$data[$counter][1] 	=	$full_name;
							$counter ++;
						}
						if(!empty($data))
						{
							return $data;
						}
					}
							return false;
				}
			}
			function add_project_payment($project_id,$project_name,$amount,$date,$sms,$s_email)
			{							
				$time = date("H-i-s A");
				if($stmt_insert = $this->con->prepare("INSERT INTO `project_payment`(`project_id`,`project_name`,`amount`,`date`,`sms`,`email`,`time`) VALUES (?,?,?,?,?,?,?)"))
				{
					$stmt_insert->bind_param("sssssss",$project_id,$project_name,$amount,$date,$sms,$s_email,$time);
					
					if($stmt_insert->execute())
					{
						return true;
					}
						return false;
				} 	
			}
			function fetch_project_name_by_id($project_id)
			{
				if($stmt_select = $this->con->prepare("Select `project_name` from `projects` where `id` = ? "))
				{	
					$stmt_select->bind_param("i",$project_id);
				
					$stmt_select->bind_result($result_password);
				
					if($stmt_select->execute())
					{
						if($stmt_select->fetch())
						{
							return $result_password;
						}
					}
							return false;
				}
			}
			function get_project_payment_information($pro_name,$date_to,$date_from,$pro_id)
			{	
				if($stmt_insert = $this->con->prepare("SELECT `id`, `project_id`,`project_name`,`amount`,`date`,`time` FROM `project_payment` WHERE `project_name` LIKE '%$pro_name%' AND `date` BETWEEN '$date_from' AND '$date_to' AND `project_id` LIKE '%$pro_id%'"))
				{	
					$stmt_insert->bind_result($id,$project_id,$project_name,$amount,$date,$time);
					
					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$project_id;
							$details[$counter][2]	=	$project_name;
							$details[$counter][3]	=	$amount;
							$details[$counter][4]	=	$date;
							$details[$counter][5]	=	$time;
							
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			function delete_project_payment_info($del_id)
			{
				if($stmt_select = $this->con->prepare("Delete from `project_payment` where `id`=?"))
				{
					$stmt_select->bind_param("i",$del_id);
				
					if($stmt_select->execute())
					{					
							return true;
					}
						return false;
				}
			}
			function get_project_payment_information_for_display($up_id)
			{	
				if($stmt_insert = $this->con->prepare("SELECT `id`, `project_id`,`project_name`,`amount`,`date` FROM `project_payment` WHERE `id` = ?"))
				{	
					$stmt_insert->bind_param("i",$up_id);
					
					$stmt_insert->bind_result($id,$project_id,$project_name,$amount,$date);
					
					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$project_id;
							$details[$counter][2]	=	$project_name;
							$details[$counter][3]	=	$amount;
							$details[$counter][4]	=	$date;
							
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			function update_project_payment($up_id,$project_id,$project_name,$amount,$date)
			{	
				if($stmt_insert = $this->con->prepare("Update `project_payment` set `project_id` =? ,`project_name` =?,`amount` =?,`date`=? Where `id` =?"))
				{
					$stmt_insert->bind_param("ssssi",$project_id,$project_name,$amount,$date,$up_id);
					
					if($stmt_insert->execute())
					{
						return true;
					}
						return false;
				} 	
			}
			function fetch_final_amount($project_id)
			{
				if($stmt_select = $this->con->prepare("Select `fees` from `projects` where `id` = ? "))
				{	
					$stmt_select->bind_param("i",$project_id);
				
					$stmt_select->bind_result($result_password);
				
					if($stmt_select->execute())
					{
						if($stmt_select->fetch())
						{
							return $result_password;
						}
					}
							return false;
				}
			}
			function check_id_exist_or_not($project_id)
			{
				if($stmt_select = $this->con->prepare("Select `id` from `project_payment` where `project_id` = ? "))
				{	
					$stmt_select->bind_param("s",$project_id);
				
					$stmt_select->bind_result($result_password);
				
					if($stmt_select->execute())
					{
						if($stmt_select->fetch())
						{
							return $result_password;
						}
					}
							return false;
				}
			}
			function update_project_records($project_id,$amount)
			{	
				if($stmt_insert = $this->con->prepare("Update `project_payment` set `amount` =? Where `project_id` =?"))
				{
					$stmt_insert->bind_param("ss",$amount,$project_id);
					
					if($stmt_insert->execute())
					{
						return true;
					}
						return false;
				} 	
			}
			function fetch_paid_amount($project_id)
			{
				if($stmt_select = $this->con->prepare("Select `amount` from `project_payment` where `project_id` = ? "))
				{	
					$stmt_select->bind_param("s",$project_id);
				
					$stmt_select->bind_result($result_password);
				
					if($stmt_select->execute())
					{
						if($stmt_select->fetch())
						{
							return $result_password;
						}
					}
							return false;
				}
			}
			function add_quotation_info($cust_id,$customer_name,$service,$service_name,$comment,$amount,$d_amount)
			{							
				$date = date("Y-m-d");
				$time = date("H-i-s A");
				if($stmt_insert = $this->con->prepare("INSERT INTO `tmp_quotation`(`cust_id`, `cust_name`, `service_id`, `service_name`, `comment`, `actual_amount`, `discount_amount`, `date`, `time`) VALUES (?,?,?,?,?,?,?,?,?)"))
				{
					$stmt_insert->bind_param("sssssssss",$cust_id,$customer_name,$service,$service_name,$comment,$amount,$d_amount,$date,$time);
					
					if($stmt_insert->execute())
					{
						return true;
					}
						return false;
				} 	
			}
			function fetch_cust_name_by_id($c_id)
			{
				if($stmt_select = $this->con->prepare("Select `name` from `customers` where `id` = ? "))
				{	
					$stmt_select->bind_param("i",$c_id);
				
					$stmt_select->bind_result($result_service);
					
					if($stmt_select->execute())
					{
						if($stmt_select->fetch())
						{
							 return $result_service;
						}
					}
							return false;
				}
			}
			function delete_quotation_info($del_id)
			{
				if($stmt_select = $this->con->prepare("Delete from `tmp_quotation` where `id`=?"))
				{
					$stmt_select->bind_param("i",$del_id);
				
					if($stmt_select->execute())
					{					
							return true;
					}
						return false;
				}
			}
			function get_all_quotation_information($c_name,$date_to,$date_from,$service)
			{	
				if($service=="select")
				{
					$service ="";
				}
			
				if($stmt_insert = $this->con->prepare("SELECT `id`, `cust_id`, `cust_name`, `service_id`, `service_name`,`comment`, `actual_amount`, `discount_amount`, `date`, `time` FROM `quotation_cart` WHERE `cust_name` LIKE '%$c_name%' AND `date` BETWEEN '$date_from' AND '$date_to' AND `service_name` LIKE '%$service%'"))
				{	
					$stmt_insert->bind_result($id,$cust_id,$cust_name,$service_no,$service_name,$comment,$actual_amount,$discount_amount,$date,$time);
					
					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$cust_id;
							$details[$counter][2]	=	$cust_name;
							$details[$counter][3]	=	$service_no;
							$details[$counter][4]	=	$service_name;
							$details[$counter][5]	=	$comment;
							$details[$counter][6]	=	$actual_amount;
							$details[$counter][7]	=	$discount_amount;
							$details[$counter][8]	=	$date;
							$details[$counter][9]	=	$time;
						
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			function get_all_quotation_information_by_id($up_id)
			{		
				if($stmt_insert = $this->con->prepare("SELECT `id`, `cust_id`, `cust_name`, `service_id`, `service_name`, `comment`, `actual_amount`, `discount_amount`, `date`, `time` FROM `quotation_cart` WHERE `transaction_id` = ?"))
				{	
					$stmt_insert->bind_param("s",$up_id);
					
					$stmt_insert->bind_result($id,$cust_id,$cust_name,$service_no,$service_name,$comment,$actual_amount,$discount_amount,$date,$time);
					
					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$cust_id;
							$details[$counter][2]	=	$cust_name;
							$details[$counter][3]	=	$service_no;
							$details[$counter][4]	=	$service_name;
							$details[$counter][5]	=	$comment;
							$details[$counter][6]	=	$actual_amount;
							$details[$counter][7]	=	$discount_amount;
							$details[$counter][8]	=	$date;
							$details[$counter][9]	=	$time;
						
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			
			function update_logo($up_id)
			{							
				$id_size_photo = "";
				
				if($stmt_insert = $this->con->prepare("Update `customers` set `logo` = ? Where `id` =?"))
				{
					$stmt_insert->bind_param("si",$id_size_photo,$up_id);
					
					if($stmt_insert->execute())
					{
						return true;
					}
						return false;
				} 	
			}
			function get_logo_name_by_id($id)
			{
				if($stmt_select = $this->con->prepare("Select `logo` from `customers` where `id` = ? "))
				{	
					$stmt_select->bind_param("i",$id);
				
					$stmt_select->bind_result($result_password);
				
					if($stmt_select->execute())
					{
						if($stmt_select->fetch())
						{
							return $result_password;
						}
					}
							return false;
				}
			}
			function update_logo_image_by_id($up_id,$id_size_photo)
			{									
				if($stmt_insert = $this->con->prepare("Update `customers` set `logo` = ? Where `id` =?"))
				{
					$stmt_insert->bind_param("si",$id_size_photo,$up_id);
					
					if($stmt_insert->execute())
					{
						return true;
					}
						return false;
				} 	
			}
			function fetch_projects()
			{
				if($stmt_insert = $this->con->prepare("SELECT `id`, `project_name` FROM `customer_services` "))
				{
					$stmt_insert->bind_result($id,$project_name);
				
					if($stmt_insert->execute())
					{
						$counter	=	0;
						$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$project_name;
							$counter++;
						}
					if(!empty($details))	
					{
						return $details;
					}
					return false;
					}	
				}
		
			}
			function approve_service_status($app_id)
			{
				$status = "show in company profile";
				if($stmt_select = $this->con->prepare("Update `customer_services` set `status`= ? where `id`=?"))
				{
					$stmt_select->bind_param("si",$status,$app_id);
				
					if($stmt_select->execute())
					{					
							return true;
					}
						return false;
				}
			}
			function pending_service_status($pen_id)
			{
				$status = "don't show in company profile";
				if($stmt_select = $this->con->prepare("Update `customer_services` set `status`= ? where `id`=?"))
				{
					$stmt_select->bind_param("si",$status,$pen_id);
				
					if($stmt_select->execute())
					{					
							return true;
					}
						return false;
				}
			}
			function get_all_service_information_for_display()
			{	
				if($stmt_insert = $this->con->prepare("SELECT `id`,`customer_name`, `service`, `project_name`,`amount`,`status` FROM `customer_services` Where `project_name` != ' ' AND `status` = 'show in company profile'  ORDER BY `service` DESC"))
				{
					$stmt_insert->bind_result($id,$customer_name,$service,$p_name,$amount,$status);
					
					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$customer_name;
							$details[$counter][2]	=	$service;
							$details[$counter][3]	=	$p_name;
							$details[$counter][4]	=	$amount;
							$details[$counter][5]	=	$status;
					
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			function fetch_email_by_id($id)
			{
				if($stmt_select = $this->con->prepare("Select `email` from `customers` where `id` = ? "))
				{	
					$stmt_select->bind_param("i",$id);
				
					$stmt_select->bind_result($result_password);
				
					if($stmt_select->execute())
					{
						if($stmt_select->fetch())
						{
							return $result_password;
						}
					}
							return false;
				}
			}
			function cancel_service_status($pen_id)
			{
				$status = "cancel";
				if($stmt_select = $this->con->prepare("Update `customer_services` set `status`= ? where `id`=?"))
				{
					$stmt_select->bind_param("si",$status,$pen_id);
				
					if($stmt_select->execute())
					{					
							return true;
					}
						return false;
				}
			}
			function get_all_service_for_display()
			{	
				if($stmt_insert = $this->con->prepare("SELECT `id`,`services` FROM `services` "))
				{	
					$stmt_insert->bind_result($id,$service);
					
					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$service;
							
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			function get_all_cancel_payment_information($s_id)
			{
				if($stmt_insert = $this->con->prepare("SELECT `id`, `services_id`, `cust_id`, `cust_name`, `service_no`, `service_name`,`project_name`, `opening_amount`, `paid_amount`, `bal_amount`, `date`, `time` FROM `payment_report` Where `services_id` =?"))
				{	
					$stmt_insert->bind_param("s",$s_id);
					
					$stmt_insert->bind_result($id,$services_id,$cust_id,$cust_name,$service_no,$service_name,$p_name,$opening_amount,$paid_amount,$bal_amount,$date,$time);
					
					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$services_id;
							$details[$counter][2]	=	$cust_id;
							$details[$counter][3]	=	$cust_name;
							$details[$counter][4]	=	$service_no;
							$details[$counter][5]	=	$service_name;
							$details[$counter][6]	=	$p_name;
							$details[$counter][7]	=	$opening_amount;
							$details[$counter][8]	=	$paid_amount;
							$details[$counter][9]	=	$bal_amount;
							$details[$counter][10]	=	$date;
							$details[$counter][11]	=	$time;
						
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			function get_all_service_information_for_cancel_status()
			{	
				if($stmt_insert = $this->con->prepare("SELECT `id` FROM `customer_services` Where `status` ='cancel' "))
				{	
					$stmt_insert->bind_result($id);
					
					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;							
					
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			function fetch_status($id)
			{
				if($stmt_select = $this->con->prepare("Select `status` from `customer_services` where `id` = ? "))
				{	
					$stmt_select->bind_param("i",$id);
				
					$stmt_select->bind_result($result_password);
				
					if($stmt_select->execute())
					{
						if($stmt_select->fetch())
						{
							return $result_password;
						}
					}
							return false;
				}
			}
			function fetch_status_by_cust_id($cust_id)
			{
				if($stmt_select = $this->con->prepare("Select `status` from `customer_services` where `customer_name` = ? "))
				{	
					$stmt_select->bind_param("s",$cust_id);
				
					$stmt_select->bind_result($result_id);
					
					if($stmt_select->execute())
					{
						if($stmt_select->fetch())
						{
							 return $result_id;
						}
					}
							return false;
				}
			}
			function cancel_service_status_in_payment($pen_id)
			{
				$status = "cancel";
				if($stmt_select = $this->con->prepare("Update `payment_report` set `status`= ? where `services_id`=?"))
				{
					$stmt_select->bind_param("ss",$status,$pen_id);
				
					if($stmt_select->execute())
					{					
							return true;
					}
						return false;
				}
			}
			function fetch_customer_name_by_id($id)
			{
				if($stmt_select = $this->con->prepare("Select `name` from `customers` where `id` = ? "))
				{	
					$stmt_select->bind_param("i",$id);
				
					$stmt_select->bind_result($result_password);
				
					if($stmt_select->execute())
					{
						if($stmt_select->fetch())
						{
							return $result_password;
						}
					}
							return false;
				}
			}
			function add_to_the_invoice_cart($insert_id,$c_id,$service_id,$actual_total_amount,$discount_total_amount)
			{							
				$date = date("Y-m-d");
				$time = date("H-i-s A");
				if($stmt_insert = $this->con->prepare("INSERT INTO `invoice_cart`(`transaction_id`,`customer_id`, `service`, `actual_amount`, `discount_amount`,`date` ,`time`) VALUES (?,?,?,?,?,?,?)"))
				{
					$stmt_insert->bind_param("sssssss",$insert_id,$c_id,$service_id,$actual_total_amount,$discount_total_amount,$date,$time);
					
					if($stmt_insert->execute())
					{
						return true;
					}
						return false;
				} 	
			}
			function get_temp_invoice_info_for_display()
			{	
				if($stmt_insert = $this->con->prepare("SELECT `id`,`customer_id`, `service`,SUM(`actual_amount`),SUM(`discount_amount`) FROM `tmp_invoice`"))
				{	
					$stmt_insert->bind_result($id,$c_id,$service,$actual_amount,$discount_amount);
					
					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$c_id;
							$details[$counter][2]	=	$service;
							$details[$counter][3]	=	$actual_amount;
							$details[$counter][4]	=	$discount_amount;
							
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			function insert_invoice_details($c_id,$actual_amount,$discount_amount)
			{							
				$date = date("Y-m-d");
				$time = date("H-i-s A");
				if($stmt_insert = $this->con->prepare("INSERT INTO `invoice`(`customer_id`, `total_amount`, `discount_amount`,`date` ,`time`) VALUES (?,?,?,?,?)"))
				{
					$stmt_insert->bind_param("sssss",$c_id,$actual_amount,$discount_amount,$date,$time);
					
					if($stmt_insert->execute())
					{
						return $stmt_insert->insert_id;
					}
						return false;
				} 	
			}
			function fetch_invoice_cart_data_by_cust_id($c_id)
			{	
				if($stmt_insert = $this->con->prepare("SELECT `id`,`transaction_id`,`customer_id`,`service`,`actual_amount`,`discount_amount` FROM `invoice_cart` Where `transaction_id` = ?"))
				{	
					$stmt_insert->bind_param("s",$c_id);
					
					$stmt_insert->bind_result($id,$t_id,$c_id,$service,$actual_amount,$discount_amount);
					
					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$c_id;
							$details[$counter][2]	=	$c_id;
							$details[$counter][3]	=	$service;
							$details[$counter][4]	=	$actual_amount;
							$details[$counter][5]	=	$discount_amount;
							
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			function fetch_invoice_id_by_cust_id($c_id)
			{
				if($stmt_select = $this->con->prepare("Select `customer_id` from `invoice` where `id` = ? "))
				{	
					$stmt_select->bind_param("i",$c_id);
				
					$stmt_select->bind_result($result_password);
				
					if($stmt_select->execute())
					{
						if($stmt_select->fetch())
						{
							return $result_password;
						}
					}
							return false;
				}
			}
			function fetch_invoice_report()
			{	
				if($stmt_insert = $this->con->prepare("SELECT `id`,`customer_id`,`total_amount`,`discount_amount` FROM `invoice` "))
				{	
					$stmt_insert->bind_result($id,$c_id,$actual_amount,$discount_amount);
					
					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$c_id;
							$details[$counter][2]	=	$actual_amount;
							$details[$counter][3]	=	$discount_amount;
							
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			function fetch_services_id_by_cust_id($c_id)
			{
				if($stmt_select = $this->con->prepare("Select `service` from `invoice_cart` where `transaction_id` = ? "))
				{	
					$stmt_select->bind_param("s",$c_id);
				
					$stmt_select->bind_result($service);
				
					if($stmt_select->execute())
					{	$count = 0;
						$data = array();
						while($stmt_select->fetch())
						{	
							$data[$count][0] = $service;
							$count++;
						}
						if(!empty($data))
						{
							return $data;
						}
					}
							return false;
				}
			}
			function fetch_invoice_cart_data_by_transaction_id($tran_id)
			{	
				if($stmt_insert = $this->con->prepare("SELECT `id`,`transaction_id`,`customer_id`,`service`,`actual_amount`,`discount_amount` FROM `invoice_cart` Where `transaction_id` = ?"))
				{	
					$stmt_insert->bind_param("s",$tran_id);
					
					$stmt_insert->bind_result($id,$t_id,$c_id,$service,$actual_amount,$discount_amount);
					
					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$t_id;
							$details[$counter][2]	=	$c_id;
							$details[$counter][3]	=	$service;
							$details[$counter][4]	=	$actual_amount;
							$details[$counter][5]	=	$discount_amount;
							
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			function delete_invoice_cart($del_id)
			{
				if($stmt_select = $this->con->prepare("Delete from `invoice_cart` where `id`=?"))
				{
					$stmt_select->bind_param("i",$del_id);
				
					if($stmt_select->execute())
					{					
							return true;
					}
						return false;
				}
			}
			function delete_main_invoice_cart($del_id)
			{
				if($stmt_select = $this->con->prepare("Delete from `invoice` where `id`=?"))
				{
					$stmt_select->bind_param("i",$del_id);
				
					if($stmt_select->execute())
					{					
							return true;
					}
						return false;
				}
			}
			function delete_invoice_cart_data($del_id)
			{
				if($stmt_select = $this->con->prepare("Delete from `invoice_cart` where `transaction_id`=?"))
				{
					$stmt_select->bind_param("s",$del_id);
				
					if($stmt_select->execute())
					{					
							return true;
					}
						return false;
				}
			}
			function update_invoice_details($up_id,$c_id,$actual_amount,$discount_amount)
			{	
				if($stmt_insert = $this->con->prepare("Update `invoice` set `customer_id` = ?, `total_amount` = ?, `discount_amount` = ? Where `id` = ?"))
				{						
				
					$stmt_insert->bind_param("sssi",$c_id,$actual_amount,$discount_amount,$up_id);
					
					if($stmt_insert->execute())
					{
						return true;
					}
						return false;
				} 	
			}
			function update_invoice_cart($up_id,$c_id,$service_id,$actual_total_amount,$discount_total_amount)
			{							
				$date = date("Y-m-d");
				$time = date("H-i-s A");
				if($stmt_insert = $this->con->prepare("update `invoice_cart` set `customer_id` = ?, `service` = ?, `actual_amount` = ?, `discount_amount` = ? Where `transaction_id` = ?"))
				{
					$stmt_insert->bind_param("sssss",$c_id,$service_id,$actual_total_amount,$discount_total_amount,$up_id);
					
					if($stmt_insert->execute())
					{
						return true;
					}
						return false;
				} 	
			}
			function get_temp_invoice_cart_info($update_id)
			{	
				if($stmt_insert = $this->con->prepare("SELECT `id`,`customer_id`,`service`,`actual_amount`,`discount_amount` FROM `invoice_cart` Where `transaction_id` = ?"))
				{	
					$stmt_insert->bind_param("s",$update_id);
					
					$stmt_insert->bind_result($id,$c_id,$service,$actual_amount,$discount_amount);
					
					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$c_id;
							$details[$counter][2]	=	$service;
							$details[$counter][3]	=	$actual_amount;
							$details[$counter][4]	=	$discount_amount;
							
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			function get_total_amount_invoice_cart_info($update_id)
			{	
				if($stmt_insert = $this->con->prepare("SELECT `id`,`customer_id`,`service`,SUM(`actual_amount`),SUM(`discount_amount`) FROM `invoice_cart` Where `transaction_id` = ?"))
				{	
					$stmt_insert->bind_param("s",$update_id);
					
					$stmt_insert->bind_result($id,$c_id,$service,$actual_amount,$discount_amount);
					
					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$c_id;
							$details[$counter][2]	=	$service;
							$details[$counter][3]	=	$actual_amount;
							$details[$counter][4]	=	$discount_amount;
							
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			function fetch_invoice_data_for_update($id)
			{	
				if($stmt_insert = $this->con->prepare("SELECT `id`,`transaction_id`, `customer_id`,`service`,`actual_amount`,`discount_amount` FROM `invoice_cart` Where `id` = ?"))
				{	
					$stmt_insert->bind_param("i",$id);
					
					$stmt_insert->bind_result($id,$t_id,$c_id,$service,$actual_amount,$discount_amount);
					
					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$t_id;
							$details[$counter][2]	=	$c_id;
							$details[$counter][3]	=	$service;
							$details[$counter][4]	=	$actual_amount;
							$details[$counter][5]	=	$discount_amount;
							
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			function fetch_actual_amount_by_id($c_id)
			{
				if($stmt_select = $this->con->prepare("Select `total_amount` from `invoice` where `id` = ? "))
				{	
					$stmt_select->bind_param("i",$c_id);
				
					$stmt_select->bind_result($result_password);
				
					if($stmt_select->execute())
					{
						if($stmt_select->fetch())
						{
							return $result_password;
						}
					}
							return false;
				}
			}
			function fetch_discount_amount_by_id($c_id)
			{
				if($stmt_select = $this->con->prepare("Select `discount_amount` from `invoice` where `id` = ? "))
				{	
					$stmt_select->bind_param("i",$c_id);
				
					$stmt_select->bind_result($result_password);
				
					if($stmt_select->execute())
					{
						if($stmt_select->fetch())
						{
							return $result_password;
						}
					}
							return false;
				}
			}
			function update_amount_invoice_details($up_id,$actual_amount,$discount_amount)
			{	
				if($stmt_insert = $this->con->prepare("Update `invoice` set  `total_amount` = ?, `discount_amount` = ? Where `id` = ?"))
				{						
					$stmt_insert->bind_param("ssi",$actual_amount,$discount_amount,$up_id);
					
					if($stmt_insert->execute())
					{
						return true;
					}
						return false;
				} 	
			}
			function get_all_customer_information_for_sms($cust_name,$cust_id)
			{	
				if($stmt_insert = $this->con->prepare("SELECT `id`,`name`, `office_name`,`email`, `address`, `primary_contact_no`, `other_contact_no`,`logo` FROM `customers` Where `name` LIKE '%$cust_name%' AND `id` LIKE '%$cust_id%' "))
				{	
					$stmt_insert->bind_result($id,$name,$office_name,$email,$address,$primary_contact_no,$other_contact_no,$logo);
					
					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$name;
							$details[$counter][2]	=	$office_name;
							$details[$counter][3]	=	$email;
							$details[$counter][4]	=	$address;
							$details[$counter][5]	=	$primary_contact_no;
							$details[$counter][6]	=	$other_contact_no;
							$details[$counter][7]	=	$logo;
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			function add_data($record,$language,$message)
			{							
				$date = date("Y-m-d");
				$time = date("H-i-s A");
				if($stmt_insert = $this->con->prepare("INSERT INTO `sms_panel`(`customer_id`, `language`, `message`,`date` ,`time`) VALUES (?,?,?,?,?)"))
				{
					$stmt_insert->bind_param("sssss",$record,$language,$message,$date,$time);
					
					if($stmt_insert->execute())
					{
						return $stmt_insert->insert_id;
					}
						return false;
				} 	
			}
			function get_all_customer_info_for_agreement($id)
			{	
				if($stmt_insert = $this->con->prepare("SELECT `id`,`name`, `office_name`,`email`, `address`, `primary_contact_no`, `other_contact_no`,`logo` FROM `customers` where `id` = ?"))
				{	
					$stmt_insert->bind_param("i",$id);
					
					$stmt_insert->bind_result($id,$name,$shop_name,$email,$address,$primary_contact,$other_contact,$logo);

					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$name;
							$details[$counter][2]	=	$shop_name;
							$details[$counter][3]	=	$email;
							$details[$counter][4]	=	$address;
							$details[$counter][5]	=	$primary_contact;
							$details[$counter][6]	=	$other_contact;
							$details[$counter][7]	=	$logo;
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			function add_bank_details($b_name,$acc_name,$acc_no,$ifsc_code,$branch_name,$other_info)
			{							
				$date = date("Y-m-d");
				$time = date("H-i-s A");
				if($stmt_insert = $this->con->prepare("INSERT INTO `bank_details`(`bank_name`, `account_name`,`account_no`, `ifsc_code`, `branch_name`,`other_info`, `date`, `time`) VALUES (?,?,?,?,?,?,?,?)"))
				{
					$stmt_insert->bind_param("ssssssss",$b_name,$acc_name,$acc_no,$ifsc_code,$branch_name,$other_info,$date,$time);
					
					if($stmt_insert->execute())
					{
						return true;
					}
						return false;
				} 	
			}
			function get_all_bank_information()
			{	
				if($stmt_insert = $this->con->prepare("SELECT `id`,`bank_name`, `account_name`,`account_no`, `ifsc_code`, `branch_name`,`other_info` FROM `bank_details`"))
				{	
					$stmt_insert->bind_result($id,$bank_name,$account_name,$account_no,$ifsc_code,$branch_name,$other_info);
					
					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$bank_name;
							$details[$counter][2]	=	$account_name;
							$details[$counter][3]	=	$account_no;
							$details[$counter][4]	=	$ifsc_code;
							$details[$counter][5]	=	$branch_name;
							$details[$counter][6]	=	$other_info;
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			function delete_bank_details($del_id)
			{
				if($stmt_select = $this->con->prepare("Delete from `bank_details` where `id`=?"))
				{
					$stmt_select->bind_param("i",$del_id);
				
					if($stmt_select->execute())
					{					
							return true;
					}
						return false;
				}
			}
			function get_all_bank_information_by_id($up_id)
			{	
				if($stmt_insert = $this->con->prepare("SELECT `id`,`bank_name`, `account_name`,`account_no`, `ifsc_code`, `branch_name`,`other_info` FROM `bank_details` Where `id` =?"))
				{	
					$stmt_insert->bind_param("i",$up_id);
					
					$stmt_insert->bind_result($id,$bank_name,$account_name,$account_no,$ifsc_code,$branch_name,$other_info);
					
					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$bank_name;
							$details[$counter][2]	=	$account_name;
							$details[$counter][3]	=	$account_no;
							$details[$counter][4]	=	$ifsc_code;
							$details[$counter][5]	=	$branch_name;
							$details[$counter][6]	=	$other_info;
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			function update_bank_details($up_id,$b_name,$acc_name,$acc_no,$ifsc_code,$branch_name,$other_info)
			{	
				if($stmt_insert = $this->con->prepare("update `bank_details` set `bank_name` = ?, `account_name` = ?,`account_no` = ?, `ifsc_code` = ?, `branch_name` = ?,`other_info` = ? Where `id` = ?"))
				{
					$stmt_insert->bind_param("ssssssi",$b_name,$acc_name,$acc_no,$ifsc_code,$branch_name,$other_info,$up_id);
					
					if($stmt_insert->execute())
					{
						return true;
					}
						return false;
				} 	
			}
			function only_customers_by_id_and_name($cust_name,$cust_id)
			{
				if($stmt_insert = $this->con->prepare("SELECT `id`, `name` FROM `customers` Where `name` LIKE '%$cust_name%' AND `id` LIKE '%$cust_id%'"))
				{
					$stmt_insert->bind_result($id,$name);
				
					if($stmt_insert->execute())
					{
						$counter	=	0;
						$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$name;
							$counter++;
						}
					if(!empty($details))	
					{
						return $details;
					}
					return false;
					}	
				}
		
			}
			function add_quotation_information()
			{		
				if($stmt_insert = $this->con->prepare("SELECT `id`, `cust_id`, `cust_name`, `service_id`, `service_name`, `comment`, `actual_amount`, `discount_amount` FROM `tmp_quotation` "))
				{	
					$stmt_insert->bind_result($id,$cust_id,$cust_name,$service_no,$service_name,$comment,$actual_amount,$discount_amount);
					
					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$cust_id;
							$details[$counter][2]	=	$cust_name;
							$details[$counter][3]	=	$service_no;
							$details[$counter][4]	=	$service_name;
							$details[$counter][5]	=	$comment;
							$details[$counter][6]	=	$actual_amount;
							$details[$counter][7]	=	$discount_amount;
							
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			function insert_quotation_details($c_id,$actual_amount,$discount_amount)
			{							
				$date = date("Y-m-d");
				$time = date("H-i-s A");
				if($stmt_insert = $this->con->prepare("INSERT INTO `quotation`(`cust_id`, `actual_amount`, `discount_amount`,`date` ,`time`) VALUES (?,?,?,?,?)"))
				{
					$stmt_insert->bind_param("sssss",$c_id,$actual_amount,$discount_amount,$date,$time);
					
					if($stmt_insert->execute())
					{
						return $stmt_insert->insert_id;
					}
						return false;
				} 	
			}
			function add_quotation_cart($insert_id,$cust_id,$customer_name,$service,$service_name,$comment,$amount,$d_amount)
			{							
				$date = date("Y-m-d");
				$time = date("H-i-s A");
				if($stmt_insert = $this->con->prepare("INSERT INTO `quotation_cart`(`transaction_id`,`cust_id`, `cust_name`, `service_id`, `service_name`, `comment`, `actual_amount`, `discount_amount`, `date`, `time`) VALUES (?,?,?,?,?,?,?,?,?,?)"))
				{
					$stmt_insert->bind_param("ssssssssss",$insert_id,$cust_id,$customer_name,$service,$service_name,$comment,$amount,$d_amount,$date,$time);
					
					if($stmt_insert->execute())
					{
						return true;
					}
						return false;
				} 	
			}
			function fetch_quotation_information()
			{	
				if($stmt_insert = $this->con->prepare("SELECT `id`, `cust_id`, `cust_name`, `service_id`, `service_name`,`comment`, SUM(`actual_amount`), SUM(`discount_amount`) FROM `tmp_quotation`"))
				{	
					$stmt_insert->bind_result($id,$cust_id,$cust_name,$service_no,$service_name,$comment,$actual_amount,$discount_amount);
					
					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$cust_id;
							$details[$counter][2]	=	$cust_name;
							$details[$counter][3]	=	$service_no;
							$details[$counter][4]	=	$service_name;
							$details[$counter][5]	=	$comment;
							$details[$counter][6]	=	$actual_amount;
							$details[$counter][7]	=	$discount_amount;
							
						
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			function get_quotation_information()
			{
				if($stmt_insert = $this->con->prepare("SELECT `id`, `cust_id`, `actual_amount`, `discount_amount` FROM `quotation`"))
				{	
					$stmt_insert->bind_result($id,$cust_id,$actual_amount,$discount_amount);
					
					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$cust_id;	
							$details[$counter][2]	=	$actual_amount;
							$details[$counter][3]	=	$discount_amount;
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			function fetch_quotation_services_id_by_cust_id($c_id)
			{
				if($stmt_select = $this->con->prepare("Select `service_id` from `quotation_cart` where `transaction_id` = ? "))
				{	
					$stmt_select->bind_param("s",$c_id);
				
					$stmt_select->bind_result($service);
				
					if($stmt_select->execute())
					{	
						$count = 0;
						$data = array();
						while($stmt_select->fetch())
						{	
							$data[$count][0] = $service;
							$count++;
						}
						if(!empty($data))
						{
							return $data;
						}
					}
							return false;
				}
			}
			function delete_quotation_cart($del_id)
			{
				if($stmt_select = $this->con->prepare("Delete from `quotation_cart` where `transaction_id`=?"))
				{
					$stmt_select->bind_param("s",$del_id);
				
					if($stmt_select->execute())
					{					
							return true;
					}
						return false;
				}
			}
			function delete_quotation($del_id)
			{
				if($stmt_select = $this->con->prepare("Delete from `quotation` where `id`=?"))
				{
					$stmt_select->bind_param("i",$del_id);
				
					if($stmt_select->execute())
					{					
							return true;
					}
						return false;
				}
			}
			function fetch_quotationcart__information($up_id)
			{	
				if($stmt_insert = $this->con->prepare("SELECT `id`, `cust_id`, `cust_name`, `service_id`, `service_name`,`comment`, SUM(`actual_amount`), SUM(`discount_amount`) FROM `quotation_cart` Where `transaction_id` = ?"))
				{	
					$stmt_insert->bind_param("s",$up_id);
					
					$stmt_insert->bind_result($id,$cust_id,$cust_name,$service_no,$service_name,$comment,$actual_amount,$discount_amount);
					
					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$cust_id;
							$details[$counter][2]	=	$cust_name;
							$details[$counter][3]	=	$service_no;
							$details[$counter][4]	=	$service_name;
							$details[$counter][5]	=	$comment;
							$details[$counter][6]	=	$actual_amount;
							$details[$counter][7]	=	$discount_amount;
							
						
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			function update_quotation_info($up_id,$cust_id,$amount,$d_amount)
			{								
				if($stmt_insert = $this->con->prepare("update `quotation` set `cust_id` = ?, `actual_amount` = ?, `discount_amount` = ? Where `id` = ?"))
				{
					$stmt_insert->bind_param("sssi",$cust_id,$amount,$d_amount,$up_id);
					
					if($stmt_insert->execute())
					{
						return true;
					}
						return false;
				} 	
			}
			function fetch_qutotation_cart_data_for_update($id)
			{	
				if($stmt_insert = $this->con->prepare("SELECT `id`,`transaction_id`, `cust_id`,`service_id`,`actual_amount`,`discount_amount` FROM `quotation_cart` Where `id` = ?"))
				{	
					$stmt_insert->bind_param("i",$id);
					
					$stmt_insert->bind_result($id,$t_id,$c_id,$service,$actual_amount,$discount_amount);
					
					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$t_id;
							$details[$counter][2]	=	$c_id;
							$details[$counter][3]	=	$service;
							$details[$counter][4]	=	$actual_amount;
							$details[$counter][5]	=	$discount_amount;
							
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			function fetch_actual_qutotation_amount_by_id($c_id)
			{
				if($stmt_select = $this->con->prepare("Select `actual_amount` from `quotation` where `id` = ? "))
				{	
					$stmt_select->bind_param("i",$c_id);
				
					$stmt_select->bind_result($result_password);
				
					if($stmt_select->execute())
					{
						if($stmt_select->fetch())
						{
							return $result_password;
						}
					}
							return false;
				}
			}
			function fetch_discount_qutotation_amount_by_id($c_id)
			{
				if($stmt_select = $this->con->prepare("Select `discount_amount` from `quotation` where `id` = ? "))
				{	
					$stmt_select->bind_param("i",$c_id);
				
					$stmt_select->bind_result($result_password);
				
					if($stmt_select->execute())
					{
						if($stmt_select->fetch())
						{
							return $result_password;
						}
					}
							return false;
				}
			}
			function update_amount_in_quotation_details($up_id,$actual_amount,$discount_amount)
			{	
				if($stmt_insert = $this->con->prepare("Update `quotation` set  `actual_amount` = ?, `discount_amount` = ? Where `id` = ?"))
				{						
					$stmt_insert->bind_param("ssi",$actual_amount,$discount_amount,$up_id);
					
					if($stmt_insert->execute())
					{
						return true;
					}
						return false;
				} 	
			}
			function delete_quotation_cart_by_id($del_id)
			{
				if($stmt_select = $this->con->prepare("Delete from `quotation_cart` where `id`=?"))
				{
					$stmt_select->bind_param("i",$del_id);
				
					if($stmt_select->execute())
					{					
							return true;
					}
						return false;
				}
			}
			function get_all_tmp_quotation_information($c_name,$date_to,$date_from,$service)
			{	
				if($service=="select")
				{
					$service ="";
				}
			
				if($stmt_insert = $this->con->prepare("SELECT `id`, `cust_id`, `cust_name`, `service_id`, `service_name`,`comment`, `actual_amount`, `discount_amount`, `date`, `time` FROM `tmp_quotation` WHERE `cust_name` LIKE '%$c_name%' AND `date` BETWEEN '$date_from' AND '$date_to' AND `service_name` LIKE '%$service%'"))
				{	
					$stmt_insert->bind_result($id,$cust_id,$cust_name,$service_no,$service_name,$comment,$actual_amount,$discount_amount,$date,$time);
					
					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$cust_id;
							$details[$counter][2]	=	$cust_name;
							$details[$counter][3]	=	$service_no;
							$details[$counter][4]	=	$service_name;
							$details[$counter][5]	=	$comment;
							$details[$counter][6]	=	$actual_amount;
							$details[$counter][7]	=	$discount_amount;
							$details[$counter][8]	=	$date;
							$details[$counter][9]	=	$time;
						
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			function check_id_exists_or_not($p_id)
			{
				if($stmt_select = $this->con->prepare("Select `id` from `create_link` where `p_id` = ? "))
				{	
					$stmt_select->bind_param("s",$p_id);
				
					$stmt_select->bind_result($result_password);
				
					if($stmt_select->execute())
					{
						if($stmt_select->fetch())
						{
							return $result_password;
						}
					}
							return false;
				}
			}
			function create_update_link($p_name,$s_code)
			{							
				$date = date("Y-m-d");
				$time = date("H-i-s A");
				if($stmt_insert = $this->con->prepare("INSERT INTO `create_link`(`p_id`, `security_code`, `date`, `time`) VALUES (?,?,?,?)"))
				{
					$stmt_insert->bind_param("ssss",$p_name,$s_code,$date,$time);
					
					if($stmt_insert->execute())
					{
						return true;
					}
						return false;
				} 	
			}
			function get_all_created_link($pro_id,$from_date,$to_date)
			{	
				$from_date = date("Y-m-d" , strtotime($from_date));
				$to_date = date("Y-m-d" , strtotime($to_date));
				if($stmt_insert = $this->con->prepare("SELECT `id`,`p_id`, `security_code` FROM `create_link` Where `p_id` LIKE '%$pro_id%' AND `date` BETWEEN '$from_date' AND '$to_date'"))
				{	
					$stmt_insert->bind_result($id,$p_id,$security_code);
					
					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$p_id;
							$details[$counter][2]	=	$security_code;
							
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			function fetch_customer_id_by_p_id($p_id)
			{
				if($stmt_select = $this->con->prepare("Select `customer_name` from `customer_services` where `id` = ? "))
				{	
					$stmt_select->bind_param("s",$p_id);
				
					$stmt_select->bind_result($result_password);
				
					if($stmt_select->execute())
					{
						if($stmt_select->fetch())
						{
							return $result_password;
						}
					}
							return false;
				}
			}
			function fetch_project_name_by_customer_services($project_id)
			{
				if($stmt_select = $this->con->prepare("Select `project_name` from `customer_services` where `id` = ? "))
				{	
					$stmt_select->bind_param("i",$project_id);
				
					$stmt_select->bind_result($result_password);
				
					if($stmt_select->execute())
					{
						if($stmt_select->fetch())
						{
							return $result_password;
						}
					}
							return false;
				}
			}
			function get_all_created_link_by_id($up_id)
			{	
				if($stmt_insert = $this->con->prepare("SELECT `id`,`p_id`, `security_code` FROM `create_link` Where `id` = ?"))
				{	
					$stmt_insert->bind_param("i",$up_id);
					
					$stmt_insert->bind_result($id,$p_id,$security_code);
					
					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$p_id;
							$details[$counter][2]	=	$security_code;
							
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			function update_created_link($up_id,$p_name,$s_code)
			{	
				if($stmt_insert = $this->con->prepare("Update `create_link` set `p_id` = ?, `security_code` = ? Where `id` = ?"))
				{
					$stmt_insert->bind_param("ssi",$p_name,$s_code,$up_id);
					
					if($stmt_insert->execute())
					{
						return true;
					}
						return false;
				} 	
			}
			function delete_create_link($del_id)
			{
				if($stmt_select = $this->con->prepare("Delete from `create_link` where `id`=?"))
				{
					$stmt_select->bind_param("i",$del_id);
				
					if($stmt_select->execute())
					{					
							return true;
					}
						return false;
				}
			}
			function fetch_project_name_by_college_students($project_id)
			{
				if($stmt_select = $this->con->prepare("Select `project_name` from `projects` where `id` = ? "))
				{	
					$stmt_select->bind_param("i",$project_id);
				
					$stmt_select->bind_result($result_password);
				
					if($stmt_select->execute())
					{
						if($stmt_select->fetch())
						{
							return $result_password;
						}
					}
							return false;
				}
			}
			function fetch_student_name_by_college_students($project_id)
			{
				if($stmt_select = $this->con->prepare("Select `student1_name`,`student2_name`,`student3_name`,`student4_name`,`student5_name` from `projects` where `id` = ? "))
				{	
					$stmt_select->bind_param("i",$project_id);
				
					$stmt_select->bind_result($student1_name,$student2_name,$student3_name,$student4_name,$student5_name);
				
					if($stmt_select->execute())
					{
						$data 		= array();
						if($stmt_select->fetch())
						{
							$data[0]	=	$student1_name;
							$data[1]	=	$student2_name;
							$data[2]	=	$student3_name;
							$data[3]	=	$student4_name;
							$data[4]	=	$student5_name;
							
						}
						if(!empty($data))
						{
							return $data;
						}
					}
							return false;
				}
			}
			function fetch_security_code_by_id($project_id)
			{
				if($stmt_select = $this->con->prepare("Select `security_code` from `create_link` where `id` = ? "))
				{	
					$stmt_select->bind_param("i",$project_id);
				
					$stmt_select->bind_result($result_password);
				
					if($stmt_select->execute())
					{
						if($stmt_select->fetch())
						{
							return $result_password;
						}
					}
							return false;
				}
			}
			function get_password_from_customer_id($email)
			{
				if($stmt_select = $this->con->prepare("Select `password` from `customers` where `id` = ? "))
				{	
					$stmt_select->bind_param("s",$email);
				
					$stmt_select->bind_result($result_password);
				
					if($stmt_select->execute())
					{
						if($stmt_select->fetch())
						{
							return $result_password;
						}
					}
							return false;
				}
			}
			function change_customer_password($email,$password)
			{ 
				$date = date("Y-m-d");
				$time = date("H:i:s A");
			
				if($stmt_select = $this->con->prepare("update `customers` set `password`='".$password."' where `id` = ?"))
				{
					$stmt_select->bind_param("i",$email);				
				
					if($stmt_select->execute())
					{					
						return true;
					}
						return false;
				}
			}
			function get_all_service_information_for_customer_display($email)
			{	
				if($stmt_insert = $this->con->prepare("SELECT `id`,`customer_name`, `service`, `project_name`,`amount`,`status` FROM `customer_services` Where `customer_name` = ?"))
				{	
					$stmt_insert->bind_param("s",$email);
					
					$stmt_insert->bind_result($id,$customer_name,$service,$p_name,$amount,$status);
					
					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$customer_name;
							$details[$counter][2]	=	$service;
							$details[$counter][3]	=	$p_name;
							$details[$counter][4]	=	$amount;
							$details[$counter][5]	=	$status;
					
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			function get_all_payment_information_for_customer_display($id)
			{	
				if($stmt_insert = $this->con->prepare("SELECT `id`, `services_id`, `cust_id`, `cust_name`, `service_no`, `service_name`,`project_name`, `opening_amount`, `paid_amount`, `bal_amount`,`status`, `date`, `time` FROM `payment_report` Where `services_id` = ? "))
				{	
					$stmt_insert->bind_param("s",$id);
					
					$stmt_insert->bind_result($id,$services_id,$cust_id,$cust_name,$service_no,$service_name,$p_name,$opening_amount,$paid_amount,$bal_amount,$status,$date,$time);
					
					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$services_id;
							$details[$counter][2]	=	$cust_id;
							$details[$counter][3]	=	$cust_name;
							$details[$counter][4]	=	$service_no;
							$details[$counter][5]	=	$service_name;
							$details[$counter][6]	=	$p_name;
							$details[$counter][7]	=	$opening_amount;
							$details[$counter][8]	=	$paid_amount;
							$details[$counter][9]	=	$bal_amount;
							$details[$counter][10]	=	$status;
							$details[$counter][11]	=	$date;
							$details[$counter][12]	=	$time;
						
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			function fetch_project_name_by_cust_id($email)
			{
				if($stmt_select = $this->con->prepare("Select `project_name` from `customer_services` where `id` = ? "))
				{	
					$stmt_select->bind_param("i",$email);
				
					$stmt_select->bind_result($result_password);
				
					if($stmt_select->execute())
					{
						if($stmt_select->fetch())
						{
							return $result_password;
						}
					}
							return false;
				}
			}
			function fetch_total_amount_by_cust_id($email)
			{
				if($stmt_select = $this->con->prepare("Select `amount` from `customer_services` where `id` = ? "))
				{	
					$stmt_select->bind_param("i",$email);
				
					$stmt_select->bind_result($result_password);
				
					if($stmt_select->execute())
					{
						if($stmt_select->fetch())
						{
							return $result_password;
						}
					}
							return false;
				}
			}
			function add_project_updates($c_id,$project_id,$updates,$attachment)
			{							
				$date = date("Y-m-d");
				$time = date("H-i-s A");
				$status = "Pending";
				if($stmt_insert = $this->con->prepare("INSERT INTO `project_updates`(`customer_id`,`project_id`, `update_details`,`attachment`, `status`, `date`, `time`) VALUES (?,?,?,?,?,?,?)"))
				{
					$stmt_insert->bind_param("sssssss",$c_id,$project_id,$updates,$attachment,$status,$date,$time);
					
					if($stmt_insert->execute())
					{
						return true;
					}
						return false;
				} 	
			}
			function get_all_updated_services_by_customer_id($c_id,$project_id)
			{	
				if($stmt_insert = $this->con->prepare("SELECT `id`,`customer_id`,`project_id`,`update_details`,`attachment`,`status`,`date` FROM `project_updates` Where `customer_id` = ? AND `project_id` = ? ORDER BY `id` DESC"))
				{	
					$stmt_insert->bind_param("ss",$c_id,$project_id);
					
					$stmt_insert->bind_result($id,$customer_id,$project_id,$update_details,$attachment,$status,$date);
					
					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$customer_id;
							$details[$counter][2]	=	$project_id;
							$details[$counter][3]	=	$update_details;
							$details[$counter][4]	=	$attachment;
							$details[$counter][5]	=	$status;
							$details[$counter][6]	=	$date;
							
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			function delete_updates_info($del_id)
			{
				if($stmt_select = $this->con->prepare("Delete from `project_updates` where `id`=?"))
				{
					$stmt_select->bind_param("i",$del_id);
				
					if($stmt_select->execute())
					{					
							return true;
					}
						return false;
				}
			}
			function get_all_updated_services_by_customer_id_by_id($c_id)
			{	
				if($stmt_insert = $this->con->prepare("SELECT `id`,`update_details`,`attachment` FROM `project_updates` Where `id` = ?"))
				{	
					$stmt_insert->bind_param("i",$c_id);
					
					$stmt_insert->bind_result($id,$update_details,$attachment);
					
					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;	
							$details[$counter][1]	=	$update_details;
							$details[$counter][2]	=	$attachment;
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			function update_projects_updates($update_id,$updates)
			{							
				$date = date("Y-m-d");
				$time = date("H-i-s A");
				$status = "Pending";
				if($stmt_insert = $this->con->prepare("Update `project_updates` set `update_details` = ? Where `id` = ?"))
				{
					$stmt_insert->bind_param("si",$updates,$update_id);
					
					if($stmt_insert->execute())
					{
						return true;
					}
						return false;
				} 	
			}
			function update_attachment_in_project_updates($update_id)
			{		
				$actual_image_name = "";					
				if($stmt_insert = $this->con->prepare("Update `project_updates` set `attachment`=? Where `id`=?"))
				{
					$stmt_insert->bind_param("si",$actual_image_name,$update_id);
					
					if($stmt_insert->execute())
					{
						return true;
					}
						return false;
				} 	
			}
			function get_attachment_in_project__updates($update_id)
			{
				if($stmt_select = $this->con->prepare("Select `attachment` from `project_updates` where `id` = ? "))
				{	
					$stmt_select->bind_param("i",$update_id);
				
					$stmt_select->bind_result($result_image);
				
					if($stmt_select->execute())
					{
						if($stmt_select->fetch())
						{
							return $result_image;
						}
					}
							return false;
				}
			}
			function update_project_update_attachement($update_id,$actual_image_name)
			{							
				if($stmt_insert = $this->con->prepare("Update `project_updates` set `attachment`=? Where `id`=?"))
				{
					$stmt_insert->bind_param("si",$actual_image_name,$update_id);
					
					if($stmt_insert->execute())
					{
						return true;
					}
						return false;
				} 	
			}
			function get_all_updated_services_by_admin_panel($from_date,$to_date)
			{	
				$from_date = date("Y-m-d" , strtotime($from_date));
				$to_date = date("Y-m-d" , strtotime($to_date));
				if($stmt_insert = $this->con->prepare("SELECT `id`,`customer_id`,`project_id`,`update_details`,`attachment`,`status`,`date`,`time` FROM `project_updates` WHERE `date` BETWEEN '$from_date' AND '$to_date' ORDER BY `id` DESC"))
				{	
					$stmt_insert->bind_result($id,$customer_id,$project_id,$update_details,$attachment,$status,$date,$time);
					
					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$customer_id;
							$details[$counter][2]	=	$project_id;
							$details[$counter][3]	=	$update_details;
							$details[$counter][4]	=	$attachment;
							$details[$counter][5]	=	$status;
							$details[$counter][6]	=	$date;
							$details[$counter][7]	=	$time;
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			function get_all_service_information_by_id($id)
			{	
				if($stmt_insert = $this->con->prepare("SELECT `id`,`customer_name`, `service`, `project_name`,`amount`,`status` FROM `customer_services` Where `id` = ?"))
				{	
					$stmt_insert->bind_param("i",$id);
					
					$stmt_insert->bind_result($id,$customer_name,$service,$p_name,$amount,$status);
					
					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$customer_name;
							$details[$counter][2]	=	$service;
							$details[$counter][3]	=	$p_name;
							$details[$counter][4]	=	$amount;
							$details[$counter][5]	=	$status;
					
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			function update_project_status_work_in_progress($app_id)
			{
				$status = "Work in Progress";
				if($stmt_select = $this->con->prepare("Update `project_updates` set `status`= ? where `id`=?"))
				{
					$stmt_select->bind_param("si",$status,$app_id);
				
					if($stmt_select->execute())
					{				
							return true;
					}
						return false;
				}
			}
			function update_project_status_pending($app_id)
			{
				$status = "Pending";
				if($stmt_select = $this->con->prepare("Update `project_updates` set `status`= ? where `id`=?"))
				{
					$stmt_select->bind_param("si",$status,$app_id);
				
					if($stmt_select->execute())
					{				
							return true;
					}
						return false;
				}
			}
			function update_project_status_complete($app_id)
			{
				$status = "Complete";
				if($stmt_select = $this->con->prepare("Update `project_updates` set `status`= ? where `id`=?"))
				{
					$stmt_select->bind_param("si",$status,$app_id);
				
					if($stmt_select->execute())
					{				
							return true;
					}
						return false;
				}
			}
			function get_pending_updates_count()
			{
				if($stmt_select = $this->con->prepare("Select COUNT(`id`) from `project_updates` where `status` = 'Pending'"))
				{	
					$stmt_select->bind_result($result_password);
				
					if($stmt_select->execute())
					{
						if($stmt_select->fetch())
						{
							return $result_password;
						}
					}
							return false;
				}
			}
			function get_work_in_progress_updates_count()
			{
				if($stmt_select = $this->con->prepare("Select COUNT(`id`) from `project_updates` where `status` = 'Work in Progress'"))
				{	
					$stmt_select->bind_result($result_password);
				
					if($stmt_select->execute())
					{
						if($stmt_select->fetch())
						{
							return $result_password;
						}
					}
							return false;
				}
			}
			function fetch_quotation_id_by_cust_id($c_id)
			{
				if($stmt_select = $this->con->prepare("Select `cust_id` from `quotation` where `id` = ? "))
				{	
					$stmt_select->bind_param("i",$c_id);
				
					$stmt_select->bind_result($result_password);
				
					if($stmt_select->execute())
					{
						if($stmt_select->fetch())
						{
							return $result_password;
						}
					}
							return false;
				}
			}
			function fetch_quotation_cart_data_by_cust_id($c_id)
			{	
				if($stmt_insert = $this->con->prepare("SELECT `id`,`transaction_id`,`cust_id`,`service_name`,`actual_amount`,`discount_amount` FROM `quotation_cart` Where `transaction_id` = ?"))
				{	
					$stmt_insert->bind_param("s",$c_id);
					
					$stmt_insert->bind_result($id,$t_id,$c_id,$service,$actual_amount,$discount_amount);
					
					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$c_id;
							$details[$counter][2]	=	$c_id;
							$details[$counter][3]	=	$service;
							$details[$counter][4]	=	$actual_amount;
							$details[$counter][5]	=	$discount_amount;
							
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			function new_offer_letter_data($text1)
			{							
				$date = date("Y-m-d");
				$time = date("H-i-s A");
				if($stmt_insert = $this->con->prepare("INSERT INTO `offer_letters`(`text1`, `date`, `time`) VALUES (?,?,?)"))
				{
					$stmt_insert->bind_param("sss",$text1,$date,$time);
					
					if($stmt_insert->execute())
					{
						return true;
					}
						return false;
				} 	
			}
			function fetch_offer_letter_data()
			{	
				if($stmt_insert = $this->con->prepare("SELECT `id`, `text1`, `date`, `time` FROM `offer_letters`"))
				{	
					$stmt_insert->bind_result($id,$text1,$date,$time);
					
					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;	
							$details[$counter][1]	=	$text1;
							$details[$counter][2]	=	$date;
							$details[$counter][3]	=	$time;
							
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			function delete_offer_letter_data($del_id)
			{
				if($stmt_select = $this->con->prepare("Delete from `offer_letters` where `id`=?"))
				{
					$stmt_select->bind_param("i",$del_id);
				
					if($stmt_select->execute())
					{					
							return true;
					}
						return false;
				}
			}
			function fetch_gender_by_id($c_id)
			{
				if($stmt_select = $this->con->prepare("Select `gender` from `employees` where `id` = ? "))
				{	
					$stmt_select->bind_param("i",$c_id);
				
					$stmt_select->bind_result($result_password);
				
					if($stmt_select->execute())
					{
						if($stmt_select->fetch())
						{
							return $result_password;
						}
					}
							return false;
				}
			}
			function update_offer_letter_data($up_id,$text1)
			{
				if($stmt_insert = $this->con->prepare("Update `offer_letters` set `text1` = ? Where `id` = ?"))
				{
					$stmt_insert->bind_param("si",$text1,$up_id);
					
					if($stmt_insert->execute())
					{
						return true;
					}
						return false;
				} 	
			}
			function fetch_offer_letter_data_by_id($update_id)
			{	
				if($stmt_insert = $this->con->prepare("SELECT `id`, `text1` FROM `offer_letters` Where `id` = ?"))
				{	
					$stmt_insert->bind_param("i",$update_id);
					
					$stmt_insert->bind_result($id,$text1);
					
					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;	
							$details[$counter][1]	=	$text1;
							
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			
			function fetch_employee_data_for_offer_letter($id)
			{	
				if($stmt_insert = $this->con->prepare("SELECT `id`,`full_name`, `email`, `contact`, `address`, `gender`, `dob`, `city`, `state`, `country`, `pincode`, `aadhar_no`, `id_size_photo`, `aadhar_attachment`, `attachment1`, `attachment2`, `attachment3`, `designation`, `joining_date`, `working_technology`, `salary`, `remark`,`job_location` FROM `employees` WHERE `id` = ?"))
				{	
					$stmt_insert->bind_param("i",$id);
					
					$stmt_insert->bind_result($id,$full_name,$email,$primary_contact,$address,$gender,$dob,$city,$state,$country,$pincode,$aadhar_no,$photo,$addhar_attachment,$attachment1,$attachment2,$attachment3,$designation,$joining_date,$technology,$salary,$remark,$location);
					
					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$full_name;
							$details[$counter][2]	=	$email;
							$details[$counter][3]	=	$primary_contact;
							$details[$counter][4]	=	$address;
							$details[$counter][5]	=	$gender;
							$details[$counter][6]	=	$dob;
							$details[$counter][7]	=	$city;
							$details[$counter][8]	=	$state;
							$details[$counter][9]	=	$country;
							$details[$counter][10]	=	$pincode;
							$details[$counter][11]	=	$aadhar_no;
							$details[$counter][12]	=	$photo;
							$details[$counter][13]	=	$addhar_attachment;
							$details[$counter][14]	=	$attachment1;
							$details[$counter][15]	=	$attachment2;
							$details[$counter][16]	=	$attachment3;
							$details[$counter][17]	=	$designation;
							$details[$counter][18]	=	$joining_date;
							$details[$counter][19]	=	$technology;
							$details[$counter][20]	=	$salary;
							$details[$counter][21]	=	$remark;
							$details[$counter][22]	=	$location;
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
	}
?>