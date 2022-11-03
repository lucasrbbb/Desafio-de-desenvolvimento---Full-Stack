<?php 
include_once('5__funcoes.php');

//REQUISIÇÕES INGREDIENTES

//inserirIngredientes
if (isset($_POST['inserir'])){
    inserirIngredientes();
}

//excluirIngrendientes
if (isset($_POST['excluir'])){

    $valor = $_POST['listaIngExc'];

    if($valor == 'Selecione'){
        erro();
    }

    $cont = verificarIngredientes();

    if($cont == 0){
        excluirIngredientes();
    }else{
        alerta('Ingredientes usados em receitas não podem ser deletados, primeiro apague as receitas com os mesmos'); ;
    }
    
}

//editarIngredientes
if (isset($_POST['editar'])){
    $valor = $_POST['listaIngEdit'];

    if($valor == 'Selecione'){
        erro();
    }else{
        editarIngredientes();
    }
}

//REQUISIÇÕES RECEITAS

//inserirReceitas
if (isset($_POST['criarReceita'])){
    inserirReceita();
}

//excluirReceita
if (isset($_POST['excluirReceita'])){
    $valor = $_POST['excluiRec'];

    if($valor == 'Selecione'){
        erro();
    }else{
        excluirReceitas();
    }
}

//editarReceitas
if (isset($_POST['editarReceita'])){
    $valor = $_POST['EditaRec'];

    if($valor == 'Selecione'){
        erro();
    }else{
        editarReceitas();
    }
}

//REQUISIÇÕES RECEITAS_INGREDIENTES

//inserirIngredientesEmReceitas
if (isset($_POST['inserirIngredienteEmReceita'])){
    $valor1 = $_POST['idReceita'];
    $valor2 = $_POST['listaIngredientes'];

    if(($valor1 == 'Selecione'|| $valor2 == 'Selecione')){
        erro();
    }else{
        inserirReceita_Ingrediente();
    }
} 

//ExcluirIngredientesEmReceitas
if (isset($_POST['escolheIngExcluir'])){
    excluirIngredientesReceita();
} 

//alterarOrdemIngredientesEmReceitas
if (isset($_POST['alteraOrdem'])){
    alterarOrdemIngredientesReceita();
} 

//alterar quantidade dos ingredientes em uma receita
if (isset($_POST['alteraQuantidade'])){
    alteraQunatIngredientes();
} 