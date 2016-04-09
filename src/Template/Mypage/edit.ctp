<article class="c-article">
  <section class="c-contents">
    <?= $this->Charisma->contentTitle(__('プロフィール編集'), '#6BAD45', 'icon_title_profile.svg'); ?>

    <?= $this->Flash->render(); ?>
    <?= $this->Form->create($user, ['type' => 'file']) ?>
      <div class="form-group">
        <?= $this->Form->label('email', __('ご登録メールアドレス')); ?>
        <div>
          <?php // TODO: メールアドレス変更できるように ?>
          <?= h($user->email); ?>
          <?= $this->Form->hidden('email'); ?>
        </div>
      </div>

      <div class="form-group">
          <?= $this->Form->label('user_images', __('プロフィール画像 (.jpg, .png, .gif)')); ?>
          <div class="inner">
              <?=
                  $this->Form->input('user_images', [
                      'id' => 'thumbnail',
                      'type' => 'file',
                      'label' => false
                  ]);
              ?>
          </div>
          <?php
              $hasImage = isset($user['user_images']) && !empty($user['user_images']);
              $imageUrl = '/images/no_image.png';
              if ($hasImage) {
                  $image = array_shift($user['user_images']);
                  $imageUrl = '/images/profile/'.$image['hash'];
              }
          ?>
          <?= $this->Html->image($imageUrl, ['id' => 'preview', 'style' => 'max-width: 250px; height: auto;']); ?>
      </div>

      <div class="form-group">
        <div class="cell-table">
          <div class="item">
              <?= $this->Form->input('user_profiles.0.name', ['label' => __('本名')]); ?>
          </div>
          <div class="item">
              <?= $this->Form->input('user_profiles.0.nickname', ['label' => __('ニックネーム')]); ?>
          </div>
        </div>
      </div>

      <div class="form-group">
        <?= $this->Form->label('prefecture_id', __('居住地')); ?>
        <div class="cell-table">
          <div class="item">
            <?= $this->Form->select('user_profiles.0.ken_id', $prefectures, ['empty' => '', 'id' => 'prefectures']); ?>
          </div>
          <div class="item">
            <?= $this->Form->select('user_profiles.0.city_id', [], ['empty' => '', 'id' => 'cities']); ?>
            <?= $this->Form->hidden('cityId', ['id' => 'selected-city', 'value' => $user->user_profiles[0]->city_id]); ?>
          </div>
        </div>
      </div>

      <div class="center col-md-10">
        <?= $this->Form->button(__('更新する'), ['class' => 'btn btn-lg btn-primary']) ?>
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

        // 初回のみ設定
        if (('#selected-city')) {
          var selectedCity = $('#selected-city').val();
          $('#cities').val(selectedCity);
          $('#selected-city').remove();
        }
      });
    });

    $('#thumbnail').on('change', function() {
      var file = $(this).prop('files')[0];
      var type = file.type;
      if (type.indexOf('image/') < 0) {
          // 画像ではないためエラー
          $(this).val('');
          $('#preview').attr('src', '/images/no_image.png');
          return $('#image-error-dialog').modal('show');
      }

      var fr = new FileReader();
      fr.onload = function() {
          $('#preview').attr('src', fr.result).css('display','inline');
      }
      fr.readAsDataURL(file);
    });

    $('#prefectures').trigger('change');
  });
</script>
