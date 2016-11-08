<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
<?= Html::csrfMetaTags() ?>
<title><?= Html::encode($this->title) ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="<?= Yii::$app->request->baseUrl?>/css/bootstrap.min.css" rel="stylesheet">
<link href="<?= Yii::$app->request->baseUrl?>/css/font-awesome.min.css" rel="stylesheet" type="text/css">


</head>
<body>

<?php $this->beginBody() ?>

<!-- Main -->
<div class="container-fluid">
<div class="row">
<div id="top-nav" class="navbar navbar-inverse navbar-static-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">BiCoGe</a>
    </div>
    <div class="navbar-collapse collapse">
                      <ul class="nav navbar-nav navbar-right">
                <li><a href="index.php?r=user/signup"><i class="glyphicon glyphicon-user"></i> Signup</a></li>
                <li><a href="index.php?r=user/login"><i class="glyphicon glyphicon-lock"></i> Login</a></li>
              </ul>                            
    </div>
  </div>
</div>
    <div class="col-sm-12">
        <?= $content ?>
  </div>
</div>
</div>

<footer class="text-center">© Copyright 2014 BiCoGe, All rights reserved</footer>



<?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>
