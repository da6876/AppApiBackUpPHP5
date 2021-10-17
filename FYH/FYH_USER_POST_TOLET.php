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
		  $P_USER_ACC_ID=$_POST['P_USER_ACC_ID'];
		  $P_TOLET_NAME=$_POST['P_TOLET_NAME'];
		  $P_TOLET_DETAILS=$_POST['P_TOLET_DETAILS'];
		  $P_ADDRESS=$_POST['P_ADDRESS'];
		  $P_LATTITUDE=$_POST['P_LATTITUDE'];
		  $P_LOGLITUTDE=$_POST['P_LOGLITUTDE'];
		  $P_PRICE=$_POST['P_PRICE'];
		  $P_BATHS=$_POST['P_BATHS'];
		  $P_BEDS=$_POST['P_BEDS'];
		  $P_FLOORS=$_POST['P_FLOORS'];
		  $P_AVAILABLE_FROM=$_POST['P_AVAILABLE_FROM'];
		  $P_CONTACT_PERSON_NM=$_POST['P_CONTACT_PERSON_NM'];
		  $P_CONTACT_PERSON_PHN=$_POST['P_CONTACT_PERSON_PHN'];
		  $P_CONTACT_PERSON_EML=$_POST['P_CONTACT_PERSON_EML'];
		  $P_TOLET_TYPE_ID=$_POST['P_TOLET_TYPE_ID'];
		  $P_PRODUCT_IMAGE=$_POST['P_PRODUCT_IMAGE'];
		  $IMAGE1_DESCRIPTOR = oci_new_descriptor($conn, OCI_D_LOB);
		  $IMAGE1_DESCRIPTOR->writeTemporary($P_PRODUCT_IMAGE);
		  $P_CREATE_DATA=$_POST['P_CREATE_DATA'];
		  $P_CREATE_BY=$_POST['P_CREATE_BY'];
		 
		 $curs = oci_new_cursor($conn);

		 $REG = oci_parse($conn, 
		 "begin APP_FYH_INSERT_DATA.FYH_USER_POST_TOLET
		 (:CUR_DATA,
		 :P_USER_ACC_ID,
		 :P_TOLET_NAME,
		 :P_TOLET_DETAILS,
		 :P_ADDRESS,
		 :P_LATTITUDE,
		 :P_LOGLITUTDE,
		 :P_PRICE,
		 :P_BATHS,
		 :P_BEDS,
		 :P_FLOORS,
		 :P_AVAILABLE_FROM,
		 :P_CONTACT_PERSON_NM,
		 :P_CONTACT_PERSON_PHN,
		 :P_CONTACT_PERSON_EML,
		 :P_TOLET_TYPE_ID,
		 :P_PRODUCT_IMAGE,
		 :P_CREATE_DATA,
		 :P_CREATE_BY
		 );
		 end;");

		oci_bind_by_name($REG, ":CUR_DATA", $curs, -1, OCI_B_CURSOR);
		oci_bind_by_name($REG, ":P_USER_ACC_ID", $P_USER_ACC_ID, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_TOLET_NAME", $P_TOLET_NAME, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_TOLET_DETAILS", $P_TOLET_DETAILS, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_ADDRESS", $P_ADDRESS, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_LATTITUDE", $P_LATTITUDE, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_LOGLITUTDE", $P_LOGLITUTDE, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_PRICE", $P_PRICE, -1, SQLT_INT);
		oci_bind_by_name($REG, ":P_BATHS", $P_BATHS, -1, SQLT_INT);
		oci_bind_by_name($REG, ":P_BEDS", $P_BEDS, -1, SQLT_INT);
		oci_bind_by_name($REG, ":P_FLOORS", $P_FLOORS, -1, SQLT_INT);
		oci_bind_by_name($REG, ":P_AVAILABLE_FROM", $P_AVAILABLE_FROM, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_CONTACT_PERSON_NM", $P_CONTACT_PERSON_NM, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_CONTACT_PERSON_PHN", $P_CONTACT_PERSON_PHN, -1, SQLT_INT);
		oci_bind_by_name($REG, ":P_CONTACT_PERSON_EML", $P_CONTACT_PERSON_EML, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_TOLET_TYPE_ID", $P_TOLET_TYPE_ID, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_PRODUCT_IMAGE", $IMAGE1_DESCRIPTOR, -1, OCI_B_CLOB);
		oci_bind_by_name($REG, ":P_CREATE_DATA", $P_CREATE_DATA, -1, SQLT_CHR);
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