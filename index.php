<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
    <link rel="manifest" href="img/site.webmanifest">

    <!-- Google Fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Google Icons-->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <title>InovaGest | Login</title>

    <?php
    session_start();

    if (isset($_SESSION['mensagemErro'])) {
        echo '<script>alert("' . $_SESSION['mensagemErro'] . '");</script>';
        unset($_SESSION['mensagemErro']);
    }
    ?>

</head>

<body>
    <header>
        <nav class="nav-header">
            <div class="container">
                <div class="tabs">

                    <a href="#" class="tab">Registro</a>

                    <img class="logotipo" src="img/LogoBOX.png" alt="logo">

                    <a href="#" class="tab" id="tab-2">Suporte</a>

                </div>
            </div>



        </nav>
    </header>

    <section class="box-sections">
        <section class="login-container">

            <div class="login-form">
                <div class="logo">
                    <img src="img/logoColor200x90.png" alt="imagem logo">
                    <span class="slogan">Gestão Facilitada para o pequeno <b>empreendedor</b></span>
                </div>
                <div class="title">
                    <span></span>
                </div>

                <div class="forms">
                    <form action="processamentoLogin.php" method="post" class="form">
                        <div class="inputs">

                            <input class="input" type="text" id="username" name="username" required
                                placeholder="Usuario" autocomplete="off">
                        </div>

                        <div class="inputs">
                            <input class="input" type="password" id="password" name="password" required
                                placeholder="Password" autocomplete="off">
                        </div>
                        <input class="form-btn" type="submit" class="login-button" value="Login">
                    </form>
                    <div class="row"></div>
                </div>
                <button class="btn-esqueci-senha">Forgot Password</button>
            </div>
        </section>

    </section>

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">



        <div class="container">

            <div class="box-credits">
                <div class="copyright">
                    &copy; Copyright <strong><span>InovaGest</span></strong>. Todos os Direitos Reservados
                </div>
                <div class="credits">
                    Projetado e Desenvolvido por
                    <a href="https://samuellmascarenhas.github.io/Portfolio/" target="_blank">SAMUEL MASCARENHAS</a>

                </div>
            </div>

            <div class="btn-socials">
                <a href="https://github.com/SamuellMascarenhas" target="_blank" class="button-socials">
                    <svg fill="#ffffff" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <g stroke-width="0" id="SVGRepo_bgCarrier"></g>
                        <g stroke-linejoin="round" stroke-linecap="round" id="SVGRepo_tracerCarrier"></g>
                        <g id="SVGRepo_iconCarrier">
                            <title>github</title>
                            <rect fill="none" height="24" width="24"></rect>
                            <path
                                d="M12,2A10,10,0,0,0,8.84,21.5c.5.08.66-.23.66-.5V19.31C6.73,19.91,6.14,18,6.14,18A2.69,2.69,0,0,0,5,16.5c-.91-.62.07-.6.07-.6a2.1,2.1,0,0,1,1.53,1,2.15,2.15,0,0,0,2.91.83,2.16,2.16,0,0,1,.63-1.34C8,16.17,5.62,15.31,5.62,11.5a3.87,3.87,0,0,1,1-2.71,3.58,3.58,0,0,1,.1-2.64s.84-.27,2.75,1a9.63,9.63,0,0,1,5,0c1.91-1.29,2.75-1,2.75-1a3.58,3.58,0,0,1,.1,2.64,3.87,3.87,0,0,1,1,2.71c0,3.82-2.34,4.66-4.57,4.91a2.39,2.39,0,0,1,.69,1.85V21c0,.27.16.59.67.5A10,10,0,0,0,12,2Z">
                            </path>
                        </g>
                    </svg>
                    Github
                </a>

                <a href="https://www.linkedin.com/in/samuellmascarenhas/" target="_blank" class="button-socials-in">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-linkedin" viewBox="0 0 16 16">
                        <path
                            d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854zm4.943 12.248V6.169H2.542v7.225zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248S2.4 3.226 2.4 3.934c0 .694.521 1.248 1.327 1.248zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016l.016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225z" />
                    </svg>
                    LinkedIn
                </a>
            </div>

        </div>

    </footer><!-- End Footer -->
    <!-- End Footer -->

</body>

</html>