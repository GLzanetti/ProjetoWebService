<?php

require_once __DIR__.'/../model/Partidas.php';

    class PartidasService {

        //Metodo GET /partidas
        public function getTodas() {
            return Partida::listarPartidas();
        }

        //Metodo GET /partidas/{id}
        public function getPartida($id) {
            if($id == null){
               throw new Exception("ID da partida não informado");
            }

            return Partida::listarPartidaPorId($id);
        }

        //Metodo POST /partidas
        public function post() {
            $dados = json_decode(file_get_contents("php://input"), true);
            if($dados == null){
                throw new Exception("Dados da partida não informados");
            }
            return Partida::inserirPartida($dados);
        }

        //Metodo PUT /partidas/{id}
        public function putPartida($id) {
            if($id == null){
                throw new Exception("ID da partida não informado");
            }

            $dados = json_decode(file_get_contents("php://input"), true);
            if($dados == null){
                throw new Exception("Dados da partida não informados");
            }

            return Partida::atualizarPartida($id, $dados);
        }

        //Metodo PUT /partidas/placar/{id}
        public function putPlacarPartida($id) {
            if($id == null){
                throw new Exception("ID da partida não informado");
            }

            $dados = json_decode(file_get_contents("php://input"), true);
            if($dados == null){
                throw new Exception("Dados do placar não informados");
            }

            return Partida::atualizarPlacarPartida($id, $dados);
        }

        //Metodo DELETE /partidas/{id}
        public function delete($id) {
            if($id == null){
                throw new Exception("ID da partida não informado");
            }

            return Partida::deletarPartida($id);
        }
    }
?>