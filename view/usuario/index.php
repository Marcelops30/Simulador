    <div class="panel panel-default">
        <div class="panel-heading">Novo Usuário -
    <?php if (isset($_COOKIE['msg'])){ echo $_COOKIE['msg']; } setcookie('msg', NULL, time()-1) ?>
	<?php //if (isset($_COOKIE['msg'])){ echo $_COOKIE['msg']; } DestroyCookie('msg') ?></div>
        <div class="panel-body">

            <form action="<?= base_url('usuario/novo') ?>" method="post" class="form-horizontal">
                <div class="form-group">
                    <label for="name" class="control-label col-sm-4">Nome</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" required="required" name="nome" pattern="[a-zA-Z\s]+$" title="Digite seu nome" maxlength="45">
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="control-label col-sm-4">Sobrenome</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" required="required" name="sobrenome" title="sobrenome" pattern="[a-zA-Z\s]+$" maxlength="30">
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="control-label col-sm-4">Username</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" required="required" name="username" title="username" pattern="[a-zA-Z0-9\s]+$" maxlength="25">
                    </div>
                </div>

                <div class="form-group">
                    <label for="name" class="control-label col-sm-4">Email</label>
                    <div class="col-sm-8">
                        <input type="email" class="form-control" required="required" name="email" title="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" maxlength="45">
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="control-label col-sm-4">CPF</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="cpf" required="required" title="digite o cpf" maxlength="11">
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
                        <select class="form-control" name="sexo">
                        <option value="M">Masculino</option>
                        <option value="F">Feminino</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="name" class="control-label col-sm-4">Perfil</label>
                    <div class="col-sm-8">
                        <select class="form-control" name="perfil">
                        <?php
                        foreach($perfis as $perfil):
                        ?>
                            <option value=" <?= $perfil->id_per ?>"> <?= $perfil->desc_per ?></option>
                        <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <button type="submit" name="acao" value="novo" class="btn btn-default"> Cadastrar </button>
            </form>
        </div>
    </div>
