<?php
/**
 * アゲラー管理システムの共通テンプレート
 */

?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="robots" content="noindex">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/img/favicon.ico">
    <title>
        <?= __('県人会-管理画面'); ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->element('Assets/header') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <div id="header">
        <?= $this->element('header') ?>
    </div>

    <div id="contents">
        <div class="ch-container">
            <div class="row">
                <div id="sidebar" class="col-sm-2 col-lg-2">
                    <?= $this->element('sidebar') ?>
                </div>

                <div id="content" class="col-lg-10 col-sm-10">
                    <?= $this->fetch('content') ?>
                </div>
            </div>
            <hr>

            <?= $this->element('footer') ?>
        </div>
    </div>

    <?= $this->element('Assets/footer') ?>
</body>
</html>
