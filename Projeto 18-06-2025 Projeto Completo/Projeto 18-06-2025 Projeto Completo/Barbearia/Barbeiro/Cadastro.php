<?php
require_once '../Config/Database.php';
require_once 'Barbeiro.php';

if ($_POST) {
  $db = (new Database())->getConnection();
  $barbeiro = new Barbeiro ($db);
  $barbeiro->nome = $_POST['nome'];
  $barbeiro->especialidade = $_POST['especialidade'];
  $barbeiro->email = $_POST['email'];

  if ($barbeiro->criar()) {

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); 
    $sql = "INSERT INTO usuario (nome, senha, email) VALUES (:nome, :senha, :email)";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':senha', $senha);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    header("Location: ../Login/Login.php");
  }
}
?>

<html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="../Menu/menu.css">
  <title>Registro</title>

</head>

<body>

  <header>
    <nav class="navbar">
      <img class="logo" src="../Img/LOGO BARBER.png" alt="Logo" />
      <ul class="nav-links">
        <li><a href="../Painel_de_Controle/index.php">Painel de Controle</a></li>
        <li><a href="../Login/logout.php">Sair</a></li>
      </ul>
    </nav>
  </header>

  <div class="container">
    <h1>Registro</h1>
    <hr />

    <form id="formCadastro" method="POST">
      <label for="nome">Nome</label>
      <input type="text" id="nome" name="nome" placeholder="Digite seu nome" required />

      <label for="email">E-mail</label>
      <input type="email" id="email" name="email" placeholder="Digite o E-mail" required />
      
      <label for="nome">Especialidade</label>
      <input type="text" id="nome" name="especialidade" placeholder="Digite a sua especialidade" required />

      <label for = "senha">Senha</label>
      <input type="password" id="senha" name="senha" placeholder="Digite a senha" required />

      <label for = "senha_2">Digite novamente</label>
      <input type="password" id="senha" name="senha_2" placeholder="Digite a senha" required />

      <button type="submit"><b>Registrar</b></button>

    </form>
  </div>
  <script src = "script.js"></script>
  <script src="efeitos.js"></script>
</body>

</html>