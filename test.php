<?PHP

 

 

include "Connection.php";

error_reporting(0);

//require_once "nusoap.php";

set_time_limit(120);      

ini_set('memory_limit', '-1');

$key = 'IHCWoJlZsimjr4Osll9xcg==';

$key = base64_decode($key);

$iv = chr(0x31).chr(0x32).chr(0x33).chr(0x34).chr(0x35).chr(0x36).chr(0x30).chr(0x30).chr(0x30).chr(0x30).chr(0x30).chr(0x30).chr(0x30).chr(0x30).chr(0x30).chr(0x30);//'31323334353630303030303030303030';

						   

$LoginID = "cps";

$Password = "bkash@cps";

$passlength = "14";

$Obfuscation = "eA3C";

$Timestampown = "";

$ConversationID = "";

$ResultCode = "";

$ResultDesc = "";

$Amount = "";

$AmountDetail = "";





										   









//----------------------------- START DATA LOAD------------------------------------------------------------------------





$PC_CODE = "99";

$bundleData = array();

$curs = oci_new_cursor($conn);

$time_start = microtime(true);

$query = oci_parse($conn, "begin DPG_MBP_BKASH_USSD_NESCO.DPD_MBP_BKASH_TEMP_DATA(:cur_data,:p_pc_Code); end;");



oci_bind_by_name($query, ":cur_data", $curs, -1, OCI_B_CURSOR);

oci_bind_by_name($query, ":p_pc_Code", $PC_CODE, -1, SQLT_CHR);

oci_execute($query);

oci_execute($curs);

$time_end = microtime(true);

$time = $time_end - $time_start;

echo "unit Time: {$time}";



while (($row = oci_fetch_array($curs, OCI_ASSOC+OCI_RETURN_NULLS)) != false)

{                                                             

			$bundleData[]=$row;                   

}



oci_free_statement($query);

oci_free_statement($curs);

oci_close($conn);



//----------------------------- END DATA LOAD------------------------------------------------------------------------

//echo json_encode($bundleData);



