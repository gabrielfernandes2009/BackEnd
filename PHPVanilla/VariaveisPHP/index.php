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
    $salario = 1520.68; //

      // Dicas para Criação de Variáveis
    // Não incie o nome de uma variavel com numeros
    // Não utilize espaços em banco
    // Não utilize caracteres especiais, somente o underline
    // Crie variáveis con nomes que ajudrão a identificar melhor a mesma
    // Evite utilizar letras maiúsculas.
    
    echo $nome;
    echo "<br>";
    echo "Idade: +$idade";

      ?>  

</body>
</html>
