<?php
    session_start();
    if(!isset($_SESSION['id'])){
        header("location:index.php");
        exit;
    }
    require_once 'src'. DIRECTORY_SEPARATOR .'Classe.php';
    $classe = new Classe ("db_sistemadeclasse","localhost","root","DB_sistema*classe1");

    include 'header.php'; 
    include 'menu.php'; 
    ?>
        <main>
            <h1>Classe</h1>
            <section class="menu-lateral">
                <ul class="menu-wrapper">
                    <li class="menu-icone"><a href="classe-cad.php" class="menu-icone-link">+</a></li>
                </ul>   
            </section> 
            <section class="wrapper-lista">
                <?php
                    $idprofessor = $_SESSION['id'];
                    $dados = $classe->buscarDadosClasse($idprofessor);
                     // verifica se tem classe cadastrada na tbl_classe
                    if (count($dados) > 0) {
                    ?>  
                        <a href="classe.php" class="fill-div">
                            <article id="classe">                            
                                <h2>Nome Escola 1</h2>
                            </article>
                        </a>
                    <?php                                
                    } else {
                        echo "<p> Nenhuma Escola cadastrada! </p>";
                    }
                    ?>
               
            </section>
    </main>
    <?=include 'footer.php'; ?>