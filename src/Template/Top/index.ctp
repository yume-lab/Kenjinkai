<div class="container-fluid">
    <div class="row">
        <?=
            $this->Charisma->contentTitle(
                __('県人会からのお知らせ'),
                '#F39700',
                'icon_title_info.svg',
                ['list' => '/informations']
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

    <div class="row">
        <?=
            $this->Charisma->contentTitle(
                __('新着コミュニティ'),
                '#0079C2',
                'icon_title_whatsnew.svg',
                ['list' => '/']
            );
        ?>

        <div class="col-xs-12">
            <?php foreach ($newCommunities as $community): ?>
                <div class="col-xs-6 col-md-3">
                    <?php
                        $hash = $community->CommunityImages['hash'];
                        $hasImage = !empty($hash);
                        $imageUrl = '/images/no_image.png';
                        if ($hasImage) {
                            $imageUrl = '/images/community/'.$hash;
                        }
                    ?>
                    <a href="/communities/view/<?= $community->id ?>" class="thumbnail">
                        <?= $this->Html->image($imageUrl); ?>
                        <div class="caption">
                            <p><?= $community->getFullName() ; ?></p>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

