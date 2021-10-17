<?php
//error_reporting(0);
	include('connection.php');
	
	if($_SERVER['REQUEST_METHOD'] === 'POST'){
		$USER_ACC_ID = $_POST['USER_ACC_ID'];
		$USER_NAME = $_POST['USER_NAME'];
		$ADDRESS = $_POST['ADDRESS'];
		$USER_IMAGE = $_POST['USER_IMAGE'];
		$GENDER = $_POST['GENDER'];

	
	
	if($USER_NAME!="" && $ADDRESS!="" && $USER_IMAGE!="" && $GENDER!="" ){
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
		$sql = "UPDATE soc_ts_user_account SET
		USER_NAME = '$USER_NAME',ADDRESS = '$ADDRESS',
		USER_IMAGE = '$filePath',UPDATE_BY= '$USER_NAME',
		GENDER = '$GENDER' WHERE USER_ACC_ID = '$USER_ACC_ID'";
			
		if (mysqli_query($conn, $sql)) {
			$post_data = array(
				'status_code' => '200',
				'msg' => 'Success',
				'values' => 'Profile Update Successfully'
			);
			print json_encode($post_data); 
			
		} else {
			$post_data = array(
				'status_code' => '400',
				'msg' => 'Failed',
				'values' => 'Profile Update Faild'
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