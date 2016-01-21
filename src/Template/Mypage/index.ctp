<style>
  .registArticle form {
    max-width: 30em;
    padding: 0.5em;
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

  .cell-table .item input
  {
      width: 100%;
  }

  .cell-table .item select
  {
      width: 12em;
  }

  textarea {
    width: 100%;
  }

</style>
<article class="registArticle">
  <section class="registContents">
    <h2 class="registContents_title"><?= __('登録内容の入力'); ?></h2>

    <?= $this->Form->create($user, ['class' => 'registContents_form']) ?>
      <div class="form-group">
        <?= $this->Form->label('email', __('ご登録メールアドレス'), ['class' => 'registContents_form_item-required']); ?>
        <div>
          <?= h($user->email); ?>
          <?= $this->Form->hidden('email'); ?>
        </div>
      </div>

      <?=
        $this->Form->input('password', ['label' => [
          'class' => 'registContents_form_item-required',
          'text' => __('パスワード')
        ]]);
      ?>

      <?=
        $this->Form->input('password_confirm', [
          'label' => [
            'class' => 'registContents_form_item-confirm',
            'text' => __('パスワード')
          ],
          'type' => 'password'
        ]);
      ?>

      <div class="form-group">
        <div class="cell-table">
          <div class="item">
              <?= $this->Form->input('user_profile.name', ['label' => __('本名')]); ?>
          </div>
          <div class="item">
              <?= $this->Form->input('user_profile.nickname', ['label' => __('ニックネーム')]); ?>
          </div>
        </div>
      </div>

      <?=
        $this->Form->input('user_profile.gender', [
          'type'=>'radio',
          'options' => $genders,
          'label' => [
            'class' => 'registContents_form_item-required',
            'text' => __('性別')
          ]
        ]);
      ?>

      <?php
        // 生年月日. テンプレートを一時的に修正
        $this->Form->templates([
          'dateWidget' => '<ul class="list-inline"><li class="year">{{year}}</li><li class="month">{{month}}</li><li class="day">{{day}}</li></ul>'
        ]);
      ?>
      <?=
        $this->Form->input('user_profile.birthday', [
          'type' => 'datetime',
          'label' => __('生年月日'),
          'dateFormat' => 'YMD',
          'monthNames' => false,
          'separator' => '/',
          'minYear' => 1950,
          'maxYear' => date('Y')-1,
          'default' => date('Y-m-d')
        ]);
      ?>

      <div class="form-group">
        <?= $this->Form->label('prefecture_id', __('生まれ故郷'), ['class' => 'registContents_form_item-required']); ?>
        <div class="cell-table">
          <div class="item">
            <?= $this->Form->select('user_hometown.prefectures_id', $prefectures, ['empty' => '', 'id' => 'prefectures']); ?>
          </div>
          <div class="item">
            <?= $this->Form->select('user_hometown.city_id', [], ['empty' => '', 'id' => 'cities']); ?>
          </div>
        </div>
      </div>

      <div class="form-group">
        <?= $this->Form->label('hobby', __('趣味'), ['class' => 'registContents_form_item-required']); ?>
        <?php
          $hobbyCount = 3;
          for ($index = 0; $index < $hobbyCount; $index++) {
            echo $this->Form->input("hobby.{$index}.content", ['label' => false]);
          }
        ?>
      </div>

      <?=
        $this->Form->input('user_hometown.memories', [
          'label' => [
            'class' => 'registContents_form_item-required',
            'text' => __('故郷の思い出')
          ],
          'type' => 'textarea'
        ]);
      ?>

      <div class="center col-md-10">
        <?= $this->Form->button(__('登録する'), ['class' => 'btn btn-lg btn-primary']) ?>
      </div>

    <?= $this->Form->end() ?>

  </section>
</article>

<script type="text/javascript">
  $(function() {
    // 都道府県の切り替えで、市町村を取得します.
    $('#prefectures').on('change', function() {
      $.get('/api/address/cities', {'prefectureId' : $(this).val()}, function(cities) {
        var options = '';
        options += '<option value=""></option>';
        $.each(JSON.parse(cities), function(index, city) {
          options += '<option value="' + city.value + '">' + city.label + '</option>';
        });
        $('#cities').html(options);
      });
    });
    $('#prefectures').trigger('change');
  });
</script>
