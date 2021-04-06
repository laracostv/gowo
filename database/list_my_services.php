<?php
    //esta funcao retorna as informações de um determinado prestador de serviço
    
    $link = '';
    // array que guarda a resposta da requisicao
    $response = array();
    $posi = 0;
    $finded = false;

    require_once('db.class.php');
    $objDb = new db();
    $link = $objDb->mysql_connect();

    if(isset($_SESSION['id_usr'])){
    $idUserSet = $_SESSION['id_usr'];
    
/*TESTES
    $idUserSet = 18;
    
    if(isset($idUserSet)){
*/    
        //consulta toda tabela de enderecos
        $response["services"] = array();

        $user_info = mysqli_query($link, "SELECT usrName, usrEmail, usrCellPhone, usrProfilePhoto, usrProfilePhotoSrc FROM users WHERE idUser = '$idUserSet'");
        $user_info_array = mysqli_fetch_array($user_info);
        $user_info_posi['usrName'] = $user_info_array[0];
        $user_info_posi['usrEmail'] = $user_info_array[1];
        $user_info_posi['usrCellPhone'] = $user_info_array[2];
        $user_info_posi['usrBase64Photo'] = $user_info_array[3];
        $user_info_posi['usrPhoto'] = $user_info_array[4];

        $result_address = mysqli_query($link, "SELECT idAdress, adNbh, adCity, adState FROM address");
        $addressArray = $result_address->fetch_all();

        $searchUserServices = mysqli_query($link, "SELECT idService, sName, sDesc, sVal, sAdressId, sClass, sPhotoSrc FROM services WHERE idUserDo = '$idUserSet'");
        
        while ($row = mysqli_fetch_array($searchUserServices)) {
            
            $services = array();

            $services['idUserDo'] = $idUserSet;
            $services['idService'] = $row["idService"];
            $services['sName'] = $row["sName"];
            $services['sDesc'] = $row["sDesc"];
            $services['sVal'] = $row["sVal"];
            $services['sAdressId'] = $row["sAdressId"];
            $services['sPhoto'] = $row["sPhotoSrc"];
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

    $services_json = json_encode($response);
?>