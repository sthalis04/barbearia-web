<?php
require_once '../config/Database.php';
require_once 'Cliente.php';
$db = (new Database())->getConnection();
$cliente = new Cliente($db);
$cliente->id = $_GET['id'];

if ($cliente->deletar()) {
    header("Location: listar.php");
}
/*$historico->registrar($cliente_id, 'Exclusão de cliente');*/
?>