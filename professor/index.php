<?php
// Requer o arquivo de conexão com o banco de dados
require_once "../conn.php";

// Prepara e executa a query para selecionar todos os professores
$stmt = $conn->prepare("SELECT * FROM professor");
$stmt->execute();
$professores = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>

<head>
    <title>Professores</title>
    <link rel="stylesheet" type="text/css" href="../style.css">
</head>

<body>
    <div class="caixa_tabela">
        <h1>Lista de Professores</h1>
        <div class="links">
            <a href="inserir.php">Adicionar Professor</a>
            <a class="voltar" href="../index.php">Gerenciar SISALUNO</a>
        </div>
        <br><br>
        <table class="aluno-list">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>CPF</th>
                <th>Siape</th>
                <th>Idade</th>
                <th>Ações</th>
            </tr>
            <?php foreach ($professores as $professor) { ?>
                <tr>
                    <td><?php echo $professor['idprofessor']; ?></td>
                    <td><?php echo $professor['nomeprof']; ?></td>
                    <td><?php echo $professor['cpf']; ?></td>
                    <td><?php echo $professor['siape']; ?></td>
                    <td><?php echo $professor['idade']; ?></td>
                    <td>
                        <a class="alterar" href="alterar.php?idprofessor=<?php echo $professor['idprofessor']; ?>">Alterar</a>
                        <a class="excluir" href="excluir.php?idprofessor=<?php echo $professor['idprofessor']; ?>&nomeprof=<?php echo $professor['nomeprof']; ?>">Excluir</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
        <br>
        <br>

    </div>
</body>

</html>