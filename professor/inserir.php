<!DOCTYPE html>
<html>
<head>
  <title>Inserir Professor</title>
  <link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body>
  <div class="caixa_form">
  <a class="voltar" href="index.php">Gerenciar professor</a>
      <h1>Inserir Professor</h1>
      <form method="post" action="inserir.php">
        <label for="nomeprof">Nome:</label>
        <input type="text" id="nomeprof" name="nomeprof" required>
        <label for="cpf">CPF:</label>
        <input type="text" id="cpf" name="cpf" required>
        <label for="siape">Siape:</label>
        <input type="text" id="siape" name="siape" required>
        <label for="idade">Idade:</label>
        <input type="number" id="idade" name="idade" required>
        <input type="submit" value="Inserir">
      </form>
  </div>
</body>
</html>

<?php

require_once "../conn.php";

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nomeprof = $_POST["nomeprof"];
  $cpf = $_POST["cpf"];
  $siape = $_POST["siape"];
  $idade = $_POST["idade"];


  // Prepara e executa a query para inserir o professor no banco de dados
  $stmt = $conn->prepare("INSERT INTO professor (nomeprof, cpf, siape, idade) VALUES (:nomeprof, :cpf, :siape, :idade)");
  $stmt->bindParam(':nomeprof', $nomeprof);
  $stmt->bindParam(':cpf', $cpf);
  $stmt->bindParam(':siape', $siape);
  $stmt->bindParam(':idade', $idade);


  $stmt->execute();

  // Redireciona para a página principal de professores
  header("Location: index.php");
  exit();
}
?>
