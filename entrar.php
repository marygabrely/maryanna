<?php
if(!isset($_SESSION)) session_start();

if(isset($_SESSION['Logado']) && $_SESSION['Logado'] == 'sim'){
    header('Location: carrinho.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entrar — Maryanna</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>

<header class="topo">
    <a class="marca" href="index.php">mary<span>anna</span></a>
    <ul class="menu-nav">
        <li><a href="index.php">Inicio</a></li>
        <li><a href="carrinho.php" class="carrinho-link">Sacola</a></li>
        <li><a href="entrar.php">Entrar</a></li>
        <li><a href="novo-cadastro.php">Cadastrar</a></li>
    </ul>
</header>

<div class="pagina-central">

    <?php if(isset($_SESSION['aviso_entrar'])): ?>
        <div class="msg msg-info"><?php echo htmlspecialchars($_SESSION['aviso_entrar']); ?></div>
        <?php unset($_SESSION['aviso_entrar']); ?>
    <?php endif; ?>

    <?php if(isset($_SESSION['erro_entrar'])): ?>
        <div class="msg msg-erro"><?php echo htmlspecialchars($_SESSION['erro_entrar']); ?></div>
        <?php unset($_SESSION['erro_entrar']); ?>
    <?php endif; ?>

    <div class="caixa-form">
        <div class="form-cabecalho">
            <h1>Bem-vinda de volta</h1>
            <p>Acesse sua conta para continuar</p>
        </div>

        <form method="POST" action="validar-login.php">
            <div class="campo">
                <label for="login">Seu login</label>
                <input type="text" id="login" name="login" placeholder="Digite seu usuario" required>
            </div>
            <div class="campo">
                <label for="senha">Senha</label>
                <input type="password" id="senha" name="senha" placeholder="Digite sua senha" required>
            </div>
            <button type="submit" name="b_entrar" class="btn btn-rosado btn-cheio">Entrar na conta</button>
        </form>

        <hr class="separador">

        <div class="link-form">
            Primeira vez aqui? <a href="novo-cadastro.php">Crie sua conta</a>
        </div>
        <div class="link-form mt-sm">
            <a href="index.php">Voltar para a loja</a>
        </div>
    </div>
</div>

<footer class="rodape">
    &copy; <?php echo date('Y'); ?> <span>maryanna</span> &mdash; Por Duas, Para Todas.
</footer>

</body>
</html>
