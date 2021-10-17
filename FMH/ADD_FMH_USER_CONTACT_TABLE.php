<?php
error_reporting(0);
include 'conn.php';
				
	if($_SERVER['REQUEST_METHOD'] === 'POST'){

		  $P_USER_INFO_ID=$_POST['P_USER_INFO_ID'];
		  $P_CON_NAME=$_POST['P_CON_NAME'];
		  $P_CON_PHONE=$_POST['P_CON_PHONE'];
		  $P_CON_STATUS=$_POST['P_CON_STATUS'];
		  $P_CREATE_BY=$_POST['P_CREATE_BY'];
		 
		 $curs = oci_new_cursor($conn);

		 $REG = oci_parse($conn, 
		 "begin FMH_DATA_PROSESS.FMH_ADD_USER_CONTACT_TABLE
		 (:CUR_DATA,
		 :P_USER_INFO_ID,
		 :P_CON_NAME,
		 :P_CON_PHONE,
		 :P_CON_STATUS,
		 :P_CREATE_BY
		 );
		 end;");

		oci_bind_by_name($REG, ":CUR_DATA", $curs, -1, OCI_B_CURSOR);
		oci_bind_by_name($REG, ":P_USER_INFO_ID", $P_USER_INFO_ID, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_CON_NAME", $P_CON_NAME, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_CON_PHONE", $P_CON_PHONE, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_CON_STATUS", $P_CON_STATUS, -1, SQLT_CHR);
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
					'msg' => "Succcess",
					'values' => $obj,
				  )
				);
		}else{
			$post_data = array(
			  'responce' => array(
				'status_code' => $obj[0]->STATUS_CODE,
					'msg' => "Failed",
					'values' => $obj,
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