<?php
include 'conn.php';
				
	if($_SERVER['REQUEST_METHOD'] === 'POST'){

		  $P_SERVICE_ID=$_POST['P_SERVICE_ID'];
		  $P_SERVICE_STATUS=$_POST['P_SERVICE_STATUS'];
		  $P_USER_INFO_ID_SP=$_POST['P_USER_INFO_ID_SP'];
		 
		 $curs = oci_new_cursor($conn);

		 $REG = oci_parse($conn, 
		 "begin OAA_PROSESS_DATA.OAA_SERVICE_STATUS_UPDATE
		 (:CUR_DATA,
		 :P_SERVICE_ID,
		 :P_SERVICE_STATUS,
		 :P_USER_INFO_ID_SP
		 );
		 end;");

		oci_bind_by_name($REG, ":CUR_DATA", $curs, -1, OCI_B_CURSOR);
		oci_bind_by_name($REG, ":P_SERVICE_ID", $P_SERVICE_ID, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_SERVICE_STATUS", $P_SERVICE_STATUS, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_USER_INFO_ID_SP", $P_USER_INFO_ID_SP, -1, SQLT_CHR);

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