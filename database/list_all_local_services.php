<?php
    require_once('db.class.php');
    $link = '';
    //session_start();
    $userWasListed = array();
    // array que guarda a resposta da requisicao
    $response = array();
    if(isset($_SESSION['active_adress'])){
        $userActiveAddress = $_SESSION['active_adress'];
        $response["services"] = array();
        $objDb = new db();
        $link = $objDb->mysql_connect();
        // Consulta o endereço ativo
        $adrActive = mysqli_query($link, "SELECT adNbh, adCity, adState  FROM address WHERE idAdress = $userActiveAddress");
        $adrActiveArray = mysqli_fetch_array($adrActive, MYSQLI_ASSOC);
        
        $nbhActive = $adrActiveArray['adNbh'];
        $cityActive = $adrActiveArray['adCity'];
        $stateActive = $adrActiveArray['adState'];

        $con = mysqli_query($link, "SELECT idUserDo, sClass, sAdressId  FROM services");
        
        while ($row = mysqli_fetch_array($con, MYSQLI_ASSOC)) {
            $services = array();
            $servicesIdUserDo = $row["idUserDo"];
            if(in_array($servicesIdUserDo, $userWasListed) == false){
                
                $servicesAddressId = $row["sAdressId"];
                $result_address = mysqli_query($link, "SELECT adNbh, adCity,adState FROM address WHERE idAdress = $servicesAddressId");
                $addressArray = mysqli_fetch_array($result_address);
                $services["sNbh"] = $addressArray['adNbh'];
                $services["sCity"] = $addressArray['adCity'];
                $services["sState"] = $addressArray['adState'];
                
                if($services["sNbh"] == $nbhActive && $services["sCity"] == $cityActive){
                    $result_user = mysqli_query($link, "SELECT usrName, usrProfilePhotoSrc FROM users WHERE idUser = $servicesIdUserDo");
                    $userDoArray = mysqli_fetch_array($result_user);
                    $services["userDoName"] = $userDoArray['usrName'];
                    $services["userDoProfilePhoto"] = $userDoArray['usrProfilePhotoSrc'];
                    $services['sClass'] = $row["sClass"];


                    $userWasListed[] = $row["idUserDo"];
                    //insere o id do usuário no array verificados para não haver duplicidade
                    $services["idUsr"] = $row["idUserDo"];
                    array_push($response["services"], $services);
                }
            }
        }

        $con = mysqli_query($link, "SELECT idUserDo, sClass, sAdressId  FROM services");
        
        while ($row = mysqli_fetch_array($con, MYSQLI_ASSOC)) {
            //echo'<script>console.log("city 1")</script>';
            $services = array();
            $servicesIdUserDo = $row["idUserDo"];
            if(in_array($servicesIdUserDo, $userWasListed) == false){
                
                $servicesAddressId = $row["sAdressId"];
                $result_address = mysqli_query($link, "SELECT adNbh, adCity,adState FROM address WHERE idAdress = $servicesAddressId");
                $addressArray = mysqli_fetch_array($result_address);
                $services["sNbh"] = $addressArray['adNbh'];
                $services["sCity"] = $addressArray['adCity'];
                $services["sState"] = $addressArray['adState'];

                if($services["sCity"] == $cityActive){
                    $result_user = mysqli_query($link, "SELECT usrName, usrProfilePhotoSrc FROM users WHERE idUser = $servicesIdUserDo");
                    $userDoArray = mysqli_fetch_array($result_user);
                    $services["userDoName"] = $userDoArray['usrName'];
                    $services["userDoProfilePhoto"] = $userDoArray['usrProfilePhotoSrc'];
                    $services['sClass'] = $row["sClass"];


                    $userWasListed[] = $row["idUserDo"];
                    //insere o id do usuário no array verificados para não haver duplicidade
                    $services["idUsr"] = $row["idUserDo"];
                    array_push($response["services"], $services);
                }
            }
        }

        $con = mysqli_query($link, "SELECT idUserDo, sClass, sAdressId  FROM services");
        
        while ($row = mysqli_fetch_array($con, MYSQLI_ASSOC)) {
            //echo'<script>console.log("state 1")</script>';
            $services = array();
            $servicesIdUserDo = $row["idUserDo"];
            if(in_array($servicesIdUserDo, $userWasListed) == false){
                //echo'<script>console.log("state 2")</script>';
                $servicesAddressId = $row["sAdressId"];
                $result_address = mysqli_query($link, "SELECT adNbh, adCity,adState FROM address WHERE idAdress = $servicesAddressId");
                $addressArray = mysqli_fetch_array($result_address);
                $services["sNbh"] = $addressArray['adNbh'];
                $services["sCity"] = $addressArray['adCity'];
                $services["sState"] = $addressArray['adState'];

                if($services["sState"] == $stateActive){
                    //echo'<script>console.log("state 3")</script>';
                    $result_user = mysqli_query($link, "SELECT usrName, usrProfilePhotoSrc FROM users WHERE idUser = $servicesIdUserDo");
                    $userDoArray = mysqli_fetch_array($result_user);
                    $services["userDoName"] = $userDoArray['usrName'];
                    $services["userDoProfilePhoto"] = $userDoArray['usrProfilePhotoSrc'];
                    $services['sClass'] = $row["sClass"];


                    $userWasListed[] = $row["idUserDo"];
                    //insere o id do usuário no array verificados para não haver duplicidade
                    $services["idUsr"] = $row["idUserDo"];
                    array_push($response["services"], $services);
                }
            }
        }

        mysqli_close($link);
        //echo json_encode($response);
        $services_json = json_encode($response);
    }else{
        $response["message"] = 'Adicione um endereço para listar os serviços próximos';
        $services_json = json_encode($response);
    }

    if(empty($userWasListed) and isset($_SESSION['active_adress'])){
        $response["message"] = 'Não há serviços encontrados para essa localidade :(';
        $services_json = json_encode($response);
    }
?>