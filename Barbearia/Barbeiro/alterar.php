<?php
require_once '../config/Database.php';
require_once 'Barbeiro.php';

$db = (new Database())->getConnection();
$barbeiro = new Barbeiro($db);
$barbeiro-> id = $_GET['id'];
$dados = $barbeiro->buscarPorId();
if ($_POST) {
    $barbeiro->nome = $_POST['nome'];
    $barbeiro->email = $_POST['email'];
    $barbeiro->especialidade = $_POST['especialidade'];
   
    
    if ($barbeiro->editar()) {
        header("Location: listar.php");
    }
}

?>

<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styleForm.css" />
    <link rel="stylesheet" href="../Menu/menu.css">
    <title>Editar barbeiro</title>
</head>

<body>

    <header>
    <nav class="navbar">
      <img class="logo" src="../Img/LOGO BARBER.png" alt="Logo" />
      <ul class="nav-links">
        <li><a href="index.php">Início</a></li>
        <li><a href="../Painel_de_Controle/index.php">Painel de Controle</a></li>
        <li><a href="../Login/logout.php">Sair</a></li>
      </ul>
    </nav>
  </header>

    <div class="container">
        <h1>Editar Barbeiro</h1>
        <hr />
        <form method="POST">
             Nome: <input type="text" name="nome" value="<?= $dados['nome'] ?>" required><br>

             E-mail: <input type="email" name="email" value="<?= $dados['email'] ?>" required><br>

             Especialidade: <input type="text" name="especialidade" value="<?= $dados['especialidade'] ?>" required><br>


           <button type="submit">Atualizar</button>
        </form>
    </div>

    <script src="efeitos.js"></script>


</body>
</html>