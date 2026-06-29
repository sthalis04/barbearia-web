<?php
require_once '../config/Database.php';
require_once 'Plano.php';
$db = (new Database())->getConnection();
$plano = new Plano($db);
$plano->id = $_GET['id'];
$dados = $plano->buscarPorId();
if ($_POST) {
    $plano->nome = $_POST['nome'];
    $plano->quantidade = $_POST['quantidade'];
    $plano->valor = $_POST['valor'];
    $plano->descricao = $_POST['descricao'];
    if ($plano->editar()) {
        header("Location: listar.php");
    }
}
?>

<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="../Menu/menu.css">
    <title>Editar Plano</title>
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
        <h1>Editar Plano</h1>
        <hr />
        <form method="POST">
            Nome: <input type="text" name="nome" value="<?= $dados['nome'] ?>" required><br>

            Quantidade: <input type="number" name="quantidade" value="<?=
                $dados['quantidade'] ?>" required><br>

            Preço: <input type="number" step="0.01" name="valor" value="<?=
                $dados['valor'] ?>" required><br>

            Descrição: <input type="text" name="descricao" value="<?= $dados['descricao'] ?>" required><br>

            <br>
           <button type="submit">Atualizar</button>
        </form>
    </div>


    

</html>