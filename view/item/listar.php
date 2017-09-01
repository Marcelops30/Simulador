<table class="table table-striped">
    <thead>
        <tr>
            <th style="width:180px;">ID</th>
            <th style="width:120px;">Nome</th>
            <th style="width:120px;">Seguencia</th>
            <th style="width:120px;">Atividade</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($listar as $r): ?>
        <tr>
            <td><?php echo $r->id_ias; ?></td>
            <td><?php echo $r->nome_ias; ?></td>
            <td><?php echo $r->sequencia_ias; ?></td>
            <td><?php echo $r->id_asm; ?></td>
            <td>
                <a href="<?= base_url('Item/editar/' . $r->id_ias); ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Editar</a>
                <a onclick="javascript:return confirm('¿Certeza que queres eliminar este registro?');" href="<?= base_url('Item/deletar/' . $r->id_ias); ?>"><i class="fa fa-trash-o" aria-hidden="true"></i>Eliminar</a>
            </td>
            <td>
                
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
