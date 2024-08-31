<!DOCTYPE html>
<html lang="pt-br">
<?php
include_once ('../../conexao.php');
$consultaCod = '';
$consultaDescricao = '';
$consultaQtde = '';
$consultaValor = '';
$consultaVlrEstoque = '';
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="PagEntrada.css">

    <!-- Google icons -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <script>

        function Cadastrar() {

            <?php

            $codigo = mysqli_real_escape_string($conexao, $_POST['codigo']);
            $descricao = mysqli_real_escape_string($conexao, $_POST['descricao']);
            $qtde = mysqli_real_escape_string($conexao, $_POST['qtde']);
            $valor = mysqli_real_escape_string($conexao, $_POST['preco']);


            $consulta = mysqli_query($conexao, "SELECT cod_fornecedor FROM estoque WHERE cod_fornecedor = '$codigo'");

            $resultado = mysqli_fetch_array($consulta);

            if ($resultado > 0) {
                header("Location: ./cadastro/ProdutoCadastrado.php");
            } else {
                if ($codigo != '' || $descricao != '' || $qtde != '' || $valor != '') {

                    if ($codigo != '' || $descricao != '' || $qtde != '' || $valor != '') {

                        $vlrEstoque = $valor * $qtde;

                        $insere = mysqli_query($conexao, "INSERT INTO estoque(descricao, quantidade, valor, vlrEstoque, cod_fornecedor)VALUES ('$descricao','$qtde','$valor','$vlrEstoque','$codigo')");

                        header("Location: ./cadastro/confirmaEntrada.php");
                    } else {
                        header("Location: ./cadastro/erroEntrada.php");
                    }
                }
            }
            ?>


        }
        function Consulta(){

            <?php
            $verificaCod = mysqli_real_escape_string($conexao, $_POST['codigo']);


            if ($codigo != '') {
                $consulta = mysqli_query($conexao, "SELECT descricao, quantidade, valor, vlrEstoque, cod_fornecedor FROM estoque WHERE cod_fornecedor = '$codigo'");


                $consultaDescricao = $consulta['descricao'];
                $consultaQtde = $consulta['quantidade'];
                $consultaValor = $consulta['valor'];
                $consultaVlrEstoque = $consulta['vlrEstoque'];
            }
            ?>
 
        }
   
 
    </script>
   
     <title>Document</title>
</head>
<body>
    <section class="container">
        <div class="divTitle">
            <h2>Central Cadastro</2>
       
 </div>
        <form action="PagEntrada.php" class="form" method="post">
            <input type="text" name="codigo" id="codigo" placeholder="Código*" value="<?php echo $consultaCod; ?>">
            <div class="divDescricao">
                <p>Descrição do Produto</p>
                <input type="text" name="descricao" id="descricao" placeholder="Descrição*" value="<?php echo $consultaDescricao; ?>">
            </div>
            <div class="divInputs">
                <div class="divQtde">
                    <p>Qtde</p>
                    <input type="text" name="qtde" id="qtde" placeholder="Qtde*" value="<?php echo $consultaQtde; ?>">
                </div>
                <div class="divPreco">
                    <p>Preço
                        <span class="material-symbols-outlined">sell</span>
                    </p>
                    <input type="text" name="preco" id="preco" placeholder="Preço (R$)*" value="<?php echo $consultaValor; ?>">
                </div>
                <div class="divTotalEstoque">
                    <p>Total Estoque (R$)</p>
                    <input type="text" name="totalEstoque" id="totalEstoque" placeholder="Vlr Total (R$)" value="<?php echo $consultaVlrEstoque; ?>">
                </div>
            </div>
            <div class="divButtons">
                <button id="btnCadastrar" onClick="Cadastrar()">
                    <span class="material-symbols-outlined">add_box</span>
                    Cadastrar
                </button>
                <button id="btnConsultar" onClick="Consulta()">
                <span class="material-symbols-outlined">search</span>
                    Consultar</button>
                <button id="btnAtulizar">
                <span class="material-symbols-outlined">edit</span>
                    Atulizar</button>
                <button id="btnDeletar">
                <span class="material-symbols-outlined">delete</span>    
                    Deletar</button>
            </div>
        </form>


    </section>
</body>
</html>