<?php
//error_reporting(0);
$mBillCorporate = "(DESCRIPTION = 
					(ADDRESS = (PROTOCOL = TCP)(HOST = localhost)(PORT = 1521))
					(CONNECT_DATA =(SERVER = DEDICATED)(SERVICE_NAME = DA)))";

				$conn = ocilogon( "SOCAPP", "SOCAPP",$mBillCorporate,"WE8ISO8859P15");


?>