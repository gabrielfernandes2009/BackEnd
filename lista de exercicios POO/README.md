Parte A: Questões Teóricas de Fixação
Procedural vs. OO: Quais são os três principais riscos técnicos de manter regras financeiras críticas implementadas puramente
 através de arrays associativos e scripts procedurais?

Ciclo de Vida do Objeto: O que ocorre na memória Heap do servidor quando a instrução new ContaCorrente(...) é executada? 

Qual é o papel do método __construct() nesse processo?

A Pseudo-Variável $this: Explique por que o comando $this->saldo é obrigatório para acessar um atributo dentro da classe, diferenciando-o de uma variável local $saldo.
Encapsulamento e Invariantes: Por que um desenvolvedor sênior de back-end nunca deve criar um método public function setSaldo(float $novoSaldo) para uma conta bancária? 

Modificadores de Acesso: Qual é a diferença prática entre os modificadores private e protected quando subclasses entram em cena através do extends? 

Constructor Property Promotion: Como o recurso de promoção de propriedades introduzido no PHP 8 reduz o boilerplate e melhora a legibilidade do código? 

Propriedades readonly: Explique o mecanismo de segurança proporcionado pela palavra-chave readonly em atributos de classes de valor como Titular ou CPF. 

Classes Abstratas: Por que faz todo sentido no modelo bancário que a classe ContaBancaria seja declarada como abstract enquanto ContaCorrente e ContaPoupanca são classes concretas? 

Polimorfismo: Como o método transferir(float $valor, ContaBancaria $destino) consegue operar transferências entre quaisquer tipos de contas filhas sem precisar saber qual é a classe exata da conta de destino? 

Exceções de Domínio: Por que é uma péssima prática retornar false ou null quando uma operação de saque é rejeitada por falta de saldo?
 

 ### Parte A — Questões Teóricas de Fixação

1. **Procedural vs. OO:** Três riscos de implementar regras financeiras com arrays e scripts procedurais são:
   - **Dados inconsistentes:** diferentes trechos do programa podem alterar o saldo sem respeitar as regras da conta.
   - **Polimorfismo:** a mesma classe mais pode ter funçoes diferentes.
   - **Manutenção e testes difíceis:** quando nos temos a prgramação procedural o codigo fica mais extenso e dependendo de quantas linhas tiver fica mais dificil fazer o tratamento de dados e identificar os erros.

2. **Ciclo de vida do objeto:** Ao executar `new ContaCorrente(...)`, o PHP instância uma classe na memória e inicializa suas propriedades. A expressão retorna a criação do  objeto. Durante a criação, o método `__construct()` é chamado para inicializá-lo — por exemplo, atribuindo os dados iniciais e validando eles .

3. **A variavel atual `$this`:** `$this` representa o objeto atual. Portanto, `$this->saldo` acessa a propriedade `saldo` . Já `$saldo`, sem `$this->`, é uma variável local do método e não se refere automaticamente à propriedade.

4. **Encapsulamento e invariantes:** Um método público `setSaldo()` permitiria mudar o saldo sem aplicar regras de negócio, como as validações de depósito, saque ou transferência. Isso pode deixar a conta em um estado inválido. O saldo deve ser alterado por operações controladas, como `depositar()` e `sacar()`.

5. **`private` e `protected`:** Uma propriedade `private` só pode ser acessada pela classe que a declarou. Uma propriedade `protected` também pode ser acessada pelas classes filhas. Nenhuma das duas fica diretamente acessível por código externo à classe e à sua hierarquia.

6. **Constructor Property Promotion:** Desde o PHP 8, é possível declarar uma propriedade diretamente nos parâmetros do construtor, como em `public function __construct(private string $nome) {}`. Isso evita repetir a declaração do atributo e sua atribuição no corpo do construtor, reduzindo o código repetitivo.

7. **Propriedades `readonly`:** Uma propriedade `readonly` pode ser inicializada uma vez e não pode ser reatribuída depois. Isso é útil para dados que devem permanecer estáveis, como um CPF. A restrição impede a reatribuição da propriedade, mas não torna automaticamente imutável o estado interno de um objeto mutável armazenado nela.

8. **Classes abstratas:** `ContaBancaria` pode concentrar atributos e comportamentos comuns sem ser instanciada diretamente. `ContaCorrente` e `ContaPoupanca` são concretas porque representam tipos específicos de conta e podem definir comportamentos próprios.

9. **Polimorfismo:** Como `transferir()` recebe o destino como `ContaBancaria`, pode trabalhar com qualquer instância de uma classe filha que respeite esse tipo. Assim, não precisa verificar se o destino é uma `ContaCorrente` ou `ContaPoupanca`; cada classe pode fornecer seu comportamento específico.

10. **Exceções de domínio:** Retornar `false` ou `null` não deixa claro por que o saque foi rejeitado e facilita que o chamador ignore a falha. Uma exceção de domínio comunica explicitamente a condição — por exemplo, saldo insuficiente — e permite tratá-la de forma apropriada.