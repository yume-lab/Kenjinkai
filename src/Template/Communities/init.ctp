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
?>
<div id="review-community">
    <?= $this->Charisma->contentTitle(__('コミュニティ初期設定'), '#6BAD45', 'icon_title_event.svg'); ?>

    <section>
        <?= $this->Form->create($community) ?>
            <div class="form-group">
                <?= $this->Form->label('full_name', __('正式名称')); ?>
                <div class="inner">
                    <?= $community->getFullName(); ?>
                </div>
            </div>
        <?= $this->Form->end() ?>
    </section>
</div>
