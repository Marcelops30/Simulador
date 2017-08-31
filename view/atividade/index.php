
<form id="frm-atividade" action="<?=base_url('atividade/novo') ?>" method="post" enctype="multipart/form-data">
   
    <div class="form-group">
        <label>Nome</label>
        <input type="text" name="nome_asm" class="form-control" required="required" placeholder=""  pattern="[a-zA-Z\s]+$" title="Digite o nome"/>
    </div>

    <div class="form-group">
        <label>Tempo</label>
        <input type="time" name="tempo_asm" class="form-control" required="required" pattern="[0-9]{2}:[0-9]{2} [0-9]{2}$" />
    </div>

    <div class="form-group">
        <label>Pontuação</label>
        <input type="number" name="pontuacao_asm" required="required" class="form-control" pattern="[0-9]+$"  />
    </div>

    <div class="form-group">
        <label>Imagem</label>
        <input type="file" name="imagem_asm" required="required" class="form-control"  />
    </div>
    
    <div class="form-group">
    <label>Ciclo Simulador</label>
      
    <?php 
    echo gerar_dropdown('tb_cicl_simu','id_csm', 'descricao_csm', 'id_csm');
    ?>
    </div>
    
    <hr />

    <div class="text-right">
        <button class="btn btn-success">Guardar</button>
    </div>
</form>

<script>
    $(document).ready(function(){
        $("#frm-atividade").submit(function(){
            return $(this).validate();
        });
    })
</script>
