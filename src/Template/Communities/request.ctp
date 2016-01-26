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

    #review-community .form-group .inner {
        display: table-cell;
        padding-left: 2em;
    }

    .pagination {
        margin: 0;
    }
</style>
<div id="review-community">
    <?php if (!empty($reviews)): ?>
        <?= $this->Charisma->contentTitle(__('審査中コミュニティ'), '#666', 'icon_title_event.svg'); ?>
        <section>
            <ul class="information-list">
                <?php foreach ($reviews as $review): ?>
                    <li>
                        <p><?= date('Y年m月d日', strtotime($review['created'])); ?></p>
                        <p><?= $review['name'] ?></p>
                        <p>
                            <a href="#" class="review-detail" data-id="<?=$review['id']; ?>">
                                <?= __('詳細'); ?>
                            </a>
                        </p>
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

<?php // 審査中コミュニティの詳細ダイアログ ?>
<div class="modal fade" id="review-detail" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h3><?= __('申請中コミュニティ'); ?></h3>
            </div>
            <div id="review-detail-content" class="modal-body">
                <?php // Ajaxで取得する. ?>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-default" data-dismiss="modal">OK</a>
                <?php // TODO: 取り消しもできるように ?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function() {
        $('.review-detail').on('click', function(e) {
            e.preventDefault();
            console.log($(this).data('id'));
            $.get('/api/communities', {'id': $(this).data('id')}, function(data) {
                console.log(data);
                $('#review-detail-content').html(data);
                $('#review-detail').modal('show');
            });
        });
    });

</script>
