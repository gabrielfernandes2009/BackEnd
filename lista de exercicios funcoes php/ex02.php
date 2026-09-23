<?php
declare(strict_types=1);

function classificarIMC(float $imc): string
{
	if ($imc < 18.5) {
		return "Abaixo do peso";
	} elseif ($imc < 25.0) {
		return "Peso normal";
	} elseif ($imc < 30.0) {
		return "Sobrepeso";
	} else {
		return "Obesidade";
	}
}
