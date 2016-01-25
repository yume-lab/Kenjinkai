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
                        __('<i class="glyphicon glyphicon-list-alt"></i><span> 審査待ち一覧</span>'),
                        ['controller' => 'ReviewCommunities', 'action' => 'index'],
                        ['escape' => false]);
                ?>
            </li>
            <li>
                <a class="ajax-link" href="/time-cards">
                    <i class="glyphicon glyphicon-book"></i>
                    <span> コミュニティ承認</span>
                </a>
            </li>

        </ul>
    </div>
</div>