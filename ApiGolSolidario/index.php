<?php

    require_once 'service/UsuariosService.php';
    require_once 'service/TimesService.php';
    require_once 'service/DoacaoService.php';
    require_once 'service/PartidasService.php';

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type");
    header("Content-Type: application/json; charset=utf-8");

    //If para a validação da URL
    if(@$_GET['url']){
        $url = explode('/', @$_GET['url']);

        $service = ucfirst($url[0])."Service";
        $method = $_SERVER['REQUEST_METHOD'];

        $method_name = null;
        $id = null;

        //Rotas para usuários, times e doações
        
        if($url[0] == "usuarios"){
            
            array_shift($url);

            if($method == "POST"){
                if(count($url) == 0){ 
                    // ROTA 1: POST /usuarios (CRIAR NOVO USUÁRIO / CADASTRO)
                    $method_name = "post"; 
                    $id = null;

                } else if(count($url) == 1 && $url[0] == "login"){
                    // ROTA 2: POST /usuarios/login (AUTENTICAÇÃO / LOGIN)
                    $method_name = "login";
                    $id = null;

                } else {
                    echo ("Rota não encontrada 404");
                    http_response_code(404);
                    exit;
                }

            }  else if ($method == "PUT") {

                if (count($url) == 2 && $url[1] == "time") {
                    $method_name = "putTime";
                    $id= count($url) > 0 ? $url[0] : null;

                } else if (count($url) == 1) {
                    $method_name = "put";
                    $id= count($url) > 0 ? $url[0] : null;

                } else {
                    echo json_encode(["mensagem" => "Rota de atualização de usuário inválida."]);
                    http_response_code(400);
                    exit;
                }

            }else { //Rota para outros metodos - GET, PUT, DELETE
                $method_name = $method;
                $id = count($url) > 0 ? $url[0] : null;
            }

        } else if ($url[0] == "logout") {
            array_shift($url); 
    
            if ($method == "GET" && count($url) === 0) {
                $service = "UsuariosService"; 
                $method_name = "logout"; 
                $id = null;
            } else {
                http_response_code(405);
                echo json_encode(["mensagem" => "Rota inválida para /logout."]);
                exit;
            }

        } else if($url[0] == "times"){
            array_shift($url);

            if($method == "GET"){
                
                if(count($url) == 0){ //Rota 1 - /times
                    $method_name = "getTimes";
                    $id = null;

                } else if(count($url) == 2 && $url[1] == "usuarios"){ //Rota 2 - /times/{id}/usuarios
                    $method_name = "getUsuariosTime";
                    $id= count($url) > 0 ? $url[0] : null;

                } else {
                    echo ("Rota não encontrada 404");
                    http_response_code(404);
                    exit;
                }

            } else { //Rota para outros metodos - POST, DELETE
                $method_name = $method;

                $id= count($url) > 0 ? $url[0] : null;
            }
        } else if($url[0] == "doacao"){
            array_shift($url);

            if($method == "GET"){
                
                if(count($url) == 0){ //Rota 1 - /doacao
                    $method_name = "getTodas";
                    $id = null;

                } else if(count($url) == 1){ //Rota 2 - /doacao/{id}
                    $method_name = "getDoacaoUsuario";
                    $id= count($url) > 0 ? $url[0] : null;

                } else {
                    echo ("Rota não encontrada 404");
                    http_response_code(404);
                    exit;
                }

            } else if($method == "PUT"){
                
                if(count($url) == 1){ //Rota 1 - /doacao/{id}
                    $method_name = "put";
                    $id= count($url) > 0 ? $url[0] : null;

                } else if(count($url) == 2 && $url[0] == "usuario"){ //Rota 2 - /doacao/usuario/{id}
                    $method_name = "putUsuario";
                    $id= count($url) > 1 ? $url[1] : null;

                } else {
                    echo ("Rota não encontrada 404");
                    http_response_code(404);
                    exit;
                }
                
            } else { //Rota para outros metodos - POST
                $method_name = $method;

                $id= count($url) > 0 ? $url[0] : null;
            }
        } else if($url[0] == "partidas"){
            array_shift($url);

            if($method == "GET"){
                
                if(count($url) == 0){ //Rota 1 - /partidas
                    $method_name = "getTodas";
                    $id = null;

                } else if(count($url) == 1){ //Rota 2 - /partidas/{id}
                    $method_name = "getPartida";
                    $id= count($url) > 0 ? $url[0] : null;

                } else {
                    echo ("Rota não encontrada 404");
                    http_response_code(404);
                    exit;
                }

            } else if($method == "PUT"){

                if(count($url) == 1){ //Rota 1 - /partidas/{id}
                    $method_name = "putPartida";
                    $id= count($url) > 0 ? $url[0] : null;

                } else if(count($url) == 2 && $url[0] == "placar"){ //Rota 2 - /partidas/placar/{id}
                    $method_name = "putPlacarPartida";
                    $id= count($url) > 1 ? $url[1] : null;

                } else {
                    echo ("Rota não encontrada 404");
                    http_response_code(404);
                    exit;
                }
            } else { //Rota para outros metodos - POST, DELETE
                $method_name = $method;

                $id= count($url) > 0 ? $url[0] : null;
            }
        }

        if($method_name){
            try{
                if(!class_exists($service) || !method_exists($service, $method_name)){
                    echo ("Rota não encontrada 404");
                    http_response_code(404);
                    exit;
                }

                $response = call_user_func(array(new $service, $method_name), $id);
                http_response_code(200);
                echo $response;

            } catch (Exception $e) {
                http_response_code(500);
                echo ("Erro 500". $e->getMessage());

            }
        } else {
            echo ("Rota não encontrada 404");
            http_response_code(404);

        }   
    } else {
        http_response_code(404);
        echo ("Rota não encontrada 404");
    }
?>