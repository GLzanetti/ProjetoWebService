<?php 

    include_once __DIR__ . "/../config.php";

    class Times{

        //Inserir time
        public static function inserir($dados){
            $tabela = "times";

            $conexao = new PDO(dbDriver.":host=".dbHost.";dbname=".dbName, dbUsuario, dbSenha);

            $sql = "INSERT INTO $tabela (nome) VALUES (:nome)";
            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':nome', $dados['nome']);

            $stmt->execute();

            if($stmt->rowCount() > 0){
                return "Time inserido com sucesso";
            } else {
                return "Erro ao inserir time";
            }
        }

        //Listar todos os times
        public static function listarTimes(){
            $tabela = "times";

            $conexao = new PDO(dbDriver.":host=".dbHost.";dbname=".dbName, dbUsuario, dbSenha);

            $sql = "SELECT * FROM $tabela";
            $stmt = $conexao->prepare($sql);
        
            $stmt->execute();

            if($stmt->rowCount() > 0){
                $valores = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return json_encode($valores);
            } else {
                return "Nenhum time encontrado";
            }
        }

        //Listar usuarios de cada time
        public static function listarUsuariosTime($id){
            $tabela = "usuarios";

            $conexao = new PDO(dbDriver.":host=".dbHost.";dbname=".dbName, dbUsuario, dbSenha);

            $sql = "SELECT * FROM $tabela WHERE time_id = :id";
            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':id', $id);

            $stmt->execute();

            if($stmt->rowCount() > 0){
                $valores = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return json_encode($valores);
            } else {
                return "Nenhum usuário encontrado para este time";
            }
        }

        //TODO analizando se é necessário fazer a implementação
        // public static function atualizarTime(){}

        //Deletar time
        public static function deletarTime($id){
            $tabela = "times";

            $conexao = new PDO(dbDriver.":host=".dbHost.";dbname=".dbName, dbUsuario, dbSenha);

            $sql = "DELETE FROM $tabela WHERE id = :id";
            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':id', $id);

            $stmt->execute();

            if($stmt->rowCount() > 0){
                return "Time deletado com sucesso";
            } else {
                return "Erro ao deletar time";
            }
        }
    }
?>