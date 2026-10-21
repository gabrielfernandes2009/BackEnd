<?php
declare(strict_types=1);

echo <<<'TXT'
Exercício 5 — Validação no cliente e no servidor

Pergunta:
Um desenvolvedor júnior afirma que o formulário dele é 100% seguro porque
colocou required e type="email" em todas as tags HTML. Explique por que essa
afirmação é falsa.

Resposta:
required e type="email" ajudam a orientar o usuário, mas são validações do
navegador e podem ser contornadas, por exemplo, enviando a requisição
diretamente, sem usar o formulário. O servidor deve validar os dados
novamente antes de processá-los.
TXT;
