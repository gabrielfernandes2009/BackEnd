<?php
declare(strict_types=1);

echo <<<'TXT'
Exercício 6 — XSS e htmlspecialchars()

Pergunta:
Qual é o risco de exibir dados vindos de um $_POST diretamente na tela sem
utilizar htmlspecialchars()?

Resposta:
Exibir diretamente um valor recebido por $_POST pode permitir que conteúdo
malicioso seja interpretado como HTML ou JavaScript no navegador, causando
XSS. Ao exibir texto em HTML, escape-o, por exemplo:

echo htmlspecialchars($valor, ENT_QUOTES, 'UTF-8');
TXT;
