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
    </head>
    <body>
    <header role="banner" id="fh5co-header">
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
            </nav>
          <!-- </div> -->
      </div>
    </header>

    <section id="content">
        <div class="row">
            <div id="navbar" class="navbar-collapse collapse col-sm-2 col-lg-2">
            <!--<div id="sidebar" class="col-sm-2 col-lg-2">-->



    <div class="memberMenu cell">
      <div class="memberMenu_prof">
        <img class="memberMenu_prof_image" src="images/member_prof.jpg" />
        <a class="memberMenu_prof_link" href="member_profile_edit.html">プロフィール編集</a>
      </div>
      <div class="memberMenu_contents_container">
        <div class="memberMenu_contents_item"><a class="memberMenu_contents_itemButton memberButton" href="member_dialy.html">日記を書く</a></div>
        <div class="memberMenu_contents_item"><a class="memberMenu_contents_itemButton memberButton" href="#">お気に入り日記</a></div>
        <div class="memberMenu_contents_item"><a class="memberMenu_contents_itemButton memberButton" href="member_message.html">メッセージ</a><span class="memberMenu_contents_itemNotification notificationNum">100</span></div>
      </div>
      <section class="memberMenu_contents">
        <h2 class="memberMenu_contents_title">県人会検索</h2>
        <div class="memberMenu_contents_container">
          <form class="memberMenu_contents_form">
            <label class="memberMenu_contents_formItem">出身地
              <select>
                <option>都道府県</option>
              </select>
              <select>
                <option>市町村</option>
              </select>
            </label>
            <label class="memberMenu_contents_formItem">現住所
              <select>
                <option>都道府県</option>
              </select>
              <select>
                <option>市町村</option>
              </select>
            </label>
            <label class="memberMenu_contents_formItem">フリーワード
              <input type="text" />
            </label>
            <div class="memberMenu_contents_item"><input class="memberMenu_contents_itemButton memberButton" type="submit" value="コミュニティを検索" /></div>
            <div class="memberMenu_contents_item"><input class="memberMenu_contents_itemButton memberButton" type="submit" value="メンバーを検索" /></div>
          </form>
        </div>
      </section>
      <section class="memberMenu_cotnents">
        <h2 class="memberMenu_contents_title">県人会検索</h2>
        <div class="memberMenu_contents_container">
          <p class="memberMenu_contents_description">自分が主導するコミュニティーを運営しませんか？<br />こちらからお申込みいただけます。</p>
          <div class="memberMenu_contents_item"><a class="memberMenu_contents_itemButton memberButton" href="#">コミュニティ申請</a></div>
        </div>
      </section>
    </div>






            </div>

            <div class="col-lg-10 col-sm-10">
                <?= $this->fetch('content') ?>
            </div>
        </div>
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
