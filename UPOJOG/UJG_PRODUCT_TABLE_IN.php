<?php
include 'conn.php';
				
	if($_SERVER['REQUEST_METHOD'] === 'POST'){

//===================================================================
		  $P_BRAND_ID=$_POST['P_BRAND_ID'];
		  $P_CATEGORY_ID=$_POST['P_CATEGORY_ID'];
		  $P_PRODUCT_NAME=$_POST['P_PRODUCT_NAME'];
		  $P_PRODUCT_DETAILS=$_POST['P_PRODUCT_DETAILS'];
		  $P_PRODUCT_IMAGE_ONE=$_POST['P_PRODUCT_IMAGE_ONE'];
		  $P_PRODUCT_IMAGE_ONE_NAME=$_POST['P_PRODUCT_IMAGE_ONE_NAME'];
		  $P_PRODUCT_IMAGE_TWO=$_POST['P_PRODUCT_IMAGE_TWO'];
		  $P_PRODUCT_IMAGE_TWO_NAME=$_POST['P_PRODUCT_IMAGE_TWO_NAME'];
		  $P_PRODUCT_IMAGE_THREE=$_POST['P_PRODUCT_IMAGE_THREE'];
		  $P_PRODUCT_IMAGE_THREE_NAME=$_POST['P_PRODUCT_IMAGE_THREE_NAME'];
		  $P_PRODUCT_PRICE=$_POST['P_PRODUCT_PRICE'];
		  $P_PRODUCT_REVIEW=$_POST['P_PRODUCT_REVIEW'];
		  $P_PRODUCT_REVIEW_DETAL=$_POST['P_PRODUCT_REVIEW_DETAL'];
		  $P_PRODUCT_STATUS=$_POST['P_PRODUCT_STATUS'];
		  $P_CREATE_BY=$_POST['P_CREATE_BY'];
		  
		  if($P_PRODUCT_IMAGE_ONE=="" && $P_PRODUCT_IMAGE_ONE_NAME==""){
			 $actualpath1="No Image";
		  }else{
			$path1 = "uploads/product_img/".$P_PRODUCT_IMAGE_ONE_NAME;
			$actualpath1 = "http://103.91.54.60/apps/Upojog/$path1";
			$status1 = file_put_contents($path1,base64_decode($P_PRODUCT_IMAGE_ONE));
		  }
		  
		  if($P_PRODUCT_IMAGE_TWO=="" && $P_PRODUCT_IMAGE_TWO_NAME==""){
			  $actualpath2="No Image";
		  }else{
			$path2 = "uploads/product_img/".$P_PRODUCT_IMAGE_TWO_NAME;
			$actualpath2 = "http://103.91.54.60/apps/Upojog/$path2";
			$status2 = file_put_contents($path2,base64_decode($P_PRODUCT_IMAGE_TWO));
		  }
		  
		  if($P_PRODUCT_IMAGE_THREE=="" && $P_PRODUCT_IMAGE_THREE_NAME==""){
			  $actualpath3="No Image";
		  }else{
			$path3 = "uploads/product_img/".$P_PRODUCT_IMAGE_THREE_NAME;
			$actualpath3 = "http://103.91.54.60/apps/Upojog/$path3";
			$status3 = file_put_contents($path3,base64_decode($P_PRODUCT_IMAGE_THREE));
		  } 
			
		
		 
		$curs = oci_new_cursor($conn);

		 $REG = oci_parse($conn, 
		 "begin UJG_DATA_PROSESS.UJG_PRODUCT_TABLE_IN
		 (:CURDATA,
		 :P_BRAND_ID,
		 :P_CATEGORY_ID,
		 :P_PRODUCT_NAME,
		 :P_PRODUCT_DETAILS,
		 :P_PRODUCT_IMAGE_ONE,
		 :P_PRODUCT_IMAGE_TWO,
		 :P_PRODUCT_IMAGE_THREE,
		 :P_PRODUCT_PRICE,
		 :P_PRODUCT_REVIEW,
		 :P_PRODUCT_REVIEW_DETAL,
		 :P_PRODUCT_STATUS,
		 :P_CREATE_BY
		 );
		 end;");

		oci_bind_by_name($REG, ":CURDATA", $curs, -1, OCI_B_CURSOR);
		oci_bind_by_name($REG, ":P_BRAND_ID", $P_BRAND_ID, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_CATEGORY_ID", $P_CATEGORY_ID, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_PRODUCT_NAME", $P_PRODUCT_NAME, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_PRODUCT_DETAILS", $P_PRODUCT_DETAILS, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_PRODUCT_IMAGE_ONE", $actualpath1, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_PRODUCT_IMAGE_TWO", $actualpath2, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_PRODUCT_IMAGE_THREE", $actualpath3, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_PRODUCT_PRICE", $P_PRODUCT_PRICE, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_PRODUCT_REVIEW", $P_PRODUCT_REVIEW, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_PRODUCT_REVIEW_DETAL", $P_PRODUCT_REVIEW_DETAL, -1, SQLT_CHR);
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