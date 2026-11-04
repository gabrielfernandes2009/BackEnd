

Resumo das respostas no `readme.md`:

 1 -  O MVC artesanal ajuda a entender o fluxo da aplicação e a separação de responsabilidades; ao estudar Laravel, esses conceitos passam a ser mais claros.
2 -   O Laravel 11 mudou a inicialização da aplicação para o foco em bootstrap/app.php e bootstrap/providers.php, deixando a estrutura mais moderna para projetos novos.
3 -   Credenciais e segredos não devem ficar em arquivos versionados; o ideal é usar .env e variáveis de ambiente, seguindo o princípio do 12-Factor App.
4 -   A APP_KEY é crucial para criptografia e sessão; trocar sem cuidado pode quebrar dados criptografados e invalidar cookies/sessões.
5 -   A raiz pública do servidor deve ser a pasta public/, para evitar expor arquivos sensíveis do projeto.
6 -   php artisan comando é melhor do que php arquivo.php para tarefas ligadas ao Laravel, porque carrega a aplicação completa e convenções do framework.
7 -   O .env.example deve ser sempre atualizado para documentar variáveis necessárias e evitar falhas de configuração em novos ambientes.
8 -   Blade com {{ $variavel }} faz escape automatico, enquanto {!! $variavel !!} exibe HTML bruto e deve ser usado apenas com conteúdo confiável.
9 -   Controllers devem ser enxutos e delegar regras de negócio para serviços ou outros pontos apropriados; isso melhora teste, reutilização e manutenção.
10 -   O Tinker permite explorar a aplicação em tempo real e testar comandos, modelos e serviços, mas deve ser usado com atenção em ambientes reais.

