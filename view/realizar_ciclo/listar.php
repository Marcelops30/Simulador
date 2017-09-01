<center>
    <?php if (isset($_COOKIE['msg'])){ echo $_COOKIE['msg']; } DestroyCookie('msg') ?>
</center>
<table class="table">
    <thead>
        <th>#</th>
        <th>Pontuação Alcançada</th>
        <th>Ciclo</th>
        <th>Usuario</th>
        <th>Ação</th>
    </thead>
    <tbody>
        <?php foreach ($listar as $dados): ?>
        <tr>
            <td>
                <?= $dados->id_rcc ?>
            </td>
            <td>
                <?= $dados->pontuacaoAlcancada_rcc ?>
            </td>
            <td>
                <?= $dados->id_csm ?>
            </td>
            <td>
                <?= $dados->id_usu ?>
            </td>
            <td>
                <a class="btn btn-warning" href="<?= base_url('realizarciclo/editar/'.$dados->id_csm) ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Editar</a>
                <a class="btn btn-danger" href="<?= base_url('realizarciclo/deletar/'.$dados->id_csm) ?>"><i class="fa fa-trash-o" aria-hidden="true"></i>Deletar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
