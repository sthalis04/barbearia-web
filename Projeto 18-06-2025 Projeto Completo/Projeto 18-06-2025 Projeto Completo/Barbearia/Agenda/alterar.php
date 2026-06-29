<?php
require_once '../config/Database.php';
require_once 'Agenda.php';
/*require_once '../Historico/historico.php';*/

$db = (new Database())->getConnection();
$agenda = new Agenda($db);
$agenda->id = $_GET['id'];
$dados = $agenda->buscarPorId();
if ($_POST) {
    $agenda->id_Cliente = $_POST['id_Cliente'];
    $agenda->id_Barbeiro = $_POST['id_Barbeiro'];
    $agenda->data_Agenda = $_POST['data_Agenda'];
    $agenda->horario = $_POST['horario'];
    
    if ($agenda->editar()) {
        header("Location: listar.php");
    }
}

$clientes = [];
$stmtClientes = $db->query("SELECT id, nome FROM cliente");
if ($stmtClientes) {
    $clientes = $stmtClientes->fetchAll(PDO::FETCH_ASSOC);
}

$barbeiros = [];
$stmtBarbeiros = $db->query("SELECT id, nome FROM barbeiro");
if ($stmtBarbeiros) {
    $barbeiros = $stmtBarbeiros->fetchAll(PDO::FETCH_ASSOC);
}
/*$historico->registrar($cliente_id, 'Atualização de dados do cliente');*/

?>

<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="../Menu/menu.css" />
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
    <form id="formCadastro" method="POST">
      <label for="id_Cliente">Cliente</label>
      <select id="id_Cliente" name="id_Cliente" required>
        <option value="">Selecione um cliente</option>
        <?php foreach ($clientes as $cliente): ?>
          <option value="<?= $cliente['id'] ?>"><?= htmlspecialchars($cliente['nome']) ?></option>
        <?php endforeach; ?>
      </select>

      <label for="id_Barbeiro">Barbeiro</label>
      <select id="id_Barbeiro" name="id_Barbeiro" required>
        <option value="">Selecione um barbeiro</option>
        <?php foreach ($barbeiros as $barbeiro): ?>
          <option value="<?= $barbeiro['id'] ?>"><?= htmlspecialchars($barbeiro['nome']) ?></option>
        <?php endforeach; ?>
      </select>

      <label for="data_Agenda">Data</label>
      <input type="date" id="data_Agenda" name="data_Agenda" required />

      <label for="horario">Horário</label>
      <input type="time" id="horario" name="horario" required />

      <button type="submit">Atualizar</button>
    </form>
  </div>
      <script src="efeitos.js"></script>

</body>
</html>
