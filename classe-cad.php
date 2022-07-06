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
        <section class="wrapper-lista">
        <!-- Início do formulário -->
            <form>

                <fieldset class="grupo">
                    
                    <div class="campo">
                        <label for="nome"><strong>Nome</strong></label>
                        <input type="text" name="nome" id="nome" required>
                    </div>

                   
                    <div class="campo">
                        <label for="ano"><strong>Ano</strong></label>
                        <input type="text" name="ano" id="ano" required>
                    </div>
                </fieldset> 

                <div class="campo">
                    <label><strong>Qual é o periodo?</strong></label>
                    <label>
                        <input type="radio" name="devweb" value="manha" checked>Manhã
                    </label>
                    <label>
                        <input type="radio" name="devweb" value="tarde">Tarde
                    </label>
                    <label>
                        <input type="radio" name="devweb" value="noite">Noite
                    </label>
                </div>
                <div class="campo">
                    <label for="senioridade"><strong>Escola</strong></label>
                    <select id="senioridade" required>
                    <option selected disabled value=""> -- Selecione -- </option>
                    <option>Escola1</option>
                    <option>Escola2</option>
                    <option>Escola3</option>
                    </select>
                </div>

                
                <div class="campo">
                    <label for="disciplina"><strong>Disciplina</strong></label>
                    <select id="disciplina" required>
                    <option selected disabled value="">-- Selecione --</option>
                    <option>História</option>
                    <option>Inglês</option>
                    <option>Matemática</option>
                    <option>-- Adicionar -- </option>
                    </select>
                </div>
                
                <button type="submit" class="btn" >Cadastrar</button>
                <a href="classe.php" class="btn-linkado">Cancelar</a>
                         
            </form>
        </section>
    </main>
    <?=include 'footer.php'; ?>