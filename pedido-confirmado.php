<?php
if(!isset($_SESSION)) session_start();

if(!isset($_SESSION['Logado']) || $_SESSION['Logado'] != 'sim'){
    header('Location: entrar.php');
    exit;
}

if(!isset($_SESSION['pedido_feito'])){
    header('Location: index.php');
    exit;
}

$pedido = $_SESSION['pedido_feito'];
unset($_SESSION['pedido_feito']);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedido Confirmado — Maryanna</title>
    <link rel="stylesheet" href="css/estilo.css">
    <style>
        .caixa-sucesso {
            text-align: center;
            padding: 32px 0 20px;
        }
        .icone-ok {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            background: #f5e5de;
            border: 2px solid #c9947a;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 18px;
            font-size: 1.8rem;
            color: #8b3a3a;
        }
        .titulo-sucesso {
            font-family: 'Playfair Display', serif;
            font-size: 1.7rem;
            color: #8b3a3a;
            margin-bottom: 8px;
        }
        .subtitulo-sucesso {
            color: #a07060;
            font-size: 0.9rem;
            margin-bottom: 24px;
        }
        .numero-pedido {
            display: inline-block;
            background: #fdf6f0;
            border: 1px solid #ddb8a8;
            border-radius: 8px;
            padding: 10px 24px;
            font-family: 'Playfair Display', serif;
            font-size: 0.95rem;
            color: #8b3a3a;
            letter-spacing: 1px;
            margin-bottom: 28px;
        }
        .numero-pedido small {
            display: block;
            font-family: 'Lato', sans-serif;
            font-size: 0.68rem;
            color: #a07060;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 4px;
        }
    </style>
</head>
<body>

<header class="topo">
    <a class="marca" href="index.php">mary<span>anna</span></a>
    <ul class="menu-nav">
        <li><a href="index.php">Inicio</a></li>
        <li><a href="sair.php">Sair (<?php echo htmlspecialchars($_SESSION['Nome']); ?>)</a></li>
    </ul>
</header>

<div class="pagina-central" style="max-width:620px;">
    <div class="caixa-form">

        <div class="caixa-sucesso">
            <div class="icone-ok">&#10003;</div>
            <div class="titulo-sucesso">Pedido realizado!</div>
            <div class="subtitulo-sucesso">
                Obrigada, <strong><?php echo htmlspecialchars(isset($_SESSION['NomeCompleto']) ? $_SESSION['NomeCompleto'] : $_SESSION['Nome']); ?></strong>.<br>
                Seu pedido foi registrado com sucesso.
            </div>
            <div class="numero-pedido">
                <small>Numero do pedido</small>
                #<?php echo htmlspecialchars($pedido['codigo']); ?>
            </div>
        </div>

        <div class="bloco-resumo">
            <h3>Resumo do pedido</h3>
            <?php foreach($pedido['itens'] as $item): ?>
            <div class="linha-dado">
                <span class="rotulo"><?php echo htmlspecialchars($item['nome']); ?></span>
                <span class="valor">R$ <?php echo number_format($item['preco'], 2, ',', '.'); ?></span>
            </div>
            <?php endforeach; ?>
            <div class="linha-dado" style="margin-top:10px;padding-top:10px;border-top:1px solid #ddb8a8;">
                <span class="rotulo" style="color:#4a2c2a;font-weight:700;">Total pago</span>
                <span class="valor" style="font-family:'Playfair Display',serif;font-size:1.1rem;color:#8b3a3a;">
                    R$ <?php echo number_format($pedido['total'], 2, ',', '.'); ?>
                </span>
            </div>
        </div>

        <div class="bloco-resumo">
            <h3>Detalhes</h3>
            <div class="linha-dado">
                <span class="rotulo">Pagamento</span>
                <span class="valor"><?php echo htmlspecialchars($pedido['pagamento']); ?></span>
            </div>
            <div class="linha-dado">
                <span class="rotulo">Data e hora</span>
                <span class="valor"><?php echo htmlspecialchars($pedido['data']); ?></span>
            </div>
        </div>

        <a href="index.php" class="btn btn-rosado btn-cheio">Voltar para a loja</a>

    </div>
</div>

<footer class="rodape">
    &copy; <?php echo date('Y'); ?> <span>maryanna</span> &mdash; Por Duas, Para Todas.
</footer>

</body>
</html>
