<?php
use app\models\Resource;
use app\models\UserInfo;
use app\models\User;

/* @var $this yii\web\View */
$this->title = 'Home';
$this->params['breadcrumbs'][] ='';
?>

<div class="row">
	<div class="col-md-9">
		<div class="panel panel-info">
            <div class="panel-heading">
            	<h4><span><i class="glyphicon glyphicon-bookmark"></i>  Shortcuts</span></h4>
                <!-- <h4>Shortcuts</h4> -->
            </div>
            <div class="panel-body">
            	<div class="row">
	                <div class="col-lg-2 col-md-6">
	                    <div class="panel panel-primary">
	                        <div class="panel-heading">
	                            <div class="row">
	                                <div class="col-xs-3">
	                                    <i class="fa fa-magic fa-5x"></i>
	                                </div>
	                                <div class="col-xs-9 text-right">
	                                    <div>BiCoGe</br>Code</br>Generation</div>
	                                </div>
	                            </div>
	                        </div>
	                        <a href="?r=user/intro&model=mapreduce">
	                            <div class="panel-footer">
	                                <span class="pull-left">View Details</span>
	                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
	                                <div class="clearfix"></div>
	                            </div>
	                        </a>
	                    </div>
	                </div>
	                <div class="col-lg-2 col-md-6">
	                    <div class="panel panel-green">
	                        <div class="panel-heading">
	                            <div class="row">
	                                <div class="col-xs-3">
	                                    <i class="glyphicon glyphicon-cog fa-5x"></i>
	                                </div>
	                                <div class="col-xs-9 text-right">
	                                    <div>Code Manager</div>
	                                </div>
	                            </div>
	                        </div>
	                        <a href='<?= Yii::$app->urlManager->createUrl(['user/managercode','user'=> Yii::$app->user->identity->id])?>'>
	                            <div class="panel-footer">
	                                <span class="pull-left">View Details</span>
	                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
	                                <div class="clearfix"></div>
	                            </div>
	                        </a>
	                    </div>
	                </div>
	                <div class="col-lg-2 col-md-6">
	                    <div class="panel panel-yellow">
	                        <div class="panel-heading">
	                            <div class="row">
	                                <div class="col-xs-3">
	                                    <i class="fa fa-comments-o fa-5x"></i>
	                                </div>
	                                <div class="col-xs-9 text-right">
	                                    <div>Message</div>
	                                </div>
	                            </div>
	                        </div>
	                        <a href="?r=user/message">
	                            <div class="panel-footer">
	                                <span class="pull-left">View Details</span>
	                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
	                                <div class="clearfix"></div>
	                            </div>
	                        </a>
	                    </div>
	                </div>
	                
	                <div class="col-lg-2 col-md-6">
	                    <div class="panel panel-info">
	                        <div class="panel-heading">
	                            <div class="row">
	                                <div class="col-xs-3">
	                                    <i class="fa fa-newspaper-o fa-5x"></i>
	                                </div>
	                                <div class="col-xs-9 text-right">
	                                    <div>BigData</br>News</div>
	                                </div>
	                            </div>
	                        </div>
	                        <a href="?r=user/resource">
	                            <div class="panel-footer">
	                                <span class="pull-left">View Details</span>
	                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
	                                <div class="clearfix"></div>
	                            </div>
	                        </a>
	                    </div>
	                </div>
	                <div class="col-lg-2 col-md-6">
	                    <div class="panel panel-red">
	                        <div class="panel-heading">
	                            <div class="row">
	                                <div class="col-xs-3">
	                                    <i class="fa fa-database fa-5x"></i>
	                                </div>
	                                <div class="col-xs-9 text-right">
	                                    <div>Resource</div>
	                                </div>
	                            </div>
	                        </div>
	                        <a href="?r=user/resource">
	                            <div class="panel-footer">
	                                <span class="pull-left">View Details</span>
	                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
	                                <div class="clearfix"></div>
	                            </div>
	                        </a>
	                    </div>
	                </div>
	                <div class="col-lg-2 col-md-6">
	                    <div class="panel panel-danger">
	                        <div class="panel-heading">
	                            <div class="row">
	                                <div class="col-xs-3">
	                                    <i class="fa fa-paper-plane-o fa-5x"></i>
	                                </div>
	                                <div class="col-xs-9 text-right">
	                                    <div>Contact</div>
	                                </div>
	                            </div>
	                        </div>
	                        <a href="?r=user/contact">
	                            <div class="panel-footer">
	                                <span class="pull-left">View Details</span>
	                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
	                                <div class="clearfix"></div>
	                            </div>
	                        </a>
	                    </div>
	                </div>
	            </div>
            </div>
        </div>

		<div class="panel panel-info">
            <div class="panel-heading">
            	<h4><span><i class="fa fa-list-alt"></i>  BigData's acticle</span></h4>            </div>
            <div class="panel-body">
