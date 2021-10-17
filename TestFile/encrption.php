<?php
error_reporting(0);
	echo "Test Data Encreption";
	echo "A = 010001";
	echo "B = 000011";
	echo "C = 000111";
	echo "D = 001111";
	echo "E = 011111";
	echo "F = 111111";
	echo "G = 100000";
	echo "H = 101010";
	echo "I = 110101";
	echo "J = 100011";
	echo "K = 010011";
	echo "L = 110001";
	echo "M = 001011";
	echo "N = 000101";
	echo "O = 001101";
	echo "P = 101001";
	echo "Q = 101101";
	echo "R = 011001";
	echo "S = 101011";
	echo "T = 010101";
	echo "U = 001010";
	echo "V = 001001";
	echo "W = 111001";
	echo "X = 110011";
	echo "Y = 011011";
	echo "Z = 001000";
	echo"' '= 000000";
	
	$A = "010001";
	$B = "000011";
	$C = "000111";
	$D = "001111";
	$E = "011111";
	$F = "111111";
	$G = "100000";
	$H = "101010";
	$I = "110101";
	$J = "100011";
	$K = "010011";
	$L = "110001";
	$M = "001011";
	$N = "000101";
	$O = "001101";
	$P = "101001";
	$Q = "101101";
	$R = "011001";
	$S = "101011";
	$T = "010101";
	$U = "001010";
	$V = "001001";
	$W = "111001";
	$X = "110011";
	$Y = "011011";
	$Z = "001000";
	$SP = "000000";
	echo "<br>";
	echo "<br>================================";
	echo "<br>";
	//echo $A.$B;
	echo "<br>========================<br>";
	$values='ABIR DHALI';
	$x;
	$value;
	$strLenth;
	$str;
	$number;
	$str1 = $values;
	$str = array($values);
	$result = array();
	echo $strLenth=strlen($str1);
	echo "<br>========================<br>";
	
	for ($x = 0; $x <= $strLenth; $x++) {
	  foreach($str as $value){
			$stringData=$value[$x];
			echo "<br>";
			if($stringData=="A"){
				$result=array($A);
				$result1=$A;
				echo "<br>";
				print $stringData."=>".$A;
				echo "<br>";
			}elseif($stringData=="B"){
				$result=array($B);
				echo "<br>";
				$result2=$B;
				
				print $result2=$result1.$result2;
				echo "<br>";
				print $stringData."=>".$B;
				echo "<br>";
			}elseif($stringData=="I"){
				$result=array($I);
				echo "<br>";
				print $stringData."=>".$I;
				echo "<br>";
			}elseif($stringData=="R"){
				$result=array($R);
				echo "<br>";
				print $stringData."=>".$R;
				echo "<br>";
			}elseif($stringData==" "){
				$result=array($SP);
				echo "<br>";
				print $stringData."=>".$SP;
				echo "<br>";
			}
		}
	}
	print_r ($result);
?>