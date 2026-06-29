<?php
require_once '../config/Database.php';
require_once 'Barbeiro.php';
$db = (new Database())->getConnection();
$barbeiro = new Barbeiro ($db);
$resultado = $barbeiro->listar();
?>

<html>
<head>
<title>Listar Barbeiros</title>
<link rel="stylesheet" href="../Planos/listar.css">
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

<div class="container">
    <h1>Barbeiros</h1>
    <hr>
    <a class="acao" href="Cadastro.php">Novo cadastro</a>
    <table class="listar-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Especialide</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $resultado->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                    <td><?= str_pad($row['id'], 3, '0', STR_PAD_LEFT) ?></td>
                    <td><?= htmlspecialchars($row['nome']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td><?= htmlspecialchars($row['especialidade']) ?></td>
                    <td>
                        <div class = "acoes">
                            <a class="acao" href="alterar.php?id=<?= $row['id'] ?>">Editar</a>
                            <a class="acao" href="excluir.php?id=<?= $row['id'] ?>"
                                onclick="return confirm('Deseja Realmente Excluir?')">Excluir</a>
                        </div>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
<script src="efeitos.js"></script>

</body>
</html>