<?php

    include_once "../model/Usuarios.php";

    class UsuariosService {
        
        // echo ("GET method called with ID: ");
        public function get( $id = null ) {
            if($id) {
                return Usuarios::buscarPorId($id[0]); ;
            }else {
                return Usuarios::listar();
            }
        }

        public function post( $data ) {
            $dados = json_decode(file_get_contents("php://input"), true, 512);
            if($dados == null) {
                throw new Exception("Dados inválidos");
            }

            return Usuarios::inserir($dados);
        }

        public function put( $id ) {
            if($id == null) {
                throw new Exception("ID inválido");
            }

            $dados = json_decode(file_get_contents("php://input"), true, 512);
            if($dados == null) {
                throw new Exception("Dados inválidos");
            }
            
            return Usuarios::atualizar($id, $dados);
        }

        public function delete( $id ) {
            if($id == null) {
                throw new Exception("ID inválido");
            }

            return Usuarios::deletar($id);
        }
    }
?>