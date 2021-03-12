<?php
    require_once('db.class.php');
    $response = array();
    //Conecta a tabela de servicos
    $sql = "SELECT * FROM services";

    $objDb = new db();
    $link = $objDb->mysql_connect();

    $servicesInfo = mysqli_query($link, $sql);

    if($servicesInfo){
        $response["services_users"] = array();
        
        while($line = mysqli_fetch_array($servicesInfo, MYSQLI_ASSOC)){
            //conecta a tabela de users para dados específicos
            $sql = "SELECT idUser, usrName, usrProfilePhoto FROM users";

            $objDb = new db();
            $link = $objDb->mysql_connect();

            $usrInfo = mysqli_query($link, $sql);

            //conecta a tabela de address para dados específicos
            $sql = "SELECT idAdress, adNbh, adCity FROM address";

            $objDb = new db();
            $link = $objDb->mysql_connect();
            $adrInfo = mysqli_query($link, $sql);
            
            //operacoes

            $service = array();
            $service['id_service'] = $line['idService'];
            $service['service_name'] = $line['idUserDo'];
            
            while ($usrData = mysqli_fetch_array($usrInfo, MYSQLI_ASSOC)) {
                    if($service['service_name'] == $usrData['idUser']){
                        $service['service_name'] = $usrData['usrName'];
                        $service['service_profile_img'] =  $usrData['usrProfilePhoto'];
                    }; // Aqui resultado da segunda tabela
                }

            $service['service_class'] = $line['sClass'];
            //$service['service_profile_img'] = $line['sPhoto'];

            while ($adrData = mysqli_fetch_array($adrInfo, MYSQLI_ASSOC)) {
                if($line['sAdressId'] == $adrData['idAdress']){
                    $service['service_nbh'] = $adrData['adNbh'];
                    $service['service_city'] =  $adrData['adCity'];
                }; // Aqui terceira da segunda tabela
            }
            //$service['service_nbh'] = 'Jardim Camburi';
            //$service['service_city'] = 'Vitória';
            $response["success"] = array();
            array_push($response["success"], '1');
            
            array_push($response["services_users"], $service);
        }
        }
        
    else{
        echo"Parece que estamos passando por uma instabilidade, entre em contato com o suporte";
    }


    echo json_encode($response, JSON_UNESCAPED_UNICODE);
?>