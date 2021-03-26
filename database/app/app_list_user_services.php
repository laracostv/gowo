<?php
    $link = '';
    // array que guarda a resposta da requisicao
    $response = array();
    $posi = 0;
    $finded = false;

    require_once('../db.class.php');
    $objDb = new db();
    $link = $objDb->mysql_connect();

    if(isset($_GET['id_user'])){
        $idUserSet = $_GET['id_user'];
    
    /*TESTES
    $idUserSet = 18;
    
    if(isset($idUserSet)){*/

        //consulta toda tabela de enderecos
        $response["services"] = array();
        $result_address = mysqli_query($link, "SELECT idAdress, adNbh, adCity, adState FROM address");
        $addressArray = $result_address->fetch_all();

        $searchUserServices = mysqli_query($link, "SELECT idService, sName, sDesc, sVal, sAdressId, sPhoto, sClass FROM services WHERE idUserDo = '$idUserSet'");
        
        while ($row = mysqli_fetch_array($searchUserServices)) {
            
            $services = array();

            $services['idUserDo'] = $idUserSet;
            $services['idService'] = $row["idService"];
            $services['sName'] = $row["sName"];
            $services['sDesc'] = $row["sDesc"];
            $services['sVal'] = $row["sVal"];
            $services['sAdressId'] = $row["sAdressId"];
            $services['sPhoto'] = $row["sPhoto"];
            $services['sClass'] = $row["sClass"];

            $servicesAddressId = $row["sAdressId"];

            //produra o endereço do servico
            while($finded == false){
                if($addressArray[$posi][0] == $servicesAddressId){
                    //print_r($addressArray[$posi]);
                    $services['sNbh'] = $addressArray[$posi][1];
                    $services['sCity'] = $addressArray[$posi][2];
                    $services['sState'] = $addressArray[$posi][3];
                    $finded = true;
                }                    
                //echo $adLineInfo;
                $posi++;
            }
            $posi = 0;
            $finded = false;
            //print_r($services);
            array_push($response["services"], $services);
        }
        $response["success"] = 1;
    }else{
        $response["success"] = 0;
    }

    mysqli_close($link);
    echo json_encode($response);
?>