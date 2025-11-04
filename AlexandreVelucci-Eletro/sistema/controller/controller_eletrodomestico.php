<?php
    require_once "../model/model_eletrodomestico.php";
    session_start();

    //CADASTRAR ELETROMÉSTICO
    if(isset($_POST["cadastrar_eletro"])){
        $eletro = new Eletrodomestico();
        $resultado = $eletro->cadastrar_eletro($_POST["eletro_nome"], $_POST["fornecedor"], $_POST["categoria"], $_POST["garantia"], $_POST["potencia"], $_POST["consumo"], $_POST["prioridade_reposicao"], $_SESSION['usuario']["USU_ID"], $_POST["quantidade"]);
        if($resultado){
            echo "<script>
                    alert('Eletrodoméstico cadastrado com sucesso!');
                    window.location.href='../view/listar_eletros.php';
                </script>";
        } 
        else {
            echo "<script>
                    alert('Erro ao cadastrar eletrodoméstico!');
                    window.location.href='../view/listar_eletros.php';
                </script>";
        }
        exit();
    }

    //BUSCAR DADOS PARA EDITAR ELETROMÉSTICO
    else if(isset($_GET["acao"]) && $_GET["acao"] == "editar_eletro"){
        $eletro = new Eletrodomestico();
        $resultados = $eletro->buscar_eletro_pelo_id($_GET["id"]);

        if(!empty($resultados)) {
            $eletro_editar = $resultados[0];
        } else {
            echo "<script>
                    alert('Eletrodoméstico não encontrado!');
                    window.location.href='listar_eletros.php';
                </script>";
            exit();
        }
    }

    //EDITAR ELETROMÉSTICO
    if(isset($_POST["editar_eletro"])){
        $eletro = new Eletrodomestico();
        $resultado = $eletro->editar_eletro($_POST["eletro_nome"], $_POST["fornecedor"], $_POST["categoria"],  $_POST["garantia"], $_POST["potencia"], $_POST["consumo"], $_POST["prioridade_reposicao"], $_GET["id"], $_SESSION['usuario']["USU_ID"]);
        if($resultado){
            echo "<script>
                    alert('Eletrodoméstico atualizado com sucesso!');
                    window.location.href='../view/listar_eletros.php';
                </script>";
        } 
        else {
            echo "<script>
                    alert('Erro ao atualizar eletrodoméstico!');
                    window.location.href='../view/listar_eletros.php';
                </script>";
        }
        exit();
    }

    //EXCLUIR ELETROMÉSTICO
    else if(isset($_GET["acao"]) && $_GET["acao"] == "excluir_eletro"){
        $eletro = new Eletrodomestico();
        $resultado = $eletro->excluir_eletro($_GET["id"], $_SESSION['usuario']['USU_ID']);
        if($resultado){
            echo "<script>
                    alert('Eletrodoméstico excluído com sucesso!');
                    window.location.href='../view/listar_eletros.php';
                </script>";
        } 
        else {
            echo "<script>
                    alert('Erro ao excluir eletrodoméstico!');
                    window.location.href='../view/listar_eletros.php';
                </script>";
        }
        exit();
    }
?>