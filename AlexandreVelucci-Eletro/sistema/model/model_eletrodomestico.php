<?php
    require_once "../config/db.php";
    require_once "model_estoque.php";
    require_once "model_logs.php";

    class Eletrodomestico{
        public function cadastrar_eletro($eletro_nome, $fornecedor, $categoria, $eletro_garantia, $eletro_potencia, $eletro_consumo, $prioridade_reposicao, $fk_usu_id) {
            $conn = Database::getConnection();
            $insert = $conn->prepare("INSERT INTO ELETRODOMESTICO (ELETRO_NOME, ELETRO_FORNECEDOR, ELETRO_CATEGORIA, ELETRO_GARANTIA, ELETRO_POTENCIA, ELETRO_CONSUMO, ELETRO_PRIORIDADE_REPOSICAO, FK_USU_ID) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $insert->bind_param("sssssssi", $eletro_nome, $fornecedor, $categoria, $eletro_garantia, $eletro_potencia, $eletro_consumo, $prioridade_reposicao, $fk_usu_id);
            $success = $insert->execute();

            if($success){
                $eletro_id = $conn->insert_id;

                $estoque = new Estoque();
                $estoque->adicionar_estoque(0,$fk_usu_id,$eletro_id);

                $logs = new Logs();
                $logs->cadastrar_logs("ELETRO <br> ID: ".$eletro_id." <br> NOME: ".$eletro_nome." <br> AÇÃO: Cadastrado! <br> ID USUÁRIO: ".$fk_usu_id);
            }

            $insert->close();
            return $success;
        }

        public function listar_eletros() {
            $conn = Database::getConnection();
            $sql = "SELECT      E.ELETRO_ID,
                                E.ELETRO_NOME,
                                E.ELETRO_FORNECEDOR,
                                E.ELETRO_CATEGORIA,
                                E.ELETRO_GARANTIA,
                                E.ELETRO_POTENCIA,
                                E.ELETRO_CONSUMO,
                                E.ELETRO_PRIORIDADE_REPOSICAO,
                                ES.ESTQ_QUANTIDADE,
                                U.USU_NOME,
                                U.USU_EMAIL
                    FROM        ELETRODOMESTICO E
                    left JOIN        USUARIO U ON E.FK_USU_ID = U.USU_ID
                    left JOIN        ESTOQUE ES ON E.ELETRO_ID = ES.FK_ELETRO_ID
                    ORDER BY    E.ELETRO_NOME";
            $result = $conn->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        }

        public function excluir_eletro($eletro_id, $fk_usu_id) {
            $conn = Database::getConnection();
            $delete = $conn->prepare("DELETE FROM ELETRODOMESTICO WHERE ELETRO_ID = ?");
            $delete->bind_param("i", $eletro_id);

            $logs = new Logs();
            $logs->cadastrar_logs("ELETRODOMÉSTICO <br> ID: ".$eletro_id." <br> AÇÃO: Excluído! <br> ID USUÁRIO: ".$fk_usu_id);
            
            $success = $delete->execute();
            $delete->close();
            return $success;
        }

        public function buscar_eletro_pelo_id($id) {
            $conn = Database::getConnection();
            $select = $conn->prepare("SELECT        E.ELETRO_ID,
                                                    E.ELETRO_NOME,
                                                    E.ELETRO_FORNECEDOR,
                                                    E.ELETRO_CATEGORIA,
                                                    E.ELETRO_GARANTIA,
                                                    E.ELETRO_POTENCIA,
                                                    E.ELETRO_CONSUMO,
                                                    E.ELETRO_PRIORIDADE_REPOSICAO,
                                                    ES.ESTQ_QUANTIDADE,
                                                    U.USU_NOME,
                                                    U.USU_EMAIL
                                        FROM        ELETRODOMESTICO E
                                        JOIN        USUARIO U ON E.FK_USU_ID = U.USU_ID
                                        JOIN        ESTOQUE ES ON E.ELETRO_ID = ES.FK_ELETRO_ID
                                        WHERE       E.ELETRO_ID = ?
                                        ORDER BY    E.ELETRO_NOME");
            $select->bind_param("i", $id);
            $select->execute();
            $result = $select->get_result();
            $eletro = $result->fetch_all(MYSQLI_ASSOC);
            $select->close();
            return $eletro;
        }

        public function editar_eletro($eletro_nome, $fornecedor, $categoria, $eletro_garantia, $eletro_potencia, $eletro_consumo, $prioridade_reposicao, $eletro_id, $fk_usu_id) {
            $conn = Database::getConnection();
            $insert = $conn->prepare("UPDATE ELETRODOMESTICO SET ELETRO_NOME = ?, ELETRO_FORNECEDOR = ?, ELETRO_CATEGORIA = ?, ELETRO_GARANTIA = ?, ELETRO_POTENCIA = ?, ELETRO_CONSUMO = ?, ELETRO_PRIORIDADE_REPOSICAO = ? WHERE ELETRO_ID = ?");
            $insert->bind_param("sssssssi", $eletro_nome, $fornecedor, $categoria, $eletro_garantia, $eletro_potencia, $eletro_consumo, $prioridade_reposicao, $eletro_id);
            $success = $insert->execute();

            if($success){
                $logs = new Logs();
                $logs->cadastrar_logs("Eletrodoméstico <br> ID: ".$eletro_id." <br> eletro_nome: ".$eletro_nome." <br> AÇÃO: Editado! <br> ID USUÁRIO: ".$fk_usu_id);
            }

            $insert->close();
            return $success;
        }

        public function filtrar_eletro($campo) {
            $conn = Database::getConnection();
            $select = $conn->prepare("SELECT        E.ELETRO_ID,
                                                    E.ELETRO_NOME,
                                                    E.ELETRO_FORNECEDOR,
                                                    E.ELETRO_CATEGORIA,
                                                    E.ELETRO_GARANTIA,
                                                    E.ELETRO_PRIORIDADE_REPOSICAO,
                                                    ES.ESTQ_QUANTIDADE,
                                                    E.ELETRO_POTENCIA,
                                                    E.ELETRO_CONSUMO,
                                                    U.USU_NOME,
                                                    U.USU_EMAIL
                                        FROM        ELETRODOMESTICO E
                                        JOIN        USUARIO U ON E.FK_USU_ID = U.USU_ID
                                        JOIN        ESTOQUE ES ON E.ELETRO_ID = ES.FK_ELETRO_ID
                                        WHERE       E.ELETRO_NOME LIKE ?
                                        ORDER BY    E.ELETRO_NOME");
            $termo = "%" . $campo . "%";
            $select->bind_param("s", $termo);
            $select->execute();
            $result = $select->get_result();
            $eletros = $result->fetch_all(MYSQLI_ASSOC);
            $select->close();
            return $eletros;
        }
    }
?>