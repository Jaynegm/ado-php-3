<?php
try {
    include "abrir_transação.php";
    include_once "operações.php";

    session_start();
    if (!$_SESSION["username"]) {
        header("Location: login.php");
        exit();
    }

    function validar($sabor) {
        if (!isset($sabor["nome"]) || !is_string($sabor["nome"]) || strlen($sabor["nome"]) > 30) {
            return "Nome inválido ou longo demais";
        }
             
        if (strlen($sabor["ingredientes"]) < 4) return "Ingredientes muito curtos";
        if (((float) $sabor["preco_sem_borda"]) <= 0) return "Tem que ter preço sem borda";
        if (((float) $sabor["preco_com_borda"]) <= 0) return "Tem que ter preço com borda";
        return "";
    }

    $erros = "";
    $validacaoOk = false;

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $alterar = isset($_GET["chave"]);
        if ($alterar) {
            $chave = $_GET["chave"];
            $sabor = buscar_sabor($chave);
            if ($sabor == null) die("Não existe!");
        } else {
            $chave = "";
            $sabor = [
                "chave" => "",
                "nome" => "",
                "ingredientes" => "",
                "preco_sem_borda" => "",
                "preco_com_borda" => "",
                "doce" => ""
            ];
        }
    } else if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $alterar = isset($_POST["chave"]);
        if ($alterar) {
            $sabor = [
                "chave" => $_POST["chave"],
                "nome" => $_POST["nome"],
                "ingredientes" => $_POST["ingredientes"],
                "preco_sem_borda" => $_POST["preco_sem_borda"],
                "preco_com_borda" => $_POST["preco_com_borda"],
                "doce" => $_POST["doce"] ? '1' : '0',
            ];
            $erros = validar($sabor);
            $validacaoOk = ($erros == "");
            if ($validacaoOk) alterar_sabor($sabor);
        } else {
            $sabor = [
                "nome" => $_POST["nome"],
                "ingredientes" => $_POST["ingredientes"],
                "preco_sem_borda" => $_POST["preco_sem_borda"],
                "preco_com_borda" => $_POST["preco_com_borda"],
                "doce" => $_POST["doce"] ? '1' : '0',
            ];
            $erros = validar($sabor);
            $validacaoOk = ($erros == "");
            if ($validacaoOk) $id = inserir_sabor($sabor);
        }

        if ($validacaoOk) {
            header("Location: listar.php");
            $transacaoOk = true;
        }
    } else {
        die("Método não aceito");
    }

} finally {
    include "fechar_transação.php";
}
?>
