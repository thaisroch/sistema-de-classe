<?php
    require_once 'src'. DIRECTORY_SEPARATOR .'Professor.php';
    $professor = new Professor;
     
    include 'header-login.php';
    ?>
        <main>
            <aside>
                <picture>
                    <source media="(max-width: 670px)" srcset="imagem/backgroud-300.jpg">
                    <img src="imagem/backgroud-600.jpg" alt="Tela de fundo!">
                </picture>
            </aside>
            <article class="conteiner">
                <h1>Acesse sua conta</h1>
                <form method="POST">
                    <input type="email" name="email" placeholder="E-mail">
                    <input  type="password" name="senha" placeholder="Senha">
                    <button type="submit" class="btn" >Acessar</button>
                    <a href="cadastro.php" class="btn-linkado">Criar conta</a>
                    <a href="recuperarConta.php">Esqueceu a senha? </a>
                </form>
                <?php
                    // verificar quando clica no botão acessar.
                    if(isset($_POST['email']))
                    {
                        // addlashes é uma segurança nos campos do usuario no formulário contra Hackers
                        $email = addslashes( $_POST['email']);
                        $senha = addslashes( $_POST['senha']);
                
                        // verificando se  os campos estão preenchidos
                        if(!empty($email) && !empty($senha)){
                            //conectar com o banco
                            $professor->conectar("db_sistemadeclasse","localhost","root","DB_sistema*classe1");
                            if($u->msgErro == ""){
                            // chamando o método logar e passando os parâmetros email e senha.
                                if($professor->logar($email, $senha)){
                                //Fazendo login na area privada!
                                    header("location: home.php");
                                }else{
                                //mensagem por não encontrar usuario e senha no banco de dados.
                                ?>
                                <div class="resp-erro">
                                    <i class="fa fa-times-circle" aria-hidden="true"></i>
                                    <span>Email ou senha invalidos!</span>
                                </div>
                                <?php
                                }
                            }else{
                                // mensagem de erro referente a conexão com o banco de dados.
                                ?>
                                    <div class="resp-erro">
                                        <i class="fa fa-times-circle" aria-hidden="true"></i>
                                        <?php echo "Erro".$u->msgErro; ?>
                                    </div>
                                <?php
                            }
                        }else{
                               // mensagem de erro, os campos não foram  preenchidos.
                            ?>
                                <div class="resp-erro">
                                    <i class="fa fa-times-circle" aria-hidden="true"></i>
                                    <span>Preencha todos os campos!</span>
                                </div>
                            <?php
                        }
                    }
                ?>
            </article>
        </main>        
        <?= include 'footer.php'; ?> 
