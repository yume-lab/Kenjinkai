<div class="container-fluid">
    <div class="row">
        <?=
            $this->Charisma->contentTitle(
                __('県人会からのお知らせ'),
                '#F39700',
                'icon_title_info.svg'
            );
        ?>
        <div class="col-xs-12">
            <ul class="information-list">
                <?php foreach ($informations as $info): ?>
                    <li class="<?= empty($info['read_date']) ? 'unread' : ''; ?>">
                        <div><?= date('Y/m/d', strtotime($info['created'])); ?></div>
                        <?= empty($info['is_important']) ? '' : '<span class="label label-danger">重要</span>'; ?>
                        <div class="info-detail" data-id="<?= h($info['id']); ?>" style="max-width: 30em;">
                            <a href=""><?= h($info['title']); ?></a>
                        </div>
                        <div style="display: none;" class="info-content">
                            <?= $info['content']; ?>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>
