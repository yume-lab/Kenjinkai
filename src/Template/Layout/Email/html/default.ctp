<?php
/**
 * メールテンプレートの共通レイアウト.
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
<head>
    <title><?= $this->fetch('title') ?></title>
</head>
<body>
    <div>
        <?= $this->fetch('content') ?>
    </div>

    <footer>
        <?= __('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━<br/>'); ?>
        <?= __('お問い合わせ<br/>'); ?>
        <?= __('inquiry01@kenjinkai.jp<br/>'); ?>
        <?= __('このメールは、送信専用メールアドレスから配信されています。<br/>'); ?>
        <?= __('ご返信いただいてもお答えできませんので、ご了承ください。<br/><br/>'); ?>
        <?= __('個人情報の取扱いについては個人情報保護方針をご覧下さい。<br/>'); ?>
        <?= __('http://kenjinkai.jp/info/pp.html<br/>'); ?>
        <?= __('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━<br/>'); ?>
        <?= __('発行：TYPICAL-JAPAN CO., LTD.<br/>'); ?>
        <?= __('COPYRIGHT(C) TYPICAL-JAPAN CO., LTD. ALL RIGHTS RESERVED.'); ?>
    </footer>
</body>
</html>
