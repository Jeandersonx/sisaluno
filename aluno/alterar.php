<?php
// Código para conexão com o banco de dados (adapte as configurações de acordo com o seu ambiente)
require_once "../conn.php";

// Verifica se o ID do aluno foi fornecido
if (!isset($_GET["idaluno"])) {
  // Redireciona de volta para a página principal de alunos
  header("Location: index.php");
  exit();
}

$idaluno = $_GET["idaluno"];

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nome = $_POST["nome"];
  $idade = $_POST["idade"];
  $datanascimento = $_POST["datanascimento"];
  $endereco = $_POST["endereco"];
  $status = $_POST["status"];
  $matricula = $_POST["matricula"];

  // Validação dos campos
  $errors = array();

  if ($idade < 0) {
    $errors[] = "A idade não pode ser negativa.";
  }

  if (preg_match('/[^a-zA-Z0-9\s]/', $nome) || preg_match('/[^a-zA-Z0-9\s]/', $endereco)) {
    $errors[] = "Os campos Nome e Endereço não podem conter caracteres especiais.";
  }

  if (count($errors) > 0) {
    // Se houver erros, exibe a mensagem de erro e não executa a atualização no banco de dados.
    foreach ($errors as $error) {
      echo "<p style='color: red;'>$error</p>";
      echo "<br>";
    }
  } else {
    // Prepara e executa a query para atualizar os dados do aluno no banco de dados
    $stmt = $conn->prepare("UPDATE aluno SET nome = :nome, idade = :idade, datanascimento = :datanascimento, endereco = :endereco, estatus = :status, matricula = :matricula WHERE idaluno = :idaluno");
    $stmt->bindParam(':idaluno', $idaluno);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':idade', $idade);
    $stmt->bindParam(':datanascimento', $datanascimento);
    $stmt->bindParam(':endereco', $endereco);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':matricula', $matricula);

    $stmt->execute();

    // Redireciona para a página principal de alunos
    header("Location: index.php");
    exit();
  }
}

// Obtém os dados do aluno a serem alterados do banco de dados
$stmt = $conn->prepare("SELECT * FROM aluno WHERE idaluno = :idaluno");
$stmt->bindParam(':idaluno', $idaluno);
$stmt->execute();
$aluno = $stmt->fetch(PDO::FETCH_ASSOC);

// Verifica se o aluno existe
if (!$aluno) {
  // Redireciona de volta para a página principal de alunos
  header("Location: index.php");
  exit();
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>Alterar Aluno</title>
  <link rel="stylesheet" type="text/css" href="../style.css">
</head>

<body>
  <div class="caixa_form">
    <a class="voltar" href="index.php">Gerenciar Aluno</a>
    <h1>Alterar Aluno</h1>
    <form method="POST">
      <input type="hidden" name="id" value="<?php echo $aluno['idaluno']; ?>">
      <label for="nome">Nome:</label>
      <input type="text" name="nome" id="nome" value="<?php echo $aluno['nome']; ?>" required>
      <br><br>
      <label for="idade">Idade:</label>
      <input type="number" name="idade" id="idade" value="<?php echo $aluno['idade']; ?>" required>
      <br><br>
      <label for="datanascimento">Data de Nascimento:</label>
      <input type="date" name="datanascimento" id="datanascimento" value="<?php echo $aluno['datanascimento']; ?>" required>
      <br><br>
      <label for="endereco">Endereço:</label>
      <input type="text" name="endereco" id="endereco" value="<?php echo $aluno['endereco']; ?>" required>
      <br><br>
      <label for="status">Status:</label>
      <select name="status" id="status" required>
          <option value="<?php echo $aluno['estatus']; ?>"><?php echo $aluno['estatus']; ?></option>
          <option value="AP">Aprovado</option>
          <option value="RP">Reprovado</option>
      </select>
      <br><br>
      <label for="matricula">Matricula:</label>
      <input type="text" name="matricula" id="matricula" value="<?php echo $aluno['matricula']; ?>" required>
      <br><br>
      <input type="submit" value="Alterar">
    </form>
  </div>
</body>

</html>
