<div class="form-group">
    <?= $this->Form->label('nickname', __('申請者')); ?>
    <div class="inner">
        <?= $data['nickname'] ?>
    </div>
</div>

<div class="form-group">
    <?= $this->Form->label('created', __('申請日')); ?>
    <div class="inner">
        <?= date('Y年m月d日', strtotime($data['created'])); ?>
    </div>
</div>

<div class="form-group">
    <?= $this->Form->label('ken_name', __('お住まいの地域')); ?>
    <div class="inner">
        <?= $data['ken_name'] ?>&nbsp;&nbsp;<?= $data['city_name'] ?>
    </div>
</div>

<div class="form-group">
    <?= $this->Form->label('ken_name', __('生まれ故郷')); ?>
    <div class="inner">
        <?= $data['hometown_ken_name'] ?>&nbsp;&nbsp;<?= $data['hometown_city_name'] ?>
    </div>
</div>

<div class="form-group">
    <?= $this->Form->label('name', __('コミュニティ名')); ?>
    <div class="inner">
        <?= $data['name'] ?>
    </div>
</div>

<div class="form-group">
    <?= $this->Form->label('message', __('コミュニティ作成の想い')); ?>
    <div class="inner">
        <?= $data['message'] ?>
    </div>
</div>