<?php
	$resource = Resource::find()->limit(4)->all(); 
    foreach ($resource as $rs) {
        echo <<<EOF
        <div class="well">
          <div class="media">
            <div class="media-body">
                <div class="row">
                    <div class="col-md-2">
                        <img style="width:100%; height 100%;" src="{$rs->thumbnail}" alt="post img" class="pull-left img-responsive thumb margin10 img-thumbnail">
                    </div>
                    <div class="col-md-10">
                        <a href="?r=user/acticle&id={$rs->id}"><h3 class="media-heading text-primary">{$rs->title}</h3></a>
                        <p class="text-right">Posted by <a href="?r=user/profile&user={$rs->author0->user_id}">{$rs->author0->lastname}</a></p>
                        <p>{$rs->decription}</p>
                      <ul class="list-inline list-unstyled">
                        <li><span><i class="glyphicon glyphicon-calendar"></i> {$rs->create_date} </span></li>
                        <li>|</li>
                        <span><i class="glyphicon glyphicon-comment"></i> {$rs->countComment()} comments</span> 
                        </ul>
                    </div>
                </div>
           </div>
        </div>
      </div>
EOF;
    }
?>
            </div>
            <div class="panel-footer" style="text-align:right">
                <a href="?r=user/resource"><small>See more</small></a>
            </div>
        </div>
	</div>

	<div class="col-md-3">
		<div class="panel panel-info">
            <div class="panel-heading">
                <h4><span><i class="fa fa-star-o"></i>  Welcome</span></h4>
            </div>
            <div class="panel-body">
                <p>BiCoGe will provide some common patterns with sample data that will help you to use map-reduce easily and effectively, save your time. BiCoGe is also a community where people share code, support to each other, and learn more about big data, technologies together. Join with us and enjoy it.</p>
            </div>
            
        </div>
        <div class="panel panel-info">
            <div class="panel-heading">
                <h4><span><i class="fa fa-users"></i>  New members</span></h4>
            </div>
            <div class="panel-body">
<?php
	$members = UserInfo::find()->limit(10)->orderBy('id desc')->all(); 
	foreach ($members as $member) {
		$desc= substr($member->job_description,0,60).'...';
        echo <<<EOF
        <div class="well">
            <div class="row">
                <div class="col-md-3">
                    <img class="media-object img-circle border-radius" src="{$member->user_image}" style="width:64px; height 64px;">
                </div>
                <div class="col-md-9">
                   <h4 class="text-muted"><a href="" class="text-primary">{$member->lastname}</a></h4>
                   <small><span class="text-danger"><i class="glyphicon glyphicon-calendar"></i> {$member->joined_date} </span></small>
                   <p>{$desc}</p>
                </div>
            </div>
        </div>
EOF;
	}
?>
            </div>
            <div class="panel-footer" style="text-align:right">
                <a href="?r=user/alluser"><small>All User</small></a>
            </div>
            
        </div>
	</div>
</div>