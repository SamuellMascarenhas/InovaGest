<?php
// excluir_boletos.php
include_once ('../../conexao.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $boletosSelecionados = json_decode($_POST['boletos']);

    // Verifique se há boletos selecionados
    if (!empty($boletosSelecionados)) {
        // Crie a instrução preparada
        $stmt = mysqli_prepare($conexao, "DELETE FROM boletos WHERE cod_boleto = ?");

        // Vincule os parâmetros usando um loop
        foreach ($boletosSelecionados as $boleto) {
            mysqli_stmt_bind_param($stmt, 'i', $boleto);

            // Execute a instrução preparada
            mysqli_stmt_execute($stmt);
        }

        // Feche a instrução
        mysqli_stmt_close($stmt);

        echo "Boletos excluídos com sucesso!";
    } else {
        echo "Nenhum boleto selecionado para exclusão.";
    }
} else {
    echo "Método de requisição inválido.";
}
?>