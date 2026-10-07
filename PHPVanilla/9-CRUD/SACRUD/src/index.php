<?php
declare(strict_types=1);

//controller de dados

require_once __DIR__ . "/src/ConexaoBanco.php";
require_once __DIR__ . "/src/PecaDAO.php";

//constante de Configuração (.ini)
const CONFIG_PATH = __DIR__ . "/config/database.ini";

//função para tratamento de impressão de valores textuais
function e(string $valor):string{
    return htmlspecialchars($valor, ENT_QUOTES, "UTF-8");
}

//função para validar os campos do formulário
function validarFormularioPeca(array $dados): array {
    $erros=[];//recebe os erros

    if(empty($dados["codigo_sku"]) || strlen(trim($dados["codigo_sku"]))<3 ){
        $erros[] = "O código SKU deve possuir no mínimo 3 caracteres.";
    }
    if(empty($dados["descricao"]) || strlen(trim($dados["descricao"]))<5 ){
        $erros[] = "A descrição deve possuir no mínimo 5 caracteres.";
    }
    if(!isset($dados["quantidade"]) || (int)$dados["quantidade"] < 0 ){
        $erros[] = "A quantidade não pode ser um valor negativo";
    }
    if(!isset($dados["preco_unitario"]) || (float)$dados["preco_unitario"]<= 0 ){
        $erros[] = "Infomre um preço válido e positivo";
    }
    return $erros;
}

//Iniciar o Controller(Iniciar a Camada de Conexão e Modificação de Dados)
$pdo = ConexaoBanco::obterConexao(CONFIG_PATH);
//criar um objeto da Classe DAO
$pecaDAO = new PecaDAO($pdo); //objeto que permite fazer o CRUD

$erros = [];
$feedback="";
$acao = $_POST["acao"] ?? $_GET["acao"] ?? "";
$pecaEdicao = null;

//Processamento do CRUD
if($_SERVER["REQUEST_METHOD"] === "POST" && $acao === "salvar"){
    $erros = validarFormularioPeca($_POST);
    //Se não tiver erros
    if(empty($erros)){
        $id = (int)($_POST["id"] ?? 0);
        //se id > 0 , produto existe no banco (atualizar), caso contraio (salvar)
        $sucesso = ($id>0) ? $pecaDAO->atualizar($id, $_POST) : $pecaDAO->salvar($_POST); //operador ternário
        $feedback = $sucesso ? "Registro persistido com sucesso no banco" : "Falha na persistência";
    }
}elseif($acao === "excluir" && isset($_GET["id"])){
    $idExcluir = (int)$_GET["id"];
    $feedback = $pecaDAO->excluir($idExcluir) ? "Peça removida do sistema com sucesso" : "Falha ao excluir";
}elseif($acao === editar)

?>