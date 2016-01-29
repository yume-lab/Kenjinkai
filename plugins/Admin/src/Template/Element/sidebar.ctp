<?php
/**
 * サイドバーエレメント
 */
?>

<div class="sidebar-nav">
    <div class="nav-canvas">
        <div class="nav-sm nav nav-stacked">

        </div>
        <ul class="nav nav-pills nav-stacked main-menu">
            <li class="nav-header"><?= __('コミュニティ') ?></li>
            <li>
                <a href="<?= $this->Url->build(['controller'=>'Communities', 'action'=>'review'])?>">
                    <i class="glyphicon glyphicon-list-alt"></i><span> 承認待ち一覧</span>
                </a>
            </li>
            <li class="nav-header"><?= __('設定') ?></li>
            <li>
                <a href="<?= $this->Url->build(['controller'=>'Informations', 'action'=>'index'])?>">
                    <i class="glyphicon glyphicon-info-sign"></i><span> お知らせ</span>
                </a>
            </li>
        </ul>
    </div>
</div>