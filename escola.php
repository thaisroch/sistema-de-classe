<?php
    session_start();
    if (!isset($_SESSION['id'])) {
        header("location:index.php");
        exit;
    }

    require_once 'src'. DIRECTORY_SEPARATOR .'Escola.php';
    $escola = new Escola("db_sistemadeclasse","localhost","root","DB_sistema*classe1");


    
    if(isset($_POST['nome'])){ // clicou no botão para cadastrar ou editar
        
        //------------------------EDITAR ------------------------------
        if(isset($_GET['id_up']) && !empty($_GET['id_up']))
        {
            $id_update = addslashes($_GET['id_up']);
            $nome = addslashes($_POST['nome']);
            $email = addslashes($_POST['email']);
            
            if(!empty($nome) && !empty($email))
            {
                $idprofessor = $_SESSION['id'];
                $escola->atualizarDadosEscola($id_update, $nome, $email, $idprofessor);
                header("location: escola.php");
            }
        //---------------------------CADASTRAR----------------------------
        }else{

            $nome = addslashes($_POST['nome']);
            $email = addslashes($_POST['email']);
            
            if(!empty($nome) && !empty($email))
            {
                $idprofessor = $_SESSION['id'];
                if(!$escola->cadastrarEscola($nome, $email, $idprofessor))
                {                             
                    echo "<script language='javascript'>window.alert('Escola já cadastrada com este email!');</script>"; //aviso provisório        
                }                
            }else{
                echo "<script language='javascript'>window.alert('Preencha todos os campos!');</script>"; //aviso provisório 
            }
        }
    }

    if(isset($_GET['id_up'])){
        $id_update = addslashes($_GET['id_up']);
        $idprofessor = $_SESSION['id'];
        $res = $escola->buscardadosUmaEscola($id_update, $idprofessor );
    }

    include 'header.php'; 
    include 'menu.php'; 
    ?>
        <main>
            <h1>Escolas</h1>
            <section class="wrapper-lista">
                <!--Chamando o conteudo-escola-->
                <div class="container-main">
                    <section id="container-cadastroEscola">
                        <form method="POST">   
                            <div class="conteudo-container-cadastroEscola">               
                                <label for="nome">Nome</label>
                                <input type="text" name="nome" id="nome" value=" 
                                    <?php 
                                        if (isset($res)) {
                                            echo $res['nome'];
                                        } 
                                    ?>
                                ">
                            </div>
                            <div class="conteudo-container-cadastroEscola">       
                                <label for="email">Email</label>
                                <input type="email"  name="email" id="email"  value="
                                    <?php 
                                        if (isset($res)) {
                                            echo $res['email'];
                                        } 
                                    ?> 
                                ">
                            </div>
                            <div class="conteudo-container-cadastroEscola">       
                                <input class="btn-linkado" type="submit" value="<?php if (isset($res)) {
                                                                echo "Atualizar";
                                                            } else {
                                                                echo "Cadastrar";
                                                            } ?>">
                            </div>
                        </form>
                    </section>
                    <section id="container-listagemEscola">                                      
                            <?php
                                $idprofessor = $_SESSION['id'];
                                $dados = $escola->buscarDados($idprofessor);
                                if (count($dados) > 0) { // verifica se tem pessoa cadastrada no banco
                                ?>  
                                    <table id="tabela-listagemEscola">    
                                    <tr id="titulo">
                                        <td>Nome</td>
                                        <!-- Fazer o campo email ocupar duas colunas!-->
                                        <td colspan="2">Email</td>
                                    </tr>
                                <?php
                                    for ($i = 0; $i < count($dados); $i++) {
                                        echo "<tr>";
                                        foreach ($dados[$i] as $k => $v) {
                                            if (($k != "id") and ($k != "fk_tbl_professor_id")) {
                                                echo "<td>" . $v . "</td>";
                                            }
                                        } //fim do foreach
                                ?>
                                    <!-- Botões de editar e excluir por linha -->
                                    <td>
                                        <a class="link-tabela-listagemEscola" id="editar" href="escola.php?id_up=<?php echo $dados[$i]['id'];?>">Editar</a>                                    <a class="link-tabela-listagemEscola" id="excluir" href="escola.php?id=<?php echo $dados[$i]['id'];?>">Excluir</a>
                                    </td>
                                <?php
                                    echo "</tr>";
                                } //fim do for
                            } else {
                                echo "<p> Nenhuma Escola cadastrada! </p>";
                            }
                            ?>
                        </table>
                    </section>
                </div>
            </section>      
        </main>
        <?php
            if(isset($_GET['id'])){
                $id_escola = addslashes($_GET['id']);
                echo "<script language='javascript'>window.location.href='escola.php';</script>";
                $escola->excluirEscola($id_escola);     
            }
        ?>
    <?= include 'footer.php'; ?>
