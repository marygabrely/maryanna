<?php
if(!isset($_SESSION)) session_start();

if(!isset($_SESSION['Logado']) || $_SESSION['Logado'] != 'sim'){
    header('Location: entrar.php');
    exit;
}

$carrinho = isset($_SESSION['carrinho']) ? $_SESSION['carrinho'] : array();

if(empty($carrinho)){
    header('Location: carrinho.php');
    exit;
}

$total = 0;
foreach($carrinho as $item) $total += $item['preco'];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finalizar Pedido — Maryanna</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>

<header class="topo">
    <a class="marca" href="index.php">mary<span>anna</span></a>
    <ul class="menu-nav">
        <li><a href="index.php">Inicio</a></li>
        <li><a href="carrinho.php" class="carrinho-link">Sacola</a></li>
        <li><a href="sair.php">Sair (<?php echo htmlspecialchars($_SESSION['Nome']); ?>)</a></li>
    </ul>
</header>

<div class="pagina-central" style="max-width:660px;">
    <div class="caixa-form">
        <div class="form-cabecalho">
            <h1>Finalizar Pedido</h1>
            <p>Confirme seus dados e escolha a forma de pagamento</p>
        </div>

        <div class="bloco-resumo">
            <h3>Itens do pedido</h3>
            <?php foreach($carrinho as $item): ?>
            <div class="linha-dado">
                <span class="rotulo"><?php echo htmlspecialchars($item['nome']); ?></span>
                <span class="valor">R$ <?php echo number_format($item['preco'], 2, ',', '.'); ?></span>
            </div>
            <?php endforeach; ?>
            <div class="linha-dado" style="margin-top:10px;padding-top:10px;border-top:1px solid #ddb8a8;">
                <span class="rotulo" style="color:#4a2c2a;font-weight:700;">Total</span>
                <span class="valor" style="font-family:'Playfair Display',serif;font-size:1.15rem;color:#8b3a3a;">
                    R$ <?php echo number_format($total, 2, ',', '.'); ?>
                </span>
            </div>
        </div>

        <div class="bloco-resumo">
            <h3>Seus dados</h3>
            <div class="linha-dado">
                <span class="rotulo">Nome</span>
                <span class="valor"><?php echo htmlspecialchars(isset($_SESSION['NomeCompleto']) ? $_SESSION['NomeCompleto'] : $_SESSION['Nome']); ?></span>
            </div>
            <div class="linha-dado">
                <span class="rotulo">Login</span>
                <span class="valor"><?php echo htmlspecialchars($_SESSION['Nome']); ?></span>
            </div>
            <?php if(!empty($_SESSION['Endereco'])): ?>
            <div class="linha-dado">
                <span class="rotulo">Endereco</span>
                <span class="valor"><?php echo htmlspecialchars($_SESSION['Endereco']); ?></span>
            </div>
            <?php endif; ?>
            <?php if(!empty($_SESSION['Cidade'])): ?>
            <div class="linha-dado">
                <span class="rotulo">Cidade / UF</span>
                <span class="valor"><?php echo htmlspecialchars($_SESSION['Cidade']); ?> / <?php echo htmlspecialchars($_SESSION['Estado']); ?></span>
            </div>
            <?php endif; ?>
        </div>

        <form method="POST" action="registrar-venda.php">
            <div class="bloco-resumo">
                <h3>Forma de pagamento</h3>
                <div class="opcoes-pagamento">
                    <div class="opcao-pag">
                        <input type="radio" name="pagamento" id="pix" value="PIX" checked>
                        <label for="pix">PIX — pagamento instantaneo</label>
                    </div>
                    <div class="opcao-pag">
                        <input type="radio" name="pagamento" id="boleto" value="Boleto Bancario">
                        <label for="boleto">Boleto Bancario</label>
                    </div>
                    <div class="opcao-pag">
                        <input type="radio" name="pagamento" id="credito" value="Cartao de Credito">
                        <label for="credito">Cartao de Credito — ate 6x sem juros</label>
                    </div>
                </div>
            </div>

            <button type="submit" name="b_registrar" class="btn btn-sucesso">
                Confirmar e finalizar pedido
            </button>
        </form>

        <a href="carrinho.php" class="btn btn-claro btn-cheio mt-sm">Voltar para a sacola</a>

    </div>
</div>

<footer class="rodape">
    &copy; <?php echo date('Y'); ?> <span>maryanna</span> &mdash; Por Duas, Para Todas.
</footer>

</body>
</html>
