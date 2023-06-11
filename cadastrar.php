<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="Pizza.png">
    <link rel="stylesheet" href="style.css">
    <title>Cadastro de Pizzas</title>
</head>
<body>
    
<?php
    
try {
    include "abrir_transação.php";
    include_once "operações.php";

    $tipos = listar_todos_sabores();

    function validar($sabor) {
        global $tipos;
        if (strlen($sabor["nome"]) > 30) return "Nome longo demais";
        if (strlen($sabor["ingredientes"]) < 4) return "Ingredientes muito curto";
        if (((float) $sabor["preco_sem_borda"]) <= 0) return "Tem que ter preço sem borda";
        if (((float) $sabor["preco_com_borda"]) <= 0) return "Tem que ter preço com borda";
        return "";
    }

    $erros = "";
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
        $validacaoOk = true;
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

?>
   <fieldset>
    <h1>Cadastro de Sabores de Pizza</h1>
    <legend>
        <a href="cadastrar.php">Cadastrar</a>
        <a href="listar.php">Listar</a>
    </legend>
    <form method="POST" action="cadastrar.php">
        <?php if ($erros) { ?>
            <div><?= $erros ?></div>
        <?php } ?>
        <div>
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required value="<?= $sabor['nome'] ?>">
        </div>
        <div>
            <label for="ingredientes">Ingredientes:</label>
            <input type="text" id="ingredientes" name="ingredientes" required value="<?= $sabor['ingredientes'] ?>">
        </div>
        <div>
            <label for="preco_sem_borda">Preço sem Borda Recheada:</label>
            <input type="number" id="preco_sem_borda" name="preco_sem_borda" required value="<?= $sabor['preco_sem_borda'] ?>">
        </div>
        <div>
            <label for="preco_com_borda">Preço com Borda Recheada:</label>
            <input type="number" id="preco_com_borda" name="preco_com_borda" required value="<?= $sabor['preco_com_borda']?>">
        </div>
        <div>
            <label for="doce">Doce:</label>
            <select id="doce" name="doce" required>
                <option value="0" <?php if ($sabor['doce'] == '0') echo 'selected'; ?>>Não</option>
                <option value="1" <?php if ($sabor['doce'] == '1') echo 'selected'; ?>>Sim</option>
            </select>
        </div>
        <div>
            <button type="submit">Salvar</button>
        </div>
    </form>
    </fieldset>
</body>
</html>

<?php

$transacaoOk = true;

} finally {
    include "fechar_transação.php";
}
?>