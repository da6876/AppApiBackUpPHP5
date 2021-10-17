<?php
include 'conn.php';
				
	if($_SERVER['REQUEST_METHOD'] === 'POST'){

//===================================================================
		  $P_SERVICE_TYPE_ID=$_POST['P_SERVICE_TYPE_ID'];
		  $P_SERVICE_NAME=$_POST['P_SERVICE_NAME'];
		  $P_SERVICE_IMAGE=$_POST['P_SERVICE_IMAGE'];
		  $P_SERVICE_IMAGE_NAME=$_POST['P_SERVICE_IMAGE_NAME'];
		  $P_SERVICE_PRICE=$_POST['P_SERVICE_PRICE'];
		  $P_SERVICE_STATUS=$_POST['P_SERVICE_STATUS'];
		  $P_SERVICE_DETAILS=$_POST['P_SERVICE_DETAILS'];
		  $P_CREATE_BY=$_POST['P_CREATE_BY'];
		  $UploadStatus="";
			
			$path = "uploads/service_img/".$P_SERVICE_IMAGE_NAME;
			
			$actualpath = "http://103.91.54.60/apps/Upojog/$path";
			
			$status = file_put_contents($path,base64_decode($P_SERVICE_IMAGE));
			//if($status){
			//$UploadStatus="uccessfully Uploaded";
			 //echo "Successfully Uploaded </br>";
			 //echo "Path : ".$actualpath;
			//}else{
			//$UploadStatus="Upload failed";
			 //echo "Upload failed";
			//}
			
		  
		 
		  $curs = oci_new_cursor($conn);

		 $REG = oci_parse($conn, 
		 "begin UJG_DATA_PROSESS.UJG_SERVICE_TABLE_IN
		 (:CURDATA,
		 :P_SERVICE_TYPE_ID,
		 :P_SERVICE_NAME,
		 :P_SERVICE_IMAGE,
		 :P_SERVICE_PRICE,
		 :P_SERVICE_DETAILS,
		 :P_SERVICE_STATUS,
		 :P_CREATE_BY
		 );
		 end;");

		oci_bind_by_name($REG, ":CURDATA", $curs, -1, OCI_B_CURSOR);
		oci_bind_by_name($REG, ":P_SERVICE_TYPE_ID", $P_SERVICE_TYPE_ID, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_SERVICE_NAME", $P_SERVICE_NAME, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_SERVICE_IMAGE", $actualpath, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_SERVICE_PRICE", $P_SERVICE_PRICE, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_SERVICE_STATUS", $P_SERVICE_STATUS, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_SERVICE_DETAILS", $P_SERVICE_DETAILS, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_CREATE_BY", $P_CREATE_BY, -1, SQLT_CHR);

		oci_execute($REG);
		oci_execute($curs);
		 while (($row = oci_fetch_array($curs, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
		  $output[]=$row;
		}
		$data=json_encode($output);
		$obj = json_decode($data);
		$obj[0]->STATUS_CODE;
		if($obj[0]->STATUS_CODE=="200"){
			$post_data = array(
				  'responce' => array(
					'status_code' => $obj[0]->STATUS_CODE,
					'msg' =>$obj[0]->TYPE,
					'values' => $obj[0]->MSG
				  )
				);
			print json_encode($post_data); 
		}elseif($obj[0]->STATUS_CODE=="500"){
			$post_data = array(
			  'responce' => array(
					'status_code' => $obj[0]->STATUS_CODE,
					'msg' =>$obj[0]->TYPE,
					'values' => $obj[0]->MSG
			  )
			);
			print json_encode($post_data); 
		}else{
			$post_data = array(
			  'responce' => array(
					'status_code' => '501',
					'msg' =>"Falied",
					'values' => $obj[0]->MSG,
			  )
			);
			print json_encode($post_data); 
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
print json_encode($post_data); 
	 } 
?>