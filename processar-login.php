<?php
try {
    include "abrir_transação.php";
    include_once "operações.php";
// Obtenha os dados enviados por meio do método POST
$username = $_POST["username"];
$password = $_POST["password"];

// Verifique as credenciais do usuário
if (login($username, $password)) {
    // Credenciais válidas, inicie a sessão ou faça qualquer outra lógica de autenticação necessária
    session_start();
    $_SESSION["username"] = $username;
    // Você pode redirecionar o usuário para outra página ou retornar uma resposta JSON de sucesso
    $response = array("success" => true, "message" => "Login bem-sucedido");
    echo json_encode($response);
} else {
    // Credenciais inválidas, retorne uma resposta JSON indicando o erro
    $response = array("success" => false, "message" => "Credenciais inválidas");
    echo json_encode($response);
}

} finally {
    include "fechar_transação.php";
}
?>
