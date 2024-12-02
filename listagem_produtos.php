<?php
include 'conexao.php'; // Inclui a conexão com o banco de dados

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
    <title>Lista de Serviços</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
<header class="header">
    <div class="logo">
        <h1>Hidratec</h1>
    </div>
    <nav class="navigation">
        <ul>
            <li><a href="index.php">Inicio</a></li>
            <li><a href="cadastro_produto.php">Cadastro de serviços</a></li>
            <li><a href="listagem_produtos.php">lista de serviços</a></li>
            <li><a href="mes.php">Destaques do Mês</a></li>
            <li><a href="login.php">Sair</a></li>
        </ul>
    </nav>
</header>
<div class="container1">
    <h2>Lista de Serviços</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID do Pedido</th>
                <th>Nome do Comprador</th>
                <th>Produto</th>
                <th>Quantidade</th>
                <th>Preço</th>
                <th>Valor Total</th>
                <th>Data do Servico</th>
            </tr>
        </thead>
        <tbody>
            <?php
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
        </tbody>
    </table>
</div>  
</body>
</html>
