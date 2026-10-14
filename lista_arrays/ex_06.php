<?php
declare(strict_types=1);

$extrato = [
    ["data" => "2026-09-01", "descricao" => "Salário", "tipo" => "Entrada", "valor" => 4000.00],
    ["data" => "2026-09-02", "descricao" => "Supermercado", "tipo" => "Saida", "valor" => 450.50],
    ["data" => "2026-09-05", "descricao" => "Pix João", "tipo" => "Entrada", "valor" => 200.00],
    ["data" => "2026-09-10", "descricao" => "Conta de Luz", "tipo" => "Saida", "valor" => 120.00],
    ["data" => "2026-09-12", "descricao" => "Cinema", "tipo" => "Saida", "valor" => 65.00],
];

$totalEntradas = 0.0;
$totalSaidas = 0.0;

foreach ($extrato as $transacao) {
    if ($transacao["tipo"] === "Entrada") {
        $totalEntradas += $transacao["valor"];
    } elseif ($transacao["tipo"] === "Saida") {
        $totalSaidas += $transacao["valor"];
    }
}

$saldo = $totalEntradas - $totalSaidas;
$limiteGastoAlto = 300.00;
$gastosAltos = array_filter(
    $extrato,
    fn(array $transacao): bool => $transacao["tipo"] === "Saida"
        && $transacao["valor"] > $limiteGastoAlto
);

$formatarMoeda = static fn(float $valor): string => "R$ " . number_format($valor, 2, ",", ".");
$escapar = static fn(string $valor): string => htmlspecialchars($valor, ENT_QUOTES, "UTF-8");
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Extrato bancário - Setembro 2026</title>
    <style>
        :root {
            color-scheme: light;
            font-family: Arial, sans-serif;
            background: #f5f5f7;
            color: #25252b;
        }
        body { margin: 0; padding: 32px 20px; }
        main { max-width: 960px; margin: 0 auto; }
        h1 { margin-top: 0; }
        .cards { display: grid; grid-template-columns: repeat(auto-fit, minmax(210px, 1fr)); gap: 16px; }
        .card, .painel { background: #fff; border-radius: 12px; padding: 20px; box-shadow: 0 3px 12px rgba(0, 0, 0, .06); }
        .card h2 { margin: 0 0 12px; color: #686873; font-size: 1rem; font-weight: 500; }
        .valor { margin: 0; font-size: 1.5rem; font-weight: 700; }
        .entrada { color: #16835d; }
        .saida { color: #c03958; }
        .saldo { color: #6924a5; }
        .painel { margin-top: 24px; overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; text-align: left; }
        th, td { padding: 14px 12px; border-bottom: 1px solid #eee; white-space: nowrap; }
        th { color: #686873; font-size: .9rem; }
        tbody tr:last-child td { border-bottom: 0; }
        .tipo { font-weight: 600; }
        .nota { color: #686873; font-size: .9rem; }
    </style>
</head>
<body>
    <main>
        <h1>Extrato bancário</h1>
        <p>Resumo financeiro de setembro de 2026</p>

        <section class="cards" aria-label="Resumo financeiro">
            <article class="card">
                <h2>Total de entradas</h2>
                <p class="valor entrada"><?= $formatarMoeda($totalEntradas) ?></p>
            </article>
            <article class="card">
                <h2>Total de saídas</h2>
                <p class="valor saida"><?= $formatarMoeda($totalSaidas) ?></p>
            </article>
            <article class="card">
                <h2>Saldo do período</h2>
                <p class="valor saldo"><?= $formatarMoeda($saldo) ?></p>
            </article>
        </section>

        <section class="painel" aria-labelledby="titulo-extrato">
            <h2 id="titulo-extrato">Movimentações</h2>
            <table>
                <thead>
                    <tr>
                        <th scope="col">Data</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Valor</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($extrato as $transacao): ?>
                        <tr>
                            <td><?= $escapar(date("d/m/Y", strtotime($transacao["data"]))) ?></td>
                            <td><?= $escapar($transacao["descricao"]) ?></td>
                            <td class="tipo <?= $transacao["tipo"] === "Entrada" ? "entrada" : "saida" ?>">
                                <?= $escapar($transacao["tipo"]) ?>
                            </td>
                            <td><?= $formatarMoeda($transacao["valor"]) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>

        <section class="painel" aria-labelledby="titulo-gastos-altos">
            <h2 id="titulo-gastos-altos">Gastos altos</h2>
            <p class="nota">Saídas acima de <?= $formatarMoeda($limiteGastoAlto) ?>.</p>
            <?php if ($gastosAltos !== []): ?>
                <ul>
                    <?php foreach ($gastosAltos as $gasto): ?>
                        <li>
                            <?= $escapar($gasto["descricao"]) ?>:
                            <?= $formatarMoeda($gasto["valor"]) ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>Nenhum gasto acima do limite neste período.</p>
            <?php endif; ?>
        </section>
    </main>
</body>
</html>