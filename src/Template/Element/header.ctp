<header id="fh5co-header">
    <div class="navbar navbar-default" role="navigation">
        <div class="navbar-inner">
          <button type="button" class="navbar-toggle pull-left">
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
                  <span class="hidden-sm hidden-xs"> <?= $profile['nickname'] ?>さん</span>
                  <span class="caret"></span>
              </button>
              <ul class="dropdown-menu">
                  <li><a href="/users/edit"><?= __('マイアカウント'); ?></a></li>
                  <li class="divider"></li>
                  <li><a href="/users/logout"><?= __('ログアウト'); ?></a></li>
              </ul>
          </div>
          <!-- user dropdown ends -->
        </div>
    </div>
</header>