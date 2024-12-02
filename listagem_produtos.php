<?php
include 'conexao.php'; // Inclui a conexão com o banco de dados

// Suponhamos que o ID do usuário esteja armazenado em uma variável de sessão (por exemplo, após o login)
session_start();
$usuario_id = $_SESSION['usuario_id'];  // A sessão deve estar configurada no login do usuário

// Buscar os pedidos anteriores do usuário
$sql_pedidos_anteriores = "
    SELECT 
        pedidos.id AS pedido_id,
        pedidos.nome_comprador,
        pedidos.email_comprador,
        pedidos.telefone_comprador,
        pedidos.pagamento,
        pedidos.horario,
        pedidos.total,
        pedidos.data_compra,
        produtos.nome AS produto_nome,
        itens_pedido.quantidade,
        itens_pedido.preco,
        itens_pedido.valor_item
    FROM pedidos
    JOIN itens_pedido ON pedidos.id = itens_pedido.pedido_id
    JOIN produtos ON itens_pedido.produto_id = produtos.id
    WHERE pedidos.nome_comprador = (SELECT nome FROM usuarios WHERE id = ?)
    ORDER BY pedidos.data_compra DESC";  // Buscar pedidos mais recentes primeiro

$stmt = $conn->prepare($sql_pedidos_anteriores);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$result_pedidos_anteriores = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Processar Compra</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Processar Compra</h1>

    <!-- Exibição de compras anteriores -->
    <h2>Histórico de Compras</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID do Pedido</th>
                <th>Nome do Comprador</th>
                <th>Produto</th>
                <th>Quantidade</th>
                <th>Preço</th>
                <th>Valor Total</th>
                <th>Data da Compra</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Verifica se há pedidos anteriores
            if ($result_pedidos_anteriores && $result_pedidos_anteriores->num_rows > 0) {
                while ($row = $result_pedidos_anteriores->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['pedido_id']}</td>
                            <td>{$row['nome_comprador']}</td>
                            <td>{$row['produto_nome']}</td>
                            <td>{$row['quantidade']}</td>
                            <td>{$row['preco']}</td>
                            <td>{$row['valor_item']}</td>
                            <td>{$row['data_compra']}</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='7'>Nenhum histórico de compras encontrado</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <!-- Formulário para processar nova compra -->
    <h2>Nova Compra</h2>
    <form action="finalizar_compra.php" method="POST">
        <!-- Detalhes da nova compra (por exemplo, seleção de produtos, quantidade) -->
        <label for="produto_id">Produto:</label>
        <select name="produto_id" id="produto_id" required>
            <?php
            // Busca os produtos disponíveis no banco
            $result_produtos = $conn->query("SELECT id, nome FROM produtos");
            while ($row = $result_produtos->fetch_assoc()) {
                echo "<option value='{$row['id']}'>{$row['nome']}</option>";
            }
            ?>
        </select><br>

        <label for="quantidade">Quantidade:</label>
        <input type="number" name="quantidade" id="quantidade" required><br>

        <label for="data_compra">Data da Compra:</label>
        <input type="date" name="data_compra" id="data_compra" required><br>

        <label for="cliente_nome">Nome do Cliente:</label>
        <input type="text" name="cliente_nome" id="cliente_nome" required><br>

        <label for="cliente_email">E-mail do Cliente:</label>
        <input type="email" name="cliente_email" id="cliente_email"><br>

        <label for="observacoes">Observações:</label>
        <textarea name="observacoes" id="observacoes"></textarea><br>

        <button type="submit">Finalizar Compra</button>
    </form>
</body>
</html>
