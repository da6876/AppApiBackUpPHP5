<?php
error_reporting(0);
	include('connection.php');
	
	if($_SERVER['REQUEST_METHOD'] === 'POST'){
	$USER_ID = $_POST['USER_ID'];
	echo $USER_PASSWORD = md5($_POST['USER_PASSWORD']);
	echo "<br>";
	echo md5($_POST['USER_PASSWORD'],raw);
	
	$checkSQL1="SELECT count(USER_ACC_ID) as User FROM soc_ts_user_account where
			USER_EMAIL='$USER_ID' and USER_PASSWORD = '$USER_PASSWORD'";
			$result1 = $conn->query($checkSQL1);
			
			if ($result1->num_rows > 0) {
				  while($row = $result1->fetch_assoc()) {
					$UserEmailExt = $row["User"];
				  }
			}
	
	$checkSQL2="SELECT count(USER_ACC_ID) as User FROM soc_ts_user_account where
			USER_PHONE='$USER_ID' and USER_PASSWORD = '$USER_PASSWORD'";
			 $result2 = $conn->query($checkSQL2);
			
			if ($result2->num_rows > 0) {
				  while($row1 = $result2->fetch_assoc()) {
					   $UserPhoneExt = $row1["User"];
				  }
			} 
			if($UserPhoneExt==1){
				
				$sql = "SELECT * FROM soc_ts_user_account
				where USER_PHONE = '$USER_ID' and USER_PASSWORD = '$USER_PASSWORD'" ;
				$result = $conn->query($sql);

					if ($result->num_rows > 0) {
					  while($row = $result->fetch_assoc()) {
						  $USER_ACC_ID = $row["USER_ACC_ID"];
					
							$checkSQL3="SELECT count(TOLET_INFO_ID) as TOTAL_POST 
							FROM `soc_ts_tolet_info_table` where user_acc_id = '$USER_ACC_ID'";
							 $result3 = $conn->query($checkSQL3);
							
							if ($result3->num_rows > 0) {
								  while($row3 = $result3->fetch_assoc()) {
									  $TOTAL_POST = $row3["TOTAL_POST"];
								  }
							} 
						$value = array(
							'USER_ACC_ID' =>  $row["USER_ACC_ID"],
							'USER_NAME' =>  $row["USER_NAME"],
							'USER_EMAIL' =>  $row["USER_EMAIL"],
							'USER_PASSWORD' =>  $row["USER_PASSWORD"],
							'LATTITUDE' =>  $row["LATTITUDE"],
							'LOGLITUTDE' =>  $row["LOGLITUTDE"],
							'ADDRESS' =>  $row["ADDRESS"],
							'USER_REFER_ID' =>  $row["USER_REFER_ID"],
							'USER_POINT' =>  $row["USER_POINT"],
							'USER_PHONE' =>  $row["USER_PHONE"],
							'USER_IMAGE' =>  $row["USER_IMAGE"],
							'STATUS' =>  $row["STATUS"],
							'GENDER' =>  $row["GENDER"],
							'LOCATION_CODE' =>  $row["LOCATION_CODE"],
							'CREATE_DATE' =>  $row["CREATE_DATE"],
							'CREATE_BY' =>  $row["CREATE_BY"],
							'TOTAL_POST' =>  $TOTAL_POST,
						);
					  }
					  
					$post_data = array(
							'status_code' => '200',
							'msg' => 'Success',
							'values' => $value
					);
					print json_encode($post_data); 
					} else {			  
						$post_data = array(
							'status_code' => '400',
							'msg' => 'Failed',
							'values' => "User Login Failed !!"
						);
						print json_encode($post_data); 
					} 
			}else if($UserEmailExt=="1"){
				$sql = "SELECT * FROM soc_ts_user_account
				where  USER_EMAIL = '$USER_ID' and USER_PASSWORD = '$USER_PASSWORD'";
				$result = $conn->query($sql);

				if ($result->num_rows > 0) {
				  while($row = $result->fetch_assoc()) {
					  
					$USER_ACC_ID = $row["USER_ACC_ID"];
					
					$checkSQL3="SELECT count(TOLET_INFO_ID) as TOTAL_POST 
					FROM `soc_ts_tolet_info_table` where user_acc_id = '$USER_ACC_ID'";
					 $result3 = $conn->query($checkSQL3);
					
					if ($result3->num_rows > 0) {
						  while($row3 = $result3->fetch_assoc()) {
							  $TOTAL_POST = $row3["TOTAL_POST"];
						  }
					} 
					$value = array(
						'USER_ACC_ID' =>  $row["USER_ACC_ID"],
						'USER_NAME' =>  $row["USER_NAME"],
						'USER_EMAIL' =>  $row["USER_EMAIL"],
						'USER_PASSWORD' =>  $row["USER_PASSWORD"],
						'LATTITUDE' =>  $row["LATTITUDE"],
						'LOGLITUTDE' =>  $row["LOGLITUTDE"],
						'ADDRESS' =>  $row["ADDRESS"],
						'USER_REFER_ID' =>  $row["USER_REFER_ID"],
						'USER_POINT' =>  $row["USER_POINT"],
						'USER_PHONE' =>  $row["USER_PHONE"],
						'USER_IMAGE' =>  $row["USER_IMAGE"],
						'STATUS' =>  $row["STATUS"],
						'GENDER' =>  $row["GENDER"],
						'LOCATION_CODE' =>  $row["LOCATION_CODE"],
						'CREATE_DATE' =>  $row["CREATE_DATE"],
						'CREATE_BY' =>  $row["CREATE_BY"],
						'TOTAL_POST' =>  $TOTAL_POST
					);
				  }
					$post_data = array(
						'status_code' => '200',
						'msg' => 'Success',
						'values' => $value
					);
					print json_encode($post_data); 
				} else {
					$post_data = array(
						'status_code' => '400',
						'msg' => 'Failed',
						'values' => "User Login Failed !!"
					);
					print json_encode($post_data); 
				} 
			}else {
					$post_data = array(
						'status_code' => '400',
						'msg' => 'Failed',
						'values' => "User Login Failed !!"
					);
					print json_encode($post_data); 
				} 
			
			
		/* if($USER_PHONE !=""){
			$sql = "SELECT * FROM soc_ts_user_account
			where USER_PHONE = ".$USER_PHONE." and USER_PASSWORD = '$USER_PASSWORD'" ;
			$result = $conn->query($sql);

				if ($result->num_rows > 0) {
				  while($row = $result->fetch_assoc()) {
					
					$value = array(
						'USER_ACC_ID' =>  $row["USER_ACC_ID"],
						'USER_NAME' =>  $row["USER_NAME"],
						'USER_EMAIL' =>  $row["USER_EMAIL"],
						'USER_PASSWORD' =>  $row["USER_PASSWORD"],
						'LATTITUDE' =>  $row["LATTITUDE"],
						'LOGLITUTDE' =>  $row["LOGLITUTDE"],
						'ADDRESS' =>  $row["ADDRESS"],
						'USER_REFER_ID' =>  $row["USER_REFER_ID"],
						'USER_POINT' =>  $row["USER_POINT"],
						'USER_PHONE' =>  $row["USER_PHONE"],
						'USER_IMAGE' =>  $row["USER_IMAGE"],
						'STATUS' =>  $row["STATUS"],
						'GENDER' =>  $row["GENDER"],
						'LOCATION_CODE' =>  $row["LOCATION_CODE"],
						'CREATE_DATE' =>  $row["CREATE_DATE"],
						'CREATE_BY' =>  $row["CREATE_BY"],
					);
				  }
				$post_data = array(
						'status_code' => '200',
						'msg' => 'Success',
						'values' => $value
				);
				print json_encode($post_data); 
				} else {			  
					$post_data = array(
						'status_code' => '400',
						'msg' => 'Failed',
						'values' => "User Login Failed !!"
					);
					print json_encode($post_data); 
				} 
		}else if($USER_EMAIL!=""){
			$sql = "SELECT * FROM soc_ts_user_account where USER_EMAIL='$USER_EMAIL' and USER_PASSWORD = '$USER_PASSWORD'";
			$result = $conn->query($sql);

				if ($result->num_rows > 0) {
				  while($row = $result->fetch_assoc()) {
					$value = array(
						'USER_ACC_ID' =>  $row["USER_ACC_ID"],
						'USER_NAME' =>  $row["USER_NAME"],
						'USER_EMAIL' =>  $row["USER_EMAIL"],
						'USER_PASSWORD' =>  $row["USER_PASSWORD"],
						'LATTITUDE' =>  $row["LATTITUDE"],
						'LOGLITUTDE' =>  $row["LOGLITUTDE"],
						'ADDRESS' =>  $row["ADDRESS"],
						'USER_REFER_ID' =>  $row["USER_REFER_ID"],
						'USER_POINT' =>  $row["USER_POINT"],
						'USER_PHONE' =>  $row["USER_PHONE"],
						'USER_IMAGE' =>  $row["USER_IMAGE"],
						'STATUS' =>  $row["STATUS"],
						'GENDER' =>  $row["GENDER"],
						'LOCATION_CODE' =>  $row["LOCATION_CODE"],
						'CREATE_DATE' =>  $row["CREATE_DATE"],
						'CREATE_BY' =>  $row["CREATE_BY"],
					);
				  }
					$post_data = array(
						'status_code' => '200',
						'msg' => 'Success',
						'values' => $value
					);
					print json_encode($post_data); 
				} else {
					$post_data = array(
						'status_code' => '400',
						'msg' => 'Failed',
						'values' => "User Login Failed !!"
					);
					print json_encode($post_data); 
				} 

		} */
	
	
	}else{
		 $post_data = array(
			'status_code' => '502',
			'msg' => 'Failed',
			'values' => 'Sorry You Are Not Allow Here',
		  );
			print json_encode($post_data); 
		} 


?>