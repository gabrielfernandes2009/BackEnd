<?php

function calcularCarrinho(array $produtos): float
{
	$total = 0;

	foreach ($produtos as $produto) {
		$total += $produto['preco'] * $produto['quantidade'];
	}

	return $total;
}

$produtos = [
	['nome' => 'Caderno', 'preco' => 25.00, 'quantidade' => 2],
	['nome' => 'Caneta', 'preco' => 3.50, 'quantidade' => 4],
];

echo number_format(calcularCarrinho($produtos), 2, '.', '');

