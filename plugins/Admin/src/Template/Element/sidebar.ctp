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
                <?=
                    $this->Html->link(
                        __('<i class="glyphicon glyphicon-list-alt"></i><span> 承認待ち一覧</span>'),
                        ['controller' => 'Communities', 'action' => 'review'],
                        ['escape' => false]);
                ?>
            </li>
            <li class="nav-header"><?= __('設定') ?></li>
            <li>
                <?=
                    $this->Html->link(
                        __('<i class="glyphicon glyphicon-info-sign"></i><span> お知らせ</span>'),
                        ['controller' => 'Informations', 'action' => 'index'],
                        ['escape' => false]);
                ?>
            </li>
        </ul>
    </div>
</div>