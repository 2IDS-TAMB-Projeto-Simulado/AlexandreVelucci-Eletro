<?php
require_once "../model/model_estoque.php";
session_start();

if (isset($_POST['botao_atualizar'])) {
    if (isset($_POST['botao_atualizar'])) {
    $estoque_atual = intval($_POST['estoque_qtd']);
    $quantidade_alterar = intval($_POST['qtd_aumentar_diminuir']);
    $nova_qtd = 0;
    
    if($_POST['acao_estoque'] == "entrada"){
        $nova_qtd = $estoque_atual + $quantidade_alterar;
    }
    else if($_POST['acao_estoque'] == "saida"){
        $nova_qtd = $estoque_atual - $quantidade_alterar;
        if($nova_qtd < 0){
            echo "<script>
                    alert('Não há estoque suficiente para esta saída!');
                    window.location.href = './../view/gestao_estoque.php';
                  </script>";
            exit;
        }
        if($nova_qtd <= 5){
            echo "<script>
                alert('Estoque do eletrodoméstico está baixo!');
              </script>";
        }
    }
}
    $estoque = new Estoque();
    $success = $estoque->atualizar_estoque($nova_qtd, $_POST["eletro_id"], $_SESSION['usuario']['USU_ID']);

    if($success){
        echo "<script>
                alert('Estoque atualizado com sucesso!');
                window.location.href = './../view/gestao_estoque.php';
              </script>";
    } 
    else {
        echo "<script>
                alert('Falha ao atualizar o estoque!');
                window.location.href = './../view/gestao_estoque.php';
              </script>";
    }
}
?>