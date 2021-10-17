<?php
error_reporting(0);
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "soc_shop_bazaar";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  //die("Connection failed: " . $conn->connect_error);
  
	$post_data = array(
		'status_code' => '500',
		'msg' => 'Connection failed',
		'values' => $conn->connect_error,
	);
	print json_encode($post_data);
}

else{
	
	$Date="";
	date_default_timezone_set("Asia/Dhaka");
	$Date=date("Y/m/d");
	$Time=date("H:i:s");
	$Date=$Date.','.$Time;
	
	if($_SERVER['REQUEST_METHOD'] === 'POST'){
		
	$Type = $_POST['Type'];
	
//=================Start Add Data==================================================================================================================		
	
	if($Type == "LogIn") {
			
		$USER_ID = $_POST['USER_ID'];
		//$USER_PASSWORD = md5($_POST['USER_PASSWORD']);
		$USER_PASSWORD = $_POST['USER_PASSWORD'];
		
		$checkSQL1="SELECT count(admins_id) as User FROM admins where
					phone='$USER_ID' and password = '$USER_PASSWORD'";
					
				$result1 = $conn->query($checkSQL1);
				if ($result1->num_rows > 0) {
					while($row1 = $result1->fetch_assoc()) {
							$UserPhoneExt = $row1["User"];
					}
				} 
		if($UserPhoneExt==1){
				
				$sql = "SELECT * FROM admins
				where phone = '$USER_ID' and password = '$USER_PASSWORD'" ;
				$result = $conn->query($sql);
				
				$json_array= array();
				
				if ($result->num_rows > 0) {
					  while($row = $result->fetch_assoc()) {
						$json_array []=$row ;
					  }
					  
					  
					$post_data = array(
						'status_code' => '200',
						'msg' => 'Success',
						'values' => $json_array
					);
					print json_encode($post_data);
				}
				else {
					$post_data = array(
						'status_code' => '400',
						'msg' => 'Failed',
						'values' => "User Login Failed !!"
					);
					print json_encode($post_data); 
				}
		
		
		}else {
					$post_data = array(
						'status_code' => '400',
						'msg' => 'Failed',
						'values' => "User Login Failed !!"
					);
					print json_encode($post_data); 
				} 
	}
	
	
	else if($Type == "Add User Type") {
			
		$user_type_name = $_POST['user_type_name'];
		$user_type_status = $_POST['user_type_status'];
		
		if($user_type_name!="" && $user_type_status!=""){
			
			$sql = "INSERT INTO `user_type` (`user_type_name`,`user_type_status`,`create_info`)
					VALUES ('$user_type_name','$user_type_status','$Date')";

			if (mysqli_query($conn, $sql)) {
				$post_data = array(
					'status_code' => '200',
					'msg' => 'Success',
					'values' => 'New User Type Addded Successfully'
				);
				print json_encode($post_data); 
			} 
			
			else {
				$post_data = array(
					'status_code' => '400',
					'msg' => 'Failed',
					'values' => "New User Type Addded Failed" 
				);
				print json_encode($post_data); 
			}
			
			mysqli_close($conn);
		}
		
		else{
			
			$post_data = array(
				'status_code' => '400',
				'msg' => 'Failed',
				'values' => "Mandatory File Empty !!"
			);
			print json_encode($post_data); 
		}
	}
	
	elseif($Type == "Add Brands"){
		
		$admins_id = $_POST['admins_id'];
		$brands_name = $_POST['brands_name'];
		$brands_status = $_POST['brands_status'];
		
		if($admins_id!="" && $brands_name!="" && $brands_status!=""){
			
			$sql = "INSERT INTO `brands` (`admins_id`,`brands_name`,`brands_status`,`create_info`)
					VALUES ('$admins_id','$brands_name','$brands_status','$Date')";

			if (mysqli_query($conn, $sql)) {
				$post_data = array(
					'status_code' => '200',
					'msg' => 'Success',
					'values' => 'New Brand Addded Successfully'
				);
				print json_encode($post_data); 
			} 
			
			else {
				$post_data = array(
					'status_code' => '400',
					'msg' => 'Failed',
					'values' => "New Brand Addded Failed" 
				);
				print json_encode($post_data); 
			}
			
			mysqli_close($conn);
		}
		
		else{
			
			$post_data = array(
				'status_code' => '400',
				'msg' => 'Failed',
				'values' => "Mandatory File Empty !!"
			);
			print json_encode($post_data); 
		}
		
	}
	
	elseif($Type == "Add Categories"){
		
		$admins_id = $_POST['admins_id'];
		$categories_name = $_POST['categories_name'];
		$categories_status = $_POST['categories_status'];
		
		if($admins_id!="" && $categories_name!="" && $categories_status!=""){
			
			$sql = "INSERT INTO `categories` (`admins_id`,`categories_name`,`categories_status`,`create_info`)
					VALUES ('$admins_id','$categories_name','$categories_status','$Date')";

			if (mysqli_query($conn, $sql)) {
				$post_data = array(
					'status_code' => '200',
					'msg' => 'Success',
					'values' => 'New Categories Addded Successfully'
				);
				print json_encode($post_data); 
			} 
			
			else {
				$post_data = array(
					'status_code' => '400',
					'msg' => 'Failed',
					'values' => "New Categories Addded Failed" 
				);
				print json_encode($post_data); 
			}
			
			mysqli_close($conn);
		}
		
		else{
			
			$post_data = array(
				'status_code' => '400',
				'msg' => 'Failed',
				'values' => "Mandatory File Empty !!"
			);
			print json_encode($post_data); 
		}
		
	}
	
	elseif($Type == "Add ShopInfo"){
		
		$shop_info_name = $_POST['shop_info_name'];
		$shop_info_address = $_POST['shop_info_address'];
		$image_one = $_POST['image'];
		$phone = $_POST['phone'];
		$email = $_POST['email'];
		$shop_info_status = $_POST['shop_info_status'];
		
		if($products_id!="" && $admins_id!="" && $markets_status!=""){
			
			if($image_one!=""){
				$binary=base64_decode($image_one);
				header('Content-Type: bitmap; charset=utf-8');
				$imageTime=round(microtime(true) * 1000);
				$rootPath="C:\\xampp\htdocs\apps\SOC_71Bazaar/";
				$filePath1='UserImage/'.$name.'_1.png';
				$fileName= $rootPath.$filePath1;
				$file = fopen($fileName, 'wb');
				
				fwrite($file, $binary);
				fclose($file);
			}else{$filePath1="No Image";}
			
			$sql = "INSERT INTO `markets` (`shop_info_name`,`shop_info_address`,`image`,`phone`,`email`,`shop_info_status`)
					VALUES ('$shop_info_name','$shop_info_address','$filePath1','$phone','$email','$shop_info_status')";

			if (mysqli_query($conn, $sql)) {
				$post_data = array(
					'status_code' => '200',
					'msg' => 'Success',
					'values' => 'New Shop Info Added Successfully'
				);
				print json_encode($post_data); 
			} 
			
			else {
				$post_data = array(
					'status_code' => '400',
					'msg' => 'Failed',
					'values' => "New Markets Added Failed" 
				);
				print json_encode($post_data); 
			}
			
			mysqli_close($conn);
		}
		
		else{
			
			$post_data = array(
				'status_code' => '400',
				'msg' => 'Failed',
				'values' => "Mandatory File Empty !!"
			);
			print json_encode($post_data); 
		}
		
	}
	
	elseif($Type == "Add Password Resets"){
		
		$admins_id = $_POST['admins_id'];
		$email = $_POST['email'];
		$token = $_POST['token'];
		$password_resets_status = $_POST['password_resets_status'];
		
		if($email!="" && $token!="" && $password_resets_status!=""){
			
			$sql = "INSERT INTO `password_resets` (`admins_id`,`email`,`token`,`password_resets_status`)
					VALUES ('$admins_id','$email','$token','$password_resets_status')";

			if (mysqli_query($conn, $sql)) {
				$post_data = array(
					'status_code' => '200',
					'msg' => 'Success',
					'values' => 'Password Resets Successfully'
				);
				print json_encode($post_data); 
			} 
			
			else {
				$post_data = array(
					'status_code' => '400',
					'msg' => 'Failed',
					'values' => "Password Resets Failed" 
				);
				print json_encode($post_data); 
			}
			
			mysqli_close($conn);
		}
		
		else{
			
			$post_data = array(
				'status_code' => '400',
				'msg' => 'Failed',
				'values' => "Mandatory File Empty !!"
			);
			print json_encode($post_data); 
		}
		
	}
	
	elseif($Type == "Add Admins"){
		
		$image_one = $_POST['image'];
		$user_type_id = $_POST['user_type_id'];
		$name = $_POST['name'];
		$username = $_POST['name'];
		$phone = $_POST['phone'];
		$email = $_POST['email'];
		$password = md5($_POST['password']);
		$remember_token = bin2hex(openssl_random_pseudo_bytes(8));
		$admins_status = $_POST['admins_status'];
		$remember_token = wordwrap($remember_token , 4 , '-' , true );
		$username = strtolower( $username );
		$username = preg_replace('/\s+/', '', $username);
 
		if($user_type_id!="" && $name!="" && $username!="" && $phone!="" && $email!=""
		&& $password!=""&& $remember_token!=""&& $admins_status!=""){
			
			if($image_one!=""){
				$binary=base64_decode($image_one);
				header('Content-Type: bitmap; charset=utf-8');
				$imageTime=round(microtime(true) * 1000);
				$rootPath="C:\\xampp\htdocs\apps\SOC_71Bazaar/";
				$filePath1='UserImage/'.$name.'_1.png';
				$fileName= $rootPath.$filePath1;
				$file = fopen($fileName, 'wb');
				
				fwrite($file, $binary);
				fclose($file);
			}else{$filePath1="No Image";}
			
			$sql = "INSERT INTO `admins` (`image`,`user_type_id`,`name`,`username`,
			`phone`,`email`,`email_verified_at`,`password`,`remember_token`,`admins_status`,`create_info`)
					VALUES ('$filePath1','$user_type_id','$name','$username',
					'$phone','$email','$email_verified_at','$password','$remember_token','$admins_status','$Date')";

			if (mysqli_query($conn, $sql)) {
				$post_data = array(
					'status_code' => '200',
					'msg' => 'Success',
					'values' => 'New User Added Successfully'
				);
				print json_encode($post_data); 
			} 
			
			else {
				$post_data = array(
					'status_code' => '400',
					'msg' => 'Failed',
					'values' => "New User Added Failed" 
				);
				print json_encode($post_data); 
			}
			
			mysqli_close($conn);
		}
		
		else{
			
			$post_data = array(
				'status_code' => '400',
				'msg' => 'Failed',
				'values' => "Mandatory File Empty !!"
			);
			print json_encode($post_data); 
		}
		
	}
	
	elseif($Type == "Add Dealership Info"){
		
		$admins_id = $_POST['admins_id'];
		$product_types_name = $_POST['product_types_name'];
		$product_types_status = $_POST['product_types_status'];
		
		if($admins_id!="" && $product_types_name!="" && $product_types_status!=""){
			
			$sql = "INSERT INTO `product_types` (`product_types_name`,`admins_id`,`product_types_status`,`create_info`)
					VALUES ('$product_types_name','$admins_id','$product_types_status','$Date')";

			if (mysqli_query($conn, $sql)) {
				$post_data = array(
					'status_code' => '200',
					'msg' => 'Success',
					'values' => 'Product Types Added Successfully'
				);
				print json_encode($post_data); 
			} 
			
			else {
				$post_data = array(
					'status_code' => '400',
					'msg' => 'Failed',
					'values' => "Product Types Added Failed" 
				);
				print json_encode($post_data); 
			}
			
			mysqli_close($conn);
		}
		
		else{
			
			$post_data = array(
				'status_code' => '400',
				'msg' => 'Failed',
				'values' => "Mandatory File Empty !!"
			);
			print json_encode($post_data); 
		}
		
	}
	
	elseif($Type == "Add Product Types"){
		
		$admins_id = $_POST['admins_id'];
		$product_types_name = $_POST['product_types_name'];
		$product_types_status = $_POST['product_types_status'];
		
		if($admins_id!="" && $product_types_name!="" && $product_types_status!=""){
			
			$sql = "INSERT INTO `product_types` (`product_types_name`,`admins_id`,`product_types_status`,`create_info`)
					VALUES ('$product_types_name','$admins_id','$product_types_status','$Date')";

			if (mysqli_query($conn, $sql)) {
				$post_data = array(
					'status_code' => '200',
					'msg' => 'Success',
					'values' => 'Product Types Added Successfully'
				);
				print json_encode($post_data); 
			} 
			
			else {
				$post_data = array(
					'status_code' => '400',
					'msg' => 'Failed',
					'values' => "Product Types Added Failed" 
				);
				print json_encode($post_data); 
			}
			
			mysqli_close($conn);
		}
		
		else{
			
			$post_data = array(
				'status_code' => '400',
				'msg' => 'Failed',
				'values' => "Mandatory File Empty !!"
			);
			print json_encode($post_data); 
		}
		
	}
	
	elseif($Type == "Add Products"){
		
		$admins_id = $_POST['admins_id'];
		$product_types_id = $_POST['product_types_id'];
		$dealership_info_id = $_POST['dealership_info_id'];
		$category_id = $_POST['category_id'];
		$brands_id = $_POST['brands_id'];
		$country_id = $_POST['country_id'];
		$name = $_POST['name'];
		$details = $_POST['details'];
		$image_one = $_POST['image_one'];
		$image_two = $_POST['image_two'];
		$image_three = $_POST['image_three'];
		$image_four = $_POST['image_four'];
		$price = $_POST['price'];
		$discount_price = $_POST['discount_price'];
		$discount = $_POST['discount'];
		$quantity = $_POST['quantity'];
		$quantity_type = $_POST['quantity_type'];
		$sort_order = $_POST['sort_order'];
		$products_status = $_POST['products_status'];
		
		if($admins_id!="" && $product_types_id!="" &&  $dealership_info_id!="" && $category_id!=""&& $brands_id!=""&& $country_id!=""&& $country_id!=""&& $name!=""&& $details!=""&& $price!=""&& $discount_price!=""&& $discount!=""&& $quantity!=""&&  $quantity_type!=""&& $sort_order!=""){
			
			if($image_one!=""){
				$binary=base64_decode($image_one);
				header('Content-Type: bitmap; charset=utf-8');
				$imageTime=round(microtime(true) * 1000);
				$rootPath="C:\\xampp\htdocs\apps\SOC_71Bazaar/";
				$filePath1='ProductImage/'.$name.'_1.png';
				$fileName= $rootPath.$filePath1;
				$file = fopen($fileName, 'wb');
				
				fwrite($file, $binary);
				fclose($file);
			}else{$filePath1="No Image";}
			
			if($image_two!=""){
				$binary=base64_decode($image_two);
					
				header('Content-Type: bitmap; charset=utf-8');
				$imageTime=round(microtime(true) * 1000);
				$rootPath="C:\\xampp\htdocs\apps\SOC_71Bazaar/";
				$filePath2='ProductImage/'.$name.'_2.png';
				$fileName= $rootPath.$filePath2;
				$file = fopen($fileName, 'wb');
				
				fwrite($file, $binary);
				fclose($file);
			}else{$filePath2="No Image";}
			
			if($image_three!=""){
				$binary=base64_decode($image_three);
					
				header('Content-Type: bitmap; charset=utf-8');
				$imageTime=round(microtime(true) * 1000);
				$rootPath="C:\\xampp\htdocs\apps\SOC_71Bazaar/";
				$filePath3='ProductImage/'.$name.'_3.png';
				$fileName= $rootPath.$filePath3;
				$file = fopen($fileName, 'wb');
				
				fwrite($file, $binary);
				fclose($file);
			}else{$filePath3="No Image";}
			
			if($image_four!=""){
				$binary=base64_decode($image_four);
					
				header('Content-Type: bitmap; charset=utf-8');
				$imageTime=round(microtime(true) * 1000);
				$rootPath="C:\\xampp\htdocs\apps\SOC_71Bazaar/";
				$filePath4='ProductImage/'.$name.'_4.png';
				$fileName= $rootPath.$filePath4;
				$file = fopen($fileName, 'wb');
				
				fwrite($file, $binary);
				fclose($file);
			}else{$filePath4="No Image";}
			
			$sql = "INSERT INTO `products` (`admins_id`, `product_types_id`,`dealership_info_id`, `category_id`, `brands_id`,
			`country_id`, `name`, `details`, `image_one`, `image_two`, `image_three`, `image_four`,
			`price`, `discount_price`, `discount`, `quantity`,`quantity_type`, `sort_order`, `products_status`, `create_info`)
					VALUES ('$admins_id','$product_types_id','$dealership_info_id','$category_id','$brands_id',
					'$country_id','$name','$details','$filePath1','$filePath2','$filePath3','$filePath4',
					'$price','$discount_price','$discount','$quantity','$quantity_type','$sort_order','$products_status','$Date')";

			if (mysqli_query($conn, $sql)) {
				$post_data = array(
					'status_code' => '200',
					'msg' => 'Success',
					'values' => 'Product Added Successfully'
				);
				print json_encode($post_data); 
			} 
			
			else {
				$post_data = array(
					'status_code' => '400',
					'msg' => 'Failed',
					'values' => "Product Added Failed" 
				);
				print json_encode($post_data); 
			}
			
			mysqli_close($conn);
		}
		
		else{
			
			$post_data = array(
				'status_code' => '400',
				'msg' => 'Failed',
				'values' => "Mandatory File Empty !!"
			);
			print json_encode($post_data); 
		}
		
	}


