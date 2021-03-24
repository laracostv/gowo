<?php
 require_once('../db.class.php');
 include_once('../db.class.php');
/*
 * Following code will create a new user row
 * All product details are read from HTTP Post Request
 */
 
// connecting to db
$objDb = new db();
$link = $objDb->mysql_connect();
 
// array for JSON response
$response = array();
$newLastName = '';

// check for required fields
if (isset($_POST['nameNewUser']) && isset($_POST['newEmail']) && isset($_POST['pwd']) && isset($_POST['dateBorn']) && isset($_POST['cell']) && isset($_FILES['img'])) {
 
	$newName = trim($_POST['nameNewUser']);
	if(isset($_POST['lastNameNewUser'])){
		$newLastName = trim($_POST['lastNameNewUser']);
	}
	$newEmail= trim($_POST['newEmail']);
	$newPwd = trim($_POST['pwd']);
	$newDateBorn = trim($_POST['dateBorn']);
	$newCell = trim($_POST['cell']);
		
	$usuario_existe = mysqli_query($link, "SELECT usrEmail FROM users WHERE usrEmail='$newEmail'");

	// check for empty result
	if (mysqli_num_rows($usuario_existe) > 0) {
		$response["success"] = 0;
		$response["error"] = "Usuário já cadastrado";
	}
	else {
        // Para a imagem do produto, primeiramente se determina qual o tipo de imagem.
        // Isso e feito atraves da obtencao da extensao do arquivo, localizada na parte
        // final do nome do arquivo (ex. ".jpg")
        $imageFileType = strtolower(pathinfo(basename($_FILES["img"]["newName"]),PATHINFO_EXTENSION));
        
        // A imagem e convertida de binario para string atraves do metodo de codificacao
        // base64
        $image_base64 = base64_encode(file_get_contents($_FILES['img']['tmp_name']) );
        
        // No futuro, clientes que pedirem pela imagem armazenada no BD devem ser 
        // capazes de converter a string base64 para o formato original binario.
        // Para que isso possa ser feito, contatena-se no inicio da string base64 da 
        // imagem o mimetype do arquivo original. O mimetype e um codigo que indica o 
        // tipo de arquivo e sua extensao.
        $img = 'data:image/'.$imageFileType.';base64,'.$image_base64;
        
		// mysql inserting a new row
		$result = mysqli_query($link, "INSERT INTO users (usrName, usrLastName, usrEmail, usrPwd, usrCellPhone, usrDateN, usrProfilePhoto)
		VALUES('$newName', '$newLastName', '$newEmail', '$newPwd', '$newCell', '$newDateBorn', '$img')");
	 
		if ($result) {
			$response["success"] = 1;
		}
		else {
			$response["success"] = 0;
			$response["error"] = "Error BD: ".mysqli_error($link);
		}
	}
}
else {
    $response["success"] = 0;
	$response["error"] = "Faltam parâmetros";
}

mysqli_close($link);
echo json_encode($response);
?>