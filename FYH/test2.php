<?php

include 'conn.php';
//error_reporting(0);
 ini_set('max_execution_time', 3000);
 

$curs = oci_new_cursor($conn);

		 
		 $stid = oci_parse($conn, 
		 "begin FMH_DATA_PROSESS.FMH_WEB_GET_US_CON_TAB
		 (:CUR_DATA
		 );
		 end;");

oci_bind_by_name($stid, ":cur_data", $curs, -1, OCI_B_CURSOR);

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
	sleep(3);
	}
print ']';
}

?>