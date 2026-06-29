<?php
class Agenda
{
    private $conn;
    private $table = "agenda";

    public $nome;
    public $id_Cliente;
    public $id_Barbeiro;
    public $data_Agenda;
    public $horario;
    public $status;
    public $id;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function listar()
    {
                 $query = "SELECT a.*, 
                     c.nome AS nomeCliente, 
                     b.nome AS nomeBarbeiro
              FROM agenda a
              LEFT JOIN cliente c ON a.id_Cliente = c.id
              LEFT JOIN barbeiro b ON a.id_Barbeiro = b.id;";
              $resultado = $this->conn->prepare($query);
              $resultado->execute();
              return $resultado;
    }

    public function criar()
    {
        $query = "INSERT INTO " . $this->table . " (id_Cliente, id_Barbeiro, data_Agenda, horario, status) VALUES (:id_Cliente, :id_Barbeiro, :data_Agenda, :horario, :status)";

        $resultado = $this->conn->prepare($query);

       $resultado->bindParam(":id_Cliente", $this-> id_Cliente);
       $resultado->bindParam(":id_Barbeiro", $this->id_Barbeiro);
       $resultado->bindParam(":data_Agenda", $this->data_Agenda);
       $resultado->bindParam(":horario", $this->horario);
        $resultado->bindParam(":status", $this->status);
 

        if ($resultado->execute()) {
            return true;
        }

        return false;
    }
     public function editar()
    {
       $query = "UPDATE " . $this->table . " SET id_Cliente = :id_Cliente, id_Barbeiro = :id_Barbeiro, data_Agenda = :data_Agenda, horario = :horario status = :status WHERE id = :id";
       $resultado = $this->conn->prepare($query);
       $resultado->bindParam(":id_Cliente", $this->id_Cliente);
       $resultado->bindParam(":id_Barbeiro", $this->id_Barbeiro);
       $resultado->bindParam(":data_Agenda", $this->data_Agenda);
       $resultado->bindParam(":horario", $this->horario);
       $resultado->bindParam(":status", $this->status);
       $resultado->bindParam(":id", $this->id);
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