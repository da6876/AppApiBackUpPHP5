<?php
error_reporting(0);
include 'conn.php';
				
	if($_SERVER['REQUEST_METHOD'] === 'POST'){

		  $P_USER_INFO_ID_ONE=$_POST['P_USER_INFO_ID_ONE'];
		  $P_USER_ADDRESS_ONE=$_POST['P_USER_ADDRESS_ONE'];
		  $P_USER_LATITUDE_ONE=$_POST['P_USER_LATITUDE_ONE'];
		  $P_USER_LONGITUDE_ONE=$_POST['P_USER_LONGITUDE_ONE'];
		  $P_USER_INFO_ID_TWO=$_POST['P_USER_INFO_ID_TWO'];
		  $P_USER_ADDRESS_TWO=$_POST['P_USER_ADDRESS_TWO'];
		  $P_USER_LATITUDE_TWO=$_POST['P_USER_LATITUDE_TWO'];
		  $P_USER_LONGITUDE_TWO=$_POST['P_USER_LONGITUDE_TWO'];
		  $P_CONT_STATUS=$_POST['P_CONT_STATUS'];
		 
		 $curs = oci_new_cursor($conn);

		 $REG = oci_parse($conn, 
		 "begin FMH_DATA_PROSESS.FMH_ADD_USER_CONT_INFO
		 (:CUR_DATA,
		 :P_USER_INFO_ID_ONE,
		 :P_USER_ADDRESS_ONE,
		 :P_USER_LATITUDE_ONE,
		 :P_USER_LONGITUDE_ONE,
		 :P_USER_INFO_ID_TWO,
		 :P_USER_ADDRESS_TWO,
		 :P_USER_LATITUDE_TWO,
		 :P_USER_LONGITUDE_TWO,
		 :P_CONT_STATUS
		 );
		 end;");

		oci_bind_by_name($REG, ":CUR_DATA", $curs, -1, OCI_B_CURSOR);
		oci_bind_by_name($REG, ":P_USER_INFO_ID_ONE", $P_USER_INFO_ID_ONE, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_USER_ADDRESS_ONE", $P_USER_ADDRESS_ONE, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_USER_LATITUDE_ONE", $P_USER_LATITUDE_ONE, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_USER_LONGITUDE_ONE", $P_USER_LONGITUDE_ONE, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_USER_INFO_ID_TWO", $P_USER_INFO_ID_TWO, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_USER_ADDRESS_TWO", $P_USER_ADDRESS_TWO, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_USER_LATITUDE_TWO", $P_USER_LATITUDE_TWO, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_USER_LONGITUDE_TWO", $P_USER_LONGITUDE_TWO, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_CONT_STATUS", $P_CONT_STATUS, -1, SQLT_CHR);

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