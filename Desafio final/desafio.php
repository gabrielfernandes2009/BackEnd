<?php
declare(strict_types=1);

// ==========================================
// CONFIGURAÇÕES E DADOS MOCKADOS
// ==========================================

const CATEGORIAS_PERMITIDAS = ['Eletrônicos', 'Mecânica', 'Consumíveis', 'Serviços'];
const CONDICOES_PAGAMENTO = ['À Vista', '30 dias', '60 dias', '90 dias'];

$cotacoesAbertas = [
    [
        'id' => 1,
        'fornecedor' => 'Eletro Parts Ltda',
        'email' => 'contato@eletroparts.com.br',
        'categoria' => 'Eletrônicos',
        'descricao' => 'Bobinas de cobre 2mm - 100kg',
        'valor' => 4500.00,
        'prazo' => 7,
        'condicao' => '30 dias',
        'data_abertura' => '2026-09-10'
    ],
    [
        'id' => 2,
        'fornecedor' => 'Peças Mecânicas do Brasil',
        'email' => 'vendas@pecasmec.com.br',
        'categoria' => 'Mecânica',
        'descricao' => 'Rolamentos de esferas NSK 6204',
        'valor' => 1250.50,
        'prazo' => 5,
        'condicao' => 'À Vista',
        'data_abertura' => '2026-09-12'
    ],
    [
        'id' => 3,
        'fornecedor' => 'Supply Express',
        'email' => 'compras@supplyexpress.com.br',
        'categoria' => 'Consumíveis',
        'descricao' => 'Óleo hidráulico ISO 46 - 200L',
        'valor' => 2100.00,
        'prazo' => 3,
        'condicao' => '60 dias',
        'data_abertura' => '2026-09-15'
    ],
    [
        'id' => 4,
        'fornecedor' => 'Serviços Técnicos SENAI',
        'email' => 'servicos@senaigeral.com.br',
        'categoria' => 'Serviços',
        'descricao' => 'Manutenção preventiva - 40h',
        'valor' => 3200.00,
        'prazo' => 1,
        'condicao' => '30 dias',
        'data_abertura' => '2026-09-14'
    ],
    [
        'id' => 5,
        'fornecedor' => 'Eletrônicos Avançados SA',
        'email' => 'vendas@eletravanc.com.br',
        'categoria' => 'Eletrônicos',
        'descricao' => 'Transformador 10kVA 220/110',
        'valor' => 8750.00,
        'prazo' => 15,
        'condicao' => '90 dias',
        'data_abertura' => '2026-09-11'
    ],
    [
        'id' => 6,
        'fornecedor' => 'Plásticos Industriais',
        'email' => 'venda@plasticosindustriais.com.br',
        'categoria' => 'Consumíveis',
        'descricao' => 'Tubos PVC 75mm - 50 metros',
        'valor' => 650.00,
        'prazo' => 2,
        'condicao' => 'À Vista',
        'data_abertura' => '2026-09-13'
    ],
    [
        'id' => 7,
        'fornecedor' => 'Automação Industrial Plus',
        'email' => 'suporte@autoplus.com.br',
        'categoria' => 'Eletrônicos',
        'descricao' => 'CLP Siemens S7-1200',
        'valor' => 15800.00,
        'prazo' => 21,
        'condicao' => '60 dias',
        'data_abertura' => '2026-09-09'
    ],
    [
        'id' => 8,
        'fornecedor' => 'Consultoria Técnica Premium',
        'email' => 'info@consultoriatech.com.br',
        'categoria' => 'Serviços',
        'descricao' => 'Auditoria de processos - 3 dias',
        'valor' => 5600.00,
        'prazo' => 5,
        'condicao' => '30 dias',
        'data_abertura' => '2026-09-08'
    ]
];

// ==========================================
// FUNÇÕES ISOLADAS (REUTILIZÁVEIS)
// ==========================================

function filtrarCotacoes(array $cotacoes, string $fornecedor = '', ?float $valorMaximo = null): array {
    return array_filter($cotacoes, function($cotacao) use ($fornecedor, $valorMaximo) {
        if ($fornecedor !== '' && stripos($cotacao['fornecedor'], $fornecedor) === false) {
            return false;
        }
        if ($valorMaximo !== null && $valorMaximo > 0.0 && $cotacao['valor'] > $valorMaximo) {
            return false;
        }
        return true;
    });
}

