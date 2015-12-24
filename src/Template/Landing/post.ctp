<style>
    .strong {
        color: #D7003A;
        font-size: 1.5em;
    }
    .bg-home {
        padding-top: 75px;
    }
</style>

<div class="bg-home">
    <div class="container">
        <div class="row row-bottom-padded-lg" id="home">
            <div class="col-md-12 section-heading text-center">
                <div class="row text-left">
                    <div  data-section="register" class="col-md-8 col-md-offset-2">
                        <h3>
                            <?= __('メールが送信されました。'); ?>
                            <br/>
                            <?= __('本登録を完了させてください。'); ?>
                            <br/>
                            <br/>

                            <?= __('あなたの故郷に縁のある'); ?>
                            <br/>
                            <span class="strong"><?= $communityCount ?></span>
                            <?= __('のコミュニティで、'); ?>
                            <br/>
                            <span class="strong"><?= $hometownCount ?></span>
                            <?= __('人のメンバーがあなたを待っています！'); ?>
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
