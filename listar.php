<?php
try {
    include "abrir_transação.php";
include_once "operações.php";
$resultado = listar_todos_sabores(); ?>

<!DOCTYPE html>
<html lang="port-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Nossos Sabores</title>
    <link rel="stylesheet" href="style.css">
</head>
    <body>
        <table>
            <tr>
                <th scope="column">Chave</th>
                <th scope="column">Nome</th>
                <th scope="column">Ingredientes</th>
                <th scope="column">Preço sem borda</th>
                <th scope="column">Preço com borda</th>
                <th scope="column">Doce</th>
                <th scope="column"></th>
                <th scope="column"></th>
            </tr>
            <?php foreach ($resultado as $linha) { ?>
                <tr>
                    <td><?= $linha["chave"] ?></td>
                    <td><?= $linha["nome"] ?></td>
                    <td><?= $linha["ingredientes"] ?></td>
                    <td><?= $linha["preco_sem_borda"] ?></td>
                    <td><?= $linha["preco_borda_recheada"] ?></td>
                    <td><?= $linha["doce"] ? 'Sim' : 'Não' ?></td>
                    <td>
                        <button type="button">
                            <a href="cadastrar.php?chave=<?= $linha["chave"] ?>">Editar</a>
                        </button>
                    </td>
                </tr>
            <?php } ?>
        </table>
        <button type="button"><a href="cadastrar.php">Criar novo</a></button>
    </body>
</html>
<?php

$transacaoOk = true;

} finally {
    include "fechar_transação.php";
}
?>