<?php

function calcularIMC(float $peso, float $altura): float
{
	return $peso / ($altura * $altura);
}

$testes = [
	[70.0, 1.75],
	[60.0, 1.65],
	[90.0, 1.80],
];

foreach ($testes as [$peso, $altura]) {
	printf("Peso: %.2f kg | Altura: %.2f m | IMC: %.2f\n", $peso, $altura, calcularIMC($peso, $altura));
}

