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
            <li>
                <a href="<?= $this->Url->build(['controller'=>'Communities', 'action'=>'all'])?>">
                    <i class="glyphicon glyphicon-list-alt"></i><span> コミュニティ一覧</span>
                </a>
            </li>
            <li class="nav-header"><?= __('おしらせ') ?></li>
            <li>
                <a href="<?= $this->Url->build(['controller'=>'Informations', 'action'=>'index'])?>">
                    <i class="glyphicon glyphicon-info-sign"></i><span> テンプレート一覧</span>
                </a>
            </li>
            <li>
                <a href="<?= $this->Url->build(['controller'=>'Informations', 'action'=>'send'])?>">
                    <i class="glyphicon glyphicon-comment"></i><span> お知らせ送信</span>
                </a>
            </li>
            <li>
                <a href="<?= $this->Url->build(['controller'=>'SystemInformations', 'action'=>'index'])?>">
                    <i class="glyphicon glyphicon-envelope"></i><span> 自動通知一覧</span>
                </a>
            </li>
        </ul>
    </div>
</div>