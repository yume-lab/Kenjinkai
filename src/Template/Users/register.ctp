<style>
  .registArticle form {
    width: 30em;
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
    
    <form class="registContents_form" action="regsit_confirm.html">
      <div class="form-group">
        <label class="registContents_form_item registContents_form_item-required" for="email">メールアドレス</label>
        <input class="form-control registContents_form_confirm-large" type="email" id="email" />
      </div>
      <div class="form-group">
        <label class="registContents_form_item registContents_form_item-confirm" for="emailConfirm">メールアドレス</label>
        <input class="form-control form-control-large" type="email" id="emailConfirm" />
      </div>
      <div class="form-group">
        <label class="registContents_form_item registContents_form_item-required" for="password">パスワード</label>
        <small class="registContents_form_hint">〇～〇文字、半角英数がご利用いただけます</small>
        <input class="form-control form-control-small" type="password" id="password" />
      </div>
      <div class="form-group col">
        <div class="registContents_form_col col-left">
          <label class="registContents_form_item" for="name">本名</label>
          <input class="form-control form-control-small" type="text" id="name" />
        </div>
        <div class="registContents_form_col col-right">
          <label class="registContents_form_item registContents_form_item-required" for="nickname">ニックネーム</label>
          <input class="form-control form-control-small" type="text" id="nickname" />
        </div>
      </div>
      <div class="form-group">
        <label class="registContents_form_item registContents_form_item-required">性別</label>
        <label class="registContents_form_radio"> <input type="radio" name="sex" id="" />男性</label>
        <label class="registContents_form_radio"> <input type="radio" name="sex" id="" />女性</label>
      </div>
      <div class="form-group">
        <label class="registContents_form_item">生年月日</label>
        <label>
          <select class="form-control">
            <option></option>
            <option>1900</option>
          </select> 年　　
        </label>
        <label>
          <select class="registContents_form_select">
            <option></option>
            <option>12</option>
          </select> 月　　
        </label>
        <label>
          <select class="registContents_form_select">
            <option></option>
            <option>12</option>
          </select> 日　
        </label>
      </div>
      <div class="form-group">
        <label class="registContents_form_item registContents_form_item-required">生まれ故郷</label>
        <label>
          <select class="registContents_form_select">
            <option>都道府県</option>
            <option>北海道</option>
          </select>
        </label>　
        <label>
          <select class="registContents_form_select">
            <option>市町村</option>
            <option>札幌市</option>
          </select>
        </label>
      </div>
      <div class="form-group">
        <label class="registContents_form_item">生まれ故郷が海外の方</label>
        <label>
          <select class="registContents_form_select">
            <option>国</option>
            <option>aaaaaaaaaaaa</option>
          </select>
        </label>
      </div>
      <div class="form-group">
        <label class="registContents_form_item registContents_form_item-required" for="hobby1">趣味</label>
        <input class="form-control form-control-large form-control-array" type="text" id="hobby1" />
        <input class="form-control form-control-large form-control-array" type="text" id="hobby2" />
        <input class="form-control form-control-large form-control-array" type="text" id="hobby3" />
      </div>
      <div class="form-group">
        <label class="registContents_form_item registContents_form_item-required" for="Memories">故郷の思い出</label>
        <small class="registContents_form_hint">500文字以内</small>
        <textarea id="Memories" class="registContents_form_textarea"></textarea>
      </div>
      <div class="form-group center">
        <input class="registContents_form_submit" type="submit" value="確認画面に進む" />
      </div>
    </form>
  </section>
</article>
