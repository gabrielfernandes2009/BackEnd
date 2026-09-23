<?php

function limparCPF(string $cpf): string
{
    return str_replace(['.', '-'], '', $cpf);
}

function cpfValido(string $cpf): bool
{
    $cpfLimpo = limparCPF($cpf);

    if (strlen($cpfLimpo) !== 11) {
        return false;
    }

    if (!is_numeric($cpfLimpo)) {
        return false;
    }

    return true;
}

// Exemplos de uso
$cpf1 = '123.456.789-09';
$cpf2 = '1234567890';

var_dump(limparCPF($cpf1));
echo '<br>';
var_dump(cpfValido($cpf1));
echo '<br>';
var_dump(cpfValido($cpf2));
