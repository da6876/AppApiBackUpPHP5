<?php
error_reporting(0);
	include('connection.php');
	
	if($_SERVER['REQUEST_METHOD'] === 'POST'){
		$TOLET_NAME = $_POST['TOLET_NAME'];
		$TOLET_DETAILS = $_POST['TOLET_DETAILS'];
		$ADDRESS = $_POST['ADDRESS'];
		$PRICE = $_POST['PRICE'];
		$BATHS = $_POST['BATHS'];
		$BEDS = $_POST['BEDS'];
		$FLOORS = $_POST['FLOORS'];
		$AVAILABLE_FROM = $_POST['AVAILABLE_FROM'];
		$CONTACT_PERSON_NM = $_POST['CONTACT_PERSON_NM'];
		$CONTACT_PERSON_PHN = $_POST['CONTACT_PERSON_PHN'];
		$CONTACT_PERSON_EML = $_POST['CONTACT_PERSON_EML'];
		$TOLET_TYPE_ID = $_POST['TOLET_TYPE_ID'];
		$PRODUCT_IMAGE = $_POST['PRODUCT_IMAGE'];
		$STATUS = $_POST['STATUS'];

	
	
	if($TOLET_NAME!="" && $TOLET_DETAILS!="" && $ADDRESS!="" && $PRICE!="" && $BATHS!="" && $BEDS!=""
	&& $FLOORS!=""&& $AVAILABLE_FROM!=""&& $CONTACT_PERSON_NM!=""&& $CONTACT_PERSON_PHN!=""&& $CONTACT_PERSON_EML
	&& $TOLET_TYPE_ID!=""&& $PRODUCT_IMAGE!="" && $STATUS!="" ){
		
		$sql = "UPDATE soc_ts_tolet_info_table SET
		TOLET_NAME=$TOLET_NAME,TOLET_DETAILS=$TOLET_DETAILS,ADDRESS=$ADDRESS,PRICE=$PRICE,
		BATHS=$BATHS,BEDS = $BEDS, FLOORS = $FLOORS,AVAILABLE_FROM = $AVAILABLE_FROM,
		CONTACT_PERSON_NM = $CONTACT_PERSON_NM,CONTACT_PERSON_PHN = $CONTACT_PERSON_PHN,
		CONTACT_PERSON_EML = $CONTACT_PERSON_EML,TOLET_TYPE_ID=$TOLET_TYPE_ID,
		PRODUCT_IMAGE = $PRODUCT_IMAGE,STATUS = $STATUS,UPDATE_BY = $TOLET_INFO_ID
		WHERE TOLET_INFO_ID = $TOLET_INFO_ID";

		if (mysqli_query($conn, $sql)) {
			if($USER_IMAGE!=""){
				$binary=base64_decode($USER_IMAGE);
					
				header('Content-Type: bitmap; charset=utf-8');
				$imageTime=round(microtime(true) * 1000);
				$rootPath="C:\\xampp\htdocs\apps\SOC_ToletService/";
				$filePath='ProfileImage/'.$USER_NAME.'_'.$USER_ACC_ID.'.png';
				$fileName= $rootPath.$filePath;
				$file = fopen($fileName, 'wb');
				
				fwrite($file, $binary);
				fclose($file);
			}
			$post_data = array(
				'status_code' => '200',
				'msg' => 'Success',
				'values' => 'Tolet(.'.$TOLET_NAME.'.) Update Successfully'
			);
			print json_encode($post_data); 
		} else {
			$post_data = array(
				'status_code' => '400',
				'msg' => 'Failed',
				'values' => 'Tolet(.'.$TOLET_NAME.'.) Update Faild'
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