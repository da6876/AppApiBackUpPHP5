<?php
//error_reporting(0);
	include('connection.php');
	
	if($_SERVER['REQUEST_METHOD'] === 'POST'){
		$SendType = $_POST['SendType'];
		$USER_ACC_ID = $_POST['USER_ACC_ID'];
		$TOLET_NAME = $_POST['TOLET_NAME'];
		$TOLET_DETAILS = $_POST['TOLET_DETAILS'];
		$ADDRESS = $_POST['ADDRESS'];
		$LATTITUDE = $_POST['LATTITUDE'];
		$LOGLITUTDE = $_POST['LOGLITUTDE'];
		$PRICE = $_POST['PRICE'];
		$BATHS = $_POST['BATHS'];
		$BEDS = $_POST['BEDS'];
		$FLOORS = $_POST['FLOORS'];
		$AVAILABLE_FROM = $_POST['AVAILABLE_FROM'];
		$CONTACT_PERSON_PHN = $_POST['CONTACT_PERSON_PHN'];
		$CONTACT_PERSON_NM = $_POST['CONTACT_PERSON_NM'];
		$CONTACT_PERSON_EML = $_POST['CONTACT_PERSON_EML'];
		$TOLET_TYPE_ID = $_POST['TOLET_TYPE_ID'];
		$PRODUCT_IMAGE = $_POST['PRODUCT_IMAGE'];
		$Point = $_POST['Point'];
		$CREATE_BY = $CONTACT_PERSON_NM;
		$STATUS = "A";
		if($SendType=="NewPost"){
			$TOLET_INFO_ID="";
		}elseif($SendType=="EditProfile"){
			$TOLET_INFO_ID=$_POST['TOLET_INFO_ID'];
		}
		
		
	
	 if($TOLET_NAME!="" && $TOLET_DETAILS!="" && $ADDRESS!="" && $PRICE!="" && $BATHS!=""&& 
	 $CONTACT_PERSON_NM!=""&& $TOLET_TYPE_ID!=""&& $PRODUCT_IMAGE!="" ){
		 
		if($PRODUCT_IMAGE!=""){
			$binary=base64_decode($PRODUCT_IMAGE);
				
			header('Content-Type: bitmap; charset=utf-8');
			$imageTime=round(microtime(true) * 1000);
			$rootPath="C:\\xampp\htdocs\apps\SOC_ToletService/";
			$filePath='ToletImages/'.$imageTime.'_'.$USER_ACC_ID.'.png';
			$fileName= $rootPath.$filePath;
			$file = fopen($fileName, 'wb');
			
			fwrite($file, $binary);
			fclose($file);
		}
		
		if($SendType=="NewPost"){
			
			$sql = "INSERT INTO `soc_ts_tolet_info_table`(  `USER_ACC_ID`, `TOLET_NAME`,
			`TOLET_DETAILS`, `ADDRESS`, `LATTITUDE`, `LOGLITUTDE`, `PRICE`, `BATHS`, `BEDS`, `FLOORS`,
			`AVAILABLE_FROM`, `CONTACT_PERSON_NM`, `CONTACT_PERSON_PHN`, `CONTACT_PERSON_EML`,
			`TOLET_TYPE_ID`, `PRODUCT_IMAGE`, `STATUS`,`CREATE_BY`)
			VALUES ('$USER_ACC_ID','$TOLET_NAME','$TOLET_DETAILS','$ADDRESS','$LATTITUDE','$LOGLITUTDE',
			'$PRICE','$BATHS','$BEDS','$FLOORS','$AVAILABLE_FROM','$CONTACT_PERSON_NM','$CONTACT_PERSON_PHN','$CONTACT_PERSON_EML',
			'$TOLET_TYPE_ID','$filePath','$STATUS','$CREATE_BY')";

			if (mysqli_query($conn, $sql)) {
				$sqlU ="UPDATE soc_ts_user_account SET 
						USER_POINT ='$Point'
						WHERE USER_ACC_ID = '$USER_ACC_ID'";
						
				if (mysqli_query($conn, $sqlU)) {
					$post_data = array(
						'status_code' => '200',
						'msg' => 'Success',
						'values' => 'New Tolet Post Successfully'
					);
					print json_encode($post_data); 
				} else {
						$post_data = array(
							'status_code' => '400',
							'msg' => 'Failed',
							'values' => "Error: " . $sqlU . "<br>" . mysqli_error($conn)
						);
						print json_encode($post_data); 
					}
				
			} else {
				$post_data = array(
					'status_code' => '400',
					'msg' => 'Failed',
					'values' => "Error: " . $sql . "<br>" . mysqli_error($conn)
				);
				print json_encode($post_data); 
			}
			
		}
		
		else if($SendType=="EditProfile"){
			
			$sql ="UPDATE soc_ts_tolet_info_table SET 
			USER_ACC_ID ='$USER_ACC_ID',
			TOLET_NAME ='$TOLET_NAME',
			TOLET_DETAILS='$TOLET_DETAILS',
			ADDRESS='$ADDRESS',
			LATTITUDE='$LATTITUDE',
			LOGLITUTDE='$LOGLITUTDE',
			PRICE='$PRICE',
			BATHS='$BATHS',
			BEDS='$BEDS',
			FLOORS='$FLOORS',
			AVAILABLE_FROM='$AVAILABLE_FROM',
			CONTACT_PERSON_NM='$CONTACT_PERSON_NM',
			CONTACT_PERSON_PHN='$CONTACT_PERSON_PHN',
			CONTACT_PERSON_EML='$CONTACT_PERSON_EML',
			TOLET_TYPE_ID='$TOLET_TYPE_ID',
			PRODUCT_IMAGE='$filePath',
			STATUS='$STATUS',
			UPDATE_BY='$USER_ACC_ID'
			WHERE TOLET_INFO_ID = '$TOLET_INFO_ID'";
			
				if ($conn->query($sql) === TRUE) {
					$post_data = array(
						'status_code' => '200',
						'msg' => 'Failed',
						'values' => "Record Update Successfully !!"
					);
				} else {
					$post_data = array(
						'status_code' => '400',
						'msg' => 'Failed',
						'values' => "Error Update Record"
					);
				}
		
			print json_encode($post_data);
				
		}else{
			$post_data = array(
				'status_code' => '500',
				'msg' => 'Failed',
				'values' => 'Same Thing is Wrrog'
			);
			print json_encode($post_data); 
			
		}
		
		mysqli_close($conn);
	}else{
		
		$post_data = array(
			'status_code' => '400',
			'msg' => 'Failed',
			'values' => "Mandatory File Empty !!"
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