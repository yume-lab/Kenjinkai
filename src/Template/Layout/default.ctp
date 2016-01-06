<?php
    // 未登録用レイアウト
?>
<!DOCTYPE html>
<html class="no-js">
    <head>
        <?= $this->Html->charset() ?>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= __('県人会 - 同郷人と築く新しい絆 -'); ?></title>
        <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,600,400italic,700' rel='stylesheet' type='text/css'>

        <?= $this->Html->css('bootstrap') ?>
        <?= $this->Html->css('charisma-app') ?>

        <?= $this->Html->css(BOWER_PATH.'/chosen/chosen.min') ?>
        <?= $this->Html->css(BOWER_PATH.'/colorbox/example3/colorbox') ?>
        <?= $this->Html->css(BOWER_PATH.'/responsive-tables/responsive-tables') ?>
        <?= $this->Html->css(BOWER_PATH.'/bootstrap-tour/build/css/bootstrap-tour.min') ?>

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
                      <?= $this->fetch('content') ?>
                  </div>
                  <div id="rightbar" class="col-lg-3 col-sm-3">
                      <div class="center">
                          <?= $this->Html->image('samplebanner.jpg'); ?>
                      </div>
                  </div>
              </div>
              <hr>
          </div>
      </div>

    <?= $this->element('footer') ?>

    <?= $this->Html->script(BOWER_PATH.'/bootstrap/dist/js/bootstrap.min.js') ?>
    <?= $this->Html->script('jquery.cookie.js') ?>
    <?= $this->Html->script('jquery.dataTables.min.js') ?>
    <?= $this->Html->script(BOWER_PATH.'/chosen/chosen.jquery.min.js') ?>
    <?= $this->Html->script(BOWER_PATH.'/colorbox/jquery.colorbox-min.js') ?>
    <?= $this->Html->script('jquery.noty.js') ?>
    <?= $this->Html->script(BOWER_PATH.'/responsive-tables/responsive-tables.js') ?>
    <?= $this->Html->script(BOWER_PATH.'/bootstrap-tour/build/js/bootstrap-tour.min.js') ?>
    <?= $this->Html->script('jquery.raty.min.js') ?>
    <?= $this->Html->script('jquery.iphone.toggle.js') ?>
    <?= $this->Html->script('jquery.autogrow-textarea.js') ?>
    <?= $this->Html->script('jquery.uploadify-3.1.min.js') ?>
    <?= $this->Html->script('jquery.history.js') ?>
    <?= $this->Html->script('charisma.js') ?>

    </body>
</html>
