# Exercicios teoricos: funcoes PHP

## 1. Conceito de funcao

Uma funcao e um bloco de codigo criado para executar uma tarefa especifica. Ela pode receber dados, processa-los e retornar um resultado.

Duas vantagens de dividir um programa em funcoes sao:

- **Reutilizacao:** a mesma logica pode ser chamada varias vezes sem ser reescrita.
- **Organizacao e manutencao:** cada funcao concentra uma responsabilidade, facilitando a leitura, os testes e as alteracoes.

## 2. Principio DRY

DRY significa *Don't Repeat Yourself* (nao se repita). Repetir o mesmo bloco de codigo em varias partes aumenta o risco de corrigir ou atualizar uma parte e esquecer as outras. Isso pode causar comportamentos diferentes e mais erros de manutencao.

Uma funcao evita essa repeticao porque concentra a regra em um unico lugar. As outras partes do sistema chamam a funcao sempre que precisam executar aquela regra.

## 3. Parametros e retorno

Um **parametro** e uma entrada definida na declaracao da funcao. Ele recebe um valor quando a funcao e chamada.

O **valor retornado** e o resultado produzido pela funcao e enviado de volta para o ponto em que ela foi chamada. No exemplo:

```php
function calcularTotal(float $preco, int $quantidade): float {
	return $preco * $quantidade;
}
```

`$preco` e `$quantidade` sao parametros, com tipos `float` e `int`. O tipo `float` depois dos parenteses indica que a funcao deve retornar um numero decimal. A expressao `return $preco * $quantidade` calcula e devolve o total.

## 4. Tipagem

Na declaracao `function cadastrar(string $nome, int $idade): bool`:

- `function` indica a declaracao de uma funcao.
- `cadastrar` e o nome da funcao.
- `$nome` e um parametro do tipo `string`.
- `$idade` e um parametro do tipo `int`.
- `bool` e o tipo do valor que a funcao deve retornar, ou seja, `true` ou `false`.

## 5. `void` e `return`

Uma funcao que retorna `string` deve produzir e devolver um texto para quem a chamou:

```php
function obter saudacao(): string {
	return "Ola, Mariana!";
}

echo obter saudacao();
```

Uma funcao `void` executa uma acao, mas nao devolve um valor utilizavel. Ela pode usar `return;` apenas para encerrar a execucao antecipadamente:

```php
function exibirMensagem(): void {
	echo "Cadastro realizado.";
}

exibirMensagem();
```

> Observacao: em PHP, nomes de funcoes nao podem conter espacos. A forma correta do primeiro exemplo e `obterSaudacao()`:

```php
function obterSaudacao(): string {
	return "Ola, Mariana!";
}
```

## 6. Escopo

`$cliente` foi criada no escopo global. Por padrao, uma funcao possui escopo local e nao acessa automaticamente variaveis globais. Por isso, o codigo abaixo gera um aviso de variavel indefinida e nao retorna o valor esperado.

Uma primeira forma de corrigir e usar `global` dentro da funcao:

```php
$cliente = "Mariana";

function exibirCliente(): string {
	global $cliente;
	return $cliente;
}
```

Outra forma, mais recomendada, e passar o valor como parametro:

```php
$cliente = "Mariana";

function exibirCliente(string $cliente): string {
	return $cliente;
}

echo exibirCliente($cliente);
```

Passar o dado como parametro deixa a dependencia explicita, reduz o acoplamento e facilita testes. Por isso, essa e a alternativa recomendada.

## 7. Referencia

Em `float &$valor`, o `&` indica que o parametro e passado **por referencia**. A funcao recebe acesso a mesma variavel original, e nao uma copia dela.

```php
function aplicarTaxa(float &$valor): void {
	$valor *= 1.1;
}

$preco = 100.0;
aplicarTaxa($preco);
// $preco agora vale 110.0
```

Sem o `&`, a funcao alteraria apenas uma copia local e `$preco` continuaria valendo `100.0`. Com o `&`, a alteracao feita dentro da funcao tambem modifica a variavel original.

## 8. Cinco funcoes nativas do PHP

| Funcao | Categoria | Finalidade | Parametros principais | Valor retornado |
|---|---|---|---|---|
| `strlen($string)` | Strings | Conta a quantidade de bytes de uma string | A string a ser medida | `int` |
| `strtolower($string)` | Strings | Converte letras para minusculas | A string de entrada | `string` |
| `count($array)` | Arrays | Conta os elementos de um array ou de um objeto contavel | O array ou objeto | `int` |
| `is_numeric($value)` | Verificacao de tipos | Verifica se um valor e um numero ou uma string numerica | O valor a verificar | `bool` |
| `array_merge($array1, ...$arrays)` | Arrays | Une dois ou mais arrays | Dois ou mais arrays | `array` |

## 9. Previsao de saida

```text
90
100
```

`aplicarDesconto(100.00)` calcula `100.00 * 0.90`, portanto retorna `90.00`. Em seguida, `echo $valor` exibe `100.00`, porque a funcao recebeu o preco por valor e nao alterou a variavel original. Como os dois `echo` nao possuem espacos nem quebra de linha, a saida exata do codigo, em uma pagina HTML, pode aparecer visualmente como `90100`.

## 10. Documentacao oficial de `strlen()`

De acordo com a documentacao oficial do PHP ([strlen](https://www.php.net/manual/en/function.strlen.php)):

```php
strlen(string $string): int
```

- **Parametro:** `$string`, uma string cuja quantidade de bytes sera contada.
- **Retorno:** um valor do tipo `int` com a quantidade de bytes da string.
- **Importante:** `strlen()` conta bytes, e nao necessariamente caracteres. Para contar caracteres multibyte, como os acentuados em UTF-8, deve-se considerar `mb_strlen()`.
