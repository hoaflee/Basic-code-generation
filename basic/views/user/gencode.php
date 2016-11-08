<?php
/* @var $this yii\web\View */
#$this->title = 'Mapreduce code generator';
use app\models\DesignPatterns;
use app\models\MapreduceTemplate;
use app\models\MapChangeIndex;
use app\models\ReduceChangeIndex;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$mapChangeIndex = MapChangeIndex::find()
					->where(['pattern_id' => $pattern])
					->all();

$reduceChangeIndex = ReduceChangeIndex::find()
					->where(['pattern_id' => $pattern])
					->all();

?>
<?php $form = ActiveForm::begin(); ?>
<?= $form->field($chForm, 'changeList') ?>
<div class="col-md-9">
	<div class="panel panel-info">
        <div class="panel-heading">
            Mapper code generation
        </div>
        <div class="panel-body">
            <ul class="cbp_tmtimeline">
            	<?php
            		$c=1;
            		foreach ($mapChangeIndex as $mapChange){
            			echo <<<EOF
            			<li>
						<time class="cbp_tmtime"><span>Condition {$c}</span> <span></span></time>
						<div class="cbp_tmicon"><i class="fa fa-check"></i></div>
						<div class="cbp_tmlabel">
							<div class="row">
								<div class="col-md-6">
									<div class="panel panel-info">
				                        <div class="panel-heading">
				                            {$mapChange->key_change}
				                        </div>
				                        <div class="panel-body">
				                            <div class="form-group">
                                            <label>Text Input</label>
                                            <input class="form-control">
                                            <p class="help-block">Type of value: {$mapChange->type}</p>
                                        </div>
				                        </div>
			                        </div>
			                    </div>
			                    <div class="col-md-6">
									<div class="alert alert-success">
									<pre>
		                                {$mapChange->code_chane}
		                                </pre>
		                            </div>
			                    	<div class="alert alert-danger">
		                                {$mapChange->comment}
		                            </div>

			                    </div>
		                    </div>
						</div>
					</li>
EOF;
$c++;
					}
            	?>					
				</ul>
        </div>
    </div>
    <div class="panel panel-info">
        <div class="panel-heading">
            Reducer code generation
        </div>
        <div class="panel-body">
            <ul class="cbp_tmtimeline">
         	<?php
            		$c=1;
            		foreach ($reduceChangeIndex as $Change){
            			echo <<<EOF
            			<li>
						<time class="cbp_tmtime"><span>Condition {$c}</span> <span></span></time>
						<div class="cbp_tmicon"><i class="fa fa-check"></i></div>
						<div class="cbp_tmlabel">
							<div class="row">
								<div class="col-md-6">
									<div class="panel panel-info">
				                        <div class="panel-heading">
				                            {$Change->key_change}
				                        </div>
				                        <div class="panel-body">
				                            <div class="form-group">
                                            <label>Text Input</label>
                                            <input class="form-control">
                                            <p class="help-block">Type of value: {$Change->type}</p>
                                        </div>
				                        </div>
			                        </div>
			                    </div>
			                    <div class="col-md-6">
									<div class="alert alert-success">
									<pre>
		                                {$Change->code_chane}
										</pre>
		                            </div>
			                    	<div class="alert alert-danger">
		                                {$Change->comment}
		                            </div>

			                    </div>
		                    </div>
						</div>
					</li>
EOF;
$c++;
					}
            	?>		
            </ul>
        </div> 
        
</div>
<div class="well">

<?= Html::submitButton('Generation', ['class' => 'btn btn-success']) ?>

<button type="button" class="btn btn-warning">Reset</button>
</div>
<?php ActiveForm::end(); ?>
