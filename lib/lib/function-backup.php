function get_delivery_boy_details()
	{
		if($stmt=$this->con->prepare("SELECT `id`, `name`, `contact_no`, `delivery_boy_id`, `password`, `address`, `date`, `time` FROM `add_delivery_boy` "))
		{
		 $stmt->bind_result($res_id,$name,$contact_no,$delivery_boy_id,$password,$address,$date,$time);
			
			if($stmt->execute())
			{
					
				$getdata	=	array();
				$counter	=	0;
				while($stmt->fetch())
				{
					
						$getdata[$counter][0]	=$res_id;
						$getdata[$counter][1]	=$name;
						$getdata[$counter][2]	=$contact_no;
						$getdata[$counter][3]	=$delivery_boy_id;
						$getdata[$counter][4]	=$password;
						$getdata[$counter][5]	=$address;
						$getdata[$counter][6]	=$date;
						$getdata[$counter][7]	=$time;
						
						$counter++;
				}
				if(!empty($getdata))
				{
					return $getdata;
				}
				else
				{
					return false;
				}
			}
			
		}
	}
	
	function delete_delivery_boy_record($delete_id)
	{
		if($stmt= $this->con->prepare("DELETE FROM `add_delivery_boy` WHERE `id`=?"))
		 {
			$stmt->bind_param("i",$delete_id);
			if($stmt->execute())
			{
				return true;
			}
		}
		else
		{
		return false;
		}
	}
	
	function get_delivery_boy_report_by_search_details($from_date,$to_date,$name,$delivery_boy_id)
	{
		if($stmt=$this->con->prepare("SELECT `id`, `name`, `contact_no`, `delivery_boy_id`, `password`, `address`, `date`, `time` FROM `add_delivery_boy` WHERE  WHERE (`date` BETWEEN ? AND ?) AND `name` LIKE '%".$name."%' AND `delivery_boy_id` LIKE '%".$delivery_boy_id."%' "))
		{	
			$stmt->bind_param("ss",$from_date,$to_date);
			
			$stmt->bind_result($res_id,$name,$contact_no,$delivery_boy_id,$password,$address,$date,$time);
				
				if($stmt->execute())
				{
					$getdata=	array();
					$counter	=	0;
					
					while($stmt->fetch())
					{
						$getdata[$counter][0]	=$res_id;
						$getdata[$counter][1]	=$name;
						$getdata[$counter][2]	=$contact_no;
						$getdata[$counter][3]	=$delivery_boy_id;
						$getdata[$counter][4]	=$password;
						$getdata[$counter][5]	=$address;
						$getdata[$counter][6]	=$date;
						$getdata[$counter][7]	=$time;
						
						$counter++;
					}
					if(!empty($getdata))
					{
						return $getdata;
					}
					else
					{
						return false;
					}
				}
		}
	}
	
	function add_updated_delivery_boy_records($name,$contact_no,$delivery_boy_id,$password,$address,$edit_id)
	{
		$date = date("Y-m-d");
		$time = date("h:i:s");
		
		if($stmt=$this->con->prepare("UPDATE `add_delivery_boy` SET `name`=?,`contact_no`=?,`delivery_boy_id`=?,`password`=?,`address`=?,`date`=?,`time`=? WHERE `id`=?"))
		{
			$stmt->bind_param("sssssssi",$name,$contact_no,$delivery_boy_id,$password,$address,$date,$time,$edit_id);
			if($stmt->execute())
			{
				return true;
			}
		}
		else
		{
			return false;
		}
	}
	
	function get_delivery_boy_records_to_update($edit_id)
	{
		if($stmt=$this->con->prepare("SELECT `id`, `name`, `contact_no`, `delivery_boy_id`, `password`, `address` FROM `add_delivery_boy` WHERE `id`=?"))
		{
			
			$stmt->bind_param("i",$edit_id);
			
			$stmt->bind_result($res_id,$name,$contact_no,$delivery_boy_id,$password,$address);
			if($stmt->execute())
			{
				$getdata	=	array();
				if($stmt->fetch())
				{
						$getdata[0]	=$res_id;
						$getdata[1]	=$name;
						$getdata[2]	=$contact_no;
						$getdata[3]	=$delivery_boy_id;
						$getdata[4]	=$password;
						$getdata[5]	=$address;
						
					return $getdata;
				}
			}
		}
	}