//================End Add Data=================================================================================================================


//================Start Dash Bord Menu=================================================================================================================
	
	elseif($Type == "Dash Bord Menu"){
		
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
						'Name' => 'Shop Info',
						'Type' => 'View ShopInfo',
						'ICON' => 'http://163.53.150.181/IVVR_BPDB/icon/unnamed.png'
					),
					array(
						'Name' => 'Dealership Info',
						'Type' => 'View Dealership Info',
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

			print json_encode($data);
		
	}
	
//=================End Dash Bord Menu================================================================================================================

//=================Start View Data ================================================================================================================
	
	elseif($Type == "View Admins"){
		
		$json_array= array();
			$checkSQL1="SELECT * FROM admins ";
			$result1 = $conn->query($checkSQL1);
			
			if ($result1->num_rows > 0) {
				  while($row = $result1->fetch_assoc()) {
					$json_array []=$row ;					 
				  }
			}
	
		print json_encode($json_array);
		
	}
	
	elseif($Type == "View Brands"){
		
		$json_array= array();
			$checkSQL1="SELECT * FROM brands ";
			$result1 = $conn->query($checkSQL1);
			
			if ($result1->num_rows > 0) {
				  while($row = $result1->fetch_assoc()) {
					$json_array []=$row ;					 
				  }
			}
	
		print json_encode($json_array);
		
	}
	
	elseif($Type == "View Categories"){
		
		$json_array= array();
			$checkSQL1="SELECT * FROM categories ";
			$result1 = $conn->query($checkSQL1);
			
			if ($result1->num_rows > 0) {
				  while($row = $result1->fetch_assoc()) {
					$json_array []=$row ;					 
				  }
			}
	
		print json_encode($json_array);
		
	}
	
	elseif($Type == "View Country"){
		
		$json_array= array();
			$checkSQL1="SELECT * FROM country ";
			$result1 = $conn->query($checkSQL1);
			
			if ($result1->num_rows > 0) {
				  while($row = $result1->fetch_assoc()) {
					$json_array []=$row ;					 
				  }
			}
	
		print json_encode($json_array);
		
	}
	
	elseif($Type == "View ShopInfo"){
		
		$json_array= array();
			$checkSQL1="SELECT * FROM shopinfo ";
			$result1 = $conn->query($checkSQL1);
			
			if ($result1->num_rows > 0) {
				  while($row = $result1->fetch_assoc()) {
					$json_array []=$row ;					 
				  }
			}
	
		print json_encode($json_array);
		
	}
	
	elseif($Type == "View Password Resets"){
		
		$json_array= array();
			$checkSQL1="SELECT * FROM password_resets ";
			$result1 = $conn->query($checkSQL1);
			
			if ($result1->num_rows > 0) {
				  while($row = $result1->fetch_assoc()) {
					$json_array []=$row ;					 
				  }
			}
	
		print json_encode($json_array);
		
	}
	
	elseif($Type == "View Product Types"){
		
		$json_array= array();
			$checkSQL1="SELECT * FROM product_types ";
			$result1 = $conn->query($checkSQL1);
			
			if ($result1->num_rows > 0) {
				  while($row = $result1->fetch_assoc()) {
					$json_array []=$row ;					 
				  }
			}
	
		print json_encode($json_array);
		
	}
	
	elseif($Type == "View User Type"){
		
		$json_array= array();
			$checkSQL1="SELECT * FROM user_type ";
			$result1 = $conn->query($checkSQL1);
			
			if ($result1->num_rows > 0) {
				  while($row = $result1->fetch_assoc()) {
					$json_array []=$row ;					 
				  }
			}
	
		print json_encode($json_array);
		
	}
	
	elseif($Type == "View Products"){
		
		$json_array= array();
			$checkSQL1="SELECT * FROM products ";
			$result1 = $conn->query($checkSQL1);
			
			if ($result1->num_rows > 0) {
				  while($row = $result1->fetch_assoc()) {
					$json_array []=$row ;					 
				  }
			}
	
		print json_encode($json_array);
		
	}

