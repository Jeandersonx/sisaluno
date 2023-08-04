<?php

require_once "../conn.php";

$nomeprof = $_GET['nomeprof'];

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $idprofessor = $_POST["idprofessor"];

  // Prepara e executa a query para excluir o professor do banco de dados
  $stmt = $conn->prepare("DELETE FROM professor WHERE idprofessor = :idprofessor");
  $stmt->bindParam(':idprofessor', $idprofessor);

  $stmt->execute();

  // Redireciona para a página principal de professores
  header("Location: index.php");
  exit();
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Excluir Professor</title>
  <link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body>
  <div class="caixa_form">
  <a class="voltar" href="index.php">Gerenciar professor</a>
      <h1>Excluir o Professor <br> <spam><?php echo $nomeprof; ?></spam></h1>
      <form method="post" action="excluir.php">
        <label for="idprofessor">ID do Professor:</label>
        <input type="number" id="idprofessor" name="idprofessor" placeholder="Digite o id do professor para confirma" required>
        <input type="submit" value="Excluir">
      </form>
  </div>
</body>
</html>



