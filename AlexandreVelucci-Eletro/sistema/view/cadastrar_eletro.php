<?php
session_start();

if(!isset($_SESSION['usuario'])){
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">       
        <title>Cadastro de Eletrodomésticos</title>
        <link rel="stylesheet" href="./../css/styles.css">
    </head>
    <body>
        <h1>Cadastro de Eletrodomésticos</h1>
        <form action="./../controller/controller_eletrodomestico.php" method="POST">
            <label>Nome:</label>
            <br>
            <input type="text" id="eletro_nome" name="eletro_nome" placeholder="Nome..." required>

            <br>
            <br>

            <label>Fornecedor:</label>
            <br>
            <input type="text" id="fornecedor" name="fornecedor" placeholder="Descricao..." required>

            <br>
            <br>

            <label>Categoria:</label>
            <br>
            <input type="text" id="categoria" name="categoria" placeholder="Categoria..." required>

            <br>
            <br>

            <label>Garantia:</label>
            <br>
            <input type="date" id="garanti" name="garantia" placeholder="Garantia..." required>

            <br>
            <br>

            <label>Potência:</label>
            <br>
            <input type="text" id="potencia" name="potencia" placeholder="Potência..." required>

            <br>
            <br>

            <label>Consumo:</label>
            <br>
            <input type="text" id="consumo" name="consumo" placeholder="Consumo..." required>

            <br>
            <br>

            <label>Prioridade de Reposição:</label>
            <br>
            <input type="text" id="prioridade_reposicao" name="prioridade_reposicao" placeholder="Prioridade de Reposição..." required>

            <br>
            <br>

            <input type="submit" id="cadastrar_eletro" name="cadastrar_eletro" value="Cadastrar">
        </form>
        <br>
        <a href="inicial.php"><button>Voltar</button></a>
    </body>
</html>