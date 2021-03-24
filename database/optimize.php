<?php
    require_once('db.class.php');
    $link = '';
    session_start();
    $userWasListed = array();
    $posi = 0;
    $finded = false;
    // array que guarda a resposta da requisicao
    $response = array();
    if(isset($_SESSION['active_adress'])){
        $userActiveAddress = $_SESSION['active_adress'];
        $response["services"] = array();
        
        $objDb = new db();
        $link = $objDb->mysql_connect();
        
                
        //consulta toda tabela de enderecos
        $result_address = mysqli_query($link, "SELECT idAdress, adNbh, adCity, adState FROM address");
        $addressArray = $result_address->fetch_all();

        //consulta toda tabela de enderecos
        $result_users = mysqli_query($link, "SELECT idUser, usrName, usrProfilePhoto FROM users");
        $usersArray = $result_users->fetch_all();
        //print_r($usersArray);

        // Consulta o endereço ativo
        $adrActive = mysqli_query($link, "SELECT adNbh, adCity, adState  FROM address WHERE idAdress = $userActiveAddress");
        $adrActiveArray = mysqli_fetch_array($adrActive, MYSQLI_ASSOC);
        
        $nbhActive = $adrActiveArray['adNbh'];
        $cityActive = $adrActiveArray['adCity'];
        $stateActive = $adrActiveArray['adState'];

        //consulta toda tabela de servicos
        $con = mysqli_query($link, "SELECT idUserDo, sClass, sAdressId  FROM services");

        while ($row = mysqli_fetch_array($con, MYSQLI_ASSOC)) {
            $services = array();
            $servicesIdUserDo = $row["idUserDo"];

            if(in_array($servicesIdUserDo, $userWasListed) == false){
                $servicesAddressId = $row["sAdressId"];
               //echo 'id endereço do serviço:'. $servicesAddressId.'<br>';

                //procura os do usuario que presta o servico
                while($finded == false){
                    if($usersArray[$posi][0] == $servicesIdUserDo){
                        //print_r($addressArray[$posi]);
                        $services['idUsr'] = $usersArray[$posi][0];
                        $services['userDoName'] = $usersArray[$posi][1];
                        $services['sProfilePhoto'] = $usersArray[$posi][2];
                        $finded = true;
                    }                    
                    //echo $adLineInfo;
                    $posi++;
                }
                $posi = 0;
                $finded = false;

                $services['sClass'] = $row["sClass"];

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
                
                $userWasListed[] = $row["idUserDo"];
                array_push($response["services"], $services);
            }
        }
/*
        $con = mysqli_query($link, "SELECT idUserDo, sClass, sAdressId  FROM services");
        
        while ($row = mysqli_fetch_array($con, MYSQLI_ASSOC)) {
            echo'<script>console.log("city 1")</script>';
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
                    $result_user = mysqli_query($link, "SELECT usrName, usrProfilePhoto FROM users WHERE idUser = $servicesIdUserDo");
                    $userDoArray = mysqli_fetch_array($result_user);
                    $services["userDoName"] = $userDoArray['usrName'];
                    $services["userDoProfilePhoto"] = $userDoArray['usrProfilePhoto'];
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
            echo'<script>console.log("state 1")</script>';
            $services = array();
            $servicesIdUserDo = $row["idUserDo"];
            if(in_array($servicesIdUserDo, $userWasListed) == false){
                echo'<script>console.log("state 2")</script>';
                $servicesAddressId = $row["sAdressId"];
                $result_address = mysqli_query($link, "SELECT adNbh, adCity,adState FROM address WHERE idAdress = $servicesAddressId");
                $addressArray = mysqli_fetch_array($result_address);
                $services["sNbh"] = $addressArray['adNbh'];
                $services["sCity"] = $addressArray['adCity'];
                $services["sState"] = $addressArray['adState'];

                if($services["sState"] == $stateActive){
                    echo'<script>console.log("state 3")</script>';
                    $result_user = mysqli_query($link, "SELECT usrName, usrProfilePhoto FROM users WHERE idUser = $servicesIdUserDo");
                    $userDoArray = mysqli_fetch_array($result_user);
                    $services["userDoName"] = $userDoArray['usrName'];
                    $services["userDoProfilePhoto"] = $userDoArray['usrProfilePhoto'];
                    $services['sClass'] = $row["sClass"];


                    $userWasListed[] = $row["idUserDo"];
                    //insere o id do usuário no array verificados para não haver duplicidade
                    $services["idUsr"] = $row["idUserDo"];
                    array_push($response["services"], $services);
                }
            }
        }*/

        mysqli_close($link);
        echo json_encode($response);
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