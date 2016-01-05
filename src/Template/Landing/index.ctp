<?php
    $registerFormElement = <<<EOF
<form class="registContents_form" method="post" action="/landing/post">
    <p>
        <input class="registContents_form_input registContents_form_confirm-large"
               type="email" id="email" name="email" required
               placeholder="signup@kenjinkai.co.jp">
    </p>
    <p>
<button type="submit" class="btn btn-primary">%s</button>
    </p>
</form>
EOF;
    $registerFormElement = sprintf($registerFormElement, __('登録する'));
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
                            <?php
                                $text = <<<EOF
誰しも、ノスタルジアな心を持っている<br/>
時折、郷愁の香りに想いを馳せ、故郷の今に好奇心を掻き立てられる<br/>
想い出のあの街、この街で、つながりたい人が待っている<br/>
あの街からはじまるネットワーク<br/>
あなたを待つ人は、ここにいる<br/>
EOF;
                                echo __($text);
                                unset($text);
                            ?>
                        </h3>

                        <h3><?= __('あなたの故郷は、どこですか？'); ?></h3>
                        <?= $registerFormElement; ?>
                    </div>
                </div>
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
            </div>
        </div>
    </div>
</div>

<div id="fh5co-features" data-section="features">
    <div class="container">
        <div class="row">
            <div class="col-md-12 section-heading text-center">
                <h2 class="single-animate animate-features-1">
                    <?= __('県人会の特徴'); ?>
                </h2>
            </div>
        </div>
        <div class="row row-bottom-padded-sm">
            <?php foreach ($features as $feature): ?>
                <div class="col-md-4 col-sm-6 col-xs-6 col-xxs-12 fh5co-service to-animate">
                    <div class="fh5co-icon"><i class="icon-crop"></i></div>
                    <div class="fh5co-desc">
                        <h3><?= $feature['title']; ?></h3>
                        <p><?= $feature['content']; ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
            <div class="clearfix visible-sm-block visible-xs-block"></div>
        </div>
        <div class="row">
            <div class="col-md-4 col-md-offset-4 single-animate animate-features-3">
                <a href="#"  data-nav-section="register" class="btn btn-primary btn-block">
                    <?= __('登録する'); ?>
                </a>
            </div>
        </div>
    </div>
</div>

<div id="fh5co-pricing" data-section="services">
    <div class="container">
        <div class="row row-bottom-padded-sm">
            <div class="col-md-12 section-heading text-center">
                <h2 class="to-animate">
                    <?= __('使い方 簡単３ステップ'); ?>
                </h2>
            </div>
        </div>
        <div class="row">
            <?php foreach ($steps as $index => $step): ?>
                <div class="col-md-4 col-sm-6 to-animate">
                    <div class="price-box popular">
                        <div class="popular-text">
                            <?= __('STEP ' . ($index + 1)); ?>
                        </div>
                        <h2 class="pricing-plan"><?= $step['title']; ?></h2>
                        <p><?= $step['content']; ?></p>
                    </div>
                </div>
                <div class="clearfix visible-sm-block"></div>
            <?php endforeach; ?>
        </div>
        <div class="row">
            <div class="col-md-4 col-md-offset-4 single-animate animate-features-3">
                <a href="#"  data-nav-section="register" class="btn btn-primary btn-block">
                    <?= __('登録する'); ?>
                </a>
            </div>
        </div>
    </div>
</div>

<div id="fh5co-testimonials" data-section="testimonials">
    <div class="container">
        <div class="row">
            <div class="col-md-12 section-heading text-center">
                <h2 class="to-animate">
                    <?= __('お客様の声'); ?>
                </h2>
            </div>
        </div>
        <div class="row">
            <?php foreach ($testimonials as $testimonial): ?>
                <div class="col-md-4">
                    <div class="box-testimony to-animate">
                        <blockquote>
                            <span class="quote"><span><i class="icon-quote-left"></i></span></span>
                            <p><?= $testimonial['text']; ?></p>
                        </blockquote>
                        <p class="author">
                            <?= $testimonial['nickname'] . __(' さん ') . $testimonial['age']; ?>
                            <span class="subtext">
                                <?= __('故郷：') . $testimonial['hometown']; ?>
                            </span>
                        </p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<div id="fh5co-press" data-section="press">
    <div class="container">
        <div class="row">
            <div class="col-md-12 section-heading text-center">
                <h2 class="single-animate animate-press-1">
                    <?= __('あなたも一緒に'); ?>
                </h2>
                <div class="row">
                    <div class="col-md-8 col-md-offset-2 subtext single-animate animate-press-2">
                        <h3><?= __('故郷を想い、集い、活性化してみませんか？'); ?></h3>
                        <?= $registerFormElement; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
