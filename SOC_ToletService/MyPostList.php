<?php
error_reporting(0);
	include('connection.php');
	
	if($_SERVER['REQUEST_METHOD'] === 'POST'){
	$USER_ID = $_POST['USER_ID'];
	//$USER_ID = '16';
	
	$checkSQL1="SELECT count(USER_ACC_ID) as User FROM soc_ts_user_account where
			USER_ACC_ID='$USER_ID'";
			
			$result = $conn->query($checkSQL1);
			
			if ($result->num_rows > 0){
				  while($row = $result->fetch_assoc()) {
					 $UserExt = $row["User"];
				}
			}
	
			if($UserExt==1){
				
				$sql = "SELECT 
					a.TOLET_INFO_ID, a.USER_ACC_ID, a.TOLET_NAME, a.TOLET_DETAILS, a.ADDRESS, a.LATTITUDE, a.LOGLITUTDE,
					a.PRICE, a.BATHS, a.BEDS, a.FLOORS, a.AVAILABLE_FROM, a.CONTACT_PERSON_NM, a.CONTACT_PERSON_PHN,
					a.CONTACT_PERSON_EML, a.TOLET_TYPE_ID, a.PRODUCT_IMAGE, a.STATUS, a.CREATE_DATA, a.CREATE_BY,
					a.UPDATE_DATA, a.UPDATE_BY, a.LOCATION_CODE, b.TOLET_TYPE_ID, b.TOLET_TYPE_NAME 
					FROM soc_ts_tolet_info_table a ,soc_ts_tolet_type_table b 
					WHERE a.USER_ACC_ID= '$USER_ID' and a.TOLET_TYPE_ID = b.TOLET_TYPE_ID ORDER BY `TOLET_INFO_ID` desc";
				$result = $conn->query($sql);

					if ($result->num_rows > 0) {
					  while($row = $result->fetch_assoc()) {
								$json_array []=$row ;
						}
							
						print json_encode($json_array);
					}else {			  
						$post_data = array(
							'status_code' => '200',
							'msg' => 'Failed',
							'values' => "No Post Found For You !!"
						);
						print json_encode($post_data); 
					} 
			}else {			  
				$post_data = array(
					'status_code' => '400',
					'msg' => 'Failed',
					'values' => "No User Found by This Id !!"
				);
				print json_encode($post_data); 
			} 	
	
	}else{
		 $post_data = array(
			'status_code' => '502',
			'msg' => 'Failed',
			'values' => 'Sorry You Are Not Allow Here',
		);
		print json_encode($post_data); 
	}
?>