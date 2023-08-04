<?php
// Código para conexão com o banco de dados (adapte as configurações de acordo com o seu ambiente)
require_once "../conn.php";

// Verifica se o ID da disciplina foi fornecido
if (!isset($_GET["iddisciplina"])) {
  // Redireciona de volta para a página principal de disciplinas
  header("Location: index.php");
  exit();
}

$iddisciplina = $_GET["iddisciplina"];

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $disciplina = $_POST["disciplina"];
  $ch = $_POST["ch"];
  $semestre = $_POST["semestre"];
  $idprofessor = $_POST["idprofessor"];

  // Prepara e executa a query para atualizar os dados da disciplina no banco de dados
  $stmt = $conn->prepare("UPDATE disciplina SET disciplina = :disciplina, ch = :ch, semestre = :semestre, idprofessor = :idprofessor WHERE iddisciplina = :iddisciplina");
  $stmt->bindParam(':iddisciplina', $iddisciplina);
  $stmt->bindParam(':disciplina', $disciplina);
  $stmt->bindParam(':ch', $ch);
  $stmt->bindParam(':semestre', $semestre);
  $stmt->bindParam(':idprofessor', $idprofessor);

  $stmt->execute();

  // Redireciona para a página principal de disciplinas
  header("Location: index.php");
  exit();
}

// Obtém os dados da disciplina a serem alterados do banco de dados
$stmt = $conn->prepare("SELECT * FROM disciplina WHERE iddisciplina = :iddisciplina");
$stmt->bindParam(':iddisciplina', $iddisciplina);
$stmt->execute();
$disciplina = $stmt->fetch(PDO::FETCH_ASSOC);

// Verifica se a disciplina existe
if (!$disciplina) {
  // Redireciona de volta para a página principal de disciplinas
  header("Location: index.php");
  exit();
}

// Prepara e executa a query para selecionar todos os professores
$stmt = $conn->prepare("SELECT idprofessor, nomeprof FROM professor");
$stmt->execute();
$professores = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>

<head>
  <title>Alterar Disciplina</title>
  <link rel="stylesheet" type="text/css" href="../style.css">
</head>

<body>
  <div class="caixa_form">
    <a class="voltar" href="index.php">Gerenciar diciplina</a>
    <h1>Alterar Disciplina</h1>
    <form method="POST">
      <input type="hidden" name="iddisciplina" value="<?php echo $disciplina['iddisciplina']; ?>">
      <label for="disciplina">Nome da Disciplina:</label>
      <input type="text" name="disciplina" id="disciplina" value="<?php echo $disciplina['disciplina']; ?>" required>
      <br><br>
      <label for="ch">Carga Horária:</label>
      <input type="text" name="ch" id="ch" value="<?php echo $disciplina['ch']; ?>" required>
      <br><br>
      <label for="semestre">Semestre:</label>
      <input type="text" name="semestre" id="semestre" value="<?php echo $disciplina['semestre']; ?>" required>
      <br><br>
      <label for="idprofessor">Professor:</label>
      <select name="idprofessor" id="idprofessor" required>
        <option value="">Selecione um professor</option>
        <?php foreach ($professores as $professor) { ?>
          <option value="<?php echo $professor['idprofessor']; ?>" <?php if ($professor['idprofessor'] == $disciplina['idprofessor']) echo 'selected'; ?>><?php echo $professor['nomeprof']; ?></option>
        <?php } ?>
      </select>
      <br><br>
      <input type="submit" value="Alterar">
    </form>
  </div>
</body>

</html>