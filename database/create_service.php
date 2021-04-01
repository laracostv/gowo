<?php
    require_once('db.class.php');
    include_once('db.class.php');
    session_start();

    $service_userId = $_SESSION['id_usr'];
    $service_name = $_POST['service_name'];
    $category = $_POST['category'];
    $adr = $_POST['adr'];
    $desc = $_POST['desc'];
    $value = $_POST['val'];


    $objDb = new db();
    $link = $objDb->mysql_connect();

        // Para a imagem do produto, primeiramente se determina qual o tipo de imagem.
        // Isso e feito atraves da obtencao da extensao do arquivo, localizada na parte
        // final do nome do arquivo (ex. ".jpg")
        $imageFileType = strtolower(pathinfo(basename($_FILES["arquivo"]["name"]),PATHINFO_EXTENSION));
        
        // A imagem e convertida de binario para string atraves do metodo de codificacao
        // base64
        $image_base64 = base64_encode(file_get_contents($_FILES['arquivo']['tmp_name']) );
        
        // No futuro, clientes que pedirem pela imagem armazenada no BD devem ser 
        // capazes de converter a string base64 para o formato original binario.
        // Para que isso possa ser feito, contatena-se no inicio da string base64 da 
        // imagem o mimetype do arquivo original. O mimetype e um codigo que indica o 
        // tipo de arquivo e sua extensao.
        $imgBase64Final = 'data:image/'.$imageFileType.';base64,'.$image_base64;

        
            
    $arquivo = $_FILES['arquivo']['name'];
			
    //Pasta onde o arquivo vai ser salvo
    $_UP['pasta'] = '../assets/images/users/services/';
    
    //Tamanho máximo do arquivo em Bytes
    $_UP['tamanho'] = 1024*1024*100; //5mb
    
    //Array com a extensões permitidas
    $_UP['extensoes'] = array('png', 'jpg', 'jpeg');
    
    //Renomeiar
    $_UP['renomeia'] = true;
    
    //Array com os tipos de erros de upload do PHP
    $_UP['erros'][0] = 'Não houve erro';
    $_UP['erros'][1] = 'O arquivo no upload é maior que o limite do PHP';
    $_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especificado no HTML';
    $_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
    $_UP['erros'][4] = 'Não foi feito o upload do arquivo';
    
    //Verifica se houve algum erro com o upload. Sem sim, exibe a mensagem do erro
    if($_FILES['arquivo']['error'] != 0){
        die("Não foi possivel fazer o upload, erro: <br />". $_UP['erros'][$_FILES['arquivo']['error']]);
        exit; //Para a execução do script
    }
    
    //Faz a verificação da extensao do arquivo
    $tmp_format = explode('.', $_FILES['arquivo']['name']);
    $extensao = strtolower(end($tmp_format));
    if(array_search($extensao, $_UP['extensoes']) === false){		
        echo "
            <script type=\"text/javascript\">
                alert(\"A imagem não foi cadastrada extensão inválida.\");
            </script>
        ";
    }
    
    //Faz a verificação do tamanho do arquivo
    else if ($_UP['tamanho'] < $_FILES['arquivo']['size']){
        echo "
            <script type=\"text/javascript\">
                alert(\"Arquivo muito grande.\");
            </script>
        ";
    }
    
    //O arquivo passou em todas as verificações, hora de tentar move-lo para a pasta foto
    else{
        //Primeiro verifica se deve trocar o nome do arquivo
        if($_UP['renomeia'] == true){
            //Cria um nome baseado no UNIX TIMESTAMP atual e com extensão .jpg
            $nome_final = md5(time()).'.jpg';
            
        }else{
            //mantem o nome original do arquivo
            $nome_final = $_FILES['arquivo']['name'];
        }
        //Verificar se é possivel mover o arquivo para a pasta escolhida
        if(move_uploaded_file($_FILES['arquivo']['tmp_name'], $_UP['pasta'].$nome_final)){
            //Upload efetuado com sucesso, exibe a mensagem
            $blank_var = true;
        }else{
            //Upload não efetuado com sucesso, exibe a mensagem
            echo "
                <script type=\"text/javascript\">
                    alert(\"Imagem não foi cadastrada com Sucesso.\");
                </script>
            ";
            die();
        }
    }

        $sql = "insert into services(idUserDo, sName, sDesc, sVal, sAdressId, sClass,sPhoto, sPhotoSrc)
         values ('$service_userId', '$service_name', '$desc', '$value', '$adr', '$category', '$imgBase64Final', '$nome_final')";

        header('Location: ../index.php?success=1');
        mysqli_query($link, $sql);
        mysqli_close($link);
?>