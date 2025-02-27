<?php
require './App/Entity/Produto.php';

if(isset($_POST['cadastrar'])){

    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $cor = $_POST['cor'];
    $preco = $_POST['preco'];
}