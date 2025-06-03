<?php
$config_path = __DIR__ . '/../db_config.php';

if (file_exists($config_path)) {
    include $config_path;
}

if (!defined('DB_SERVERNAME') || !defined('DB_USERNAME') || !defined('DB_PASSWORD') || !defined('DB_NAME')) {
    die("Erro: O arquivo de configuração do banco de dados (db_config.php) não foi encontrado ou não define todas as constantes necessárias (DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_NAME). Por favor, crie este arquivo em '" . realpath(__DIR__ . '/..') . "/db_config.php' com base no db_config.php.template e preencha suas credenciais de banco de dados.");
}

$conn = new mysqli(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>
