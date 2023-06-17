<?php

include_once "conectar.php";

function inserir_sabor($sabor) {
    $pdo = conectar();
    $sql = "INSERT INTO sabor_pizza (nome, ingredientes, dt_inclusao, dt_alteracao, preco_sem_borda, preco_borda_recheada, doce) " .
            "VALUES (:nome, :ingredientes, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, :preco_sem_borda, :preco_com_borda, :doce)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':nome', $sabor['nome']);
    $stmt->bindValue(':ingredientes', $sabor['ingredientes']);
    $stmt->bindValue(':preco_sem_borda', $sabor['preco_sem_borda']);
    $stmt->bindValue(':preco_com_borda', $sabor['preco_com_borda']);
    $stmt->bindValue(':doce', $sabor['doce']);
    $stmt->execute();
    return $pdo->lastInsertId();
}

function listar_todos_sabores() {
    $pdo = conectar();
    $sql = "SELECT * FROM sabor_pizza";
    $resultados = [];
    $stmt = $pdo->query($sql);
    while ($linha = $stmt->fetch()) {
        $resultados[] = $linha;
    }
    return $resultados;
}

function buscar_sabor($chave) {
    $pdo = conectar();
    $sql = "SELECT * FROM sabor_pizza WHERE chave = :chave";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(["chave" => $chave]);
    return $stmt->fetch();
}

function login($login, $senha) {
    $pdo = conectar();
    $sql = "SELECT * FROM usuario WHERE login = :login AND senha = :senha";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(["login" => $login, "senha" => $senha]);
    return $stmt->fetch();
}

function usuario_logado($login) {
    $pdo = conectar();
    $sql = "SELECT * FROM usuario WHERE login = :login";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(["login" => $login]);
    return $stmt->fetch();
}