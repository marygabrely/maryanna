<?php
if(!isset($_SESSION)) session_start();

$kits = array(
    array(
        'id'       => 'kit-cacheado',
        'nome'     => 'Kit Completo para Cabelos Cacheados',
        'tipo'     => 'Cabelos Cacheados',
        'preco'    => 189.90,
        'imagem'   => 'img/cacheado.jpeg',
        'descricao'=> 'Definicao, hidratacao e brilho para cachos perfeitos. Formula liberada, sem sulfatos.'
    ),
    array(
        'id'       => 'kit-crespo',
        'nome'     => 'Kit Completo para Cabelos Crespos',
        'tipo'     => 'Cabelos Crespos',
        'preco'    => 189.90,
        'imagem'   => 'img/crespo.jpeg',
        'descricao'=> 'Nutricao, definicao e forca para cachos com personalidade. Formula enriquecida.'
    ),
    array(
        'id'       => 'kit-liso',
        'nome'     => 'Kit Completo para Cabelos Lisos',
        'tipo'     => 'Cabelos Lisos',
        'preco'    => 179.90,
        'imagem'   => 'img/liso.jpeg',
        'descricao'=> 'Alinhamento, brilho e protecao para fios lisos e sem frizz. Formula suave.'
    ),
    array(
        'id'       => 'kit-ondulado',
        'nome'     => 'Kit Completo para Cabelos Ondulados',
        'tipo'     => 'Cabelos Ondulados',
        'preco'    => 179.90,
        'imagem'   => 'img/ondulado.jpeg',
        'descricao'=> 'Movimento, leveza e hidratacao para ondas naturais e soltinhas. Formula suave.'
    ),
);

$qtd_carrinho = 0;
if(isset($_SESSION['carrinho'])) $qtd_carrinho = count($_SESSION['carrinho']);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maryanna — Por Duas, Para Todas</title>
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
        <?php if(isset($_SESSION['Logado']) && $_SESSION['Logado'] == 'sim'): ?>
            <li><a href="sair.php">Sair (<?php echo htmlspecialchars($_SESSION['Nome']); ?>)</a></li>
        <?php else: ?>
            <li><a href="entrar.php">Entrar</a></li>
            <li><a href="novo-cadastro.php">Cadastrar</a></li>
        <?php endif; ?>
    </ul>
</header>

<section class="banner">
    <img src="img/Baner.jpeg" alt="Maryanna — Por Duas, Para Todas">
</section>

<section class="frase-central">
    <h2>Cuidado que transforma</h2>
    <p>Escolha o kit ideal para o seu tipo de cabelo e descubra sua melhor versao</p>
    <div class="linha-ornamento">
        <hr><span>&#9825;</span><hr>
    </div>
</section>

<?php if(isset($_SESSION['aviso_vitrine'])): ?>
    <div style="max-width:900px;margin:0 auto 10px;padding:0 24px;">
        <div class="msg msg-ok"><?php echo htmlspecialchars($_SESSION['aviso_vitrine']); ?></div>
    </div>
    <?php unset($_SESSION['aviso_vitrine']); ?>
<?php endif; ?>

<section class="catalogo">
    <p class="catalogo-titulo">Nossos Kits</p>

    <div class="grade-produtos">
        <?php foreach($kits as $k): ?>
        <div class="produto-cartao">
            <div class="produto-foto">
                <img src="<?php echo htmlspecialchars($k['imagem']); ?>"
                     alt="<?php echo htmlspecialchars($k['nome']); ?>">
            </div>
            <div class="produto-info">
                <div class="produto-categoria"><?php echo htmlspecialchars($k['tipo']); ?></div>
                <div class="produto-nome"><?php echo htmlspecialchars($k['nome']); ?></div>
                <div class="produto-desc"><?php echo htmlspecialchars($k['descricao']); ?></div>
            </div>
            <div class="produto-rodape">
                <div class="produto-preco">
                    <small>Kit completo</small>
                    R$ <?php echo number_format($k['preco'], 2, ',', '.'); ?>
                </div>
                <form method="POST" action="incluir-sacola.php">
                    <input type="hidden" name="pid"    value="<?php echo htmlspecialchars($k['id']); ?>">
                    <input type="hidden" name="pnome"  value="<?php echo htmlspecialchars($k['nome']); ?>">
                    <input type="hidden" name="ppreco" value="<?php echo $k['preco']; ?>">
                    <button type="submit" name="b_incluir" class="btn btn-rosado">Adicionar</button>
                </form>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<footer class="rodape">
    &copy; <?php echo date('Y'); ?> <span>maryanna</span> &mdash; Por Duas, Para Todas. Todos os direitos reservados.
</footer>

</body>
</html>
