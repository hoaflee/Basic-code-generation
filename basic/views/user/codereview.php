<?php
use app\models\DesignPatterns;
use app\models\MapreduceTemplate;
use app\models\MapChangeIndex;
use app\models\ReduceChangeIndex;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\models\Comment;

$this->title = $UserCode->name.' Review';
$this->params['breadcrumbs'][0] = ['label' => 'Code manager', 'url' => ['user/managercode','user'=>Yii::$app->user->identity->id]];
$this->params['breadcrumbs'][1] = $this->title;
$this->title = $UserCode->name.' Review';
$userComment = Comment::find()
            ->where(['code_id' => $UserCode->id])
            ->orderBy('create_date')
            ->all();
//var_dump($userComment);
?>
<link rel="stylesheet" href="<?= Yii::$app->request->baseUrl?>/lib/codemirror.css">
<script src="<?= Yii::$app->request->baseUrl?>/lib/codemirror.js"></script>
<script src="<?= Yii::$app->request->baseUrl?>/addon/edit/matchbrackets.js"></script>
<script src="<?= Yii::$app->request->baseUrl?>/js/python.js"></script>

<!-- theme -->
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
    <div class="col-lg-12">
        <div class="row">
            <div class="col-md-4">
                <h2><?php echo $UserCode->name; ?></h2>     
                <p id="code_id" name="<?= $UserCode->id ?>" style="margin-top:10px">Design Pattern: <em class="text-primary"><?php echo($UserCode->designPatterns->name).' / ';echo $UserCode->pattern0->name; ?></em></p>

            </div>
            <div class="col-md-2 col-md-offset-6">
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
            <hr>
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?= $UserCode->name?> Description
                </div>
                <div class="panel-body">
                    <?= $UserCode->description?>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Mapper
                    </div>
                    <div class="panel-body">
                        <textarea class=”form-control”  style ="width: 100% !important;" rows="30" id="code-map-python"><?= $UserCode->map?></textarea>
                    </div>
                    <!-- /.panel-body -->
                </div>
            </div>
            <div class="col-lg-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Reducer
                    </div>
                    <div class="panel-body">
                        <textarea class=”form-control”  style ="width: 100% !important;" rows="30" id="code-reduce-python"><?= $UserCode->reduce?></textarea>
                    </div>
                    <!-- /.panel-body -->
                </div>
            </div>
        </div>
        <!-- /.panel -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-info">
            <div class="panel-heading">
                COMMENT
            </div>
            <div class="panel-body">
            <ul class="media-list" id="commentBox">
<?php
foreach ($userComment as $comment){
    //var_dump();
    echo <<<EOF
                 <li class="media">
                    <div>
                        <div class="media">
                            <a class="pull-left">
                                <img class="media-object img-circle " src="{$comment->owner0->user_image}" style="width:64px; height 64px;">
                            </a>
                            <button class="btn btn-link pull-right" name="deleteCmBt" id="{$comment->id}">
                                <span class="glyphicon glyphicon-remove" title="Delete this comment">
                            </button>
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
    </div>
    <!-- /.col-lg-12 -->
</div>
<script>
    var mapEditor = CodeMirror.fromTextArea(document.getElementById("code-map-python"), {
        mode: {name: "python",
               version: 3,
               singleLineStringErrors: false},
        lineNumbers: true,
        indentUnit: 4,
        matchBrackets: true
    });
    var reduceEditor = CodeMirror.fromTextArea(document.getElementById("code-reduce-python"), {
        mode: {name: "python",
               version: 3,
               singleLineStringErrors: false},
        lineNumbers: true,
        indentUnit: 4,
        matchBrackets: true
    });
    mapEditor.setSize(-1,500);
    reduceEditor.setSize(-1,500);

  var input = document.getElementById("select");
  function selectTheme() {
    var theme = input.options[input.selectedIndex].innerHTML;
    mapEditor.setOption("theme", theme);
    reduceEditor.setOption("theme", theme);
  }

  $("#sendComment").click(function (){
    //alert($('#yourComment').val());
    if($("#yourComment").val()) {
        $.ajax({
                    type: "POST",
                    data:
                    {
                        content: $('#yourComment').val(),
                        code_id: $("#code_id").attr('name'),
                    },
                    url: '?r=user/comment',
                    success: function(data) {
                        $("#yourComment").val('');

                        location.reload();
                    }
                })
    };
  });

$('button[name="deleteCmBt"]').click(function(){
    if(confirm("Are you sure to delete this comment")){
        //alert(this.id);
        $.ajax({
                type: "POST",
                data:
                {
                    code_id:this.id,
                },
                url: '?r=user/deletecomment',
                success: function(data) {       
                    location.reload();         
                    //alert(data);
                }
            })
    }
});
</script>
