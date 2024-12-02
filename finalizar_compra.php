<?php
include 'conexao.php'; // Conexão com o banco de dados

// Inicializar variáveis
$total = 0;
$mensagem = "";

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

// Calcular o total
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $valor_total = $row['preco'] * $row['quantidade'];
        $total += $valor_total;
    }
}

// Processar o formulário, se enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome_comprador = $_POST['nome_comprador'];
    $email_comprador = $_POST['email_comprador'];
    $telefone_comprador = $_POST['telefone_comprador'];
    $pagamento = $_POST['pagamento'];
    $horario = $_POST['horario'] ?? null;
    $total = $_POST['total'];

    // Inserir o pedido na tabela `pedidos`
    $sql_pedido = "INSERT INTO pedidos (nome_comprador, email_comprador, telefone_comprador, pagamento, horario, total)
                   VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql_pedido);
    $stmt->bind_param("sssssd", $nome_comprador, $email_comprador, $telefone_comprador, $pagamento, $horario, $total);

    if ($stmt->execute()) {
        $mensagem = "Compra finalizada com sucesso!";
    } else {
        $mensagem = "Erro ao processar a compra: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Finalizar Compra</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Finalização da Compra</h1>

    <!-- Exibição do valor total do carrinho -->
    <h2>Total do Carrinho: R$ <?php echo number_format($total, 2, ',', '.'); ?></h2>

    <!-- Mensagem de feedback -->
    <?php if ($mensagem): ?>
        <p><?php echo $mensagem; ?></p>
    <?php endif; ?>

    <!-- Formulário de finalização de compra -->
    <form action="" method="POST">
        <h3>Dados Pessoais</h3>
        <label for="nome_comprador">Nome Completo:</label>
        <input type="text" name="nome_comprador" id="nome_comprador" required><br>

        <label for="email_comprador">E-mail:</label>
        <input type="email" name="email_comprador" id="email_comprador" required><br>

        <label for="telefone_comprador">Telefone:</label>
        <input type="text" name="telefone_comprador" id="telefone_comprador" required><br>

        <h3>Modo de Pagamento</h3>
        <label for="pagamento">Escolha o método de pagamento:</label><br>
        <input type="radio" name="pagamento" value="cartao_credito" required> Cartão de Crédito<br>
        <input type="radio" name="pagamento" value="boleto" required> Boleto Bancário<br>
        <input type="radio" name="pagamento" value="paypal" required> PayPal<br>

        <h3>Horário de Preferência para Entrega</h3>
        <label for="horario">Escolha um horário:</label>
        <input type="time" name="horario" id="horario"><br>

        <input type="hidden" name="total" value="<?php echo $total; ?>">

        <br><br>
        <button type="submit">Finalizar Compra</button>
    </form>

    <br><br>
    <a href="carrinho.php">Voltar ao Carrinho</a>
</body>
</html>
