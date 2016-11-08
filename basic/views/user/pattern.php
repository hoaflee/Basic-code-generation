<?php
/* @var $this yii\web\View */
$this->title = 'Mapreduce code generator';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
  <div class="row">
    <div class="col-md-8">
    	<?php
    	echo <<<EOF
    	<strong><i class="glyphicon glyphicon-dashboard"></i> {$pattern} Workspace</strong>      
<hr>
EOF;
    		foreach ($patternList as $pattern){
    			$url = Yii::$app->urlManager->createUrl(['user/gencode','pattern'=> $pattern->id]);
    			echo <<<EOF
    			<a href="{$url}" class="btn btn-primary btn-lg btn-block" role="button">
				{$pattern->name}        
        		</a>
      			</br>
EOF;
    		}
    	?> 
    </div>
</div>