<?php
include 'conn.php';
				
	if($_SERVER['REQUEST_METHOD'] === 'POST'){
		
		$ViewType=$_POST['ViewType'];
		
		if($ViewType="User Type In"){
			

		  $P_USER_TYPE_NAME=$_POST['P_USER_TYPE_NAME'];
		  $P_USER_TYPE_STATUS=$_POST['P_USER_TYPE_STATUS'];
		  $P_CREATE_BY=$_POST['P_CREATE_BY'];
		  
			if($P_USER_TYPE_NAME !="" || $P_USER_TYPE_STATUS !=""){
				 $curs = oci_new_cursor($conn);

				 $REG = oci_parse($conn, 
				 "begin SOC_NET_DATA_PROSESS.NET_USER_TYPE_IN
				 (:CURDATA,
				 :P_USER_TYPE_NAME,
				 :P_USER_TYPE_STATUS,
				 :P_CREATE_BY
				 );
				 end;");

				oci_bind_by_name($REG, ":CURDATA", $curs, -1, OCI_B_CURSOR);
				oci_bind_by_name($REG, ":P_USER_TYPE_NAME", $P_USER_TYPE_NAME, -1, SQLT_CHR);
				oci_bind_by_name($REG, ":P_USER_TYPE_STATUS", $P_USER_TYPE_STATUS, -1, SQLT_CHR);
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
		}
		
		else if($ViewType="User Info In"){
			
			$P_USER_TYPE_ID=$_POST['P_USER_TYPE_ID'];
			$P_USER_NAME=$_POST['P_USER_NAME'];
			$P_USER_PHONE=$_POST['P_USER_PHONE'];
			$P_USER_EMAIL=$_POST['P_USER_EMAIL'];
			$P_USER_IMAGE=$_POST['P_USER_IMAGE'];
			$P_USER_ADDRESS=$_POST['P_USER_ADDRESS'];
			$P_USER_DETAILS=$_POST['P_USER_DETAILS'];
			$P_USER_STATUS=$_POST['P_USER_STATUS'];
			$P_CREATE_BY=$_POST['P_CREATE_BY'];
			$P_USER_PASSWORD=md5($_POST['P_USER_PASSWORD']);
			  
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
			
			
		}
		
		else if($ViewType="Service Type In"){
			
			$P_SERVICE_TYPE_NAME=$_POST['P_SERVICE_TYPE_NAME'];
			$P_SERVICE_TYPE_STATUS=$_POST['P_SERVICE_TYPE_STATUS'];
			$P_CREATE_BY=$_POST['P_CREATE_BY'];
			  
			if($P_SERVICE_TYPE_NAME !="" || $P_SERVICE_TYPE_STATUS !=""){
				 $curs = oci_new_cursor($conn);

				 $REG = oci_parse($conn, 
				 "begin SOC_NET_DATA_PROSESS.NET_SERVICE_TYPE_IN
				 (:CURDATA,
				 :P_SERVICE_TYPE_NAME,
				 :P_SERVICE_TYPE_STATUS,
				 :P_CREATE_BY
				 );
				 end;");

				oci_bind_by_name($REG, ":CURDATA", $curs, -1, OCI_B_CURSOR);
				oci_bind_by_name($REG, ":P_SERVICE_TYPE_NAME", $P_SERVICE_TYPE_NAME, -1, SQLT_CHR);
				oci_bind_by_name($REG, ":P_SERVICE_TYPE_STATUS", $P_SERVICE_TYPE_STATUS, -1, SQLT_CHR);
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
		}
		
		else if($ViewType="Service In"){
			
			$P_SERVICE_TYPE_ID=$_POST['P_SERVICE_TYPE_ID'];
			$P_SERVICE_NAME=$_POST['P_SERVICE_NAME'];
			$P_SERVICE_DETAILS=$_POST['P_SERVICE_DETAILS'];
			$P_SERVICE_AMOUNT=$_POST['P_SERVICE_AMOUNT'];
			$P_SERVICE_STATUS=$_POST['P_SERVICE_STATUS'];
			$P_CREATE_BY=$_POST['P_CREATE_BY'];
			  
			if($P_SERVICE_TYPE_ID !="" || $P_SERVICE_NAME !=""|| $P_SERVICE_DETAILS !=""|| $P_SERVICE_AMOUNT !=""|| $P_SERVICE_STATUS !=""){
				 $curs = oci_new_cursor($conn);

				 $REG = oci_parse($conn, 
				 "begin SOC_NET_DATA_PROSESS.NET_SERVICE_INFO_IN
				 (:CURDATA,
				 :P_SERVICE_TYPE_ID,
				 :P_SERVICE_NAME,
				 :P_SERVICE_DETAILS,
				 :P_SERVICE_AMOUNT,
				 :P_SERVICE_STATUS,
				 :P_CREATE_BY
				 );
				 end;");

				oci_bind_by_name($REG, ":CURDATA", $curs, -1, OCI_B_CURSOR);
				oci_bind_by_name($REG, ":P_SERVICE_TYPE_ID", $P_SERVICE_TYPE_ID, -1, SQLT_CHR);
				oci_bind_by_name($REG, ":P_SERVICE_NAME", $P_SERVICE_NAME, -1, SQLT_CHR);
				oci_bind_by_name($REG, ":P_SERVICE_DETAILS", $P_SERVICE_DETAILS, -1, SQLT_CHR);
				oci_bind_by_name($REG, ":P_SERVICE_AMOUNT", $P_SERVICE_AMOUNT, -1, SQLT_CHR);
				oci_bind_by_name($REG, ":P_SERVICE_STATUS", $P_SERVICE_STATUS, -1, SQLT_CHR);
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
		}
		
		else if($ViewType="Net Packeg In"){
		
			$P_NETPACKEG_TYPE_NAME=$_POST['P_NETPACKEG_TYPE_NAME'];
			$P_NETPACKEG_TYPE_STATUS=$_POST['P_NETPACKEG_TYPE_STATUS'];
			$P_CREATE_BY=$_POST['P_CREATE_BY'];
			  
			if($P_NETPACKEG_TYPE_NAME !="" || $P_NETPACKEG_TYPE_STATUS !=""){
				 $curs = oci_new_cursor($conn);

				 $REG = oci_parse($conn, 
				 "begin SOC_NET_DATA_PROSESS.NET_NETPACKEG_TYPE_IN
				 (:CURDATA,
				 :P_NETPACKEG_TYPE_NAME,
				 :P_NETPACKEG_TYPE_STATUS,
				 :P_CREATE_BY
				 );
				 end;");

				oci_bind_by_name($REG, ":CURDATA", $curs, -1, OCI_B_CURSOR);
				oci_bind_by_name($REG, ":P_NETPACKEG_TYPE_NAME", $P_NETPACKEG_TYPE_NAME, -1, SQLT_CHR);
				oci_bind_by_name($REG, ":P_NETPACKEG_TYPE_STATUS", $P_NETPACKEG_TYPE_STATUS, -1, SQLT_CHR);
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
		}
		
		else if($ViewType="Location In"){
		
			$P_LOCATION_NAME=$_POST['P_LOCATION_NAME'];
			$P_LOCATION_STATUS=$_POST['P_LOCATION_STATUS'];
			$P_CREATE_BY=$_POST['P_CREATE_BY'];
			  
			if($P_LOCATION_NAME !="" || $P_LOCATION_STATUS !=""){
				 $curs = oci_new_cursor($conn);

				 $REG = oci_parse($conn, 
				 "begin SOC_NET_DATA_PROSESS.NET_LOCATION_TABLE_IN
				 (:CURDATA,
				 :P_LOCATION_NAME,
				 :P_LOCATION_STATUS,
				 :P_CREATE_BY
				 );
				 end;");

				oci_bind_by_name($REG, ":CURDATA", $curs, -1, OCI_B_CURSOR);
				oci_bind_by_name($REG, ":P_LOCATION_NAME", $P_LOCATION_NAME, -1, SQLT_CHR);
				oci_bind_by_name($REG, ":P_LOCATION_STATUS", $P_LOCATION_STATUS, -1, SQLT_CHR);
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
		}
		
		else if($ViewType="Equipment Type In"){
		
			$P_EQUIPMENT_TYPE_NAME=$_POST['P_EQUIPMENT_TYPE_NAME'];
			$P_EQUIPMENT_TYPE_STATUS=$_POST['P_EQUIPMENT_TYPE_STATUS'];
			$P_CREATE_BY=$_POST['P_CREATE_BY'];
			  
			if($P_EQUIPMENT_TYPE_NAME !="" || $P_EQUIPMENT_TYPE_STATUS !=""){
				 $curs = oci_new_cursor($conn);

				 $REG = oci_parse($conn, 
				 "begin SOC_NET_DATA_PROSESS.NET_EQUIPMENT_TYPE_IN
				 (:CURDATA,
				 :P_EQUIPMENT_TYPE_NAME,
				 :P_EQUIPMENT_TYPE_STATUS,
				 :P_CREATE_BY
				 );
				 end;");

				oci_bind_by_name($REG, ":CURDATA", $curs, -1, OCI_B_CURSOR);
				oci_bind_by_name($REG, ":P_EQUIPMENT_TYPE_NAME", $P_EQUIPMENT_TYPE_NAME, -1, SQLT_CHR);
				oci_bind_by_name($REG, ":P_EQUIPMENT_TYPE_STATUS", $P_EQUIPMENT_TYPE_STATUS, -1, SQLT_CHR);
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
		}
		
		else if($ViewType="Equipment In"){
		
			$P_EQUIPMENT_TYPE_ID=$_POST['P_EQUIPMENT_TYPE_ID'];
			$P_EQUIPMENT_NAME=$_POST['P_EQUIPMENT_NAME'];
			$P_EQUIPMENT_DETAILS=$_POST['P_EQUIPMENT_DETAILS'];
			$P_EQUIPMENT_AMOUNT_BUY=$_POST['P_EQUIPMENT_AMOUNT_BUY'];
			$P_EQUIPMENT_AMOUNT_SELL=$_POST['P_EQUIPMENT_AMOUNT_SELL'];
			$P_EQUIPMENT_STATUS=$_POST['P_EQUIPMENT_STATUS'];
			$P_EQUIPMENT_SIZE=$_POST['P_EQUIPMENT_SIZE'];
			$P_CREATE_BY=$_POST['P_CREATE_BY'];
			  
			if($P_EQUIPMENT_TYPE_ID !="" || $P_EQUIPMENT_NAME !="" || $P_EQUIPMENT_DETAILS !="" || 
			$P_EQUIPMENT_AMOUNT_BUY !="" || $P_EQUIPMENT_AMOUNT_SELL !=""|| $P_EQUIPMENT_STATUS !=""|| $P_EQUIPMENT_SIZE !=""){
				 $curs = oci_new_cursor($conn);

				 $REG = oci_parse($conn, 
				 "begin SOC_NET_DATA_PROSESS.NET_EQUIPMENT_INFO_IN
				 (:CURDATA,
				 :P_EQUIPMENT_TYPE_ID,
				 :P_EQUIPMENT_NAME,
				 :P_EQUIPMENT_DETAILS,
				 :P_EQUIPMENT_AMOUNT_BUY,
				 :P_EQUIPMENT_AMOUNT_SELL,
				 :P_EQUIPMENT_STATUS,
				 :P_EQUIPMENT_SIZE,
				 :P_CREATE_BY
				 );
				 end;");

				oci_bind_by_name($REG, ":CURDATA", $curs, -1, OCI_B_CURSOR);
				oci_bind_by_name($REG, ":P_EQUIPMENT_TYPE_ID", $P_EQUIPMENT_TYPE_ID, -1, SQLT_CHR);
				oci_bind_by_name($REG, ":P_EQUIPMENT_NAME", $P_EQUIPMENT_NAME, -1, SQLT_CHR);
				oci_bind_by_name($REG, ":P_EQUIPMENT_DETAILS", $P_EQUIPMENT_DETAILS, -1, SQLT_CHR);
				oci_bind_by_name($REG, ":P_EQUIPMENT_AMOUNT_BUY", $P_EQUIPMENT_AMOUNT_BUY, -1, SQLT_CHR);
				oci_bind_by_name($REG, ":P_EQUIPMENT_AMOUNT_SELL", $P_EQUIPMENT_AMOUNT_SELL, -1, SQLT_CHR);
				oci_bind_by_name($REG, ":P_EQUIPMENT_STATUS", $P_EQUIPMENT_STATUS, -1, SQLT_CHR);
				oci_bind_by_name($REG, ":P_EQUIPMENT_SIZE", $P_EQUIPMENT_SIZE, -1, SQLT_CHR);
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
		}	
		
		else if($ViewType="Customer Type In"){
		
			$P_CUSTOMER_TYPE_NAME=$_POST['P_CUSTOMER_TYPE_NAME'];
			$P_CUSTOMER_TYPE_STATUS=$_POST['P_CUSTOMER_TYPE_STATUS'];
			$P_CREATE_BY=$_POST['P_CREATE_BY'];
			  
			if($P_CUSTOMER_TYPE_NAME !="" || $P_CUSTOMER_TYPE_STATUS !=""){
				 $curs = oci_new_cursor($conn);

				 $REG = oci_parse($conn, 
				 "begin SOC_NET_DATA_PROSESS.NET_CUSTOMER_TYPE_IN
				 (:CURDATA,
				 :P_CUSTOMER_TYPE_NAME,
				 :P_CUSTOMER_TYPE_STATUS,
				 :P_CREATE_BY
				 );
				 end;");

				oci_bind_by_name($REG, ":CURDATA", $curs, -1, OCI_B_CURSOR);
				oci_bind_by_name($REG, ":P_CUSTOMER_TYPE_NAME", $P_CUSTOMER_TYPE_NAME, -1, SQLT_CHR);
				oci_bind_by_name($REG, ":P_CUSTOMER_TYPE_STATUS", $P_CUSTOMER_TYPE_STATUS, -1, SQLT_CHR);
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
		}	
		
		else if($ViewType="Customer In"){
		
		   $P_CUSTOMER_TYPE_ID=$_POST['P_CUSTOMER_TYPE_ID'];
		   $P_LOCATION_ID=$_POST['P_LOCATION_ID'];
		   $P_NETPACKEG_TYPE_ID=$_POST['P_NETPACKEG_TYPE_ID'];
		   $P_CUSTOMER_NAME=$_POST['P_CUSTOMER_NAME'];
		   $P_CUSTOMER_PHONE=$_POST['P_CUSTOMER_PHONE'];
		   $P_CUSTOMER_EMAIL=$_POST['P_CUSTOMER_EMAIL'];
		   $P_CUSTOMER_IMAGE=$_POST['P_CUSTOMER_IMAGE'];
		   $P_CUSTOMER_ADDRESS=$_POST['P_CUSTOMER_ADDRESS'];
		   $P_CUSTOMER_DETAILS=$_POST['P_CUSTOMER_DETAILS'];
		   $P_CUSTOMER_STATUS=$_POST['P_CUSTOMER_STATUS'];
		   $P_CREATE_BY=$_POST['P_CREATE_BY'];
			  
			if($P_CUSTOMER_TYPE_ID !="" || $P_LOCATION_ID !="" || $P_NETPACKEG_TYPE_ID !="" || $P_CUSTOMER_NAME !="" 
			|| $P_CUSTOMER_PHONE !="" || $P_CUSTOMER_EMAIL !="" || $P_CUSTOMER_IMAGE !="" || $P_CUSTOMER_ADDRESS !=""|| $P_CUSTOMER_DETAILS !=""|| $P_CUSTOMER_STATUS !=""){
				 $curs = oci_new_cursor($conn);

				 $REG = oci_parse($conn, 
				 "begin SOC_NET_DATA_PROSESS.NET_CUSTOMER_INFO_IN
				 (:CURDATA,
				 :P_CUSTOMER_TYPE_ID,
				 :P_LOCATION_ID,
				 :P_NETPACKEG_TYPE_ID,
				 :P_CUSTOMER_NAME,
				 :P_CUSTOMER_PHONE,
				 :P_CUSTOMER_EMAIL,
				 :P_CUSTOMER_IMAGE,
				 :P_CUSTOMER_ADDRESS,
				 :P_CUSTOMER_DETAILS,
				 :P_CUSTOMER_STATUS,
				 :P_CREATE_BY
				 );
				 end;");

				oci_bind_by_name($REG, ":CURDATA", $curs, -1, OCI_B_CURSOR);
				oci_bind_by_name($REG, ":P_CUSTOMER_TYPE_ID", $P_CUSTOMER_TYPE_ID, -1, SQLT_CHR);
				oci_bind_by_name($REG, ":P_LOCATION_ID", $P_LOCATION_ID, -1, SQLT_CHR);
				oci_bind_by_name($REG, ":P_NETPACKEG_TYPE_ID", $P_NETPACKEG_TYPE_ID, -1, SQLT_CHR);
				oci_bind_by_name($REG, ":P_CUSTOMER_NAME", $P_CUSTOMER_NAME, -1, SQLT_CHR);
				oci_bind_by_name($REG, ":P_CUSTOMER_PHONE", $P_CUSTOMER_PHONE, -1, SQLT_CHR);
				oci_bind_by_name($REG, ":P_CUSTOMER_EMAIL", $P_CUSTOMER_EMAIL, -1, SQLT_CHR);
				oci_bind_by_name($REG, ":P_CUSTOMER_IMAGE", $P_CUSTOMER_IMAGE, -1, SQLT_CHR);
				oci_bind_by_name($REG, ":P_CUSTOMER_ADDRESS", $P_CUSTOMER_ADDRESS, -1, SQLT_CHR);
				oci_bind_by_name($REG, ":P_CUSTOMER_DETAILS", $P_CUSTOMER_DETAILS, -1, SQLT_CHR);
				oci_bind_by_name($REG, ":P_CUSTOMER_STATUS", $P_CUSTOMER_STATUS, -1, SQLT_CHR);
				oci_bind_by_name($REG, ":P_CREATE_BY", $P_CREATE_BY, -1, SQLT_CHR);

				oci_execute($REG);
				oci_execute($curs);
				 while (($row = oci_fetch_array($curs, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
				  $output[]=$row;
				}
				echo $data=json_encode($output);
				$obj = json_decode($data);
				echo $obj[0]->STATUS_CODE;
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
		}	
		
		else if($ViewType="Cost Type In"){
		
			$P_COST_TYPE_NAME=$_POST['P_COST_TYPE_NAME'];
			$P_COST_TYPE_STATUS=$_POST['P_COST_TYPE_STATUS'];
			$P_CREATE_BY=$_POST['P_CREATE_BY'];
			  
			if($P_COST_TYPE_NAME !="" || $P_COST_TYPE_STATUS !=""){
				 $curs = oci_new_cursor($conn);

				 $REG = oci_parse($conn, 
				 "begin SOC_NET_DATA_PROSESS.NET_COST_TYPE_IN
				 (:CURDATA,
				 :P_COST_TYPE_NAME,
				 :P_COST_TYPE_STATUS,
				 :P_CREATE_BY
				 );
				 end;");

				oci_bind_by_name($REG, ":CURDATA", $curs, -1, OCI_B_CURSOR);
				oci_bind_by_name($REG, ":P_COST_TYPE_NAME", $P_COST_TYPE_NAME, -1, SQLT_CHR);
				oci_bind_by_name($REG, ":P_COST_TYPE_STATUS", $P_COST_TYPE_STATUS, -1, SQLT_CHR);
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
		}
		
		else if($ViewType="Cost In"){
		
			$P_COST_TYPE_ID=$_POST['P_COST_TYPE_ID'];
			$P_USER_INFO_ID=$_POST['P_USER_INFO_ID'];
			$P_COST_NAME=$_POST['P_COST_NAME'];
			$P_COST_DETAILS=$_POST['P_COST_DETAILS'];
			$P_COST_AMOUNT=$_POST['P_COST_AMOUNT'];
			$P_COST_STATUS=$_POST['P_COST_STATUS'];
			$P_CREATE_BY=$_POST['P_CREATE_BY'];
			  
			if($P_COST_TYPE_ID !="" || $P_USER_INFO_ID !="" || $P_COST_NAME !="" || $P_COST_AMOUNT !="" || $P_COST_STATUS !=""){
				 $curs = oci_new_cursor($conn);

				 $REG = oci_parse($conn, 
				 "begin SOC_NET_DATA_PROSESS.NET_COST_INFO_IN
				 (:CURDATA,
				 :P_COST_TYPE_ID,
				 :P_USER_INFO_ID,
				 :P_COST_NAME,
				 :P_COST_DETAILS,
				 :P_COST_AMOUNT,
				 :P_COST_STATUS,
				 :P_CREATE_BY
				 );
				 end;");

				oci_bind_by_name($REG, ":CURDATA", $curs, -1, OCI_B_CURSOR);
				oci_bind_by_name($REG, ":P_COST_TYPE_ID", $P_COST_TYPE_ID, -1, SQLT_CHR);
				oci_bind_by_name($REG, ":P_USER_INFO_ID", $P_USER_INFO_ID, -1, SQLT_CHR);
				oci_bind_by_name($REG, ":P_COST_NAME", $P_COST_NAME, -1, SQLT_CHR);
				oci_bind_by_name($REG, ":P_COST_DETAILS", $P_COST_DETAILS, -1, SQLT_CHR);
				oci_bind_by_name($REG, ":P_COST_AMOUNT", $P_COST_AMOUNT, -1, SQLT_CHR);
				oci_bind_by_name($REG, ":P_COST_STATUS", $P_COST_STATUS, -1, SQLT_CHR);
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