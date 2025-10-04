<?php 

    class Partida{

        //Lista todas as partidas
        public static function listarPartidas(){
            $tabela = "partidas";

            $conexao = new PDO(dbDriver.":host=".dbHost.";dbname=".dbName, dbUsuario, dbSenha);

            $sql = "SELECT * FROM $tabela";
            $stmt = $conexao->prepare($sql);
        
            $stmt->execute();

            if($stmt->rowCount() > 0){
                $valores = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return json_encode($valores);
            } else {
                return "Nenhuma partida encontrada";
            }
        }

        //Lista uma partida pelo ID
        public static function listarPartidaPorId($id){
            $tabela = "partidas";

            $conexao = new PDO(dbDriver.":host=".dbHost.";dbname=".dbName, dbUsuario, dbSenha);

            $sql = "SELECT * FROM $tabela WHERE id = :id";
            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':id', $id);

            $stmt->execute();

            if($stmt->rowCount() > 0){
                $valores = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return json_encode($valores);
            } else {
                return "Nenhuma partida encontrada para o ID informado";
            }
        }

        //Insere uma nova partida
        public static function inserirPartida($dados){
            $tabela = "partidas";

            $conexao = new PDO(dbDriver.":host=".dbHost.";dbname=".dbName, dbUsuario, dbSenha);

            $sql = "INSERT INTO $tabela (time_mandante, time_visitante, dia, placar_mandante, placar_visitante) 
            VALUES (:time_mandante, :time_visitante, :dia, :placar_mandante, :placar_visitante)";

            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':time_mandante', $dados['time_mandante']);
            $stmt->bindParam(':time_visitante', $dados['time_visitante']);
            $stmt->bindParam(':dia', $dados['dia']);
            $stmt->bindParam(':placar_mandante', $dados['placar_mandante']);
            $stmt->bindParam(':placar_visitante', $dados['placar_visitante']);

            $stmt->execute();

            if($stmt->rowCount() > 0){
                return "Partida inserida com sucesso";
            } else {
                return "Erro ao inserir partida";
            }
        }

        //Atualiza uma partida
        public static function atualizarPartida($id, $dados){
            $tabela = "partidas";

            $conexao = new PDO(dbDriver.":host=".dbHost.";dbname=".dbName, dbUsuario, dbSenha);

            $sql = "UPDATE $tabela SET time_mandante = :time_mandante, time_visitante = :time_visitante, dia = :dia WHERE id = :id";

            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':time_mandante', $dados['time_mandante']);
            $stmt->bindParam(':time_visitante', $dados['time_visitante']);
            $stmt->bindParam(':dia', $dados['dia']);
            $stmt->bindParam(':id', $id);

            $stmt->execute();

            if($stmt->rowCount() > 0){
                return "Partida atualizada com sucesso";
            } else {
                return "Erro ao atualizar partida ou nenhuma alteração feita";
            }
        }

        //Atualiza o placar de uma partida
        public static function atualizarPlacarPartida($id, $dados){
            $tabela = "partidas";

            $conexao = new PDO(dbDriver.":host=".dbHost.";dbname=".dbName, dbUsuario, dbSenha);

            $sql = "UPDATE $tabela SET placar_mandante = :placar_mandante, placar_visitante = :placar_visitante WHERE id = :id";

            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':placar_mandante', $dados['placar_mandante']);
            $stmt->bindParam(':placar_visitante', $dados['placar_visitante']);
            $stmt->bindParam(':id', $id);

            $stmt->execute();

            if($stmt->rowCount() > 0){
                return "Partida atualizada com sucesso";
            } else {
                return "Erro ao atualizar partida ou nenhuma alteração feita";
            }
        }

        //Deleta uma partida
        public static function deletarPartida($id){
            $tabela = "partidas";

            $conexao = new PDO(dbDriver.":host=".dbHost.";dbname=".dbName, dbUsuario, dbSenha);

            $sql = "DELETE FROM $tabela WHERE id = :id";

            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':id', $id);

            $stmt->execute();

            if($stmt->rowCount() > 0){
                return "Partida deletada com sucesso";
            } else {
                return "Erro ao deletar partida ou partida não encontrada";
            }
        }
    }
?>