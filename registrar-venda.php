<?php
if(!isset($_SESSION)) session_start();
extract($_POST);

if(!isset($_SESSION['Logado']) || $_SESSION['Logado'] != 'sim'){
    header('Location: entrar.php');
    exit;
}

if(isset($b_registrar)){

    $carrinho = isset($_SESSION['carrinho']) ? $_SESSION['carrinho'] : array();

    if(empty($carrinho)){
        header('Location: carrinho.php');
        exit;
    }

    if(!is_dir('vendas')) mkdir('vendas', 0777, true);

    $codigo = date('YmdHis').rand(100,999);
    $data   = date('d/m/Y H:i:s');
    $total  = 0;

    foreach($carrinho as $item) $total += $item['preco'];

    $lista = '';
    foreach($carrinho as $item){
        $lista .= $item['nome'].' (R$'.number_format($item['preco'],2,'.',',').')|';
    }
    $lista = rtrim($lista, '|');

    $nome_completo = isset($_SESSION['NomeCompleto']) ? $_SESSION['NomeCompleto'] : $_SESSION['Nome'];

    // codigo|login|nome|produtos|data|total|pagamento
    $linha = $codigo.'|'.$_SESSION['Nome'].'|'.$nome_completo.'|'.$lista.'|'.$data.'|'.number_format($total,2,'.',',').'|'.$pagamento;

    $f = fopen('vendas/'.$codigo.'.dat', 'w');
    fwrite($f, $linha);
    fclose($f);

    $_SESSION['carrinho'] = array();
    $_SESSION['pedido_feito'] = array(
        'codigo'    => $codigo,
        'itens'     => $carrinho,
        'total'     => $total,
        'pagamento' => $pagamento,
        'data'      => $data
    );

    header('Location: pedido-confirmado.php');
    exit;
}

header('Location: pedido.php');
exit;
?>
