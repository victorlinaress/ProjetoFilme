<?php
namespace DAO;
use Generic\MySqlFactory;

class FilmeDAO
{
    private MySqlFactory $factory;

    public function __construct()
    {
        $this->factory = new MySqlFactory();
    }

    public function listarFilmes()
    {
        $sql = "SELECT * FROM filmes";
        return $this->factory->banco
            ->executar($sql)
            ->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function inserir(string $titulo, int $ano_lancamento)
    {
        $sql = "INSERT INTO filmes (titulo, ano_lancamento) VALUES (:titulo, :ano_lancamento)";
        return $this->factory->banco->executar($sql, [
            ':titulo'         => $titulo,
            ':ano_lancamento' => $ano_lancamento
        ]);
    }

    public function atualizarFilme(int $id, string $titulo, int $ano_lancamento)
    {
        $sql = "UPDATE filmes 
                SET titulo = :titulo, ano_lancamento = :ano_lancamento 
                WHERE id = :id";
        return $this->factory->banco->executar($sql, [
            ':id'             => $id,
            ':titulo'         => $titulo,
            ':ano_lancamento' => $ano_lancamento
        ]);
    }

    public function deletarFilme(int $id)
    {
        $sql = "DELETE FROM filmes WHERE id = :id";
        return $this->factory->banco->executar($sql, [
            ':id' => $id
        ]);
    }

    public function buscarPorId(int $id)
    {
        $sql = "SELECT * FROM filmes WHERE id = :id";
        return $this->factory->banco
            ->executar($sql, [':id' => $id])
            ->fetch(\PDO::FETCH_ASSOC);
    }
}
