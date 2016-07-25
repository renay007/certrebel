<?php
	ob_start();
	session_start();
	require_once('/var/www/certrebel/functions.php');
	date_default_timezone_set('America/New_york');

	try {
		$dbConnection = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser , $dbpass);
		$checkUserQuery ="SELECT 
													*
											FROM
													CertRebel.orange_county_zip_codes";
		$checkUserStmt = $dbConnection->prepare($checkUserQuery);
		$checkUserStmt->execute();
		while ($queryResult = $checkUserStmt->fetch(PDO::FETCH_ASSOC)) {
					$result[] = array("zip_code" 	=> $queryResult['zip_code'],
														"city" 			=> $queryResult['city']
													 );
		}
	} catch (PDOException $e) {
		die("Error: Cannot satisfy your request at this time. Please try again later");
	}
ob_flush();
echo json_encode($result);
?>
