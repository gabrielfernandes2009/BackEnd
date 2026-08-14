<?php 
declare(strict_types=1);
?>

<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estudo de variaveis</title>
</head>
<body>
    <h1>Estudo de Variaveis</h1> 
    <hr> 
    <?php
   // para criar variáveis em php bata usar o sinal de $
    // variáveis em php são NÃO tipadas, NÃO precisa declarar o tipo (Texto, numeros, booleanas)
    // ao atribuir valor para a variável a tipagem é automática
    $nome = "João"; // criação da variavel nome com o valor textual "João"
    $idade = 25; // criação da variável idade com o valor numérico 25
    $ativo = true; // criação da variável ativo com o valor booleano true
    $salario = 1520.68; // variavel numerica - decimal  (float - double)
    $status = null; // variavel nula 
    //$endereco; // Variavel Undefined, não é possivel declarar uma variavel sem atribuir  um valor a ela, não existe Undefined em PHP


      // Dicas para Criação de Variáveis
    // Não incie o nome de uma variavel com numeros
    // Não utilize espaços em banco
    // Não utilize caracteres especiais, somente o underline
    // Crie variáveis con nomes que ajudrão a identificar melhor a mesma
    // Evite utilizar letras maiúsculas.
    

    //Exibir as variaveis na tela 
    echo "Nome $nome <br>";
    echo "Idade: $idade <br>";
    echo  "Ativo: $ativo <br>";  
    echo  "Salário: $salario <br>";  
    echo  "Status: $status <br>";  

      echo "<br><h3> Constantes </h3><br>";
    // Constantes são representadas pela palavra "const" ou "define" seguidas do nome da constante
    //Exemplos de constantes
    const PI = 3.14; //Constante do Tipo Number (float)
    const EMPRESA = "Google"; //Constatne do Tipo String
    define("SITE", "www.google.com"); //Declaração de Constante do tipo String usando "define"
    // uma boa prática é utilizar letras maiúsculas para nomear constantes, para diferenciar das variáveis

    //Exibir as constantes na tela
    echo "Valor de PI: " . PI . "<br>";
    echo "Nome da Empresa: " . EMPRESA . "<br>";
    echo "Site: " . SITE . "<br>";

    
      // tentar alterar o valor de uma constante, isso irá gerar um erro de código, pois constantes não podem ser alteradas
    // PI = 3.14159; // isso é um erro
    // redeclarar uma constante tamb´me irá gerar um erro
    // const SITE = "www.google.com.br"; //Isso é um Erro
     
     //Regra de ouro: Senpre coloque a intrução " declare(strict_types=1);" no início do código PHP 
     // isso blindara o seu sistema  contra mistura acidental de tipos de dados 
      
       // Ultilização de  texto  (Concatenação Vs interpolação)
       
        // Exemplo de Concatenação => Juntar duas ou mais Strings utilizando p operador "."(ponto)
    echo "Olá, ".$nome ."! Seja bem-vindo ao nosso site! <br>";

    // Exemplo de Interpolação => Utilização de variáveis dentro de um exto, utilizando aspas duplas no texto
    echo "$nome, tem $idade anos e seu salário é R$ $salario reais. <br>";//forma mais correta de misturar texto e variáveis

 
      ?>   
    



</body>
</html>
