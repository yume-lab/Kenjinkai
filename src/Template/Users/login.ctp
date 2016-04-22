<style>
  .registArticle form {
    max-width: 30em;
    padding: 0.5em;
    margin: 0 auto;
  }

  .registArticle h2 {
    margin-top: 0;
  }

  .registContents {
    max-width: 750px;
    width: 100%;
    padding: 0.5em;
  }
</style>
<article class="registArticle">
  <section class="registContents">
    <h2 class="registContents_title"><?= __('ログイン'); ?></h2>

    <?= $this->Form->create(null, ['url' => ['controller' => 'Users', 'action' => 'login']]);?>
      <div>
          <?= $this->Form->input('email', ['label' => ['text' => __('メールアドレス')]]); ?>
          <?= $this->Form->input('password', ['label' => ['text' => __('パスワード')]]); ?>
      </div>
      <div class="center">
        <?= $this->Form->button(__('ログイン'), ['class' => 'btn btn-primary']) ?>
      </div>
    <?= $this->Form->end(); ?>
  </section>
</article>
