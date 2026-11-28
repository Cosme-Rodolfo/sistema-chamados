<?php 
require_once 'config/conexao.php';

//1. Verifica se o formulario foi submetido via método POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $prioridade = $_POST['prioridade'];
    $usuario_id = $_POST['usuario_id'];

    //Prepara a query com marcadores (:nome) para bloquear SQL Injection
    $sql = "INSERT INTO chamados (titulo, prioridade, usuario_id) VALUES (:titulo, :prioridade, :usuario_id)";
    $stmt = $pdo->prepare($sql);

    //Vincula os valores reais aos marcadores e executa no MySQL
    $stmt->execute([
        ':titulo' => $titulo,
        ':prioridade' => $prioridade,
        ':usuario_id' => $usuario_id
    ]);

    //Redireciona de volta para a página inicial após gravar
    header('Location: index.php');
}

//2. Busca os usuários cadastrados para preencher o campo <select>
$stmtUsuarios = $pdo->query("SELECT id, nome FROM usuarios ORDER BY nome ASC");
$usuarios = $stmtUsuarios->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Abrir Novo Chamado</title>
</head>
<body>
    <h1>Abrir Novo Chamado</h1>
    <p><a href="index.php">← Voltar para a listagem</a></p>

    <form method="POST" action="novo_chamado.php">
        <div>
            <label for="titulo">Título do Problema:</label><br>
            <input type="text" id="titulo" name="titulo" required>
        </div>
        <br>
        <div>
            <label for="prioridade">Prioridade:</label><br>
            <select id="prioridade" name="prioridade">
                <option value="baixa">Baixa</option>
                <option value="media" selected>Média</option>
                <option value="alta">Alta</option>
            </select>
        </div>
        <br>
        <div>
            <label for="usuario_id">Solicitante:</label><br>
            <select id="usuario_id" name="usuario_id" required>
                <?php foreach ($usuarios as $usuario): ?>
                    <option value="<?= $usuario['id'] ?>">
                        <?= htmlspecialchars($usuario['nome']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <br>
        <button type="submit">Salvar Chamado</button>
    </form>
</body>
</html>