<?php
class Cliente
{
    private $conn;
    private $table = "cliente";

    public $nome;
    public $telefone;
    public $data_Hora;
    public $email;
    public $plano;
    public $id;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function listar()
    {
        $query = "SELECT c.*, p.nome AS nomePlano /*Criando uma tabela com base no id para exibir somente o nome ao invez do id*/
              FROM cliente c
              LEFT JOIN plano p ON c.id_Plano = p.id";
              $resultado = $this->conn->prepare($query);
              $resultado->execute();
              return $resultado;
    }

    public function criar()
    {
        $query = "INSERT INTO " . $this->table . " (nome, telefone, email, data_Hora, id_Plano) VALUES (:nome, :telefone, :email, :data_Hora, :id_Plano)";

        $stmt = $this->conn->prepare($query);


        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":telefone", $this->telefone);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam("data_Hora", $this->data_Hora);
        $stmt->bindParam(":id_Plano", $this->plano);


        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
     public function editar()
    {
        $query = "UPDATE " . $this->table . " SET nome = :nome, telefone
         = :telefone, email = :email, id_Plano = :id_Plano WHERE id = :id";
        $resultado = $this->conn->prepare($query);
        $resultado->bindParam(':nome', $this->nome);
        $resultado->bindParam(':email', $this->email);
        $resultado->bindParam(':telefone', $this->id);
        $resultado->bindParam(':id_Plano', $this->plano);
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
}
?>