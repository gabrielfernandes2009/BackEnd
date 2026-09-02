<?php
declare(strict_types=1);
$notas = [7.5, 8.0, 6.5, 9.0, 5.5];
$soma = array_sum($notas); 
$quantidade = count($notas); 
$media = $soma / $quantidade; 
echo "a media do aluno é: ". number_format($media, 2, ',' , '.');  

// Comandos Usados 
// array_sum() soma  os valores dentro array    
// cont() serve para contar quantos elementos tem dentro do array 
// echo para copiar a media do aluno 
// nu