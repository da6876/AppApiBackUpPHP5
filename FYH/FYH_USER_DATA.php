<?php
//error_reporting(0);
include 'conn.php';

	//if($_SERVER['REQUEST_METHOD'] === 'POST'){
		 //$P_USER_ACC_ID=$_POST['P_USER_ACC_ID'];
		 $P_USER_ACC_ID='11220026';
		 //$P_USER_ACC_ID='11220027';
		 //$P_USER_PASSWORD=$_POST['P_USER_PASSWORD'];
		 //$P_USER_NAME="500";
		 //$P_USER_PASSWORD="11";
		 
		 $curs = oci_new_cursor($conn);

		 $REG = oci_parse($conn, 
		 "begin APP_FYH_INSERT_DATA.FYH_USER_DATA
		 (:CUR_DATA,
		 :P_USER_ACC_ID
		 );
		 end;");

		oci_bind_by_name($REG, ":CUR_DATA", $curs, -1, OCI_B_CURSOR);
		oci_bind_by_name($REG, ":P_USER_ACC_ID", $P_USER_ACC_ID, -1, SQLT_INT);

		oci_execute($REG);
		oci_execute($curs);
		 while (($row = oci_fetch_array($curs, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
		  $output[]=$row;
		}
		$data=json_encode($output);
		$obj = json_decode($data);
		$obj[0]->USER_ACC_ID;
		if($obj[0]->USER_ACC_ID!=""){
			$post_data = array(
				  'responce' => array(
					'status_code' => "200",
					'msg' => "Success",
					'values' => $obj,
				  )
				);
		}else{
			$post_data = array(
			  'responce' => array(
					'status_code' => "500",
					'msg' => "Failed",
				'values' => $obj[0]->MSG,
			  )
			);
		}
		oci_free_statement($REG);
		oci_close($conn);
	 /*}else{
		 $post_data = array(
		  'responce' => array(
			'status_code' => '400',
			'msg' => 'Failed',
			'values' => 'Sorry You Are Not Allow Here',
		  )
		);


	 }*/
print json_encode($post_data);
?>