<?php
require_once('4__requisicoes.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receitas com ingredientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<header>
        <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="3__receitaIngredientes.php">Receitas com Ingredientes</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="1__index.php">Ingredientes</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="2__receitas.php">Receitas</a>
                </ul>
                </li>
            </ul>
            </div>
        </div>
        </nav>
    </header>
    <main>
        <div class = main>
            <!-- MOSTRAR LISTA DE INGREDIENTES EM UMA RECEITA -->
            <div class = "container">
                <div class = "item i3">

                    <table class="table">
                            <tr class="table-dark">
                                <th>ESCOLHA UMA RECEITA PARA VER</th>
                            </tr>
                        </table>

                        <!-- LISTA RECEITA -->

                    <form id='inserirReceita_Ingrediente' action="3__receitaIngredientes.php" method="POST">
                        <div class="row">
                            <div class="col-sm-8">
                                <select id = 'escolheReceita' class="form-select" name='idReceita'>
                                    <option>Selecione a receita</option>
                                    <?php 
                                        $run = conectarReceitas();
                                        while($row_receitas = mysqli_fetch_assoc($run)){?>
                                            <option value="<?php echo $row_receitas['id']; ?>">
                                                <?php echo $row_receitas['id'] . " - " . $row_receitas['descricao'];?> 
                                            </option><?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="col">
                                <input class="btn btn-dark" type="submit" value="Buscar" name='verIngredienteEmReceita'/>
                            </div>
                        </div>
                    </form>
                    
                    <br>

                    <!-- lista ingredientes na receita -->
                    
                    <?php
                        if (isset($_POST['verIngredienteEmReceita']) ||
                            isset($_POST['inserirIngredienteEmReceita'])||
                            // isset($_POST['alteraOrdem'])||
                            // isset($_POST['alteraQuantidade'])||
                            // isset($_POST['escolheIngExcluir'])||
                            isset($_POST['acaoEscolhida'])
                            ){
                                $var = 'idReceita';
                            listarIngredientesnaReceita($var);
                        }
                    ?>
                </div>
            
                <!-- ADICIONAR INGREDIENTES NUMA RECEITA EXISTENTE -->
        
                <div class = "item i2">
                    <table class="table">
                        <tr class="table-dark">
                            <th>ADICIONE UM INGREDIENTE</th>
                        </tr>
                    </table>

                    <form id='inserirReceita_Ingrediente' action="3__receitaIngredientes.php" method="POST">
                        <!-- lista receitas -->
                        <div class="row">
                            <label class="form-label" for='escolheReceita'>Escolha a receita </label>
                            <div class="col">
                                <select class="form-select" id = 'escolheReceita' name='idReceita'>
                                    <option>Selecione</option>
                                        <?php
                                            $run = conectarReceitas();
                                            while($row_ingredientes = mysqli_fetch_assoc($run)){?>
                                                <option value="<?php echo $row_ingredientes['id']; ?>">
                                                    <?php echo $row_ingredientes['id'] . " - " . $row_ingredientes['descricao'];?> 
                                                </option><?php
                                            }
                                        ?>
                                </select>
                            </div>
                        </div>
                        <br>
                        <!-- lista ingredientes -->
                        <div class="row">
                            <label class="form-label" for='inputReceita'> Escolha o ingrediente </label>
                            <div class="col">
                                <select class="form-select" id = 'inputReceita' name="listaIngredientes">
                                    <option>Selecione</option>
                                        <?php
                                            $run = conectarIngredientes();
                                            while($row_ingredientes = mysqli_fetch_assoc($run)){?>
                                                <option value="<?php echo $row_ingredientes['id']; ?>">
                                                    <?php echo $row_ingredientes['id'] . " - " . $row_ingredientes['descricao'];?> 
                                                </option><?php
                                            }
                                        ?>
                                </select>
                            </div>
                        </div>
                        <br>
                        <!-- quantidade -->
                        <div class="row">
                        <label class="form-label" for='quantidade'>Digite a quantidade em kilos</label>
                            <div class="col-sm-8">
                                <input class="form-control" id='quantidade' type='number' placeholder="Digite a quantidade" name='quantidade' required/>
                            </div>
                            <div class="col-sm-2">
                            <input class="btn btn-dark" type="submit" value="Inserir" name='inserirIngredienteEmReceita'/>
                            </div>
                        </div>    
                    </form>
                </div>      
                <!-- ALTERAÇÕES -->
            
                <div class = "item i2">
                    <div>
                        <table class="table">
                            <tr class="table-dark">
                                <th>ESCOLHA UMA AÇÃO</th>
                            </tr>
                    </table>
                        <form id='escolhaAcao' action="3__receitaIngredientes.php" method="POST">
                            <!-- LISTA RECEITAS -->                    
                            <div class="row">
                                <label class="form-label" for='escolheOrdem'>Receitas </label>
                                <div class="col">
                                    <select class="form-select" id = 'escolheOrdem' name='idReceita'>
                                        <option>Selecione</option>
                                            <?php 
                                                $run = conectarReceitas();
                                                while($row_receitas = mysqli_fetch_assoc($run)){?>
                                                <option value="<?php echo $row_receitas['id']; ?>">
                                                <?php echo $row_receitas['id'] . " - " . $row_receitas['descricao'];?> 
                                                </option><?php
                                                }
                                            ?>
                                    </select>
                                </div>
                            </div>
                            <br>            
                            <!-- SELETOR AÇÃO -->                
                            <div class="row">
                                <label class="form-label" for='seletorAcao'>Ação</label>
                                <div class="col-sm-7">
                                    <select class="form-select" id = 'seletorAcao' name='acao'>
                                        <option>Selecione</option>
                                        <option value = 'escolheOrdem'>Alterar Ordem</option>
                                        <option value = 'alteraQuant' >Alterar Quantidade</option>
                                        <option value = 'escolheExcluir' >Excluir Ingrediente</option>
                                    </select>
                                </div>
                                <div class="col-sm-2">
                                <input class="btn btn-dark" type="submit" value="Selecionar" name='acaoEscolhida'/>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div>
                    <?php
                        if (isset($_POST['acaoEscolhida'])){

                            $opcao = $_POST['acao'];
                            $opcaoReceita = $_POST['idReceita'];

                            if($opcaoReceita == 'Selecione'){
                                erro();
                            }else{
                                if($opcao == 'escolheOrdem'){
                                    ?>

                                    <!-- ALTERA ORDEM DE INGREDIENTES EM  UMA RECEITA EXISTENTE -->

                                    <div>
                                    <form id='inserirReceita_Ingrediente' action="3__receitaIngredientes.php" method="POST">
                                        <!-- seletor ingredientes -->
                                        <?php
                                            echo "<br>";
                                            echo "<p>Escolha dois ingredientes para trocar de ordem<p>";
                                            caixaSelecaoOrdem('id1');
                                            echo "<br>";
                                            caixaSelecaoOrdem('id2');
                                            echo "<br>";
                                            echo "<input type='submit' class='btn btn-dark' value='Alterar Ordem' name='alteraOrdem'/>"; 
                                        ?>
                                    </form>
                                </div>
                                <?php 
                                } 
                                else if($opcao == 'alteraQuant'){
                                ?>

                                <!-- ALTERA QUANTIDADE DE INGREDIENTE EM  UMA RECEITA EXISTENTE -->

                                <div> 
                                    <form id='inserirReceita_Ingrediente' action="3__receitaIngredientes.php" method="POST">
                                        <!-- seletor ingredientes -->
                                        <?php
                                            echo "<br>";
                                            echo "<label class='form-label' for='quantidade'>Escolha o ingrediente</label>";
                                            echo "<br>";
                                            caixaSelecaoOrdem('novaQuant');
                                            echo "<br>";
                                            echo "<label class='form-label' for='quantidade'>Digite o peso em kilos</label>";
                                            echo "<input class='form-control' id='quantidade' type='number' placeholder='Digite o novo peso' name='novaQuantValor' required/>";
                                            echo "<br><input class='btn btn-dark' type='submit' value='Alterar Ordem' name='alteraQuantidade'/>";
                                        ?>
                                    </form>
                                </div>
                                <?php 
                                }
                                else if($opcao == 'escolheExcluir'){
                                ?>

                                    <!-- EXCLUI INGREDIENTE NUMA RECEITA EXISTENTE -->

                                    <div>
                                        <form id='escolhaExcluirIngrediente' action="3__receitaIngredientes.php" method="POST">
                                            <!-- seletor ingredientes -->
                                            <?php
                                            caixaSelecaoIngredientes('escolheIngExcluir');
                                            ?>
                                        </form>
                                    </div><?php
                                }else{
                                    echo "<p>Por favor selecione uma ação<p>";
                                }
                        }
                    }
                    ?>   
                </div>
            </div>    
        </div>
    </main>
    <footer>

    </footer>
</body>
</html>
