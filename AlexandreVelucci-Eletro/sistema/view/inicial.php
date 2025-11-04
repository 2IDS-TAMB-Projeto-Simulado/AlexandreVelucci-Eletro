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
        <title>Página Inicial</title>
        <link rel="stylesheet" href="./../css/styles.css">
    </head>
    <body>
        <h1>Página Inicial</h1>
        
        <h2>Loja de Eletrodomésticos</h2>
        <h3>Bem vindo, <?php echo $_SESSION['usuario']['USU_NOME']; ?>!</h3>
        <a href="listar_eletros.php"><button>Cadastrar Eletrodoméstico</button></a>
        <a href="gestao_estoque.php"><button>Gestão de Estoque</button></a>
        <a href="login.php"><button>Logout</button></a>
    </body>
</html>