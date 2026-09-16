<?php
if(!isset($_SESSION)) session_start();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Conta — Maryanna</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>

<header class="topo">
    <a class="marca" href="index.php">mary<span>anna</span></a>
    <ul class="menu-nav">
        <li><a href="index.php">Inicio</a></li>
        <li><a href="carrinho.php" class="carrinho-link">Sacola</a></li>
        <li><a href="entrar.php">Entrar</a></li>
    </ul>
</header>

<div class="pagina-central" style="max-width:600px;">

    <?php if(isset($_SESSION['erro_cadastro'])): ?>
        <div class="msg msg-erro"><?php echo htmlspecialchars($_SESSION['erro_cadastro']); ?></div>
        <?php unset($_SESSION['erro_cadastro']); ?>
    <?php endif; ?>

    <div class="caixa-form">
        <div class="form-cabecalho">
            <h1>Criar minha conta</h1>
            <p>Preencha todos os campos para se cadastrar</p>
        </div>

        <form method="POST" action="gravar-cadastro.php">

            <p style="font-size:0.75rem;text-transform:uppercase;letter-spacing:2px;color:#c9947a;font-weight:700;margin-bottom:14px;">Informacoes pessoais</p>

            <div class="dois-campos">
                <div class="campo">
                    <label for="nome">Nome completo</label>
                    <input type="text" id="nome" name="nome" placeholder="Seu nome" required>
                </div>
                <div class="campo">
                    <label for="cpf">CPF</label>
                    <input type="text" id="cpf" name="cpf" placeholder="00000000000" maxlength="14" required>
                </div>
            </div>

            <div class="campo">
                <label for="endereco">Endereco completo</label>
                <input type="text" id="endereco" name="endereco" placeholder="Rua, numero, complemento" required>
            </div>

            <div class="dois-campos">
                <div class="campo">
                    <label for="bairro">Bairro</label>
                    <input type="text" id="bairro" name="bairro" placeholder="Bairro" required>
                </div>
                <div class="campo">
                    <label for="cidade">Cidade</label>
                    <input type="text" id="cidade" name="cidade" placeholder="Cidade" required>
                </div>
            </div>

            <div class="dois-campos">
                <div class="campo">
                    <label for="cep">CEP</label>
                    <input type="text" id="cep" name="cep" placeholder="00000-000" maxlength="9" required>
                </div>
                <div class="campo">
                    <label for="estado">Estado</label>
                    <select id="estado" name="estado" required>
                        <option value="">Selecione</option>
                        <?php
                        $ufs = array('AC','AL','AP','AM','BA','CE','DF','ES','GO','MA','MT','MS',
                                     'MG','PA','PB','PR','PE','PI','RJ','RN','RS','RO','RR','SC',
                                     'SP','SE','TO');
                        foreach($ufs as $u) echo "<option value='".$u."'>".$u."</option>";
                        ?>
                    </select>
                </div>
            </div>

            <hr class="separador">

            <p style="font-size:0.75rem;text-transform:uppercase;letter-spacing:2px;color:#c9947a;font-weight:700;margin-bottom:14px;">Dados de acesso</p>

            <div class="campo">
                <label for="login">Login</label>
                <input type="text" id="login" name="login" placeholder="Escolha um nome de usuario" required autocomplete="off">
            </div>

            <div class="dois-campos">
                <div class="campo">
                    <label for="senha">Senha</label>
                    <input type="password" id="senha" name="senha" placeholder="Minimo 6 caracteres" required minlength="6">
                </div>
                <div class="campo">
                    <label for="senha2">Confirmar senha</label>
                    <input type="password" id="senha2" name="senha2" placeholder="Repita a senha" required>
                </div>
            </div>

            <button type="submit" name="b_cadastrar" class="btn btn-rosado btn-cheio">
                Finalizar cadastro
            </button>
        </form>

        <div class="link-form mt-sm">
            Ja tem conta? <a href="entrar.php">Entre aqui</a>
        </div>
    </div>
</div>

<footer class="rodape">
    &copy; <?php echo date('Y'); ?> <span>maryanna</span> &mdash; Por Duas, Para Todas.
</footer>

</body>
</html>
