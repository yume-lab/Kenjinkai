<div class="center" style="padding: 0.5em;">
  <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
  <!-- default -->
  <ins class="adsbygoogle"
       style="display:block"
       data-ad-client="ca-pub-4647915311191349"
       data-ad-slot="7717086117"
       data-ad-format="auto"></ins>
  <script>
  (adsbygoogle = window.adsbygoogle || []).push({});
  </script>
</div>

<div class="center" style="padding: 0.5em;">
  <?= $this->Charisma->contentTitle(__('新着コミュニティ'), '#6BAD45', 'icon_title_event.svg'); ?>

  <ul id="latest-community">
      <?php foreach ($latestCommunities as $community): // TODO: Ajaxで定期的に取りに行くとかやりたい ?>
          <?php
              $hash = $community->CommunityImages['hash'];
              $hasImage = !empty($hash);
              $imageUrl = '/images/no_image.png';
              if ($hasImage) {
                  $imageUrl = '/images/community/'.$hash;
              }
          ?>

          <li style="background: url(<?= $imageUrl ?>) no-repeat center; background-size: contain;">
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