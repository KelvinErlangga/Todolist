<?php 

$host = 'localhost';
$user = 'root';
$pass = '';
$db_name = 'todolist';

try {
    $conn = new PDO("mysql:host=$host;dbname=$db_name",
                    $user,$pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Gagal" . $e->getMessage();
}

?>