<div class="container">
    <div class="row">
        <div class="col-md-5 center login-box" style="margin-top: 2em;">
            <div class="alert alert-info">
                <?= __('新しいパスワードを入力してください。') ?>
            </div>
            <?= $this->Flash->render() ?>
            <?=
              $this->Form->create(null, [
                'class' => 'form-horizontal',
                'style' => 'padding: 0 2em; text-align: left;'
              ]);
            ?>
            <div class="form-group">
                <div class="col-md-12">
                    <?= $this->Form->input('password', ['label' => __('パスワード'), 'value' => '']); ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <?= $this->Form->input('confirm_password', ['type' => 'password', 'label' => __('パスワード確認')]); ?>
                </div>
            </div>

            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">設定</button>
            </div>
            <?= $this->Form->end(); ?>
        </div>
    </div>
</div>

