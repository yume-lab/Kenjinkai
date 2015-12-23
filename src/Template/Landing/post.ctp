<?php
    $this->layout = false;

    // TODO: スタブ
    $hometownCount = 12;
    $communityCount = 20;
?>
<!DOCTYPE html>
<html class="no-js">
    <head>
        <?= $this->Html->charset() ?>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>
            <?= __('県人会 - 同郷人と築く新しい絆 -'); ?>
        </title>

        <link rel="shortcut icon" href="favicon.ico">
        <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,600,400italic,700' rel='stylesheet' type='text/css'>
        <?php
            echo $this->Html->css('inc');
            echo $this->Html->css('bootstrap');
            echo $this->Html->css('turquoise');
        ?>
        <style>
            .strong {
                color: #D7003A;
                font-size: 1.5em;
            }
        </style>
    </head>
    <body>
    <header role="banner" id="fh5co-header" style="position: initial;">
        <div class="container">
            <nav class="navbar navbar-default">
                <div class="navbar-header">
                    <!-- Mobile Toggle Menu Button -->
                    <a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle"
                       data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <i></i>
                    </a>
                    <a class="navbar-brand" href="/">
                        <div class="inner">
                            <?= $this->Html->image('login_logo.svg'); ?>
                        </div>
                        <div class="inner">
                            <?= $this->Html->image('login_subtitle.svg'); ?>
                        </div>
                    </a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#" style="color: #FFF;"><span><?= __('→ ログイン'); ?></span></a></li>
                    </ul>
                </div>
            </nav>
          <!-- </div> -->
      </div>
    </header>

    <div class="bg-home">
        <div class="container">
            <div class="row row-bottom-padded-lg" id="home">
                <div class="col-md-12 section-heading text-center">
                    <div class="row text-left">
                        <div  data-section="register" class="col-md-8 col-md-offset-2">
                            <h3>
                                <?= __('メールが送信されました。'); ?>
                                <br/>
                                <?= __('本登録を完了させてください。'); ?>
                                <br/>
                                <br/>

                                <?= __('あなたの故郷に縁のある'); ?>
                                <br/>
                                <span class="strong"><?= $communityCount ?></span>
                                <?= __('のコミュニティで、'); ?>
                                <br/>
                                <span class="strong"><?= $hometownCount ?></span>
                                <?= __('人のメンバーがあなたを待っています！'); ?>
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
        echo $this->Html->script('jquery.min');
        echo $this->Html->script('bootstrap.min');
    ?>
    </body>
</html>
