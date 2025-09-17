<?php
namespace Controller;

use Service\FilmeService;
use Service\CategoriaService;

class FilmeController {
    private FilmeService $filmeService;
    private CategoriaService $categoriaService;

    public function __construct() {
        $this->filmeService = new FilmeService();
        $this->categoriaService = new CategoriaService(); // usado para carregar categorias no formulário
    }

    public function listar() {
        $filmes = $this->filmeService->listarFilmes();
        require __DIR__ . '/../View/filmes/listar.php';
    }

    public function criar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titulo       = $_POST['titulo'] ?? null;
            $descricao    = $_POST['descricao'] ?? null;
            $categoria_id = $_POST['categoria_id'] ?? null;
            $ano          = $_POST['ano'] ?? null;

            try {
                $this->filmeService->criarFilme($titulo, $descricao, (int)$categoria_id, (int)$ano);
                header("Location: index.php?controller=Filme&action=listar");
                exit;
            } catch (\Exception $e) {
                $erro = $e->getMessage();
                $categorias = $this->categoriaService->listarCategorias();
                require __DIR__ . '/../View/filmes/form.php';
            }
        } else {
            $categorias = $this->categoriaService->listarCategorias();
            require __DIR__ . '/../View/filmes/form.php';
        }
    }

    public function editar(int $id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titulo       = $_POST['titulo'] ?? null;
            $descricao    = $_POST['descricao'] ?? null;
            $categoria_id = $_POST['categoria_id'] ?? null;
            $ano          = $_POST['ano'] ?? null;

            $this->filmeService->atualizarFilme($id, $titulo, $descricao, (int)$categoria_id, (int)$ano);
            header("Location: index.php?controller=Filme&action=listar");
            exit;
        } else {
            $filme = ['id' => $id, 'titulo' => $_GET['titulo'] ?? '', 'descricao' => $_GET['descricao'] ?? '', 'categoria_id' => $_GET['categoria_id'] ?? '', 'ano' => $_GET['ano'] ?? ''];
            $categorias = $this->categoriaService->listarCategorias();
            require __DIR__ . '/../View/filmes/form.php';
        }
    }

    public function deletar(int $id) {
        $this->filmeService->deletarFilme($id);
        header("Location: index.php?controller=Filme&action=listar");
        exit;
    }
}
