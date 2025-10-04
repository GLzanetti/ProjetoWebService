<?php 

    require_once __DIR__.'/../enum/StatusDoacao.php';

    class Doacao {
        
        //Insere uma nova doação com status inicial "Pendente"
        public static function inserirDoacao($dados) {
            $tabela = 'doacao';

            $conexao = new PDO(dbDriver.":host=".dbHost.";dbname=".dbName, dbUsuario, dbSenha);

            $sql = "INSERT INTO $tabela (usuario_id, status) VALUES (:usuario_id, :status)";
            
            $statusInicial = StatusDoacao::PENDENTE->value;

            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':usuario_id', $dados['usuario_id']);
            $stmt->bindParam(':status', $statusInicial);
            $stmt->execute();

            if($stmt->rowCount() > 0){
                return "Doação inserida com sucesso";
            } else {
                return "Erro ao inserir doação";
            }
        }

        //Lista todas as doações
        public static function listar(){
            $tabela = "doacao";

            $conexao = new PDO(dbDriver.":host=".dbHost.";dbname=".dbName, dbUsuario, dbSenha);

            $sql = "SELECT * FROM $tabela";

            $stmt = $conexao->prepare($sql);
            $stmt->execute();

            if($stmt->rowCount() > 0){
                $valores = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return json_encode($valores);
            } else {
                return "Nenhuma doação encontrada";
            }
        }

        //Lista todas as doações de um usuário específico
        public static function listarDoacaoUsuario($id){
            $tabela = "doacao";

            $conexao = new PDO(dbDriver.":host=".dbHost.";dbname=".dbName, dbUsuario, dbSenha);

            $sql = "SELECT * FROM $tabela WHERE usuario_id = :id";

            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':id', $id);

            $stmt->execute();

            if($stmt->rowCount() > 0){
                $valores = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return json_encode($valores);
            } else {
                return "Nenhuma doação encontrada";
            }
        }

        //Atualiza o status de uma doação para "Recebida"
        public static function atualizarStatus($id){
            $tabela = "doacao";

            $conexao = new PDO(dbDriver.":host=".dbHost.";dbname=".dbName, dbUsuario, dbSenha);

            $sql = "UPDATE $tabela SET status = :status WHERE usuario_id = :id";

            $statusAtualizado = StatusDoacao::RECEBIDA->value;

            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':status', $statusAtualizado);
            $stmt->bindParam(':id', $id);
            
            $stmt->execute();

            if($stmt->rowCount() > 0){
                return "Status da doação atualizado para 'Recebida'";
            } else {
                return "Erro ao atualizar status ou doação não encontrada";
            }
        }

        public static function atualizarDoacaoUsuario($id){
            $tabela = "doacao";

            $conexao = new PDO(dbDriver.":host=".dbHost.";dbname=".dbName, dbUsuario, dbSenha);

            $sql = "UPDATE $tabela SET usuario_id = null WHERE id = :id";

            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':id', $id);
            
            $stmt->execute();

            if($stmt->rowCount() > 0){
                return "Usuário da doação atualizado com sucesso";
            } else {
                return "Erro ao atualizar usuário ou doação não encontrada";
            }
        }
    }
?>