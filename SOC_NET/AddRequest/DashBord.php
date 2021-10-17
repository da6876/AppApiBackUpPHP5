<?php

		$UserType = $_POST['UserType'];
		
		if($UserType == "Super Admin"){
			$data=array(
					array(
						'Name' => 'User',
						'Type' => 'View User',
						'ICON' => 'http://163.53.150.181/IVVR_BPDB/icon/download.png'
					),
					array(
						'Name' => 'User Type',
						'Type' => 'View User Type',
						'ICON' => 'http://163.53.150.181/IVVR_BPDB/icon/unnamed.png'
					),
					array(
						'Name' => 'Customer',
						'Type' => 'View Customer',
						'ICON' => 'http://163.53.150.181/IVVR_BPDB/icon/download.png'
					),
					array(
						'Name' => 'Customer Type',
						'Type' => 'View Customer Type',
						'ICON' => 'http://163.53.150.181/IVVR_BPDB/icon/unnamed.png'
					),
					array(
						'Name' => 'Service',
						'Type' => 'View Service',
						'ICON' => 'http://163.53.150.181/IVVR_BPDB/icon/download.png'
					),
					array(
						'Name' => 'Service Type',
						'Type' => 'View Service Type',
						'ICON' => 'http://163.53.150.181/IVVR_BPDB/icon/download.png'
					),
					array(
						'Name' => 'Equipment',
						'Type' => 'View Equipment',
						'ICON' => 'http://163.53.150.181/IVVR_BPDB/icon/download.png'
					),
					array(
						'Name' => 'Equipment Type',
						'Type' => 'View Equipment Type',
						'ICON' => 'http://163.53.150.181/IVVR_BPDB/icon/download.png'
					),
					array(
						'Name' => 'Location',
						'Type' => 'View Location',
						'ICON' => 'http://163.53.150.181/IVVR_BPDB/icon/download.png'
					)
				);
		}
		
		else if($UserType == "Admin"){
			$data=array(
					array(
						'Name' => 'User',
						'Type' => 'View User',
						'ICON' => 'http://163.53.150.181/IVVR_BPDB/icon/download.png'
					),
					array(
						'Name' => 'User Type',
						'Type' => 'View User Type',
						'ICON' => 'http://163.53.150.181/IVVR_BPDB/icon/unnamed.png'
					),
					array(
						'Name' => 'Customer',
						'Type' => 'View Customer',
						'ICON' => 'http://163.53.150.181/IVVR_BPDB/icon/download.png'
					),
					array(
						'Name' => 'Customer Type',
						'Type' => 'View Customer Type',
						'ICON' => 'http://163.53.150.181/IVVR_BPDB/icon/unnamed.png'
					),
					array(
						'Name' => 'Service',
						'Type' => 'View Service',
						'ICON' => 'http://163.53.150.181/IVVR_BPDB/icon/download.png'
					),
					array(
						'Name' => 'Service Type',
						'Type' => 'View Service Type',
						'ICON' => 'http://163.53.150.181/IVVR_BPDB/icon/download.png'
					),
					array(
						'Name' => 'Equipment',
						'Type' => 'View Equipment',
						'ICON' => 'http://163.53.150.181/IVVR_BPDB/icon/download.png'
					),
					array(
						'Name' => 'Equipment Type',
						'Type' => 'View Equipment Type',
						'ICON' => 'http://163.53.150.181/IVVR_BPDB/icon/download.png'
					),
					array(
						'Name' => 'Location',
						'Type' => 'View Location',
						'ICON' => 'http://163.53.150.181/IVVR_BPDB/icon/download.png'
					)
				);
		}
		
		else if($UserType == "Editor"){
			$data=array(
					array(
						'Name' => 'Brand',
						'Type' => 'View Brands',
						'ICON' => 'http://163.53.150.181/IVVR_BPDB/icon/unnamed.png'
					),
					array(
						'Name' => 'Categories',
						'Type' => 'View Categories',
						'ICON' => 'http://163.53.150.181/IVVR_BPDB/icon/download.png'
					),
					array(
						'Name' => 'Product Types',
						'Type' => 'View Product Types',
						'ICON' => 'http://163.53.150.181/IVVR_BPDB/icon/unnamed.png'
					),
					array(
						'Name' => 'Product',
						'Type' => 'View Products',
						'ICON' => 'http://163.53.150.181/IVVR_BPDB/icon/download.png'
					)
				);
		}
		
		else if($UserType == "Super Admin"){
			$data=array(
					array(
						'Name' => 'User Type',
						'Type' => 'View User Type',
						'ICON' => 'http://163.53.150.181/IVVR_BPDB/icon/download.png'
					),
					array(
						'Name' => 'Brand',
						'Type' => 'View Brands',
						'ICON' => 'http://163.53.150.181/IVVR_BPDB/icon/unnamed.png'
					),
					array(
						'Name' => 'Categories',
						'Type' => 'View Categories',
						'ICON' => 'http://163.53.150.181/IVVR_BPDB/icon/download.png'
					),
					array(
						'Name' => 'Markets',
						'Type' => 'View Markets',
						'ICON' => 'http://163.53.150.181/IVVR_BPDB/icon/unnamed.png'
					),
					array(
						'Name' => 'Password Resets',
						'Type' => 'View Password Resets',
						'ICON' => 'http://163.53.150.181/IVVR_BPDB/icon/download.png'
					),
					array(
						'Name' => 'Product Types',
						'Type' => 'View Product Types',
						'ICON' => 'http://163.53.150.181/IVVR_BPDB/icon/unnamed.png'
					),
					array(
						'Name' => 'Product',
						'Type' => 'View Products',
						'ICON' => 'http://163.53.150.181/IVVR_BPDB/icon/download.png'
					),
					array(
						'Name' => 'Admins Users',
						'Type' => 'View Admins',
						'ICON' => 'http://163.53.150.181/IVVR_BPDB/icon/download.png'
					),
					array(
						'Name' => 'Country',
						'Type' => 'View Country',
						'ICON' => 'http://163.53.150.181/IVVR_BPDB/icon/download.png'
					)
				);
		}
		

		print json_encode($data);
		
	
	
?>