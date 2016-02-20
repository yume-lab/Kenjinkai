<style>
    #review-community section {
        margin: 0 auto;
        padding: 1em;
        max-width: 600px;
    }

    #review-community .form-group .inner {
        padding-left: 1em;
    }
</style>

<?php
debug($community);
?>
<div id="review-community">
    <?= $this->Charisma->contentTitle(__('コミュニティ初期設定'), '#6BAD45', 'icon_title_event.svg'); ?>

    <section>
        <?= $this->Flash->render(); ?>
        <?= $this->Form->create($community, ['type' => 'file']) ?>
            <div class="form-group">
                <?= $this->Form->label('full_name', __('正式名称')); ?>
                <div class="inner">
                    <?= $community->getFullName(); ?>
                </div>
            </div>

            <!--
            <div class="form-group">
                <?= $this->Form->label('community_images', __('イメージ')); ?>
                <div class="inner">
                    <?= $this->Form->input('community_images.avatar', ['type' => 'file']); ?>
                </div>
            </div>
            -->

            <div class="form-group">
                <?= $this->Form->label('community_settings[0].gender', __('性別制限')); ?>
                <div class="inner">
                    <?=
                        $this->Form->select(
                            'community_settings[0].gender',
                            $genders,
                            ['empty' => true, 'style' => 'width: 5em; display: inline;']
                        ).__(' 限定');
                    ?>
                </div>
            </div>

            <div class="form-group">
                <?= $this->Form->label('community_settings[0].generation', __('年齢制限')); ?>
                <div class="inner">
                    <?=
                        $this->Form->select(
                            'community_settings[0].generation',
                            $generations,
                            ['empty' => true, 'style' => 'width: 5em; display: inline;']
                        ).__(' 代限定');
                    ?>
                </div>
            </div>

            <?= $this->Form->hidden('id'); ?>
            <?= $this->Form->hidden('community_status_id', ['value' => $publishStatusId]); ?>
            <?= $this->Form->hidden('community_settings[0].is_deleted', ['value' => 0]); ?>

            <div class="center col-md-10">
                <?= $this->Form->button(__('公開する'), ['class' => 'btn btn-lg btn-warning']) ?>
            </div>
        <?= $this->Form->end() ?>
    </section>
</div>
