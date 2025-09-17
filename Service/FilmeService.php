<?php
namespace Service;

class FilmeService {
    private FilmeDAO $filmeDAO;

    public function __construct() {
        $this->filmeDAO = new FilmeDAO();
    }

    public function listarFilmes() {
        return $this->filmeDAO->listarFilmes();
    }

    public function criarFilme($titulo, $descricao, $categoria_id, $ano) {
        if (empty($titulo)) {
            throw new \InvalidArgumentException("O título do filme não pode ser vazio.");
        }
        if (empty($descricao)) {
            throw new \InvalidArgumentException("A descrição do filme não pode ser vazia.");
        }
        if (empty($categoria_id)) {
            throw new \InvalidArgumentException("A categoria do filme não pode ser vazia.");
        }
        if (!is_numeric($ano) || $ano < 1800 || $ano > intval(date("Y"))) {
            throw new \InvalidArgumentException("O ano informado é inválido.");
        }
        return $this->filmeDAO->inserir($titulo, $descricao, $categoria_id, $ano);
    }

    public function atualizarFilme($id, $titulo, $descricao, $categoria_id, $ano) {
        return $this->filmeDAO->atualizarFilme($id, $titulo, $descricao, $categoria_id, $ano);
    }

    public function deletarFilme($id) {
        return $this->filmeDAO->deletarFilme($id);
    }
}