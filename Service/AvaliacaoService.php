<?php 
namespace Service;
use DAO\AvaliacaoDAO;
use Generic\MySqlFactory;           

class AvaliacaoService {
    private AvaliacaoDAO $avaliacaoDAO;
    public function __construct() {
        $this->avaliacaoDAO = new AvaliacaoDAO();
    }

    public function listarAvaliacoes() {
        return $this->avaliacaoDAO->listarAvaliacoes();
    }

    public function criarAvaliacao($usuarioId, $filmeId, $nota, $comentario) {
          if ($nota < 0 || $nota > 10) {
            throw new \InvalidArgumentException("A nota deve ser entre 0 e 10.");
        }
        return $this->avaliacaoDAO->inserir($usuarioId, $filmeId, $nota, $comentario);
    }

    
    public function atualizarAvaliacao($id, $nota, $comentario) {
        return $this->avaliacaoDAO->atualizarAvaliacao($id, $nota, $comentario);
    }

    public function deletarAvaliacao($id) {
        return $this->avaliacaoDAO->deletarAvaliacao($id);
    }

    public function buscarAvaliacaoPorId($id) {
        return $this->avaliacaoDAO->buscarPorId($id);
    }
}