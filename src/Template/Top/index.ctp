
<div id="informations">
    <?= $this->Charisma->contentTitle(__('県人会からのお知らせ'), '#F39700', '/', 'icon_title_info.svg'); ?>
    <ul style="list-style: none;">
        <?php foreach ($informations as $info): ?>
            <li style="width: 100%; margin-top: 20px; padding-bottom: 20px; border-bottom: 1px solid #D1D5E5; display: table;">
                <p style="width: 12em; display: table-cell;">
                    <?= date('Y年m月d日', strtotime($info['date'])); ?>
                </p>
                <p style="display: table-cell;">
                    <a href=""><?= h($info['title']); ?></a>
                </p>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<div id="news">
    <?= $this->Charisma->contentTitle(__('新着情報'), '#0079C2', '/', 'icon_title_whatsnew.svg'); ?>
    <ul style="list-style: none;">
        <?php foreach ($informations as $info): ?>
            <li style="width: 100%; margin-top: 20px; padding-bottom: 20px; border-bottom: 1px solid #D1D5E5; display: table;">
                <p style="width: 12em; display: table-cell;">
                    <?= date('Y年m月d日', strtotime($info['date'])); ?>
                </p>
                <p style="display: table-cell;">
                    <a href=""><?= h($info['title']); ?></a>
                </p>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<div>
<?= debug($user) ?>
</div>

