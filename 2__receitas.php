<?php
    require_once("4__requisicoes.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingredientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="2__receitas.php">Receitas</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="1__index.php">Ingredientes</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="3__receitaIngredientes.php">Receitas com Ingredientes</a>
                </ul>
                </li>
            </ul>
            </div>
        </div>
        </nav>
    </header>
    <main >
    <div class = main>
        <div class = "container">
            <!-- LISTA RECEITAS -->

            <div class = "item i1" >
                <table class="table table-hover" >
                    <tr class="table-dark">
                        <th colspan = 2>RECEITAS CADASTRADOS</th>
                    </tr>
                    <tr class="table-secondary">
                        <th>Código</th>
                        <th>Receita</th>
                    </tr>
                        <?php listarReceitas(); ?>
                </table>
            </div>

            <div class = "item i2 " >

                <!-- INSERIR RECEITAS -->

                <table class="table">
                    <tr class="table-dark">
                        <th>ESCOLHA UMA AÇÃO</th>
                    </tr>
                </table>

                <form id='receitas' action="2__receitas.php" method="POST">
                    <div class = "row">
                        <label for='nomeReceita' class="form-label" >Inserir</label>
                        <div class="col-sm-9">
                            <input id='nomeReceita' class="form-control" type='text' placeholder="Digite a receita" name='nomeReceita' required/>
                        </div>
                        <div class="col-sm-2">
                            <input class="btn btn-dark" type="submit" value="Criar" name='criarReceita'/>
                        </div>
                    </div>
                            
                </form>

                <br>

                <!--  EDITAR RECEITA -->

                <form id='EditaRec' action="2__receitas.php" method="POST">
                    <div class="row">
                        <label for='listaReceita' class="form-label"> Editar </label>
                        <div class="col-sm-4">
                            <select class="form-select"id = 'listaReceita' name="EditaRec" required>
                                <option>Selecione</option>
                                    <?php
                                        $run = conectarReceitas();
                                        while($row_receitas = mysqli_fetch_assoc($run)){?>
                                        <option value="<?php echo $row_receitas['id']; ?>">
                                        <?php echo 'ID ' . $row_receitas['id'] . ' - ' . $row_receitas['descricao'];
                                    ?> 
                                </option><?php
                                }
                                    ?>
                            </select>
                        </div>
                        <div class="col-sm-5">
                            <input class="form-control" id='editarNomeReceita' type='text' placeholder="Digite o novo nome" name='editarNomeReceita' required/>
                        </div>
                        <div class="col-sm-2">
                            <input class="btn btn-dark" type="submit" value="Editar" name='editarReceita'/>
                        </div>
                    </div>
                    
                </form>

                <br>

                <!-- EXCLUIR INGREDIENTE -->
                <form id='excluiR' action="2__receitas.php" method="POST">
                    <div class="row">
                        <label class="form-label" for='listaReceita'>Excluir </label>
                        <div class="col-sm-9">
                            <select class="form-select" id = 'listaReceita' name="excluiRec" required>
                                <option>Selecione</option>
                                    <?php
                                    $run = conectarReceitas();
                                    while($row_receitas = mysqli_fetch_assoc($run)){?>
                                        <option value="<?php echo $row_receitas['id']; ?>">
                                            <?php echo 'ID ' . $row_receitas['id'] . ' - ' . $row_receitas['descricao'];?> 
                                        </option><?php
                                    }
                                ?>
                            </select>
                        </div>
                        <div class = "col-sm-2">
                            <input class="btn btn-dark"type="submit" value="Excluir" name='excluirReceita'/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </main>
    <footer>
    
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    </body>
</html>