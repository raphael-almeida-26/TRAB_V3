<?php
// login.php
$servername = "localhost";
$username = "root"; // Use o usuário root ou crie outro usuário para o MySQL
$password = ""; // Normalmente, a senha é vazia no XAMPP por padrão
$dbname = "test_db";
$port = 7306;
// Conectar ao banco de dados
$conn = new mysqli($servername, $username, $password, $dbname, $port);
// Verificar conexão
if ($conn->connect_error) {
 die("Conexão falhou: " . $conn->connect_error);
}
// Obter dados do formulário
$usuario = $_POST['usuario'];
$senha = $_POST['senha'];
// Construir a query vulnerável
$sql = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND senha = '$senha'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
 echo "Login realizado com sucesso!";
} else {
 echo "Usuário ou senha inválidos.";
}
$conn->close();
?>