<?php
if(!isset($_SESSION)) session_start();
include "app/cons.php";
require_once "app/DLL.php";
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

    $consulta  = "SELECT * FROM clientes WHERE CPF = '$cpf_limpo'";
    $resultado = banco($server, $user, $password, $db, $consulta);

    if($resultado->num_rows > 0){
        $_SESSION['erro_cadastro'] = 'Este CPF ja esta cadastrado no sistema.';
        header('Location: novo-cadastro.php');
        exit;
    }

    $consulta  = "SELECT * FROM acessos WHERE Usuario = '$login'";
    $resultado = banco($server, $user, $password, $db, $consulta);

    if($resultado->num_rows > 0){
        $_SESSION['erro_cadastro'] = 'Este nome de usuario ja esta em uso. Escolha outro.';
        header('Location: novo-cadastro.php');
        exit;
    }

    // Salva dados pessoais na tabela clientes
    $consulta = "INSERT INTO clientes (Id, NomeCompleto, CPF, Endereco, Bairro, Cidade, Estado, CEP) VALUES (NULL, '$nome', '$cpf_limpo', '$endereco', '$bairro', '$cidade', '$estado', '$cep')";
    banco($server, $user, $password, $db, $consulta);

    // Salva login na tabela acessos
    $senha_hash = md5($senha);
    $consulta   = "INSERT INTO acessos (Id, Usuario, SenhaHash, CPF) VALUES (NULL, '$login', '$senha_hash', '$cpf_limpo')";
    banco($server, $user, $password, $db, $consulta);

    $_SESSION['aviso_entrar'] = 'Cadastro realizado! Faca login para continuar.';
    header('Location: entrar.php');
    exit;
}

header('Location: novo-cadastro.php');
exit;
?>