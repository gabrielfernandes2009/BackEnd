<?php

function retirarEstoque(array &$produto, int $quantidade): bool
{
	if ($quantidade <= 0 || !isset($produto['estoque']) || $quantidade > $produto['estoque']) {
		return false;
	}

	$produto['estoque'] -= $quantidade;

	return true;
}

$produto = [
	'nome' => 'Teclado',
	'estoque' => 10,
];

echo retirarEstoque($produto, 3) ? "Retirada permitida\n" : "Retirada recusada\n";
echo "Estoque atual: {$produto['estoque']}\n";

echo retirarEstoque($produto, 8) ? "Retirada permitida\n" : "Retirada recusada\n";
echo "Estoque atual: {$produto['estoque']}\n";

?>
