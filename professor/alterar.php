<?php
// Código para conexão com o banco de dados (adapte as configurações de acordo com o seu ambiente)
require_once "../conn.php";

// Verifica se o ID do professor foi fornecido
if (!isset($_GET["idprofessor"])) {
  // Redireciona de volta para a página principal de professores
  header("Location: index.php");
  exit();
}

$idprofessor = $_GET["idprofessor"];

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nomeprof = $_POST["nomeprof"];
  $cpf = $_POST["cpf"];
  $siape = $_POST["siape"];
  $idade = $_POST["idade"];


  // Prepara e executa a query para atualizar os dados do professor no banco de dados
  $stmt = $conn->prepare("UPDATE professor SET nomeprof = :nomeprof, cpf = :cpf, siape = :siape, idade = :idade WHERE idprofessor = :idprofessor");
  $stmt->bindParam(':idprofessor', $idprofessor);
  $stmt->bindParam(':nomeprof', $nomeprof);
  $stmt->bindParam(':cpf', $cpf);
  $stmt->bindParam(':siape', $siape);
  $stmt->bindParam(':idade', $idade);

  $stmt->execute();

  // Redireciona para a página principal de professores
  header("Location: index.php");
  exit();
}

// Obtém os dados do professor a serem alterados do banco de dados
$stmt = $conn->prepare("SELECT * FROM professor WHERE idprofessor = :idprofessor");
$stmt->bindParam(':idprofessor', $idprofessor);
$stmt->execute();
$professor = $stmt->fetch(PDO::FETCH_ASSOC);

// Verifica se o professor existe
if (!$professor) {
  // Redireciona de volta para a página principal de professores
  header("Location: index.php");
  exit();
}
?>
<!DOCTYPE html>
<html>

<head>
  <title>Alterar Professor</title>
  <link rel="stylesheet" type="text/css" href="../style.css">
</head>

<body>
  <div class="caixa_form">
    <a class="voltar" href="index.php">Gerenciar professor</a>
    <h1>Alterar Professor</h1>
    <form method="POST">
      <input type="hidden" name="idprofessor" value="<?php echo $professor['idprofessor']; ?>">
      <label for="nomeprof">Nome:</label>
      <input type="text" name="nomeprof" id="nomeprof" value="<?php echo $professor['nomeprof']; ?>" required>
      <br><br>
      <label for="cpf">CPF:</label>
      <input type="text" name="cpf" id="cpf" value="<?php echo $professor['cpf']; ?>" required>
      <br><br>
      <label for="siape">Siape:</label>
      <input type="date" name="siape" id="siape" value="<?php echo $professor['siape']; ?>" required>
      <br><br>
      <label for="idade">Idade:</label>
      <input type="number" name="idade" id="idade" value="<?php echo $professor['idade']; ?>" required>
      <br><br>
      <input type="submit" value="Alterar">
    </form>
  </div>
</body>

</html>