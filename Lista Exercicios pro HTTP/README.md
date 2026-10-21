 Exercícios Teóricos de Fixação
Diferença Estrutural: Explique a diferença física entre onde os dados são anexados em uma requisição GET e em uma requisição POST.
Segurança e Privacidade: Por que senhas de usuário nunca devem ser enviadas via método GET? Cite pelo menos dois locais onde essa senha ficaria gravada de forma insegura.
Coalescência Nula: Por que a instrução $nome = $_POST['nome']; dispara um Warning na primeira vez que a página é carregada no navegador? Como o operador ?? resolve isso?
Idempotência: O que significa dizer que uma requisição GET é idempotente? Por que atualizar ou deletar dados no banco usando links GET é uma má prática de segurança?
Validação Client vs Server: Um desenvolvedor júnior afirma que o formulário dele é 100% seguro porque colocou required e type="email" em todas as tags HTML. Explique por que essa afirmação é falsa.
XSS e Sanitização: Qual é o risco de exibir dados vindos de um $_POST diretamente na tela sem utilizar htmlspecialchars()?
Sticky Forms: O que é a técnica de Sticky Forms e qual é o seu impacto na experiência do usuário (UX)?
DevTools: Como você utilizaria a aba Network do navegador para comprovar que um formulário foi enviado via POST e não via GET?
  
   
   ## Respostas 
    
    1. **Diferença estrutural — GET e POST**  
   Em uma requisição **GET**, os dados são anexados à URL, geralmente após `?`, como parâmetros de consulta: `pagina.php?nome=Ana`. Em uma requisição **POST**, os dados são enviados no corpo (*body*) da requisição, separados da URL.

2. **Segurança e privacidade**  
   Senhas não devem ser enviadas por GET porque podem aparecer na URL e ficar registradas no **histórico do navegador**, em **logs de servidores** e de proxies, ou ser expostas ao compartilhar ou copiar o link. Usar POST evita que o valor vá na URL, mas **não substitui HTTPS**: sem HTTPS, os dados ainda podem ser interceptados durante o envio.

3. **Coalescência nula (`??`)**  
   Na primeira abertura da página, o formulário ainda não foi enviado, então a chave `nome` pode não existir em `$_POST`. Acessá-la diretamente gera um *Warning*. O operador `??` permite definir um valor padrão quando a chave não existe ou é nula:
   ```php
   $nome = $_POST['nome'] ?? '';
   ```

4. **Idempotência e uso de GET para alterar dados**  
   Uma requisição GET é considerada **idempotente** quando repeti-la não muda o resultado pretendido depois da primeira execução. GET deve servir para consultar dados, não para atualizar ou excluir. Links podem ser acessados por engano, pré-carregados por navegadores ou rastreadores e repetidos; isso poderia causar alterações indesejadas. Para ações que modificam dados, use métodos apropriados, como POST, com proteção contra requisições forjadas quando necessário.

5. **Validação no cliente e no servidor**  
   `required` e `type="email"` ajudam a orientar o usuário, mas são validações do navegador e podem ser contornadas — por exemplo, enviando a requisição diretamente, sem usar o formulário. O servidor deve validar os dados novamente antes de processá-los.

6. **XSS e `htmlspecialchars()`**  
   Exibir diretamente um valor recebido por `$_POST` pode permitir que conteúdo malicioso seja interpretado como HTML ou JavaScript no navegador, causando **XSS**. Ao exibir texto em HTML, escape-o, por exemplo:
   ```php
   echo htmlspecialchars($valor, ENT_QUOTES, 'UTF-8');
   ```

7. **Sticky Forms**  
   É a técnica de preencher novamente os campos com os valores que o usuário já havia digitado, por exemplo, quando o formulário falha na validação. Isso evita que a pessoa tenha de redigitar tudo e melhora a experiência. Os valores devem ser escapados antes de serem inseridos no HTML.

8. **Comprovar POST no DevTools**  
   Abra as ferramentas do desenvolvedor, vá à aba **Network** (Rede) e envie o formulário. Selecione a requisição correspondente e verifique o campo **Request Method**: deve mostrar `POST`. Confira também se os dados aparecem em **Payload** ou **Form Data**, e não como parâmetros na URL.