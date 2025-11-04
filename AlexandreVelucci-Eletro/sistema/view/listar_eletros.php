<?php
require_once "./../controller/controller_eletrodomestico.php";

if(!isset($_SESSION['usuario'])){
    header("Location: login.php");
    exit();
}

$eletro = new Eletrodomestico();
if (isset($_POST['botao_pesquisar'])) {
    $resultados = $eletro->filtrar_eletro($_POST['pesquisar']);
} 
else {
    $resultados = $eletro->listar_eletros();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">       
        <title>Lista de Eletrodomésticos</title>
        <link rel="stylesheet" href="./../css/styles.css">
        <link rel="stylesheet" href="./../css/styles.css">
        <style>
            table{
                border-collapse:collapse;
            }
            tr, td, th{
                padding: 12px;
            }
        </style>
    </head>
    <body>
        <h1>Lista de Eletrodomésticos</h1>
        <br/>
        <br/>
        <form method="POST">
            <input type="search" id="pesquisar" name="pesquisar" placeholder="Pesquisar...">
            <input type="submit" id="botao_pesquisar" name="botao_pesquisar" value="Filtrar">
        </form>
        
        <br>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Fornecedor</th>
                <th>Categoria</th>
                <th>Garantia</th>
                <th>Potência</th>
                <th>Consumo </th>
                <th>Prioridade de Reposição</th>
                <th>Editar</th>
                <th>Excluir</th>
            </tr>
            <?php
                if(count($resultados) > 0){
                    foreach($resultados as $r){
                        echo "<tr>";  
                        echo "<td>".$r["ELETRO_ID"]."</td>";
                        echo "<td>".$r["ELETRO_NOME"]."</td>";
                        echo "<td>".$r["ELETRO_FORNECEDOR"]."</td>";
                        echo "<td>".$r["ELETRO_CATEGORIA"]."</td>";
                        echo "<td>".$r["ELETRO_GARANTIA"]."</td>";
                        echo "<td>".$r["ELETRO_POTENCIA"]."</td>";
                        echo "<td>".$r["ELETRO_CONSUMO"]."</td>";
                        echo "<td>".$r["ELETRO_PRIORIDADE_REPOSICAO"]."</td>";
                        echo "<td><a href='editar_eletro.php?acao=editar_eletro&id=".$r["ELETRO_ID"]."'>Editar</a></td>";
                        echo "<td><a href='./../controller/controller_eletrodomestico.php?acao=excluir_eletro&id=".$r["ELETRO_ID"]."'>Excluir</a></td>";
                        echo "</tr>";                            
                    }
                }
                else{
                    echo "<tr>";  
                    echo "<th colspan='6'>Nenhum eletrodoméstico cadastrado!</th>";
                    echo "</tr>";       
                }
            ?>
        </table>
        <br/><br/>
        <br>
        <a href="cadastrar_eletro.php"><button>Cadastrar Eletrodoméstico</button></a>
        <br>
        <br>
        <a href="inicial.php"><button>Voltar</button></a>
    </body>
</html>