<?php
require_once '../config/Database.php';
require_once 'Agenda.php';
$db = (new Database())->getConnection();
$cliente = new agenda($db);
$cliente->id = $_GET['id'];

if ($cliente->deletar()) {
    header("Location: listar.php");
}
?>