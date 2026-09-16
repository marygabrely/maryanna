<?php
if(!isset($_SESSION)) session_start();
extract($_POST);

if(isset($b_entrar)){

    $arquivo = 'login/'.$login.'.dat';
    $senha_salva = '';

    if(file_exists($arquivo)){
        $f = fopen($arquivo, 'r');
        $linha = fgets($f, 500);
        fclose($f);

        $partes = explode('|', trim($linha));
        $senha_salva = $partes[0];
        $cpf_ref     = isset($partes[1]) ? $partes[1] : '';
    }

    if(md5($senha) == $senha_salva && $senha_salva != ''){

        $_SESSION['Logado'] = 'sim';
        $_SESSION['Nome']   = $login;
        $_SESSION['CPF']    = isset($cpf_ref) ? $cpf_ref : '';

        $arq_usuario = 'usuarios/'.$cpf_ref.'.dat';
        if(file_exists($arq_usuario)){
            $fu = fopen($arq_usuario, 'r');
            $du = fgets($fu, 1000);
            fclose($fu);
            $dados = explode('|', trim($du));
            $_SESSION['NomeCompleto'] = isset($dados[0]) ? $dados[0] : $login;
            $_SESSION['Endereco']     = isset($dados[2]) ? $dados[2] : '';
            $_SESSION['Cidade']       = isset($dados[4]) ? $dados[4] : '';
            $_SESSION['Estado']       = isset($dados[5]) ? $dados[5] : '';
        } else {
            $_SESSION['NomeCompleto'] = $login;
        }

        if(isset($_SESSION['destino']) && $_SESSION['destino'] != ''){
            $ir = $_SESSION['destino'];
            unset($_SESSION['destino']);
            header('Location: '.$ir);
        } elseif(isset($_SESSION['carrinho']) && count($_SESSION['carrinho']) > 0){
            header('Location: carrinho.php');
        } else {
            header('Location: index.php');
        }
        exit;

    } else {
        $_SESSION['erro_entrar'] = 'Login ou senha incorretos. Tente novamente.';
        header('Location: entrar.php');
        exit;
    }
}

header('Location: entrar.php');
exit;
?>
