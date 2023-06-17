<?php
try {
    include "abrir_transacao.php";
    include_once "operacoes.php";

    $chave = (int) $_POST["sabor"];
    $id = excluir_sabor($chave);

    header("Location: listar.php");

    $transacaoOk = true;
} catch (Exception $e) {
    // Tratamento de exceção, se necessário
} finally {
    include "fechar_transacao.php";
}


?>
