<?php

$mBillCorporate = "(DESCRIPTION = 
					(ADDRESS = (PROTOCOL = TCP)(HOST = localhost)(PORT = 1521))
					(CONNECT_DATA =(SERVER = DEDICATED)(SERVICE_NAME = DA)))";

				$conn = ocilogon( "SOCAPP", "SOCAPP",$mBillCorporate,"WE8ISO8859P15");

	if($_SERVER['REQUEST_METHOD'] === 'POST'){
		 $P_USER_NAME=$_POST['P_USER_NAME'];
		 $P_USER_PASSWORD=$_POST['P_USER_PASSWORD'];
		 //$P_USER_NAME="1955375749";
		 //$P_USER_PASSWORD="12345678";
		 
		 $curs = oci_new_cursor($conn);

		 $REG = oci_parse($conn, 
		 "begin APP_FYH_INSERT_DATA.FYH_USER_LOGIN
		 (:CUR_DATA,
		 :P_USER_NAME,
		 :P_USER_PASSWORD
		 );
		 end;");

		oci_bind_by_name($REG, ":CUR_DATA", $curs, -1, OCI_B_CURSOR);
		oci_bind_by_name($REG, ":P_USER_NAME", $P_USER_NAME, -1, SQLT_CHR);
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
					'status_code' => "500",
					'msg' => "Success",
					'values' => $obj,
				  )
				);
		print json_encode($post_data);
		}else{
			$post_data = array(
			  'responce' => array(
				'status_code' => $obj[0]->STATUS_CODE,
				'msg' => $obj[0]->STATUS_TYPE,
				'values' => $obj[0]->MSG,
			  )
			);
		print json_encode($post_data);
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
		print json_encode($post_data);
	 }
?>