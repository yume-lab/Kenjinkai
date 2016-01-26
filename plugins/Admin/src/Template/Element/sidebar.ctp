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
            <li class="nav-header">コミュニティ</li>
            <li>
                <?=
                    $this->Html->link(
                        __('<i class="glyphicon glyphicon-list-alt"></i><span> 承認待ち一覧</span>'),
                        ['controller' => 'Communities', 'action' => 'review'],
                        ['escape' => false]);
                ?>
            </li>
        </ul>
    </div>
</div>