<?php
function conectar() {
    try {
        $db_file = "C:\\xampp\\htdocs\\pizzaria.sqlite";
        $pdo = new PDO("sqlite:$db_file");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
        throw $e;
    }
}
?>
