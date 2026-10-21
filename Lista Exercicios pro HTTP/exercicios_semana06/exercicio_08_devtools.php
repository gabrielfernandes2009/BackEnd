<?php
declare(strict_types=1);

echo <<<'TXT'
Exercício 8 — DevTools

Pergunta:
Como você utilizaria a aba Network do navegador para comprovar que um
formulário foi enviado via POST e não via GET?

Resposta:
Abra as ferramentas do desenvolvedor, vá à aba Network (Rede) e envie o
formulário. Selecione a requisição correspondente e verifique o campo
Request Method: deve mostrar POST. Confira também se os dados aparecem em
Payload ou Form Data, e não como parâmetros na URL.
TXT;
