<?php
if(!isset($_SESSION)) session_start();
include "app/cons.php";
require_once "app/DLL.php";
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
    $total_bd      = number_format($total, 2, '.', '');
    $usuario_sessao = $_SESSION['Nome'];

    $consulta = "INSERT INTO pedidos (Id, Codigo, Usuario, NomeCliente, Itens, DataHora, ValorTotal, FormaPagamento) VALUES (NULL, '$codigo', '$usuario_sessao', '$nome_completo', '$lista', '$data', '$total_bd', '$pagamento')";
    banco($server, $user, $password, $db, $consulta);

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