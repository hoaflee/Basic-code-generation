<?php
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

$this->title = $resource->title;
$this->params['breadcrumbs'][0] = ['label' => 'Resource', 'url' => ['user/resource']];
$this->params['breadcrumbs'][1] = $resource->title;

$userPage = Yii::$app->urlManager->createUrl(['user/profile','user'=> $resource->author0->user_id]);

?>

	<div class="panel panel-default" id="resource_id" name='<?= $resource->id ?>'>
        <div class="panel-heading">
            <h2><?= $resource->title ?></h2>
        </div>
        <div class="panel-body">
        	<small><span><i class="glyphicon glyphicon-calendar"></i> <?= $resource->create_date ?> </span> </small>| Posted by<a href='<?= $userPage?>'> <?= $resource->author0->lastname ?></a>
        	<hr>
            <?=$resource->content ?>
        </div>
        <div class="panel-footer">
        </div>
    </div>

    <div class="row">
	    <div class="col-lg-12">
	        <div class="panel panel-info">
		        <div class="panel-heading">
		            COMMENT
		        </div>
		        <div class="panel-body">
			        <ul class="media-list" id="commentBox">
<?php
foreach ($comments as $comment){
    //var_dump();
    echo <<<EOF
                 <li class="media">
                    <div>
                        <div class="media">
                            <a class="pull-left">
                                <img class="media-object img-circle " src="{$comment->owner0->user_image}" style="width:64px; height 64px;">
                            </a>
                            <div>{$comment->content}
                                <br>
                               <small class="text-muted"><a href="?r=user/profile&user={$comment->owner0->user_id}" class="text-primary">{$comment->owner0->lastname} </a>| {$comment->create_date}</small>
                                <hr>
                            </div>
                        </div>
                    </div>
                </li>
EOF;
}
?>
			        </ul>
			    </div>
		        <div class="panel-footer">
		            <div class="input-group">
		                <input type="text" class="form-control" id="yourComment" placeholder="Enter Your Comment">
		                <span class="input-group-btn">
		                    <button class="btn btn-info" id="sendComment" type="button">SEND</button>
		                </span>
		            </div>
		        </div>
		    </div>
	    </div>
    </div>

<script>
  $("#sendComment").click(function (){
  	//alert($("#resource_id").attr('name'));
    if($("#yourComment").val()) {
        $.ajax({
            type: "POST",
            data:
            {
                content: $('#yourComment').val(),
                code_id: $("#resource_id").attr('name'),
                type:'resource',
            },
            url: '?r=user/comment',
            success: function(data) {
                $("#yourComment").val('');

                location.reload();
            }
        })
    };
  });
</script>