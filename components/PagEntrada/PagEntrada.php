<!DOCTYPE html>
<html lang="pt-br">

<?php
include_once ('../../conexao.php');

if (isset($_POST['cadastrar'])) {
    $codigo = mysqli_real_escape_string($conexao, $_POST['codigo']);
    $descricao = mysqli_real_escape_string($conexao, $_POST['descricao']);
    $qtde = mysqli_real_escape_string($conexao, $_POST['qtde']);
    $valor = mysqli_real_escape_string($conexao, $_POST['valor']);

    $consulta = mysqli_query($conexao, "SELECT cod_fornecedor FROM estoque WHERE cod_fornecedor = '$codigo'");
    $resultado = mysqli_fetch_array($consulta);

    if ($resultado > 0) {
        header("Location: ./cadastro/ProdutoCadastrado.php");
    } else {
        if ($codigo != '' && $descricao != '' && $qtde != '' && $valor != '') {
            $vlrEstoque = $valor * $qtde;

            // Inserindo no estoque
            $insereEstoque = mysqli_query($conexao, "INSERT INTO estoque(descricao, quantidade, valor, vlrEstoque, cod_fornecedor) VALUES ('$descricao','$qtde','$valor','$vlrEstoque','$codigo')");

            // Inserindo movimentação
            $movimentacao = "Inserção de produto: $descricao - Quantidade: $qtde - Valor: $valor";
            $insereMovimentacao = mysqli_query($conexao, "INSERT INTO movimentacoes(descricao) VALUES ('$movimentacao')");

            header("Location: ./cadastro/confirmaEntrada.php");
        } else {
            header("Location: ./cadastro/erroEntrada.php");
        }
    }
}

if (isset($_POST['consultar'])) {
    $codigo = mysqli_real_escape_string($conexao, $_POST['codigo']);

    // Consultar produto no estoque
    $consultaProduto = mysqli_query($conexao, "SELECT * FROM estoque WHERE cod_fornecedor = '$codigo'");
    $produto = mysqli_fetch_assoc($consultaProduto);

    if ($produto) {
        // Produto encontrado, redireciona para página de consulta com os dados
        header("Location: ../PagEstoque/PagEstoque.php");
    } else {
        // Produto não encontrado, redireciona para página de erro
        header("Location: ../PagEstoque/produtoNull.php");
    }
}

if (isset($_POST['atualizar'])) {
    $codigo = mysqli_real_escape_string($conexao, $_POST['codigo']);
    $descricao = mysqli_real_escape_string($conexao, $_POST['descricao']);
    $qtde = mysqli_real_escape_string($conexao, $_POST['qtde']);
    $valor = mysqli_real_escape_string($conexao, $_POST['valor']);

    // Atualizar produto no estoque
    $atualizaProduto = mysqli_query($conexao, "UPDATE estoque SET descricao = '$descricao', quantidade = '$qtde', valor = '$valor' WHERE cod_fornecedor = '$codigo'");

    if ($atualizaProduto) {
        // Produto atualizado com sucesso, redireciona para página de confirmação
        header("Location: ./Atualiza/Atualiza.php");
    } else {
        // Falha ao atualizar produto, redireciona para página de erro
        header("Location: ./Atualiza/AtualizaErro.php");
    }
}

if (isset($_POST['deletar'])) {
    $codigo = mysqli_real_escape_string($conexao, $_POST['codigo']);

    // Deletar produto do estoque
    $deletaProduto = mysqli_query($conexao, "DELETE FROM estoque WHERE cod_fornecedor = '$codigo'");

    if ($deletaProduto) {
        // Produto deletado com sucesso, redireciona para página de confirmação
        header("Location: ./Delet/produtoDeletado.php");
    } else {
        // Falha ao deletar produto, redireciona para página de erro
        header("Location: ./Delet/deletError.php");
    }
}
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

    <title>Entrada</title>
</head>

<body>
    <section class="container">
        <div class="divTitle">
            <h2>Central Cadastro</h2>
        </div>
        <form action="PagEntrada.php" class="form" method="post">
            <div class="codigo">
                <p>Código do Produto</p>
                <input type="text" name="codigo" id="codigo" placeholder="Código*" value="" autocomplete="off" required>
            </div>
            <div class="divDescricao">
                <p>Descrição do Produto</p>
                <input type="text" name="descricao" id="descricao" placeholder="Descrição*" autocomplete="off">
            </div>
            <div class="divInputs">
                <div class="divQtde">
                    <p>Qtde</p>
                    <input type="text" name="qtde" id="qtde" placeholder="Qtde*" autocomplete="off">
                </div>
                <div class="divPreco">
                    <p>Preço
                        <span class="material-symbols-outlined">sell</span>
                    </p>
                    <input type="text" name="valor" id="preco" placeholder="Preço (R$)*" autocomplete="off">
                </div>
                <div>

                </div>
            </div>
            <div class="divButtons">
                <button id="btnCadastrar" name="cadastrar">
                    <span class="material-symbols-outlined">add_box</span>
                    Cadastrar
                </button>
                <button id="btnConsultar" name="consultar">
                    <span class="material-symbols-outlined">search</span>
                    Consultar
                </button>
                <button id="btnAtulizar" name="atualizar">
                    <span class="material-symbols-outlined">edit</span>
                    Atualizar
                </button>
                <button id="btnDeletar" name="deletar" required>
                    <span class="material-symbols-outlined">delete</span>
                    Deletar
                </button>
            </div>
        </form>
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