<?php
error_reporting(0);
	include('connection.php');
	
	if($_SERVER['REQUEST_METHOD'] === 'POST'){
		$json_array= array();
	$checkSQL1="SELECT * FROM soc_ts_tolet_type_table ";
			$result1 = $conn->query($checkSQL1);
			
			if ($result1->num_rows > 0) {
				  while($row = $result1->fetch_assoc()) {
					$json_array []=$row ;					 
				  }
			}
	
		print json_encode($json_array);
	
	}else{
	 $post_data = array(
		'status_code' => '502',
		'msg' => 'Failed',
		'values' => 'Sorry You Are Not Allow Here',
	  );
		print json_encode($post_data); 
	 } 


?>