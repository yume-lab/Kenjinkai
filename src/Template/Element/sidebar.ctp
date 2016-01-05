<style>

.edit-profile {
	width: 100%;
	padding: 5px 0 !important;
	background: rgba(0,0,0,0.6);
	position: absolute !important;
	bottom: 0;
	left: 0;
	display: block  !important;
	color: #fff;
	text-align: center;
	text-decoration: none;
	transition: 0.2s;
}

.edit-profile:hover {
	background: rgba(0,0,0,0.8);
}

.edit-profile:before {
	content: url(../images/icon_prof.svg);
	margin-right: 3px;
}

</style>
<div class="sidebar-nav">
    <div class="nav-canvas">
        <div class="nav-sm nav nav-stacked">

        </div>
        <ul class="nav nav-pills nav-stacked main-menu">
            <li>
                <!-- TODO: サンプル -->
                <img src="http://contents.sony.jp/cyber-shot/photo-sample/DSC-WX1/photo-sample_wx1_03.jpg" />
                <button class="edit-profile" href="">
                    <?= __('プロフィール編集'); ?>
                </button>
            </li>
            <li>
                <div class="box col-md-12">
                    <button class="btn btn-lg btn-info col-md-12" href=""><?= __('日記を書く'); ?></button>
                </div>
                <div class="box col-md-12">
                    <button class="btn btn-lg btn-info col-md-12" href=""><?= __('お気に入り日記'); ?></button>
                </div>
                <div class="box col-md-12">
                    <button class="btn btn-lg btn-info col-md-12" href=""><?= __('メッセージ'); ?></button>
                </div>
            </li>

            <li class="nav-header"><?= __('県人会検索'); ?></li>
            <li>
                TODO
            </li>

        </ul>
    </div>
</div>