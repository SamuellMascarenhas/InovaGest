<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="PagPrincipal.css">

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="../../img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../../img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../../img/favicon-16x16.png">
    <link rel="manifest" href="../../img/site.webmanifest">

    <!-- Google icons -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <?php
    session_start();

    // Verifica se o usuário está logado
    if (!isset($_SESSION['usuario'])) {
        // se o usuário não estiver logado, redireciona para a página de login
        $_SESSION['mensagemErro'] = "Faça login para acessar a página.";
        header("Location: ../../index.php");
        exit();
    }

    // Vai verificar se o formulário de logout foi acionado
    if (isset($_POST['logout'])) {
        // se sim, finaliza a sessão
        session_destroy();

        // e redireciona para a página de login
        header("Location: ../../index.php");
        exit();
    }
    ?>

    <title>InovaGest</title>
</head>

<body>
    <header>
        <div class="divLogo">
            <div>
                <a href="">
                    <img src="../../img/logoColor200x90.png" alt="imagem Logo">
                </a>

            </div>

            <div>
                <form method="post">
                    <button class="btn-logout" type="submit" name="logout">
                        <span class="material-symbols-outlined">power_settings_new</span>
                    </button>
                </form>
            </div>
        </div>

        <nav class="nav-bar">
            <ul class="ul-header">
                <li class="li-header">
                    <a class="a-header" href="">
                        <span class="material-symbols-outlined">home</span>
                        <p>Inicio</p>
                    </a>
                </li>
                <li class="li-header">
                    <a href="../PagEntrada/PagEntrada.php" target="conteudo">
                        <span class="material-symbols-outlined">screenshot_region</span>
                        <p>Entrada</p>
                    </a>
                </li>
                <li class="li-header">
                    <a href="../PagEstoque/PagEstoque.php" target="conteudo">
                        <span class="material-symbols-outlined">inventory_2</span>
                        <p>Estoque</p>
                    </a>
                </li>
                <li class="li-header">
                    <a href="../PagFinanceiro/PagFinanceiro.php" target="conteudo">
                        <span class="material-symbols-outlined">
                            account_balance_wallet
                        </span>
                        <p>Financeiro</p>
                    </a>
                </li>

            </ul>

        </nav>
    </header>
    <section>
        <aside>
            <div class="divLogo">
                <a href="">
                    <img src="../../img/logoColor200x90.png" alt="imagem Logo">
                </a>
            </div>
            <nav class="nav-aside">
                <ul>
                    <li>
                        <a href="">
                            <span class="material-symbols-outlined">home</span>
                            <p>Inicio</p>
                        </a>
                    </li>
                    <li>
                        <a href="../PagEntrada/PagEntrada.php" target="conteudo">
                            <span class="material-symbols-outlined">screenshot_region</span>
                            <p>Entrada</p>
                        </a>
                    </li>
                    <li>
                        <a href="../PagEstoque/PagEstoque.php" target="conteudo">
                            <span class="material-symbols-outlined">inventory_2</span>
                            <p>Estoque</p>
                        </a>
                    </li>
                    <li>
                        <a href="../PagFinanceiro/PagFinanceiro.php" target="conteudo">
                            <span class="material-symbols-outlined">
                                account_balance_wallet
                            </span>
                            <p>Financeiro</p>
                        </a>
                    </li>
                </ul>
            </nav>
            <form method="post">
                <button type="submit" name="logout">
                    <div>
                        <span class="material-symbols-outlined">power_settings_new</span>
                    </div>
                </button>
            </form>
        </aside>


        <div class="divIframePrincipal">
            <iframe src="../PagHome/PagHome.php" frameborder="0" name="conteudo">

            </iframe>
        </div>
    </section>
</body>

</html>