<?php
require_once '../Config/Database.php';
require_once 'Agenda.php';


$db = (new Database())->getConnection();

// Buscar clientes
$clientes = $db->query("SELECT id, nome FROM cliente")->fetchAll(PDO::FETCH_ASSOC);

// Buscar barbeiros
$barbeiros = $db->query("SELECT id, nome FROM barbeiro")->fetchAll(PDO::FETCH_ASSOC);

if ($_POST) {
  $bd = (new Database())->getConnection();
  $agenda = new Agenda($db);
  $agenda->id_Cliente = $_POST['id_Cliente'];
  $agenda->id_Barbeiro = $_POST['id_Barbeiro'];
  $agenda->data_Agenda = $_POST['data_Agenda'];
  $agenda->horario = $_POST['horario'];
  $agenda->status = $_POST['status'];

  if ($agenda->criar()) {
    header("Location: listar.php");
    exit;
  }
}

?>

<html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../Cadastro/style.css" />
  <link rel="stylesheet" href="../Menu/menu.css" />
  <title>Criar Agendamento</title>

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
    <h1>Criar agendamento</h1>
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

  <label for="status">Status</label>
  <input type="text" id="status" name="status" required />

  <button type="submit"><b>Criar Agenda</b></button>

  </div>
  <script src="efeitos.js"></script>
</body>

</html>