<?php
include 'conn.php';
				
	if($_SERVER['REQUEST_METHOD'] === 'POST'){

//===================================================================
		  $P_BB_PER_TYPE_ID=$_POST['P_BB_PER_TYPE_ID'];
		  $P_BB_USER_TYPE_NAME=$_POST['P_BB_USER_TYPE_NAME'];
		  $P_BB_USER_TYPE_STATUS=$_POST['P_BB_USER_TYPE_STATUS'];
		  $P_CREATE_BY=$_POST['P_CREATE_BY'];
		  

		 if($P_BB_USER_TYPE_NAME!="" && $P_BB_USER_TYPE_STATUS!=""&& $P_CREATE_BY!=""){
			 $curs = oci_new_cursor($conn);

			 $REG = oci_parse($conn, 
			 "begin BB_ADD_DATA_PROSESS.ADD_BB_USER_TYPE
			 (:CURDATA,
			 :P_BB_PER_TYPE_ID,
			 :P_BB_USER_TYPE_NAME,
			 :P_BB_USER_TYPE_STATUS,
			 :P_CREATE_BY
			 );
			 end;");

			oci_bind_by_name($REG, ":CURDATA", $curs, -1, OCI_B_CURSOR);
			oci_bind_by_name($REG, ":P_BB_PER_TYPE_ID", $P_BB_PER_TYPE_ID, -1, SQLT_CHR);
			oci_bind_by_name($REG, ":P_BB_USER_TYPE_NAME", $P_BB_USER_TYPE_NAME, -1, SQLT_CHR);
			oci_bind_by_name($REG, ":P_BB_USER_TYPE_STATUS", $P_BB_USER_TYPE_STATUS, -1, SQLT_CHR);
			oci_bind_by_name($REG, ":P_CREATE_BY", $P_CREATE_BY, -1, SQLT_CHR);

			oci_execute($REG);
			oci_execute($curs);
			 while (($row = oci_fetch_array($curs, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
			  $output[]=$row;
			}
			print $data=json_encode($output);
			
			
			oci_free_statement($REG);
			oci_close($conn);
		}else{
			 $post_data = array(
		  'responce' => array(
			'status_code' => '504',
			'msg' => 'Failed',
			'values' => 'Enter All Information',
		  )
		);
		print json_encode($post_data); 
		 }
 	  }else{
		 $post_data = array(
		  'responce' => array(
			'status_code' => '502',
			'msg' => 'Failed',
			'values' => 'Sorry You Are Not Allow Here',
		  )
		);
print json_encode($post_data); 
	 } 
?>