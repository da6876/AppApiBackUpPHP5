<?php
error_reporting(0);
$ORACLECON = "(DESCRIPTION = 
					(ADDRESS = (PROTOCOL = TCP)(HOST = localhost)(PORT = 1521))
					(CONNECT_DATA =(SERVER = DEDICATED)(SERVICE_NAME = DA)))";

				$conn = ocilogon( "SOCAPP", "SOCAPP",$ORACLECON,"WE8ISO8859P15");


?>