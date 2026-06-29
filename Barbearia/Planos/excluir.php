<?php
require_once '../config/Database.php';
require_once 'Plano.php';
$db = (new Database())->getConnection();
$plano = new Plano($db);
$plano->id = $_GET['id'];

if ($plano->deletar()) {
    header("Location: listar.php");
}
?>