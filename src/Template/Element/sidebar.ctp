<div class="sidebar-nav">
    <div class="nav-canvas">
        <div class="nav-sm nav nav-stacked"></div>

        <ul class="nav nav-pills nav-stacked main-menu">
            <li>
                <!-- TODO: サンプル -->
                <img src="http://contents.sony.jp/cyber-shot/photo-sample/DSC-WX1/photo-sample_wx1_03.jpg" />
                <button class="edit-profile" href="">
                    <?= __('プロフィール編集'); ?>
                </button>
            </li>
            <li class="nav-header"><?= __('県人会検索'); ?></li>
            <li>
                <?= $this->Charisma->menuButton(__('コミュニティ検索'), '#'); ?>
            </li>
            <li>
                <?= $this->Charisma->menuButton(__('メンバー検索'), '#'); ?>
            </li>
            <li class="nav-header"><?= __('コミュニティ'); ?></li>
            <li>
                <p>
                    <?= __('自分が主導するコミュニティーを運営しませんか？<br/>こちらからお申込みいただけます。'); ?>
                </p>
            </li>
            <li>
                <?= $this->Charisma->menuButton(__('コミュニティ申請'), '#'); ?>
            </li>

        </ul>
    </div>
</div>