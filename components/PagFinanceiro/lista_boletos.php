<?php
// lista_boletos.php
include_once ('../../conexao.php');

$consultaBoletos = mysqli_query($conexao, "SELECT cod_boleto, beneficiario, vlrPagamento, DATE_FORMAT(vencimento, '%d-%m-%Y') as vencimento FROM boletos ORDER BY vencimento");

?>

<table>
    <tr>
        <th>Selecionar</th>
        <th>Cód</th>
        <th>Beneficiario</th>
        <th>Vlr Pagamento</th>
        <th>Vencimento</th>
    </tr>

    <?php
    while ($boleto = mysqli_fetch_array($consultaBoletos)) {
        echo "<tr>
                <td><input type='checkbox' name='selecionados[]' value='" . $boleto['cod_boleto'] . "'></td>
                <td>" . $boleto['cod_boleto'] . "</td>
                <td>" . $boleto['beneficiario'] . "</td>
                <td>" . number_format($boleto['vlrPagamento'], 2, ',', '.') . "</td>
                <td>" . $boleto['vencimento'] . "</td>
            </tr>";
    }
    ?>
</table>