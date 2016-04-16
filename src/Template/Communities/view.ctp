<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12">
            <?= $this->Charisma->contentTitle(__('コミュニティ情報'), '#5bc0de', 'icon_title_event.svg'); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <?= $this->Flash->render(); ?>
            <div class="col-xs-12">
                <div class="col-xs-5 col-md-4">
                    <?php
                        $hasImage = isset($community['community_images']) && !empty($community['community_images']);
                        $imageUrl = '/images/no_image.png';
                        if ($hasImage) {
                            $image = array_shift($community['community_images']);
                            $imageUrl = '/images/community/'.$image['hash'];
                        }
                    ?>
                    <?= $this->Html->image($imageUrl, ['style' => 'max-width: 180px; height: auto;']); ?>
                </div>
                <div class="col-md-8 col-md-offset-0 col-xs-6 col-xs-offset-1">
                    <h3>
                        <?= $community->getFullName(); ?>
                    </h3>
                    <p>
                        <?= sprintf(__('参加メンバー: %d'), count($users)); ?>
                    </p>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-md-8 center">
                        <?php if ($belongsTo): ?>
                            <button id="btn-unjoin" class="btn btn-lg btn-warning">
                                <?= __('コミュニティを退会する'); ?>
                            </button>
                        <?php else: ?>
                            <button id="btn-join" class="btn btn-lg btn-success">
                                <?= __('コミュニティに参加する'); ?>
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php // 確認モーダル ?>
<div class="modal fade" id="join-confirm-dialog" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h3><?= __('コミュニティ参加確認'); ?></h3>
            </div>
            <div class="modal-body">
                <?= $community->getFullName(); ?>
                <?= __('に参加しますか？'); ?>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal">
                    <?= __('キャンセル'); ?>
                </button>
                <a href="/communities/join/<?= $community['id']; ?>" class="btn btn-success">
                    <?= __('参加する'); ?>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="unjoin-confirm-dialog" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h3><?= __('コミュニティ退会確認'); ?></h3>
            </div>
            <div class="modal-body">
                <?= $community->getFullName(); ?>
                <?= __('を本当に退会しますか？'); ?>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal">
                    <?= __('キャンセル'); ?>
                </button>
                <a href="/communities/unjoin/<?= $community['id']; ?>" class="btn btn-warning">
                    <?= __('退会する'); ?>
                </a>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(function() {
        $('#btn-unjoin').on('click', function(e) {
            e.preventDefault();
            $('#unjoin-confirm-dialog').modal('show');
        });
        $('#btn-join').on('click', function(e) {
            e.preventDefault();
            $('#join-confirm-dialog').modal('show');
        });
    });
</script>