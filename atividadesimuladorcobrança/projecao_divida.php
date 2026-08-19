<?php
//criar O sistema deve avaliar a Categoria do Cliente ('A', 'B', 'C') utilizando a estrutura match e definir a taxa de juros

//Categoria 'A' ➔ Juros de 0.01 (1% ao mês)

//Categoria 'B' ➔ Juros de 0.02 (2% ao mês)

//Categoria 'C' ➔ Juros de 0.03 (3% ao mês)

// Qualquer outra coisa (default) ➔ Juros de 0.05 (5% - Risco Máximo)  


//Resolução


def calcular_juros (categoria_cliente):


// nesta linha, eu usei def de definition para definir a função

//  e depois eu usei def calcular_juros(categoria_cliente): para criar uma função chamada calcular_juros que aceita um dado chamado categoria_cliente.



match categoria.upper():



// nesta linha , eu usei match por que ele(Analisa o valor que esta na variavel)  categoria.

// e depois eu usei upper por que ele comverte  letras minusculas (string) em maiusculas



        case 'A':

            taxa_juros = 0.01


// nesta linha eu usei case 'A': para definir o caso em que a categoria do cliente é 'A' e depois eu usei return = 0.01 para retornar a taxa de juros correspondente a essa categoria, que é 0.01 (1% ao mês).

             

        case 'B':

            taxa_juros = 0.02  

            // nesta linha eu usei case 'B': para definir o caso em que a categoria do cliente é 'B' e depois eu usei taxa_juros = 0.02 para definir a taxa de juros correspondente a essa categoria, que é 0.02 (2% ao mês).

        case 'C':

            taxa_juros = 0.03

           //nesta linha eu usei case 'C': para definir o caso em que a categoria do cliente é 'C' e depois eu usei taxa_juros = 0.03 para definir a taxa de juros correspondente a essa categoria, que é 0.03 (3% ao mês).

        case _:

            taxa_juros = 0.05  # Default / Risco Máximo



            // nesta linha eu usei case _: para definir o caso padrão, ou seja, quando a categoria do cliente não se encaixa em nenhuma das categorias específicas, e depois eu usei taxa_juros = 0.05 para definir a taxa de juros correspondente a essa categoria, que é 0.05 (5% - Risco Máximo).

    return taxa_juros

 //codigo completo



 def calcular_juros(categoria_cliente):

    match categoria.upper():

        case 'A':

            taxa_juros = 0.01

        case 'B':

            taxa_juros = 0.02  

        case 'C':

            taxa_juros = 0.03

        case _:

            taxa_juros = 0.05  # Default / Risco Máximo

    return taxa_juros



 // Projeção da Dívida: Você deve usar um laço for para gerar exatamente 12 meses de dívida.


//projeção da divida em 12 meses


def projetar_divida(valor_inicial, categoria_cliente):

    taxa = calcular_juros(categoria_cliente)

    valor_atual = valor_inicial



     print(f" --- Projeção da Dívida (Categoria: {categoria_cliente.upper()}) ---")

print(f"Valor Inicial: R$ {valor_inicial:.2f}")

    print(f"Taxa de Juros: {taxa * 100:.2f}% ao mês")

    print("Mês\tValor da Dívida")

    for mes in range(1, 12):        



        //nesta linha eu usei for mes in range(1, 13): para criar um laço de repetição que vai de 1 a 12, representando os 12 meses do ano.



        valor_atual += valor_atual * taxa  



        //nesta linha eu usei valor_atual += valor_atual * taxa para atualizar o valor da dívida a cada mês, aplicando a taxa de juros correspondente à categoria do cliente.

        print(f"{mes}\tR$ {valor_atual:.2f}")



        //nesta linha eu usei print(f"{mes}\tR$ {valor_atual:.2f}") para exibir o mês atual e o valor da dívida atualizado, formatando o valor com duas casas decimais.


// Cálculo: Todo mês, o valor da dívida sofre um aumento. A fórmula de cada mês é: Juros do Mês = Dívida Atual * Taxa. O saldo atualizado passa a ser Dívida Atual + Juros do Mês

     

juros ao mes


        def calcular_juros(categoria_cliente):

   

    taxas = {

        "bronze": 0.05,   5% ao mês

        "prata": 0.03,    3% ao mês

        "ouro": 0.015     1.5% ao mês

    }

   

    return taxas.get(categoria_cliente.lower(), 0.06)

   

def projetar_divida(valor_inicial, categoria_cliente):

    taxa = calcular_juros(categoria_cliente)

    valor_atual = valor_inicial

   

    print(f"--- Projeção da Dívida (Categoria: {categoria_cliente.upper()}) ---")

    print(f"Valor Inicial: R$ {valor_inicial:.2f}")

    print(f"Taxa de Juros: {taxa * 100:.2f}% ao mês")

    print("Mês\tValor da Dívida")

   

    for mes in range(1, 13):

        valor_atual += valor_atual * taxa

        print(f"{mes}\tR$ {valor_atual:.2f}")
?>
