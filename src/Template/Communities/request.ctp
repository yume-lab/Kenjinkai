<style>
    #review-community section {
        margin: 0 auto;
        padding: 1em;
        max-width: 30em;
    }

    #review-community .form-group {
        display: table;
    }

    #review-community .form-group label {
        display: table-cell;
        width: 9em;
        vertical-align: top;
    }

    #review-community .form-group div.inner {
        display: table-cell;
        padding-left: 2em;
    }

    .pagination {
        margin: 0;
    }
</style>
<div id="review-community">
    <?php if (!empty($inReviews)): ?>
        <?= $this->Charisma->contentTitle(__('審査中コミュニティ'), '#666', 'icon_title_event.svg'); ?>
        <section>
            <ul class="information-list">
                <?php foreach ($inReviews as $review): ?>
                    <li>
                        <p><?= date('Y年m月d日', strtotime($review['created'])); ?></p>
                        <p><?= $statuses[$review['community_status_id']]; ?></p>
                        <p><a class="review-detail" data-id="<?= $review['id']; ?>"><?= __('詳細'); ?></a></p>
                    </li>
                <?php endforeach; ?>
            </ul>
            <div class="center-block">
                <div class="dataTables_paginate paging_bootstrap pagination">
                    <ul class="pagination">
                        <?= $this->Paginator->prev('< ' . __('前')) ?>
                        <?= $this->Paginator->numbers() ?>
                        <?= $this->Paginator->next(__('次') . ' >') ?>
                    </ul>
                </div>
            </div>

        </section>
    <?php endif; ?>

    <?= $this->Charisma->contentTitle(__('コミュニティ申請'), '#6BAD45', 'icon_title_event.svg'); ?>
    <section>
        <?= $this->Form->create($community) ?>
            <div class="form-group">
                <?= $this->Form->label('name', __('本名')); ?>
                <div class="inner">
                    <?= h($profile['name']); ?>
                </div>
            </div>

            <div class="form-group">
                <?= $this->Form->label('nickname', __('ニックネーム')); ?>
                <div class="inner">
                    <?= h($profile['nickname']); ?>
                </div>
            </div>

            <div class="form-group">
                <?= $this->Form->label('gender', __('性別')); ?>
                <div class="inner">
                    <?= h($genders[$profile['gender']]); ?>
                </div>
            </div>

            <div class="form-group">
                <?= $this->Form->label('birthday', __('生年月日')); ?>
                <div class="inner">
                    <?= date('Y/m/d', strtotime($profile['birthday'])); ?>
                </div>
            </div>

            <div class="form-group">
                <?= $this->Form->label('prefecture', __('現在のお住まい')); ?>
                <div class="inner">
                    <?= $city['ken_name'] ?>
                    &nbsp;&nbsp;
                    <?= $city['city_name'] ?>
                </div>
            </div>

            <div class="form-group">
                <?= $this->Form->label('hometown', __('生まれ故郷')); ?>
                <div class="inner">
                    <?= $hometown['ken_name'] ?>
                    &nbsp;&nbsp;
                    <?= $hometown['city_name'] ?>
                </div>
            </div>

            <div class="form-group">
                <?= $this->Form->label('hobby', __('趣味')); ?>
                <div class="inner">
                    <?php foreach ($hobbies as $hobby): ?>
                        - <?= $hobby ?>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="form-group">
                <?= $this->Form->label('memories', __('故郷の思い出')); ?>
                <div class="inner">
                    <?= $hometown['memories'] ?>
                </div>
            </div>

            <div class="form-group">
                <?= $this->Form->label('message', __('コミュニティ作成の想い')); ?>
                <div class="inner">
                    <?= $this->Form->input('message', ['label' => false], ['type' => 'textarea']); ?>
                </div>
            </div>

            <div class="center col-md-10">
                <?= $this->Form->button(__('申請する'), ['class' => 'btn btn-lg btn-warning']) ?>
            </div>

        <?= $this->Form->end() ?>
    </section>
</div>

<script type="text/javascript">
    $(function() {
        $('.review-detail').on('click', function(e) {
            e.preventDefault();

        });
    });

</script>