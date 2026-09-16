<?php
if(!isset($_SESSION)) session_start();
extract($_POST);

if(isset($b_incluir)){

    if(!isset($_SESSION['carrinho'])) $_SESSION['carrinho'] = array();

    $repetido = false;
    foreach($_SESSION['carrinho'] as $item){
        if($item['id'] == $pid){ $repetido = true; break; }
    }

    if(!$repetido){
        $_SESSION['carrinho'][] = array(
            'id'    => $pid,
            'nome'  => $pnome,
            'preco' => floatval($ppreco)
        );
    }

    if(!isset($_SESSION['Logado']) || $_SESSION['Logado'] != 'sim'){
        $_SESSION['aviso_entrar'] = 'Faca login para finalizar seu pedido.';
        $_SESSION['destino']      = 'carrinho.php';
        header('Location: entrar.php');
        exit;
    }

    $_SESSION['aviso_vitrine'] = 'Kit adicionado a sua sacola!';
    header('Location: carrinho.php');
    exit;
}

header('Location: index.php');
exit;
?>