//=================End View Data ================================================================================================================

//=================Start Delete Data ================================================================================================================
	
	elseif($Type == "Delete User Type"){
		$ID = $_POST['ID'];
		
			$sql ="DELETE FROM 	user_type WHERE '$ID'";
			
			if ($conn->query($sql) === TRUE) {
				$post_data = array(
					'status_code' => '200',
					'msg' => 'Failed',
					'values' => "Record Deleted Successfully !!"
				);
			} else {
				$post_data = array(
					'status_code' => '400',
					'msg' => 'Failed',
					'values' => "Error Deleting Record"
				);
			}
	
		print json_encode($post_data);
		
	}
	
	elseif($Type == "Delete Categories"){
		$ID = $_POST['ID'];
		
			$sql ="DELETE FROM categories WHERE '$ID'";
			
			if ($conn->query($sql) === TRUE) {
				$post_data = array(
					'status_code' => '200',
					'msg' => 'Failed',
					'values' => "Record Deleted Successfully !!"
				);
			} else {
				$post_data = array(
					'status_code' => '400',
					'msg' => 'Failed',
					'values' => "Error Deleting Record"
				);
			}
	
		print json_encode($post_data);
		
	}
	
	elseif($Type == "Delete Admins"){
		$ID = $_POST['ID'];
		
			$sql ="DELETE FROM admins WHERE '$ID'";
			
			if ($conn->query($sql) === TRUE) {
				$post_data = array(
					'status_code' => '200',
					'msg' => 'Failed',
					'values' => "Record Deleted Successfully !!"
				);
			} else {
				$post_data = array(
					'status_code' => '400',
					'msg' => 'Failed',
					'values' => "Error Deleting Record"
				);
			}
	
		print json_encode($post_data);
		
	}
	
	elseif($Type == "Delete Brands"){
		$ID = $_POST['ID'];
		
			$sql ="DELETE FROM brands WHERE '$ID'";
			
			if ($conn->query($sql) === TRUE) {
				$post_data = array(
					'status_code' => '200',
					'msg' => 'Failed',
					'values' => "Record Deleted Successfully !!"
				);
			} else {
				$post_data = array(
					'status_code' => '400',
					'msg' => 'Failed',
					'values' => "Error Deleting Record"
				);
			}
	
		print json_encode($post_data);
		
	}

	elseif($Type == "Delete Products"){
		$ID = $_POST['ID'];
		
			$sql ="DELETE FROM products WHERE '$ID'";
			
			if ($conn->query($sql) === TRUE) {
				$post_data = array(
					'status_code' => '200',
					'msg' => 'Failed',
					'values' => "Record Deleted Successfully !!"
				);
			} else {
				$post_data = array(
					'status_code' => '400',
					'msg' => 'Failed',
					'values' => "Error Deleting Record"
				);
			}
	
		print json_encode($post_data);
		
	}
	
	elseif($Type == "Delete Product Types"){
		
		$ID = $_POST['ID'];
		
			$sql ="DELETE FROM product_types WHERE '$ID'";
			
			if ($conn->query($sql) === TRUE) {
				$post_data = array(
					'status_code' => '200',
					'msg' => 'Failed',
					'values' => "Record Deleted Successfully !!"
				);
			} else {
				$post_data = array(
					'status_code' => '400',
					'msg' => 'Failed',
					'values' => "Error Deleting Record"
				);
			}
	
		print json_encode($post_data);
		
	}
	
	elseif($Type == "Delete ShopInfo"){
		
		$ID = $_POST['ID'];
		
			$sql ="DELETE FROM shopinfo WHERE '$ID'";
			
			if ($conn->query($sql) === TRUE) {
				$post_data = array(
					'status_code' => '200',
					'msg' => 'Failed',
					'values' => "Record Deleted Successfully !!"
				);
			} else {
				$post_data = array(
					'status_code' => '400',
					'msg' => 'Failed',
					'values' => "Error Deleting Record"
				);
			}
	
		print json_encode($post_data);
		
	}

