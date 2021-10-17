<?php
//error_reporting(0);
	include('connection.php');
	
	if($_SERVER['REQUEST_METHOD'] === 'POST'){
		$json_array= array();
	$checkSQL1="SELECT TOLET_INFO_ID,USER_ACC_ID,TOLET_NAME,TOLET_DETAILS,ADDRESS
	,LATTITUDE,LOGLITUTDE,PRICE,BATHS,BEDS,FLOORS,AVAILABLE_FROM,CONTACT_PERSON_NM
	,CONTACT_PERSON_PHN,CONTACT_PERSON_EML,TOLET_TYPE_ID,PRODUCT_IMAGE,STATUS
	,STATUS,CREATE_DATA,CREATE_BY,LOCATION_CODE FROM soc_ts_tolet_info_table where STATUS='A' ORDER BY TOLET_INFO_ID desc";
			$result1 = $conn->query($checkSQL1);
			
			if ($result1->num_rows > 0) {
				  while($row = $result1->fetch_assoc()) {
					$json_array []=$row ;					 
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