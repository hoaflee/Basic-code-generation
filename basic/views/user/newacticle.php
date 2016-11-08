<?php
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

$this->title = 'Create acticle';
$this->params['breadcrumbs'][0] = ['label' => 'Resource', 'url' => ['user/resource']];
$this->params['breadcrumbs'][1] = 'Create acticle';

?>
<script src="<?= Yii::$app->request->baseUrl?>/js/ckeditor/ckeditor.js"></script>

<div class="well">
	<div class="col-lg-12">
		<div class="form-group">
		<label class="control-label col-xs-2"><h4>Your title :</h4></label>
			<div class="col-xs-10">
				<input type="text" id="title" class="form-control" placeholder="Inter your acticle's title">
			</div>
		</div>
	</div>

	<div class="col-lg-12">
		<div class="form-group">
		<label class="control-label col-xs-2"><h4>Add description :</h4></label>
			<div class="col-xs-10">
				<textarea style ="width: 100% !important;" rows="3" id="description">Short paragraph describing your article</textarea>
			</div>
		</div>
	</div>

	<div class="col-lg-12">
		<div class="form-group">
		<label class="control-label col-xs-2"><h4>Thumbnail image :</h4></label>
			<div class="col-xs-10">
				<input type="text" id="thumbnail" class="form-control" placeholder="inter image link for your acticle">
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12">
            <div class="col-md-12">
                <div class="alert alert-success">
                    Add content for your acticle
                </div>
            </div>
            <div class="col-lg-12">
                <textarea class="ckeditor" name="editor1" id="textarea_id"></textarea>
            </div>
            
            <form id="active-form" action="?r=mapreduce/savefile" method="post">
                <div class="col-md-12">
                    <div class="well text-right">
                        <button type="button" class="btn btn-primary btn-lg" id="saveButton">
                            <span class="glyphicon glyphicon-floppy-saved" aria-hidden="true"></span> Create
                        </button>                   
                    </div>
                </div>
            </form>

        </div>

</div>

<script>
    CKEDITOR.replace( 'textarea_id', {
    	height: '500'
    });
$('#saveButton').click(function(){
    	// alert( CKEDITOR.instances['textarea_id'].getData());
    if(confirm("Are you sure to create this acticle")){
        $.ajax({
            type: "POST",
            data:
                {
	                description: $("#description").val(),
	                content: CKEDITOR.instances['textarea_id'].getData(),
	                title: $("#title").val(),
	                thumbnail: $("#thumbnail").val(),
                },
            url: '?r=user/saveacticle',
            success: function(data) {
                alert(data);               
            }
        })
        $(this).hide();
    }
    });
</script>