<?php

    require_once 'service/UsuariosService.php';

    //If para a validação da URL
    if(@$_GET['url']){
        $url = explode('/', @$_GET['url']);

        if($url[0] == "usuarios"){
            
            $service = ucfirst($url[0])."Service";
            $method = $_SERVER['REQUEST_METHOD'];

            array_shift($url);
            
            $id = count($url) > 0 ? $url[0] : null;
            try{
                $response = call_user_func(array(new $service, $method), $id);
                http_response_code(200);
                echo $response;
            } catch (Exception $e) {
                http_response_code(500);
                echo ("Erro 500: ");
            }

        } else {
            http_response_code(404);
            echo ("Rota não encontrada 404");
        }

    } else {
        http_response_code(404);
        echo ("Rota não encontrada 404");
    }
?>
