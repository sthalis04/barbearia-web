<?php
require_once '../Config/Database.php';

$erro_senha = "";
$erro_usuario = "";
 /*Variavel de erro, isso fara com que o que ocorrer ele armazene e mostre caso tenha algo*/

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = (new Database())->getConnection();

    $nome = $_POST['nome'];   /*Coleta os dados*/
    $senha = $_POST['senha'];
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    $sql = "SELECT * FROM usuario WHERE nome = :nome"; /*Aqui esta realizando a consulta no meu Banco de Dados*/
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':nome', $nome);
    $stmt->execute();

    if ($stmt->rowCount() > 0) { /*Verificando se o barbeiro cadastrado existe*/
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        if (password_verify($senha, $usuario['senha'])) { /*Verificação da senha do barbeiro*/
            session_start();
            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];
            header("Location: ../Painel_de_Controle/index.php"); 
            exit;
        } else { /*Situações possiveis*/
            $erro_senha = "A sua senha esta incorreta";
        }
    } else {
        $erro_usuario = "Usuário não foi encontrado no sistema";
    }
}
?>

<html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
     
  <div class="container">
    <h1>Login</h1>
    <hr />
    <form id="formLogin" method="POST" autocomplete="off"> 
  <label for="usuario">Usuário</label>
  <input type="text" id="usuario" name="nome" placeholder="Digite o usuário" required />
  <div class = "msg_erro">  
    <?php 
    if (!empty($erro_usuario)) { echo $erro_usuario; } 
    ?>
  </div> <br>

  <label for="senha">Senha</label>
  <input type="password" id="senha" name="senha" placeholder="Digite a senha" required />
   <div class = "msg_erro">  
    <?php 
    if (!empty($erro_senha)) { echo $erro_senha; } 
    ?>
  </div> <br>

  <div class="links">
    <a href="../Barbeiro/Cadastro.php">Cadastrar</a>
    <span>|</span>
    <a href="../Recuperar/index.php">Redefinir senha</a>
  </div>

  <button type="submit">ENTRAR</button>
</form>
  </div>

 
</body>
</html>
