<?php
error_reporting(0);
include 'conn.php';
				
	if($_SERVER['REQUEST_METHOD'] === 'POST'){

		  $P_USER_ID=$_POST['P_USER_ID'];
		  $P_PRODUCT_NAME=$_POST['P_PRODUCT_NAME'];
		  $P_PRODUCT_DEATILS=$_POST['P_PRODUCT_DEATILS'];
		  $P_PRODUCT_ADDRESS=$_POST['P_PRODUCT_ADDRESS'];
		  $P_PRODUCT_IMAGE=$_POST['P_PRODUCT_IMAGE'];
		  $P_PRODUCT_STATUS=$_POST['P_PRODUCT_STATUS'];
		  $P_CREATE_BY=$_POST['P_CREATE_BY'];
		 
		 $curs = oci_new_cursor($conn);

		 $REG = oci_parse($conn, 
		 "begin FOOD_DELIVERY_PROSESS_DATA.FA_INSERT_SOC_FA_PRODUCT_TABLE
		 (:CUR_DATA,
		 :P_USER_ID,
		 :P_PRODUCT_NAME,
		 :P_PRODUCT_DEATILS,
		 :P_PRODUCT_ADDRESS,
		 :P_PRODUCT_IMAGE,
		 :P_PRODUCT_STATUS,
		 :P_CREATE_BY
		 );
		 end;");

		oci_bind_by_name($REG, ":CUR_DATA", $curs, -1, OCI_B_CURSOR);
		oci_bind_by_name($REG, ":P_USER_ID", $P_USER_ID, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_PRODUCT_NAME", $P_PRODUCT_NAME, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_PRODUCT_DEATILS", $P_PRODUCT_DEATILS, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_PRODUCT_ADDRESS", $P_PRODUCT_ADDRESS, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_PRODUCT_IMAGE", $P_PRODUCT_IMAGE, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_PRODUCT_STATUS", $P_PRODUCT_STATUS, -1, SQLT_CHR);
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