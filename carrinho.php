<?php
if(!isset($_SESSION)) session_start();

if(!isset($_SESSION['Logado']) || $_SESSION['Logado'] != 'sim'){
    $_SESSION['aviso_entrar'] = 'Faca login para visualizar sua sacola.';
    $_SESSION['destino']      = 'carrinho.php';
    header('Location: entrar.php');
    exit;
}

if(isset($_GET['retirar'])){
    $pos = intval($_GET['retirar']);
    if(isset($_SESSION['carrinho'][$pos])){
        array_splice($_SESSION['carrinho'], $pos, 1);
    }
    header('Location: carrinho.php');
    exit;
}

$carrinho = isset($_SESSION['carrinho']) ? $_SESSION['carrinho'] : array();
$total = 0;
foreach($carrinho as $item) $total += $item['preco'];

$qtd_carrinho = count($carrinho);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minha Sacola — Maryanna</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>

<header class="topo">
    <a class="marca" href="index.php">mary<span>anna</span></a>
    <ul class="menu-nav">
        <li><a href="index.php">Inicio</a></li>
        <li>
            <a href="carrinho.php" class="carrinho-link">
                Sacola
                <?php if($qtd_carrinho > 0): ?>
                    <span class="badge-qtd"><?php echo $qtd_carrinho; ?></span>
                <?php endif; ?>
            </a>
        </li>
        <li><a href="sair.php">Sair (<?php echo htmlspecialchars($_SESSION['Nome']); ?>)</a></li>
    </ul>
</header>

<div class="pagina-central" style="max-width:680px;">

    <div class="caixa-form">
        <div class="form-cabecalho">
            <h1>Minha Sacola</h1>
            <p>Revise seus itens antes de finalizar</p>
        </div>

        <?php if(empty($carrinho)): ?>
            <div class="msg msg-info">
                Sua sacola esta vazia. <a href="index.php">Ver os kits disponíveis</a>.
            </div>

        <?php else: ?>

            <table class="tabela-carrinho">
                <thead>
                    <tr>
                        <th>Produto</th>
                        <th>Valor</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($carrinho as $i => $item): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['nome']); ?></td>
                        <td class="col-preco">R$ <?php echo number_format($item['preco'], 2, ',', '.'); ?></td>
                        <td>
                            <a href="carrinho.php?retirar=<?php echo $i; ?>" class="link-remover">remover</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="total-carrinho">
                Total: R$ <?php echo number_format($total, 2, ',', '.'); ?>
            </div>

            <a href="pedido.php" class="btn btn-rosado btn-cheio">Ir para o pagamento</a>
            <a href="index.php" class="btn btn-contorno btn-cheio mt-sm">Continuar comprando</a>

        <?php endif; ?>
    </div>
</div>

<footer class="rodape">
    &copy; <?php echo date('Y'); ?> <span>maryanna</span> &mdash; Por Duas, Para Todas.
</footer>

</body>
</html>
