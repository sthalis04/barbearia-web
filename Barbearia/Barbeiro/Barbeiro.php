<?php
class Barbeiro
{
    private $conn;
    private $table = "barbeiro";

    public $nome;
    public $email;
    public $especialidade;
    public $id;


    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function listar()
    {
        $query = "SELECT * FROM " . $this->table;
        $resultado = $this->conn->prepare($query);
        $resultado->execute();
        return $resultado;
    }

    public function criar()
    {
        $query = "INSERT INTO " . $this->table . " (nome, email, especialidade) VALUES (:nome, :email, :especialidade)";

        $stmt = $this->conn->prepare($query);


        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":especialidade", $this->especialidade);


        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
     public function editar()
    {
        $query = "UPDATE " . $this->table . " SET nome = :nome, email = :email, especialidade = :especialidade WHERE id = :id";
        $resultado = $this->conn->prepare($query);
        $resultado->bindParam(':nome', $this->nome);
        $resultado->bindParam(':email', $this->email);
        $resultado->bindParam(':especialidade', $this->especialidade);
        $resultado->bindParam(':id', $this->id);
        return $resultado->execute();

    }

    public function buscarPorId()
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id
          LIMIT 1";
        $resultado = $this->conn->prepare($query);
        $resultado->bindParam(':id', $this->id);
        $resultado->execute();
        return $resultado->fetch(PDO::FETCH_ASSOC);
    }

    public function deletar()
    {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $resultado = $this->conn->prepare($query);
        $resultado->bindParam(':id', $this->id);
        return $resultado->execute();
    }

    public function redefinirSenha($email, $novaSenha) {
   $hash = password_hash($novaSenha, PASSWORD_DEFAULT);
   $stmt = $this->conn->prepare("UPDATE usuario SET senha = :senha WHERE
   email = :email");
   return $stmt->execute([
   ':senha' => $hash,
   ':email' => $email]);
}
}
?>