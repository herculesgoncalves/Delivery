<?php 

//dados locais

$usuario = 'root';
$senha = '';
$banco = 'delivery_interativo';
$servidor = 'localhost';

/*
//servidor hospedado
$usuario = 'hugocu75_interativo';
$senha = 'interativoteste';
$banco = 'hugocu75_interativo';
$servidor = 'sh-pro24.hostgator.com.br';
*/

$url_sistema = "http://$_SERVER[HTTP_HOST]/";
$url = explode("//", $url_sistema);
if($url[1] == 'localhost/'){
	$url_sistema = "http://$_SERVER[HTTP_HOST]/delivery-interativo/";
}

date_default_timezone_set('America/Sao_Paulo');

try {
	$pdo = new PDO("mysql:dbname=$banco;host=$servidor;charset=utf8", "$usuario", "$senha");
} catch (Exception $e) {
	echo 'Não conectado ao Banco de Dados! <br><br>' .$e;
}


$nome_sistema = 'Delivery Interativo';
$email_sistema = 'contato@hugocursos.com.br';
$telefone_sistema = '(31) 97527-5084';



//VERIFICAR SE EXISTE DADOS NO CONFIG
$query = $pdo->query("SELECT * FROM config");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg == 0){
//CRIAR UM USUÁRIO ADMIN
$pdo->query("INSERT INTO config SET nome_sistema = '$nome_sistema', email_sistema = '$email_sistema', telefone_sistema = '$telefone_sistema', tipo_rel = 'PDF', tipo_miniatura = 'Cores', status_whatsapp = 'Sim', previsao_entrega = '60', horario_abertura = '18:00', horario_fechamento = '00:00', status_estabelecimento = 'Aberto', logo_sistema = 'logo.png', favicon_sistema = 'favicon.png', logo_rel = 'logo_rel.jpg', tempo_atualizar = '30', dias_apagar = '30', impressao_automatica = 'Não', fonte_comprovante = '11', banner_rotativo = 'Sim', mostrar_aberto = 'Sim' ");
}else{
$nome_sistema = $res[0]['nome_sistema'];
$email_sistema = $res[0]['email_sistema'];
$telefone_sistema = $res[0]['telefone_sistema'];
$telefone_fixo = $res[0]['telefone_fixo'];
$endereco_sistema = $res[0]['endereco_sistema'];
$instagram_sistema = $res[0]['instagram_sistema'];
$tipo_rel = $res[0]['tipo_rel'];
$tipo_miniatura = $res[0]['tipo_miniatura'];
$status_whatsapp = $res[0]['status_whatsapp'];
$previsao_entrega = $res[0]['previsao_entrega'];
$horario_abertura = $res[0]['horario_abertura'];
$horario_fechamento = $res[0]['horario_fechamento'];
$texto_fechamento_horario = $res[0]['texto_fechamento_horario'];
$status_estabelecimento = $res[0]['status_estabelecimento'];
$texto_fechamento = $res[0]['texto_fechamento'];
$logo_sistema = $res[0]['logo_sistema'];
$favicon_sistema = $res[0]['favicon_sistema'];
$logo_rel = $res[0]['logo_rel'];
$tempo_atualizar = $res[0]['tempo_atualizar'];
$tipo_chave = $res[0]['tipo_chave'];
$chave_pix = $res[0]['chave_pix'];
$cnpj_sistema = $res[0]['cnpj'];
$dias_apagar = $res[0]['dias_apagar'];
$impressao_automatica = $res[0]['impressao_automatica'];
$fonte_comprovante = $res[0]['fonte_comprovante'];
$banner_rotativo = $res[0]['banner_rotativo'];
$token = $res[0]['token'];
$instancia = $res[0]['instancia'];
$ativo_sistema = $res[0]['ativo'];
$pedido_minimo = $res[0]['pedido_minimo'];
$mostrar_aberto = $res[0]['mostrar_aberto'];
$chave_api_maps = $res[0]['chave_api_maps'];
$entrega_distancia = $res[0]['entrega_distancia'];

$latitude_rest = $res[0]['latitude_rest'];
$longitude_rest = $res[0]['longitude_rest'];
$distancia_entrega_km = $res[0]['distancia_entrega_km'];
$valor_km = $res[0]['valor_km'];
$mais_sabores = $res[0]['mais_sabores'];

$whatsapp_sistema = '55'.preg_replace('/[ ()-]+/' , '' , $telefone_sistema);
}


if($ativo_sistema != 'Sim' and $ativo_sistema != ''){ ?>
	<style type="text/css">
		@media only screen and (max-width: 700px) {
  .imgsistema_mobile{
    width:300px;
  }
    
}
	</style>
	<div style="text-align: center; margin-top: 100px">
	<img src="<?php echo $url_sistema ?>img/bloqueio.png" class="imgsistema_mobile">	
	</div>
<?php 
exit();
} 
 ?>
