<div class="container">
    <div class="row">
        <div class="col-md-5 center login-box" style="margin-top: 2em;">
            <?= $this->Flash->render() ?>
            <?=
              $this->Form->create(null, [
                'class' => 'form-horizontal',
                'url' => ['controller' => 'Users', 'action' => 'forgot'],
                'style' => 'padding: 0 2em; text-align: left;'
              ]);
            ?>
            <div class="form-group">
                <div class="col-md-12">
                    <?= $this->Form->input('email', ['label' => __('メールアドレス'), 'required']); ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <?= $this->Form->input('nickname', ['label' => __('ニックネーム'), 'required']); ?>
                </div>
            </div>


            <?php
              // 生年月日. テンプレートを一時的に修正
              $this->Form->templates([
                'dateWidget' => '<ul class="list-inline"><li class="year">{{year}}</li><li class="month">{{month}}</li><li class="day">{{day}}</li></ul>'
              ]);
            ?>
            <div class="form-group col-md-12">
              <?=
                $this->Form->input('birthday', [
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

            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">再発行</button>
            </div>
            <?= $this->Form->end(); ?>
        </div>
    </div>
</div>

