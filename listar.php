<?php
require './App/Entity/Produto.php';

$prods = new Produto();
$products = $prods->buscar();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        #foto_perfil{
            width: 30%;
            border-radius: 50%;
        }
    </style>
</head>
<body>
    <h1>Produtos</h1>
    
    <table border="1" collapse="collapse">
        <tr>
            <td>ID</td>
            <td>Foto</td>
            <td>Nome</td>
            <td>Descricao</td>
            <td>Cor</td>
            <td>Preco</td>
            <td>Editar</td>
            <td>Excluir</td>
        </tr>

        <?php
        foreach($products as $pro){
            echo '
            <tr>
                <td> '. $pro->id_categoria .'</td>
                <td> <img id="foto_perfil" src="' .$pro->foto . '"> </td>
                <td> '. $pro->nome .' </td>
                <td> '. $pro->descricao .' </td>
                <td> '. $pro->cor .' </td>
                <td> '. $pro->preco .' </td>
                <td> <a href="./editar_prod.php?id_categoria='. $pro->id_categoria . '"> Editar </a> </td>
                <td> <a href="./excluir_prod.php?id_categoria='. $pro->id_categoria . '"> Excluir </a> </td>
            </tr>
            ';    
            }
        ?>    
    </table>
</body>
</html>