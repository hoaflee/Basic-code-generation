<?php
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;


$this->title = 'Resource';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="well">
    <a href="?r=user/newacticle"><button type="button" class="btn btn-success" >Create new</button></a>
</div>
<?php
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
        # code...
    }
?>
  
