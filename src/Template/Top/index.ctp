<div id="informations">
    <?=
        $this->Charisma->contentTitle(
            __('県人会からのお知らせ'),
            '#F39700',
            'icon_title_info.svg',
            ['list' => '/informations']
        );
    ?>
    <ul class="information-list">
        <?php foreach ($informations as $info): ?>
            <li>
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

<div id="communities">
    <?=
        $this->Charisma->contentTitle(
            __('新着コミュニティ'),
            '#0079C2',
            'icon_title_whatsnew.svg',
            ['list' => '/']
        );
    ?>
    <ul class="tile-list">
      <?php foreach ($newCommunities as $community): ?>
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

