<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\db\Query;
use yii\web\View;


use app\models\ProgrammingModel;
use app\models\DesignPatterns;
use app\models\Pattern;
use app\models\Message;
use app\models\Resource;
use app\models\UserInfo;

//$Programming = ProgrammingModel::find()	->all();	
//$designPatterns = DesignPatterns::find()->all();
$Programming = DesignPatterns::find() ->all();  
$designPatterns = Pattern::find()->all();

$userId = Yii::$app->user->identity->id;

$newMessage = Message::find()->where(['user_to' => $userId,'isNew' => '1'])->count();

$resources = Resource::find()->all();
$members = UserInfo::find()->all();
$source = [];
foreach ($resources as $resource ) {
    $source = array_merge($source, array(['id'=>Yii::$app->urlManager->createUrl(['user/acticle','id'=> $resource->id]),'name'=>$resource->title.' [Acticle]']));
}

foreach ($members as $member ) {
    $source = array_merge($source, array(['id'=>Yii::$app->urlManager->createUrl(['user/profile','user'=> $member->user_id]),'name'=>$member->lastname.' [User]']));
}

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
<?= Html::csrfMetaTags() ?>
<title><?= Html::encode($this->title) ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 
<!-- <meta charset="utf-8"> -->

<!-- <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> -->
<!-- <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet"> -->

<!-- <link rel="shortcut icon" href="http://www.bootply.com/bootstrap/img/favicon.ico">
<link rel="apple-touch-icon" href="http://www.bootply.com/bootstrap/img/apple-touch-icon.png">
<link rel="apple-touch-icon" sizes="72x72" href="http://www.bootply.com/bootstrap/img/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="114x114" href="http://www.bootply.com/bootstrap/img/apple-touch-icon-114x114.png"> -->
<!-- <link href="<?= Yii::$app->request->baseUrl?>/css/timeline.css" rel="stylesheet"> -->
<link href="<?= Yii::$app->request->baseUrl?>/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="<?= Yii::$app->request->baseUrl?>/css/bootstrap.min.css" rel="stylesheet">
<link href="<?= Yii::$app->request->baseUrl?>/css/sb-admin-2.css" rel="stylesheet">

<link href="<?= Yii::$app->request->baseUrl?>/css/ProcessSteps.css" rel="stylesheet">


<link rel="stylesheet" type="text/css" href="<?= Yii::$app->request->baseUrl?>/css/component.css" />
<!-- <script src="<?= Yii::$app->request->baseUrl?>/js/modernizr.custom.js"></script> -->


<link rel="stylesheet" type="text/css" href="<?= Yii::$app->request->baseUrl?>/css/jquery.dataTables.css"> 
<script type="text/javascript" src="<?= Yii::$app->request->baseUrl?>/js/jquery.min.js"></script>
<!-- <script src="<?= Yii::$app->request->baseUrl?>/js/jquery-1.10.2.min.js"></script> -->


<script type="text/javascript" charset="utf8" src="<?= Yii::$app->request->baseUrl?>/js/jquery.dataTables.js"></script> 
<script type="text/javascript" src="<?= Yii::$app->request->baseUrl?>/js/bootstrap.js"></script>
<script type="text/javascript" src="<?= Yii::$app->request->baseUrl?>/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?= Yii::$app->request->baseUrl?>/js/bootstrap-typeahead.js"></script>



<style type="text/css">
.navbar-static-top {
  margin-bottom:20px;
}

i {
  font-size:16px;
}

.nav > li > a {
  color:#787878;
}
  
footer {
  margin-top:20px;
  padding-top:20px;
  padding-bottom:20px;
  background-color:#efefef;
}

/* count indicator near icons */
.nav>li .count {
  position: absolute;
  bottom: 12px;
  right: 6px;
  font-size: 9px;
  background: rgba(51,200,51,0.55);
  color: rgba(255,255,255,0.9);
  line-height: 1em;
  padding: 2px 4px;
  -webkit-border-radius: 10px;
  -moz-border-radius: 10px;
  -ms-border-radius: 10px;
  -o-border-radius: 10px;
  border-radius: 10px;
}

/* indent 2nd level */
.list-unstyled li > ul > li {
   margin-left:10px;
   padding:8px;
}
</style>

<style id="style-1-cropbar-clipper">
.en-markup-crop-options {
    top: 18px !important;
    left: 50% !important;
    margin-left: -100px !important;
    width: 200px !important;
    border: 2px rgba(255,255,255,.38) solid !important;
    border-radius: 4px !important;
}

.en-markup-crop-options div div:first-of-type {
    margin-left: 0px !important;
}

</style>

</head>
<body>

