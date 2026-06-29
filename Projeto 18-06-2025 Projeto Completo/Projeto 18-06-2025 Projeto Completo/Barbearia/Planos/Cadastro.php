<?php
require_once '../Config/Database.php';
require_once 'Plano.php';

if ($_POST) {
    $db = (new Database())->getConnection();
    $plano = new Plano($db);
    $plano->nome = $_POST['nome'];
    $plano->valor = $_POST['valor'];
    $plano->quantidade = $_POST['quantidade'];
    $plano->descricao = $_POST['descricao'];

    if ($plano->criar()) {
        header("Location: listar.php");
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
    <title>Cadastro</title>

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
        <h1>Cadastro de Plano</h1>
        <hr />

        <form id="formPlano" method="POST">
            <label for="nome">Nome do Plano</label>
            <input type="text" id="nome" name="nome" placeholder="Digite o nome do plano" required />

            <label for="valor">Valor</label>
            <input type="number" id="valor" name="valor" placeholder="Digite o valor" step="0.01" required />

            <label for="quantidade">Quantidade</label>
            <input type="number" id="quantidade" name="quantidade" placeholder="Digite a quantidade" required />

            <label for="descricao">Descrição</label>
            <textarea id="descricao" name="descricao" placeholder="Digite uma descrição" rows="3" required></textarea>

            <button type="submit"><b>CADASTRAR PLANO</b></button>
        </form>

    </div>
</body>

</html>