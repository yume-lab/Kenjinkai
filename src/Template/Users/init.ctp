<div class="container">
    <div class="row">
        <div class="well col-md-5 center login-box" style="margin-top: 2em;">
            <div class="alert alert-info">
                <?= __('利用規約に同意のうえ登録をお願いします。'); ?>
            </div>
            <?= $this->Flash->render() ?>
            <?= $this->Form->create(null, ['class' => 'form-horizontal','url' => ['controller' => 'Users', 'action' => 'init']]);?>
                <fieldset>
                    <div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user red"></i></span>
                        <input name="email" type="text" class="form-control" placeholder="メールアドレス">
                    </div>
                    <div class="clearfix"></div>
                    <br>
                    <!--
                    <div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock red"></i></span>
                        <input name="password" type="password" class="form-control" placeholder="パスワード">
                    </div>
                    <div class="clearfix"></div>
                    <br>
                    -->
                    <div class="input-group input-group-lg" style="margin: 0 auto; ">
                        <label class="checkbox-inline">
                            <input name="is_agree" type="checkbox" value="1" checked="checked" />
                            <?= __('<a href="/pages/terms" target="_blank">利用規約</a>に同意して登録する'); ?>
                        </label>
                    </div>
                    <div class="clearfix"></div>

                    <p class="center col-md-10">
                        <button type="submit" class="btn btn-primary">
                            <?= __('登録する'); ?>
                        </button>
                    </p>
                </fieldset>
            <?= $this->Form->end(); ?>
        </div>
    </div>
</div>