function validarCotacao(array $dados): array {
    $erros = [];

    if (strlen(trim($dados['nome_fornecedor'] ?? '')) < 5) {
        $erros['nome_fornecedor'] = 'O nome do fornecedor deve ter no mínimo 5 caracteres.';
    }

    if (!filter_var($dados['email_fornecedor'] ?? '', FILTER_VALIDATE_EMAIL)) {
        $erros['email_fornecedor'] = 'Informe um e-mail corporativo válido.';
    }

    if (!in_array($dados['categoria_produto'] ?? '', CATEGORIAS_PERMITIDAS, true)) {
        $erros['categoria_produto'] = 'Selecione uma categoria permitida.';
    }

    if (strlen(trim($dados['descricao_item'] ?? '')) < 10) {
        $erros['descricao_item'] = 'A descrição deve ter no mínimo 10 caracteres.';
    }

    // Limpeza de string monetária (remove R$ e ajusta separadores para formato float padrão)
    $valorRaw = $dados['valor_cotacao'] ?? '';
    $valorRaw = str_replace(['R$', ' ', '.'], '', $valorRaw);
    $valorRaw = str_replace(',', '.', $valorRaw);
    $valor = filter_var($valorRaw, FILTER_VALIDATE_FLOAT);

    if ($valor === false || $valor <= 0) {
        $erros['valor_cotacao'] = 'Informe um valor positivo em R$.';
    }

    $prazo = filter_var($dados['prazo_entrega_dias'] ?? '', FILTER_VALIDATE_INT);
    if ($prazo === false || $prazo < 1 || $prazo > 60) {
        $erros['prazo_entrega_dias'] = 'O prazo deve estar entre 1 e 60 dias.';
    }

    if (!in_array($dados['condicoes_pagamento'] ?? '', CONDICOES_PAGAMENTO, true)) {
        $erros['condicoes_pagamento'] = 'Selecione uma condição de pagamento válida.';
    }

    return $erros;
}

function s(string $valor): string {
    return htmlspecialchars($valor, ENT_QUOTES, 'UTF-8');
}


// CONTROLE DE FLUXO (PROCESSAMENTO)

$filtroFornecedor = '';
$filtroValor = null;
$erros = [];
$sucesso = false;
$formPost = [];

// Estado inicial da tabela com todos os dados mockados
$cotacoesExibidas = $cotacoesAbertas;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formPost = $_POST;
    $erros = validarCotacao($formPost);
    
    if (empty($erros)) {
        $sucesso = true;
        
        // Formata o valor monetário tratado para simular inserção
        $valorTratado = str_replace(['R$', ' ', '.'], '', $formPost['valor_cotacao']);
        $valorTratado = (float) str_replace(',', '.', $valorTratado);

        // Simulando persistência na lista em memória para exibição em tela imediata
        $novaCotacao = [
            'id' => count($cotacoesAbertas) + 1,
            'fornecedor' => trim($formPost['nome_fornecedor']),
            'email' => trim($formPost['email_fornecedor']),
            'categoria' => $formPost['categoria_produto'],
            'descricao' => trim($formPost['descricao_item']),
            'valor' => $valorTratado,
            'prazo' => (int)$formPost['prazo_entrega_dias'],
            'condicao' => $formPost['condicoes_pagamento'],
            'data_abertura' => date('Y-m-d')
        ];
        array_unshift($cotacoesAbertas, $novaCotacao);
        $cotacoesExibidas = $cotacoesAbertas;
        
        // Limpa o formulário após o sucesso
        $formPost = [];
    }
}

// Executado no GET ou se falhar o POST mantém os filtros do GET ativos no recarregamento
if (isset($_GET['fornecedor']) || isset($_GET['valor_max'])) {
    $filtroFornecedor = trim($_GET['fornecedor'] ?? '');
    $valMaxRaw = $_GET['valor_max'] ?? '';
    $filtroValor = $valMaxRaw !== '' ? filter_var($valMaxRaw, FILTER_VALIDATE_FLOAT) : null;
    
    $cotacoesExibidas = filtrarCotacoes($cotacoesAbertas, $filtroFornecedor, $filtroValor !== false ? $filtroValor : null);
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SupplyChain SENAI - Autoatendimento</title>
    <style>
        :root {
            --primary: #1e3799;
            --primary-hover: #0c2461;
            --success: #27ae60;
            --error: #e74c3c;
            --bg: #f5f6fa;
            --text: #2f3640;
        }
        :not(html) { box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { background-color: var(--bg); color: var(--text); margin: 0; padding: 20px; }
        .container { max-width: 1100px; margin: 0 auto; }
        header { background: var(--primary); color: white; padding: 20px; border-radius: 8px; margin-bottom: 20px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        header h1 { margin: 0; font-size: 24px; }
        header p { margin: 5px 0 0 0; opacity: 0.8; }
        
        .card { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); margin-bottom: 20px; }
        .card-title { font-size: 18px; margin-top: 0; margin-bottom: 15px; color: var(--primary); border-bottom: 2px solid #eee; padding-bottom: 8px; }
        
        .filter-form { display: grid; grid-template-columns: 2fr 1fr auto auto; gap: 15px; align-items: flex-end; }
        
        .form-group { display: flex; flex-direction: column; margin-bottom: 15px; }
        .form-group label { font-weight: 600; margin-bottom: 5px; font-size: 14px; }
        .form-control { padding: 10px; border: 1px solid #ccc; border-radius: 4px; font-size: 14px; width: 100%; }
        .form-control:focus { border-color: var(--primary); outline: none; box-shadow: 0 0 4px rgba(30, 55, 153, 0.3); }
        
        .btn { padding: 10px 20px; border: none; border-radius: 4px; font-weight: bold; cursor: pointer; font-size: 14px; transition: background 0.2s; text-decoration: none; text-align: center; }