<?php $this->beginBody() ?>

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
      <?php
          if (Yii::$app->user->isGuest) {
              echo<<<EOF
                <ul class="nav navbar-nav navbar-right">
                <li><a href="index.php?r=user/signup"><i class="glyphicon glyphicon-user"></i> Signup</a></li>
                <li><a href="index.php?r=user/login"><i class="glyphicon glyphicon-lock"></i> Login</a></li>
              </ul>                              
EOF;
          } else {
            $username = Yii::$app->user->identity->username;
            $userID = Yii::$app->user->identity->id;
            $urlManagercode = Yii::$app->urlManager->createUrl(['user/managercode','user'=> $userID]);
            $urlProfile = Yii::$app->urlManager->createUrl(['user/profile','user'=> $userID]);
            echo<<<EOF
              <ul class="nav navbar-nav navbar-right">        
              <li class="dropdown">
                <a role="button" class="dropdown-toggle" id="dLabel" data-toggle="dropdown" href="#"><i class="glyphicon glyphicon-user"></i> {$username} ({$newMessage})<span class="caret"></span></a>
                <ul id="g-account-menu" aria-labelledby="dLabel" class="dropdown-menu" role="menu">
                  <li><a href="{$urlProfile}"><i class="fa fa-user fa-fw"></i> User Profile</a></li>
                  <li><a href="{$urlManagercode}"><i class="fa fa-sign-out fa-fw"></i> Code manager</a></li>
                  <li class="divider"></li>
                  <li><a href="?r=user/message" ><i class="fa fa-comments fa-fw"></i>Message ({$newMessage})</a></li>
                </ul>
              </li>
              <li><a href='/dack/basic/web/index.php?r=user/logout' data-method='post'><i class="glyphicon glyphicon-lock"></i> Logout</a></li>
            </ul>
EOF;
          }
      ?>
    </div>
  </div>
</div>

<div class="container-fluid">
<div class="row">
  <div class="col-sm-2">


        <div class="form-group has-feedback">
          <label for="search" class="sr-only">Search</label>
          <input type="text" data-provide="typeahead" class="form-control" name="search" id="demo1" placeholder="search" >
            <span class="glyphicon glyphicon-search form-control-feedback"></span>
        </div>


      <hr>
      <strong class="text-primary"><a href="?r=user/intro&model=mapreduce"><i class="glyphicon glyphicon-list" style="margin: 0px auto 10px auto;"></i>  Design pattern</a></strong>
      <ul class="list-unstyled list-group" >
      <?php
      		function designPaternsSearch($model,$designPatterns)
			{
				$html = '';
				foreach ($designPatterns as $dp){
					if($dp->design_patterns_id == $model){
						$html = $html.'<li><a href="'.Yii::$app->urlManager->createUrl(['mapreduce/gencode','pattern'=> $dp->id]).'">'.$dp->name. '</a></li>';
					}
				}
				return $html;
			}
      		$count = 0;
      		foreach ($Programming as $model){	      		
				$html = '';
				$html = designPaternsSearch($model->id,$designPatterns);
	      		$count ++;
				echo <<<EOF
				<li class="nav-header list-group-item"> <a data-toggle="collapse" data-target="#menu{$count}">
	          <h4>{$model->name} <i class="glyphicon glyphicon-chevron-right" style="float:right;"></i></h4>
	          </a>
	          <ul class="collapse" id="menu{$count}">
	          {$html}
	          </ul>
	   </li>
EOF;
					
	}
      ?>
      </ul>
          
      <hr>
        <a href="?r=user/resource" class="text-default"><h4><i class="glyphicon glyphicon-link"></i> Resources </h4></a>  
      <hr>
        <a href="?r=user/contact" class="text-info"><strong><i class="fa fa-paper-plane-o"></i> Contact Us</strong></a>  
      <hr>      
     
    </div>

    <div class="col-sm-10">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
  </div>
</div>
</div>

<!-- <div class="modal" id="addWidgetModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">Add Widget</h4>
      </div>
      <div class="modal-body">
        <p>Add a widget stuff here..</p>
      </div>
      <div class="modal-footer">
        <a href="#" data-dismiss="modal" class="btn">Close</a>
        <a href="#" class="btn btn-primary">Save changes</a>
      </div>
    </div>
  </div>
</div>
 -->

 <script type='text/javascript'>
 (function($){
    $('.dropdown-toggle').dropdown();
})(jQuery);

        
  $(document).ready(function() {      

    $('[data-toggle=collapse]').click(function(){
    $(this).find("i").toggleClass("glyphicon-chevron-right glyphicon-chevron-down");
      });
    });
// $('.typeahead').typeahead();
function displayResult(item, val, text) {
    console.log(item);
    window.location = val;
    // alert('You selected <strong>' + val + '</strong>: <strong>' + text + '</strong>');
}

$('#demo1').typeahead({
  <?php echo("source:".json_encode($source).",");
?>

        itemSelected: displayResult
    });


        
</script>
<!--         
        <script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
          ga('create', 'UA-40413119-1', 'bootply.com');
          ga('send', 'pageview');
        </script>
         -->
<footer class="text-center">© Copyright 2014 BiCoGe, All rights reserved</footer>

<?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>
