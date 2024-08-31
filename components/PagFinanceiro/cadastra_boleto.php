<?php
include_once ('../../conexao.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se todos os campos foram preenchidos
    if (isset($_POST['beneficiario']) && isset($_POST['data']) && isset($_POST['valor'])) {
        // Obtém os valores dos campos do formulário
        $beneficiario = $_POST['beneficiario'];
        $data = $_POST['data'];
        $valor = $_POST['valor'];

        // Insira a lógica para cadastrar o boleto no banco de dados aqui
        // Por exemplo:
        $query = "INSERT INTO boletos (beneficiario, vencimento, vlrPagamento) VALUES ('$beneficiario', '$data', $valor)";
        $resultado = mysqli_query($conexao, $query);

        if ($resultado) {
            header("Location: boletoCadastrado.php");
        } else {
            echo "Erro ao cadastrar o boleto: " . mysqli_error($conexao);
        }
    } else {
        echo "Por favor, preencha todos os campos.";
    }
}
?>