<?php
  require_once '../Config/Database.php';

  session_start(); 
  if (!isset($_SESSION['nome'])) {
      header("Location: ../Login/Login.php"); // ira redirecionar caso não logado
      exit;
  }

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Painel de controle</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../Menu/menu.css">
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

    <main>
<div class="botoes-grid">
    <div class="card">
        <img src="../Img/logo_agenda.png" alt="Ícone">
        <button onclick="location.href='../Agenda/Cadastro.php'">Agendar</button>
        <button onclick="location.href='../Agenda/listar.php'">Listar Agendamento</button>
    </div>
    <div class="card">
        <img src="../Img/logo_clientes.png" alt="Ícone">
        <button onclick="location.href='../Cadastro/Cadastro.php'">Cadastrar Cliente</button>
        <button onclick="location.href='../Cadastro/listar.php'">Listar Clientes</button>
    </div>
    <div class="card">
        <img src="../Img/logo_colaborador.png" alt="Ícone">
        <button onclick="location.href='../Barbeiro/listar.php'">Listar Barbeiro</button>
    </div>
    <div class="card">
        <img src="../Img/logo.png" alt="Ícone">
        <button onclick="location.href='../Planos/Cadastro.php'">Cadastrar Planos</button>
        <button onclick="location.href='../Planos/listar.php'">Listar Planos</button>
    </div>
</div>
    </main>

    <script src="../Efeitos/efeitos.js"></script>

</body>
 
</html>
