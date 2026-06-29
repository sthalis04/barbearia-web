<?php
require_once '../config/Database.php';
require_once 'Barbeiro.php';
$db = (new Database())->getConnection();
$barbeiro = new Barbeiro ($db);
$barbeiro->id = $_GET['id'];

if ($barbeiro->deletar()) {
    header("Location: listar.php");
}
?>