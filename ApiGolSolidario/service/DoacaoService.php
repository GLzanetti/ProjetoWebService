<?php 

    require_once __DIR__.'/../model/Doacao.php';

    class Doacao {
        
        public function get(){
            return Doacao::listar();
        }

        public function getDoacaoUsuario($id){
            if($id == null){
                throw new Exception("ID do usuário não fornecido");
            }

            return Doacao::listarDoacaoUsuario($id);
        }

        public function post($data){
            $dados = json_decode(file_get_contents("php://input"), true, 512);

            if($dados == null){
                throw new Exception("Dados inválidos");
            }

            return Doacao::inserirDoacao($dados);
        }

        public function put($id){
            if($id == null){
                throw new Exception("ID da doação não fornecido");
            }

            return Doacao::atualizarStatus($id);
        }
    }
?>