<?php
include 'conn.php';
				
	if($_SERVER['REQUEST_METHOD'] === 'POST'){

		  $P_USER_TYPE_ID=$_POST['P_USER_TYPE_ID'];
		  $P_USER_NAME=$_POST['P_USER_NAME'];
		  $P_USER_PHONE=$_POST['P_USER_PHONE'];
		  $P_USER_EMAIL=$_POST['P_USER_EMAIL'];
		  $P_USER_IMAGE=$_POST['P_USER_IMAGE'];
		  $P_USER_ADDRESS=$_POST['P_USER_ADDRESS'];
		  $P_USER_DETAILS=$_POST['P_USER_DETAILS'];
		  $P_USER_STATUS=$_POST['P_USER_STATUS'];
		  $P_CREATE_BY=$_POST['P_CREATE_BY'];
		  //$P_USER_PASSWORD=md5($_POST['P_USER_PASSWORD']);
		  $P_USER_PASSWORD=$_POST['P_USER_PASSWORD'];
		  
		if($P_USER_TYPE_ID !="" || $P_USER_NAME !=""|| $P_USER_PHONE !=""|| $P_USER_ADDRESS !=""|| $P_USER_PASSWORD !=""|| $P_USER_STATUS !=""){
			 $curs = oci_new_cursor($conn);

			 $REG = oci_parse($conn, 
			 "begin SOC_NET_DATA_PROSESS.NET_USER_INFO_IN
			 (:CURDATA,
			 :P_USER_TYPE_ID,
			 :P_USER_NAME,
			 :P_USER_PHONE,
			 :P_USER_EMAIL,
			 :P_USER_IMAGE,
			 :P_USER_ADDRESS,
			 :P_USER_DETAILS,
			 :P_USER_STATUS,
			 :P_CREATE_BY,
			 :P_USER_PASSWORD
			 );
			 end;");

			oci_bind_by_name($REG, ":CURDATA", $curs, -1, OCI_B_CURSOR);
			oci_bind_by_name($REG, ":P_USER_TYPE_ID", $P_USER_TYPE_ID, -1, SQLT_CHR);
			oci_bind_by_name($REG, ":P_USER_NAME", $P_USER_NAME, -1, SQLT_CHR);
			oci_bind_by_name($REG, ":P_USER_PHONE", $P_USER_PHONE, -1, SQLT_CHR);
			oci_bind_by_name($REG, ":P_USER_EMAIL", $P_USER_EMAIL, -1, SQLT_CHR);
			oci_bind_by_name($REG, ":P_USER_IMAGE", $P_USER_IMAGE, -1, SQLT_CHR);
			oci_bind_by_name($REG, ":P_USER_ADDRESS", $P_USER_ADDRESS, -1, SQLT_CHR);
			oci_bind_by_name($REG, ":P_USER_DETAILS", $P_USER_DETAILS, -1, SQLT_CHR);
			oci_bind_by_name($REG, ":P_USER_STATUS", $P_USER_STATUS, -1, SQLT_CHR);
			oci_bind_by_name($REG, ":P_CREATE_BY", $P_CREATE_BY, -1, SQLT_CHR);
			oci_bind_by_name($REG, ":P_USER_PASSWORD", $P_USER_PASSWORD, -1, SQLT_CHR);

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
						'msg' =>$obj[0]->TYPE,
						'values' => $obj[0]->MSG
					);
			}elseif($obj[0]->STATUS_CODE==="500"){
				$post_data = array(
					'status_code' => $obj[0]->STATUS_CODE,
					'msg' =>$obj[0]->TYPE,
					'values' => $obj[0]->MSG

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
					'status_code' => '502',
					'msg' =>"Falied",
					'values' => "Enter The All Data !",
			);
		}
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