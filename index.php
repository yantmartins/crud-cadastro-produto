<?php
require './App/Entity/Produto.php';

if(isset($_POST['cadastrar'])) {

    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $cor = $_POST['cor'];
    $preco = $_POST['preco'];

    // Verifica se o arquivo foi enviado corretamente
    if(isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $arquivo = $_FILES['foto'];
        $pasta = './uploads/fotos/';
        $nome_foto = $arquivo['name'];
        $novo_nome = uniqid();
        $extensao = strtolower(pathinfo($nome_foto, PATHINFO_EXTENSION));

        // Verifica se a extensão do arquivo é permitida
        $extensoes_permitidas = ['png', 'jpg', 'jpeg', 'jfif'];
        if (!in_array($extensao, $extensoes_permitidas)) {
            die("Extensão do arquivo inválida");
        }

        // Define o caminho do arquivo
        $caminho = $pasta . $novo_nome . '.' . $extensao;
        $upload_sucesso = move_uploaded_file($arquivo['tmp_name'], $caminho);

        if (!$upload_sucesso) {
            die("Erro ao salvar o arquivo.");
        }

    } else {
        die("Erro: Nenhuma foto foi enviada ou ocorreu um erro no upload.");
    }

    $objProduct = new Produto();
    $objProduct->nome = $nome;
    $objProduct->descricao = $descricao;
    $objProduct->cor = $cor;
    $objProduct->preco = $preco;
    $objProduct->foto = $caminho; // Definir corretamente a propriedade foto

    $res = $objProduct->cadastrar();
    if($res){
        echo '<script> alert("Cadastrado com sucesso!")</script>';
    } else {
        echo '<script> alert("ERROR")</script>';
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
    <h1>Cadastro de Produto</h1>
    <form method="POST" enctype='multipart/form-data'>
        <input type="text" id="nome" name="nome" placeholder="Informe o nome do produto">
        <br>
        <input type="text" id="descricao" name="descricao" placeholder="Digite a descrição do produto">
        <br>
        <input type="text" id="cor" name="cor" placeholder="Informe a cor do produto">
        <br>
        <input type="number" id="preco" name="preco" placeholder="Informe o preço do produto">
        <br>
        <input type="file" id="foto" name="foto">
        <br>
        <input type="submit" name="cadastrar" value="Cadastrar">
    </form>
</body>
</html>