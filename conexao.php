<?php 
$host = "localhost";
$user = 'root';
$pass = '';
$banco = 'filmes_bd';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$banco;charset=utf8", $user, $pass); //conexão com o banco de dados
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //configura o PDO para lançar exceções em caso de erro

} catch (PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
}