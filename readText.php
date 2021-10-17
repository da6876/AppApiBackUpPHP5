<?php
$file = 'aaaa.txt';
$file1 = 'C:\xampp\apache\logs\access.log';
//echo $date=date("d/M/Y",strtotime("-1 days"));
$dateFile=date("d_M_Y",strtotime("-1 days"));
$date=date("Y");
//$searchfor = '27 Sep 2020';
header('Content-Type: text/plain');


$contents = file_get_contents($file1);

$pattern = preg_quote($date, '/');

$pattern = "/^.*$pattern.*\$/m";

if(preg_match_all($pattern, $contents, $matches)){
	$foundfile=implode("\n", $matches[0]);
    echo $foundfile;
	$myfile = fopen("F:\\LogCopy\\".$dateFile.".txt", "w") or die("Unable to open file!");
	$txt = $foundfile;
	fwrite($myfile, $txt);
	fclose($myfile); 
	
	$myfile1 = fopen("C:\\xampp\\apache\\logs\\access.log", "w") or die("Unable to open file!");
	$txt1 = "";
	fwrite($myfile1, $txt1);
	fclose($myfile1); 

	
$replacements=" ";
echo str_replace( $foundfile, $replacements, $foundfile );
}
else{
   echo "No matches found";
} 

//$path_to_file = 'wwww.txt';
//$file_contents = file_get_contents($path_to_file);
//$file_contents = str_replace("test",",H",$file_contents);
//file_put_contents($path_to_file,$file_contents);
//print $myString = "'My amiable lady!' he interrupted, with an almost diabolical sneer on his face. 'Where is she--my amiable lady?'\n";
//$searchTerms = array ( 'lady', 'amiable' );
//$replacements = array ( 'wife', 'lovely' );
//$replacements="Empty";
//echo str_replace( $myString, $replacements, $myString );
?>