<?php
include 'conn.php';
				
	if($_SERVER['REQUEST_METHOD'] === 'POST'){

//===================================================================
		  $P_TOKEN_NO=$_POST['P_TOKEN_NO'];
		  $P_USER_INFO_ID=$_POST['P_USER_INFO_ID'];
		  $P_MOBILE_NUM=$_POST['P_MOBILE_NUM'];
		  $P_SERVICE_TYPE_ID=$_POST['P_SERVICE_TYPE_ID'];
		  $P_SERVICE_STATUS=$_POST['P_SERVICE_STATUS'];
		  $P_REMARKS=$_POST['P_REMARKS'];
		  $P_USER_ADDRESS=$_POST['P_USER_ADDRESS'];
		  $P_USER_LATITUDE=$_POST['P_USER_LATITUDE'];
		  $P_USER_LONGITUDE=$_POST['P_USER_LONGITUDE'];
		  $P_LOCATION_CODE=$_POST['P_LOCATION_CODE'];
		  $P_CREATE_BY=$_POST['P_CREATE_BY'];
		 
		 $curs = oci_new_cursor($conn);

		 $REG = oci_parse($conn, 
		 "begin OAA_PROSESS_DATA.OAA_ADD_SERVICE
		 (:CURDATA,
		 :P_TOKEN_NO,
		 :P_USER_INFO_ID,
		 :P_MOBILE_NUM,
		 :P_SERVICE_TYPE_ID,
		 :P_SERVICE_STATUS,
		 :P_REMARKS,
		 :P_USER_ADDRESS,
		 :P_USER_LATITUDE,
		 :P_USER_LONGITUDE,
		 :P_LOCATION_CODE,
		 :P_CREATE_BY
		 );
		 end;");

		oci_bind_by_name($REG, ":CURDATA", $curs, -1, OCI_B_CURSOR);
		oci_bind_by_name($REG, ":P_TOKEN_NO", $P_TOKEN_NO, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_USER_INFO_ID", $P_USER_INFO_ID, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_MOBILE_NUM", $P_MOBILE_NUM, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_SERVICE_TYPE_ID", $P_SERVICE_TYPE_ID, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_SERVICE_STATUS", $P_SERVICE_STATUS, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_REMARKS", $P_REMARKS, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_USER_ADDRESS", $P_USER_ADDRESS, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_USER_LATITUDE", $P_USER_LATITUDE, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_USER_LONGITUDE", $P_USER_LONGITUDE, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_LOCATION_CODE", $P_LOCATION_CODE, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_CREATE_BY", $P_CREATE_BY, -1, SQLT_CHR);

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
					'msg' =>$obj[0]->STATUS_TYPE,
					'values' => $obj
				  )
				);
		}else{
			$post_data = array(
			  'responce' => array(
					'status_code' => $obj[0]->STATUS_CODE,
					'msg' =>$obj[0]->STATUS_TYPE,
					'values' => $obj
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