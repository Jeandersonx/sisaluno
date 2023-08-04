<?php
// Requer o arquivo de conexão com o banco de dados
require_once "../conn.php";

// Prepara e executa a query para selecionar todos os alunos
$stmt = $conn->prepare("SELECT * FROM aluno");
$stmt->execute();
$alunos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>

<head>
    <title>Alunos</title>
    <link rel="stylesheet" type="text/css" href="../style.css">
</head>

<body>
    <div class="caixa_tabela">
        <h1>Lista de Alunos</h1>
        <div class="links">
            <a href="inserir.php">Adicionar Aluno</a>
            <a class="voltar" href="../index.php">Gerenciar SISALUNO</a>
        </div>
        <br><br>
        <table>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Idade</th>
                <th>Data de Nascimento</th>
                <th>Endereço</th>
                <th>Status</th>
                <th>Matricula</th>
                <th>Ações</th>
            </tr>
            <?php foreach ($alunos as $aluno) { ?>
                <tr>
                    <td><?php echo $aluno['idaluno']; ?></td>
                    <td><?php echo $aluno['nome']; ?></td>
                    <td><?php echo $aluno['idade']; ?></td>
                    <td><?php echo $aluno['datanascimento']; ?></td>
                    <td><?php echo $aluno['endereco']; ?></td>
                    <td><?php echo $aluno['estatus']; ?></td>
                    <td><?php echo $aluno['matricula']; ?></td>
                    <td>
                        <a class="alterar" href="alterar.php?idaluno=<?php echo $aluno['idaluno']; ?>">Alterar</a>
                        <a class="excluir" href="excluir.php?idaluno=<?php echo $aluno['idaluno']; ?>&nome=<?php echo $aluno['nome']; ?>">Excluir</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
        <br>
        <br>

    </div>
</body>

</html>