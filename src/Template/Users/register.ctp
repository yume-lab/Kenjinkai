<div class="container" style="margin-top: 2em;">
    <div class="row">
      <div class="col-md-8 col-xs-12 center" style="text-align: left;">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?= __('登録内容の入力'); ?>
            </div>
            <div class="panel-body">
                <div class="alert alert-warning">
                    <?= __('全て必須入力です。') ?>
                </div>

                <?= $this->Form->create($user, ['class' => 'registContents_form']) ?>
                  <div class="row">
                    <div class="form-group col-md-8">
                      <?= $this->Form->label('email', __('ご登録メールアドレス'), ['class' => 'registContents_form_item-required']); ?>
                      <div>
                        <?= h($user->email); ?>
                        <?= $this->Form->hidden('email'); ?>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-md-5">
                      <?=
                        $this->Form->input('password', ['label' => [
                          'text' => __('パスワード')
                        ]]);
                      ?>
                    </div>

                    <div class="form-group col-md-5">
                      <?=
                        $this->Form->input('confirm_password', [
                          'label' => [
                            'text' => __('パスワード')
                          ],
                          'type' => 'password'
                        ]);
                      ?>
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-md-5">
                        <?= $this->Form->input('user_profile.name', ['label' => __('本名')]); ?>
                    </div>
                    <div class="form-group col-md-5">
                        <?= $this->Form->input('user_profile.nickname', ['label' => __('ニックネーム')]); ?>
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-md-5">
                      <?=
                        $this->Form->input('user_profile.gender', [
                          'type'=>'radio',
                          'options' =>  $genders,
                          'label' => [
                            'class' => 'registContents_form_item-required',
                            'text' => __('性別')
                          ]
                        ]);
                      ?>
                    </div>
                  </div>

                  <?php
                    // 生年月日. テンプレートを一時的に修正
                    $this->Form->templates([
                      'dateWidget' => '<ul class="list-inline"><li class="year">{{year}}</li><li class="month">{{month}}</li><li class="day">{{day}}</li></ul>'
                    ]);
                  ?>
                  <div class="row">
                    <div class="form-group col-md-8">
                      <?=
                        $this->Form->input('user_profile.birthday', [
                          'type' => 'datetime',
                          'label' => __('生年月日'),
                          'dateFormat' => 'YMD',
                          'monthNames' => false,
                          'separator' => '/',
                          'minYear' => 1930,
                          'maxYear' => date('Y')-1,
                          'default' => date('Y-m-d')
                        ]);
                      ?>
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-md-12">
                      <?= $this->Form->label('prefecture_id', __('現在のお住まい')); ?>
                    </div>
                    <div class="form-group col-md-4 prefectures">
                        <?= $this->Form->select('user_profile.ken_id', $prefectures, ['empty' => '']); ?>
                    </div>
                    <div class="form-group col-md-4 cities">
                        <?= $this->Form->select('user_profile.city_id', [], ['empty' => '']); ?>
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-md-12">
                      <?= $this->Form->label('prefecture_id', __('生まれ故郷')); ?>
                    </div>
                    <div class="form-group col-md-4 prefectures">
                        <?= $this->Form->select('user_hometown.ken_id', $prefectures, ['empty' => '']); ?>
                    </div>
                    <div class="form-group col-md-4 cities">
                        <?= $this->Form->select('user_hometown.city_id', [], ['empty' => '']); ?>
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-md-12">
                      <?=
                        $this->Form->input('user_hometown.memories', [
                          'label' => [
                            'class' => 'registContents_form_item-required',
                            'text' => __('故郷の思い出')
                          ],
                          'type' => 'textarea'
                        ]);
                      ?>
                    </div>
                  </div>

                  <?php // TODO: 利用規約とか ?>

                  <div class="center col-md-10">
                    <?= $this->Form->button(__('登録する'), ['class' => 'btn btn-lg btn-primary']) ?>
                  </div>

                <?= $this->Form->end() ?>
            </div>
        </div>
      </div>
    </div>
</div>

<script type="text/javascript">
  $(function() {
    // 都道府県の切り替えで、市町村を取得します.
    $('.prefectures select').on('change', function() {
      var $cities = $(this).parents('.prefectures').siblings('.cities').children('select');
      $.get('/api/address/cities', {'prefectureId' : $(this).val()}, function(cities) {
        var options = '';
        $.each(JSON.parse(cities), function(index, city) {
          options += '<option value="' + city.value + '">' + city.label + '</option>';
        });
        $cities.html(options);
      });
    });
    $('.prefectures select').trigger('change');
  });
</script>
