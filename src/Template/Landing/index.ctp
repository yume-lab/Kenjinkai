<?php
    $this->layout = false;
?>
<!DOCTYPE html>
<html class="no-js">
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>県人会 - 同郷人と築く新しい絆 -</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="" />

   <!-- Facebook and Twitter integration -->
    <meta property="og:title" content=""/>
    <meta property="og:image" content=""/>
    <meta property="og:url" content=""/>
    <meta property="og:site_name" content=""/>
    <meta property="og:description" content=""/>
    <meta name="twitter:title" content="" />
    <meta name="twitter:image" content="" />
    <meta name="twitter:url" content="" />
    <meta name="twitter:card" content="" />

    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
    <link rel="shortcut icon" href="favicon.ico">

    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,600,400italic,700' rel='stylesheet' type='text/css'>

    <?php
        echo $this->Html->css('inc');
        echo $this->Html->css('animate');
        echo $this->Html->css('icomoon');
        echo $this->Html->css('simple-line-icons');
        echo $this->Html->css('owl.carousel.min');
        echo $this->Html->css('owl.theme.default.min');
        echo $this->Html->css('bootstrap');
        echo $this->Html->css('turquoise');

        echo $this->Html->script('modernizr-2.6.2.min');
    ?>

    <style>
        .registContents_form {
            width: 100%;
        }
    </style>

    </head>
    <body>
    <header role="banner" id="fh5co-header">
            <div class="container">
                <!-- <div class="row"> -->
                <nav class="navbar navbar-default">
                <div class="navbar-header">
                    <!-- Mobile Toggle Menu Button -->
                    <a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle"
                       data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <i></i>
                    </a>
                      <a class="navbar-brand" href="index.html">
                        <div class="inner">
                          <img src="images/login_logo.svg" alt="県人会" />
                        </div>
                        <div class="inner">
                          <img src="images/login_subtitle.svg" alt="同郷人と築く新しい絆" />
                        </div>
                    </a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                  <ul class="nav navbar-nav navbar-right">
                    <li class="active"><a href="#" data-nav-section="home"><span>Home</span></a></li>
                    <li><a href="#" data-nav-section="about"><span>県人会とは？</span></a></li>
                    <li><a href="#" data-nav-section="features"><span>特　徴</span></a></li>
                    <li><a href="#" data-nav-section="services"><span>使い方</span></a></li>
                    <li><a href="#" style="color: #FFF;"><span>→ ログイン</span></a></li>
                  </ul>
                </div>
                </nav>
              <!-- </div> -->
          </div>
    </header>

    <div id="fh5co-home" data-section="home" class="bg-home">
        <div class="container">
            <div class="row row-bottom-padded-lg" id="home">
                <div class="col-md-12 section-heading text-center">
                    <h2 class="to-animate">
                        <img src="images/login_servicelogo.svg" alt="県人会" />
                    </h2>
                    <div class="row">
                        <div  data-section="register" class="col-md-8 col-md-offset-2 to-animate">
                            <h3 id="catch-copy">
                              誰しも未来への心と、ノスタルジアな心は同居している<br/>
                              時折、郷愁の香りに想いを馳せ、故郷の今に好奇心を掻き立てられる<br/>
                              想い出のあの街、この街で、つながりたい人が待っている<br/>
                              あの街からはじまるネットワーク<br/>
                              あなたを待つ人は、ここにいる<br/>
                            </h3>

                            <h3>あなたの故郷は、どこですか？</h3>
                            <form class="registContents_form">
                                <p>
                                    <input class="registContents_form_input registContents_form_confirm-large"
                                           type="email" id="email"
                                           placeholder="signup@kenjinkai.co.jp">
                                </p>
                                <p>
                                  <a href="#" class="btn btn-primary">登録する</a>
                                </p>
                            </form>
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
                    <h2 class="to-animate">県人会とは</h2>
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2 to-animate">
                            <h4>
                                この街が好き<br/>
                                <br/>
                                愛着のあるこの街、故郷を離れもう何年になるだろう。<br/>
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
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" id="goal">
                <div class="col-md-12 section-heading text-center to-animate">
                    <h2>県人会が目指すもの</h2>
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2 to-animate">
                            <h4>
                                日本に住むブラジルの方は浅草サンバで盛り上がります。<br/>
                                <br/>
                                この街で頑張っている方に、<br/>
                                故郷を思い、集い、様々な形でこの土地で故郷を活性化してもらいたい。<br/>
                                <br/>
                                飲み会、同郷会、イベント、物産展。<br/>
                                <br/>
                                近い将来、県人会コミュニティの中から、いろいろな土地の物産展が実現できたら嬉しく思います。<br/>
                                <br/>
                                このような思いで県人会を立ち上げました。<br/>
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
                        県人会の特徴
                    </h2>
                </div>
            </div>
            <div class="row row-bottom-padded-sm">
                <div class="col-md-4 col-sm-6 col-xs-6 col-xxs-12 fh5co-service to-animate">
                    <div class="fh5co-icon"><i class="icon-crop"></i></div>
                    <div class="fh5co-desc">
                        <h3>特徴１</h3>
                        <p>
                            特徴１テキスト
                            特徴１テキスト
                            特徴１テキスト
                            特徴１テキスト
                            特徴１テキスト
                        </p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-6 col-xxs-12 fh5co-service to-animate">
                    <div class="fh5co-icon"><i class="icon-crop"></i></div>
                    <div class="fh5co-desc">
                        <h3>特徴２</h3>
                        <p>
                            特徴２テキスト
                            特徴２テキスト
                            特徴２テキスト
                            特徴２テキスト
                            特徴２テキスト
                        </p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-6 col-xxs-12 fh5co-service to-animate">
                    <div class="fh5co-icon"><i class="icon-crop"></i></div>
                    <div class="fh5co-desc">
                        <h3>特徴３</h3>
                        <p>
                            特徴３テキスト
                            特徴３テキスト
                            特徴３テキスト
                            特徴３テキスト
                            特徴３テキスト
                        </p>
                    </div>
                </div>
                <div class="clearfix visible-sm-block visible-xs-block"></div>
            </div>
            <div class="row">
                <div class="col-md-4 col-md-offset-4 single-animate animate-features-3">
                    <a href="#"  data-nav-section="register" class="btn btn-primary btn-block">
                        登録する
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div id="fh5co-pricing" data-section="services">
        <div class="container">
            <div class="row row-bottom-padded-sm">
                <div class="col-md-12 section-heading text-center">
                    <h2 class="to-animate">使い方 簡単３ステップ</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-6 to-animate">
                    <div class="price-box popular">
                        <div class="popular-text">STEP 1</div>
                        <h2 class="pricing-plan">◯◯する</h2>
                        <p>
                            STEP1説明文
                            STEP1説明文
                            STEP1説明文
                            STEP1説明文
                            STEP1説明文
                        </p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 to-animate">
                    <div class="price-box popular">
                        <div class="popular-text">STEP 2</div>
                        <h2 class="pricing-plan">◯◯する</h2>
                        <p>
                            STEP2説明文
                            STEP2説明文
                            STEP2説明文
                            STEP2説明文
                            STEP2説明文
                        </p>
                    </div>
                </div>
                <div class="clearfix visible-sm-block"></div>
                <div class="col-md-4 col-sm-6 to-animate">
                    <div class="price-box popular">
                        <div class="popular-text">STEP 3</div>
                        <h2 class="pricing-plan">◯◯する</h2>
                        <p>
                            STEP3説明文
                            STEP3説明文
                            STEP3説明文
                            STEP3説明文
                            STEP3説明文
                        </p>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-4 col-md-offset-4 single-animate animate-features-3">
                    <a href="#"  data-nav-section="register" class="btn btn-primary btn-block">
                        登録する
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div id="fh5co-testimonials" data-section="testimonials">
        <div class="container">
            <div class="row">
                <div class="col-md-12 section-heading text-center">
                    <h2 class="to-animate">お客様の声</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="box-testimony to-animate">
                        <blockquote>
                            <span class="quote"><span><i class="icon-quote-left"></i></span></span>
                            <p>
                                お客様の声テキスト
                                お客様の声テキスト
                                お客様の声テキスト
                            </p>
                        </blockquote>
                        <p class="author">
                            A.A. さん 20代
                            <span class="subtext">
                                故郷：北海道札幌市
                            </span>
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="box-testimony to-animate">
                        <blockquote>
                            <span class="quote"><span><i class="icon-quote-left"></i></span></span>
                            <p>
                                お客様の声テキスト
                                お客様の声テキスト
                                お客様の声テキスト
                            </p>
                        </blockquote>
                        <p class="author">
                            A.A. さん 20代
                            <span class="subtext">
                                故郷：北海道札幌市
                            </span>
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="box-testimony to-animate">
                        <blockquote>
                            <span class="quote"><span><i class="icon-quote-left"></i></span></span>
                            <p>
                                お客様の声テキスト
                                お客様の声テキスト
                                お客様の声テキスト
                            </p>
                        </blockquote>
                        <p class="author">
                            A.A. さん 20代
                            <span class="subtext">
                                故郷：北海道札幌市
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="fh5co-press" data-section="press">
        <div class="container">
            <div class="row">
                <div class="col-md-12 section-heading text-center">
                    <h2 class="single-animate animate-press-1">あなたも一緒に</h2>
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2 subtext single-animate animate-press-2">
                            <h3>故郷を想い、集い、活性化してみませんか？</h3>
                            <form class="registContents_form">
                                <p>
                                    <input class="registContents_form_input registContents_form_confirm-large"
                                           type="email" id="email"
                                           placeholder="signup@kenjinkai.co.jp">
                                </p>
                                <p>
                                  <a href="#" class="btn btn-primary">登録する</a>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <footer id="footer" role="contentinfo">
        <div class="container">
            <div class="row row-bottom-padded-sm">
                <div class="col-md-12">
                    <p class="copyright text-center">
                        &copy; 2015 県人会. All Rights Reserved. <br>
                    </p>
                </div>
            </div>
        </div>
    </footer>


    <?php
        echo $this->Html->script('jquery.min');
        echo $this->Html->script('jquery.easing.1.3');
        echo $this->Html->script('bootstrap.min');
        echo $this->Html->script('jquery.waypoints.min');
        echo $this->Html->script('owl.carousel.min');
        echo $this->Html->script('jquery.style.switcher');
        echo $this->Html->script('main');
    ?>

    </body>
</html>
