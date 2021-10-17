<?php
include 'conn.php';


if($_SERVER['REQUEST_METHOD'] === 'POST'){
	
	$Type=$_POST['Type'];
	
	if($Type=="User Add"){
		
		date_default_timezone_set("Asia/Dhaka");
		$Month=date("m");
		
		if($Month == "01"){
			 $P_CASUAL_LEAVE="12";
			 $P_MEADICAL_LEAVE="12";
			 $P_ANNUAL_LEAVE="12";
		}elseif($Month == "02"){
			 $P_CASUAL_LEAVE="11";	
			 $P_MEADICAL_LEAVE="11";		
			 $P_ANNUAL_LEAVE="11";		
		}elseif($Month == "03"){
			 $P_CASUAL_LEAVE="10";	
			 $P_MEADICAL_LEAVE="10";		
			 $P_ANNUAL_LEAVE="10";		
		}elseif($Month == "04"){
			 $P_CASUAL_LEAVE="9";
			 $P_MEADICAL_LEAVE="9";			
			 $P_ANNUAL_LEAVE="9";			
		}elseif($Month == "05"){
			 $P_CASUAL_LEAVE="8";
			 $P_MEADICAL_LEAVE="8";			
			 $P_ANNUAL_LEAVE="8";			
		}elseif($Month == "06"){
			 $P_CASUAL_LEAVE="7";
			 $P_MEADICAL_LEAVE="7";			
			 $P_ANNUAL_LEAVE="7";			
		}elseif($Month == "07"){
			 $P_CASUAL_LEAVE="6";
			 $P_MEADICAL_LEAVE="6";			
			 $P_ANNUAL_LEAVE="6";			
		}elseif($Month == "08"){
			 $P_CASUAL_LEAVE="5";
			 $P_MEADICAL_LEAVE="5";			
			 $P_ANNUAL_LEAVE="5";			
		}elseif($Month == "09"){
			 $P_CASUAL_LEAVE="4";
			 $P_MEADICAL_LEAVE="4";			
			 $P_ANNUAL_LEAVE="4";			
		}elseif($Month == "10"){
			 $P_CASUAL_LEAVE="3";
			 $P_MEADICAL_LEAVE="3";			
			 $P_ANNUAL_LEAVE="3";			
		}elseif($Month == "11"){
			 $P_CASUAL_LEAVE="2";
			 $P_MEADICAL_LEAVE="2";			
			 $P_ANNUAL_LEAVE="2";			
		}elseif($Month == "12"){
			 $P_CASUAL_LEAVE="1";
			 $P_MEADICAL_LEAVE="1";			
			 $P_ANNUAL_LEAVE="1";			
		}
	
		  $P_USER_TYPE_ID=$_POST['P_USER_TYPE_ID'];
		  $P_USER_NAME=$_POST['P_USER_NAME'];
		  $P_USER_PASSWORD=md5($_POST['P_USER_PASSWORD']);
		  $P_USER_PHONE=$_POST['P_USER_PHONE'];
		  $P_USER_EMAIL=$_POST['P_USER_EMAIL'];
		  $P_USER_IMAGE=$_POST['P_USER_IMAGE'];
		  $P_USER_DEG=$_POST['P_USER_DEG'];
		  $P_USER_ADDRESS=$_POST['P_USER_ADDRESS'];
		  $P_USER_DETAILS=$_POST['P_USER_DETAILS'];
		  $P_CREATE_BY=$_POST['P_CREATE_BY'];
		  $P_USER_SING="";
		  $P_TEAM_TYPE_ID=$_POST['P_TEAM_TYPE_ID'];
		  $value = $P_USER_TYPE_ID .", ". $P_USER_NAME.", ". $P_USER_PASSWORD.", ". $P_USER_PHONE.", ". $P_USER_EMAIL.",
		  ". $P_USER_ADDRESS.", ". $P_USER_DETAILS.", ". $P_USER_IMAGE.", ". $P_CREATE_BY.", ". $P_TEAM_TYPE_ID.", ". $P_USER_SING;
		  
		if($P_USER_TYPE_ID !="" || $P_USER_NAME !="" || $P_USER_PASSWORD !="" || $P_USER_PHONE !=""){
			
			if($P_USER_IMAGE!=""){
				$binary=base64_decode($P_USER_IMAGE);
				header('Content-Type: bitmap; charset=utf-8');
				$imageTime=round(microtime(true) * 1000);
				$rootPath="C:\\xampp\htdocs\apps\SRL_MANAGER/";
				$filePath1='UserImage/'.$P_USER_PHONE.'_1.png';
				$fileName= $rootPath.$filePath1;
				$file = fopen($fileName, 'wb');
				
				fwrite($file, $binary);
				fclose($file);
			}else{$filePath1="No Image";}
			 $curs = oci_new_cursor($conn);

			 $REG = oci_parse($conn, 
			 "begin SRL_MANGER_PROSESS_DATE.SRL_USER_INFO_IN
			 (:CURDATA,
			 :P_USER_TYPE_ID,
			 :P_USER_NAME,
			 :P_USER_PASSWORD,
			 :P_USER_PHONE,
			 :P_USER_EMAIL,
			 :P_USER_IMAGE,
			 :P_USER_ADDRESS,
			 :P_USER_DEG,
			 :P_USER_DETAILS,
			 :P_CREATE_BY,
			 :P_USER_SING,
			 :P_CASUAL_LEAVE,
			 :P_ANNUAL_LEAVE,
			 :P_MEADICAL_LEAVE,
			 :P_TEAM_TYPE_ID
			 );
			 end;");

			oci_bind_by_name($REG, ":CURDATA", $curs, -1, OCI_B_CURSOR);
			oci_bind_by_name($REG, ":P_USER_TYPE_ID", $P_USER_TYPE_ID, -1, SQLT_CHR);
			oci_bind_by_name($REG, ":P_USER_NAME", $P_USER_NAME, -1, SQLT_CHR);
			oci_bind_by_name($REG, ":P_USER_PASSWORD", $P_USER_PASSWORD, -1, SQLT_CHR);
			oci_bind_by_name($REG, ":P_USER_PHONE", $P_USER_PHONE, -1, SQLT_CHR);
			oci_bind_by_name($REG, ":P_USER_EMAIL", $P_USER_EMAIL, -1, SQLT_CHR);
			oci_bind_by_name($REG, ":P_USER_IMAGE", $filePath1, -1, SQLT_CHR);
			oci_bind_by_name($REG, ":P_USER_ADDRESS", $P_USER_ADDRESS, -1, SQLT_CHR);
			oci_bind_by_name($REG, ":P_USER_DEG", $P_USER_DEG, -1, SQLT_CHR);
			oci_bind_by_name($REG, ":P_USER_DETAILS", $P_USER_DETAILS, -1, SQLT_CHR);
			oci_bind_by_name($REG, ":P_CREATE_BY", $P_CREATE_BY, -1, SQLT_CHR);
			oci_bind_by_name($REG, ":P_USER_SING", $P_USER_SING, -1, SQLT_CHR);
			oci_bind_by_name($REG, ":P_CASUAL_LEAVE", $P_CASUAL_LEAVE, -1, SQLT_CHR);
			oci_bind_by_name($REG, ":P_ANNUAL_LEAVE", $P_ANNUAL_LEAVE, -1, SQLT_CHR);
			oci_bind_by_name($REG, ":P_MEADICAL_LEAVE", $P_MEADICAL_LEAVE, -1, SQLT_CHR);
			oci_bind_by_name($REG, ":P_TEAM_TYPE_ID", $P_TEAM_TYPE_ID, -1, SQLT_CHR);

			oci_execute($REG);
			oci_execute($curs);
			 while (($row = oci_fetch_array($curs, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
			  $output[]=$row;
			}
			$data=json_encode($output);
			$obj = json_decode($data);
			if($obj[0]->STATUS_CODE==="200"){
				$post_data = array(
						'status_code' => $obj[0]->STATUS_CODE,
						'msg' =>$obj[0]->TYPE,
						'values' => $obj[0]->MSG
					);
					print json_encode($post_data);
			}elseif($obj[0]->STATUS_CODE==="500"){
				$post_data = array(
					'status_code' => $obj[0]->STATUS_CODE,
					'msg' =>$obj[0]->TYPE,
					'values' => $obj[0]->MSG

				);
				print json_encode($post_data);
			}else{
				$post_data = array(
					'status_code' => $obj[0]->STATUS_CODE,
					'msg' =>$obj[0]->TYPE,
					'values' => $obj[0]->MSG

				);
				print json_encode($post_data);
			}
			oci_free_statement($REG);
			oci_close($conn);
		}else{
			
			$post_data = array(
					'status_code' => '502',
					'msg' =>"Falied",
					'values' => "Enter The All Data !",
			);
			print json_encode($post_data);
		}
		
	}
	
	elseif($Type=="User Login"){
		
		$P_USER_PHONE=$_POST['P_USER_PHONE'];
		$P_USER_PASSWORD=md5($_POST['P_USER_PASSWORD']);
		  
		if($P_USER_PHONE !="" || $P_USER_PASSWORD !=""){
			 $curs = oci_new_cursor($conn);

			 $REG = oci_parse($conn, 
			 "begin SRL_MANGER_PROSESS_DATE.SRL_USER_LOGIN
			 (:CURDATA,
			 :P_USER_PHONE,
			 :P_USER_PASSWORD
			 );
			 end;");

			oci_bind_by_name($REG, ":CURDATA", $curs, -1, OCI_B_CURSOR);
			oci_bind_by_name($REG, ":P_USER_PHONE", $P_USER_PHONE, -1, SQLT_CHR);
			oci_bind_by_name($REG, ":P_USER_PASSWORD", $P_USER_PASSWORD, -1, SQLT_CHR);

			oci_execute($REG);
			oci_execute($curs);
			 while (($row = oci_fetch_array($curs, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
			  $output[]=$row;
			}
			$data=json_encode($output);
			$obj = json_decode($data);
			$obj[0]->STATUS_CODE;
			if($obj[0]->STATUS_CODE==="200"){
				$post_data = array(
						'status_code' => $obj[0]->STATUS_CODE,
						'msg' =>"Success",
						'values' => $obj
					);
				print json_encode($post_data);
			}elseif($obj[0]->STATUS_CODE==="500"){
				$post_data = array(
					'status_code' => $obj[0]->STATUS_CODE,
					'msg' =>$obj[0]->TYPE,
					'values' => $obj[0]->MSG

				);
				print json_encode($post_data);
			}else{
				$post_data = array(
					'status_code' => $obj[0]->STATUS_CODE,
					'msg' =>$obj[0]->TYPE,
					'values' => $obj[0]->MSG

				);
				print json_encode($post_data);
			}
			oci_free_statement($REG);
			oci_close($conn);
		}else{
			
			$post_data = array(
					'status_code' => '502',
					'msg' =>"Falied",
					'values' => "Enter The All Data !",
			);
				print json_encode($post_data);
		}
		
	}
	
	elseif($Type=="Get User List Spinner"){
		
		$P_USER_INFO_ID=$_POST['P_USER_INFO_ID'];
		  
		if($P_USER_INFO_ID !=""){
			 $curs = oci_new_cursor($conn);

			 $REG = oci_parse($conn, 
			 "begin SRL_MANGER_PROSESS_DATE.SRL_GET_USER_LIST_SPINNER
			 (:CURDATA,
			 :P_USER_INFO_ID
			 );
			 end;");

			oci_bind_by_name($REG, ":CURDATA", $curs, -1, OCI_B_CURSOR);
			oci_bind_by_name($REG, ":P_USER_INFO_ID", $P_USER_INFO_ID, -1, SQLT_CHR);

			oci_execute($REG);
			oci_execute($curs);
			 while (($row = oci_fetch_array($curs, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
			  $output[]=$row;
			}
			$data=json_encode($output);
			$obj = json_decode($data);
			$obj[0]->STATUS_CODE;
			if($obj[0]->STATUS_CODE==="200"){
				$post_data = array(
						'status_code' => $obj[0]->STATUS_CODE,
						'msg' =>"Success",
						'values' => $obj
					);
				print json_encode($post_data);
			}elseif($obj[0]->STATUS_CODE==="500"){
				$post_data = array(
					'status_code' => $obj[0]->STATUS_CODE,
					'msg' =>$obj[0]->TYPE,
					'values' => $obj[0]->MSG

				);
				print json_encode($post_data);
			}else{
				$post_data = array(
					'status_code' => $obj[0]->STATUS_CODE,
					'msg' =>$obj[0]->TYPE,
					'values' => $obj[0]->MSG

				);
				print json_encode($post_data);
			}
			oci_free_statement($REG);
			oci_close($conn);
		}else{
			
			$post_data = array(
					'status_code' => '502',
					'msg' =>"Falied",
					'values' => "Enter The All Data !",
			);
				print json_encode($post_data);
		}
		
	}
	
	elseif($Type=="Get Team List Spinner"){
		
		  

			 $curs = oci_new_cursor($conn);

			 $REG = oci_parse($conn, 
			 "begin SRL_MANGER_PROSESS_DATE.SRL_GET_TEAM_LIST_SPINNER
			 (:CURDATA);
			 end;");

			oci_bind_by_name($REG, ":CURDATA", $curs, -1, OCI_B_CURSOR);

			oci_execute($REG);
			oci_execute($curs);
			 while (($row = oci_fetch_array($curs, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
			  $output[]=$row;
			}
			$data=json_encode($output);
			$obj = json_decode($data);
			$obj[0]->STATUS_CODE;
			if($obj[0]->STATUS_CODE==="200"){
				$post_data = array(
						'status_code' => $obj[0]->STATUS_CODE,
						'msg' =>"Success",
						'values' => $obj
					);
				print json_encode($post_data);
			}elseif($obj[0]->STATUS_CODE==="500"){
				$post_data = array(
					'status_code' => $obj[0]->STATUS_CODE,
					'msg' =>$obj[0]->TYPE,
					'values' => $obj[0]->MSG

				);
				print json_encode($post_data);
			}else{
				$post_data = array(
					'status_code' => $obj[0]->STATUS_CODE,
					'msg' =>$obj[0]->TYPE,
					'values' => $obj[0]->MSG

				);
				print json_encode($post_data);
			}
			oci_free_statement($REG);
			oci_close($conn);

		
	}
	
	elseif($Type=="Forget Password"){
		
		$P_USER_EMAIL=$_POST['P_USER_EMAIL'];
		$P_USER_PASSWORD=md5($_POST['P_USER_PASSWORD']);
		$P_TYPE=$_POST['P_TYPE'];
		  
		if($P_USER_EMAIL !="" || $P_TYPE !=""){
			 $curs = oci_new_cursor($conn);

			 $REG = oci_parse($conn, 
			 "begin SRL_MANGER_PROSESS_DATE.SRL_FORGET_PASSWORD
			 (:CURDATA,
			 :P_USER_EMAIL,
			 :P_USER_PASSWORD,
			 :P_TYPE
			 );
			 end;");

			oci_bind_by_name($REG, ":CURDATA", $curs, -1, OCI_B_CURSOR);
			oci_bind_by_name($REG, ":P_USER_EMAIL", $P_USER_EMAIL, -1, SQLT_CHR);
			oci_bind_by_name($REG, ":P_USER_PASSWORD", $P_USER_PASSWORD, -1, SQLT_CHR);
			oci_bind_by_name($REG, ":P_TYPE", $P_TYPE, -1, SQLT_CHR);

			oci_execute($REG);
			oci_execute($curs);
			 while (($row = oci_fetch_array($curs, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
			  $output[]=$row;
			}
			$data=json_encode($output);
			$obj = json_decode($data);
			$obj[0]->STATUS_CODE;
			if($obj[0]->STATUS_CODE==="200"){
				$post_data = array(
						'status_code' => $obj[0]->STATUS_CODE,
						'msg' =>"Success",
						'values' => $obj
					);
				print json_encode($post_data);
			}elseif($obj[0]->STATUS_CODE==="500"){
				$post_data = array(
					'status_code' => $obj[0]->STATUS_CODE,
					'msg' =>$obj[0]->TYPE,
					'values' => $obj[0]->MSG

				);
				print json_encode($post_data);
			}else{
				$post_data = array(
					'status_code' => $obj[0]->STATUS_CODE,
					'msg' =>$obj[0]->TYPE,
					'values' => $obj[0]->MSG

				);
				print json_encode($post_data);
			}
			oci_free_statement($REG);
			oci_close($conn);
		}else{
			
			$post_data = array(
					'status_code' => '502',
					'msg' =>"Falied",
					'values' => "Enter The All Data !",
			);
				print json_encode($post_data);
		}
		
	}
	
	elseif($Type=="Canteen Info Add"){
		
		$P_USER_INFO_ID=$_POST['P_USER_INFO_ID'];
		$P_REMARKS=$_POST['P_REMARKS'];
		$P_MEAL_TAKE_DATE=$_POST['P_MEAL_TAKE_DATE'];
		$P_EMP_GEST=$_POST['P_EMP_GEST'];
		$P_ADMIN_SING=$_POST['P_ADMIN_SING'];
		$P_ADMIN_CONFIRAM=$_POST['P_ADMIN_CONFIRAM'];
		$P_USER_SING=$_POST['P_USER_SING'];
		$P_EMP_CONFIRAM=$_POST['P_EMP_CONFIRAM'];
		$P_STATUS=$_POST['P_STATUS'];
		  
		if($P_USER_INFO_ID !="" || $P_MEAL_TAKE_DATE !=""){
			 $curs = oci_new_cursor($conn);

			 $REG = oci_parse($conn, 
			 "begin SRL_MANGER_PROSESS_DATE.SRL_CANTEEN_INFO_IN
			 (:CURDATA,
			 :P_USER_INFO_ID,
			 :P_REMARKS,
			 :P_MEAL_TAKE_DATE,
			 :P_EMP_GEST,
			 :P_ADMIN_SING,
			 :P_ADMIN_CONFIRAM,
			 :P_USER_SING,
			 :P_EMP_CONFIRAM,
			 :P_STATUS
			 );
			 end;");

			oci_bind_by_name($REG, ":CURDATA", $curs, -1, OCI_B_CURSOR);
			oci_bind_by_name($REG, ":P_USER_PHONE", $P_USER_PHONE, -1, SQLT_CHR);
			oci_bind_by_name($REG, ":P_USER_PASSWORD", $P_USER_PASSWORD, -1, SQLT_CHR);

			oci_execute($REG);
			oci_execute($curs);
			 while (($row = oci_fetch_array($curs, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
			  $output[]=$row;
			}
			$data=json_encode($output);
			$obj = json_decode($data);
			$obj[0]->STATUS_CODE;
			if($obj[0]->STATUS_CODE==="200"){
				$post_data = array(
						'status_code' => $obj[0]->STATUS_CODE,
						'msg' =>"Success",
						'values' => $obj
					);
				print json_encode($post_data);
			}elseif($obj[0]->STATUS_CODE==="500"){
				$post_data = array(
					'status_code' => $obj[0]->STATUS_CODE,
					'msg' =>$obj[0]->TYPE,
					'values' => $obj[0]->MSG

				);
				print json_encode($post_data);
			}else{
				$post_data = array(
					'status_code' => $obj[0]->STATUS_CODE,
					'msg' =>$obj[0]->TYPE,
					'values' => $obj[0]->MSG

				);
				print json_encode($post_data);
			}
			oci_free_statement($REG);
			oci_close($conn);
		}else{
			
			$post_data = array(
					'status_code' => '502',
					'msg' =>"Falied",
					'values' => "Enter The All Data !",
			);
				print json_encode($post_data);
		}
		
	}
	
	elseif($Type=="Leave Info Add"){
		
		$P_USER_INFO_ID=$_POST['P_USER_INFO_ID'];
		$P_REASON_LEAVE=$_POST['P_REASON_LEAVE'];
		$P_PHN_DURING_LEAVE=$_POST['P_PHN_DURING_LEAVE'];
		$P_APPLICATION_DATE=$_POST['P_APPLICATION_DATE'];
		$P_REQ_LEAVE_FOR=$_POST['P_REQ_LEAVE_FOR'];
		$P_CATEGORY_LEAVE=$_POST['P_CATEGORY_LEAVE'];
		$P_LEAVE_TO_DATE=$_POST['P_LEAVE_TO_DATE'];
		$P_LEAVE_FROM_DATE=$_POST['P_LEAVE_FROM_DATE'];
		$P_RELIEVER_USER_INFO_ID=$_POST['P_RELIEVER_USER_INFO_ID'];
		$P_LEAVE_BALANCE_CHECKED_SING=$_POST['P_LEAVE_BALANCE_CHECKED_SING'];
		$P_TEAM_LEADER_SING=$_POST['P_TEAM_LEADER_SING'];
		$P_DIRECTOR_SING=$_POST['P_DIRECTOR_SING'];
		$P_MANAGING_DIRECTOR_SING=$_POST['P_MANAGING_DIRECTOR_SING'];
		$P_USER_SING=$_POST['P_USER_SING'];
		$P_LEAVE_STATUS=$_POST['P_LEAVE_STATUS'];
		  
		if($P_USER_INFO_ID !=""){
			 $curs = oci_new_cursor($conn);

			 $REG = oci_parse($conn, 
			 "begin SRL_MANGER_PROSESS_DATE.SRL_LEAVE_INFO_IN
			 (:CURDATA,
			 :P_USER_INFO_ID,
			 :P_REASON_LEAVE,
			 :P_PHN_DURING_LEAVE,
			 :P_APPLICATION_DATE,
			 :P_REQ_LEAVE_FOR,
			 :P_CATEGORY_LEAVE,
			 :P_LEAVE_TO_DATE,
			 :P_LEAVE_FROM_DATE,
			 :P_RELIEVER_USER_INFO_ID,
			 :P_LEAVE_BALANCE_CHECKED_SING,
			 :P_TEAM_LEADER_SING,
			 :P_DIRECTOR_SING,
			 :P_MANAGING_DIRECTOR_SING,
			 :P_USER_SING,
			 :P_LEAVE_STATUS
			 );
			 end;");

			oci_bind_by_name($REG, ":CURDATA", $curs, -1, OCI_B_CURSOR);
			oci_bind_by_name($REG, ":P_USER_INFO_ID", $P_USER_INFO_ID, -1, SQLT_CHR);
			oci_bind_by_name($REG, ":P_REASON_LEAVE", $P_REASON_LEAVE, -1, SQLT_CHR);
			oci_bind_by_name($REG, ":P_PHN_DURING_LEAVE", $P_PHN_DURING_LEAVE, -1, SQLT_CHR);
			oci_bind_by_name($REG, ":P_APPLICATION_DATE", $P_APPLICATION_DATE, -1, SQLT_CHR);
			oci_bind_by_name($REG, ":P_REQ_LEAVE_FOR", $P_REQ_LEAVE_FOR, -1, SQLT_CHR);
			oci_bind_by_name($REG, ":P_CATEGORY_LEAVE", $P_CATEGORY_LEAVE, -1, SQLT_CHR);
			oci_bind_by_name($REG, ":P_LEAVE_TO_DATE", $P_LEAVE_TO_DATE, -1, SQLT_CHR);
			oci_bind_by_name($REG, ":P_LEAVE_FROM_DATE", $P_LEAVE_FROM_DATE, -1, SQLT_CHR);
			oci_bind_by_name($REG, ":P_RELIEVER_USER_INFO_ID", $P_RELIEVER_USER_INFO_ID, -1, SQLT_CHR);
			oci_bind_by_name($REG, ":P_LEAVE_BALANCE_CHECKED_SING", $P_LEAVE_BALANCE_CHECKED_SING, -1, SQLT_CHR);
			oci_bind_by_name($REG, ":P_TEAM_LEADER_SING", $P_TEAM_LEADER_SING, -1, SQLT_CHR);
			oci_bind_by_name($REG, ":P_DIRECTOR_SING", $P_DIRECTOR_SING, -1, SQLT_CHR);
			oci_bind_by_name($REG, ":P_MANAGING_DIRECTOR_SING", $P_MANAGING_DIRECTOR_SING, -1, SQLT_CHR);
			oci_bind_by_name($REG, ":P_USER_SING", $P_USER_SING, -1, SQLT_CHR);
			oci_bind_by_name($REG, ":P_LEAVE_STATUS", $P_LEAVE_STATUS, -1, SQLT_CHR);

			oci_execute($REG);
			oci_execute($curs);
			 while (($row = oci_fetch_array($curs, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
			  $output[]=$row;
			}
			$data=json_encode($output);
			$obj = json_decode($data);
			$obj[0]->STATUS_CODE;
			if($obj[0]->STATUS_CODE==="200"){
				$post_data = array(
						'status_code' => $obj[0]->STATUS_CODE,
						'msg' =>$obj[0]->TYPE,
						'values' =>$obj[0]->MSG
					);
				print json_encode($post_data);
			}elseif($obj[0]->STATUS_CODE==="500"){
				$post_data = array(
					'status_code' => $obj[0]->STATUS_CODE,
					'msg' =>$obj[0]->TYPE,
					'values' => $obj[0]->MSG

				);
				print json_encode($post_data);
			}else{
				$post_data = array(
					'status_code' => $obj[0]->STATUS_CODE,
					'msg' =>$obj[0]->TYPE,
					'values' => $obj[0]->MSG

				);
				print json_encode($post_data);
			}
			oci_free_statement($REG);
			oci_close($conn);
		}else{
			
			$post_data = array(
					'status_code' => '502',
					'msg' =>"Falied",
					'values' => "Enter The All Data !",
			);
				print json_encode($post_data);
		}
		
	}
	
	elseif($Type=="User Online Status Update"){
		
		$P_USER_INFO_ID=$_POST['P_USER_INFO_ID'];
		$P_ONLINE_STATUS=$_POST['P_ONLINE_STATUS'];
		  
		if($P_USER_INFO_ID !="" || $P_ONLINE_STATUS !=""){
			 $curs = oci_new_cursor($conn);

			 $REG = oci_parse($conn, 
			 "begin SRL_MANGER_PROSESS_DATE.SRL_USER_ONLINE_STATUS
			 (:CURDATA,
			 :P_USER_INFO_ID,
			 :P_ONLINE_STATUS
			 );
			 end;");

			oci_bind_by_name($REG, ":CURDATA", $curs, -1, OCI_B_CURSOR);
			oci_bind_by_name($REG, ":P_USER_INFO_ID", $P_USER_INFO_ID, -1, SQLT_CHR);
			oci_bind_by_name($REG, ":P_ONLINE_STATUS", $P_ONLINE_STATUS, -1, SQLT_CHR);

			oci_execute($REG);
			oci_execute($curs);
			 while (($row = oci_fetch_array($curs, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
			  $output[]=$row;
			}
			$data=json_encode($output);
			$obj = json_decode($data);
			$obj[0]->STATUS_CODE;
			if($obj[0]->STATUS_CODE==="200"){
				$post_data = array(
						'status_code' => $obj[0]->STATUS_CODE,
						'msg' =>$obj[0]->TYPE,
						'values' => $obj[0]->MSG
					);
				print json_encode($post_data);
			}elseif($obj[0]->STATUS_CODE==="500"){
				$post_data = array(
					'status_code' => $obj[0]->STATUS_CODE,
					'msg' =>$obj[0]->TYPE,
					'values' => $obj[0]->MSG

				);
				print json_encode($post_data);
			}else{
				$post_data = array(
					'status_code' => $obj[0]->STATUS_CODE,
					'msg' =>$obj[0]->TYPE,
					'values' => $obj[0]->MSG

				);
				print json_encode($post_data);
			}
			oci_free_statement($REG);
			oci_close($conn);
		}else{
			
			$post_data = array(
					'status_code' => '502',
					'msg' =>"Falied",
					'values' => "Enter The All Data !",
			);
				print json_encode($post_data);
		}
		
	}
	
	elseif($Type=="User Online Users"){
		
		 $curs = oci_new_cursor($conn);

		 $REG = oci_parse($conn, 
		 "begin SRL_MANGER_PROSESS_DATE.SRL_GET_ONLINE_USER
		 (:CURDATA);
		 end;");

		oci_bind_by_name($REG, ":CURDATA", $curs, -1, OCI_B_CURSOR);

		oci_execute($REG);
		oci_execute($curs);
		 while (($row = oci_fetch_array($curs, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
		  $output[]=$row;
		}
		$data=json_encode($output);
		$obj = json_decode($data);
		$obj[0]->STATUS_CODE;
		if($obj[0]->STATUS_CODE==="200"){
			$post_data = array(
					'status_code' => $obj[0]->STATUS_CODE,
					'msg' =>"Success",
					'values' => $obj
				);
			print json_encode($post_data);
		}elseif($obj[0]->STATUS_CODE==="500"){
			$post_data = array(
				'status_code' => $obj[0]->STATUS_CODE,
				'msg' =>$obj[0]->TYPE,
				'values' => $obj[0]->MSG

			);
			print json_encode($post_data);
		}else{
			$post_data = array(
				'status_code' => $obj[0]->STATUS_CODE,
				'msg' =>$obj[0]->TYPE,
				'values' => $obj[0]->MSG

			);
			print json_encode($post_data);
		}
		oci_free_statement($REG);
		oci_close($conn);
		
		
	}
	
	elseif($Type=="Get Users List"){
		
		 $curs = oci_new_cursor($conn);

		 $REG = oci_parse($conn, 
		 "begin SRL_MANGER_PROSESS_DATE.SRL_GET_USER_LIST
		 (:CURDATA);
		 end;");

		oci_bind_by_name($REG, ":CURDATA", $curs, -1, OCI_B_CURSOR);

		oci_execute($REG);
		oci_execute($curs);
		 while (($row = oci_fetch_array($curs, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
		  $output[]=$row;
		}
		$data=json_encode($output);
		$obj = json_decode($data);
		$obj[0]->STATUS_CODE;
		if($obj[0]->STATUS_CODE==="200"){
			$post_data = array(
					'status_code' => $obj[0]->STATUS_CODE,
					'msg' =>"Success",
					'values' => $obj
				);
			print json_encode($post_data);
		}elseif($obj[0]->STATUS_CODE==="500"){
			$post_data = array(
				'status_code' => $obj[0]->STATUS_CODE,
				'msg' =>$obj[0]->TYPE,
				'values' => $obj[0]->MSG

			);
			print json_encode($post_data);
		}else{
			$post_data = array(
				'status_code' => $obj[0]->STATUS_CODE,
				'msg' =>$obj[0]->TYPE,
				'values' => $obj[0]->MSG

			);
			print json_encode($post_data);
		}
		oci_free_statement($REG);
		oci_close($conn);
		
		
	}
	
	
	
}

else{
	 $post_data = array(
	  'responce' => array(
		'status_code' => '502',
		'msg' => 'Failed',
		'values' => 'Sorry You Are Not Allow Here',
	  )
	);
}

?>