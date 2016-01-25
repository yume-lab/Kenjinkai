<?php
/**
 * アゲラー管理システムの共通テンプレート.
 * ヘッダーとサイドバーを表示させない用です.
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
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->element('Assets/header') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <div id="loading"></div>

    <div id="contents">
        <div class="ch-container">
            <div class="row">
                <div id="content" class="col-lg-12 col-sm-10">
                    <?= $this->fetch('content') ?>
                </div>
            </div>
        </div>
    </div>

    <?= $this->element('Assets/footer') ?>
</body>
</html>
