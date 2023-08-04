<!DOCTYPE html>
<html>
<head>
  <title>Inserir Aluno</title>
  <link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body>
  <div class="caixa_form">
  <a class="voltar" href="index.php">Gerenciar Aluno</a>
      <h1>Inserir Aluno</h1>
      <form method="post" action="inserir.php">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>
        <label for="idade">Idade:</label>
        <input type="number" id="idade" name="idade" required>
        <label for="datanascimento">Data de Nascimento:</label>
        <input type="date" id="datanascimento" name="datanascimento" required>
        <label for="endereco">Endereço:</label>
        <input type="text" id="endereco" name="endereco" required>
        <label for="status">Status:</label>
        <select name="status" id="status" required>
          <option value="AP">Aprovado</option>
          <option value="RP">Reprovado</option>
        </select>
        <label for="matricula">Matricula:</label>
        <input type="text" id="matricula" name="matricula" required>
        <input type="submit" value="Inserir">
      </form>
  </div>
</body>
</html>

<?php

require_once "../conn.php";

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
        // Se houver erros, exibe a mensagem de erro e não executa a inserção no banco de dados.
        foreach ($errors as $error) {
            echo "<p style='color: red;'>$error</p>";
        }
    } else {
        // Prepara e executa a query para inserir o aluno no banco de dados
        $stmt = $conn->prepare("INSERT INTO aluno (nome, idade, datanascimento, endereco, estatus, matricula) VALUES (:nome, :idade, :datanascimento, :endereco, :status, :matricula)");
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
?>
