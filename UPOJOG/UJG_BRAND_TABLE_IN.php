<?php
include 'conn.php';
				
	if($_SERVER['REQUEST_METHOD'] === 'POST'){

//===================================================================
		  $P_BRAND_NAME=$_POST['P_BRAND_NAME'];
		  $P_BRAND_STATUS=$_POST['P_BRAND_STATUS'];
		  $P_CREATE_BY=$_POST['P_CREATE_BY'];
		 
		 $curs = oci_new_cursor($conn);

		 $REG = oci_parse($conn, 
		 "begin UJG_DATA_PROSESS.UJG_BRAND_TABLE_IN
		 (:CURDATA,
		 :P_BRAND_NAME,
		 :P_BRAND_STATUS,
		 :P_CREATE_BY
		 );
		 end;");

		oci_bind_by_name($REG, ":CURDATA", $curs, -1, OCI_B_CURSOR);
		oci_bind_by_name($REG, ":P_BRAND_NAME", $P_BRAND_NAME, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_BRAND_STATUS", $P_BRAND_STATUS, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_CREATE_BY", $P_CREATE_BY, -1, SQLT_CHR);

		oci_execute($REG);
		oci_execute($curs);
		 while (($row = oci_fetch_array($curs, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
		  $output[]=$row;
		}
		$data=json_encode($output);
		$obj = json_decode($data);
		$obj[0]->STATUS_CODE;
		if($obj[0]->STATUS_CODE==="200"){
			$post_data = array(
				  'responce' => array(
					'status_code' => $obj[0]->STATUS_CODE,
					'msg' =>$obj[0]->TYPE,
					'values' => $obj[0]->MSG
				  )
				);
		}elseif($obj[0]->STATUS_CODE==="500"){
			$post_data = array(
			  'responce' => array(
					'status_code' => $obj[0]->STATUS_CODE,
					'msg' =>$obj[0]->TYPE,
					'values' => $obj[0]->MSG
			  )
			);
		}else{
			$post_data = array(
			  'responce' => array(
					'status_code' => '501',
					'msg' =>"Falied",
					'values' => "Internal Server Error",
			  )
			);
		}
		
		oci_free_statement($REG);
		oci_close($conn);
 	  }else{
		 $post_data = array(
		  'responce' => array(
			'status_code' => '502',
			'msg' => 'Failed',
			'values' => 'Sorry You Are Not Allow Here',
		  )
		);
	 } 
print json_encode($post_data); 
?>