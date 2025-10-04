<?php 

    require_once __DIR__.'/../model/Doacao.php';

    class DoacaoService {
        
        //Método GET /doacao
        public function getTodas(){
            return Doacao::listar();
        }

        //Método GET /doacao/{id}
        public function getDoacaoUsuario($id){
            if($id == null){
                throw new Exception("ID do usuário não fornecido");
            }

            return Doacao::listarDoacaoUsuario($id);
        }

        //Método POST /doacao
        public function post($data){
            $dados = json_decode(file_get_contents("php://input"), true, 512);

            if($dados == null){
                throw new Exception("Dados inválidos");
            }

            return Doacao::inserirDoacao($dados);
        }

        //Método PUT /doacao/{id}
        public function put($id){
            if($id == null){
                throw new Exception("ID da doação não fornecido");
            }

            return Doacao::atualizarStatus($id);
        }

        public function putUsuario($id){
            if($id == null){
                throw new Exception("ID do usuário não fornecido");
            }

            return Doacao::atualizarDoacaoUsuario($id);
        }
    }
?>