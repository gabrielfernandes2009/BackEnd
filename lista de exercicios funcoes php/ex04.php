<?php
function formatarNome(string $nome): string
{
	return ucfirst(strtolower(trim($nome)));
}

$nomes = [
	'  GABRIEL  ',
	'mArIa',
	' joao ',
];

foreach ($nomes as $nome) {
	echo formatarNome($nome) . PHP_EOL;
}
?>
