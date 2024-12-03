<?php
include 'conexao.php'; // Conexão com o banco de dados

// Consulta para buscar os contratos e os produtos relacionados, incluindo o preço
$sql = "SELECT 
            contratos.id AS contrato_id,
            produtos.nome AS produto_nome,
            contratos.quantidade,
            contratos.data_contrato,
            contratos.cliente_nome,
            contratos.cliente_email,
            contratos.observacoes,
            produtos.preco
        FROM contratos
        JOIN produtos ON contratos.produto_id = produtos.id";

$result = $conn->query($sql);

// Inicializar a variável para o valor total
$total = 0;
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Carrinho</title>
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
            <li><a href="cadastro_produto.php">cadastro de serviços</a></li>
            <li><a href="listagem_produtos.php">lista de serviços</a></li>
            <li><a href="mes.php">Destaques do Mês</a></li>
            <li><a href="login.php">Sair</a></li>
        </ul>
    </nav>
</header>
<div class="container2">
    <h1>Listagem de Contratos</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Produto</th>
                <th>Quantidade</th>
                <th>Data</th>
                <th>Cliente</th>
                <th>E-mail</th>
                <th>Observações</th>
                <th>Preço Unitário</th>
                <th>Valor Total</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    
                    $valor_total = $row['preco'] * $row['quantidade'];
                    $total += $valor_total;  

                    echo "<tr>
                            <td>{$row['contrato_id']}</td>
                            <td>{$row['produto_nome']}</td>
                            <td>{$row['quantidade']}</td>
                            <td>{$row['data_contrato']}</td>
                            <td>{$row['cliente_nome']}</td>
                            <td>{$row['cliente_email']}</td>
                            <td>{$row['observacoes']}</td>
                            <td>R$ " . number_format($row['preco'], 2, ',', '.') . "</td>
                            <td>R$ " . number_format($valor_total, 2, ',', '.') . "</td>
                            <td>
                                <a href='contrato.php?edit_id={$row['contrato_id']}'>Editar</a>
                                <a href='contrato.php?delete_id={$row['contrato_id']}' onclick=\"return confirm('Tem certeza que deseja excluir?')\">Excluir</a>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='10'>Nenhum contrato encontrado</td></tr>";
            }
            ?>
        </tbody>
    </table>

    </div>
</body>
</html>
