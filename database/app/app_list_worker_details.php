<?php
$link = '';
// array que guarda a resposta da requisicao
$servicesList = array();
$workerSet = $_GET['worker'];//pega o id do prestador de serviço
$workerCat = $_GET['category'];//pega a categoria do prestador de serviço

require_once('../db.class.php');
$objDb = new db();
$link = $objDb->mysql_connect();

$result = mysqli_query($link, "SELECT * FROM services WHERE idUserDo = '$workerSet' and sClass = '$workerCat'");

$servicesList["servicesWorker"] = array();

while ($row = mysqli_fetch_array($result)) {
    $servicesDetails = array();

    $servicesDetails["serviceId"] = $row["idService"];
    $servicesDetails["serviceName"] = $row["sName"];
    //$serviceDesc = $row["sDesc"];
    $servicesDetails["serviceVal"] = $row["sVal"];
    array_push($servicesList["servicesWorker"], $servicesDetails);
}

$servicesList["success"] = 1;
echo json_encode($servicesList);

mysqli_close($link);
?>