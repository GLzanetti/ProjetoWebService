<?php 

    require __DIR__ .  "/../config.php";

    class Usuarios {

        //Inserir usuario
        public static function inserir($usuario) {
            $tabela = "usuarios";

            $conexao = new PDO(dbDriver.":host=".dbHost.";dbname=".dbName, dbUsuario, dbSenha);

            $sql = "INSERT INTO $tabela (nome, email, telefone, time_id) VALUES (:nome, :email, :telefone, :time_id)";
            
            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(":nome", $usuario["nome"]);
            $stmt->bindValue(":email", $usuario["email"]);
            $stmt->bindValue(":telefone", $usuario["telefone"]);
            $stmt->bindValue(":time_id", $usuario["time_id"]);

            $stmt->execute();

            if($stmt->rowCount() > 0) {
                return "Usuário inserido com sucesso!";
            } else {
                return "Erro ao inserir usuário.";
            }
        }

        //Buscar todos os usuarios
        public static function listar(){
            $tabela = "usuarios";

            $conexao = new PDO(dbDriver.":host=".dbHost.";dbname=".dbName, dbUsuario, dbSenha);

            $sql = "SELECT * FROM $tabela";

            $stmt = $conexao->prepare($sql);
            $stmt->execute();

            if($stmt->rowCount() > 0) {
                $valores = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return json_encode($valores);
                
            } else {
                return "Nenhum usuário encontrado.";
            }
        }

        //Buscar usuario por ID
        public static function buscarPorId($id){
            $tabela = "usuarios";

            $conexao = new PDO(dbDriver.":host=".dbHost.";dbname=".dbName, dbUsuario, dbSenha);

            $sql = "SELECT * FROM $tabela WHERE id = :id";

            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(":id", $id);
            $stmt->execute();

            if($stmt->rowCount() > 0) {
                $valores = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return json_encode($valores); // Convertendo o array para JSON antes de
                
            } else {
                return "Usuário não encontrado.";
            }
        }

        //Alterar dados usuario
        public static function atualizar($id, $usuario) {
            $tabela = "usuarios";

            $conexao = new PDO(dbDriver.":host=".dbHost.";dbname=".dbName, dbUsuario, dbSenha);

            $sql = "UPDATE $tabela SET nome = :nome, email = :email, telefone = :telefone, time_id = :time_id WHERE id = :id";
            
            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(":nome", $usuario["nome"]);
            $stmt->bindValue(":email", $usuario["email"]);
            $stmt->bindValue(":telefone", $usuario["telefone"]);
            $stmt->bindValue(":time_id", $usuario["time_id"]);
            $stmt->bindValue(":id", $id);

            $stmt->execute();

            if($stmt->rowCount() > 0) {
                return "Usuário alterado com sucesso!";
            } else {
                return "Erro ao alterar usuário.";
            }
        }

        //Deletar usuario
        public static function deletar($id) {
            $tabela = "usuarios";

            $conexao = new PDO(dbDriver.":host=".dbHost.";dbname=".dbName, dbUsuario, dbSenha);

            $sql = "DELETE FROM $tabela WHERE id = :id";
            
            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(":id", $id);

            $stmt->execute();

            if($stmt->rowCount() > 0) {
                return "Usuário deletado com sucesso!";
            } else {
                return "Erro ao deletar usuário.";
            }
        }
    }
?>