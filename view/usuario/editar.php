<div class="col-md-6 col-md-offset-3">
    <div class="panel panel-default">
        <div class="panel-heading">  <center> Atualizar Cadastro
              <?php if (isset($_COOKIE['msg'])){ echo $_COOKIE['msg']; } setcookie('msg', NULL, time()-1) ?></center>  </div>
        <div class="panel-body">
            <form action="<?= base_url('usuario/atualizar/' .$resultado->id_usu) ?>" method="post" class="form-horizontal">

                <div class="form-group">
                    <label for="name" class="control-label col-sm-4">Nome</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" required="required" name="nome" pattern="[a-zA-Z\s]+$" title="Digite seu nome" maxlength="45" value="<?= $resultado->nome_usu ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="control-label col-sm-4">Sobrenome</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" required="required" name="sobrenome" title="sobrenome" pattern="[a-zA-Z\s]+$" maxlength="30" value="<?= $resultado->sobrenome_usu ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="control-label col-sm-4">Username</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" required="required" name="username" title="username" pattern="[a-zA-Z0-9\s]+$" maxlength="25" value="<?= $resultado->username_usu ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="name" class="control-label col-sm-4">Email</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" required="required" name="email" title="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" maxlength="45" value="<?= $resultado->email_usu ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="control-label col-sm-4">CPF</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="cpf" required="required" title="digite o cpf" maxlength="11" value="<?= $resultado->cpf_usu ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="control-label col-sm-4">Senha</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" required="required" name="senha" maxlength="25">
                    </div>
                </div>


                <div class="form-group">
                    <label for="name" class="control-label col-sm-4">Sexo</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="sexo" title="sexo" value="<?= $resultado->sexo_usu ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="name" class="control-label col-sm-4">Perfil</label>
                    <div class="col-sm-8">
                        <?php 
                        echo gerar_dropdown('tb_perfil','id_per', 'desc_per', 'id_per')
                        ?>
                    </div>
                </div>


                <center><button type="submit" name="acao" value="update" class="btn btn-default"> Atualizar Cadastro </button></center>
            </form>
        </div>
    </div>
</div>
