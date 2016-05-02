<div class="container-fluid">
    <div class="row">
      <div class="col-md-12 col-xs-12">
        <?= $this->Charisma->contentTitle(__('アカウント設定'), '#6BAD45', 'icon_title_profile.svg'); ?>
      </div>
    </div>

    <div class="row">
      <div class="col-md-10 col-xs-12 center align-left">
        <?= $this->Form->error; ?>
        <?= $this->Form->create($user) ?>
          <div class="form-group">
            <?= $this->Form->label('email', __('ご登録メールアドレス')); ?>
            <div>
              <?php // TODO: メールアドレス変更できるように ?>
              <?= h($user->email); ?>
              <?= $this->Form->hidden('email'); ?>
            </div>
          </div>

          <div class="form-group col-md-10">
            <div class="col-md-5">
                <?= $this->Form->input('password', ['label' => __('パスワード'), 'value' => '']); ?>
            </div>
            <div class="col-md-5">
                <?= $this->Form->input('confirm_password', ['type' => 'password', 'label' => __('パスワード確認')]); ?>
            </div>
          </div>

          <div class="col-md-10" style="text-align: center;">
            <br/>
            <?= $this->Form->button(__('更新する'), ['class' => 'btn btn-lg btn-primary']) ?>
          </div>

        <?= $this->Form->end() ?>
      </div>
  </div>
</div>

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
