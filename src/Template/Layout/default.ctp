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

        <?= $this->Html->script('jquery.min') ?>
        <?= $this->Html->script('modernizr-2.6.2.min') ?>

        <?= $this->Html->meta('icon') ?>
        <?= $this->fetch('meta') ?>
        <?= $this->fetch('css') ?>
        <?= $this->fetch('script') ?>

        <style>
          #fh5co-header {
            background: #D7003A;
          }
          #fh5co-header .navbar-default {
            border: transparent;
            background: transparent;
            -webkit-border-radius: 0px;
            -moz-border-radius: 0px;
            -ms-border-radius: 0px;
            border-radius: 0px;
          }
          #fh5co-header .navbar-brand {
            width: auto;
          }
          @media screen and (max-width: 768px) {
            #fh5co-header .navbar-brand .inner {
              display: block;
            }
          }
          .navbar-brand .inner {display: inline;}
          .navbar-brand {padding: 15px 5px;}

        </style>

    </head>
    <body>

      <header id="fh5co-header">
        <div class="navbar navbar-default" role="navigation">
          <div class="navbar-inner">
              <button type="button" class="navbar-toggle pull-left animated flip">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="/">
                  <div class="inner">
                      <?= $this->Html->image('login_logo.svg'); ?>
                  </div>
              </a>

              <!-- user dropdown starts -->
              <div class="btn-group pull-right">
                  <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                      <i class="glyphicon glyphicon-user"></i>
                      <span class="hidden-sm hidden-xs"> <?= 'まるまる' ?>さん</span>
                      <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu">
                      <li><a href="/users/account"><?= __('マイアカウント'); ?></a></li>
                      <li class="divider"></li>
                      <li><a href="/users/logout"><?= __('ログアウト'); ?></a></li>
                  </ul>
              </div>
              <!-- user dropdown ends -->
          </div>
        </div>
      </header>


      <div id="contents">
          <div class="ch-container">
              <div class="row">
                  <div id="sidebar" class="col-sm-2 col-lg-2">

                  </div>

                  <div id="content" class="col-lg-10 col-sm-10">
                      <?= $this->fetch('content') ?>
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
