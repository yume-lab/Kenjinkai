<div id="informations">
    <?=
        $this->Charisma->contentTitle(
            __('県人会からのお知らせ'),
            '#F39700',
            'icon_title_info.svg',
        '/informations');
    ?>
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

<div id="communities">
    <?= $this->Charisma->contentTitle(__('新着コミュニティ'), '#0079C2', 'icon_title_whatsnew.svg', '/'); ?>
    <ul class="top-community">
      <?php foreach ($latestCommunities as $community): ?>
          <?php $image = $community->CommunityImages; ?>
          <li>
              <a href="/communities/view/<?= $community->id ?>">
                  <?= $this->Html->image('/images/community/'.$image['hash']); ?>
                  <p><?= $community->getFullName() ; ?></p>
              </a>
          </li>
      <?php endforeach; ?>
  </ul>
</div>
<div style="clear: both;"></div>

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
