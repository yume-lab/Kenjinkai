<?php
    // 未登録用レイアウト
?>
<!DOCTYPE html>
<html class="no-js">
    <head>
        <?= $this->Html->charset() ?>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="県人会は、今住んでいる地域で同郷人とつながるコミュニティサービスです。
あいつ今何してるのかな。SNSを通して故郷がつないでくれる昔なつかしい友。
今ここの地で誰かとつながっているかけがえのない安心。
この地域で同郷の仲間をし、ふる里の話題でこの地を活性化してもらう事を
サポートします。">
        <meta name="keywords" content="県人会,生まれ故郷,同郷,ふる里,地域でつながる,友達探す,地域活性,地域応援">
        <title><?= __('今住んでいる地域で同郷人とつながるなら県人会へ'); ?></title>
        <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,600,400italic,700' rel='stylesheet' type='text/css'>

        <?= $this->Html->css('bootstrap.min') ?>
        <?= $this->Html->css('charisma-app') ?>

        <?= $this->Html->css('jquery.noty') ?>
        <?= $this->Html->css('noty_theme_default') ?>
        <?= $this->Html->css('elfinder.min') ?>
        <?= $this->Html->css('elfinder.theme') ?>
        <?= $this->Html->css('jquery.iphone.toggle') ?>
        <?= $this->Html->css('uploadify') ?>
        <?= $this->Html->css('animate.min') ?>

        <?= $this->Html->css('front') ?>

        <?= $this->Html->script('jquery.min') ?>
        <?= $this->Html->script('modernizr-2.6.2.min') ?>

        <?= $this->Html->meta('icon') ?>
        <?= $this->fetch('meta') ?>
        <?= $this->fetch('css') ?>
        <?= $this->fetch('script') ?>
    </head>
    <body>
      <?= $this->element('header') ?>

      <div id="contents">
          <div class="ch-container">
              <div class="row">
                  <div id="sidebar" class="col-sm-2 col-lg-2">
                    <?= $this->element('sidebar') ?>
                  </div>

                  <div id="content" class="col-lg-7 col-sm-7">
                      <?= $this->Flash->render(); ?>
                      <?= $this->fetch('content') ?>
                  </div>
                  <div id="rightbar" class="col-lg-3 col-sm-3">
                      <?= $this->element('rightbar') ?>
                  </div>
              </div>
              <hr>
          </div>
      </div>

    <?= $this->element('footer') ?>

    <?= $this->Html->script('bootstrap.min.js') ?>
    <?= $this->Html->script('jquery.cookie.js') ?>
    <?= $this->Html->script('jquery.dataTables.min.js') ?>
    <?= $this->Html->script('jquery.noty.js') ?>
    <?= $this->Html->script('jquery.raty.min.js') ?>
    <?= $this->Html->script('jquery.iphone.toggle.js') ?>
    <?= $this->Html->script('jquery.autogrow-textarea.js') ?>
    <?= $this->Html->script('jquery.uploadify-3.1.min.js') ?>
    <?= $this->Html->script('jquery.history.js') ?>
    <?= $this->Html->script('charisma.js') ?>
    <?= $this->Html->script('front') ?>

    <?= $this->element('tag_manager') ?>

    </body>
</html>
