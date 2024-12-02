<?php
include 'conexao.php'; // Inclui a conexão com o banco

$mensagem = ""; // Variável para exibir mensagens

// Tratamento para adicionar ou editar contrato
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $produto_id = $_POST['produto_id'];
    $quantidade = $_POST['quantidade'];
    $data_contrato = $_POST['data_contrato'];
    $cliente_nome = $_POST['cliente_nome'];
    $cliente_email = $_POST['cliente_email'];
    $observacoes = $_POST['observacoes'];

    if ($id) {
        $sql = "UPDATE contratos SET produto_id=?, quantidade=?, data_contrato=?, cliente_nome=?, cliente_email=?, observacoes=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iissssi", $produto_id, $quantidade, $data_contrato, $cliente_nome, $cliente_email, $observacoes, $id);
        $mensagem = "Contrato atualizado com sucesso!";
    } else {
        $sql = "INSERT INTO contratos (produto_id, quantidade, data_contrato, cliente_nome, cliente_email, observacoes) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iissss", $produto_id, $quantidade, $data_contrato, $cliente_nome, $cliente_email, $observacoes);
        $mensagem = "Contrato adicionado com sucesso!";
    }

    if (!$stmt->execute()) {
        $mensagem = "Erro: " . $stmt->error;
    }
}

// Tratamento para deletar contrato
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $sql = "DELETE FROM contratos WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $delete_id);
    if ($stmt->execute()) {
        $mensagem = "Contrato excluído com sucesso!";
    } else {
        $mensagem = "Erro ao excluir contrato: " . $stmt->error;
    }
}

// Buscar contratos para exibição
$sql = "SELECT 
            contratos.id AS contrato_id,
            produtos.nome AS produto_nome,
            contratos.quantidade,
            contratos.data_contrato,
            contratos.cliente_nome,
            contratos.cliente_email,
            contratos.observacoes
        FROM contratos
        JOIN produtos ON contratos.produto_id = produtos.id";
$contratos = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Contrato de Serviço</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header class="header">
    <div class="logo">
        <h1>HidratecShop</h1>
    </div>
    <nav class="navigation">
        <ul>
            <li><a href=".php">Início</a></li>
            <li><a href="produtos.php">Produtos</a></li>
            <li><a href="contrato.php">Contrato de serviços</a></li>
            <li><a href="login.php">Sair</a></li>
            <li><a href="carrinho.php"><svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
  <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
</svg></li></a>
        </ul>
    </nav>
</header>
    <h1>Contrato de Serviço</h1>

    <?php if ($mensagem): ?>
        <p class="mensagem"><?php echo $mensagem; ?></p>
    <?php endif; ?>

    <form action="contrato.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $_GET['edit_id'] ?? ''; ?>">

        <label for="produto_id">Produto:</label>
        <select name="produto_id" id="produto_id" required>
            <?php
            // Busca os produtos no banco
            $result = $conn->query("SELECT id, nome FROM produtos");
            while ($row = $result->fetch_assoc()) {
                $selected = (isset($_GET['edit_id']) && $row['id'] == $contrato['produto_id']) ? 'selected' : '';
                echo "<option value='{$row['id']}' $selected>{$row['nome']}</option>";
            }
            ?>
        </select><br>

        <label for="quantidade">Quantidade:</label>
        <input type="number" name="quantidade" id="quantidade" required><br>

        <label for="data_contrato">Data:</label>
        <input type="date" name="data_contrato" id="data_contrato" required><br>

        <label for="cliente_nome">Nome do Cliente:</label>
        <input type="text" name="cliente_nome" id="cliente_nome" required><br>

        <label for="cliente_email">E-mail do Cliente:</label>
        <input type="email" name="cliente_email" id="cliente_email"><br>

        <label for="observacoes">Observações:</label>
        <textarea name="observacoes" id="observacoes"></textarea><br>

        <button type="submit">Salvar Contrato</button>
    </form>

        </tbody>
    </table>
</body>
</html>
