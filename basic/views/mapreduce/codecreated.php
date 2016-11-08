<?php
/* @var $this yii\web\View */
#$this->title = 'Mapreduce code generator';
use app\models\DesignPatterns;
use app\models\MapreduceTemplate;
use app\models\ReduceChangeIndex;
use app\models\CreateCode;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use dosamigos\ckeditor\CKEditor;
use dosamigos\ckeditor\CKEditorInline;
use app\models\UserCode;
use app\models\Pattern;

$code = CreateCode::createCode($pattern,$chForm);
$UserCode = new UserCode();
$patternName = Pattern::find()
            ->where(['id' => $pattern])
            ->one();

$this->title = $patternName->name.' code generator';
$this->params['breadcrumbs'][0] =['label' => 'Mapreduce generator', 'url' => ['user/intro','model'=>'mapreduce']];
$this->params['breadcrumbs'][1] = ['label' => $patternName->designPatterns->name, 'url' => ['mapreduce/intro','pattern'=>$patternName->designPatterns->id]];
$this->params['breadcrumbs'][2] = ['label' => $patternName->name, 'url' => ['mapreduce/gencode','pattern'=>$patternName->id]];
$this->params['breadcrumbs'][3] = $patternName->name.' edit code';

?>
<link rel="stylesheet" href="<?= Yii::$app->request->baseUrl?>/lib/codemirror.css">
<script src="<?= Yii::$app->request->baseUrl?>/lib/codemirror.js"></script>
<script src="<?= Yii::$app->request->baseUrl?>/addon/edit/matchbrackets.js"></script>
<script src="<?= Yii::$app->request->baseUrl?>/js/python.js"></script>
<script src="<?= Yii::$app->request->baseUrl?>/js/ckeditor/ckeditor.js"></script>
<!-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet"> -->


<link rel="stylesheet" href="<?= Yii::$app->request->baseUrl?>/theme/3024-day.css">
<link rel="stylesheet" href="<?= Yii::$app->request->baseUrl?>/theme/3024-night.css">
<link rel="stylesheet" href="<?= Yii::$app->request->baseUrl?>/theme/ambiance.css">
<link rel="stylesheet" href="<?= Yii::$app->request->baseUrl?>/theme/base16-dark.css">
<link rel="stylesheet" href="<?= Yii::$app->request->baseUrl?>/theme/base16-light.css">
<link rel="stylesheet" href="<?= Yii::$app->request->baseUrl?>/theme/blackboard.css">
<link rel="stylesheet" href="<?= Yii::$app->request->baseUrl?>/theme/cobalt.css">
<link rel="stylesheet" href="<?= Yii::$app->request->baseUrl?>/theme/eclipse.css">
<link rel="stylesheet" href="<?= Yii::$app->request->baseUrl?>/theme/elegant.css">
<link rel="stylesheet" href="<?= Yii::$app->request->baseUrl?>/theme/erlang-dark.css">
<link rel="stylesheet" href="<?= Yii::$app->request->baseUrl?>/theme/lesser-dark.css">
<link rel="stylesheet" href="<?= Yii::$app->request->baseUrl?>/theme/mbo.css">
<link rel="stylesheet" href="<?= Yii::$app->request->baseUrl?>/theme/mdn-like.css">
<link rel="stylesheet" href="<?= Yii::$app->request->baseUrl?>/theme/midnight.css">
<link rel="stylesheet" href="<?= Yii::$app->request->baseUrl?>/theme/monokai.css">
<link rel="stylesheet" href="<?= Yii::$app->request->baseUrl?>/theme/neat.css">
<link rel="stylesheet" href="<?= Yii::$app->request->baseUrl?>/theme/neo.css">
<link rel="stylesheet" href="<?= Yii::$app->request->baseUrl?>/theme/night.css">
<link rel="stylesheet" href="<?= Yii::$app->request->baseUrl?>/theme/paraiso-dark.css">
<link rel="stylesheet" href="<?= Yii::$app->request->baseUrl?>/theme/paraiso-light.css">
<link rel="stylesheet" href="<?= Yii::$app->request->baseUrl?>/theme/pastel-on-dark.css">
<link rel="stylesheet" href="<?= Yii::$app->request->baseUrl?>/theme/rubyblue.css">
<link rel="stylesheet" href="<?= Yii::$app->request->baseUrl?>/theme/solarized.css">
<link rel="stylesheet" href="<?= Yii::$app->request->baseUrl?>/theme/the-matrix.css">
<link rel="stylesheet" href="<?= Yii::$app->request->baseUrl?>/theme/tomorrow-night-eighties.css">
<link rel="stylesheet" href="<?= Yii::$app->request->baseUrl?>/theme/twilight.css">
<link rel="stylesheet" href="<?= Yii::$app->request->baseUrl?>/theme/vibrant-ink.css">
<link rel="stylesheet" href="<?= Yii::$app->request->baseUrl?>/theme/xq-dark.css">
<link rel="stylesheet" href="<?= Yii::$app->request->baseUrl?>/theme/xq-light.css">


