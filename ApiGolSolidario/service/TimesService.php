<?php 
    require_once __DIR__ . "/../model/Times.php";

    class TimesService{

        //Método GET /times
        public function getTimes(){
            return Times::listarTimes();
        }

        //Método GET /times/{id}/usuarios
        public function getUsuariosTime($id){
            if($id == null){
                throw new Exception("ID do time não fornecido");
            }
            return Times::listarUsuariosTime($id);
        }

        //Método POST /times
        public function post(){
            $dados = json_decode(file_get_contents("php://input"), true, 512);
            if($dados == null){
                throw new Exception("Dados inválidos");
            }
            return Times::inserir($dados);
        }

        //Método DELETE /times/{id}
        public function delete($id){
            if($id == null){
                throw new Exception("ID do time não fornecido");
            }

            return Times::deletarTime($id);
        }
    }

?>