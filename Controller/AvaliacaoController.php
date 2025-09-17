<?php
namespace Controller;

use Service\AvaliacaoService;
use Service\FilmeService;
use Service\CategoriaService;

class AvaliacaoController {
    private AvaliacaoService $avaliacaoService;
    private FilmeService $filmeService;
    private CategoriaService $categoriaService;

    public function __construct() {
        $this->avaliacaoService = new AvaliacaoService();
        $this->filmeService = new FilmeService();
        $this->categoriaService = new CategoriaService();
    }

    public function listar() {
        $avaliacoes = $this->avaliacaoService->listarAvaliacoes();
        require __DIR__ . '/../View/avaliacoes/listar.php';
    }

    public function criar() {
        $filmes = $this->filmeService->listarFilmes();
        $categorias = $this->categoriaService->listarCategorias();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $filme_id     = $_POST['filme_id'] ?? null;
            $categoria_id = $_POST['categoria_id'] ?? null;
            $nota         = $_POST['nota'] ?? null;

            try {
                $this->avaliacaoService->criarAvaliacao(
                    (int)$filme_id,
                    (int)$categoria_id,
                    (int)$nota,
                    $_POST['comentario'] ?? ''
                );

                header("Location: index.php?controller=Avaliacao&action=listar");
                exit;
            } catch (\Exception $e) {
                $erro = $e->getMessage();
                require __DIR__ . '/../View/avaliacoes/form.php';
            }
        } else {
            require __DIR__ . '/../View/avaliacoes/form.php';
        }
    }

    public function editar(int $id) {
        $filmes = $this->filmeService->listarFilmes();
        $categorias = $this->categoriaService->listarCategorias();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nota = $_POST['nota'] ?? null;
            $comentario = $_POST['comentario'] ?? '';

            try {
                $this->avaliacaoService->atualizarAvaliacao($id, (int)$nota, $comentario);
                header("Location: index.php?controller=Avaliacao&action=listar");
                exit;
            } catch (\Exception $e) {
                $erro = $e->getMessage();
                $avaliacao = $this->avaliacaoService->buscarAvaliacaoPorId($id);
                require __DIR__ . '/../View/avaliacoes/form.php';
            }
        } else {
            $avaliacao = $this->avaliacaoService->buscarAvaliacaoPorId($id);
            require __DIR__ . '/../View/avaliacoes/form.php';
        }
    }

    public function deletar(int $id) {
        try {
            $this->avaliacaoService->deletarAvaliacao($id);
            header("Location: index.php?controller=Avaliacao&action=listar");
            exit;
        } catch (\Exception $e) {
            $erro = $e->getMessage();
            $avaliacoes = $this->avaliacaoService->listarAvaliacoes();
            require __DIR__ . '/../View/avaliacoes/listar.php';
        }
    }
}
