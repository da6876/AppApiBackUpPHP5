<?php

include 'conn.php';
//error_reporting(0);
 ini_set('max_execution_time', 300);
 
$P_USER_ACC_ID="11220039";

$curs = oci_new_cursor($conn);

//$stid = oci_parse($conn, "begin APP_FYH_INSERT_DATA.FYH_GET_TOLET_ALL(:cur_data); end;");
		 
		 $stid = oci_parse($conn, 
		 "begin APP_FYH_INSERT_DATA.FYH_GET_TOLET_ALL
		 (:CUR_DATA,
		 :P_USER_ACC_ID);
		 end;");

oci_bind_by_name($stid, ":cur_data", $curs, -1, OCI_B_CURSOR);
oci_bind_by_name($stid, ":P_USER_ACC_ID", $P_USER_ACC_ID, -1, SQLT_CHR);

oci_execute($stid);
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

oci_free_statement($stid);
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