<?php

declare(strict_types=1);

$peso = 85.5;
$altura = 1.75;

$imc = $peso / ($altura * $altura); 
//$imc = $peso/ $altura**2;

if ($imc < 18.5) {
    $classificacao = "Abaixo do peso";
} elseif ($imc >= 18.5 && $imc < 25) {
    $classificacao = "Peso normal";
} elseif ($imc >= 25 && $imc < 30) {
    $classificacao = "Sobrepeso";
} elseif ($imc >= 30 && $imc < 35) {
    $classificacao = "Obesidade grau I";
} elseif ($imc >= 35 && $imc < 40) {
    $classificacao = "Obesidade grau II";
} else {
    $classificacao = "Obesidade grau III";
}

echo "Peso: $peso kg<br>";
echo "Altura: $altura m<br>";
echo "IMC: " . number_format($imc, 2, ',', '.') .;
echo "Classificação: $classificacao";

?>
