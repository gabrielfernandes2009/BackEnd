<?php
declare(strict_types=1);

echo <<<'TXT'
Exercício 4 — Idempotência

Pergunta:
O que significa dizer que uma requisição GET é idempotente? Por que atualizar
ou deletar dados no banco usando links GET é uma má prática de segurança?

Resposta:
Uma requisição GET é considerada idempotente quando repeti-la não muda o
resultado pretendido depois da primeira execução. GET deve servir para
consultar dados, não para atualizar ou excluir. Links podem ser acessados
por engano, pré-carregados por navegadores ou rastreadores e repetidos,
causando alterações indesejadas. Para ações que modificam dados, use métodos
apropriados, como POST, com proteção contra requisições forjadas quando
necessário.
TXT;
