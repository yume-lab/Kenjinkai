
<div id="informations">
    <?= $this->Charisma->contentTitle(__('県人会からのお知らせ'), '#F39700', 'icon_title_info.svg', '/'); ?>
    <ul class="information-list">
        <?php foreach ($informations as $info): ?>
            <li>
                <p><?= date('Y年m月d日', strtotime($info['date'])); ?></p>
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
                <p><?= date('Y年m月d日', strtotime($info['date'])); ?></p>
                <p><a href=""><?= h($info['title']); ?></a></p>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