<link rel="stylesheet" href="<?= Yii::$app->request->baseUrl?>/addon/hint/show-hint.css">
<script src="<?= Yii::$app->request->baseUrl?>/addon/hint/show-hint.js"></script>
<script src="<?= Yii::$app->request->baseUrl?>/addon/hint/javascript-hint.js"></script>
<style type="text/css">

.detailBox {
    width:97%;
    border:1px solid #bbb;
    margin:50px;
}
.titleBox {
    background-color:#fdfdfd;
    padding:10px;
}
.titleBox label{
  color:#444;
  margin:0;
  display:inline-block;
}

.commentBox {
    padding:10px;
    border-top:1px dotted #bbb;
}
.commentBox .form-group:first-child, .actionBox .form-group:first-child {
    width:100%;
}
.commentBox .form-group:nth-child(2), .actionBox .form-group:nth-child(2) {
    width:10%;
}
.actionBox .form-group * {
    width:100%;
}
.taskDescription {
    margin-top:10px 0;
}
.commentList {
    padding:0;
    list-style:none;
    max-height:200px;
    overflow:auto;
}
.commentList li {
    margin:0;
    margin-top:10px;
}
.commentList li > div {
    display:table-cell;
}
.commenterImage {
    width:30px;
    margin-right:5px;
    height:100%;
    float:left;
}
.commenterImage img {
    width:100%;
    border-radius:50%;
}
.commentText p {
    margin:0;
}
.sub-text {
    color:#aaa;
    font-family:verdana;
    font-size:11px;
}
.actionBox {
    border-top:1px dotted #bbb;
    padding:10px;
}
</style>

<div class="row">
    <div class="col-lg-11" style="">
    <div class="row shop-tracking-status">
          <div class="order-status" style="margin-left: 15px;">
              <div class="order-status-timeline">
                  <!-- class names: c0 c1 c2 c3 and c4 -->
                  <div class="order-status-timeline-completion c3" id="main-step"></div>
                  </div>

                  <div class="image-order-status image-order-status-new active img-circle">
                      <span class="status">Select design</span>
                      <div class="icon"></div>
                  </div>
                  <div class="image-order-status image-order-status-active active img-circle">
                      <span class="status">Choose pattern</span>
                      <div class="icon"></div>
                  </div>
                  <div class="image-order-status image-order-status-intransit active img-circle">
                      <span class="status">Add conditions</span>
                      <div class="icon"></div>
                  </div>
                  <div class="image-order-status image-order-status-delivered active img-circle">
                      <span class="status"><b style="color: red" id="edit-step">Edit Code</b></span>
                      <div class="icon"></div>
                  </div>
                  <div class="image-order-status image-order-status-completed active img-circle">
                      <span class="status">Completed</span>
                      <div class="icon"></div>
                  </div>

              </div>
          </div>
  </div>
  <div class="col-lg-12">
        <hr>
        <div class="well">
            <div class="row">            
                <div class="col-md-6">
                    <h2 class="text-info" id="codeName"><?= $chForm->codeName; ?></h2>     
                    <p>Design Pattern: <em class="text-primary"><?= $patternName->designPatterns->name ?> / </em><em class="text-primary" id="pattern" value="<?= $pattern ?>"><?= $patternName->name; ?></em></p>
                </div>
                <div class="col-md-2 col-md-offset-4">
                    <p>Select a theme:</p>
                        <select onchange="selectTheme()" id="select" class="form-control">
                            <option selected>default</option>
                            <option>3024-day</option>
                            <option>3024-night</option>
                            <option>ambiance</option>
                            <option>base16-dark</option>
                            <option>base16-light</option>
                            <option>blackboard</option>
                            <option>cobalt</option>
                            <option>eclipse</option>
                            <option>elegant</option>
                            <option>erlang-dark</option>
                            <option>lesser-dark</option>
                            <option>mbo</option>
                            <option>mdn-like</option>
                            <option>midnight</option>
                            <option>monokai</option>
                            <option>neat</option>
                            <option>neo</option>
                            <option>night</option>
                            <option>paraiso-dark</option>
                            <option>paraiso-light</option>
                            <option>pastel-on-dark</option>
                            <option>rubyblue</option>
                            <option>solarized dark</option>
                            <option>solarized light</option>
                            <option>the-matrix</option>
                            <option>tomorrow-night-eighties</option>
                            <option>twilight</option>
                            <option>vibrant-ink</option>
                            <option>xq-dark</option>
                            <option>xq-light</option>
                        </select>                
                </div>
            </div>
        </div>
            <hr>
        <div class="row">
            <div class="col-lg-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Mapper
                    </div>
                    <div class="panel-body">
                        <textarea class=”form-control”  style ="width: 100% !important;" rows="30" id="code-map-python"><?= $code['map_code']?></textarea>
                    </div>

                </div>
            </div>
            <div class="col-lg-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Reducer
                    </div>
                    <div class="panel-body">
                        <textarea class=”form-control”  style ="width: 100% !important;" rows="30" id="code-reduce-python"><?= $code['reduce_code']?></textarea>
                    </div>

                </div>
            </div>
            <div  class="col-lg-12">
                <p id="hind" class="text-muted"> <small>You are in readonly mode</small></p>
            </div>
            
        </div>

    </div>

    <div class="col-lg-12">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-success">
                    Add decription for your code<button type="button" class="btn btn-primary pull-right" onclick="editCode()" id="editButton">Edit generated code</button>
                </div>
            </div>
            <div class="col-lg-12">
                <textarea class="ckeditor" name="editor1" id="textarea_id"></textarea>
                <hr>
            </div>
            
            <form id="active-form" action="?r=mapreduce/savefile" method="post">
                <div class="col-md-12">
                    <div class="well text-right">
                        <button type="button" class="btn btn-primary btn-lg" id="saveButton">
                            <span class="glyphicon glyphicon-floppy-saved" aria-hidden="true"></span> Save
                        </button>                   
                    </div>
                </div>
            </form>

        </div>
    </div>

