<?php
include 'conn.php';
				
	//if($_SERVER['REQUEST_METHOD'] === 'POST'){
		  //$P_USER_ACC_ID="11220029"; 
//===================================================================
		  $P_USER_ACC_ID=$_POST['P_USER_ACC_ID'];
		  $P_LOCATION_CODE=$_POST['P_LOCATION_CODE'];
		  $P_BEDS=$_POST['P_BEDS'];
		  $P_BATHS=$_POST['P_BATHS'];
		  $P_MIN=$_POST['P_MIN'];
		  $P_MAX=$_POST['P_MAX'];
		 
		 $curs = oci_new_cursor($conn);

		 $REG = oci_parse($conn, 
		 "begin APP_FYH_INSERT_DATA.FYH_GET_TOLET_FILTER
		 (:CUR_DATA,
		 :P_USER_ACC_ID,
		 :P_LOCATION_CODE,
		 :P_BEDS,
		 :P_BATHS,
		 :P_MIN,
		 :P_MAX
		 );
		 end;");

		oci_bind_by_name($REG, ":CUR_DATA", $curs, -1, OCI_B_CURSOR);
		oci_bind_by_name($REG, ":P_USER_ACC_ID", $P_USER_ACC_ID, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_LOCATION_CODE", $P_LOCATION_CODE, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_BEDS", $P_BEDS, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_BATHS", $P_BATHS, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_MIN", $P_MIN, -1, SQLT_CHR);
		oci_bind_by_name($REG, ":P_MAX", $P_MAX, -1, SQLT_CHR);

		oci_execute($REG);
		oci_execute($curs);
		
		
$abc = array();
while (($row = oci_fetch_array($curs, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {

	foreach($row as $key=>$data) {

			if(is_object($data)){
				$abc[$key] = $data->load();
			//	base64_to_jpeg($data->load(),'abc.jpg');
			} else{
				$abc[$key] = $data;
			}
	}
  $output[]=$abc;
}
//var_dump($output);
json_encode_custom($output);

oci_free_statement($REG);
oci_free_statement($curs);
oci_close($conn);



function json_encode_custom($arr) {
print '[';
	$count = count($arr);
	$current =0;
	$tempContainer = array();
	while($current<$count) {
	$tempContainer = $arr[$current];
	$tempContainer = preg_replace('/[^a-zA-Z0-9-.\/=+-]/', ' ', $tempContainer);
	if($current==($count-1))
		print json_encode($tempContainer);
	else
		print json_encode($tempContainer).",";
	
	$current++;
	}
print ']';
}
?>