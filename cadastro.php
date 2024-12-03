<?php
session_start();
include('conexao.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'];
    $senha = md5($_POST['senha']); 
    $confirmar_senha = md5($_POST['confirmar_senha']);

    if ($senha !== $confirmar_senha) {
        $error = "As senhas não coincidem.";
    } else {
       
        $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $error = "Usuário já existe.";
        } else {
            $sql_insert = "INSERT INTO usuarios (usuario, senha, tipo) VALUES ('$usuario', '$senha', 'usuario')";
            if ($conn->query($sql_insert) === TRUE) {
                $_SESSION['usuario'] = $usuario;
                header('Location: home.php'); 
                exit();
            } else {
                $error = "Erro ao criar conta: " . $conn->error;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to bottom, #ffffff, #234467bd);
            background-attachment: fixed;
            background-size: cover;
            height: 100%;
            margin: 0;
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

        input, button {
            width: 100%;
            padding: 15px;
            margin-bottom: 15px;
            border: none;
            border-radius: 10px;
        }

        button {
            background-color: #234467;
            color: aliceblue;
            cursor: pointer;
        }

        button:hover {
            background-color: #43648a;
        }

        h2 {
            text-align: center;
        }
    </style>
</head>
<body>
    <div>
        <h2>Criar Conta</h2>
        <form method="post" action="">
            <input type="text" name="usuario" placeholder="Usuário" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <input type="password" name="confirmar_senha" placeholder="Confirmar Senha" required>
            <?php if (isset($error)) echo "<p>$error</p>"; ?>
            <button type="submit">Cadastrar</button>
        </form>
    </div>
</body>
</html>
