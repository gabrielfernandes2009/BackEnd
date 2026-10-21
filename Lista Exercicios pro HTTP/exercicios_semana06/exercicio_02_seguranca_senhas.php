<?php
declare(strict_types=1);

echo <<<'TXT'
Exercício 2 — Segurança e privacidade

Pergunta:
Por que senhas de usuário nunca devem ser enviadas via método GET? Cite pelo
menos dois locais onde essa senha ficaria gravada de forma insegura.

Resposta:
Senhas não devem ser enviadas por GET porque podem aparecer na URL e ficar
registradas no histórico do navegador, em logs de servidores e proxies, ou
ser expostas ao compartilhar ou copiar o link. Usar POST evita que o valor
vá na URL, mas não substitui HTTPS: sem HTTPS, os dados ainda podem ser
interceptados durante o envio.
TXT;
