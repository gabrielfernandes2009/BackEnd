<?php
function aplicarDesconto(float &$preco, float $porcentagem): void
{
	$preco -= $preco * ($porcentagem / 100);
}

$preco = 200.00;

echo "Valor antes do desconto: R$ " . number_format($preco, 2, ',', '.') . PHP_EOL;

aplicarDesconto($preco, 15);

echo "Valor depois do desconto: R$ " . number_format($preco, 2, ',', '.') . PHP_EOL;
?>
