<?php
include 'conn.php';
				
	if($_SERVER['REQUEST_METHOD'] === 'POST'){

		  $P_USER_ACC_ID=$_POST['P_USER_ACC_ID'];
		  $P_USER_NAME=$_POST['P_USER_NAME'];
		  $P_USER_EMAIL=$_POST['P_USER_EMAIL'];
		  $P_USER_PASSWORD=$_POST['P_USER_PASSWORD'];
		  $P_LATTITUDE=$_POST['P_LATTITUDE'];
		  $P_LOGLITUTDE=$_POST['P_LOGLITUTDE'];
		  $P_ADDRESS=$_POST['P_ADDRESS'];
		  $P_USER_PHONE=$_POST['P_USER_PHONE'];
		  //$P_USER_IMAGE=$_POST['P_USER_IMAGE'];
		  $P_GENDER=$_POST['P_GENDER'];
		  $P_UPDATE_BY=$_POST['P_UPDATE_BY'];
		  $P_STATUS=$_POST['P_STATUS'];
		 
		 $curs = oci_new_cursor($conn);

		 $REG = oci_parse($conn, 
		 "begin APP_FYH_INSERT_DATA.FYH_UPDATE_USER_PROFILE
		 (:CUR_DATA,
		 :P_USER_ACC_ID,
		 :P_USER_NAME,
		 :P_USER_EMAIL,
		 :P_USER_PASSWORD,
		 :P_LATTITUDE,
		 :P_LOGLITUTDE,
		 :P_ADDRESS,
		 :P_USER_PHONE,
		 :P_GENDER,
		 :P_UPDATE_BY,
		 :P_STATUS
		 );
		 end;");

		oci_bind_by_name($REG, ":CUR_DATA", $curs, -1, OCI_B_CURSOR);
		oci_bind_by_name($REG, ":P_USER_ACC_ID", $P_USER_ACC_ID, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_USER_NAME", $P_USER_NAME, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_USER_EMAIL", $P_USER_EMAIL, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_USER_PASSWORD", $P_USER_PASSWORD, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_LATTITUDE", $P_LATTITUDE, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_LOGLITUTDE", $P_LOGLITUTDE, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_ADDRESS", $P_ADDRESS, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_USER_PHONE", $P_USER_PHONE, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_GENDER", $P_GENDER, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_UPDATE_BY", $P_UPDATE_BY, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_STATUS", $P_STATUS, -1, SQLT_CHR);

		oci_execute($REG);
		oci_execute($curs);
		 while (($row = oci_fetch_array($curs, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
		  $output[]=$row;
		}
		$data=json_encode($output);
		$obj = json_decode($data);
		$obj[0]->STATUS_CODE;
		if($obj[0]->STATUS_CODE==="500"){
			$post_data = array(
				  'responce' => array(
					'status_code' => $obj[0]->STATUS_CODE,
					'msg' => $obj[0]->STATUS_TYPE,
					'values' => $obj[0]->MSG,
				  )
				);
		}else{
			$post_data = array(
			  'responce' => array(
				'status_code' => $obj[0]->STATUS_CODE,
				'msg' => $obj[0]->STATUS_TYPE,
				'values' => $obj[0]->MSG,
			  )
			);
		}
		
		oci_free_statement($REG);
		oci_close($conn);
 	 }else{
		 $post_data = array(
		  'responce' => array(
			'status_code' => '400',
			'msg' => 'Failed',
			'values' => 'Sorry You Are Not Allow Here',
		  )
		);
	 } 
print json_encode($post_data);
?>