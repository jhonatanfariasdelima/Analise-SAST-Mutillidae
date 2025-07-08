<?php
// Exemplo inseguro para testes SAST

// 1. Conexão com banco de dados (credenciais expostas)
$host = "localhost";
$user = "root";
$password = "123456"; // Informação sensível
$dbname = "meubanco";

$conn = mysqli_connect($host, $user, $password, $dbname);

// 2. Recebendo dados diretamente do GET (vulnerável a SQL Injection)
$id = $_GET['id'];
$query = "SELECT * FROM usuarios WHERE id = $id"; // SQL Injection
$result = mysqli_query($conn, $query);

// 3. Exibindo dados sem sanitização (vulnerável a XSS)
while ($row = mysqli_fetch_assoc($result)) {
    echo "Nome: " . $row['nome'] . "<br>"; // XSS
    echo "Email: " . $row['email'] . "<br><br>";
}

// 4. Uso de função perigosa com entrada do usuário (Command Injection)
$arquivo = $_GET['arquivo'];
system("cat " . $arquivo); // Command Injection
?>
