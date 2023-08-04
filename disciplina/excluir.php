
<?php

require_once "../conn.php";

$disciplina = $_GET['disciplina'];

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $iddisciplina = $_POST["iddisciplina"];

  // Prepara e executa a query para excluir a disciplina do banco de dados
  $stmt = $conn->prepare("DELETE FROM disciplina WHERE iddisciplina = :iddisciplina");
  $stmt->bindParam(':iddisciplina', $iddisciplina);

  $stmt->execute();

  // Redireciona para a página principal de disciplinas
  header("Location: index.php");
  exit();
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Excluir Disciplina</title>
  <link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body>
  <div class="caixa_form">
  <a class="voltar" href="index.php">Gerenciar diciplina</a>
      <h1>Excluir a Disciplina <br> <spam><?php echo $disciplina; ?></spam></h1>
      <form method="post" action="excluir.php">
        <label for="iddisciplina">ID da Disciplina:</label>
        <input type="number" id="iddisciplina" name="iddisciplina" placeholder="Digite o id da diciplina para comfirma" required>
        <input type="submit" value="Excluir">
      </form>
  </div>
</body>
</html>
