<?php
//error_reporting(0);
	include('connection.php');
	
	if($_SERVER['REQUEST_METHOD'] === 'POST'){
		
		
		
		$PRICE_S = $_POST['PRICE_S'];
		$PRICE_E = $_POST['PRICE_E'];
		$BEDS_S = $_POST['BEDS_S'];
		$BEDS_E = $_POST['BEDS_E'];
		$BATHS_S = $_POST['BATHS_S'];
		$BATHS_E = $_POST['BATHS_E'];
		$TOLET_TYPE_ID = $_POST['TOLET_TYPE_ID'];
		$AVAILABLE_FROM_S = $_POST['AVAILABLE_FROM_S'];
		$AVAILABLE_FROM_E = $_POST['AVAILABLE_FROM_E'];
		
		$json_array= array();
		if($PRICE_S != "" || $PRICE_E != ""){
			
			if($TOLET_TYPE_ID  != "" ){
				
				if($BEDS_S != "" || $BEDS_E != ""){
					
					if($BATHS_S != "" || $BATHS_E != ""){
						
						if($AVAILABLE_FROM_S != "" || $AVAILABLE_FROM_E != "")
						{
							
							$checkSQL1="SELECT a.TOLET_INFO_ID,a.USER_ACC_ID,a.TOLET_NAME,a.TOLET_DETAILS,a.ADDRESS,
								a.LATTITUDE,a.LOGLITUTDE,a.PRICE,a.BATHS,a.BEDS,a.FLOORS,a.AVAILABLE_FROM,
								a.CONTACT_PERSON_NM, a.CONTACT_PERSON_PHN,a.CONTACT_PERSON_EML,a.TOLET_TYPE_ID,
								a.PRODUCT_IMAGE,a.STATUS,a.CREATE_DATA,a.CREATE_BY,a.LOCATION_CODE,b.TOLET_TYPE_NAME
								FROM soc_ts_tolet_info_table a, soc_ts_tolet_type_table b 
								where a.price between '$PRICE_S' and '$PRICE_E' 
								and a.TOLET_TYPE_ID = b.TOLET_TYPE_ID 
								and a.TOLET_TYPE_ID = '$TOLET_TYPE_ID'
								and a.BEDS between '$BEDS_S' and '$BEDS_E' 
								and a.BATHS between '$BATHS_S' and '$BATHS_E' 
								and a.AVAILABLE_FROM between '$AVAILABLE_FROM_S' and '$AVAILABLE_FROM_E' 
								and a.STATUS = 'A' 
								ORDER BY a.TOLET_INFO_ID desc";
								$result1 = $conn->query($checkSQL1);
								
								if ($result1->num_rows > 0) {
									  while($row = $result1->fetch_assoc()) {
										$json_array []=$row ;					 
									  }
								}
						}
						
						else
						
						{
							$checkSQL1="SELECT a.TOLET_INFO_ID,a.USER_ACC_ID,a.TOLET_NAME,a.TOLET_DETAILS,a.ADDRESS,
								a.LATTITUDE,a.LOGLITUTDE,a.PRICE,a.BATHS,a.BEDS,a.FLOORS,a.AVAILABLE_FROM,
								a.CONTACT_PERSON_NM, a.CONTACT_PERSON_PHN,a.CONTACT_PERSON_EML,a.TOLET_TYPE_ID,
								a.PRODUCT_IMAGE,a.STATUS,a.CREATE_DATA,a.CREATE_BY,a.LOCATION_CODE,b.TOLET_TYPE_NAME
								FROM soc_ts_tolet_info_table a, soc_ts_tolet_type_table b 
								where a.price between '$PRICE_S' and '$PRICE_E' 
								and a.TOLET_TYPE_ID = b.TOLET_TYPE_ID 
								and a.TOLET_TYPE_ID = '$TOLET_TYPE_ID'
								and a.BEDS between '$BEDS_S' and '$BEDS_E' 
								and a.BATHS between '$BATHS_S' and '$BATHS_E' 
								and a.STATUS = 'A' 
								ORDER BY a.TOLET_INFO_ID desc";
								$result1 = $conn->query($checkSQL1);
								
								if ($result1->num_rows > 0) {
									  while($row = $result1->fetch_assoc()) {
										$json_array []=$row ;					 
									  }
								}
						}
						
							
					}
					
					else
					
					{
						$checkSQL1="SELECT a.TOLET_INFO_ID,a.USER_ACC_ID,a.TOLET_NAME,a.TOLET_DETAILS,a.ADDRESS,
							a.LATTITUDE,a.LOGLITUTDE,a.PRICE,a.BATHS,a.BEDS,a.FLOORS,a.AVAILABLE_FROM,
							a.CONTACT_PERSON_NM, a.CONTACT_PERSON_PHN,a.CONTACT_PERSON_EML,a.TOLET_TYPE_ID,
							a.PRODUCT_IMAGE,a.STATUS,a.CREATE_DATA,a.CREATE_BY,a.LOCATION_CODE,b.TOLET_TYPE_NAME
							FROM soc_ts_tolet_info_table a, soc_ts_tolet_type_table b 
							where a.price between '$PRICE_S' and '$PRICE_E' 
							and a.TOLET_TYPE_ID = b.TOLET_TYPE_ID 
							and a.TOLET_TYPE_ID = '$TOLET_TYPE_ID'
							and a.BEDS between '$BEDS_S' and '$BEDS_E' 
							and a.STATUS = 'A' 
							ORDER BY a.TOLET_INFO_ID desc";
							$result1 = $conn->query($checkSQL1);
							
							if ($result1->num_rows > 0) {
								  while($row = $result1->fetch_assoc()) {
									$json_array []=$row ;					 
								  }
							}
					}
					
					}
					
					else
					
					{
						$checkSQL1="SELECT a.TOLET_INFO_ID,a.USER_ACC_ID,a.TOLET_NAME,a.TOLET_DETAILS,a.ADDRESS,
							a.LATTITUDE,a.LOGLITUTDE,a.PRICE,a.BATHS,a.BEDS,a.FLOORS,a.AVAILABLE_FROM,
							a.CONTACT_PERSON_NM, a.CONTACT_PERSON_PHN,a.CONTACT_PERSON_EML,a.TOLET_TYPE_ID,
							a.PRODUCT_IMAGE,a.STATUS,a.CREATE_DATA,a.CREATE_BY,a.LOCATION_CODE,b.TOLET_TYPE_NAME
							FROM soc_ts_tolet_info_table a, soc_ts_tolet_type_table b 
							where a.price between '$PRICE_S' and '$PRICE_E' 
							and a.TOLET_TYPE_ID = b.TOLET_TYPE_ID 
							and a.TOLET_TYPE_ID = '$TOLET_TYPE_ID'
							and a.STATUS = 'A' 
							ORDER BY a.TOLET_INFO_ID desc";
							$result1 = $conn->query($checkSQL1);
							
							if ($result1->num_rows > 0) {
								  while($row = $result1->fetch_assoc()) {
									$json_array []=$row ;					 
								  }
							}
						
					}
			}
			
			else
			
			{
				$checkSQL1="SELECT a.TOLET_INFO_ID,a.USER_ACC_ID,a.TOLET_NAME,a.TOLET_DETAILS,a.ADDRESS,
					a.LATTITUDE,a.LOGLITUTDE,a.PRICE,a.BATHS,a.BEDS,a.FLOORS,a.AVAILABLE_FROM,
					a.CONTACT_PERSON_NM, a.CONTACT_PERSON_PHN,a.CONTACT_PERSON_EML,a.TOLET_TYPE_ID,
					a.PRODUCT_IMAGE,a.STATUS,a.CREATE_DATA,a.CREATE_BY,a.LOCATION_CODE,b.TOLET_TYPE_NAME
					FROM soc_ts_tolet_info_table a, soc_ts_tolet_type_table b 
					where a.price between '$PRICE_S' and '$PRICE_E' 
					and a.TOLET_TYPE_ID = b.TOLET_TYPE_ID 
					and a.STATUS = 'A' 
					ORDER BY a.TOLET_INFO_ID desc";
					$result1 = $conn->query($checkSQL1);
					
					if ($result1->num_rows > 0) {
						  while($row = $result1->fetch_assoc()) {
							$json_array []=$row ;					 
						  }
					}
			}
			
		}
		
		else{
			$checkSQL1="SELECT a.TOLET_INFO_ID,a.USER_ACC_ID,a.TOLET_NAME,a.TOLET_DETAILS,a.ADDRESS,a.LATTITUDE,a.LOGLITUTDE,a.PRICE,a.BATHS,a.BEDS,a.FLOORS,a.AVAILABLE_FROM,a.CONTACT_PERSON_NM,
				a.CONTACT_PERSON_PHN,a.CONTACT_PERSON_EML,a.TOLET_TYPE_ID,a.PRODUCT_IMAGE,a.STATUS,a.CREATE_DATA,a.CREATE_BY,a.LOCATION_CODE,b.TOLET_TYPE_NAME
				FROM soc_ts_tolet_info_table a, soc_ts_tolet_type_table b
					where a.TOLET_TYPE_ID = b.TOLET_TYPE_ID
					and a.STATUS = 'A'
					ORDER BY a.TOLET_INFO_ID desc";
			$result1 = $conn->query($checkSQL1);
			
			if ($result1->num_rows > 0) {
				  while($row = $result1->fetch_assoc()) {
					$json_array []=$row ;					 
				  }
			}
		}
	 
	
		print json_encode($json_array);
	
	}else{
	 $post_data = array(
		'status_code' => '502',
		'msg' => 'Failed',
		'values' => 'Sorry You Are Not Allow Here',
	  );
		print json_encode($post_data); 
	 } 


?>