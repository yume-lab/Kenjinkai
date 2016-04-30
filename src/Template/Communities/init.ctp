<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <?= $this->Charisma->contentTitle(__('コミュニティ初期設定'), '#6BAD45', 'icon_title_event.svg'); ?>
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

                <div class="form-group" style="height: 250px;">
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

                <div class="form-group col-md-8">
                    <div class="form-group">
                        <?= $this->Form->label('community_settings.gender', __('性別制限')); ?>
                        <?=
                            $this->Form->select(
                                'community_settings.gender',
                                $genders,
                                ['empty' => true, 'style' => 'width: 10em; display: inline;']
                            ).__(' 限定');
                        ?>
                    </div>
                    <div class="form-group">
                        <?= $this->Form->label('community_settings.generation', __('年齢制限')); ?>
                        <?=
                            $this->Form->select(
                                'community_settings.generation',
                                $generations,
                                ['empty' => true, 'style' => 'width: 10em; display: inline;']
                            ).__(' 代限定');
                        ?>
                    </div>
                </div>

                <?= $this->Form->hidden('id'); ?>
                <?= $this->Form->hidden('user_id', ['value' => $community['review_communities'][0]['user_id']]); ?>
                <?= $this->Form->hidden('community_status_id', ['value' => $publishStatusId]); ?>

                <div class="col-md-8" style="text-align: center;">
                    <?= $this->Form->button(__('公開する'), ['class' => 'btn btn-lg btn-primary']) ?>
                </div>
            <?= $this->Form->end() ?>
        </div>
    </div>

</div>