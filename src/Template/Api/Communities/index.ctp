<div class="form-group">
    <?= $this->Form->label('nickname', __('申請者')); ?>
    <div class="inner">
        <?= $sender['nickname'] ?>
    </div>
</div>

<div class="form-group">
    <?= $this->Form->label('created', __('申請日')); ?>
    <div class="inner">
        <?= date('Y年m月d日', strtotime($data['created'])); ?>
    </div>
</div>

<div class="form-group">
    <?= $this->Form->label('message', __('コミュニティ作成の想い')); ?>
    <div class="inner">
        <?= $data['message'] ?>
    </div>
</div>

