<?php
//error_reporting(0);
$ORA = "(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)(HOST = localhost)(PORT = 1521))
						(CONNECT_DATA =(SERVER = DEDICATED)(SERVICE_NAME = DA)))";

				$conn = ocilogon( "SOCAPP", "SOCAPP",$ORA,"WE8ISO8859P15");
				if(!$conn){
					//echo"Not Ok";
				}else{
					//echo "ok";
				}


?>