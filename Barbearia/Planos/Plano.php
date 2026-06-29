<?php
class Plano
{
    private $conn;
    private $table = "plano";

    public $nome;
    public $valor;
    public $descricao;
    public $quantidade;

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
        $query = "INSERT INTO " . $this->table . " (nome, valor, quantidade, descricao) VALUES (:nome, :valor, :quantidade, :descricao)";

        $stmt = $this->conn->prepare($query);


        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":valor", $this->valor);
        $stmt->bindParam(":quantidade", $this->quantidade);
        $stmt->bindParam("descricao", $this->descricao);


        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
    public function editar()
    {
        $query = "UPDATE " . $this->table . " SET nome = :nome, valor
         = :valor, quantidade = :quantidade, descricao = :descricao WHERE id = :id";
        $resultado = $this->conn->prepare($query);
        $resultado->bindParam(':nome', $this->nome);
        $resultado->bindParam(':quantidade', $this->quantidade);
        $resultado->bindParam(':valor', $this->id);
        $resultado->bindParam(':descricao', $this->descricao);
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