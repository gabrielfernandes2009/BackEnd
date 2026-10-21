<?php
declare(strict_types=1);

echo <<<'TXT'
Exercício 3 — Coalescência nula

Pergunta:
Por que a instrução $nome = $_POST['nome']; dispara um Warning na primeira
vez que a página é carregada no navegador? Como o operador ?? resolve isso?

Resposta:
Na primeira abertura da página, o formulário ainda não foi enviado, então
a chave 'nome' pode não existir em $_POST. Acessá-la diretamente gera um
Warning. O operador ?? permite definir um valor padrão quando a chave não
existe ou é nula:

$nome = $_POST['nome'] ?? '';
TXT;
