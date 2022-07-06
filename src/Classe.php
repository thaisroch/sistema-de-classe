<?php
    class Classe
    {
        private $pdo;
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
        //---------------------------------------------------------------------------------

        public function buscarDadosClasse($idprofessor){
            //recebendo o arreio em cmd e convertendo e mandando para variável $res.
            $res = array();
            $cmd = $this->pdo->prepare(" SELECT c.id, c.nome, c.periodo, c.fk_tbl_professor_id1, c.fk_tbl_escola_id, c.fk_tbl_disciplina_id FROM tbl_classe AS c INNER JOIN tbl_professor AS p ON c.fk_tbl_professor_id1 = p.id 
            WHERE c.fk_tbl_professor_id1 = :p");
            $cmd->bindValue(":p", $idprofessor);
            $cmd->execute();
            //recebendo o arreio em cmd e convertendo e mandando para variavel res.
            $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }
        //--------------------------------------------------------------------------------
        //Função de cadastrar Escola no banco de dados
        public function cadastrarClasse($nome, $email){
            //Antes de cadastrar temos que verificar se já existe o cadastro do email
            $cmd = $this->pdo->prepare("SELECT id FROM tbl_classe WHERE email = :e");
            $cmd->bindValue(":e", $email);
            $cmd->execute();
            if($cmd->rowCount() > 0) //email já existente.
            {
                return false;
            }else{ // email não cadastrado
                $cmd = $this->pdo->prepare("INSERT INTO  tbl_classe  (nome, email) VALUES (:n, :e)");
                $cmd->bindValue(":n", $nome);
                $cmd->bindValue(":e", $email);
                $cmd->execute();
                return true;
            }
        }
        //-----------------------------------------------------------------------------------------------------------------------
        public function excluirClasse($id){
            $cmd = $this->pdo->prepare("DELETE FROM tbl_escola WHERE id=:id");
            $cmd->bindValue(":id", $id);
            $cmd->execute();
        }
        public function buscarDadosClasseEsp($id){
            // tranformando a variável $res em um array, pois caso o banco não retorne nenhum dado poderia dar erro!
            $res = array();
            $cmd = $this->pdo->prepare("SELECT * FROM tbl_escola WHERE id = :id");
            $cmd->bindValue(":id", $id);
            $cmd->execute();
            $res = $cmd->fetch(PDO::FETCH_ASSOC);
            return $res;
        }
        public function atualizarDadosClasse($id, $nome,$email){
            
            $cmd = $this->pdo->prepare("UPDATE tbl_escola SET nome = :n, email = :e WHERE id= :id;");
            $cmd ->bindValue(":n", $nome);
            $cmd ->bindValue(":e", $email);
            $cmd ->bindValue(":id", $id);
            $cmd->execute();    
        }  
        public function qtdadeClasse(){
            $cmd = $this->pdo->query("SELECT COUNT(id) FROM tbl_escola");
            $cmd->execute();
            return $cmd;
        }
        public function buscarDadosDisciplina(){

            $cmd = $this->pdo->query("SELECT *
                                      FROM  tbl_disciplina 
                                      ORDER BY nome");
            //recebendo o array no $cmd, convertendo e mandando para variável $res.
            $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }
    }
?>