<center>
    <?php if (isset($_COOKIE['msg'])){ echo $_COOKIE['msg']; } DestroyCookie('msg') ?>
</center>
<table class="table">
    <thead>
        <th>#</th>
        <th>Nome</th>
        <th>Carga Horaria</th>
        <th>Ação</th>
    </thead>
    <tbody>
        <?php foreach ($componentes as $dados): ?>
        <tr>
            <td>
                <?= $dados->id_ccr ?>
            </td>
            <td>
                <?= $dados->nome_ccr ?>
            </td>
            <td>
                <?= $dados->cargaHoraria_ccr ?>
            </td>
            <td>
                <a href="<?= base_url('ComponenteCurricular/editar/'.$dados->id_csm) ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Editar</a>
                <a href="<?= base_url('ComponenteCurricular/deletar/'.$dados->id_csm) ?>"><i class="fa fa-trash-o" aria-hidden="true"></i>Deletar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
