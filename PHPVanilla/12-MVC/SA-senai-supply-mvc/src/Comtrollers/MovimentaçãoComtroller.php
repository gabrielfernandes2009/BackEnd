<?php
declare(strict_types=1);

final class MovimentacaoController extends Controller {

    //fomrulário para registrar movimentação
    public function formulario(): void {
        $produtoId = (int)($_GET['produto_id'] ?? 0);
        $produto = Produto::buscarPorId($produtoId);
        if (!$produto) {
            $this->redirecionar('/produtos');
        }
        $this->renderizar('movimentacoes/novo', [
            'titulo'    => "Movimentar Estoque: {$produto['nome']}",
            'produto'   => $produto,
            'csrfToken' => $this->obterCsrfToken()
        ]);
    }

    //salvar a movimentação


    //listar os histórico de movimentações

}