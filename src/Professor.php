<?php
    class Professor{

    public $msgErro = "";

    public function conectar($nome, $host, $usuario, $senha){
        global $pdo;
        try{
            $pdo = new PDO("mysql:dbname=".$nome.";host=".$host,$usuario,$senha);
        }catch(PDOException $e){
            $msgErro = $e -> getMessage();
        }        
    }
    public function cadastrar($nome, $email, $senha){
        global $pdo;
        //verificar se já existe o email cadastrado
        $sql = $pdo-> prepare ("SELECT id FROM tbl_professor WHERE email = :e");
        $sql -> bindValue(":e",$email);
        $sql -> execute();
        if($sql -> rowCount() > 0){
            return false; // já está cadastrada
        }else{  // caso não exista, cadastrar
        $sql = $pdo -> prepare ("INSERT INTO tbl_professor(
            nome, email, senha) VALUES (:n, :e, :s)"); 
            $sql -> bindValue(":n",$nome);
            $sql -> bindValue(":e",$email);
            $sql -> bindValue(":s",md5($senha));
            $sql -> execute();
            return true;
        }
    }  
    public function logar($email, $senha){
        global $pdo;
        //verificar se o email e senha estão cadastrados, se sim entrar no sistema(sessaõ)
        $sql = $pdo -> prepare ("SELECT id from tbl_professor where email = :e AND senha = :s");
        $sql -> bindValue(":e",$email); // substitue o email por :e e s:senha
        $sql -> bindValue(":s",md5($senha));
        $sql -> execute();
        if($sql -> rowCount() > 0){
            //entrar no sistema(sessão)
            //transformar o que veio do banco em array por fetch
            $dado = $sql->fetch(); 
            //iniciar sessão
            session_start();
            //estartar a sessão       
            $_SESSION['id'] = $dado ['id'];
            return true;  // logado com sucesso
        }else{
            return false; // não conseguiu logar
        }
    }

}
?>