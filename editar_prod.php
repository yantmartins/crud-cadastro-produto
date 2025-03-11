<?php
require './App/Entity/Produto.php';

if(isset($_GET['id_categoria'])){

    $id = $_GET['id_categoria'];
    $obj = new Produto();
    $prody = $obj->buscar_por_id($id);
}

if(isset($_POST['editar'])){

    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $cor = $_POST['cor'];
    $preco = $_POST['preco'];

    $prody->nome = $nome;
    $prody->descricao = $descricao;
    $prody->cor = $cor;
    $prody->preco = $preco;

    $res = $prody->atualizar();
    if($res){
        echo '<script> alert("Editado com sucesso!");
        window.location.href= "./listar.php"; </script>';
        exit;
    }else{
        echo '<script> alert("Error!") </script>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Editar Produtos</h1>
    <form method="POST">
        <input type="text" id="nome" name="nome" value="<?=$prody->nome;?>" >
        <br>
        <input type="text" id="descricao" name="descricao" value="<?=$prody->descricao;?>" >
        <br>
        <input type="text" id="cor" name="cor" value="<?=$prody->cor;?>" >
        <br>
        <input type="number" id="preco" name="preco" value="<?=$prody->preco;?>" >
        <br>
        <input type="file" name="foto" id="foto">
        <br>

        <input type="submit"  name="editar" value="Editar">
    </form>
</body>
</html>