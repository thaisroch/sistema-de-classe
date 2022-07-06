<?php
    class Escola{

        private $pdo;
        // 6 funções
        // ponto de partida do codigo
        public function __construct($dbname, $host, $user, $senha)
        {
            try{
                $this->pdo = new PDO("mysql:dbname=".$dbname.";host=".$host,$user,$senha);
            }
            catch(PDOException $e){
                echo "Erro com banco de dados:".$e->getMessage();
                exit();
            }
            catch(Exception $e){
                echo "Erro generico:".$e->getMessage();
            }
        }
        //-----------------------------------------------------------------------------------------------------------------------
        // função para buscar o dados e colocar no canto direiro da tela.
        public function buscarDados( $idprofessor){
            $res = array();
            $cmd = $this->pdo->prepare(" SELECT escola.id, escola.nome, escola.email FROM tbl_escola AS escola INNER JOIN tbl_professor AS professor ON escola.fk_tbl_professor_id = professor.id 
            WHERE escola.fk_tbl_professor_id = :p");
            $cmd->bindValue(":p", $idprofessor);
            $cmd->execute();
            //recebendo o arreio em cmd e convertendo e mandando para variavel res.
            $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }
        //-----------------------------------------------------------------------------------------------------------------------
        //Função de cadastrar Escola no banco de dados
        public function cadastrarEscola($nome, $email, $idprofessor){
            //Antes de cadastrar temos que verificar se já existe o cadastro do email
            $cmd = $this->pdo->prepare(" SELECT escola.id FROM tbl_escola AS escola INNER JOIN tbl_professor AS professor ON escola.fk_tbl_professor_id = professor.id WHERE escola.email = :e");           

            $cmd->bindValue(":e", $email);
            $cmd->execute();
            if($cmd->rowCount() > 0) //email já existente.
            {
                return false;
            }else{ // email não cadastrado
                $cmd = $this->pdo->prepare("INSERT INTO tbl_escola (nome, email, fk_tbl_professor_id) VALUES (:n, :e, :p)");
                $cmd->bindValue(":n", $nome);
                $cmd->bindValue(":e", $email);
                $cmd->bindValue(":p", $idprofessor);
                $cmd->execute();
                return true;
            }
        }
        //--------------------------------------------------S---------------------------------------------------------------------
        public function excluirEscola($id){
            $cmd = $this->pdo->prepare("DELETE FROM tbl_escola WHERE id=:id");
            $cmd->bindValue(":id", $id);
            $cmd->execute();
        }

        public function buscardadosUmaEscola($id_upEscola, $idprofessor ){
            // tranformando a variavel $res em um array, pois caso o banco não retorne nenhum dados poderia dar erro!
            $res = array();
            $cmd = $this->pdo->prepare(" SELECT escola.id, escola.nome, escola.email  FROM tbl_escola AS escola 
            INNER JOIN tbl_professor AS professor ON escola.fk_tbl_professor_id = professor.id 
            WHERE escola.fk_tbl_professor_id = :idPro
            AND  escola.id = :idEsc;");

            $cmd->bindValue(":idEsc", $id_upEscola);
            $cmd->bindValue(":idPro", $idprofessor);
            $cmd->execute();
            $res = $cmd->fetch(PDO::FETCH_ASSOC);
            return $res;
        }


        //---------------------------------------------- FALTA CORREÇÃO AQUI ------------------------------------------------
        public function atualizarDadosEscola($id, $nome, $email, $idprofessor){
            
            $cmd = $this->pdo->prepare("UPDATE tbl_escola escola
            SET escola.nome = :n, escola.email = :e 
            INNER JOIN tbl_professor AS professor 
            ON escola.fk_tbl_professor_id = professor.id 
            WHERE escola.fk_tbl_professor_id = :p  AND escola.id = :id;");


            $cmd->bindValue(":n", $nome);
            $cmd->bindValue(":e", $email);
            $cmd->bindValue(":id", $id);
            $cmd->bindValue(":p", $idprofessor);
            $cmd->execute();    
        }  
        public function qtdade_escolas($idprofessor){

            $cmd = $this->pdo->prepare("SELECT COUNT(*) FROM tbl_escola AS escola 
            INNER JOIN tbl_professor AS professor ON escola.fk_tbl_professor_id = professor.id 
            WHERE escola.fk_tbl_professor_id = :p;");
            
            $cmd->bindValue(":p", $idprofessor);
            $cmd->execute();
            $res = $cmd->fetchColumn();
            return $res;
        }
    }
?>