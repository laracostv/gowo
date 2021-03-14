<?php

// connecting to db
require_once('../db.class.php');

// array for JSON response
$response = array();

// check for required fields
if (isset($_POST['login']) && isset($_POST['password'])) {
	
    $login = trim($_POST['login']);
	$password = trim(md5($_POST['password']));

	$sql = "SELECT * FROM users WHERE usrEmail = '$login' AND usrPwd = '$password'";

	$objDb = new db();
	$link = $objDb->mysql_connect();

	$query = mysqli_query($link, $sql);

	if(mysql_num_rows($query) > 0){
		$row = mysql_fetch_array($query);
		if($password == $row['password']){
			$response["success"] = 1;
		}
		else {
			// senha ou usuario nao confere
			$response["success"] = 0;
			$response["error"] = "usuario ou senha não confere";
		}
	}
	else {
		// senha ou usuario nao confere
		$response["success"] = 0;
		$response["error"] = "usuario ou senha não confere";
	}
}
else {
	$response["success"] = 0;
	$response["error"] = "faltam parametros";
}
mysql_close($link);
echo json_encode($response);
?>