</div>
<!-- <button type="button" class="btn btn-primary pull-right" id="test_button">test</button> -->
<script>

    var mapEditor = CodeMirror.fromTextArea(document.getElementById("code-map-python"), {
        mode: {name: "python",
               version: 3,
               singleLineStringErrors: false},
        lineNumbers: true,
        indentUnit: 4,
        matchBrackets: true,
        readOnly: true,
        extraKeys: {"Ctrl-Space": "autocomplete"},
    });
    var reduceEditor = CodeMirror.fromTextArea(document.getElementById("code-reduce-python"), {
        mode: {name: "python",
               version: 3,
               singleLineStringErrors: false},
        lineNumbers: true,
        indentUnit: 4,
        matchBrackets: true,
        readOnly: true,
        extraKeys: {"Ctrl-Space": "autocomplete"},
    });
    mapEditor.setSize(-1,500);
    reduceEditor.setSize(-1,500);

  var input = document.getElementById("select");
  function selectTheme() {
    var theme = input.options[input.selectedIndex].innerHTML;
    mapEditor.setOption("theme", theme);
    reduceEditor.setOption("theme", theme);
  }

    CKEDITOR.replace( 'textarea_id', {
        uiColor: '#A9D0F5'
    });

function editCode(){
    mapEditor.setOption("readOnly", false);
    reduceEditor.setOption("readOnly", false);
    $("#hind").text("You are in editable mode, Press ctrl-space to activate autocompletion.");
    $("#editButton").text("Editable mode");
    $("#editButton").attr('disabled','disabled');
}

    $('#saveButton').click(function(){
        //alert();
        $.ajax({
            type: "POST",
            data:
                {
                mapCode: mapEditor.getValue(),
                reduceCode: reduceEditor.getValue(),
                description: CKEDITOR.instances['textarea_id'].getData(),
                nameCode: $("#codeName").text(),
                pattern: $("#pattern").attr('value'),
                },
            url: '?r=mapreduce/savecode',
            success: function(data) {
                alert(data);
            }
        })
    $("#edit-step").removeAttr("style");
    $(".image-order-status-completed").remove();
    $(".order-status-timeline").append('<div class="image-order-status image-order-status-completed active img-circle"><span class="status"><b style="color: red">Completed</b></span><div class="icon"></div></div>');
    $("#main-step").attr('class','order-status-timeline-completion c4');
    });
</script>