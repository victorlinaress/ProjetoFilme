<?php
namespace Controller;

use Service\CategoriaService;

class CategoriaController {
    private CategoriaService $categoriaService;

    public function __construct() {
        $this->categoriaService = new CategoriaService();
    }

    public function listar() {
        $categorias = $this->categoriaService->listarCategorias();
        require __DIR__ . '/../View/categorias/listar.php';
    }

    public function criar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = $_POST['nome'] ?? null;

            try {
                $this->categoriaService->criarCategoria($nome);
                header("Location: index.php?controller=Categoria&action=listar");
                exit;
            } catch (\Exception $e) {
                $erro = $e->getMessage();
                require __DIR__ . '/../View/categorias/form.php';
            }
        } else {
            require __DIR__ . '/../View/categorias/form.php';
        }
    }

    public function editar(int $id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = $_POST['nome'] ?? null;
            $this->categoriaService->atualizarCategoria($id, $nome);
            header("Location: index.php?controller=Categoria&action=listar");
            exit;
        } else {
            $categoria = ['id' => $id, 'nome' => $_GET['nome'] ?? '']; 
            require __DIR__ . '/../View/categorias/form.php';
        }
    }

    public function deletar(int $id) {
        $this->categoriaService->deletarCategoria($id);
        header("Location: index.php?controller=Categoria&action=listar");
        exit;
    }
}
