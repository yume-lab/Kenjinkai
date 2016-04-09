<article class="c-article">
  <section class="c-contents">
    <?= $this->Charisma->contentTitle(__('コミュニティ情報'), '#5bc0de', 'icon_title_event.svg'); ?>

    <div class="form-group">
          <?php
              $hasImage = isset($community['community_images']) && !empty($community['community_images']);
              $imageUrl = '/images/no_image.png';
              if ($hasImage) {
                  $image = array_shift($community['community_images']);
                  $imageUrl = '/images/community/'.$image['hash'];
              }
          ?>
          <?= $this->Html->image($imageUrl, ['style' => 'max-width: 250px; height: auto;']); ?>
    </div>
  </section>
</article>
TODO:

<?php debug($community); ?>