//=================End Delete Data ================================================================================================================

//=================Start Edit Data ================================================================================================================
	
	elseif($Type == "Edit Product Types"){
		
		$ID = $_POST['ID'];
		$product_types_name = $_POST['product_types_name'];
		$product_types_status = $_POST['product_types_status'];
		
			$sql ="UPDATE product_types SET 
			product_types_name='$product_types_name',
			product_types_status='$product_types_status',
			update_info='$Date'
			WHERE product_types_id = '$ID'";
			
			if ($conn->query($sql) === TRUE) {
				$post_data = array(
					'status_code' => '200',
					'msg' => 'Failed',
					'values' => "Product Type Update Successfully !!"
				);
			} else {
				$post_data = array(
					'status_code' => '400',
					'msg' => 'Failed',
					'values' => "Product Type Update Failed"
				);
			}
	
		print json_encode($post_data);
		
		
	}
	
	elseif($Type == "Edit  Products"){
		
		$ID = $_POST['ID'];
		
			$sql ="DELETE FROM product_types WHERE '$ID'";
			
			if ($conn->query($sql) === TRUE) {
				$post_data = array(
					'status_code' => '200',
					'msg' => 'Failed',
					'values' => "Record Deleted Successfully !!"
				);
			} else {
				$post_data = array(
					'status_code' => '400',
					'msg' => 'Failed',
					'values' => "Error Deleting Record"
				);
			}
	
		print json_encode($post_data);
		
	}
	
	elseif($Type == "Edit Admins"){
		
		$ID = $_POST['ID'];
		$user_type_id = $_POST['user_type_id'];
		$name = $_POST['name'];
		$image = $_POST['image'];
		$phone = $_POST['phone'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$admins_status = $_POST['admins_status'];
		
		$remember_token = bin2hex(openssl_random_pseudo_bytes(8));
		$remember_token = wordwrap($remember_token , 4 , '-' , true );
		$name = strtolower( $name );
		$username = preg_replace('/\s+/', '', $name);
		
		if($image!=""){
				$binary=base64_decode($image);
				header('Content-Type: bitmap; charset=utf-8');
				$imageTime=round(microtime(true) * 1000);
				$rootPath="C:\\xampp\htdocs\apps\SOC_71Bazaar/";
				$filePath1='UserImage/'.$name.'_1.png';
				$fileName= $rootPath.$filePath1;
				$file = fopen($fileName, 'wb');
				
				fwrite($file, $binary);
				fclose($file);
				
		}else{$filePath1="No Image";}
		
			$sql ="UPDATE admins SET 
			user_type_id ='$user_type_id',
			name='$name',
			image='$filePath1',
			phone='$phone',
			email='$email',
			password='$password',
			remember_token='$remember_token',
			username='$username',
			admins_status='$admins_status',
			update_info='$Date'
			WHERE admins_id = '$ID'";
			
			if ($conn->query($sql) === TRUE) {
				$post_data = array(
					'status_code' => '200',
					'msg' => 'Failed',
					'values' => "Record Update Successfully !!"
				);
			} else {
				$post_data = array(
					'status_code' => '400',
					'msg' => 'Failed',
					'values' => "Error Update Record"
				);
			}
	
		print json_encode($post_data);
		
	}
	
	elseif($Type == "Edit Brands"){
		
		$ID = $_POST['ID'];
		$brands_name = $_POST['brands_name'];
		$brands_status = $_POST['brands_status'];
		
			$sql ="UPDATE brands SET 
			brands_name='$brands_name',
			brands_status='$brands_status',
			update_info='$Date'
			WHERE brands_id = '$ID'";
			
			if ($conn->query($sql) === TRUE) {
				$post_data = array(
					'status_code' => '200',
					'msg' => 'Failed',
					'values' => "Brands Update Successfully !!"
				);
			} else {
				$post_data = array(
					'status_code' => '400',
					'msg' => 'Failed',
					'values' => "Brands Update Record"
				);
			}
	
		print json_encode($post_data);
		
	}
	
	elseif($Type == "Edit User Type"){
		
		$ID = $_POST['ID'];
		$user_type_name = $_POST['user_type_name'];
		$user_type_status = $_POST['user_type_status'];
		
			$sql ="UPDATE user_type SET 
			user_type_name='$user_type_name',
			user_type_status='$user_type_status',
			update_info='$Date'
			WHERE user_type_id = '$ID'";
			
			if ($conn->query($sql) === TRUE) {
				$post_data = array(
					'status_code' => '200',
					'msg' => 'Failed',
					'values' => "User Type Update Successfully !!"
				);
			} else {
				$post_data = array(
					'status_code' => '400',
					'msg' => 'Failed',
					'values' => "User Type Update Failed"
				);
			}
	
		print json_encode($post_data);
		
	}
		
	elseif($Type == "Edit Categories"){
		
		$ID = $_POST['ID'];
		$categories_name = $_POST['categories_name'];
		$categories_status = $_POST['categories_status'];
		
			$sql ="UPDATE user_type SET 
			categories_name='$categories_name',
			categories_status='$categories_status',
			update_info='$Date'
			WHERE categories_id = '$ID'";
			
			if ($conn->query($sql) === TRUE) {
				$post_data = array(
					'status_code' => '200',
					'msg' => 'Failed',
					'values' => "Categories Update Successfully !!"
				);
			} else {
				$post_data = array(
					'status_code' => '400',
					'msg' => 'Failed',
					'values' => "Categories Update Failed"
				);
			}
	
		print json_encode($post_data);
		
	}
	
//=================End Edit Data ================================================================================================================
	
	else{
		$post_data = array(
			'status_code' => '400',
			'msg' => 'Failed',
			'values' => "Type Not Found !!"
		);
		print json_encode($post_data); 
	}
	
}
	
	else{
		$post_data = array(
			'status_code' => '502',
			'msg' => 'Failed',
			'values' => 'Sorry You Are Not Allow Here',
		  );
		print json_encode($post_data); 
		 //header('Location: error.php');
	 } 
}
?>