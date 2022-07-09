<?php
    class Escola{

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
        //-----------------------------------------------------------------------------------------------------------------------
        // Função para buscar todos os dados cadastrado na tbl_escola, com validação por id do usuário professor
        public function buscarDados( $idprofessor){
            $res = array();
            $cmd = $this->pdo->prepare("SELECT e.id, e.nome, e.email 
                                        FROM tbl_escola e 
                                        INNER JOIN tbl_professor p 
                                        ON e.fk_tbl_professor_id = p.id 
                                        WHERE e.fk_tbl_professor_id = :p");

            $cmd->bindValue(":p", $idprofessor);
            $cmd->execute();
            //recebendo o array em cmd e convertendo.
            $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }
        //-----------------------------------------------------------------------------------------------------------------------
        //Função de cadastrar uma escola, com validação por id do usuário professor
        public function cadastrarEscola($nome, $email, $idprofessor){
            //Antes de cadastrar, verifica se já existe o cadastro do email na tbl_escola. 
            $cmd = $this->pdo->prepare("SELECT e.id 
                                        FROM tbl_escola e 
                                        INNER JOIN tbl_professor p 
                                        ON e.fk_tbl_professor_id = p.id
                                        WHERE e.email = :e");           

            $cmd->bindValue(":e", $email);
            $cmd->execute();
            //email já cadastrado.
            if($cmd->rowCount() > 0) 
            {
                return false;
            // email não cadastrado.
            }else{ 
                $cmd = $this->pdo->prepare("INSERT INTO tbl_escola (nome, email, fk_tbl_professor_id) 
                                            VALUES (:n, :e, :p)");

                $cmd->bindValue(":n", $nome);
                $cmd->bindValue(":e", $email);
                $cmd->bindValue(":p", $idprofessor);
                $cmd->execute();
                return true;
            }
        }
        //------------------------------ -------------------------------------------------------------------------------------------
       
        //Função para excluir uma escola da tbl_escola, com  validação por usuário professor.

        public function excluirEscola($id_escola, $idprofessor){
            $cmd = $this->pdo->prepare("DELETE e.*
                                        FROM tbl_escola e
                                        LEFT JOIN tbl_professor p
                                        ON e.fk_tbl_professor_id = p.id 
                                        WHERE e.id=:id and e.fk_tbl_professor_id=:idPro;");

            $cmd->bindValue(":id", $id_escola);
            $cmd->bindValue(":idPro", $idprofessor);
            $cmd->execute();
        }
        //------------------------------------------------------------------------------------------------------------------------
        //Função de buscando uma escola especifica na tbl_escola,  com  validação por usuário professor
        public function buscardadosUmaEscola($id_upEscola, $idprofessor ){
            // Tranformando a variavel $res em um array, pois caso o banco não retorne nenhum dado pode dar um erro!
            $res = array();
            $cmd = $this->pdo->prepare("SELECT e.id, e.nome, e.email  
                                        FROM tbl_escola  e 
                                        INNER JOIN tbl_professor p 
                                        ON e.fk_tbl_professor_id = p.id 
                                        WHERE e.fk_tbl_professor_id = :idPro AND  e.id = :idEsc;");

            $cmd->bindValue(":idEsc", $id_upEscola);
            $cmd->bindValue(":idPro", $idprofessor);
            $cmd->execute();
            $res = $cmd->fetch(PDO::FETCH_ASSOC);
            return $res;
        }


        //---------------------------------------------- -----------------------------------------------------------------------
        //Função de atualizar as informações na tbl_escola,  com  validação por usuário professor
        public function atualizarDadosEscola($id_update, $nome, $email, $idprofessor){
            
            $cmd = $this->pdo->prepare("UPDATE tbl_escola e                                       
                                        LEFT JOIN tbl_professor p 
                                        ON e.fk_tbl_professor_id = p.id 
                                        SET e.nome =:n, e.email =:e, e.fk_tbl_professor_id =:p                                        
                                        WHERE e.id =:id;");

            $cmd->bindValue(":n", $nome);
            $cmd->bindValue(":e", $email);
            $cmd->bindValue(":id", $id_update);
            $cmd->bindValue(":p", $idprofessor);
            $cmd->execute();    
        }  
        //---------------------------------------------------------------------------------------------------------------------
        //Função para saber a quantidade de escolas cadastradas na tbl_escola,
        public function qtdade_escolas($idprofessor){

            $cmd = $this->pdo->prepare("SELECT COUNT(*)     
                                        FROM tbl_escola AS escola 
                                        INNER JOIN tbl_professor AS professor ON escola.fk_tbl_professor_id = professor.id 
                                        WHERE escola.fk_tbl_professor_id = :p;");
            
            $cmd->bindValue(":p", $idprofessor);
            $cmd->execute();
            $res = $cmd->fetchColumn();
            return $res;
        }
    }
?>