<div class="modal fade" id="login-form" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">
            <?= __('ログイン'); ?>
        </h4>
      </div>
      <div class="modal-body">
          <?= $this->Form->input('email', ['label' => ['text' => __('メールアドレス')]]); ?>
          <?= $this->Form->input('password', ['label' => ['text' => __('パスワード')]]); ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">
            <?= __('閉じる'); ?>
        </button>
        <button type="button" class="btn btn-primary">
            <?= __('ログイン'); ?>
        </button>
      </div>
    </div>
  </div>
</div>
