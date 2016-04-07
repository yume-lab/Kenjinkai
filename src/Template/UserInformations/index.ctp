<div id="informations">
    <?=
        $this->Charisma->contentTitle(
            __('県人会からのお知らせ'),
            '#F39700',
            'icon_title_info.svg'
        );
    ?>
    <ul class="information-list">
        <?php foreach ($informations as $info): ?>
            <li class="<?= empty($info['is_unread']) ? 'unread' : ''; ?>">
                <div><?= date('Y/m/d', strtotime($info['created'])); ?></div>
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

<script type="text/javascript">
    $(function() {
        $('.info-detail').on('click', function(e) {
            e.preventDefault();
            $(this).siblings('.info-content').slideToggle('slow');
        });
    });

</script>
