<style>
  .registArticle form {
    max-width: 30em;
  }

  .registContents {
    max-width: 750px;
    width: 100%;
  }
  
  .cell-table {
    display: table;
    width: 100%;
  }

  .cell-table .item {
      display: table-cell;
      padding-right: 0.5em;
  }

  .cell-table .item input {
      width: 100%;
  }
</style>
<article class="registArticle">
  <section class="registContents">
    <h2 class="registContents_title">登録内容の入力</h2>
    
    <?= $this->Form->create($user, ['class' => 'registContents_form']) ?>
      <?=
        // 入力できないように. pre_registerから取得する
        $this->Form->input('email', ['label' => [
          'class' => 'registContents_form_item-required',
          'text' => 'ご登録メールアドレス'
        ]]);
      ?>

      <?=
        $this->Form->input('password', ['label' => [
          'class' => 'registContents_form_item-required',
          'text' => 'パスワード'
        ]]);
      ?>

      <?=
        $this->Form->input('password_confirm', ['label' => [
          'class' => 'registContents_form_item-confirm',
          'text' => 'パスワード'
        ]]);
      ?>

      <div class="cell-table">
        <div class="item">
            <?= $this->Form->input('name', ['label' => '本名']); ?>
        </div>
        <div class="item">
            <?= $this->Form->input('nickname', ['label' => 'ニックネーム']); ?>
        </div>
      </div>

      <?=
        $this->Form->input('gender', [
          'type'=>'radio',
          'options' => ['1' => '男性', '2' => '女性'], // TODO: 設定ファイルから
          'label' => [
            'class' => 'registContents_form_item-required',
            'text' => '性別'
          ]
        ]);
      ?>

    // TODO: とりあえずここまで. 次は生年月日とか

    <?= $this->Form->end() ?>
    
  </section>
</article>
