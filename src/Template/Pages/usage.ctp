<?php $this->layout = 'default'; ?>
<style>
    .s-page-usage .panel-body {
        font-size: 0.9em;
        padding: 15px 0;
    }
</style>
<div class="container-fluid s-page-usage">
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <?= $this->Charisma->contentTitle(__('県人会の使い方'), '#6BAD45', 'icon_title_event.svg'); ?>
        </div>

        <hr style="width: 100%" />

        <div class="col-md-12 col-xs-12">
            <ul>
                <li>
                    <a href="#usage_1">
                        <?= __('つながりのある人を探す（コミュニティの検索）'); ?>
                    </a>
                </li>
                <li>
                    <a href="#usage_2">
                        <?= __('県人会メンバーになる（県人会に登録する）'); ?>
                    </a>
                </li>
                <li>
                    <a href="#usage_3">
                        <?= __('コミュニティを作る'); ?>
                    </a>
                </li>
                <li>
                    <a href="#usage_4">
                        <?= __('コミュニティメンバーになる'); ?>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <hr style="width: 100%" />

    <div class="row">
        <div class="col-md-12 col-xs-12">
            <div id="usage_1" class="panel panel-info">
                <div class="panel-heading">
                    <?= __('つながりのある人を探す（コミュニティの検索）'); ?>
                </div>
                <div class="panel-body">
                    <ul>
                        <li><?= __('県人会メンバー登録後、コミュニティ検索からつながりのある人をさがしてください。'); ?></li>
                        <li><?= __('マイページトップの画面左上の「コミュニティ検索」ボタンをクリックしてください'); ?></li>
                        <li><?= __('「居住地」「故郷」「カテゴリ」名称」などのキーワードから関連のある人（コミュニティ）を検索できます'); ?></li>
                    </ul>
                </div>
            </div>
            <div id="usage_2" class="panel panel-info">
                <div class="panel-heading">
                    <?= __('県人会メンバーになる（県人会に登録する）'); ?>
                </div>
                <div class="panel-body">
                    <ul>
                        <li><?= __('登録するボタンをクリックしてください'); ?></li>
                        <li><?= __('利用規約に同意してメールアドレスを入力後「登録する」ボタンをクリックしてください'); ?></li>
                        <li><?= __('登録内容の入力画面が表示されますので、項目に従って入力をしてください'); ?></li>
                        <li><?= __('全ての項目の入力を終えたら、「登録する」ボタンをクリックしてください'); ?></li>
                        <li><?= __('登録完了ページの「コミュニティを探す」ボタンをクリックしてください<br/>ここで開かれたページがあなたのマイページトップになります。'); ?></li>
                    </ul>
                </div>
            </div>
            <div id="usage_3" class="panel panel-info">
                <div class="panel-heading">
                    <?= __('コミュニティを作る'); ?>
                </div>
                <div class="panel-body">
                    <ul>
                        <li><?= __('マイページトップから画面左側の「コミュニティ申請」ボタンをクリックしてください'); ?></li>
                        <li><?= __('コミュニティ申請ページに登録済みの「現在のお住まい」「生まれ故郷」の表示を確認後、<br/>お好きな「コミュニティ名」を入力後、「カテゴリ」を選択し、コミュニティ画像をアップロードしてください。<br/>※コミュニティ画像は120px×120pxを規定としています'); ?></li>
                        <li><?= __('「コミュニティ作成の想い」を入力してください'); ?></li>
                        <li><?= __('「申請」ボタンをクリックします<br/>※申請ボタンをクリックすると県人会運営者に申請がされます'); ?></li>
                        <li><?= __('申請確認ページが表示されるので「TOP」ページボタンをクリックしてください'); ?></li>
                        <li><?= __('コミュニティ審査が完了するとマイページトップの「県人会からのお知らせ」に審査完了のお知らせが表示されまさす'); ?></li>
                        <li><?= __('お知らせ本文のテキストをクリックしてコミュニティ公開設定ページで「公開する」ボタンをクリックしてください<br/>コミュニティページが公開されます'); ?></li>
                        <li><?= __('コミュニティを作成したユーザーは「参加メンバー」画像に「リーダー」と表示されます<br/>コミュニティリーダーとしてコミュニティを盛り上げてください'); ?></li>
                    </ul>
                </div>
            </div>
            <div id="usage_4" class="panel panel-info">
                <div class="panel-heading">
                    <?= __('コミュニティメンバーになる'); ?>
                </div>
                <div class="panel-body">
                    <ul>
                        <li><?= __('県人会メンバー登録後、マイページトップから気になるコミュニティを検索してください'); ?></li>
                        <li><?= __('コミュニティ申請ページに登録済みの該当するコミュニティの検索結果表示後に、該当のコミュニティ画像をクリックしてください'); ?></li>
                        <li><?= __('表示されたページの「コミュニティに参加する」ボタンをクリックしてください'); ?></li>
                    </ul>
                </div>
            </div>

            <?php // TODO: 続きは今度 ?>
        </div>
    </div>
</div>
