<?php
namespace DAO;
use Generic\MySqlFactory;

class AvaliacaoDAO
{

    public function __construct()
    {
        $this->factory = new MySqlFactory();
    }

    public function inserir($id_usuario, $id_filme, $nota, $comentario)
    {
        $sql = "INSERT INTO avaliacoes (id_usuario, id_filme, nota, comentario) VALUES (:id_usuario, :id_filme, :nota, :comentario)";
        return $this->factory->banco->executar($sql, [
            ':id_usuario' => $id_usuario,
            ':id_filme' => $id_filme,
            ':nota' => $nota,
            ':comentario' => $comentario
        ]);
    }

    public function listarAvaliacoesPorFilme($id_filme)
    {
        $sql = "SELECT * FROM avaliacoes WHERE id_filme = :id_filme";
        return $this->factory->banco->executar($sql, [':id_filme' => $id_filme])->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function deletarAvaliacao($id)
    {
        $sql = "DELETE FROM avaliacoes WHERE id = :id";
        return $this->factory->banco->executar($sql, [':id' => $id]);
    }
    public function atualizarAvaliacao($id, $nota, $comentario)
    {
        $sql = "UPDATE avaliacoes SET nota = :nota, comentario = :comentario WHERE id = :id";
        return $this->factory->banco->executar($sql, [
            ':id' => $id,
            ':nota' => $nota,
            ':comentario' => $comentario
        ]);
    }
    public function buscarPorId($id)
    {
        $sql = "SELECT * FROM avaliacoes WHERE id = :id";
        return $this->factory->banco->executar($sql, [':id' => $id])->fetch(\PDO::FETCH_ASSOC);
    }

}