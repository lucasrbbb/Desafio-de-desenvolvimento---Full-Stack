<?php 
/*-------------=+*-_-*+=---FUNÇÕES GERAIS---=+*-_-*+=-------------*/

function conectarBanco(){
    $conexao = new mysqli("localhost", "root", "", "racao");
    return $conexao;
}

function fecharBanco($conexao){
    mysqli_close($conexao);
}

function conectarIngredientes(){
    $conexao = conectarBanco();

    $query = "SELECT * FROM ingredientes";
    $run = mysqli_query($conexao,$query) or die("Não foi possível conectar");

    return $run;
}

function conectarReceitas(){
    $conexao = conectarBanco();

    $query = "SELECT * FROM receitas";
    $run = mysqli_query($conexao,$query) or die("Não foi possível conectar");

    return $run;
}

function conectarReceitasIngredientes($valor){
    $conexao = conectarBanco();
    
    $idReceita = $valor;
    
    $query = "SELECT RI.id, id_ingrediente, quant, ordem, descricao FROM receitas_ingredientes AS RI
                INNER JOIN ingredientes ON RI.id_ingrediente = ingredientes.id
                WHERE id_receita = $idReceita ORDER BY ordem";
    $run = mysqli_query($conexao,$query) or die("Não foi possível conectar");

    return $run;
}

function erro(){
    echo "<script>alert('Por favor escolha um valor válido');</script>";
}

function alerta($message) {
    echo "<script>alert('$message');</script>";
}

/*-------------=+*-_-*+=---___FIM__---=+*-_-*+=-------------*/

/*-------=+*-_-*+=---FUNÇÕES INGREDIENTES---=+*-_-*+=-------*/

//inseriringredientes
function inserirIngredientes(){
        $conexao = conectarBanco();

        $descricao = $_POST['descricao'];
        
        $query = "INSERT INTO ingredientes(descricao) VALUES ('$descricao')";
        $run = mysqli_query($conexao,$query) or die("Não foi possível conectar");

        fecharBanco($conexao);

        alerta('Ingrediente incluido com sucesso!');
}

//excluiringredientes
function verificarIngredientes(){
    $conexao = conectarBanco();

    $idIngrediente = $_POST['listaIngExc'];

    $query = "SELECT id_ingrediente FROM receitas_ingredientes";
    $run = mysqli_query($conexao,$query) or die("Não foi possível conectar");
    
    while($ordemReceitas_ingredientes = mysqli_fetch_assoc($run)){
        $id_ingrediente[] = $ordemReceitas_ingredientes['id_ingrediente'];     
    }

    $count = 0;

    for($i = 0; $i< sizeof($id_ingrediente); $i++){
        if($idIngrediente == $id_ingrediente[$i]){
            $count++;
        }
    }

    return $count;
}

function excluirIngredientes(){
        $conexao = conectarBanco();

        $idIngrediente = $_POST['listaIngExc'];

        $query = "DELETE FROM ingredientes WHERE id = $idIngrediente";  
        $run = mysqli_query($conexao,$query) or die("Não foi possível conectar");

        fecharBanco($conexao);

        alerta('Ingrediente excluído com sucesso!');
}

//editarIngredientes
function editarIngredientes(){

    $conexao = conectarBanco();

    $idIngrediente = $_POST['listaIngEdit']; 
    $novoNome = $_POST['editarNome'];

    $query = "UPDATE ingredientes SET descricao = '$novoNome' WHERE id = $idIngrediente";  
    $run = mysqli_query($conexao,$query) or die("Não foi possível conectar");

    fecharBanco($conexao);

    alerta('Ingrediente editado com sucesso!');
}

//ListarIngredientes
function listarIngredientes(){
    $conexao = conectarBanco();

    $query = "SELECT * FROM ingredientes";
    $run = mysqli_query($conexao,$query) or die("Não foi possível conectar");

    while($row_ingredientes = mysqli_fetch_assoc($run)){
        echo "<tr>";
        echo "<td>" . $row_ingredientes['id'] . "</td>";
        echo "<td>" . $row_ingredientes['descricao'] . "</td>";
        echo "</tr>";
    }

    fecharBanco($conexao);
}

/*-------------=+*-_-*+=---___FIM__---=+*-_-*+=-------------*/

/*---------=+*-_-*+=---FUNÇÕES RECEITAS---=+*-_-*+=---------*/

//inserirReceitas
function inserirReceita(){
    $conexao = conectarBanco();

    $nomeReceita = $_POST['nomeReceita'];

    $query = "INSERT INTO receitas(descricao) VALUES ('$nomeReceita')";
    $run = mysqli_query($conexao,$query) or die("Não foi possível conectar");

    fecharBanco($conexao);

    alerta('Receita incluida com sucesso!');

}

//listarReceitas
function listarReceitas(){
    $conexao = conectarBanco();

    $query = "SELECT * FROM receitas";
    $run = mysqli_query($conexao,$query) or die("Não foi possível conectar");

    while($row_receita = mysqli_fetch_assoc($run)){
        echo "<tr>";
        echo "<td>" . $row_receita['id'] . "</td>";
        echo "<td>" . $row_receita['descricao'] . "</td>";
        echo "</tr>";
    }

    fecharBanco($conexao); 
}

