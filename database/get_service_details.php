<?php
 
/*
 * O codigo seguinte retorna os dados detalhados de um servico.
 * Essa e uma requisicao do tipo GET. Um servico e identificado 
 * pelo campo idService.
 */
$link = '';
// array que guarda a resposta da requisicao
$response = array();
$posi = 0;
$finded = false;

//$teste_category = 1;

// Verifica se o parametro pid foi enviado na requisicao
if (isset($_GET["service"])) {
    //if (isset($teste_category)) {	
	// Aqui sao obtidos os parametros
    $idService = $_GET['service'];
	//$category = $teste_category;
	// Abre uma conexao com o BD.
    require_once('db.class.php');
    $objDb = new db();
    $link = $objDb->mysql_connect();
 
    // Obtem do BD os detalhes do produto com pid especificado na requisicao GET
    $sql = "SELECT idService, idUserDo, sName, sDesc, sVal, sAdressId, sClass, sPhotoSrc FROM services WHERE idService = '$idService'";

    $result_address = mysqli_query($link, "SELECT idAdress, adNbh, adCity, adState FROM address");
    $addressArray = $result_address->fetch_all();

	$query = mysqli_query($link, $sql);

    if (!empty($query)) {
        if (mysqli_num_rows($query) > 0) {
 
			// Se o produto existe, os dados de detalhe do produto 
			// sao adicionados no array de resposta.
            $query = mysqli_fetch_array($query);
 
            $service = array();
            $service["idService"] = $query["idService"];
            $service["idUserDo"] = $query["idUserDo"];
            $service["sName"] = $query["sName"];
			$service["sDesc"] = $query["sDesc"];
            $service["sVal"] = $query["sVal"];
            $service["sAdressId"] = $query["sAdressId"];
            $service["sClass"] = $query["sClass"];
            $service["sPhoto"] = $query["sPhotoSrc"];
            
            $servicesAddressId = $service["sAdressId"];

            //produra o endereço do servico
            while($finded == false){
                if($addressArray[$posi][0] == $servicesAddressId){
                    //print_r($addressArray[$posi]);
                    $service['sNbh'] = $addressArray[$posi][1];
                    $service['sCity'] = $addressArray[$posi][2];
                    $service['sState'] = $addressArray[$posi][3];
                    $finded = true;
                }                    
                //echo $adLineInfo;
                $posi++;
            }

            $idUserDoService = $service["idUserDo"];

            $sql = "SELECT usrName, usrEmail, usrCellPhone, usrProfilePhotoSrc FROM users WHERE idUser = '$idUserDoService'";
            $userInfo = mysqli_query($link, $sql);

            $userInfo = mysqli_fetch_array($userInfo);

            $service["usrName"] = $userInfo["usrName"];
            $service["usrEmail"] = $userInfo["usrEmail"];
            $service["usrCellPhone"] = $userInfo["usrCellPhone"];
            $service["usrProfilePhotoSrc"] = $userInfo["usrProfilePhotoSrc"];

            // Caso o servico exista no BD, o cliente 
			// recebe a chave "success" com valor 1.
            $response["success"] = 1;
 
            $response["service"] = array();

            array_push($response["service"], $service);
			
			// Fecha a conexao com o BD
			mysqli_close($link);
 
            // Converte a resposta para o formato JSON.
            $response;
        } else {
            // Caso o produto nao exista no BD, o cliente 
			// recebe a chave "success" com valor 0. A chave "message" indica o 
			// motivo da falha.
            $response["success"] = 0;
            $response["message"] = "Serviço não encontrado";
			
			// Fecha a conexao com o BD
			mysqli_close($link);
 
            // Converte a resposta para o formato JSON.
            $response;
        }
    } else {
        // Caso o produto nao exista no BD, o cliente 
		// recebe a chave "success" com valor 0. A chave "message" indica o 
		// motivo da falha.
        $response["success"] = 0;
        $response["message"] = "Serviço não encontrado";
 
		// Fecha a conexao com o BD
		mysqli_close($link);
 
        // Converte a resposta para o formato JSON.
        $response;
    }
} else {
    // Se a requisicao foi feita incorretamente, ou seja, os parametros 
	// nao foram enviados corretamente para o servidor, o cliente 
	// recebe a chave "success" com valor 0. A chave "message" indica o 
	// motivo da falha.
    $response["success"] = 0;
    $response["message"] = "Campo requerido não preenchido";
 
    // Converte a resposta para o formato JSON.
    $response;
}
?>