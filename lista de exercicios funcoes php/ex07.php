<?php

function calcularMedia(array $notas): float
{
	if (count($notas) === 0) {
		return 0.0;
	}

	return array_sum($notas) / count($notas);
}

function verificarAprovacao(float $media): string
{
	if ($media >= 7) {
		return 'Aprovado';
	} else {
		return 'Reprovado';
	}
}

$notas = [8.5, 7.0, 6.5, 9.0];
$media = calcularMedia($notas);

echo 'Notas: ' . implode(', ', $notas) . '<br>';
echo 'Média: ' . number_format($media, 2, ',', '.') . '<br>';
echo 'Situação: ' . verificarAprovacao($media) . '<br>';
echo 'Maior nota: ' . max($notas) . '<br>';
echo 'Menor nota: ' . min($notas);

?>
