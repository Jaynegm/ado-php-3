<?php

include_once "conectar.php";

function inserir_sabor($sabor) {
    global $pdo;
    $sql = "INSERT INTO sabor_pizza (nome, ingredientes, preco_sem_borda, preco_borda_recheada, doce) " .
            "VALUES (:nome, :ingredientes, :preco_sem_borda, :preco_com_borda, :doce)";
    $pdo->prepare($sql)->execute($sabor);
    return $pdo->lastInsertId();
}

function listar_todos_sabores() {
    global $pdo;
    $sql = "SELECT * FROM sabor_pizza";
    $resultados = [];
    $consulta = $pdo->query($sql);
    while ($linha = $consulta->fetch()) {
        $resultados[] = $linha;
        for ($i = 0; isset($linha["$i"]); $i++) {
            unset($linha["$i"]);
        }
    }
    return $resultados;
}

function buscar_sabor($chave) {
    global $pdo;
    $sql = "SELECT * FROM sabor_pizza WHERE chave = :chave";
    $resultados = [];
    $consulta = $pdo->prepare($sql);
    $consulta->execute(["chave" => $chave]);
    return $consulta->fetch();
}