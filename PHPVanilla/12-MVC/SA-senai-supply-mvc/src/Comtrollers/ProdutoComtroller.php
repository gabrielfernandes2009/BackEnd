<?php
declare(strict_types=1);

final class ProdutoController extends Controller {

    //listar todos os produtos
    public function listar():void {
        //armazenar os produtos em um vetor
        $produtos = Produto::listarTodos();
        $this->renderizar("produtos/listar", [
            "titulo" => "Catálogo Geral de Insumos/Produtos",
            "produto" => $produtos
        ]);
    }

    //formulário para cadastrar novos produtos
    public function formulario():void {
        $this->renderizar("produtos/criar",[
            "titulo" => "Cadastrar Novo Produto",
            "csrfToken" => $this->obterCsrfToken()
        ]);
    }


    //salvar produtos
    public function salvar(): void {
        if (!$this->validarCsrfToken($_POST['csrf_token'] ?? null)) {
            $this->renderizar('produtos/criar', ['titulo' => 'Novo Insumo', 'erro' => 'Falha CSRF.']);
            return;
        }
        $nome = trim($_POST['nome'] ?? '');
        $cat  = trim($_POST['categoria'] ?? '');
        $preco = (float)($_POST['preco'] ?? 0.0);
        $est  = (int)($_POST['estoque'] ?? 0);

        if ($nome !== '' && $cat !== '' && $preco > 0.0 && $est >= 0) {
            Produto::salvar($nome, $cat, $preco, $est);
            Logger::info("Novo insumo cadastrado no almoxarifado", ['nome' => $nome, 'categoria' => $cat]);
            $this->redirecionar('/produtos');
        }
        $this->renderizar('produtos/criar', [
            'titulo'    => 'Novo Insumo',
            'erro'      => 'Preencha todos os campos corretamente.',
            'csrfToken' => $this->obterCsrfToken()
        ]);
    }

} 