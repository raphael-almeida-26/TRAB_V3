<!DOCTYPE html>
<html lang="pt-br">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Usuários</title>
</head>
<body>
 <h1>Usuários</h1>
 <?php
 // Configuração de exibição de erros
 ini_set('display_errors', 1);
 ini_set('display_startup_errors', 1);
 error_reporting(E_ALL);
 // Conexão com o banco de dados
 $servername = "localhost";
 $username = "root";
 $password = "";
 $dbname = "test_db";
 $conn = new mysqli($servername, $username, $password, $dbname);
 if ($conn->connect_error) {
 die("Conexão falhou: " . $conn->connect_error);
 }
 // Obter o parâmetro 'id' da URL
 $id = isset($_GET['id']) ? $_GET['id'] : '';
 // Verificar se o id é um número inteiro para evitar erros
 if (filter_var($id, FILTER_VALIDATE_INT) === false) {
 echo "ID inválido.";
 $conn->close();
 exit();
 }
 // Construir a consulta SQL segura usando prepared statements
 $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
 $stmt->bind_param("i", $id); // 'i' indica que o parâmetro é um inteiro
 // Executar a consulta
 $stmt->execute();
 // Obter o resultado
 $result = $stmt->get_result();
 if ($result->num_rows > 0) {
 // Exibir os usuários encontrados
 while ($row = $result->fetch_assoc()) {
 echo "<h2>Usuário: " . htmlspecialchars($row['username']) . "</h2>";
 echo "<p>Email: " . htmlspecialchars($row['email']) . "</p>";
 }
 } else {
 echo "Nenhum usuário encontrado.";
 }
 // Fechar a conexão
 $stmt->close();
 $conn->close();
 ?>
</body>
</html>