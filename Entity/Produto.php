<?php

require './App/DB/Database.php';

class Produto{
    public int $id_categoria;
    public string $nome;
    public string $descricao;
    public string $cor;
    public float $preco;

    public function cadastrar(){

        $db = new Database('products');

        $res = $db->insert(
            [
                'nome'=> $this->nome,
                'descricao'=> $this->descricao,
                'cor'=> $this->cor,
                'preco'=> $this->preco
            ]
        );
        return $res;
    }

    public function buscar($where = null,$order = null,$limit = null){
        $db = new Database('products');

        $res = $db->select($where,$order,$limit)->fetchAll(PDO::FETCH_CLASS,self::class);
        return $res;
    }

    public function buscar_por_id($id){
        $db = new Database('products');
        $where = 'id_categoria =' .$id;
        $res = $db->select($where)->fetchObject(self::class);
        return $res;
    }

    public function atualizar(){
        $db = new Database('products');
        $res = $db->update(
            'id_categoria ='.$this->id_categoria,
            [
                "nome"=> $this->nome,
                "descricao"=> $this->descricao,
                "cor"=> $this->cor,
                "preco"=> $this->preco
            ]
        );
        return $res;
    }

}