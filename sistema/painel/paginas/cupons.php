<?php 
//verificar se ele tem a permissão de estar nessa página
if(@$cupons == 'ocultar'){
    echo "<script>window.location='../index.php'</script>";
    exit();
}
$pag = 'cupons';
 ?>
<a class="btn btn-primary" onclick="inserir()" class="btn btn-primary btn-flat btn-pri"><i class="fa fa-plus" aria-hidden="true"></i> Novo Cupom</a>


<div class="bs-example widget-shadow" style="padding:15px" id="listar">
	
</div>





<!-- Modal Inserir-->
<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"><span id="titulo_inserir"></span></h4>
				<button id="btn-fechar" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
					<span aria-hidden="true" >&times;</span>
				</button>
			</div>
			<form id="form">
			<div class="modal-body">

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Código</label>
								<input type="text" class="form-control" id="codigo" name="codigo" placeholder="Código do Cupom" required>    
							</div> 	
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Valor</label>
								<input type="text" class="form-control" id="valor" name="valor" placeholder="Valor" required>    
							</div> 	
						</div>
					
					</div>

					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Quantidade</label>
								<input type="number" class="form-control" id="quantidade" name="quantidade" placeholder="Quantidade" value="1">    
							</div> 	
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Data Validade</label>
								<input type="date" class="form-control" id="data" name="data" placeholder="Data de Validade" >    
							</div> 	
						</div>


						<div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Valor Mínimo</label>
								<input type="text" class="form-control" id="valor_minimo" name="valor_minimo" placeholder="Valor Mínimo" >    
							</div> 	
						</div>
					
					</div>


								
						<input type="hidden" name="id" id="id">

					<br>
					<small><div id="mensagem" align="center"></div></small>
				</div>

				<div class="modal-footer">      
					<button type="submit" class="btn btn-primary">Salvar</button>
				</div>
			</form>

			
		</div>
	</div>
</div>





<script type="text/javascript">var pag = "<?=$pag?>"</script>
<script src="js/ajax.js"></script>

