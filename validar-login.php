<?php
if(!isset($_SESSION)) session_start();
include "app/cons.php";
require_once "app/DLL.php";
extract($_POST);

if(isset($b_entrar)){

    $senha_salva = '';
    $cpf_ref     = '';

    $consulta  = "SELECT * FROM acessos WHERE Usuario = '$login'";
    $resultado = banco($server, $user, $password, $db, $consulta);

    if($linha = $resultado->fetch_assoc()){
        $senha_salva = $linha['SenhaHash'];
        $cpf_ref     = $linha['CPF'];
    }

    if(md5($senha) == $senha_salva && $senha_salva != ''){

        $_SESSION['Logado'] = 'sim';
        $_SESSION['Nome']   = $login;
        $_SESSION['CPF']    = $cpf_ref;

        $consulta  = "SELECT * FROM clientes WHERE CPF = '$cpf_ref'";
        $resultado = banco($server, $user, $password, $db, $consulta);

        if($dados = $resultado->fetch_assoc()){
            $_SESSION['NomeCompleto'] = $dados['NomeCompleto'];
            $_SESSION['Endereco']     = $dados['Endereco'];
            $_SESSION['Cidade']       = $dados['Cidade'];
            $_SESSION['Estado']       = $dados['Estado'];
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