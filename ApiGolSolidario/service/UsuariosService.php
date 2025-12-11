<?php

    require_once __DIR__ . "/../model/Usuarios.php";

    class UsuariosService {
        
        //Método GET /usuarios ou /usuarios/{id}
        public function get( $id = null ) {
            if($id) {
                return Usuarios::buscarPorId($id); ;
            }else {
                return Usuarios::listar();
            }
        }

        //Método POST /usuarios
        public function post() {
            $dados = json_decode(file_get_contents("php://input"), true, 512);
            if($dados == null) {
                throw new Exception("Dados inválidos");
            }

            return Usuarios::inserir($dados);
        }

        //Metodo POST /usuarios/login
        public function login() {
            $dados = json_decode(file_get_contents("php://input"), true, 512);
            if($dados == null || !isset($dados["email"]) || !isset($dados["senha"])) {
                throw new Exception("Dados inválidos");
            }
            
            $resultado = Usuarios::login($dados["email"], $dados["senha"]);

            if (is_array($resultado)) {
                return json_encode($resultado); 
            } else {
                return $resultado;
            }
        }

        //Método PUT /usuarios/{id}
        public function put( $id = null ) {
            if($id == null) {
                throw new Exception("ID inválido");
            }

            $dados = json_decode(file_get_contents("php://input"), true, 512);
            if($dados == null) {
                throw new Exception("Dados inválidos");
            }
            
            return Usuarios::atualizar($id, $dados);
        }

        //Método PUT times /usuarios/{id}/time
        public function putTime( $id = null ) {
            if($id == null) {
                throw new Exception("ID inválido");
            }

            $dados = json_decode(file_get_contents("php://input"), true, 512);
            if($dados == null || !isset($dados["time_id"])) {
                throw new Exception("Dados inválidos");
            }
            
            return Usuarios::alterarTime($id, $dados["time_id"]);
        }

        //Método DELETE /usuarios/{id}
        public function delete( $id ) {
            if($id == null) {
                throw new Exception("ID inválido");
            }

            return Usuarios::deletar($id);
        }
        public function logout() {
            http_response_code(200);
            return json_encode(["mensagem" => "Logout concluído com sucesso."]);
        }
    }
?>