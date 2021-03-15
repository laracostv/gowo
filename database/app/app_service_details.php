<?php
 
/*
 * O codigo seguinte retorna os dados detalhados de um servico.
 * Essa e uma requisicao do tipo GET. Um produto e identificado 
 * pelo campo pid.
 */
$link = '';
// array que guarda a resposta da requisicao
$response = array();

//$teste_category = 'Automotivo';

// Verifica se o parametro pid foi enviado na requisicao
if (isset($_GET["category"])) {
    //if (isset($teste_category)) {	
	// Aqui sao obtidos os parametros
    $category = $_GET['category'];
	//$category = $teste_category;
	// Abre uma conexao com o BD.
    require_once('../db.class.php');
    $objDb = new db();
    $link = $objDb->mysql_connect();
 
    // Obtem do BD os detalhes do produto com pid especificado na requisicao GET
    $sql = "SELECT * FROM services WHERE sClass = '$category'";

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
            $service["sPhoto"] = $query["sPhoto"];
            $service["sClass"] = $query["sClass"];
            
            
            // Caso o produto exista no BD, o cliente 
			// recebe a chave "success" com valor 1.
            $response["success"] = 1;
 
            $response["service"] = array();
 
			// Converte a resposta para o formato JSON.
            array_push($response["service"], $service);
			
			// Fecha a conexao com o BD
			mysqli_close($link);
 
            // Converte a resposta para o formato JSON.
            echo json_encode($response);
        } else {
            // Caso o produto nao exista no BD, o cliente 
			// recebe a chave "success" com valor 0. A chave "message" indica o 
			// motivo da falha.
            $response["success"] = 0;
            $response["message"] = "Serviço não encontrado";
			
			// Fecha a conexao com o BD
			mysqli_close($link);
 
            // Converte a resposta para o formato JSON.
            echo json_encode($response);
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
        echo json_encode($response);
    }
} else {
    // Se a requisicao foi feita incorretamente, ou seja, os parametros 
	// nao foram enviados corretamente para o servidor, o cliente 
	// recebe a chave "success" com valor 0. A chave "message" indica o 
	// motivo da falha.
    $response["success"] = 0;
    $response["message"] = "Campo requerido não preenchido";
 
    // Converte a resposta para o formato JSON.
    echo json_encode($response);
}
?>