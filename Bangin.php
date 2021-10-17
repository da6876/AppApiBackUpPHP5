<?php


if($_SERVER['REQUEST_METHOD'] === 'POST'){
		//$Type = $_POST['Type'];
		$Type = "User Login";
	if($Type == "User Login"){
		
		$userName= $_POST['userName'];
		$userPassword= $_POST['userPassword'];

		if($userName=="GM" && $userPassword=="12345" || $userName=="SV" && $userPassword=="12345"){
			$post_data = array(
							'status_code' => '200',
							'msg' => 'Success',
							'values' => 'Log In Success'
						);
			print json_encode($post_data); 
			
		}else{
			$post_data = array(
							'status_code' => '400',
							'msg' => 'Failed',
							'values' => 'Your user name Password Wrrog'
						);
			print json_encode($post_data); 
		}
	}
}else{
			$post_data = array(
							'status_code' => '500',
							'msg' => 'Failed',
							'values' => 'Your Are Not Allowed here !!!!!!'
						);
			print json_encode($post_data); 
		}
?>