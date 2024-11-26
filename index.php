<?php include('valida_sessao.php'); ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Painel Principal</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
<audio id="background-music" loop autoplay>
        <source src="audio.mp3" type="audio/mpeg">
    </audio>
    
<header class="header">
    <div class="logo">
        <h1>Hidratec</h1>
    </div>
    <nav class="navigation">
        <ul>
            <li><a href="index.php">Inicio</a></li>
            <li><a href="cadastro_fornecedor.php">cadastro de funcionários</a></li>
            <li><a href="cadastro_produto.php">cadastro de serviços</a></li>
            <li><a href="listagem_produtos.php">lista de serviços</a></li>
            <li><a href="mes.php">Destaques do Mês</a></li>
            <li><a href="login.php">Sair</a></li>
        </ul>
    </nav>
</header>
<main>
    <div class="container">
        <img src="qa.png" alt="Imagem QA" class="qa-image">
        <p class="welcome-text"></p>
        
    </div>
</main>
<script>
    const targetText = "Olá, seja bem-vindo(a) <?php echo $_SESSION['usuario'] ?>.";
    const typingDelay = 100;
    let currentIndex = 0;

    const textElement = document.querySelector(".welcome-text");

    function type() {
        if (currentIndex < targetText.length) {
            textElement.textContent += targetText.charAt(currentIndex);
            currentIndex++;
            setTimeout(type, typingDelay);
        }
    }

    type();
</script>
</body>
</html>


