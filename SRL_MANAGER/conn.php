<?php
error_reporting(0);
$SRL_MANAGER = "(DESCRIPTION = 
					(ADDRESS = (PROTOCOL = TCP)(HOST = localhost)(PORT = 1521))
					(CONNECT_DATA =(SERVER = DEDICATED)(SERVICE_NAME = DA)))";

				$conn = ocilogon( "DHALIABIR", "DHALIABIR",$SRL_MANAGER,"WE8ISO8859P15");


?>