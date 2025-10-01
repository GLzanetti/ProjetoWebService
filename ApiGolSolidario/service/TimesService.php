<?php 
    require_once __DIR__ . "/../model/Times.php";

    class TimesService{

        public function getTimes(){
            return Times::listarTimes();
        }

        public function getUsuariosTime($id){
            if($id == null){
                throw new Exception("ID do time não fornecido");
            }
            return Times::listarUsuariosTime($id);
        }

        public function post($data){
            $dados = json_decode(file_get_contents("php://input"), true, 512);
            if($dados == null){
                throw new Exception("Dados inválidos");
            }
            return Times::inserir($dados);
        }

        public function delete($id){
            if($id == null){
                throw new Exception("ID do time não fornecido");
            }

            return Times::deletarTime($id);
        }
    }

?>