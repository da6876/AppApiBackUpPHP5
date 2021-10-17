<?php
include 'conn.php';
				
	if($_SERVER['REQUEST_METHOD'] === 'POST'){
		  /* $P_USER_ACC_ID="12";
		  $P_TOLET_NAME="sa";
		  $P_TOLET_DETAILS="asd";
		  $P_ADDRESS="as";
		  $P_LATTITUDE="67";
		  $P_LOGLITUTDE="78";
		  $P_PRICE="333";
		  $P_BATHS="2";
		  $P_BEDS="2";
		  $P_FLOORS="3";
		  $P_AVAILABLE_FROM="asd";
		  $P_CONTACT_PERSON_NM="asd";
		  $P_CONTACT_PERSON_PHN="35434";
		  $P_CONTACT_PERSON_EML="afafs";
		  $P_TOLET_TYPE_ID="11330002";
		  $P_PRODUCT_IMAGE="adsgag";
		  $P_CREATE_DATA="5/5/2019";
		  $P_CREATE_BY="dsfg"; */
//===================================================================
		  $P_USER_INFO_NAME=$_POST['P_USER_INFO_NAME'];
		  $P_LOCATION_CODE=$_POST['P_LOCATION_CODE'];
		  $P_USER_FAST_NAME=$_POST['P_USER_FAST_NAME'];
		  $P_USER_LAST_NAME=$_POST['P_USER_LAST_NAME'];
		  $P_USER_PHONE=$_POST['P_USER_PHONE'];
		  $P_USER_EMAIL=$_POST['P_USER_EMAIL'];
		  $P_USER_PASSWORD=$_POST['P_USER_PASSWORD'];
		  $P_USER_REFER_NO=$_POST['P_USER_REFER_NO'];
		  $P_USER_POINT=$_POST['P_USER_POINT'];
		  $P_USER_ADDRESS=$_POST['P_USER_ADDRESS'];
		  $P_USER_LATITUDE=$_POST['P_USER_LATITUDE'];
		  $P_USER_LONGITUDE=$_POST['P_USER_LONGITUDE'];
		  $P_USER_STATUS=$_POST['P_USER_STATUS'];
		  $P_CREATE_BY=$_POST['P_CREATE_BY'];
		 
		 $curs = oci_new_cursor($conn);

		 $REG = oci_parse($conn, 
		 "begin OAA_PROSESS_DATA.OAA_INSERT_NEW_USER
		 (:CURDATA,
		 :P_USER_INFO_NAME,
		 :P_LOCATION_CODE,
		 :P_USER_FAST_NAME,
		 :P_USER_LAST_NAME,
		 :P_USER_PHONE,
		 :P_USER_EMAIL,
		 :P_USER_PASSWORD,
		 :P_USER_REFER_NO,
		 :P_USER_POINT,
		 :P_USER_ADDRESS,
		 :P_USER_LATITUDE,
		 :P_USER_LONGITUDE,
		 :P_USER_STATUS,
		 :P_CREATE_BY
		 );
		 end;");

		oci_bind_by_name($REG, ":CURDATA", $curs, -1, OCI_B_CURSOR);
		oci_bind_by_name($REG, ":P_USER_INFO_NAME", $P_USER_INFO_NAME, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_LOCATION_CODE", $P_LOCATION_CODE, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_USER_FAST_NAME", $P_USER_FAST_NAME, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_USER_LAST_NAME", $P_USER_LAST_NAME, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_USER_PHONE", $P_USER_PHONE, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_USER_EMAIL", $P_USER_EMAIL, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_USER_PASSWORD", $P_USER_PASSWORD, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_USER_REFER_NO", $P_USER_REFER_NO, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_USER_POINT", $P_USER_POINT, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_USER_ADDRESS", $P_USER_ADDRESS, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_USER_LATITUDE", $P_USER_LATITUDE, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_USER_LONGITUDE", $P_USER_LONGITUDE, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_USER_STATUS", $P_USER_STATUS, -1, SQLT_CHR);
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
					'msg' => $obj[0]->STATUS_TYPE,
					'values' => $obj[0]->MSG,
				  )
				);
		}else{
			$post_data = array(
			  'responce' => array(
				'status_code' => $obj[0]->STATUS_CODE,
				'msg' => $obj[0]->STATUS_TYPE,
				'values' => $obj[0]->MSG,
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