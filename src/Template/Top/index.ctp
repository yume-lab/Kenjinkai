<div id="informations">
    <?= $this->Charisma->contentTitle(__('県人会からのお知らせ'), '#F39700', 'icon_title_info.svg', '/'); ?>
    <ul class="information-list">
        <?php foreach ($informations as $info): ?>
            <li>
                <?php // TODO: 押したら既読処理＆詳細表示 ?>
                <?php // TODO: 重要なお知らせ ?>
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

<div id="news">
    <?= $this->Charisma->contentTitle(__('新着情報'), '#0079C2', 'icon_title_whatsnew.svg', '/'); ?>
    <ul class="information-list">
        <?php foreach ($news as $info): ?>
            <li>
                <div><?= date('Y/m/d', strtotime($info['date'])); ?></div>
                <div>
                    <a href="" class="info-detail" data-id=""><?= h($info['title']); ?></a>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<script type="text/javascript">
    $(function() {
        $('.info-detail').on('click', function(e) {
            e.preventDefault();
            var $this = $(this);
            var id = $this.data('id');
            // TODO: 既読API
            $this.siblings('.info-content').slideToggle('slow');
        });

        $('#send-comment').on('click', function(e) {
            e.preventDefault();
            var $form = $('#review-form');
            $.post($form.attr('action'), $form.serialize(), function() {
                $('#notice').trigger('click');
                location.reload();
            });
            return false;
        });
    });

</script>
