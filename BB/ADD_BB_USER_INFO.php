<?php
include 'conn.php';
				
	if($_SERVER['REQUEST_METHOD'] === 'POST'){

//===================================================================
		  $P_BB_USER_TYPE_ID=$_POST['P_BB_USER_TYPE_ID'];
		  $P_BB_LOCATION_INFO_ID=$_POST['P_BB_LOCATION_INFO_ID'];
		  $P_BB_USER_INFO_NAME=$_POST['P_BB_USER_INFO_NAME'];
		  $P_BB_USER_FAST_NAME=$_POST['P_BB_USER_FAST_NAME'];
		  $P_BB_USER_LAST_NAME=$_POST['P_BB_USER_LAST_NAME'];
		  $P_BB_USER_PASSWORD=$_POST['P_BB_USER_PASSWORD'];
		  $P_BB_USER_PHONE=$_POST['P_BB_USER_PHONE'];
		  $P_BB_USER_EMAIL=$_POST['P_BB_USER_EMAIL'];
		  $P_BB_USER_REFER_NO=$_POST['P_BB_USER_REFER_NO'];
		  $P_BB_USER_POINT=$_POST['P_BB_USER_POINT'];
		  $P_BB_USER_ADDRESS=$_POST['P_BB_USER_ADDRESS'];
		  $P_BB_USER_LATITUDE=$_POST['P_BB_USER_LATITUDE'];
		  $P_BB_USER_LONGITUDE=$_POST['P_BB_USER_LONGITUDE'];
		  $P_BB_USER_STATUS=$_POST['P_BB_USER_STATUS'];
		  $P_CREATE_BY=$_POST['P_CREATE_BY'];
		 
		 $curs = oci_new_cursor($conn);

		 $REG = oci_parse($conn, 
		 "begin BB_ADD_DATA_PROSESS.ADD_BB_USER_INFO
		 (:CURDATA,
		 :P_BB_USER_TYPE_ID,
		 :P_BB_LOCATION_INFO_ID,
		 :P_BB_USER_INFO_NAME,
		 :P_BB_USER_FAST_NAME,
		 :P_BB_USER_LAST_NAME,
		 :P_BB_USER_PASSWORD,
		 :P_BB_USER_PHONE,
		 :P_BB_USER_EMAIL,
		 :P_BB_USER_REFER_NO,
		 :P_BB_USER_POINT,
		 :P_BB_USER_ADDRESS,
		 :P_BB_USER_LATITUDE,
		 :P_BB_USER_LONGITUDE,
		 :P_BB_USER_STATUS,
		 :P_CREATE_BY
		 );
		 end;");

		oci_bind_by_name($REG, ":CURDATA", $curs, -1, OCI_B_CURSOR);
		oci_bind_by_name($REG, ":P_BB_USER_TYPE_ID", $P_BB_USER_TYPE_ID, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_BB_LOCATION_INFO_ID", $P_BB_LOCATION_INFO_ID, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_BB_USER_INFO_NAME", $P_BB_USER_INFO_NAME, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_BB_USER_FAST_NAME", $P_BB_USER_FAST_NAME, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_BB_USER_LAST_NAME", $P_BB_USER_LAST_NAME, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_BB_USER_PASSWORD", $P_BB_USER_PASSWORD, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_BB_USER_PHONE", $P_BB_USER_PHONE, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_BB_USER_EMAIL", $P_BB_USER_EMAIL, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_BB_USER_REFER_NO", $P_BB_USER_REFER_NO, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_BB_USER_POINT", $P_BB_USER_POINT, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_BB_USER_ADDRESS", $P_BB_USER_ADDRESS, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_BB_USER_LATITUDE", $P_BB_USER_LATITUDE, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_BB_USER_LONGITUDE", $P_BB_USER_LONGITUDE, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_BB_USER_STATUS", $P_BB_USER_STATUS, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_CREATE_BY", $P_CREATE_BY, -1, SQLT_CHR);

		oci_execute($REG);
		oci_execute($curs);
		 while (($row = oci_fetch_array($curs, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
		  $output[]=$row;
		}
		print $data=json_encode($output);
		/* $obj = json_decode($data);
		$obj[0]->STATUS_CODE;
		if($obj[0]->STATUS_CODE==="200"){
			$post_data = array(
				  'responce' => array(
					'status_code' => $obj[0]->STATUS_CODE,
					'msg' =>$obj[0]->TYPE,
					'values' => $obj[0]->$MSG
				  )
				);
		}elseif($obj[0]->STATUS_CODE==="500"){
			$post_data = array(
			  'responce' => array(
					'status_code' => $obj[0]->STATUS_CODE,
					'msg' =>$obj[0]->TYPE,
					'values' => $obj[0]->$MSG
			  )
			);
		}else{
			$post_data = array(
			  'responce' => array(
					'status_code' => '501',
					'msg' =>"Falied",
					'values' => "Internal Server Error",
			  )
			);
		} */
		
		oci_free_statement($REG);
		oci_close($conn);
 	  }else{
		 $post_data = array(
		  'responce' => array(
			'status_code' => '502',
			'msg' => 'Failed',
			'values' => 'Sorry You Are Not Allow Here',
		  )
		);
		
print json_encode($post_data);
	 }  
?>