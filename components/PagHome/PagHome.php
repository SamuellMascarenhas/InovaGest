<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="PagHome.css">

    <!-- Google icons -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <title>InovaGest</title>
</head>

<body>
    <section class="container">
        <div class="divTopo">
            <div class="divLeft">
                <span>
                    <div class="title-cards">
                        <span class="material-symbols-outlined">moving</span>
                        <p>Movimentações</p>
                    </div>
                </span>
                <hr>

                <?php
                // Certifique-se de que o caminho para o arquivo de conexão está correto
                include 'db_connection.php';
                ?>
                <div class="conteudo">
                    <?php
                    // Verificação adicional para garantir que a conexão foi estabelecida
                    if ($conexao->connect_error) {
                        die("Falha na conexão: " . $conexao->connect_error);
                    }

                    // Consulta para obter o número total de movimentações
                    $sql = "SELECT COUNT(*) as total_movimentacoes FROM movimentacoes";
                    $result = $conexao->query($sql);

                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $total_movimentacoes = $row["total_movimentacoes"];
                        echo "<p>Total de movimentações:  " . $total_movimentacoes . "</p>";
                    } else {
                        echo "Nenhuma movimentação encontrada.";
                    }

                    // Atualizar o contador de movimentações ao adicionar, atualizar ou deletar
                    if (isset($_POST['registrar_movimentacao'])) {
                        $sql = "INSERT INTO movimentacoes (descricao) VALUES ('" . $_POST['descricao'] . "')";
                        if ($conexao->query($sql) === TRUE) {
                            $total_movimentacoes++;
                            echo "<p>Movimentação registrada com sucesso.</p>";
                        } else {
                            echo "Erro ao registrar movimentação: " . $conexao->error;
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="divRigth">
                <span>
                    <div class="title-cards">
                        <span class="material-symbols-outlined">account_balance_wallet</span>
                        <p>Contas a Pagar</p>
                    </div>
                    <a class="btn-financeiro" href="../PagFinanceiro/PagFinanceiro.php">
                        Financeiro
                    </a>
                </span>
                <hr>

                <div class="cardContasApagar">
                    <?php
                    $sql = "SELECT * FROM boletos WHERE status = 'pendente' ORDER BY vencimento ASC";
                    $result = $conexao->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<p>" . $row["beneficiario"] . " | " . $row["vencimento"] . " | Valor: " . $row["vlrPagamento"] . "</p>";
                        }
                    } else {
                        echo "<p>Nenhuma conta a pagar encontrada.";
                    }
                    ?>

                </div>
            </div>
        </div>

        <!-- Div para detalhes das movimentações -->
        <div class="detalhes-movimentacoes">
            <h3>Detalhes das Movimentações</h3>
            <div class="conteudo-movimentacoes">
                <?php
                // Consulta para obter os detalhes das movimentações, incluindo descrições de todos os tipos de movimentação
                $sql = "SELECT * FROM movimentacoes ORDER BY data DESC";
                $result = $conexao->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<p>Descrição: " . $row["descricao"] . "</p>";
                    }
                } else {
                    echo "<p>Nenhuma movimentação encontrada.";
                }
                ?>
            </div>
        </div>
    </section>
    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">



        <div class="container">
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