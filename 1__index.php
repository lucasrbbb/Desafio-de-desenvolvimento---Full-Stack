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
            <a class="navbar-brand" href="1__index.php">Ingredientes</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="2__receitas.php">Receitas</a>
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
            <!-- LISTA INGREDIENTES -->

            <div class = "item i1" >
                <table class="table table-hover" >
                    <tr class="table-dark">
                        <th colspan = 2>INGREDIENTES CADASTRADOS</th>
                    </tr>
                    <tr class="table-secondary">
                        <th>Código</th>
                        <th>Descrição</th>
                    </tr>
                        <?php listarIngredientes(); ?>
                </table>
            </div>

            <div class = "item i2 ">

                <!-- INSERIR INGREDIENTES -->
                <table class="table">
                    <tr class="table-dark">
                        <th>ESCOLHA UMA AÇÃO</th>
                    </tr>
                </table>

                <form id='form'  action="1__index.php" method="POST">
                    <div class="row">
                            <label for='inputDescricao' class="form-label" >Adicionar </label>
                        <div class="col-sm-9">
                            <input class="form-control" id='inputDescricao' type='text' placeholder="Digite o ingrediente" name='descricao' required/>
                        </div>
                        <div class="col-sm-2">
                            <input class="btn btn-dark" type="submit" value="Inserir" name='inserir'/>
                        </div>  
                    </div>        
                </form>

                <br>

                <!--  EDITAR INGREDIENTE -->

                <form id='excluiIng' action="1__index.php" method="POST">
                    <div class="row">
                        <label for='editarNome' class="form-label" > Editar </label>
                        <div class="col-sm-4">
                            <select class="form-select" id = 'listaIng' name="listaIngEdit" required>
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
                        <div class="col-sm-5">
                            <input class="form-control" id='editarNome' type='text' placeholder="Digite o novo nome" name='editarNome' required/>
                        </div>
                        <div class="col-sm-2">
                            <input class="btn btn-dark" type="submit" value="Editar" name='editar'/>
                        </div>
                    </div>
                    
                </form>

                <br>

                <!-- EXCLUIR INGREDIENTE -->

                <form id='editarIng' action="1__index.php" method="POST">
                    <div class="row">
                        <label for='listaIng' class="form-label"> Excluir </label>
                        <div class="col-sm-9">
                        <select class="form-select" id = 'listaIng' name="listaIngExc" required>
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
                        <div class="col-sm-2">
                            <input class="btn btn-dark" type="submit" value="Excluir" name='excluir'/>
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
