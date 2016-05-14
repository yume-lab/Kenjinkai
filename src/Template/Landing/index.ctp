<?php
    $registerButtonRow = <<<EOF
    <div class="row" style="margin-top: 2em;">
        <div class="col-md-4 col-md-offset-4">
            <a href="/users/init" class="btn btn-primary btn-block btn-lg">
                %s
            </a>
        </div>
    </div>
EOF;
    $registerButtonRow = sprintf($registerButtonRow, __('登録する'));
?>

<div id="fh5co-home" data-section="home" class="bg-home">
    <div class="container">
        <div class="row row-bottom-padded-lg" id="home">
            <div class="col-md-12 section-heading text-center">
                <h2 class="to-animate">
                    <?= $this->Html->image('login_servicelogo.svg'); ?>
                </h2>
                <div class="row">
                    <div  data-section="register" class="col-md-8 col-md-offset-2 to-animate">
                        <h3 id="catch-copy">
                            <?= __('誰しもノスタルジアな心を持っている'); ?><br/>
                            <?= __('時折、郷愁の香りに想いを馳せ、故郷の今に好奇心を掻き立てられる'); ?><br/>
                            <?= __('想い出のあの街、この街で、つながりたい人が待っている'); ?><br/>
                            <?= __('あの街からはじまるネットワーク'); ?><br/>
                            <br/>
                            <?= __('故郷はどこですか？'); ?><br/>
                            <?= __('現在のお住まいはどこですか？'); ?><br/>
                            <br/>
                            <?= __('あなたを待つ人は、ここにいる'); ?><br/>
                            <br/>
                            <span style="font-size: 1.3em;"><?= __('登録料は完全無料'); ?></span><br/>
                            <br/>
                            <?= __('あなたの故郷の県人会で仲間を見つけませんか。'); ?><br/>
                            <br/>
                            <a href="#" data-nav-section="about" style="color: #FFF; text-decoration: underline;">
                                <?= __('県人会とは'); ?>
                            </a>
                            <br/>
                        </h3>
                    </div>
                </div>

                <?= $registerButtonRow; ?>
            </div>
        </div>
    </div>
</div>

<div id="fh5co-about-us" data-section="about" class="bg-about">
    <div class="container">
        <div class="row row-bottom-padded-lg" id="about-us">
            <div class="col-md-12 section-heading text-center">
                <h2 class="to-animate">
                    <?= __('県人会とは'); ?>
                </h2>
                <div class="row">
                    <div class="col-md-8 col-md-offset-2 to-animate">
                        <h4>
                            <?php
                                $text = <<<EOF
この街が好き<br/>
<br/>
故郷を離れ、この街に来て何年になるだろう。<br/>
この街で同じ故郷の人がいたら、あの時の夢や希望、今の現実。<br/>
<br/>
沢山話したい。<br/>
<br/>
この街で毎日つながる誰かと話し、時には故郷で造られたお酒を呑み交わす。<br/>
県人会はそんな出会いを求める方に入会して頂きたい<br/>
ソーシャルネットワークサービスです。<br/>
<br/>
<br/>
入会は無料、あなたの町であなたの故郷のコミュニティを立ち上げてください。<br/>
<br/>
たまに連絡を取るだけのネット上の希薄なコミュニケーションではなく、
この街のどこかにいる同郷人とリアルな関係性を構築し、毎日を楽しんでください。
<br/>
EOF;
                                echo __($text);
                                unset($text);
                            ?>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" id="goal">
            <div class="col-md-12 section-heading text-center to-animate">
                <h2>
                    <?= __('県人会が目指すもの'); ?>
                </h2>
                <div class="row">
                    <div class="col-md-8 col-md-offset-2 to-animate">
                        <h4>
                            <?php
                                $text = <<<EOF
