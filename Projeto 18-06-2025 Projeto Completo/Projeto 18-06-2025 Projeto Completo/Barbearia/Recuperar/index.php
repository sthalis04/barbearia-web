<?php
require_once '../Config/Database.php';
require_once '../Barbeiro/Barbeiro.php';
  
$erro_modificar = "";
$erro_email = "";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
   $db = (new Database())->getConnection();
   $barbeiro = new Barbeiro($db); 
   $email = $_POST['email'];
   $novaSenha = $_POST['novaSenha'];
   $confirmarSenha = $_POST['confirmar_senha'];

   $sql = "SELECT email FROM usuario WHERE email = '$email'"; 
   $procura_email = $db->query($sql);

   if ($novaSenha !== $confirmarSenha) { 
       $erro_modificar = "As senhas não coincidem.";
   } else if (strlen($novaSenha) < 8){
       $erro_modificar = "A senha deve ter pelo menos 8 caracteres.";
   }

   else if ($procura_email && $procura_email->rowCount() == 0) {
    $erro_email =  "E-mail não encontrado no sistema!";}

    else if ($barbeiro->redefinirSenha($_POST['email'], $_POST['novaSenha']))
{
  header ('location: Confirma.php');
} else {
  $erro_modificar= "Erro ao redefinir senha.";
}  
  
}
?>

<html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Recureção</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <div class="container">
    <h1>Recuperação</h1>
    <hr />
    <form method="POST">
      <label for="email">E-mail</label>
      <input type="email" id="email" name="email" placeholder="Digite seu E-mail" required />
      <div class = "msg_erro">  
    <?php 
    if (!empty($erro_email)) { 
       echo $erro_email; } 
    ?>
  </div> <br>

      <label for= "novaSenha">Nova Senha</label>
      <input type="password" id="senha" name="novaSenha" placeholder="Digite sua nova senha" required />

      <label for="confirmar_senha">Confirmar Senha</label>
      <input type="password" id="confirmar_senha" name="confirmar_senha" placeholder="Confirme sua nova senha" required />

      <div class = "msg_erro">  
    <?php 
    if (!empty($erro_modificar)) {
      echo $erro_modificar; } 
    ?>
  </div> <br>

      <button type="submit">Recuperar</button>
    </form>
  </div>

  <script src="script.js"></script>
</body>
</html> 