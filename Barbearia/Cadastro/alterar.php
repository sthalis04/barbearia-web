<?php
require_once '../config/Database.php';
require_once 'Cliente.php';
/*require_once '../Historico/historico.php';*/

$db = (new Database())->getConnection();
$cliente = new Cliente($db);
$cliente->id = $_GET['id'];
$dados = $cliente->buscarPorId();
if ($_POST) {
    $cliente->nome = $_POST['nome'];
    $cliente->telefone = $_POST['telefone'];
    $cliente->email = $_POST['email'];
    $cliente->data_Hora = $_POST['data_Hora'];
    $cliente->plano = $_POST['plano'];
    
    if ($cliente->editar()) {
        header("Location: listar.php");
    }
}

$planos = [];
$stmt = $db->query("SELECT id, nome FROM plano");
if ($stmt) {
    $planos = $stmt->fetchAll(PDO::FETCH_ASSOC);
}


?>

<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <li><a href="../Painel_de_Controle/index.php">Painel de Controle</a></li>
    <link rel="stylesheet" href="../Menu/menu.css">
    <title>Editar Plano</title>
</head>

<body>

  <header>
    <nav class="navbar">
      <img class="logo" src="../Img/LOGO BARBER.png" alt="Logo" />
      <ul class="nav-links">
        <li><a href="index.php">Início</a></li>
        <li><a href="../Login/logout.php">Sair</a></li>
      </ul>
    </nav>
  </header>

    <div class="container">
        <h1>Editar Plano</h1>
        <hr />
        <form method="POST">
            Nome: <input type="text" name="nome" value="<?= $dados['nome'] ?>" required><br>

            Telefone: <input type="text" name="telefone" value="<?=
                $dados['telefone'] ?>" required><br>

            E-mail: <input type="email" name="email" value="<?= $dados['email'] ?>" required><br>

            Data e Hora: <input type="datetime-local" name="data_Hora" value="<?= $dados['data_Hora'] ?>" required><br>
           
            <label for="plano">Selecione o plano: </label>
      <select name="plano" id="plano" required>
        <?php if (count($planos) > 0): ?> <!--Esta parte é responsavel por verificar se possui planos cadastrados--> 
          <?php foreach ($planos as $plano): ?>
            <option value="<?= $plano['id'] ?>"><?= htmlspecialchars($plano['nome']) ?></option>
          <?php endforeach; ?>
        <?php else: ?>
          <option value="">Nenhum plano cadastrado</option>
        <?php endif; ?>
      </select><br>
           <button type="submit">Atualizar</button>
        </form>
    </div>

          <script src="efeitos.js"></script>
    
</<body>

</html>