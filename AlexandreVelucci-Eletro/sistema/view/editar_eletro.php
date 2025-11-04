<?php
require_once "./../controller/controller_eletrodomestico.php";

if(!isset($_SESSION['usuario'])){
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">       
        <title>Editar Eletrodoméstico</title>
        <link rel="stylesheet" href="./../css/styles.css">
    </head>
    <body>
        <h1>Editar Eletrodoméstico</h1>
        <form action="" method="POST">
            <label>Nome:</label>
            <br>
            <input type="text" id="eletro_nome" name="eletro_nome" value="<?php echo $eletro_editar["ELETRO_NOME"]; ?>" required>

            <br>
            <br>

            <label>Fornecedor:</label>
            <br>
            <input type="text" id="fornecedor" name="fornecedor" value="<?php echo $eletro_editar["ELETRO_FORNECEDOR"]; ?>" required>

            <br>
            <br>

            <label>Categoria:</label>
            <br>
            <input type="text" id="categoria" name="categoria" value="<?php echo $eletro_editar["ELETRO_CATEGORIA"]; ?>" required>

            <br>
            <br>

             <label>Garantia:</label>
            <br>
            <input type="date" id="garantia" name="garantia" value="<?php echo $eletro_editar["ELETRO_GARANTIA"]; ?>" required>

            <br>
            <br>

            <label>Potência:</label>
            <br>
            <input type="text" id="potencia" name="potencia" value="<?php echo $eletro_editar["ELETRO_POTENCIA"]; ?>" required>

            <br>
            <br>

            <label>Consumo:</label>
            <br>
            <input type="text" id="consumo" name="consumo" value="<?php echo $eletro_editar["ELETRO_CONSUMO"]; ?>" required>

            <br>
            <br>

             <label>Prioridade de Reposição:</label>
            <br>
            <input type="text" id="prioridade_reposicao" name="prioridade_reposicao" value="<?php echo $eletro_editar["ELETRO_PRIORIDADE_REPOSICAO"]; ?>" required>

            <br>
            <br>

            <input type="submit" id="editar_eletro" name="editar_eletro" value="Salvar Alterações">
        </form>
        <br>
        <a href="inicial.php"><button>Voltar</button></a>
    </body>
</html>