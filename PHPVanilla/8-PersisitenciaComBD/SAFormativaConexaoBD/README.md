# Criação de uma aplicação para Teste de Conexão PDO com Singleton e PDOException

## Passo 1 - Validando a Extensão `pdo_pgsql` e o Serviço do Postgres

1. Abra o Terminal e digite:
```bash
php -m | findstr -i pgsql
```
*Saída Esperada:* deve listar `pdo_pgsql` e o `pgsql`

Caso não aparece:
- abra o `php.ini`
- Localize a linha `;extension=pdo_pgsql` e remova o ponto e virgula inicial(`;`);
- Salve o arquivo e valide novamente o comando

2. Validando o **PostgreSQL**

Usando a Extensão do VSCode = postgresql -> instalar a extensão Chris Kolkman

## Passo 2 - Estrutura de Diretórios do Projeto

Organize a raiz do projeto exatamente com a seguinte árvore de pastas:

```text
SAFormativaConexaoBD/
├── config/
│   └── database.ini        <- Credenciais protegidas
├── logs/
│   └── database.log        <- Arquivo gerado para auditoria de falhas
├── src/
│   └── ConexaoBanco.php    <- Classe Singleton com PDO para PostgreSQL
├── schema.sql              <- Script DDL e DML para o PostgreSQL
├── index.php               <- Painel de diagnóstico e testes operacionais
└── README.md               <- Documentação do Projeto
```

## Passo 3 - Executando o Script DDL no PostgreSQL (`schema.sql`)


## Passo 4 - Criando a Arquivo de Configuração (`config/database.ini`)

