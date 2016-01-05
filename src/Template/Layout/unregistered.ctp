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

        <?php
            echo $this->Html->css('inc');
            echo $this->Html->css('animate');
            echo $this->Html->css('icomoon');
            echo $this->Html->css('simple-line-icons');
            echo $this->Html->css('owl.carousel.min');
            echo $this->Html->css('owl.theme.default.min');
            echo $this->Html->css('bootstrap');
            echo $this->Html->css('turquoise');

            echo $this->Html->script('jquery.min');
            echo $this->Html->script('modernizr-2.6.2.min');
        ?>
        <style>
            .registContents_form {
                width: 100%;
            }
        </style>

        <?= $this->Html->meta('icon') ?>
        <?= $this->fetch('meta') ?>
        <?= $this->fetch('css') ?>
        <?= $this->fetch('script') ?>
    </head>
    <body>
    <header role="banner" id="fh5co-header">
        <div class="container">
            <nav class="navbar navbar-default">
                <div class="navbar-header">
                    <!-- Mobile Toggle Menu Button -->
                    <?php if (isset($showMenu) && $showMenu): ?>
                        <a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle"
                           data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <i></i>
                        </a>
                    <?php endif; ?>
                    <a class="navbar-brand" href="/">
                        <div class="inner">
                            <?= $this->Html->image('login_logo.svg'); ?>
                        </div>
                        <div class="inner">
                            <?= $this->Html->image('login_subtitle.svg'); ?>
                        </div>
                    </a>
                </div>
                <?php if (isset($showMenu) && $showMenu): ?>
                    <div id="navbar" class="navbar-collapse collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <li class="active"><a href="#" data-nav-section="home"><span><?= __('TOP'); ?></span></a></li>
                            <li><a href="#" data-nav-section="about"><span><?= __('県人会とは？'); ?></span></a></li>
                            <li><a href="#" data-nav-section="features"><span><?= __('特　徴'); ?></span></a></li>
                            <li><a href="#" data-nav-section="services"><span><?= __('使い方'); ?></span></a></li>
                            <li>
                                <a href="#" style="color: #FFF;" data-toggle="modal" data-target="#login-form">
                                    <span><?= __('→ ログイン'); ?></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                <?php endif; ?>
            </nav>
          <!-- </div> -->
      </div>
    </header>

    <section id="content">
        <?= $this->fetch('content') ?>
    </section>

    <footer id="footer" role="contentinfo">
        <div class="container">
            <div class="row row-bottom-padded-sm">
                <div class="col-md-12">
                    <p class="copyright text-center">
                        &copy; <?= __('2015 県人会. All Rights Reserved.'); ?> <br>
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <?php
        echo $this->Html->script('jquery.easing.1.3');
        echo $this->Html->script('bootstrap.min');
        echo $this->Html->script('jquery.waypoints.min');
        echo $this->Html->script('owl.carousel.min');
        echo $this->Html->script('jquery.style.switcher');
        echo $this->Html->script('main');
    ?>
    </body>
</html>
