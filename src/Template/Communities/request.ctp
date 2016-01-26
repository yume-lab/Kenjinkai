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
<div id="review-community">
    <?= $this->Charisma->contentTitle(__('コミュニティ申請'), '#6BAD45', 'icon_title_event.svg'); ?>
    <section>
        <?= $this->Form->create($community) ?>
            <div class="form-group">
                <?= $this->Form->label('prefecture', __('現在のお住まい')); ?>
                <div class="inner">
                    <?= $city['ken_name'] ?>&nbsp;&nbsp;<?= $city['city_name'] ?>
                </div>
            </div>

            <div class="form-group">
                <?= $this->Form->label('hometown', __('生まれ故郷')); ?>
                <div class="inner">
                    <?= $hometown['ken_name'] ?>&nbsp;&nbsp;<?= $hometown['city_name'] ?>
                </div>
            </div>

            <div class="form-group">
                <?= $this->Form->label('name', __('コミュニティ名')); ?>
                <div class="inner">
                    <?= $this->Form->input('name', ['label' => false, 'placeholder' => '◯◯飲み会！']); ?>
                </div>
            </div>

            <div class="form-group">
                <?= $this->Form->label('review_community.message', __('コミュニティ作成の想い')); ?>
                <div class="inner">
                    <?= $this->Form->textarea('review_community.message', ['label' => false]); ?>
                </div>
            </div>

            <div class="center col-md-10">
                <?= $this->Form->button(__('申請する'), ['class' => 'btn btn-lg btn-warning']) ?>
            </div>

        <?= $this->Form->end() ?>
    </section>
</div>
