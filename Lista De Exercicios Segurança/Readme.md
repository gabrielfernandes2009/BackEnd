Exercicios teoricos Segurança e higienização de dados. 
 
 ### Parte A: Exercícios Teóricos de Fixação

1. **Conceituação OWASP:** XSS significa *Cross-Site Scripting*. A vulnerabilidade ocorre quando conteúdo não confiável é interpretado pelo navegador como código, em vez de dados. É chamada de *Client-Side* porque o código malicioso é executado no navegador da vítima. O Back-End deve prevenir isso validando dados e, principalmente, codificando-os corretamente ao inseri-los na resposta.

2. **Reflected vs. Stored:** No XSS refletido, o conteúdo malicioso chega em uma requisição e é devolvido na resposta sem codificação adequada; costuma depender de a vítima acessar uma página ou link preparado. No XSS armazenado, o conteúdo fica salvo — por exemplo, em um comentário — e pode ser exibido a vários usuários. O armazenado geralmente tem maior potencial de estrago, pois pode atingir muitas pessoas repetidamente.

3. **Mecanismo de escapamento:** `htmlspecialchars()` converte caracteres especiais em entidades HTML. Por exemplo, `<` vira `&lt;` e `>` vira `&gt;`. Assim, o navegador exibe esses sinais como texto, em vez de interpretá-los como delimitadores de uma tag HTML; o conteúdo não é tratado como marcação executável.

4. **Flag `ENT_QUOTES`:** Ela determina que aspas simples e duplas também sejam convertidas em entidades HTML. Em um atributo como `<input value="...">`, escapar as aspas duplas ajuda a impedir que um valor não confiável encerre o atributo e introduza outros atributos. Sem a flag, a proteção contra aspas simples pode variar conforme a versão e as opções padrão do PHP. É mais seguro especificar explicitamente as flags e o conjunto de caracteres.

5. **`FILTER_SANITIZE_STRING`:** Esse filtro foi descontinuado no PHP 8.1 e removido no PHP 8.3. Além disso, não é uma proteção geral contra XSS: “limpar” uma string sem considerar onde ela será usada pode alterar dados legítimos e ainda deixar riscos. Valide conforme a regra do campo e codifique os dados no contexto em que serão exibidos.

6. **Validação de e-mail:** `empty($email)` verifica apenas se o valor está vazio (ou é considerado vazio pelo PHP); não verifica se tem formato de e-mail. `filter_var($email, FILTER_VALIDATE_EMAIL)` verifica se a string tem um formato aceito como endereço de e-mail. Isso não confirma que o endereço existe nem que a pessoa controla essa caixa postal.

7. **Roubo de sessão:** Se um site vulnerável executar código injetado no navegador, esse código pode tentar acessar informações disponíveis à página, inclusive cookies que não estejam protegidos com `HttpOnly`. Se o cookie de sessão for obtido, pode permitir que outra pessoa tente se passar pelo usuário. A flag `HttpOnly` impede o acesso ao cookie por scripts, mas não impede que um XSS realize outras ações em nome da vítima enquanto a sessão estiver ativa.

8. **Segurança em camadas:** `strip_tags()` tenta remover tags HTML, mas não é uma solução universal: o resultado depende do conteúdo e do uso, e a string pode ser inserida em contextos diferentes, como HTML, atributos ou JavaScript. Por isso, é necessário codificar na saída de acordo com o contexto — por exemplo, usar `htmlspecialchars()` ao inserir texto em HTML. A validação na entrada e a codificação na saída cumprem funções distintas e complementares.