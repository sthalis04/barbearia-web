<?php
require_once '../Config/Database.php';
require_once 'Cliente.php';
/*require_once '../Historico/historico.php';*/

$db = (new Database())->getConnection();

// Buscar planos sempre, antes do if
$planos = [];
$stmt = $db->query("SELECT id, nome FROM plano");
if ($stmt) {
    $planos = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

if ($_POST) {
  $cliente = new Cliente($db);
  $cliente->nome = $_POST['nome'];
  $cliente->telefone = $_POST['telefone'];
  $cliente->email = $_POST['email'];
  $cliente->data_Hora = $_POST['data_Hora'];
  $cliente->plano = $_POST['plano'];

  if ($cliente->criar()) {
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
    <h1>Cadastro</h1>
    <hr />

    <form id="formCadastro" method="POST">
      <label for="nome">Nome</label>
      <input type="text" id="nome" name="nome" placeholder="Digite seu nome" required />

      <label for="email">E-mail</label>
      <input type="email" id="email" name="email" placeholder="Digite o E-mail" required />

      <label for="telefone">Telefone</label>
      <input type="text" id="telefone" name="telefone" placeholder="Digite o telefone" required />

      <label for="data_Hora">Data e Hora</label>
      <input type="datetime-local" id="data_Hora" name="data_Hora" required />

      <label for="plano">Selecione o plano desejado: </label>
      <select name="plano" id="plano" required>
        <?php if (count($planos) > 0): ?> <!--Esta parte é responsavel por verificar se possui planos cadastrados--> 
          <?php foreach ($planos as $plano): ?>
            <option value="<?= $plano['id'] ?>"><?= htmlspecialchars($plano['nome']) ?></option>
          <?php endforeach; ?>
        <?php else: ?>
          <option value="">Nenhum plano cadastrado</option>
        <?php endif; ?>
      </select>

      <button type="submit"><b>CADASTRAR</b></button>

    </form>

  </div>

  <script src="efeitos.js"></script>

</body>

</html>