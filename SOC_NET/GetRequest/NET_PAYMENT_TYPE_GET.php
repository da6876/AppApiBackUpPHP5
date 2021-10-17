<?php
include 'conn.php';
				
	if($_SERVER['REQUEST_METHOD'] === 'GET'){

//===================================================================

		 
		 $curs = oci_new_cursor($conn);

		 $REG = oci_parse($conn, 
		 "begin SOC_NET_DATA_PROSESS.NET_PAYMENT_TYPE_GET
		 (:CURDATA
		 );
		 end;");

		oci_bind_by_name($REG, ":CURDATA", $curs, -1, OCI_B_CURSOR);

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