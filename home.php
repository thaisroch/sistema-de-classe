<?php
    session_start();
    if(!isset($_SESSION['id'])){
        header("location:index.php");
        exit;
    }
    require_once 'src'. DIRECTORY_SEPARATOR .'Escola.php';
    $escola = new Escola ("db_sistemadeclasse","localhost","root","DB_sistema*classe1");

    require_once 'src'. DIRECTORY_SEPARATOR .'Classe.php';
    $classe = new Classe ("db_sistemadeclasse","localhost","root","DB_sistema*classe1");

    require_once 'src'. DIRECTORY_SEPARATOR .'Professor.php';
    $professor = new Professor ("db_sistemadeclasse","localhost","root","DB_sistema*classe1");

    include 'header.php'; 
    include 'menu.php';
?>    
    <main>
        <section class="wrapper-lista">           
            <a href="escola.php" class="fill-div">
                <article id="escola">
                    <?php
                        $idprofessor = $_SESSION['id'];                    
                        $resp_escolas = $escola->qtdade_escolas($idprofessor);                       
                    ?>
                    <div  class="resp_qtde">
                        <?php echo "$resp_escolas" ?>
                    </div>
                <h2>Escolas</h2>
                </article>
            </a>
            <a href="classe.php" class="fill-div">
                <article id="classe">
                    <div class="resp_qtde">0</div>
                    <h2>Classes</h2>
                </article>
            </a>
            <a href="aluno.php" class="fill-div">
                <article id="aluno">
                    <div class="resp_qtde">0</div>
                    <h2>Alunos</h2>
                </article>
            </a>
            <a href="relatorios.php" class="fill-div">
                <article id="relatorio">
                    <div class="resp_qtde">0</div>
                    <h2>Relatórios</h2>             
                </article>
            </a>
        </section>
    </main>
    <?=include 'footer.php'; ?>