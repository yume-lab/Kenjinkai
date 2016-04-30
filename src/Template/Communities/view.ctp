<style>
    #community-image {
        max-width: 160px;
        max-height: 160px;
        height: auto;
        margin: 0.5em 0;
    }
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12">
            <?=
                $this->Charisma->contentTitle(
                    __('コミュニティ情報'),
                    '#5bc0de',
                    'icon_title_event.svg'
                );
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-md-12">
            <div class="col-xs-12 col-md-12">
                <?php if ($isLeader): ?>
                    <a href="<?= $this->Url->build(['controller' => 'Communities','action' => 'edit',$community['id']]);?>"
                       class="btn btn-primary">
                        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> <?= __('設定'); ?>
                    </a>
                <?php endif; ?>
                <div class="col-xs-5 col-md-4">
                    <?php
                        $hasImage = isset($community['community_images']) && !empty($community['community_images']);
                        $imageUrl = '/images/no_image.png';
                        if ($hasImage) {
                            $image = array_shift($community['community_images']);
                            $imageUrl = '/images/community/'.$image['hash'];
                        }
                    ?>
                    <?= $this->Html->image($imageUrl, ['id' => 'community-image']); ?>
                </div>
                <div class="col-md-8 col-md-offset-0 col-xs-6 col-xs-offset-1">
                    <h3>
                        <?= $community->getFullName(); ?>
                    </h3>
                    <p>
                        <?= sprintf(__('参加メンバー: %d'), count($members)); ?>
                    </p>
                </div>
                <div class="col-xs-12 col-md-12" style="text-align: right;">
                    <?php if ($belongsTo): ?>
                        <?php if ($isLeader): ?>
                            <span class="label label-danger"><?= __('リーダーは退会できません'); ?></span>
                        <?php endif; ?>
                        <button id="btn-unjoin" class="btn btn-lg btn-warning"
                            <?= ($isLeader) ? 'disabled="disabled"' : '' ?>>
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
    <div style="clear: both;"></div>

    <?php if ($belongsTo): ?>
        <div class="row">
            <div class="col-xs-12">
                <?=
                    $this->Charisma->contentTitle(
                        __('新着スレッド'),
                        '#793862',
                        'icon_title_event.svg',
                        ['glyphs' => [
                            'icon' => 'glyphicon-plus',
                            'href' => $this->Url->build([
                                'controller' => 'CommunityThreads',
                                'action' => 'add',
                                $community['id']
                            ])
                        ]]
                    );
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-md-12">
                <table class="table">
                    <tbody>
                        <?php foreach ($threads as $thread): ?>
                            <tr>
                                <td>
                                    <span class="label label-primary">
                                        <?= $threadCategories[$thread['thread_category_id']]; ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="<?= $this->Url->build(['controller' => 'CommunityThreads','action' => 'messages', $thread->id])?>">
                                        <?= h($thread['name']); ?>
                                    </a>
                                </td>
                                <td><?= date('Y/m/d', strtotime($thread['modified'])); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-xs-12">
            <?= $this->Charisma->contentTitle(__('参加メンバー'), '#6BAD45', 'icon_title_profile.svg'); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-md-12">
            <?php foreach ($members as $member): ?>
                <div class="col-xs-6 col-md-3">
                    <?php
                        $image = $member->user->user_images;
                        $hasImage = !empty($image);
                        $imageUrl = '/images/no_image.png';
                        if ($hasImage) {
                            $image = array_shift($image);
                            $imageUrl = '/images/profile/'.$image['hash'];
                        }
                    ?>
                    <div class="thumbnail">
                        <?= $this->Html->image($imageUrl); ?>
                        <div class="caption">
                            <p><?= $member->user->user_profiles[0]->nickname; ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
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