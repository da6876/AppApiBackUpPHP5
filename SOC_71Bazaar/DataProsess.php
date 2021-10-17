<?php
error_reporting(0);
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "soc_71bazaar";

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
		
	if($Type == "User LogIn") {
			
		$USER_ID = $_POST['USER_ID'];
		$USER_PASSWORD = md5($_POST['USER_PASSWORD']);
		//$USER_PASSWORD = $_POST['USER_PASSWORD'];
		
		$checkSQL1="SELECT count(admins_id) as User FROM admins where
				email='$USER_ID' and password = '$USER_PASSWORD'";
				$result1 = $conn->query($checkSQL1);
				
				if ($result1->num_rows > 0) {
					  while($row = $result1->fetch_assoc()) {
						 $UserEmailExt = $row["User"];
					  }
				}
		
		$checkSQL2="SELECT count(admins_id) as User FROM admins where
				phone='$USER_ID' and password = '$USER_PASSWORD'";
				 $result2 = $conn->query($checkSQL2);
				
				if ($result2->num_rows > 0) {
					  while($row1 = $result2->fetch_assoc()) {
						   $UserPhoneExt = $row1["User"];
					  }
				} 
			
		if($UserPhoneExt==1){
				
				$sql = "SELECT a.admins_id, a.user_type_id, a.name, a.username,
				a.image, a.phone, a.email, a.password, a.admins_status, b.user_type_name 
				FROM admins a, user_type b 
				where email = '$USER_ID' and
				password = '$USER_PASSWORD' and
				a.user_type_id = b.user_type_id";
				
				$result = $conn->query($sql);

					if ($result->num_rows > 0) {
					  while($row = $result->fetch_assoc()) {
					
							$value = array(
								'admins_id' =>  $row["admins_id"],
								'user_type_id' =>  $row["user_type_id"],
								'name' =>  $row["name"],
								'username' =>  $row["username"],
								'image' =>  $row["image"],
								'phone' =>  $row["phone"],
								'email' =>  $row["email"],
								'password' =>  $row["password"],
								'user_type_name' =>  $row["user_type_name"],
								'admins_status' =>  $row["admins_status"]
							);
					  }
					  
					$post_data = array(
							'status_code' => '200',
							'msg' => 'Success',
							'values' => $value
					);
					print json_encode($post_data); 
					} else {			  
						$post_data = array(
							'status_code' => '400',
							'msg' => 'Failed',
							'values' => "User Login Failed !!"
						);
						print json_encode($post_data); 
					} 
			}else if($UserEmailExt=="1"){
				$sql = "SELECT a.admins_id, a.user_type_id, a.name, a.username,
				a.image, a.phone, a.email, a.password, a.admins_status, b.user_type_name 
				FROM admins a, user_type b 
				where email = '$USER_ID' and
				password = '$USER_PASSWORD' and
				a.user_type_id = b.user_type_id";
				
				$result = $conn->query($sql);

				if ($result->num_rows > 0) {
				  while($row = $result->fetch_assoc()) {
					  
				
					$value = array(
						'admins_id' =>  $row["admins_id"],
						'user_type_id' =>  $row["user_type_id"],
						'name' =>  $row["name"],
						'username' =>  $row["username"],
						'image' =>  $row["image"],
						'phone' =>  $row["phone"],
						'email' =>  $row["email"],
						'password' =>  $row["password"],
								'user_type_name' =>  $row["user_type_name"],
						'admins_status' =>  $row["admins_status"]
					);
				  }
					$post_data = array(
						'status_code' => '200',
						'msg' => 'Success',
						'values' => $value
					);
					print json_encode($post_data); 
				} else {
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
			
			$sql = "INSERT INTO `user_type` (`user_type_name`,`user_type_status`)
					VALUES ('$user_type_name','$user_type_status')";

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
		
		$brands_name = $_POST['brands_name'];
		$brands_status = $_POST['brands_status'];
		
		if($brands_name!="" && $brands_status!=""){
			
			$sql = "INSERT INTO `brands` (`brands_name`,`brands_status`)
					VALUES ('$brands_name','$brands_status')";

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
		
		$categories_name = $_POST['categories_name'];
		$categories_status = $_POST['categories_status'];
		
		if($categories_name!="" && $categories_status!=""){
			
			$sql = "INSERT INTO `categories` (`categories_name`,`categories_status`)
					VALUES ('$categories_name','$categories_status')";

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
	
	elseif($Type == "Add Markets"){
		
		$products_id = $_POST['products_id'];
		$admins_id = $_POST['admins_id'];
		$markets_status = $_POST['markets_status'];
		$quantity = $_POST['quantity'];
		
		if($products_id!="" && $admins_id!="" && $markets_status!=""){
			
			$sql = "INSERT INTO `markets` (`products_id`,`admins_id`,`markets_status`,`quantity`)
					VALUES ('$products_id','$admins_id','$markets_status','$quantity')";

			if (mysqli_query($conn, $sql)) {
				$post_data = array(
					'status_code' => '200',
					'msg' => 'Success',
					'values' => 'New Card Added Successfully'
				);
				print json_encode($post_data); 
			} 
			
			else {
				$post_data = array(
					'status_code' => '400',
					'msg' => 'Failed',
					'values' => "New Card Added Failed" 
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
	
	elseif($Type == "Add Oder"){
		
		$admin_id = $_POST['admin_id'];
		$product_id = $_POST['product_id'];
		$address = $_POST['address'];
		$price = $_POST['price'];
		$quantity = $_POST['quantity'];
		
		if($admin_id!="" && $product_id!="" && $address!="" && $price!="" && $quantity!=""){
			
			$sql = "INSERT INTO `oder_info` (`admin_id`,`product_id`,`address`,`price`,`quantity`)
					VALUES ('$admin_id','$product_id','$address','$price','$quantity')";

			if (mysqli_query($conn, $sql)) {
				$post_data = array(
					'status_code' => '200',
					'msg' => 'Success',
					'values' => 'New Order Added Successfully'
				);
				print json_encode($post_data); 
			} 
			
			else {
				$post_data = array(
					'status_code' => '400',
					'msg' => 'Failed',
					'values' => "New Order Added Failed" 
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
	
	elseif($Type == "Delete Oder"){
		
		$order_id = $_POST['order_id'];
		
		if($order_id!=""){
			
			$sql = "DELETE FROM `oder_info` WHERE order_id='$order_id')";

			if (mysqli_query($conn, $sql)) {
				$post_data = array(
					'status_code' => '200',
					'msg' => 'Success',
					'values' => 'New Order Cancle Successfully'
				);
				print json_encode($post_data); 
			} 
			
			else {
				$post_data = array(
					'status_code' => '400',
					'msg' => 'Failed',
					'values' => "New Order Cancle Failed" 
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
	
	elseif($Type == "Update Markets"){
		
		$markets_id = $_POST['markets_id'];
		$products_id = $_POST['products_id'];
		$admins_id = $_POST['admins_id'];
		$quantity = $_POST['quantity'];
		
		if($products_id!="" && $admins_id!="" && $markets_id!=""){
			
			$sql = "UPDATE markets SET 
			products_id='$products_id',
			admins_id='$admins_id',
			quantity='$quantity',
			markets_status='A',
			update_info='$Date' 
			WHERE markets_id = '$markets_id'";

			if (mysqli_query($conn, $sql)) {
				$post_data = array(
					'status_code' => '200',
					'msg' => 'Success',
					'values' => 'Card update Successfully'
				);
				print json_encode($post_data); 
			} 
			
			else {
				$post_data = array(
					'status_code' => '400',
					'msg' => 'Failed',
					'values' => "Card update Failed" 
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
	
	elseif($Type == "Delete Markets"){
		
		$markets_id = $_POST['markets_id'];
		
		if($products_id!="" && $admins_id!="" && $markets_id!=""){
			
			$sql = "UPDATE FROM markets where markets_id = '$markets_id'";

			if (mysqli_query($conn, $sql)) {
				$post_data = array(
					'status_code' => '200',
					'msg' => 'Success',
					'values' => 'Card Delete Successfully'
				);
				print json_encode($post_data); 
			} 
			
			else {
				$post_data = array(
					'status_code' => '400',
					'msg' => 'Failed',
					'values' => "Card Delete Failed" 
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
		
		$email = $_POST['email'];
		$token = $_POST['token'];
		$password_resets_status = $_POST['password_resets_status'];
		
		if($email!="" && $token!="" && $password_resets_status!=""){
			
			$sql = "INSERT INTO `password_resets` (`email`,`token`,`password_resets_status`)
					VALUES ('$email','$token','$password_resets_status')";

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
				
				fclose($file);
				fwrite($file, $binary);
			}else{$filePath1="No Image";}
			
			$sql = "INSERT INTO `admins` (`image`,`user_type_id`,`name`,`username`,
			`phone`,`email`,`email_verified_at`,`password`,`remember_token`,`admins_status`)
					VALUES ('$filePath1','$user_type_id','$name','$username',
					'$phone','$email','$email_verified_at','$password','$remember_token','$admins_status')";

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
	
	elseif($Type == "Add User From App"){
		
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
			
			if($image_one!=""){$filePath1=$image_one;}else{$filePath1="No Image";}
			
			$sql = "INSERT INTO `admins` (`image`,`user_type_id`,`name`,`username`,
			`phone`,`email`,`email_verified_at`,`password`,`remember_token`,`admins_status`)
					VALUES ('$filePath1','$user_type_id','$name','$username',
					'$phone','$email','$email_verified_at','$password','$remember_token','$admins_status')";

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
	
	elseif($Type == "Add Product Types"){
		
		$product_types_name = $_POST['product_types_name'];
		$product_types_status = $_POST['product_types_status'];
		
		if($product_types_name!="" && $product_types_status!=""){
			
			$sql = "INSERT INTO `product_types` (`product_types_name`,`product_types_status`)
					VALUES ('$product_types_name','$product_types_status')";

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
		
		$product_types_id = $_POST['product_types_id'];
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
		$sort_order = $_POST['sort_order'];
		$products_status = $_POST['products_status'];
		
		if($product_types_id!="" && $category_id!=""&& $brands_id!=""&& $country_id!=""&& $country_id!=""&& $name!=""&& $details!=""&& $price!=""&& $discount_price!=""&& $discount!=""&& $quantity!=""&& $sort_order!=""){
			
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
			
			$sql = "INSERT INTO `products` (`products_id`, `product_types_id`, `category_id`, `brands_id`,
			`country_id`, `name`, `details`, `image_one`, `image_two`, `image_three`, `image_four`,
			`price`, `discount_price`, `discount`, `quantity`, `sort_order`, `products_status`)
					VALUES ('$products_id','$product_types_id','$category_id','$brands_id',
					'$country_id','$name','$details','$filePath1','$filePath2','$filePath3','$filePath4',
					'$price','$discount_price','$discount','$quantity','$sort_order','$products_status')";

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
	
	elseif($Type == "Dash Bord Menu"){
		$UserType = $_POST['UserType'];
		
		if($UserType == "Admin"){
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
		
	}
	
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
	
	elseif($Type == "View Markets"){
		
		$json_array= array();
			$checkSQL1="SELECT * FROM markets ";
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
	
	elseif($Type == "Delete User Type"){
		$ID = $_POST['ID'];
		$checkSQL1="SELECT count(user_type_id) as user_type_id FROM user_type where
			user_type_id='$ID'";
			$result1 = $conn->query($checkSQL1);
			
			if ($result1->num_rows > 0) {
				  while($row = $result1->fetch_assoc()) {
					$Ext = $row["user_type_id"];
				  }
			}
			
			if($Ext==1){
				$sql ="DELETE FROM user_type WHERE user_type_id ='$ID'";
				
				 if ($conn->query($sql) == TRUE) {
					$post_data = array(
						'status_code' => '200',
						'msg' => 'Success',
						'values' => "Record Deleted Successfully !!"
					);
				} else {
					$post_data = array(
						'status_code' => '400',
						'msg' => 'Failed',
						'values' => "Error Deleting Record"
					);
				} 
			}else{
				$post_data = array(
						'status_code' => '400',
						'msg' => 'Failed',
						'values' => "ID Is not Valid"
					);
			}
		print json_encode($post_data);
		
	}
	
	elseif($Type == "Delete Categories"){
		$ID = $_POST['ID'];
		$checkSQL1="SELECT count(categories_id) as categories_id FROM categories where
			categories_id='$ID'";
			$result1 = $conn->query($checkSQL1);
			
			if ($result1->num_rows > 0) {
				  while($row = $result1->fetch_assoc()) {
					$Ext = $row["categories_id"];
				  }
			}
			
			if($Ext!=0){
				$sql ="DELETE FROM categories WHERE categories_id='$ID'";
				
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
			}else {
					$post_data = array(
						'status_code' => '400',
						'msg' => 'Failed',
						'values' => "Id Is Not Valid"
					);
				}
		print json_encode($post_data);
		
	}
	
	elseif($Type == "Delete Admins"){
		$ID = $_POST['ID'];
		$checkSQL1="SELECT count(admins_id) as admins_id FROM admins where
			admins_id='$ID'";
			$result1 = $conn->query($checkSQL1);
			
			if ($result1->num_rows > 0) {
				  while($row = $result1->fetch_assoc()) {
					$Ext = $row["admins_id"];
				  }
			}
			
			if($Ext!=0){
				
				$sql ="DELETE FROM admins WHERE admins_id='$ID'";
			
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
			}else {
					$post_data = array(
						'status_code' => '400',
						'msg' => 'Failed',
						'values' => "ID IS Not Valid"
					);
				}
			
	
		print json_encode($post_data);
		
	}
	
	elseif($Type == "Delete Brands"){
		$ID = $_POST['ID'];
		$checkSQL1="SELECT count(brands_id) as brands_id FROM brands where
			brands_id='$ID'";
			$result1 = $conn->query($checkSQL1);
			
			if ($result1->num_rows > 0) {
				  while($row = $result1->fetch_assoc()) {
					$Ext = $row["brands_id"];
				  }
			}
			if($Ext!=0){
				$sql ="DELETE FROM brands WHERE brands_id='$ID'";
				
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
				
			}else {
					$post_data = array(
						'status_code' => '400',
						'msg' => 'Failed',
						'values' => "Id Not Valid"
					);
				}
	
		print json_encode($post_data);
		
	}

	elseif($Type == "Delete Products"){
		$ID = $_POST['ID'];
		$checkSQL1="SELECT count(products_id) as products_id FROM products where
			products_id='$ID'";
			$result1 = $conn->query($checkSQL1);
			
			if ($result1->num_rows > 0) {
				  while($row = $result1->fetch_assoc()) {
					$Ext = $row["products_id"];
				  }
			}
			
			if($Ext!=0){
				$sql ="DELETE FROM products WHERE products_id='$ID'";
			
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
			}else{
				$post_data = array(
						'status_code' => '400',
						'msg' => 'Failed',
						'values' => "ID Not Valid"
					);
			}
			
	
		print json_encode($post_data);
		
	}
	
	elseif($Type == "Delete Product Types"){
		
		$ID = $_POST['ID'];
		$checkSQL1="SELECT count(product_types_id) as product_types_id FROM product_types where
			product_types_id='$ID'";
			$result1 = $conn->query($checkSQL1);
			
			if ($result1->num_rows > 0) {
				  while($row = $result1->fetch_assoc()) {
					$Ext = $row["product_types_id"];
				  }
			}
			
			if($Ext!=0){
				$sql ="DELETE FROM product_types WHERE product_types_id='$ID'";
				
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
			}else {
				$post_data = array(
					'status_code' => '400',
					'msg' => 'Failed',
					'values' => "Id Not Valid"
				);
			}
		print json_encode($post_data);
		
	}
	
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
	
	elseif($Type == "Edit  Admins"){
		
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
	
	elseif($Type == "Edit  Brands"){
		
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
	
	elseif($Type == "View Home Page Data"){
		
		$Brand_Data= array();
		$Categories_Data= array();
		$Products_Data= array();
		$SliderImage_Data= array();
		
			$checkSQL1="SELECT * FROM brands where brands_status = 'A'";
			$result1 = $conn->query($checkSQL1);
			
			if ($result1->num_rows > 0) {
				  while($row = $result1->fetch_assoc()) {
					$Brand_Data []=$row ;					 
				  }
			}
			
			$checkSQL3="SELECT A.products_id, A.product_types_id,
			B.product_types_name, A.category_id, E.categories_name,
			A.brands_id, C.brands_name, A.country_id, D.name as country_name, A.name,
			A.details, A.image_one,A.image_two,A.image_three, A.image_four,
			A.price, A.discount_price, A.discount,A.quantity,A.sort_order,
			A.products_status, A.create_info 
			FROM products A, product_types B, brands C, country D , categories E 
			where A.product_types_id = B.product_types_id
			and A.category_id = E.categories_id
			and A.brands_id = C.brands_id
			and A.country_id = D.id
			and  A.products_status = 'A' ORDER BY create_info DESC LIMIT 20";
			
			$result3 = $conn->query($checkSQL3);
			
			if ($result3->num_rows > 0) {
				  while($row = $result3->fetch_assoc()) {
					$Products_Data []=$row ;					 
				  }
			}
			
			$checkSQL2="SELECT * FROM categories where  categories_status = 'A' ";
			$result2 = $conn->query($checkSQL2);
			
			if ($result2->num_rows > 0) {
				  while($row = $result2->fetch_assoc()) {
					$Categories_Data []=$row ;					 
				  }
			}
			
			$checkSQL3="SELECT * FROM slider_image  ";
			$result3 = $conn->query($checkSQL3);
			
			if ($result3->num_rows > 0) {
				  while($row = $result3->fetch_assoc()) {
					$SliderImage_Data []=$row ;					 
				  }
			}
			
			$data=array(
					'Brand' => $Brand_Data,
					'Categories' => $Categories_Data,
					'SliderImage' => $SliderImage_Data,	
					'Products' => $Products_Data	
				);
	
		print json_encode($data);
		
	}
	
	elseif($Type == "View Product By Type"){
		
		$ViewType = $_POST['ViewType'];
		$ViewName = $_POST['ViewName'];
		$ViewId = $_POST['ViewId'];
		
		$Products_Data= array();
		
		
		if($ViewType == "Brand"){
			$productSQL="SELECT A.products_id, A.product_types_id,
			B.product_types_name, A.category_id, E.categories_name,
			A.brands_id, C.brands_name, A.country_id, D.name as country_name, A.name,
			A.details, A.image_one,A.image_two,A.image_three, A.image_four,
			A.price, A.discount_price, A.discount,A.quantity,A.sort_order,
			A.products_status, A.create_info 
			FROM products A, product_types B, brands C, country D , categories E 
			where A.product_types_id = B.product_types_id
			and A.category_id = E.categories_id
			and A.brands_id = '$ViewId'
			and A.brands_id = C.brands_id
			and A.country_id = D.id
			and  A.products_status = 'A' ORDER BY create_info DESC LIMIT 50";
			
			$result3 = $conn->query($productSQL);
			
			if ($result3->num_rows > 0) {
				  while($row = $result3->fetch_assoc()) {
					$Products_Data []=$row ;					 
				  }
			}
		}
		
		elseif($ViewType == "Categories"){
			$productSQL="SELECT A.products_id, A.product_types_id,
			B.product_types_name, A.category_id, E.categories_name,
			A.brands_id, C.brands_name, A.country_id, D.name as country_name, A.name,
			A.details, A.image_one,A.image_two,A.image_three, A.image_four,
			A.price, A.discount_price, A.discount,A.quantity,A.sort_order,
			A.products_status, A.create_info 
			FROM products A, product_types B, brands C, country D , categories E 
			where A.product_types_id = B.product_types_id
			and A.category_id = '$ViewId'
			and A.category_id = E.categories_id
			and A.brands_id = C.brands_id
			and A.country_id = D.id
			and  A.products_status = 'A'  ORDER BY create_info DESC LIMIT 50";
			
			$result3 = $conn->query($productSQL);
			
			if ($result3->num_rows > 0) {
				  while($row = $result3->fetch_assoc()) {
					$Products_Data []=$row ;					 
				  }
			}
		}
	
		print json_encode($Products_Data);
		
	}
	
	elseif($Type == "View Categories App Single"){
		
		$json_array= array();
			$checkSQL1="SELECT * FROM `categories`where categories_status = 'A' ORDER BY categories_id  DESC";
			$result1 = $conn->query($checkSQL1);
			
			if ($result1->num_rows > 0) {
				  while($row = $result1->fetch_assoc()) {
					$json_array []=$row ;					 
				  }
			}
	
		print json_encode($json_array);
		
	}
	
	elseif($Type == "View Brands App Single"){
		
		$json_array= array();
			$checkSQL1="SELECT * FROM `brands`where brands_status = 'A' ORDER BY brands_id  DESC";
			$result1 = $conn->query($checkSQL1);
			
			if ($result1->num_rows > 0) {
				  while($row = $result1->fetch_assoc()) {
					$json_array []=$row ;					 
				  }
			}
	
		print json_encode($json_array);
		
	}
	
	elseif($Type == "View Products App Single"){
		
		$json_array= array();
			$checkSQL1="SELECT A.products_id, A.product_types_id,
			B.product_types_name, A.category_id, E.categories_name,
			A.brands_id, C.brands_name, A.country_id, D.name as country_name, A.name,
			A.details, A.image_one,A.image_two,A.image_three, A.image_four,
			A.price, A.discount_price, A.discount,A.quantity,A.sort_order,
			A.products_status, A.create_info 
			FROM products A, product_types B, brands C, country D , categories E 
			where A.product_types_id = B.product_types_id
			and A.category_id = E.categories_id
			and A.brands_id = C.brands_id
			and A.country_id = D.id
			and  A.products_status = 'A' ORDER BY create_info DESC LIMIT 20";
			$result1 = $conn->query($checkSQL1);
			
			if ($result1->num_rows > 0) {
				  while($row = $result1->fetch_assoc()) {
					$json_array []=$row ;					 
				  }
			}
	
		print json_encode($json_array);
		
	}
	
	elseif($Type == "View User Card Info"){
		$admins_id = $_POST['admins_id'];
		
		$json_array= array();
			$checkSQL1="SELECT A.markets_id, A.products_id, A.admins_id, A.quantity, 
			A.markets_status, B.product_types_id, B.category_id, 
			B.brands_id, B.country_id, B.name, B.details,B.image_one, B.image_two, 
			B.image_three, B.image_four, B.price, B.discount_price, B.discount,
			B.quantity, B.sort_order, B.products_status 
			FROM markets A, products B, admins C 
			WHERE A.products_id = B.products_id 
			And A.admins_id = C.admins_id 
			And A.admins_id = '$admins_id'
			and A.markets_status = 'P'";
			
			$result1 = $conn->query($checkSQL1);
			
			if ($result1->num_rows > 0) {
				  while($row = $result1->fetch_assoc()) {
					$json_array []=$row ;					 
				  }
			}
	
		print json_encode($json_array);
		
	}
	
	elseif($Type == "Delete Card Single"){
		$products_id = $_POST['products_id'];
		$admins_id = $_POST['admins_id'];
		
			$checkSQL1="DELETE FROM `markets` WHERE admins_id='$admins_id' and products_id='$products_id'";

			
			if (mysqli_query($conn, $checkSQL1)) {
				$post_data = array(
					'status_code' => '200',
					'msg' => 'Success',
					'values' => 'Card Delete Successfully'
				);
				print json_encode($post_data); 
			} 
			
			else {
				$post_data = array(
					'status_code' => '400',
					'msg' => 'Failed',
					'values' => 'Card Delete Failed'
				);
				print json_encode($post_data); 
			}
			
			mysqli_close($conn);
			
	}
	
	elseif($Type == "Delete Card All"){
		$admins_id = $_POST['admins_id'];
		
			$checkSQL1="DELETE FROM `markets` WHERE admins_id='$admins_id'";
			
			if (mysqli_query($conn, $checkSQL1)) {
				$post_data = array(
					'status_code' => '200',
					'msg' => 'Success',
					'values' => 'Card Delete Successfully'
				);
				print json_encode($post_data); 
			} 
			
			else {
				$post_data = array(
					'status_code' => '400',
					'msg' => 'Failed',
					'values' => 'Card Delete Failed'
				);
				print json_encode($post_data); 
			}
			
			mysqli_close($conn);
			
	}
	
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
	 } 
}
?>