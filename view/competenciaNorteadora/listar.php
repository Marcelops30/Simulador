<center>
    <?php if (isset($_COOKIE['msg'])){ echo $_COOKIE['msg']; } DestroyCookie('msg') ?>
</center>
<table class="table">
    <thead>
        <th>#</th>
        <th>Nome competencia</th>
        <th>Nome Simulador Associado</th>
        <th>Ação</th>
    </thead>
    <tbody>
        <?php foreach ($listar as $dados): ?>
        <tr>
            <td>
                <?= $dados->id_cnr ?>
            </td>
            <td>
                <?= $dados->nome_cnr ?>
            </td>
            <td>
                <?= $dados->nome_sml ?>
            </td>
            <td>
                <a href="<?= base_url('competenciaNorteadora/editar/'.$dados->id_csm) ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Editar</a>
                <a href="<?= base_url('competenciaNorteadora/deletar/'.$dados->id_csm) ?>"><i class="fa fa-trash-o" aria-hidden="true"></i>Deletar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
