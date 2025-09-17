<?php 
namespace Service;

class CategoriaService {
    private CategoriaDAO $categoriaDAO;
    public function __construct() {
        $this->categoriaDAO = new CategoriaDAO();
    }

    public function listarCategorias() {
        return $this->categoriaDAO->listarCategorias();
    }
    public function criarCategoria($nome) {
        return $this->categoriaDAO->inserir($nome);
    }   


    public function atualizarCategoria($id, $nome) {
        return $this->categoriaDAO->atualizarCategoria($id, $nome);
    }

    public function deletarCategoria($id) {
        return $this->categoriaDAO->deletarCategoria($id);
    }
}