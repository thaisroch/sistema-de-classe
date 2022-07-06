<?php
    session_start();
    if(!isset($_SESSION['id'])){
        header("location:index.php");
        exit;
    }
    include 'header.php';
    include 'menu.php';
?>
    <main>
        <h1>Relatórios</h1>
        <section class="wrapper-lista">
            <p>Nenhuma classe cadastrada!</p>
        </section>           
    </main>           
    <?= include 'footer.php'; ?>