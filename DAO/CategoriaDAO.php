<?php 
namespace DAO;
use Generic\MySqlFactory;

class CategoriaDAO
{
    private MySqlFactory $factory;

    public function __construct()
    {
        $this->factory = new MySqlFactory();
    }

    public function listarCategorias()
    {
        $sql = "SELECT * FROM categorias";
        return $this->factory->banco->executar($sql)->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function inserir($nome)
    {
        $sql = "INSERT INTO categorias (nome) VALUES (:nome)";
        return $this->factory->banco->executar($sql, [
            ':nome' => $nome
        ]);
    }

    public function atualizarCategoria($id, $nome)
    {
        $sql = "UPDATE categorias SET nome = :nome WHERE id = :id";
        return $this->factory->banco->executar($sql, [
            ':id'   => $id,
            ':nome' => $nome
        ]);
    }

    public function deletarCategoria($id)
    {
        $sql = "DELETE FROM categorias WHERE id = :id";
        return $this->factory->banco->executar($sql, [':id' => $id]);
    }
}