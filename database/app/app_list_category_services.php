<?php
 
/*
 * O seguinte codigo retorna para o cliente a lista de produtos 
 * armazenados no servidor. Essa e uma requisicao do tipo GET. 
 * Nao sao necessarios nenhum tipo de parametro.
 * A resposta e no formato JSON.
 */
$link = '';
$userWasListed = array();
// array que guarda a resposta da requisicao
$response = array();
 
require_once('../db.class.php');
$objDb = new db();
$link = $objDb->mysql_connect();
$categorySet = $_GET['category'];
// Realiza uma consulta ao BD e obtem todos os produtos.
$result = mysqli_query($link, "SELECT * FROM services WHERE sClass = '$categorySet'");
 

if (mysqli_num_rows($result) > 0) {
    // Caso existam produtos no BD, eles sao armazenados na 
	// chave "services". O valor dessa chave e formado por um 
	// array onde cada elemento e um produto.
    $response["services"] = array();
 
    while ($row = mysqli_fetch_array($result)) {
        // Para cada produto, sao retornados somente o 
		// pid (id do produto) e o nome do produto. Nao ha necessidade 
		// de retornar nesse momento todos os campos de todos os produtos 
		// pois a app cliente, inicialmente, so precisa do nome do mesmo para 
		// exibir na lista de produtos. O campo pid e usado pela app cliente 
		// para buscar os detalhes de um produto especifico quando o usuario 
		// o seleciona. Esse tipo de estrategia poupa banda de rede, uma vez 
		// os detalhes de um produto somente serao transferidos ao cliente 
		// em caso de real interesse.
        $services = array();

        //pega o nome do usuário que presta o serviço
        $servicesIdUserDo = $row["idUserDo"];
        if(in_array($servicesIdUserDo, $userWasListed) == false){
            $userWasListed[] = $row["idUserDo"];
            $services["idUsr"] = $row["idUserDo"];
            
            $result_user = mysqli_query($link, "SELECT usrName, usrProfilePhoto FROM users WHERE idUser = $servicesIdUserDo");
            $userDoArray = mysqli_fetch_array($result_user);
            $services["userDoName"] = $userDoArray['usrName'];
            $services["userDoProfilePhoto"] = $userDoArray['usrProfilePhoto'];
            
            //echo$services["userDoName"];
            //echo json_encode(mysqli_fetch_array($result_user));

            //pega o edereço base do serviço
            $servicesAddressId = $row["sAdressId"];
            $result_address = mysqli_query($link, "SELECT adNbh, adCity FROM address WHERE idAdress = $servicesAddressId");
            $addressArray = mysqli_fetch_array($result_address);
            $services["sNbh"] = $addressArray['adNbh'];
            $services["sCity"] = $addressArray['adCity'];

            //$services["sName"] = $row["sName"];
    
            // Adiciona o servico no array de produtos.
            array_push($response["services"], $services);
        }
    }
    // Caso haja produtos no BD, o cliente 
	// recebe a chave "success" com valor 1.
    $response["success"] = 1;
	
	mysqli_close($link);
 
    // Converte a resposta para o formato JSON.
    echo json_encode($response);
	
} else {
    // Caso nao haja produtos no BD, o cliente 
	// recebe a chave "success" com valor 0. A chave "message" indica o 
	// motivo da falha.
    $response["success"] = 0;
    $response["message"] = "Nao ha serviços";
	
	// Fecha a conexao com o BD
	mysqli_close($link);
 
    // Converte a resposta para o formato JSON.
    echo json_encode($response);
}
?>