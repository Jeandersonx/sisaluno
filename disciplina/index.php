<?php
// Requer o arquivo de conexão com o banco de dados
require_once "../conn.php";

// Prepara e executa a query para selecionar todas as disciplinas
$stmt = $conn->prepare("SELECT * FROM disciplina");
$stmt->execute();
$disciplinas = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Função para obter o nome do professor a partir do ID do professor
function getProfessorName($conn, $idprofessor)
{
    $stmt = $conn->prepare("SELECT nomeprof FROM professor WHERE idprofessor = :idprofessor");
    $stmt->bindParam(':idprofessor', $idprofessor);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['nomeprof'];
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Disciplinas</title>
    <link rel="stylesheet" type="text/css" href="../style.css">
</head>

<body>
    <div class="caixa_tabela">
        <h1>Lista de Disciplinas</h1>
        <div class="links">
            <a href="inserir.php">Adicionar Disciplina</a>
            <a class="voltar" href="../index.php">Gerenciar SISALUNO</a>
        </div>
        <br><br>
        <table>
            <tr>
                <th>ID</th>
                <th>Disciplina</th>
                <th>Carga Horária</th>
                <th>Semestre</th>
                <th>Professor</th>
                <th>Ações</th>
            </tr>
            <?php foreach ($disciplinas as $disciplina) { ?>
                <tr>
                    <td><?php echo $disciplina['iddisciplina']; ?></td>
                    <td><?php echo $disciplina['disciplina']; ?></td>
                    <td><?php echo $disciplina['ch']; ?></td>
                    <td><?php echo $disciplina['semestre']; ?></td>
                    <td><?php echo getProfessorName($conn, $disciplina['idprofessor']); ?></td>
                    <td>
                        <a class="alterar" href="alterar.php?iddisciplina=<?php echo $disciplina['iddisciplina']; ?>">Alterar</a>
                        <a class="excluir" href="excluir.php?iddisciplina=<?php echo $disciplina['iddisciplina']; ?>&disciplina=<?php echo $disciplina['disciplina']; ?>">Excluir</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
        <br>
        <br>

    </div>
</body>

</html>