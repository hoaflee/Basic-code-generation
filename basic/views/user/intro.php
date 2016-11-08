<?php
	/* @var $this yii\web\View */
	use app\models\ProgrammingModel;
	use app\models\DesignPatterns;
	use yii\widgets\Breadcrumbs;
	
	
$this->title = 'Mapreduce code generator';
$this->params['breadcrumbs'][] = $this->title;
	
	$Programming = ProgrammingModel::find()
					->where(['id' => $model])
	    			->one();
					
	$designPatterns = DesignPatterns::find()
					->where(['model_id' => $model])
					->all();
					
	$this->title = $Programming->name .' Introduction';
	$html = '';
	foreach ($designPatterns as $dp){
		$url = Yii::$app->urlManager->createUrl(['mapreduce/intro','pattern'=> $dp->id]);
		$des=strip_tags($dp->description);
		$html = $html .<<<EOF
		<a title="{$des}" href="{$url}" class="btn btn-primary btn-lg btn-block">
				{$dp->name}        
        </a>
      	</br>
EOF;
	}
	?>
<div class="col-md-9">

    <div class="row shop-tracking-status">
    <div class="order-status">
		<div class="order-status-timeline">
		    <!-- class names: c0 c1 c2 c3 and c4 -->
		    <div class="order-status-timeline-completion c0"></div>
			</div>

			<div class="image-order-status image-order-status-new active img-circle">
			    <span class="status"><b style="color: red">Select design</b></span>
			    <div class="icon"></div>
			</div>
			<div class="image-order-status image-order-status-active active img-circle">
			    <span class="status">Choose pattern </span>
			    <div class="icon"></div>
			</div>
			<div class="image-order-status image-order-status-intransit active img-circle">
			    <span class="status">Add conditions</span>
			    <div class="icon"></div>
			</div>
			<div class="image-order-status image-order-status-delivered active img-circle">
			    <span class="status">Edit Code</span>
			    <div class="icon"></div>
			</div>
			<div class="image-order-status image-order-status-completed active img-circle">
			    <span class="status">Completed</span>
			    <div class="icon"></div>
			</div>

		</div>
    </div>
<hr>
<strong><i class="glyphicon glyphicon-dashboard"></i> <?= $Programming->name ?> Introduction</strong>      
<hr>
	<div class="panel panel-info">
        <div class="panel-heading">
        	<div class="panel-heading">
		        <span class="panel-title"><i class="glyphicon glyphicon-bookmark"></i>  <?= $Programming->name ?> Decription</span>
		        <div class="btn-group pull-right">
		            <button title="See all description" class="btn btn-primary" data-toggle="collapse" data-target=".description"> <i class="fa fa-bars"></i>
		        </div>
		        <div class="clearfix"></div>
	    	</div>
        </div>
        <div class="panel-body">
        	<div class="collapse description">
            	<?=$Programming->description ?>
        	</div>
        	<h4>Please choose Design patterns:</h4>
        </div>
        <hr>
        <div class="well" style="max-width: 500px; margin: 0 auto 10px;">
        <?=$html ?>
        </div>
        <div class="panel-footer">
            Bicoge - <?=$Programming->name ?> code generation
        </div>
    </div>
</div>

<script>

</script>