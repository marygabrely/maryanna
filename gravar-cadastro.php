<?php
if(!isset($_SESSION)) session_start();
extract($_POST);

if(isset($b_cadastrar)){

    $cpf_limpo = preg_replace('/\D/', '', $cpf);

    if(strlen($cpf_limpo) != 11){
        $_SESSION['erro_cadastro'] = 'CPF invalido. Informe os 11 digitos.';
        header('Location: novo-cadastro.php');
        exit;
    }

    if($senha != $senha2){
        $_SESSION['erro_cadastro'] = 'As senhas nao conferem. Verifique e tente novamente.';
        header('Location: novo-cadastro.php');
        exit;
    }

    if(strlen($senha) < 6){
        $_SESSION['erro_cadastro'] = 'A senha precisa ter no minimo 6 caracteres.';
        header('Location: novo-cadastro.php');
        exit;
    }

    if(!is_dir('usuarios')) mkdir('usuarios', 0777, true);
    if(!is_dir('login'))    mkdir('login',    0777, true);

    $arq_usuario = 'usuarios/'.$cpf_limpo.'.dat';
    $arq_login   = 'login/'.$login.'.dat';

    if(file_exists($arq_usuario)){
        $_SESSION['erro_cadastro'] = 'Este CPF ja esta cadastrado no sistema.';
        header('Location: novo-cadastro.php');
        exit;
    }

    if(file_exists($arq_login)){
        $_SESSION['erro_cadastro'] = 'Este nome de usuario ja esta em uso. Escolha outro.';
        header('Location: novo-cadastro.php');
        exit;
    }

    // Salva dados pessoais: nome|cpf|endereco|bairro|cidade|estado|cep
    $dados = $nome.'|'.$cpf_limpo.'|'.$endereco.'|'.$bairro.'|'.$cidade.'|'.$estado.'|'.$cep;
    $fu = fopen($arq_usuario, 'w');
    fwrite($fu, $dados);
    fclose($fu);

    // Salva login: md5(senha)|cpf
    $acesso = md5($senha).'|'.$cpf_limpo;
    $fl = fopen($arq_login, 'w');
    fwrite($fl, $acesso);
    fclose($fl);

    $_SESSION['aviso_entrar'] = 'Cadastro realizado! Faca login para continuar.';
    header('Location: entrar.php');
    exit;
}

header('Location: novo-cadastro.php');
exit;
?>
