<?php
require './App/Entity/Produto.php';

if(isset($_POST['cadastrar'])){

    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $cor = $_POST['cor'];
    $preco = $_POST['preco'];
}

$arquivo = $_FILES['foto'];
if($arquivo['error']) die ("Falha ao enviar a foto");
$pasta = './uploads/fotos';
$nome_foto = $arquivo['name'];
$novo_nome = uniqid();
$extensao = strtolower(pathinfo($nome_foto, PATHINFO_EXTENSION));

if ($extensao != 'pgn' && $extensao != 'jpg' && $extensao != 'jfif') die ("Extensão do arquivo inválida");
$caminho = $pasta . $novo_nome . '.' .$extensao;
$foto = move_uploaded_file($arquivo['tmp_name'], $caminho);

echo $caminho;
echo "<br>".$foto;

$objProduct = new Produto();
$objProduct->nome = $nome;
$objProduct->descricao = $descricao;
$objProduct->cor = $cor;
$objProduct->preco = $preco;

print_r($objProduct);
$res = $objProduct->cadastrar();
if($res){
    echo '<script> alert("Cadastrado com sucesso!")</script>';
}else{
    echo '<script> alert("ERROR")</script';
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