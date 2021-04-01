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
	$newPwd = md5($newPwd);
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
        $imageFileType = strtolower(pathinfo(basename($_FILES["img"]["name"]),PATHINFO_EXTENSION));
        
        // A imagem e convertida de binario para string atraves do metodo de codificacao
        // base64
        $image_base64 = base64_encode(file_get_contents($_FILES['img']['tmp_name']) );
        
        // No futuro, clientes que pedirem pela imagem armazenada no BD devem ser 
        // capazes de converter a string base64 para o formato original binario.
        // Para que isso possa ser feito, contatena-se no inicio da string base64 da 
        // imagem o mimetype do arquivo original. O mimetype e um codigo que indica o 
        // tipo de arquivo e sua extensao.
        $img = 'data:image/'.$imageFileType.';base64,'.$image_base64;



		//Pasta onde o arquivo vai ser salvo
		//UPLOAD IMAGE
		$_UP['pasta'] = '../../assets/images/users/profile_photos/';
    
		//Tamanho máximo do arquivo em Bytes
		$_UP['tamanho'] = 1024*1024*100; //5mb
		
		//Array com a extensões permitidas
		$_UP['extensoes'] = array('png', 'jpg', 'jpeg');
		
		//Renomeiar
		$_UP['renomeia'] = true;

		//Array com os tipos de erros de upload do PHP
		$_UP['erros'][0] = 'Não houve erro';
		$_UP['erros'][1] = 'O arquivo no upload é maior que o limite do PHP';
		$_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especificado no HTML';
		$_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
		$_UP['erros'][4] = 'Não foi feito o upload do arquivo';
		
		//Verifica se houve algum erro com o upload. Sem sim, exibe a mensagem do erro
		if($_FILES['arquivo']['error'] != 0){
			die("Não foi possivel fazer o upload, erro: <br />". $_UP['erros'][$_FILES['arquivo']['error']]);
			exit; //Para a execução do script
		}
		
		//Faz a verificação da extensao do arquivo
		$tmp_format = explode('.', $_FILES['arquivo']['name']);
		$extensao = strtolower(end($tmp_format));
		if(array_search($extensao, $_UP['extensoes']) === false){		
			echo "alert('A imagem não foi cadastrada extensão inválida.');";
		}
		
		//Faz a verificação do tamanho do arquivo
		else if ($_UP['tamanho'] < $_FILES['arquivo']['size']){
			echo "
					alert('Arquivo muito grande.');
			";
		}
		
		//O arquivo passou em todas as verificações, hora de tentar move-lo para a pasta foto
		else{
			//Primeiro verifica se deve trocar o nome do arquivo
			if($_UP['renomeia'] == true){
				//Cria um nome baseado no UNIX TIMESTAMP atual e com extensão .jpg
				$nome_final = md5(time()).'.jpg';
				
			}else{
				//mantem o nome original do arquivo
				$nome_final = $_FILES['arquivo']['name'];
			}
			//Verificar se é possivel mover o arquivo para a pasta escolhida
			if(move_uploaded_file($_FILES['arquivo']['tmp_name'], $_UP['pasta'].$nome_final)){
				//Upload efetuado com sucesso, exibe a mensagem
				$blank_var = true;
			}else{
				//Upload não efetuado com sucesso, exibe a mensagem
				echo "
						alert('Imagem não foi cadastrada com Sucesso.');
				";
				die();
			}
		}
        
		// mysql inserting a new row
		$result = mysqli_query($link, "INSERT INTO users (usrName, usrLastName, usrEmail, usrPwd, usrCellPhone, usrDateN, usrProfilePhoto, usrProfilePhotoSrc)
		VALUES('$newName', '$newLastName', '$newEmail', '$newPwd', '$newCell', '$newDateBorn', '$img', '$nome_final')");
	 
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