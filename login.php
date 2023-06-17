<?php
session_start();
if (isset($_SESSION["username"])) {
    header("Location: listar.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pizzaria</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

  <div class="container">
    <h2>Login</h2>
    <form id="login-form">
      <div class="form-group">
        <label for="username">Usuário:</label>
        <input type="text" id="username" name="username" required>
      </div>
      <div class="form-group">
        <label for="password">Senha:</label>
        <input type="password" id="password" name="password" required>
      </div>
      <div class="form-group">
        <button type="submit">Entrar</button>
      </div>
    </form>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    // Manipula o evento de submit do formulário
    $("#login-form").submit(function(e) {
      e.preventDefault(); // Impede o envio tradicional do formulário

      // Obtém os valores do formulário
      var username = $("#username").val();
      var password = $("#password").val();

      // Cria um objeto com os dados do formulário
      var formData = {
        username: username,
        password: password
      };

      // Envia a requisição AJAX
      $.ajax({
        url: "processar-login.php", // Caminho para o arquivo PHP de processamento do login
        type: "POST",
        data: formData,
        dataType: "json",
        success: function(response) {
          // Manipula a resposta do servidor
          if (response.success) {
            // Login bem-sucedido, redireciona para a página principal
            window.location.href = "listar.php";
          } else {
            // Login falhou, exibe uma mensagem de erro
            alert("Usuário ou senha inválidos");
          }
        },
        error: function() {
          // Ocorreu um erro na requisição AJAX
          alert("Erro ao processar o login");
        }
      });
    });
  });
</script>
</body>