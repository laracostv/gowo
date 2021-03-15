<?php
$link = '';
// connecting to db
require_once('../db.class.php');
$objDb = new db();
$link = $objDb->mysql_connect();
// array for JSON response
$response = array();

// check for required fields
if (isset($_POST['login']) && isset($_POST['password'])) {

    
	$login = trim($_POST['login']);
	$password = trim(md5($_POST['password']));
	
	$sql = "SELECT usrPwd FROM usuários WHERE usrEmail = '$ login'";

	$query = mysqli_query($link, $sql);

	if(mysqli_num_rows($query) > 0){
		$row = mysqli_fetch_array($query);
		if($password == $row['usrPwd']){
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

//$query->close();
mysqli_close($link);

echo json_encode($response);
?>
