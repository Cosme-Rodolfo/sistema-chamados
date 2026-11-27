<?php 
require_once 'config/conexao.php';

$sql = "SELECT chamados.id, chamados.titulo, chamados.status, chamados.prioridade, usuarios.nome AS usuario_nome
FROM chamados
INNER JOIN usuarios ON chamados.usuario_id = usuarios.id
ORDER BY chamados.id ASC";

$stmt = $pdo->query($sql);
$chamados = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
        <meta charset="UTF-8">
        <title>Sistema de Chamados</title>
</head>
<body>
    <h1>Chamados Registrados</h1>

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Status</th>
                <th>Prioridade</th>
                <th>Solicitante</th>
            </tr>
        </thead> 
        <tbody>
            <?php foreach ($chamados as $chamado): ?>
                <tr>
                    <td><?= $chamado['id'] ?></td>
                    <td><?= htmlspecialchars($chamado['titulo']) ?></td>
                    <td><?= $chamado['status'] ?></td>
                    <td><?= $chamado['prioridade'] ?></td>
                    <td><?= htmlspecialchars($chamado['usuario_nome']) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table> 
</body>
</html>


