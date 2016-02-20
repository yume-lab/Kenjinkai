<div id="informations">
    <?= $this->Charisma->contentTitle(__('県人会からのお知らせ'), '#F39700', 'icon_title_info.svg', '/'); ?>
    <ul class="information-list">
        <?php foreach ($informations as $info): ?>
            <li>
                <p style="width: 8em;"><?= date('Y/m/d', strtotime($info['created'])); ?></p>
                <?php // TODO: 押したら既読処理＆詳細表示 ?>
                <?php // TODO: 重要なお知らせ ?>
                <p><a href=""><?= h($info['title']); ?></a></p>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<div id="news">
    <?= $this->Charisma->contentTitle(__('新着情報'), '#0079C2', 'icon_title_whatsnew.svg', '/'); ?>
    <ul class="information-list">
        <?php foreach ($news as $info): ?>
            <li>
                <p style="width: 8em;"><?= date('Y/m/d', strtotime($info['date'])); ?></p>
                <p><a href=""><?= h($info['title']); ?></a></p>
            </li>
        <?php endforeach; ?>
    </ul>
</div>


