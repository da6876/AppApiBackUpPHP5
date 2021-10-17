<?php
error_reporting(0);
include 'conn.php';
				
	if($_SERVER['REQUEST_METHOD'] === 'POST'){

		  $P_USER_PHONE=$_POST['P_USER_PHONE'];
		  $P_USER_PASSWORD=$_POST['P_USER_PASSWORD'];
		 
		 $curs = oci_new_cursor($conn);

		 $REG = oci_parse($conn, 
		 "begin FMH_DATA_PROSESS.FMH_APP_FGP_PASSWORD
		 (:CUR_DATA,
		 :P_USER_PHONE,
		 :P_USER_PASSWORD
		 );
		 end;");

		oci_bind_by_name($REG, ":CUR_DATA", $curs, -1, OCI_B_CURSOR);
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