<center>
    <?php if (isset($_COOKIE['msg'])){ echo $_COOKIE['msg']; } DestroyCookie('msg') ?>
</center>
<table class="table">
    <thead>
        <th>#</th>
        <th>Descrição</th>
        <th>Ação</th>
    </thead>
    <tbody>
        <?php foreach ($listar as $dados): ?>
        <tr>
            <td>
                <?= $dados->id_cur ?>
            </td>
            <td>
                <?= $dados->nome_cur ?>
            </td>
            <td>
                <a href="<?= base_url('curso/editar/'.$dados->id_csm) ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Editar</a>
                <a href="<?= base_url('curso/deletar/'.$dados->id_csm) ?>"><i class="fa fa-trash-o" aria-hidden="true"></i>Deletar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
