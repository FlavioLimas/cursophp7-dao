<?php 
/**
 * require da função de localizar as classes
 */
require_once("config.php");
/*
$sql = new Sql();
$usuarios = $sql->select("SELECT * FROM tb_usuarios");
echo json_encode($usuarios);*/

// Carrega um usuario
/*$root = new Usuario();
$root->loadById(4);
echo $root;*/

// Carega uma lista
/*$lista = Usuario::getLista();
echo json_encode($lista);*/

// Pesquisa login
/*$search = Usuario::search("j");
echo json_encode($search);*/

// Carrega um usuario usando o login e a senha

$usuario = new Usuario();
// $testeFalha = new Usuario();
$usuario->login("root","!@#$");
// $testeFalha->login("joao","5555");

echo $usuario;
echo "<br>";
// echo $testeFalha;



?>