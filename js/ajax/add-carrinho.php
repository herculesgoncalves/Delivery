<?php 
@session_start();
require_once('../../sistema/conexao.php');

$produto = $_POST['produto'];
//$telefone = $_POST['telefone'];
//$nome = $_POST['nome'];
$quantidade = $_POST['quantidade'];
$total_item = $_POST['total_item'];
$obs = $_POST['obs'];
$sessao = @$_SESSION['sessao_usuario'];
$sabores = $_POST['sabores'];
$variacao = $_POST['variacao'];
//$mesa = $_POST['mesa'];

$query = $pdo->query("SELECT * FROM carrinho where sessao = '$sessao' and id_sabor != 0 order by id desc limit 1 ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){
	$id_sabor = $res[0]['id_sabor'];
	$ult_produto = $res[0]['produto'];
	$ult_variacao = $res[0]['variacao'];
	$ult_total_item = $res[0]['total_item'];
}else{
	$id_sabor = 0;
	$ult_produto = 0;
	$ult_variacao = 0;
	$ult_total_item = 0;
}

if($sabores == 1){
	$id_sabor += 1;
}

if($sabores != 1 and $sabores != 2){
	$id_sabor = 0;
}

$query = $pdo->query("SELECT * FROM produtos where id = '$produto'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$id_categoria = $res[0]['categoria'];
$valor_produto = $res[0]['valor_venda'];
$estoque = $res[0]['estoque'];
$tem_estoque = $res[0]['tem_estoque'];

//ver se possui a quantidade de produtos comprados
if($quantidade > $estoque and $tem_estoque == 'Sim'){
	echo 'Quantidade em Estoque insuficiente, possui apenas '.$estoque.' Itens';
	exit();
}

$query = $pdo->query("SELECT * FROM variacoes where id = '$variacao'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
$valor_produto = $res[0]['valor'];
}



$query = $pdo->query("SELECT * FROM produtos where id = '$ult_produto'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$valor_ult_produto = @$res[0]['valor_venda'];

$query = $pdo->query("SELECT * FROM variacoes where id = '$ult_variacao'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
$valor_ult_produto = $res[0]['valor'];
}

if($valor_produto > $valor_ult_produto){
	$produto_menor = $valor_ult_produto;
}else{
	$produto_menor = $valor_produto;
}


$total_item2 = $ult_total_item + $total_item - $produto_menor;



$query = $pdo->prepare("INSERT INTO carrinho SET sessao = '$sessao', cliente = '0', produto = '$produto', quantidade = '$quantidade', total_item = '$total_item', obs = :obs, pedido = '0', id_sabor = '$id_sabor', data = curDate(), variacao = '$variacao', mesa = '0', nome_cliente = ''"); 
$query->bindValue(":obs", "$obs");
$query->execute();
$id_carrinho = $pdo->lastInsertId();
echo 'Inserido com Sucesso';


//limpar os ingredientes e adicionais
$pdo->query("UPDATE temp SET carrinho = '$id_carrinho' where sessao = '$sessao' and carrinho = '0'"); 

if($sabores == 2){
	$query = $pdo->prepare("INSERT INTO carrinho SET sessao = '$sessao', cliente = '0', produto = '0', quantidade = '1', total_item = '$total_item2',  pedido = '0', id_sabor = '0', data = curDate(), categoria = '$id_categoria', item = '$id_sabor', variacao = '$variacao', mesa = '0', nome_cliente = :nome_cliente"); 

$query->bindValue(":nome_cliente", "");
$query->execute();
}

//abater produto estoque
if($tem_estoque == 'Sim'){
$total_produtos = $estoque - $quantidade;
$pdo->query("UPDATE produtos SET estoque = '$total_produtos' where id = '$produto'"); 
}

 ?>