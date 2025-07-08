<?php
// Exemplo vulnerável para teste de SAST

// 1. Vulnerabilidade: SQL Injection
// Recebe parâmetro 'id' da URL e insere direto na query
$id = $_GET['id'];
$conn = new mysqli('localhost', 'root', '', 'testdb');

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

$sql = "SELECT * FROM users WHERE id = $id"; // Vulnerável a SQL Injection
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "Usuário: " . $row['username'] . "<br>";
    }
} else {
    echo "Nenhum usuário encontrado.";
}

$conn->close();

// 2. Vulnerabilidade: Cross-Site Scripting (XSS)
// Exibe um parâmetro 'msg' recebido via GET direto na página
if (isset($_GET['msg'])) {
    echo "Mensagem: " . $_GET['msg']; // Vulnerável a XSS
}

// 3. Vulnerabilidade: Inclusion insegura
// Inclui um arquivo com base no parâmetro 'page' recebido via GET
if (isset($_GET['page'])) {
    include($_GET['page'] . ".php"); // Vulnerável a Local File Inclusion (LFI)
}

?>
