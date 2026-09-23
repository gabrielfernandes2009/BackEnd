<?php

function senhaForte(string $senha): bool
{
	return strlen($senha) > 8;
}

$senha = "minhaSenha";

if (senhaForte($senha)) {
	echo "A senha é forte.";
} else {
	echo "A senha é fraca.";
}

?>
