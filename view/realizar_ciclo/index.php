<div class="panel panel-default">
        <div class="panel-heading">Cadastrar -
    <?php if (isset($_COOKIE['msg'])){ echo $_COOKIE['msg']; } setcookie('msg', NULL, time()-1) ?>
        <div class="panel-body">
            <form action="<?= base_url('realizarciclo/novo') ?>" method="post" class="form-horizontal">
                <div class="form-group">
                    <label for="name" class="control-label col-sm-4">Pontuaçao Alcançada</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="pontuacaoAlcancadaRcc">
                    </div>
                </div>
				<div class="form-group">
                    <label for="name" class="control-label col-sm-4">Ciclo</label>
                    <div class="col-sm-8">
                    <?php 
						echo gerar_dropdown('tb_cicl_simu','id_csm', 'descricao_csm', 'id_csm');
					?>
                    
                    </div>
                </div>
   
                <div class="form-group">
                    <label for="name" class="control-label col-sm-4">Usuario</label>
                    <div class="col-sm-8">
                    <?php 
						echo gerar_dropdown('tb_usuario','id_usu', 'nome_usu', 'id_usu');
					?>
                    
                    </div>
                </div>
                <button type="submit" name="acao" value="novo" class="btn btn-default"> Cadastrar </button>
            </form>

