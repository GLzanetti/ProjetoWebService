<?php

    require_once 'service/UsuariosService.php';
    require_once 'service/TimesService.php';

    //If para a validação da URL
    if(@$_GET['url']){
        $url = explode('/', @$_GET['url']);

        $service = ucfirst($url[0])."Service";
        $method = $_SERVER['REQUEST_METHOD'];

        $method_name = null;
        $id = null;
        

        if($url[0] == "usuarios"){
            
            $method_name = $method;
            array_shift($url);
            $id = count($url) > 0 ? $url[0] : null;

        }else if($url[0] == "times"){
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
        }else if($url[0] == "doacao"){
            array_shift($url);

            if($method == "GET"){
                
                if(count($url) == 0){ //Rota 1 - /doacao
                    $method_name = "get";
                    $id = null;

                } else if(count($url) == 1){ //Rota 2 - /doacao/{id}
                    $method_name = "getDoacaoUsuario";
                    $id= count($url) > 0 ? $url[0] : null;

                } else {
                    echo ("Rota não encontrada 404");
                    http_response_code(404);
                    exit;
                }

            } else { //Rota para outros metodos - POST, PUT
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