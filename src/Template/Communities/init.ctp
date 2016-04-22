<style>
    #init-community section {
        margin: 0 auto;
        padding: 1em;
        max-width: 500px;
    }

    #init-community .form-group .inner {
        padding-left: 1em;
    }

    #init-community img {
        max-width: 250px;
        width: 100%;
    }
</style>

<div id="init-community">
    <?= $this->Charisma->contentTitle(__('コミュニティ初期設定'), '#6BAD45', 'icon_title_event.svg'); ?>

    <section>
        <?= $this->Form->create($community) ?>
            <div class="form-group">
                <?= $this->Form->label('full_name', __('正式名称')); ?>
                <div class="inner">
                    <?= $community->getFullName(); ?>
                </div>
            </div>

            <div class="form-group">
                <?= $this->Form->label('community_images', __('コミュニティ画像')); ?>
                <div class="inner">
                    <?php
                        $hasImage = isset($community['community_images']) && !empty($community['community_images']);
                        $imageUrl = '/images/no_image.png';
                        if ($hasImage) {
                            $image = array_shift($community['community_images']);
                            $imageUrl = '/images/community/'.$image['hash'];
                        }
                    ?>
                    <?= $this->Html->image($imageUrl); ?>
                </div>
            </div>

            <div class="form-group">
                <?= $this->Form->label('community_settings.gender', __('性別制限')); ?>
                <div class="inner">
                    <?=
                        $this->Form->select(
                            'community_settings.gender',
                            $genders,
                            ['empty' => true, 'style' => 'width: 5em; display: inline;']
                        ).__(' 限定');
                    ?>
                </div>
            </div>

            <div class="form-group">
                <?= $this->Form->label('community_settings.generation', __('年齢制限')); ?>
                <div class="inner">
                    <?=
                        $this->Form->select(
                            'community_settings.generation',
                            $generations,
                            ['empty' => true, 'style' => 'width: 5em; display: inline;']
                        ).__(' 代限定');
                    ?>
                </div>
            </div>

            <?= $this->Form->hidden('id'); ?>
            <?= $this->Form->hidden('user_id', ['value' => $community['review_communities'][0]['user_id']]); ?>
            <?= $this->Form->hidden('community_status_id', ['value' => $publishStatusId]); ?>

            <div class="center col-md-10">
                <?= $this->Form->button(__('公開する'), ['class' => 'btn btn-lg btn-warning']) ?>
            </div>
        <?= $this->Form->end() ?>
    </section>
</div>
