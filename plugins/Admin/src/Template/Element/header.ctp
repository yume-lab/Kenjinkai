<?php
/**
 * ヘッダーエレメント
 */
?>

<div class="navbar navbar-default" role="navigation">
    <div class="navbar-inner">
        <button type="button" class="navbar-toggle pull-left animated flip">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/admin">
            <span><?= __('県人会-管理画面'); ?></span>
        </a>

        <!-- user dropdown starts -->
        <div class="btn-group pull-right">
            <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                <i class="glyphicon glyphicon-user"></i>
                <span class="hidden-sm hidden-xs"> <?= $admin['name'] . __('さん') ?></span>
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <li>
                    <?= $this->Html->link(__('ログアウト'), ['controller' => 'Admins', 'action' => 'logout']); ?>
                </li>
            </ul>
        </div>
        <!-- user dropdown ends -->
        <ul class="collapse navbar-collapse nav navbar-nav top-menu">
            <li><a href="/" target="_blank"><i class="glyphicon glyphicon-globe"></i> <?= __('フロントページ表示') ?></a></li>
        </ul>
    </div>
</div>
