<!DOCTYPE html>
<?php
include_once ('../../conexao.php');
?>

<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="PagFinanceiro.css">

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- estilo para janela modal -->
    <style>
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 1;
        }

        .modal-content {
            background-color: #fefefe;
            padding: 20px;
            border-radius: 5px;
            max-width: 600px;
            margin: 25px auto;
            overflow: auto;
            box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover {
            color: black;
        }

        .modalButton {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
        }

        .modal-content button {
            margin-top: 15px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            margin-right: 10px;
            border: none;
            border-radius: 5px;
        }


        .modal-content #btnExcluir {
            background-color: #bd0f0f;
            color: white;
        }


        .modal-content #btnCancelar {
            background-color: #aaa;
            color: white;
        }

        /* Adicionei estilos para hover nos botões */
        .modal-content button:hover {
            opacity: 0.8;
        }
    </style>
    <!-- fim estilo janela modal -->

    <!-- scrip para janela modal -->
    <script>

        function abrirModal() {
            var modal = document.getElementById("myModal");
            modal.style.display = "block";

            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'lista_boletos.php', true);

            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    document.getElementById("modalTable").innerHTML = xhr.responseText;
                }
            }

            xhr.send();
        }

        function fecharModal() {
            var modal = document.getElementById("myModal");
            modal.style.display = "none";
        }

        function excluirBoletos() {
            var boletosSelecionados = [];

            var checkboxList = document.querySelectorAll('input[type="checkbox"]:checked');
            for (var i = 0; i < checkboxList.length; i++) {
                boletosSelecionados.push(parseInt(checkboxList[i].value));
            }

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'excluir_boletos.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    alert(xhr.responseText);
                    location.reload();
                }
            }

            xhr.send('boletos=' + JSON.stringify(boletosSelecionados));
        }
    </script>
    <!-- fim script janela modal -->
    <title>Financeiro</title>
</head>

<body>
    <section class="container">
        <div class="divContas">
            <div class="divContentLeft">
                <div class="infoText">
                    <span class="material-symbols-outlined">attach_money</span>
                    <p>Contas a Pagar</p>
                </div>
                <hr>
                <div class="infoConteudo">
                    <div>
                        <p>R$</p>
                    </div>
                    <div class="infoConteudoDiv">
                        <?php
                        $dataAtual = date("Y-m-d");
                        $query = "SELECT DATE_ADD('$dataAtual', INTERVAL 30 DAY) AS data30";
                        $resul = mysqli_query($conexao, $query);
                        $row = mysqli_fetch_assoc($resul);
                        $data30 = $row['data30'];
                        $consultaData = mysqli_query($conexao, "SELECT *, SUM(vlrPagamento) AS dia FROM boletos WHERE vencimento <= '$data30';");
                        $resultdata30 = mysqli_fetch_array($consultaData);
                        echo "<h2>" . $resultdata30formatdo = number_format($resultdata30['dia'], 2, ',', '.') . "</h2>";
                        ?>
                        <p>Próximos 30 Dias</p>
                    </div>
                </div>
            </div>

            <div class="divContentRigth">
                <div class="infoText">
                    <p>Hoje</p>
                </div>
                <div class="infoConteudos">
                    <p>R$</p>
                    <?php
                    $totalBoletos = mysqli_query($conexao, "SELECT *, SUM(vlrPagamento) AS vlrTotal FROM boletos WHERE vencimento = CURDATE();");
                    $resultTotalBoletos = mysqli_fetch_array($totalBoletos);
                    $totalBoletosFormatado = number_format($resultTotalBoletos['vlrTotal'], 2, '.', '.');
                    if (is_numeric($resultTotalBoletos['vlrTotal'])) {
                        echo "<h2>" . $totalBoletosFormatado . "</h2>";
                    } else {
                        echo "<h2>0,00</h2>";
                    }
                    ?>
                    <h2></h2>
                    <span class="material-symbols-outlined">sell</span>
                </div>
            </div>
        </div>

        <div class="divCadastrar">
            <div class="infoText">
                <span class="material-symbols-outlined">request_quote</span>
                <p>Cadastrar Boleto</p>
            </div>
            <hr>
            <div class="divForm">
                <form action="cadastra_boleto.php" method="post">
                    <input type="text" placeholder="Beneficiário" id="beneficiario" name="beneficiario" autocomplete="off" required>
                    <input type="date" id="date" name="data" required>
                    <input type="text" placeholder="Vlr a Pagar (R$)" id="valor" name="valor" autocomplete="off" required>
                    <input type="submit" value="Cadastrar" id="btnCadastrar" onClick="Cadastra">
                </form>
            </div>
        </div>
        <div class="divTabela">
            <div class="infoText">
                <div class="title-boletos">
                    <span class="material-symbols-outlined">attach_money</span>
                    <p>Boletos a Pagar</p>
                </div>

                <div class="btn-delete"><button class="modalButton" onclick="abrirModal()">Deletar Boleto</button></div>
            </div>

            <div id="myModal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="fecharModal()">&times;</span>
                    <h2>Lista de Boletos</h2>
                    <table id="modalTable">
                        <!-- boletos para o usuário selecionar -->
                    </table>
                    <button id="btnExcluir" onclick="excluirBoletos()">Excluir</button>
                    <button id="btnCancelar" onclick="fecharModal()">Cancelar</button>

                </div>
            </div>
            <hr>
            <table>
                <tr>
                    <th class="tableCod">Cód</th>
                    <th class="tableBeneficiario">Beneficiario</th>
                    <th class="tableVlrTopo">Vlr Pagamento</th>
                    <th class="tableVencimentoTopo">Vencimento</th>
                </tr>
            </table>
            <div class="tableList">
                <table>
                    <?php
                    $consulta = mysqli_query($conexao, "SELECT cod_boleto, beneficiario, vlrPagamento, DATE_FORMAT(vencimento, '%d-%m-%Y') as vencimento FROM boletos ORDER BY vencimento");
                    while ($resultado = mysqli_fetch_array($consulta)) {
                        echo "<tr>
                        <td class='tableCod'>" . $resultado['cod_boleto'] . "</td>
                        <td class='tableBeneficiario'>" . $resultado['beneficiario'] . "</td>
                        <td class='tableVlr'>" . $vlrFormatado = number_format($resultado['vlrPagamento'], 2, '.', '') . "</td>
                        <td class='tableVencimento'>" . $resultado['vencimento'] . "</td>
                    </tr>";
                    }
                    ?>
                </table>
            </div>
        </div>
    </section>

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">



        <div class="container-footer">
            <div class="copyright">
                &copy; Copyright <strong><span>InovaGest</span></strong>. Todos os Direitos Reservados
            </div>
            <div class="credits">
                Projetado e Desenvolvido por <a href="https://samuellmascarenhas.github.io/Portfolio/"
                    target="_blank">SAMUEL MASCARENHAS</a>
            </div>
        </div>

    </footer><!-- End Footer -->
    <!-- End Footer -->
</body>

</html>