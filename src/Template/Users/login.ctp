<div class="container">
    <div class="row">
        <div class="well col-md-5 center login-box" style="margin-top: 2em;">
            <div class="alert alert-info">
            メールアドレスとパスワードを入力してください
            </div>
            <?= $this->Flash->render() ?>
            <?= $this->Form->create(null, ['class' => 'form-horizontal','url' => ['controller' => 'Users', 'action' => 'login']]);?>
                <fieldset>
                    <div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user red"></i></span>
                        <input name="email" type="text" class="form-control" placeholder="メールアドレス">
                    </div>
                    <div class="clearfix"></div>
                    <br>
                    <div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock red"></i></span>
                        <input name="password" type="password" class="form-control" placeholder="パスワード">
                    </div>
                    <div class="clearfix"></div>
                    <p class="center col-md-10">
                        <button type="submit" class="btn btn-primary">ログイン</button>
                    </p>

                    <div class="input-group input-group-lg" style="margin-left: auto; font-size: 0.8em;">
                        <a href="/users/forgot">
                            <?= __('パスワードをお忘れの方はこちら'); ?>
                        </a>
                    </div>
                </fieldset>
            <?= $this->Form->end(); ?>
        </div>
    </div>
</div>

