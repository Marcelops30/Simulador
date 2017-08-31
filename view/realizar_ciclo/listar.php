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
            <td><a href="<?= base_url('realizarciclo/deletar/'.$dados->id_rcc) ?>">Deletar</a>
                <a href="<?= base_url('realizarciclo/editar/'.$dados->id_rcc) ?>">Editar</a></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
