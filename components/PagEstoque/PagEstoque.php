<!DOCTYPE html>

<?php
include_once('../../conexao.php');
?>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="PagEstoque.css">

    <!-- Google icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <title>Document</title>
</head>
<body>
    <section class="container">
        <div class="divTitle">
            <h2>Estoque</2>
        </div>

        <form action="PagEstoque.php" class="form" method="post">
            <input type="text" placeholder="Busque aqui..." name="busca">
            <button type="submit">
                <span class="material-symbols-outlined">search</span>
            </button>
        </form>

        <table>
            <tr>
                <th class="tableCod">Cod</th>
                <th class="tableDescricao">Descrição</th>
                <th class="tableQtd">Quantidade</th>
            </tr>
        </table>
        <hr>
        <div  class="tableConteudo">
            <table>
                <?php
                    
                    $busca = isset($_POST['busca']) ? $_POST['busca'] : '';

                    if($busca != ''){
                        $consulta = mysqli_query($conexao, "SELECT * FROM estoque WHERE descricao LIKE '%$busca%'" );

                        while($resultado = mysqli_fetch_array($consulta)){
                            echo "<tr>
                            <td class='tableCod'>
                                <p>". $resultado["cod_fornecedor"] ."</p>
                            </td>
                            <td class='tableDescricao'>". $resultado['descricao'] ."</td>
                            <td class='tableQtd'>". $resultado['quantidade'] ."</td>
                        </tr>";
                        }
                    }else{
                        $consulta = mysqli_query($conexao, "SELECT * FROM estoque" );

                        while($resultado = mysqli_fetch_array($consulta)){
                            echo "<tr>
                            <td class='tableCod'>
                                <p>". $resultado["cod_fornecedor"] ."</p>
                            </td>
                            <td class='tableDescricao'>". $resultado['descricao'] ."</td>
                            <td class='tableQtd'>". $resultado['quantidade'] ."</td>
                        </tr>";
                        }
                    }

                ?>

            </table>
        </div>
    </section>

        <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">



<div class="container">
  <div class="copyright">
    &copy; Copyright <strong><span>InovaGest</span></strong>. Todos os Direitos Reservados
  </div>
  <div class="credits">
    Projetado e Desenvolvido por <a href="https://samuellmascarenhas.github.io/Portfolio/" target="_blank">SAMUEL MASCARENHAS</a>
  </div>
</div>

</footer><!-- End Footer -->
<!-- End Footer -->
</body>
</html>