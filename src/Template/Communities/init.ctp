<style>
    #review-community section {
        margin: 0 auto;
        padding: 1em;
        max-width: 500px;
    }

    #review-community .form-group .inner {
        padding-left: 1em;
    }
</style>

<?php
//debug($community);
?>
<div id="review-community">
    <?= $this->Charisma->contentTitle(__('コミュニティ初期設定'), '#6BAD45', 'icon_title_event.svg'); ?>

    <section>
        <?= $this->Form->create($community, ['type' => 'file']) ?>
            <div class="form-group">
                <?= $this->Form->label('full_name', __('正式名称')); ?>
                <div class="inner">
                    <?= $community->getFullName(); ?>
                </div>
            </div>

            <div class="form-group">
                <?= $this->Form->label('community_images', __('イメージ')); ?>
                <div class="inner">
                    <?= $this->Form->input('community_images', ['type' => 'file']); ?>
                </div>
            </div>

            <div class="center col-md-10">
                <?= $this->Form->button(__('公開する'), ['class' => 'btn btn-lg btn-warning']) ?>
            </div>
        <?= $this->Form->end() ?>
    </section>
</div>