if(count($bundleData)>0){

			$countERR = 0;

			foreach($bundleData as $singleData) {



							if(isset($singleData['PC_TIMESTAMP']))

							{

											$Timestamp = trim($singleData['PC_TIMESTAMP']);                       

							}

							else

							{

											$Timestamp = "";

							}                             

							if(isset($singleData['BANK_TRAN_ID']))

							{

											$trans_id = trim($singleData['BANK_TRAN_ID']);

							}

							else

							{

											$trans_id = "";

							}                             

							if(isset($singleData['ORG_CODE']))

							{

											$org_code = trim($singleData['ORG_CODE']);

							}

							else

							{

											$org_code = "";

							}                                                                                                                                                                                                             

							if(isset($singleData['ACC_NUM']))

							{

											$acc_no = trim($singleData['ACC_NUM']);

							}

							else

							{

											$acc_no = "";

							}

						   

							if(isset($singleData['TOT_AMT']))

							{

											$amount = trim($singleData['TOT_AMT']);

							}

							else

							{

											$amount = "0";

							}

							if(isset($singleData['BILL_MON']))

							{

											$billcycle = trim($singleData['BILL_MON']);

							}

							else

							{

											$billcycle = "";

							}

							if(isset($singleData['USER_MOBILE']))

							{

											$UserMobileNo = trim($singleData['USER_MOBILE']);

							}

							else

							{

											$UserMobileNo = "";

							}

						   

							if(isset($singleData['PAY_TYPE']))

							{

											$PayType = trim($singleData['PAY_TYPE']);

							}

							else

							{

											$PayType = "CHK_BILL";

							}                             

							if(isset($singleData['GT_CODE']))

							{

											$GT_CODE = trim($singleData['GT_CODE']);

							}

							else

							{

											$GT_CODE = "BKASH_MFS";

							}

							if(isset($singleData['PC_CODE']))

							{

											$PC_CODE = trim($singleData['PC_CODE']);

							}

							else

							{

											$PC_CODE = "99";

							}

							if(isset($singleData['BILL_NUM']))

							{

											$BILL_NUM = trim($singleData['BILL_NUM']);

							}

							else

							{

											$BILL_NUM = "";

							}

						   

							if(isset($singleData['METER_NO']))
							{
								$METER_NO = trim($singleData['METER_NO']);
							}else
							{
								$METER_NO = "";
							}

																							   

				if($PayType == "CHK_BILL"){

								$url = 'http://localhost/bkash_api/live/core_api.php';

								$data = array('PC_TIMESTAMP' => $Timestamp, 'BANK_TRAN_ID' => $trans_id, 'ORG_CODE' => $org_code, 'ACC_NUM' => $acc_no,

								'TOT_AMT' => $amount, 'BILL_MON' => $billcycle, 'USER_MOBILE' => $UserMobileNo, 'PAY_TYPE' => $PayType,

								'GT_CODE' => $GT_CODE, 'PC_CODE' => $PC_CODE, 'BILL_NUM' => $BILL_NUM, 'METER_NO' => $METER_NO,'METER_NO' => $METER_NO);

				$countERR = post_without_wait($url, $data,$countERR );

				}else if($PayType == "PST_PAY"){

					$url = 'http://localhost/bkash_api/live/Core_Api_Trans.php';

					$data = array('PC_TIMESTAMP' => $Timestamp, 'BANK_TRAN_ID' => $trans_id, 'ORG_CODE' => $org_code, 'ACC_NUM' => $acc_no,

					'TOT_AMT' => $amount, 'BILL_MON' => $billcycle, 'USER_MOBILE' => $UserMobileNo, 'PAY_TYPE' => $PayType,

					'GT_CODE' => $GT_CODE, 'PC_CODE' => $PC_CODE, 'BILL_NUM' => $BILL_NUM, 'METER_NO' => $METER_NO,'METER_NO' => $METER_NO);


			   $Data_post_string="PC_TIMESTAMP =".urlencode($Timestamp).", BANK_TRAN_ID =".urlencode($trans_id).", ORG_CODE =".urlencode($org_code).", ACC_NUM =".urlencode($acc_no).",
			   TOT_AMT =".urlencode($amount).", BILL_MON =".urlencode($billcycle).", USER_MOBILE =".urlencode(UserMobileNo).", PAY_TYPE =".urlencode($PayType).", GT_CODE =".urlencode($GT_CODE).",
			   PC_CODE =".urlencode($PC_CODE).", BILL_NUM =".urlencode($BILL_NUM).", METER_NO =".urlencode($METER_NO);


				$countERR = post_without_wait($url, $Data_post_string,$countERR );

				}else{

								date_default_timezone_set('Asia/Dhaka');

								$date = date("Y-m-d H:i:s");

								$myfile = fopen("../logs/NESCO_PAY_TYPE_LOGS.txt", "a") or die("Unable to open file!");

								fwrite($myfile, " Pay Type Error:".json_encode($singleData)." date:".$date."\n");

								fclose($myfile);

			   



				}

			}


			if($countERR == 0){

				$time = microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"];

				echo " Process Time: {$time} ";

				print "DATA SENT SUCCESSFULLY \n";

			}else{
				$time = microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"];

				echo " Process Time: {$time} ";

				print " ".$countERR." ERROR WHILE SENDING DATA \n";
			}	   

}else{
	print " NO DATA \n";
}


function post_without_wait($url, $params,$countERR )

{

//            $post_string = $params;
//            global $countval;
			foreach ($params as $key => &$val) {

			  if (is_array($val)) $val = implode(',', $val);

				$post_params[] = $key.'='.urlencode($val);

			}

			$post_string = implode('&', $post_params);



			$parts=parse_url($url);



			$fp = fsockopen($parts['host'],

							isset($parts['port'])?$parts['port']:80,

							$errno, $errstr, 3);

						   

			if(!$fp){

						   

							$countERR++;   

							date_default_timezone_set('Asia/Dhaka');

							$date = date("Y-m-d H:i:s");

							$myfile = fopen("../logs/NESCO_SUBMISSION_LOGS.txt", "a") or die("Unable to open file!");

							fwrite($myfile, " Submission Error:".$post_string." ".$errstr." - ".$errno." date:".$date."\n");

							fclose($myfile);

						   

						   

			}else{

						   

							$out = "POST ".$parts['path']." HTTP/1.1\r\n";

							$out.= "Host: ".$parts['host']."\r\n";

							$out.= "Content-Type: application/x-www-form-urlencoded\r\n";

							$out.= "Content-Length: ".strlen($post_string)."\r\n";

							$out.= "Connection: Close\r\n\r\n";

							if (isset($post_string)) $out.= $post_string;



							fwrite($fp, $out);

							fclose($fp);

						   

			}

			return $countERR ;



}



                                               

?>