<?php
session_start();
include('conexao.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'];
    $senha = md5($_POST['senha']); // Usando MD5 para hashing básico

    // Verificar se o usuário já existe no banco de dados
    $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // O usuário existe, verificar a senha
        $row = $result->fetch_assoc();
        if ($row['senha'] === $senha) {
            $_SESSION['usuario'] = $usuario;

            // Redirecionar de acordo com o tipo de usuário
            if ($row['tipo'] == 'admin') {
                header('Location: index.php'); // Página para o administrador
            } else {
                header('Location: home.php'); // Página para o usuário comum
            }
            exit();
        } else {
            $error = "Senha incorreta.";
        }
    } else {
        // O usuário não existe, oferecer a opção de criar um perfil
        if (isset($_POST['criar_perfil']) && $_POST['criar_perfil'] == '1') {
            // Inserir o novo usuário no banco de dados
            $sql_insert = "INSERT INTO usuarios (usuario, senha, tipo) VALUES ('$usuario', '$senha', 'usuario')";
            if ($conn->query($sql_insert) === TRUE) {
                $_SESSION['usuario'] = $usuario;
                header('Location: index.php'); // Redirecionar após criar o perfil
                exit();
            } else {
                $error = "Erro ao criar perfil: " . $conn->error;
            }
        } else {
            $error = "Usuário não encontrado. Deseja criar um perfil?";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        html, body {
            height: 100%;
            margin: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to bottom, #ffffff, #234467bd);
            background-attachment: fixed;
            background-size: cover;
        }

        div {
            background-color: rgba(0, 0, 0, 0.7);
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 80px;
            border-radius: 25px;
            color: aliceblue;
        }

        input {
            padding: 15px;
            border: none;
            outline: none;
            font-size: 15px;
            width: 100%;
            margin-bottom: 15px;
        }

        button {
            background-color: #234467;
            border: none;
            padding: 15px;
            width: 100%;
            border-radius: 10px;
            color: aliceblue;
        }

        button:hover {
            background-color: #43648a;
            cursor: pointer;
        }

        h2 {
            text-align: center;
            font-size: 30px;
        }
    </style>
</head>
<body>
    <div>
        <h2>Login</h2>
        <form method="post" action="">
            <input type="text" name="usuario" placeholder="Usuário" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <?php if (isset($error)) echo "<p>$error</p>"; ?>
            
            <!-- Botão de login -->
            <button type="submit">Entrar</button>

            <!-- Caso o usuário não exista, exibir opção de criar perfil -->
            <?php if (isset($error) && strpos($error, 'Deseja criar') !== false): ?>
                <input type="hidden" name="criar_perfil" value="1">
                <button type="submit">Criar Perfil</button>
            <?php endif; ?>
        </form>
    </div>
</body>
</html>


