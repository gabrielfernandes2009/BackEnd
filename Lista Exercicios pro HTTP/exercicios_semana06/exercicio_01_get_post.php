<?php
declare(strict_types=1);

echo <<<'TXT'
Exercício 1 — Diferença estrutural entre GET e POST

Pergunta:
Explique a diferença física entre onde os dados são anexados em uma requisição
GET e em uma requisição POST.

Resposta:
Em uma requisição GET, os dados são anexados à URL, geralmente depois de “?”,
como parâmetros de consulta: pagina.php?nome=Ana. Em uma requisição POST, os
dados são enviados no corpo (body) da requisição, separados da URL.
TXT;