//excluirReceita
function excluirReceitas(){
    $conexao = conectarBanco();

    $idReceita = $_POST['excluiRec'];

    $query1= "DELETE FROM receitas_ingredientes WHERE id_receita = $idReceita";
    $run1 = mysqli_query($conexao,$query1) or die("Não foi possível conectar");

    $query2 = "DELETE FROM receitas WHERE id = $idReceita "; 
    $run2 = mysqli_query($conexao,$query2) or die("Não foi possível conectar"); 

    fecharBanco($conexao);

    alerta('Receita excluida com sucesso!');

}

//editarReceitas
function editarReceitas(){
    $conexao = conectarBanco();

    $idReceita = $_POST['EditaRec']; 
    $novoNome = $_POST['editarNomeReceita'];

    $query = "UPDATE receitas SET descricao = '$novoNome' WHERE id = $idReceita";  
    $run = mysqli_query($conexao,$query) or die("Não foi possível conectar");

    fecharBanco($conexao);

    alerta('Receita editada com sucesso!');
}

/*-------------=+*-_-*+=---___FIM__---=+*-_-*+=-------------*/

/*-=+*-_-*+=---FUNÇÕES RECEITAS E INGREDIENTES---=+*-_-*+=--*/

//listarReceitasIngredientes
function listarIngredientesnaReceita($valor){
    $conexao = conectarBanco();

    $idReceita = $_POST[$valor];

    // busca lista ingredientes 
    $busca = "SELECT RI.id, id_ingrediente, quant, ordem, descricao FROM receitas_ingredientes AS RI
    INNER JOIN ingredientes ON RI.id_ingrediente = ingredientes.id
    WHERE id_receita = $idReceita ORDER BY ordem";
    $buscaResultado = mysqli_query($conexao,$busca) or die("Não foi possível conectar");

    //busca nome receita
    $nReceita = "SELECT descricao FROM receitas WHERE id = $idReceita";
    $buscaNomeReceita = mysqli_query($conexao,$nReceita) or die("Não foi possível conectar");
    
    //imprime lista ingredientes
    echo "<table class='table table-hover'>";
        echo "<tr class='table-dark'>";
            echo "<th colspan=2>" . "Código: " . $idReceita . "</th>";
            while($row = mysqli_fetch_assoc($buscaNomeReceita)){
            echo "<th colspan=2>" . $row['descricao'] . "</th>";}
        echo "</tr>";
        echo "<tr class='table-secondary'>
                <th colspan=4> Ingredientes  </th>
            </tr>
            <tr>
                <th>Ordem</th>
                <th>Código</th>
                <th>Descrição</th>
                <th>Previsto em Kg</th>
            </tr>";

    while($row = mysqli_fetch_assoc($buscaResultado)){
        echo "<tr>";
        echo "<td>" . $row['ordem'] . "</td>";
        echo "<td>" . $row['id_ingrediente'] . "</td>";
        echo "<td>" . $row['descricao'] . "</td>";
        echo "<td>" . $row['quant'] . "</td>";
        echo "</tr>";
    }
        echo "</table>";

    fecharBanco($conexao);
}

//inserir ingredientes em uma receita
function inserirReceita_Ingrediente(){
    $conexao = conectarBanco();

    $idReceita = $_POST['idReceita'];
    $idIngrediente = $_POST['listaIngredientes'];
    $quantidade = $_POST['quantidade'];
    $ordem = array();

    //ordem 
    $busca = "SELECT ordem FROM receitas_ingredientes WHERE id_receita = $idReceita";
    $retorno = mysqli_query($conexao,$busca) or die("Não foi possível conectar");
    
    while($ordemReceitas_ingredientes = mysqli_fetch_assoc($retorno)){
        $ordem = $ordemReceitas_ingredientes;     
    }

    if($ordem == null){
        $ordemNovo = 1;
    }else{
        $max = max($ordem) ;
        $ordemNovo = $max + 1;
    }      
    
    $query = "INSERT INTO receitas_ingredientes (id_receita, id_ingrediente, quant, ordem) 
                VALUES ($idReceita, $idIngrediente, $quantidade, $ordemNovo)";
    $run = mysqli_query($conexao,$query) or die("Não foi possível conectar");

    fecharBanco($conexao);

    alerta('Ingrediente incluído com sucesso!');  
}

//excluir ingrediente de uma receita
function caixaSelecaoIngredientes($variavel){
    $valor = $_POST['idReceita'];

    echo "<br>";
    echo "<label class='form-label' for='inputReceita'> Escolha o ingrediente </label>";
    echo "<select class='form-select' id = 'inputReceita' name='ingredientesExc'>";
    echo    "<option>Selecione</option>";
            $run = conectarReceitasIngredientes($valor);
            while($row = mysqli_fetch_assoc($run)){
    echo            "<option value=". $row['id']. ">".
                    $row['ordem'] . " - " . $row['descricao']; 
    echo            "</option>";
            }
    echo  "</select>"; 
    echo "<input type='submit' class='btn btn-dark' value='Excluir' name='$variavel'/>";          
}

