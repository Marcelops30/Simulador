<center>
    <?php if (isset($_COOKIE['msg'])){ echo $_COOKIE['msg']; } DestroyCookie('msg') ?>
</center>
<table class="table">
    <thead>
        <th>#</th>
        <th>Descrição</th>
        <th>Imagem</th>
        <th>Nome Comp Curricular</th>
        <th>Nome Simulador</th>
        <th>Ação</th>
    </thead>
    <tbody>
        <?php foreach ($listar as $dados): ?>
        <tr>
            <td>
                <?= $dados->id_csm ?>
            </td>
            <td>
                <?= $dados->descricao_csm ?>
            </td>
            
            <td>
                <?= $dados->imagem_csm ?>
            </td>
            <td>
                <?= $dados->nome_ccr ?>
            </td>
            <td>
                <?= $dados->nome_sml ?>
            </td>
            
            <td>
                 <a class="btn btn-warning" href="<?= base_url('cicloSimulador/editar/'.$dados->id_csm) ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Editar</a>
                <a class="btn btn-danger" href="<?= base_url('cicloSimulador/deletar/'.$dados->id_csm) ?>"><i class="fa fa-trash-o" aria-hidden="true"></i>Deletar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
