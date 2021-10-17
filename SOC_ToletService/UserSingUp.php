<?php
error_reporting(0);
	include('connection.php');
	
	if($_SERVER['REQUEST_METHOD'] === 'POST'){
		
		$USER_NAME = $_POST['USER_NAME'];
		$USER_EMAIL = $_POST['USER_EMAIL'];
		$USER_PASSWORD = md5($_POST['USER_PASSWORD']);
		$ADDRESS = $_POST['ADDRESS'];
		$USER_REFER_ID = $_POST['USER_REFER_ID'];
		$USER_POINT = $_POST['USER_POINT'];
		$USER_PHONE = $_POST['USER_PHONE'];
		$USER_IMAGE = $_POST['USER_IMAGE'];
		$GENDER = $_POST['GENDER'];
		$CREATE_BY = $_POST['USER_PHONE'];
		$STATUS = "N";
		$USER_POINT = "120";
		$checkUSER_EMAIL="SELECT count(USER_NAME) as User FROM soc_ts_user_account where
				USER_EMAIL='$USER_EMAIL'";
				$result1 = $conn->query($checkUSER_EMAIL);
				
				if ($result1->num_rows > 0) {
					  while($row = $result1->fetch_assoc()) {
						$UserEmailExt = $row["User"];
					  }
				}
		
		$checkUSER_PHONE="SELECT count(USER_NAME) as User FROM soc_ts_user_account where
				USER_PHONE='$USER_PHONE'";
				 $result2 = $conn->query($checkUSER_PHONE);
				
				if ($result2->num_rows > 0) {
					  while($row1 = $result2->fetch_assoc()) {
						  $UserPhoneExt = $row1["User"];
					  }
				}
			
		if($UserEmailExt==0){
			if($UserPhoneExt==0){
				if($USER_NAME!="" && $USER_EMAIL!="" && $USER_PASSWORD!="" && $ADDRESS!="" && $USER_PHONE!=""&& $GENDER!="" ){
			
				$sql = "INSERT INTO soc_ts_user_account (`USER_NAME`, `USER_EMAIL`, `USER_PASSWORD`, `ADDRESS`,`USER_REFER_ID`,
				`USER_POINT`, `USER_PHONE`, `USER_IMAGE`, `GENDER`, `CREATE_BY`, `STATUS`)
				VALUES ('$USER_NAME', '$USER_EMAIL', '$USER_PASSWORD', '$ADDRESS', '$USER_REFER_ID', '$USER_POINT', '$USER_PHONE',
				'$filePath', '$GENDER', '$CREATE_BY', '$STATUS')";

				if (mysqli_query($conn, $sql)) {
					$post_data = array(
						'status_code' => '200',
						'msg' => 'Success',
						'values' => 'Registration  Compleate Successfully'
					);
					print json_encode($post_data); 
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
					} else {
						$post_data = array(
							'status_code' => '400',
							'msg' => 'Failed',
							'values' => "Error: " . $sql . "<br>" . mysqli_error($conn)
						);
						print json_encode($post_data); 
					}
					mysqli_close($conn);
				}
				
				else{
					
					$post_data = array(
						'status_code' => '400',
						'msg' => 'Failed',
						'values' => "Mandatory File Empty !!"
					);
					print json_encode($post_data); 
				}
			
			}else{
				$post_data = array(
					'status_code' => '400',
					'msg' => 'Failed',
					'values' => "Phone Number Already Used !!"
				);
				print json_encode($post_data); 
				
			}
		}else{
			$post_data = array(
				'status_code' => '400',
				'msg' => 'Failed',
				'values' => "Email Address Already Used !!"
			);
			print json_encode($post_data); 
			
		}
		
	
	}
	
	else{
	 $post_data = array(
		'status_code' => '502',
		'msg' => 'Failed',
		'values' => 'Sorry You Are Not Allow Here',
	  );
		print json_encode($post_data); 
	 } 


?>