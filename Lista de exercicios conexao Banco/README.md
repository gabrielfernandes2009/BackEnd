Exercicios Teoricos de Conexão com Banco de Dados pdo 
 

1. **Abstração de dados:** PDO (*PHP Data Objects*) é uma interface do PHP para acessar diferentes bancos de dados usando uma API comum. Em projetos corporativos, facilita trocar o SGBD e manter o código mais uniforme. Também oferece suporte a consultas preparadas, que ajudam a prevenir SQL injection. Extensões especializadas, como `pgsql`, são específicas do PostgreSQL.

2. **Ciclo do DSN:** DSN (*Data Source Name*) é a string que informa ao PDO como localizar e acessar o banco. Para PostgreSQL, por exemplo:  
   `pgsql:host=localhost;port=5432;dbname=minha_base`  
   - `host`: endereço do servidor do banco;  
   - `port`: porta em que o PostgreSQL está escutando;  
   - `dbname`: nome do banco de dados a acessar.

3. **Padrão de portas:** A porta padrão do PostgreSQL é **5432**. Ela aparece no DSN como `port=5432`. Se o servidor estiver configurado para outra porta, deve-se informar essa porta.

4. **Flags de integridade:** `PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION` faz o PDO lançar uma exceção quando ocorre um erro, permitindo tratá-lo com `try/catch`. Sem configuração explícita, o comportamento depende da versão do PHP: antes do PHP 8.0, o padrão era `PDO::ERRMODE_SILENT`; a partir do PHP 8.0, é `PDO::ERRMODE_EXCEPTION`.

5. **Fetch mode:** `PDO::FETCH_ASSOC` retorna cada linha como um array associativo, usando os nomes das colunas como chaves. Em comparação com `PDO::FETCH_BOTH`, evita manter também chaves numéricas duplicadas, podendo reduzir o uso de memória no PHP. O efeito depende do volume de dados; esse modo não reduz a memória do servidor PostgreSQL.

6. **Padrão Singleton:** Abrir uma conexão com `new PDO()` para cada consulta cria conexões repetidas, que consomem recursos e podem permanecer abertas durante o processamento. Se muitas requisições fizerem isso ao mesmo tempo, o limite `max_connections` do PostgreSQL pode ser atingido. Reutilizar uma conexão dentro do escopo adequado reduz conexões desnecessárias. O Singleton, porém, não compartilha automaticamente a conexão entre processos PHP diferentes.

7. **Encapsulamento do Singleton:** O construtor deve ser `private` para impedir que outras partes do código criem instâncias com `new`. Para proteger a unicidade, costuma-se impedir a clonagem com `__clone()` privado e bloquear a criação de instâncias por desserialização com `__wakeup()` privado — e também `__unserialize()` em versões que o utilizem.

8. **Segurança de credenciais:** Credenciais fixas no código podem vazar por meio do repositório, de cópias de segurança, de logs ou de mensagens de erro. Use variáveis de ambiente ou um gerenciador de segredos, não publique esses valores e conceda à aplicação somente as permissões de banco necessárias.

9. **Tratamento de exceções e LGPD:** Exibir `$e->getMessage()` diretamente no navegador pode revelar informações internas, como nomes de tabelas, consultas, caminhos de arquivos, endereços de servidores ou detalhes da configuração. Isso facilita ataques e pode expor dados protegidos. Registre detalhes técnicos em logs com acesso restrito e mostre ao usuário uma mensagem genérica, sem informações internas.
