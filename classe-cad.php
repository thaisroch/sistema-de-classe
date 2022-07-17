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
    ?>lstat

    <main>
        <h1>Classe</h1>
        <section class="wrapper-lista">
        <!-- Início do formulário -->
            <form class="formulario-cadastro-classe">
                    
                    <div class="campoInputClasse" id="campoInputNomeClasse">
                        <label for="tituloInputNomeClasse" class="tituloInputClasse">Nome</label>
                        <input type="text" class="InputClasse" name="InputNomeClasse" id="InputNomeClasse" required>
                    </div>

                   
                    <div class="campoInputClasse">
                        <label for="tituloInputAnoClasse" class="tituloInputClasse">Ano</label>
                        <input type="number" name="ano" class="InputClasse" id="ano" required>
                    </div>
               

                <div class="campoRedioButtonClasse">
                    <label class="tituloInputClasse">Qual é o periodo?</label>
                    <label class="tituloInputClasse">
                        <input type="radio" class="radioButtonClasse" name="classePeriodo" value="manha" checked>Manhã
                    </label>
                    <label class="tituloInputClasse">
                        <input type="radio" class="radioButtonClasse" name="classePeriodo" value="tarde">Tarde
                    </label>
                    <label class="tituloInputClasse">
                        <input type="radio" class="radioButtonClasse" name="classePeriodo" value="noite">Noite
                    </label>
                </div>
                <div class="campoSelectEscolaClasse">
                    <label class="tituloInputClasse" for="senioridade">Escola</label>
                    <select id="senioridade" required>
                    <option  class="tituloInputClasse"selected disabled value=""> -- Selecione -- </option>
                    <option  class="tituloInputClasse" >Escola1</option>
                    <option  class="tituloInputClasse">Escola2</option>
                    <option  class="tituloInputClasse">Escola3</option>
                    </select>
                </div>

                
                <div class="campoSelectDisciplinaClasse">
                    <label class="tituloInputClasse" for="disciplina">Disciplina</label>
                    <select id="disciplina" required>
                    <option  class="tituloInputClasse"selected disabled value="">-- Selecione --</option>
                    <option  class="tituloInputClasse">História</option>
                    <option  class="tituloInputClasse">Inglês</option>
                    <option  class="tituloInputClasse">Matemática</option>
                    <option  class="tituloInputClasse">-- Adicionar -- </option>
                    </select>
                </div>
                <fieldset class="grupoInputClasse" > 

                    <label for="tituloInputAnoClasse" class="tituloInputClasse">Nome da Disciplina</label>
                    <input type="text" class="InputClasse" name="InputNomeClasse" id="InputNomeClasse" required>
                    <div class="boxbtnPequeno">
                        <button class="btnPequeno" type="submit"  >Adicionar</button>
                        <a href="classe.php" class="linkBotaoPequeno" >Cancelar</a>
                    </div>
                </fieldset> 
                <div class="boxbtnGrande">
                    <button class="btn" type="submit"  >Cadastrar</button>
                    <a href="classe.php" class="linkBotao" >Cancelar</a>
                </div>
                         
            </form>
        </section>
    </main>
    <?=include 'footer.php'; ?>






