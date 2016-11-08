<?php
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <?= Html::csrfMetaTags() ?>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <title><?= Html::encode($this->title) ?></title>
    <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
    <link rel="shortcut icon" href="/images/fav.png" />	
    <script src="<?= Yii::$app->request->baseUrl?>/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?= Yii::$app->request->baseUrl?>/js/move-top.js"></script>
    <script type="text/javascript" src="<?= Yii::$app->request->baseUrl?>/js/easing.js"></script>    
    <script type="text/javascript">
            jQuery(document).ready(function($) {
                    $(".scroll").click(function(event){		
                            event.preventDefault();
                            $('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
                    });
            });
    </script>
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    </script>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,800,700' rel='stylesheet' type='text/css'>
    <script>
            $(function() {
                    var pull 		= $('#pull');
                            menu 		= $('nav ul');
                            menuHeight	= menu.height();
                    $(pull).on('click', function(e) {
                            e.preventDefault();
                            menu.slideToggle();
                    });
                    $(window).resize(function(){
                    var w = $(window).width();
                    if(w > 320 && menu.is(':hidden')) {
                            menu.removeAttr('style');
                    }
            });
            });
    </script>
</head>
<body>

<?php $this->beginBody() ?>
<div id="home" class="header">
        <div class="container">
                <div class="top-header">
                        <div class="logo">
                                <a href="index.php"><img src="images/logo.png" title="logo" /></a>
                        </div>
                        
                         <nav class="top-nav">
                                <ul class="top-nav">
                                        <li class="active"><a href="#home" class="scroll">Home </a></li>
                                        <li><a href="#fea" class="scroll">FEATURES</a></li>
                                        <li><a href="#about" class="scroll">About </a></li>
                                        <?php
                                            if (Yii::$app->user->isGuest) {
                                                echo<<<EOF
                                                    <li><a href="index.php?r=user/signup">Signup</a></li>
                                                    <li><a href="index.php?r=user/login">Login</a></li>                                                
EOF;
                                            } else {
                                                echo "<li><a href='/dack/basic/web/index.php?r=user%2Flogout' data-method='post'>Logout (" . Yii::$app->user->identity->username . ")</a></li>";
                                            }
                                        ?>
                                        
                                </ul>
                        </nav>
                        <div class="clearfix"> </div>
                </div>
        </div>
</div>
<?= $content ?>
     <div class="footer">
            <div class="container">
                    <div class="footer-grids">
                            <div class="col-md-3 footer-grid about-info">
                                    <a href="#"><img src="images/logo.png" title="Umbrella" /></a>
                                    <p>© Copyright 2014 BiCoGe, All rights reserved</p>
                                    <p>Phone: 01688824579</p>
                                    <p>Email: pi.le@Unicorn.vn</p>
                            </div>
                            <div class="col-md-3 footer-grid subscribe">
                                    <h3>Subscribe </h3>
                                    <form>
                                            <input type="text" placeholder="" required />
                                            <input type="submit" value="" />
                                    </form>
                                    <p>Subscribe our Website to receive the newest information about Bigdata in the world!</p>
                            </div>
                            <div class="col-md-3 footer-grid explore">
                                    <h3>Explore</h3>
                                    <ul class="col-md-6">
                                            <li><a href="http://www.amazon.com/">Amazon</a></li>
                                            <li><a href="http://stackoverflow.com/">StackOverflow</a></li>
                                            <li><a href="https://github.com/">Github</a></li>
                                            <li><a href="https://trello.com/">Trello</a></li>
                                    </ul>
                                    <ul class="col-md-6">
                                            <li><a href="https://bitbucket.org/">Bitbucket</a></li>
                                            <li><a href="http://www.microsoft.com/">Microsoft</a></li>
                                            <li><a href="https://www.google.com">Google</a></li>
                                            <li><a href="https://vn.yahoo.com">Yahoo</a></li>
                                    </ul>
                                    <div class="clearfix"> </div>
                            </div>
                            <div class="col-md-3 footer-grid copy-right">
                                    <p>Life is a succession of lessons which must be lived to be understood.</p>                                   
                            </div>
                            <div class="clearfix"> </div>
                            <script type="text/javascript">
                                    $(document).ready(function() {
                                            /*
                                            var defaults = {
                                                    containerID: 'toTop', // fading element id
                                                    containerHoverID: 'toTopHover', // fading element hover id
                                                    scrollSpeed: 1200,
                                                    easingType: 'linear' 
                                            };
                                            */

                                            $().UItoTop({ easingType: 'easeOutQuart' });

                                    });
                            </script>
                                    <a href="#" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
                    </div>
            </div>
         </div>
<?php $this->endBody() ?>
<script type="text/javascript" src="<?= Yii::$app->request->baseUrl?>/js/responsiveslides.min.js"></script>
</body>
</html>
<?php $this->endPage() ?>