この街で共に生きてる方と、<br/>
故郷を想い、集い、様々な形で<br/>
この街からあなたの故郷を共に活性化して<br/>
もらいたい<br/>
<br/>
もちろん海外から日本に住む方も、母国の<br/>
文化で盛り上がって下さい<br/>
<br/>
飲み会、同郷会、イベント、物産展。<br/>
<br/>
近い将来、県人会コミュニティの中から、いろいろな土地の物産展が実現できたら嬉しく思います。<br/>
<br/>
このような思いで県人会を立ち上げました。<br/>
EOF;
                                echo __($text);
                                unset($text);
                            ?>
                        </h4>
                    </div>
                </div>

                <?= $registerButtonRow; ?>
            </div>
        </div>
    </div>
</div>

<div id="fh5co-pricing" data-section="services">
    <div class="container">
        <div class="row row-bottom-padded-sm">
            <div class="col-md-12 section-heading text-center">
                <h2 class="to-animate">
                    <?= __('使い方'); ?>
                </h2>
            </div>
        </div>
        <div class="row">
            <?php
                $contents = [
                    'つながりのある人を探す',
                    '県人会メンバーになる',
                    'コミュニティを作る',
                    'コミュニティメンバーになる',
                    'プロフィールを書く',
                    'コミュニティを申請する',
                    '掲示板にメッセージを書く',
                ];
            ?>
            <?php foreach ($contents as $content): ?>
                <div class="col-md-3 col-sm-6 to-animate">
                    <div class="price-box popular" style="background-color: #00b8a9;">
                        <p style="margin: 0; color: #FFF;"><?= __($content); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<div id="fh5co-testimonials" data-section="testimonials">
    <div class="container">
        <div class="row">
            <div class="col-md-12  col-xs-12 section-heading text-center">
                <h2 class="to-animate">
                    <?= __('会員さんの入会の動機'); ?>
                </h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="box-testimony to-animate">
                    <div class="col-md-2 col-xs-5" style="padding: 0;">
                        <?= $this->Html->image('landing/member_1.gif', ['class'=>'img-responsive']); ?>
                    </div>

                    <div class="col-md-8 col-xs-12">
                        <blockquote>
                            <p>
                                <?= __('故郷っていいな'); ?><br/>
                                <?= __('ただそれだけじゃないか'); ?><br/>
                                <?= __('他に理由なんかない'); ?><br/>
                                <?= __('あいつ、どんなやつになったかな？あの子はどうしてるのかな？'); ?><br/>
                                <?= __('それ位のものだけど、なんだか会いたい'); ?><br/>
                                <?= __('ちょっと今の自分を自慢してやりたいからかも・・'); ?><br/>
                            </p>
                        </blockquote>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-xs-12">
                <div class="box-testimony to-animate">
                    <div class="col-md-2 col-xs-5" style="padding: 0;">
                        <?= $this->Html->image('landing/member_2.gif', ['class'=>'img-responsive']); ?>
                    </div>

                    <div class="col-md-8 col-xs-12">
                        <blockquote>
                            <p>
                                <?= __('故郷・・・それは「人」が、「自分」がいて、'); ?><br/>
                                <?= __('初めて存在するもの'); ?><br/>
                                <?= __('未来に憧れ、まっすぐに愛した、あの頃'); ?><br/>
                                <?= __('自分の人生の第１幕だった舞台である故郷の地'); ?><br/>
                                <?= __('懐かしい人に会いたい・・'); ?><br/>
                            </p>
                        </blockquote>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-xs-12">
                <div class="box-testimony to-animate">
                    <div class="col-md-2 col-xs-5" style="padding: 0;">
                        <?= $this->Html->image('landing/member_3.gif', ['class'=>'img-responsive']); ?>
                    </div>

                    <div class="col-md-8 col-xs-12">
                        <blockquote>
                            <p>
                                <?= __('東京に出てきて7年、思えば職場と家の往復の毎日。'); ?><br/>
                                <?= __('最近なんだか疲れてきちゃった。'); ?><br/>
                                <?= __('小学校、中学校、高校時代の友人もこっちで頑張っているのかな・・'); ?><br/>
                            </p>
                        </blockquote>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

