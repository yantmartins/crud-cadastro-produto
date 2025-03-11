<?php
require './App/Entity/Produto.php'

if(isset($_GET['id_categoria'])){

    $id = $_GET['id_categoria'];
    $obj = new Produto();

    $prod = $obj->buscar_por_id($id);

    $result = $prod->excluir();
    if($result){
        header('location: ./listar.php');
    }else{
        echo '<script> alert("ERROOOOOOOOO") </script>';
    }
}