function excluirIngredientesReceita(){
    $conexao = conectarBanco(); 

    $idIngredienteReceita = $_POST['ingredientesExc'];

    // encontra id_receita
    $query = "SELECT id_receita, ordem FROM receitas_ingredientes WHERE id = $idIngredienteReceita";
    $run= mysqli_query($conexao,$query) or die("Não foi possível conectar");

    while($idIngReceita = mysqli_fetch_assoc($run)){
        $idReceita = $idIngReceita['id_receita']; 
        $ordem = $idIngReceita['ordem'];    
    }
    
    //deleta ingrediente
    $query = "DELETE FROM receitas_ingredientes WHERE id = $idIngredienteReceita";
    $run = mysqli_query($conexao,$query) or die("Não foi possível conectar");

    //verifica se é o último na ordem
    $query = "SELECT ordem FROM receitas_ingredientes WHERE id_receita = $idReceita";
    $run = mysqli_query($conexao,$query) or die("Não foi possível conectar");

    while($busca = mysqli_fetch_assoc($run)){
        $valorOrdem[] = $busca['ordem'];    
    }
    //compara os valores 
    $verifica = 0;

    for($i = 0; $i< sizeof($valorOrdem); $i++){
        if($ordem < $valorOrdem[$i]){
            $verifica++;
        }
    }

    //altera ordem
    if($verifica != 0){
        $query = "SELECT ordem, id FROM receitas_ingredientes WHERE id_receita = $idReceita AND ordem > $ordem";
        $run= mysqli_query($conexao,$query) or die("Não foi possível conectar");

        while($idquery = mysqli_fetch_assoc($run)){
            $idBusca[] = $idquery['id']; 
            $ordemBusca[] = $idquery['ordem'];    
        }
        
        //altera valor ondem
        for($i = 0; $i< sizeof($ordemBusca); $i++){
            $ordemBusca[$i]--;
        }
    
        //manda alterações pro banco
        for($i = 0; $i< sizeof($ordemBusca); $i++){
        $query = "UPDATE receitas_ingredientes SET ordem = $ordemBusca[$i] WHERE id = $idBusca[$i]";  
        $run = mysqli_query($conexao,$query) or die("Não foi possível conectar");
        }
    } 
    
    fecharBanco($conexao);

    alerta('Excluido com sucesso!');  
}

//alterar ordem dos ingredientes em uma receita
function caixaSelecaoOrdem($var){
    $valor = $_POST['idReceita'];
    echo "<select class = 'form-select' id = 'inputReceita' name='$var'>";
    echo    "<option>Selecione</option>";
            $run = conectarReceitasIngredientes($valor);
            while($row = mysqli_fetch_assoc($run)){
    echo            "<option value=". $row['id']. ">".
                    $row['ordem'] . " - " . $row['descricao']; 
    echo            "</option>";
            }
    echo  "</select>"; 
}

function alterarOrdemIngredientesReceita(){
    $id1 = $_POST['id1'];
    $id2 = $_POST['id2'];

    $conexao = conectarBanco();

    $query = "SELECT ordem FROM receitas_ingredientes WHERE id = $id1 OR id = $id2";
    $run= mysqli_query($conexao,$query) or die("Não foi possível conectar");

    while($row = mysqli_fetch_assoc($run)){
        $varOrdem[] = $row['ordem'];    
    }

    if($varOrdem[0] == $varOrdem[1]){
        alerta('Mesmos itens!');    
    }else{
        if($varOrdem[1]>$varOrdem[0]){
            $query = "UPDATE receitas_ingredientes SET ordem = $varOrdem[0]  WHERE id = $id2 ";
            $run = mysqli_query($conexao,$query) or die("Não foi possível conectar");
    
            $query = "UPDATE receitas_ingredientes SET ordem = $varOrdem[1]  WHERE id = $id1 ";
            $run = mysqli_query($conexao,$query) or die("Não foi possível conectar");
        }else{
            $query = "UPDATE receitas_ingredientes SET ordem = $varOrdem[0]  WHERE id = $id2 ";
            $run = mysqli_query($conexao,$query) or die("Não foi possível conectar");
    
            $query = "UPDATE receitas_ingredientes SET ordem = $varOrdem[1]  WHERE id = $id1 ";
            $run = mysqli_query($conexao,$query) or die("Não foi possível conectar");
        }
        alerta('Ordem alterada!');
    }
    
    

    fecharBanco($conexao);
}

//alterar quantidade dos ingredientes em uma receita
function alteraQunatIngredientes(){
    $conexao = conectarBanco();

    $idIngre = $_POST['novaQuant'];
    $novaQuant = $_POST['novaQuantValor'];

    $query = "UPDATE receitas_ingredientes SET quant = $novaQuant WHERE id = $idIngre ";
    $run = mysqli_query($conexao,$query) or die("Não foi possível conectar");

    fecharBanco($conexao);

    alerta('Quantidade alterada!');
}

/*-------------=+*-_-*+=---___FIM__---=+*-_-*+=-------------*/