
<?php

require_once "../conn.php";

$nome = $_GET['nome'];

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $idaluno = $_POST["idaluno"];

  // Prepara e executa a query para excluir o aluno do banco de dados
  $stmt = $conn->prepare("DELETE FROM aluno WHERE idaluno = :idaluno");
  $stmt->bindParam(':idaluno', $idaluno);

  $stmt->execute();

  // Redireciona para a página principal de alunos
  header("Location: index.php");
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Excluir Aluno</title>
  <link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body>
  <div class="caixa_form">
  <a class="voltar" href="index.php">Gerenciar Aluno</a>
      <h1>Excluir o Aluno: <br> <spam><?php echo $nome;?></spam> </h1>
      <form method="post" action="excluir.php">
        <label for="id">ID do Aluno:</label>
        <input type="number" id="id" name="idaluno" placeholder="Digite o id do aluno para comfirma" required>
        <input type="submit" value="Excluir">
      </form>
  </div>
</body>
</html>

