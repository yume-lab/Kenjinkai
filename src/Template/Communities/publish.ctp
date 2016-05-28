<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <?= $this->Charisma->contentTitle(__('コミュニティ公開設定'), '#6BAD45', 'icon_title_event.svg'); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-xs-12 center align-left">
            <?= $this->Form->create($community) ?>
                <div class="form-group">
                    <?= $this->Form->label('full_name', __('正式名称')); ?>
                    <br/>
                    <?= $community->getFullName(); ?>
                </div>

                <div class="form-group" style="min-height: 200px;">
                    <?= $this->Form->label('community_images', __('コミュニティ画像')); ?>
                    <?php
                        $hasImage = isset($community['community_images']) && !empty($community['community_images']);
                        $imageUrl = '/images/no_image.png';
                        if ($hasImage) {
                            $image = array_shift($community['community_images']);
                            $imageUrl = '/images/community/'.$image['hash'];
                        }
                    ?>
                    <?= $this->Html->image($imageUrl, ['id' => 'preview', 'style' => 'width: auto; max-height: 190px;']); ?>
                </div>

                <div class="col-md-8">
                    <?= __('※下記のボタンを押すとコミュニティが公開されます。'); ?>
                </div>

                <div class="col-md-8" style="text-align: center;">
                    <?= $this->Form->button(__('公開する'), ['class' => 'btn btn-lg btn-primary']) ?>
                </div>
            <?= $this->Form->end() ?>
        </div>
    </div>

</div>