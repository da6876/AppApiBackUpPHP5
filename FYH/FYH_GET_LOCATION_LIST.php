<?php
//error_reporting(0);
include 'conn.php';

	//if($_SERVER['REQUEST_METHOD'] === 'POST'){

		 
		 $curs = oci_new_cursor($conn);

		 $REG = oci_parse($conn, 
		 "begin APP_FYH_INSERT_DATA.FYH_GET_LOCATION_LIST
		 (:CUR_DATA);
		 end;");

		oci_bind_by_name($REG, ":CUR_DATA", $curs, -1, OCI_B_CURSOR);

		oci_execute($REG);
		oci_execute($curs);
		 while (($row = oci_fetch_array($curs, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
		  $output[]=$row;
		}
		$data=json_encode($output);
		$obj = json_decode($data);
		$obj[0]->STATUS_CODE;
		if($obj[0]->STATUS_CODE="500"){
			$post_data = array(
				  'responce' => array(
					'status_code' => "500",
					'msg' => "Success",
					'values' => $obj,
				  )
				);
		}else{
			$post_data = array(
			  'responce' => array(
					'status_code' => "200",
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