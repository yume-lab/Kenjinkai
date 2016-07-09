<div class="sidebar-nav">
    <div class="nav-canvas">
        <div class="nav-sm nav nav-stacked"></div>

        <ul class="nav nav-pills nav-stacked main-menu">
            <li style="background-color: #F8f8f8;">
                <?= $this->Html->image($imageUrl); ?>
                <a class="edit-profile" href="/mypage/edit">
                    <?= __('プロフィール編集'); ?>
                </a>
            </li>
            <li class="nav-header"><?= __('県人会検索'); ?></li>
            <li>
                <a href="/communities"><?= __('コミュニティ検索'); ?></a>
            </li>
            <li class="nav-header"><?= __('コミュニティ'); ?></li>
            <li>
                <p>
                    <?= __('自分が主導するコミュニティーを運営しませんか？'); ?>
                </p>
            </li>
            <li>
                <a href="/communities/request"><?= __('コミュニティ申請'); ?></a>
            </li>
            <li class="nav-header"><?= __('設定/ヘルプ'); ?></li>
            <li>
                <a href="/pages/usage"><?= __('使い方'); ?></a>
            </li>
        </ul>
    </div>
</div>