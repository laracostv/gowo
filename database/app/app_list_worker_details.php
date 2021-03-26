<?php
$link = '';
// array que guarda a resposta da requisicao
$servicesList = array();
$workerSet = 18;//$_GET['worker'];//pega o id do prestador de serviço
$workerCat = 'Automotivo';//$_GET['category'];//pega a categoria do prestador de serviço
$posi = 0;
$finded = false;

require_once('../db.class.php');
$objDb = new db();
$link = $objDb->mysql_connect();

$result = mysqli_query($link, "SELECT * FROM services WHERE idUserDo = '$workerSet' and sClass = '$workerCat'");

$servicesList["servicesWorker"] = array();

//consulta toda tabela de enderecos
$response["services"] = array();
$result_address = mysqli_query($link, "SELECT idAdress, adNbh, adCity, adState FROM address");
$addressArray = $result_address->fetch_all();

while ($row = mysqli_fetch_array($result)) {
    $servicesDetails = array();
    $servicesDetails["idUserDo"] = $workerSet;
    $servicesDetails["serviceId"] = $row["idService"];
    $servicesDetails["serviceName"] = $row["sName"];
    $servicesDetails["servicePhoto"] = $row["sPhoto"];
    //$serviceDesc = $row["sDesc"];
    $servicesDetails["serviceVal"] = $row["sVal"];

    $servicesAddressId = $row["sAdressId"];

    while($finded == false){
        if($addressArray[$posi][0] == $servicesAddressId){
            //print_r($addressArray[$posi]);
            $servicesDetails['sNbh'] = $addressArray[$posi][1];
            $servicesDetails['sCity'] = $addressArray[$posi][2];
            $servicesDetails['sState'] = $addressArray[$posi][3];
            $finded = true;
        }                    
        //echo $adLineInfo;
        $posi++;
    }
    $posi = 0;
    $finded = false;
    array_push($servicesList["servicesWorker"], $servicesDetails);
}

$servicesList["success"] = 1;
echo json_encode($servicesList);

mysqli_close($link);
?>