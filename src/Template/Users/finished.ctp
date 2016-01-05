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
                            <?= __('ご登録、ありがとうございます！'); ?>
                            <br/>
                            <br/>
                            <?= __('本登録が完了致しました。'); ?>
                            <br/>
                            <?= __('故郷のつながりを、お楽しみください。'); ?>
                            <br/>
                        </h3>
                        <div class="center col-md-10" style="padding-top: 2em;">
                          <?= $this->Html->link(__('コミュニティを探す'), '/', ['class' => 'btn btn-lg btn-warning']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
