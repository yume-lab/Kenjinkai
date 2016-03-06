<div class="center" style="padding: 0.5em;">
  <?= $this->Html->image('samplebanner.jpg'); ?>
</div>

<div class="center" style="padding: 0.5em;">
  <?= $this->Charisma->contentTitle(__('新着コミュニティ'), '#6BAD45', 'icon_title_event.svg'); ?>

  <ul id="latest-community">
      <?php foreach ($latestCommunities as $community): ?>
          <?php $image = $community->community_images[0]; ?>
          <li style="background: url(<?= '/images/community/'.$image['hash'] ?>) no-repeat center; background-size: contain;">
              <a href="/communities/view/<?= $community->id ?>">
                  <p>
                      <?= sprintf(__('更新日：%s'), date('Y/m/d', strtotime($community->modified))); ?>
                  </p>
                  <p style="border-bottom: 1px solid #fff;">
                      <?= $community->getFullName() ; ?>
                  </p>

                  <?php
                    // TODO: 盛り上がってきたら人数とか
                  ?>
              </a>
          </li>
      <?php endforeach; ?>
  </ul>
</div>