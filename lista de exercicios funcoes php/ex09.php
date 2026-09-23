<?php

function buscarCliente(array $clientes, string $nome): ?array
{
	foreach ($clientes as $cliente) {
		if ($cliente['nome'] === $nome) {
			return $cliente;
		}
	}

	return null;
}

$clientes = [
	[
		'nome' => 'Ana Souza',
		'email' => 'ana@example.com',
	],
	[
		'nome' => 'Bruno Lima',
		'email' => 'bruno@example.com',
	],
];

echo "Cliente encontrado:\n";
var_dump(buscarCliente($clientes, 'Ana Souza'));

echo "Cliente não encontrado:\n";
var_dump(buscarCliente($clientes, 'Carlos Mendes'));

?>
