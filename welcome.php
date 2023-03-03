<?php
// Inicialize a sessão
session_start();

// Verifique se o usuário está logado, se não, redirecione-o para uma página de login
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  header("location: index.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Bem vindo</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    body {
      font: 14px sans-serif;
      text-align: center;
    }

    .botao {
      margin: 0;
      display: flex;
      align-items: center;
      font-family: inherit;
      max-width: 120px;
      font-weight: 500;
      font-size: 17px;
      padding: 0.8em 1.3em 0.8em 0.9em;
      color: white;
      background: #ad5389;
      background: linear-gradient(to right, #0f0c29, #302b63, #24243e);
      border: none;
      letter-spacing: 0.05em;
      border-radius: 16px;
    }

    .botao svg {
      margin-right: 3px;
      transform: rotate(30deg);
      transition: transform 0.5s cubic-bezier(0.76, 0, 0.24, 1);
    }

    .botao span {
      transition: transform 0.5s cubic-bezier(0.76, 0, 0.24, 1);
    }

    .botao:hover svg {
      transform: translateX(5px) rotate(90deg);
    }

    .botao:hover span {
      transform: translateX(7px);
    }
  </style>
</head>

<body>
  <h1 class="my-5">Oi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Bem vindo ao nosso sistema.</h1>
  <p>
    <a href="reset-password.php" class="btn btn-warning">Redefina sua senha</a>
    <a href="logout.php" class="btn btn-danger ml-3">Sair da conta</a>
  </p>
  <div class="container-md  mt-5">

    <a class="botao" href="./sistema/index.php">
      <svg height="24" width="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path d="M0 0h24v24H0z" fill="none"></path>
        <path d="M5 13c0-5.088 2.903-9.436 7-11.182C16.097 3.564 19 7.912 19 13c0 .823-.076 1.626-.22 2.403l1.94 1.832a.5.5 0 0 1 .095.603l-2.495 4.575a.5.5 0 0 1-.793.114l-2.234-2.234a1 1 0 0 0-.707-.293H9.414a1 1 0 0 0-.707.293l-2.234 2.234a.5.5 0 0 1-.793-.114l-2.495-4.575a.5.5 0 0 1 .095-.603l1.94-1.832C5.077 14.626 5 13.823 5 13zm1.476 6.696l.817-.817A3 3 0 0 1 9.414 18h5.172a3 3 0 0 1 2.121.879l.817.817.982-1.8-1.1-1.04a2 2 0 0 1-.593-1.82c.124-.664.187-1.345.187-2.036 0-3.87-1.995-7.3-5-8.96C8.995 5.7 7 9.13 7 13c0 .691.063 1.372.187 2.037a2 2 0 0 1-.593 1.82l-1.1 1.039.982 1.8zM12 13a2 2 0 1 1 0-4 2 2 0 0 1 0 4z" fill="currentColor"></path>
      </svg>
      <span>Acessar</span>
    </a>
  </div>
</body>

</html>