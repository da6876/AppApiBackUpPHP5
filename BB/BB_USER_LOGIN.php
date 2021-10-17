<?php
include 'conn.php';
				
	if($_SERVER['REQUEST_METHOD'] === 'POST'){

//===================================================================
		  $P_BB_USER_NAME=$_POST['P_BB_USER_NAME'];
		  $P_BB_USER_PASSWORD=$_POST['P_BB_USER_PASSWORD'];
		  $P_BB_USER_ADDRESS=$_POST['P_BB_USER_ADDRESS'];
		  $P_BB_USER_LATITUDE=$_POST['P_BB_USER_LATITUDE'];
		  $P_BB_USER_LONGITUDE=$_POST['P_BB_USER_LONGITUDE'];
		 
		 $curs = oci_new_cursor($conn);

		 $REG = oci_parse($conn, 
		 "begin BB_ADD_DATA_PROSESS.BB_USER_LOGIN
		 (:CURDATA,
		 :P_BB_USER_NAME,
		 :P_BB_USER_PASSWORD,
		 :P_BB_USER_ADDRESS,
		 :P_BB_USER_LATITUDE,
		 :P_BB_USER_LONGITUDE
		 );
		 end;");

		oci_bind_by_name($REG, ":CURDATA", $curs, -1, OCI_B_CURSOR);
		oci_bind_by_name($REG, ":P_BB_USER_NAME", $P_BB_USER_NAME, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_BB_USER_PASSWORD", $P_BB_USER_PASSWORD, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_BB_USER_ADDRESS", $P_BB_USER_ADDRESS, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_BB_USER_LATITUDE", $P_BB_USER_LATITUDE, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_BB_USER_LONGITUDE", $P_BB_USER_LONGITUDE, -1, SQLT_CHR);

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
				  
					'status_code' => $obj[0]->STATUS_CODE,
					'msg' =>"Success",
					'values' => $obj
				  
				);
		}elseif($obj[0]->STATUS_CODE==="500"){
			$post_data = array(
			  
					'status_code' => $obj[0]->STATUS_CODE,
					'type' =>$obj[0]->TYPE,
					'values' => "User Name Password Is not Match"
			  
			);
		}else{
			$post_data = array(
			  
					'status_code' => '501',
					'msg' =>"Falied",
					'values' => "Internal Server Error",
			  
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