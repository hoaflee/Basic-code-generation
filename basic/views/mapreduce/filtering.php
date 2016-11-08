<?php
/* @var $this yii\web\View */
#$this->title = 'Mapreduce code generator';
use app\models\DesignPatterns;
use app\models\MapreduceTemplate;
use app\models\MapChangeIndex;
use app\models\ReduceChangeIndex;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\models\Pattern;

$patternName = Pattern::find()
            ->where(['id' => $pattern])->one();

$this->title = $patternName->name.' code generator';
$this->params['breadcrumbs'][0] =['label' => 'Mapreduce generator', 'url' => ['user/intro','model'=>'mapreduce']];
$this->params['breadcrumbs'][1] = ['label' => $patternName->designPatterns->name, 'url' => ['mapreduce/intro','pattern'=>$patternName->designPatterns->id]];
$this->params['breadcrumbs'][2] = $patternName->name;

?>

<?php $form = ActiveForm::begin([
    'id' => 'active-form',
  ]); ?>

<div class="col-md-9">
    <div class="row shop-tracking-status">
      <div class="order-status">
          <div class="order-status-timeline">
              <div class="order-status-timeline-completion c2"></div>
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
                  <span class="status"><b style="color: red">Add conditions</b></span>
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
	<div class="panel panel-primary">
        <div class="panel-heading">
            <?=$patternName->name ?> code generation
        </div>
        <div class="panel-body">
           <div class="form-group">
              <label class="control-label col-xs-2" style="text-align:right">CodeName</label>
              <div class="col-xs-10">
                  <input type="text" id="codeName" class="form-control" placeholder="file's name after generated" required>
                  <p class="help-block">Code name will be display on Code manager page</p>
              </div>
           </div>

	        <div class="form-group">
                <label class="control-label col-xs-2" style="text-align:right">Data input</label>
                <div class="col-xs-10">
                	<div class="well">
                		<div class="form-group">
                            <label>Type of Input data</label>
                            <select class="form-control" id="inputType">
                                <option selected>text</option>
                                <option>csv</option>
                                <option>xml</option>
                                <option>json</option>
                                <option>other...</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="form-group">                          	
                                  <label>Upload data file
                                  </label>
                                  <input id="fileupload" type="file" name="files[]" multiple>
                            </div>
                            <div class="form-group">
                                <label>Insert sample data
                                </label>
                                <textarea  style="margin-top: 10px;"class="form-control" rows="3" id="dataInput" onchange="changeDataInput()"></textarea>
                            </div>                            
                        </div>
                        
                    </div>
                	
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-xs-2" style="text-align:right">Delimiter</label>
                <div class="col-xs-5">
	                <select id="DelimiterSelect" class="form-control" onchange="changeDelimiter()">
	                    <option value='\t'>Horizontal tab (\t)</option>
	                    <option value='\v'>vertical tab (\v)</option>
	                    <option value='\n'>Linefeed (\n)</option>
	                    <option value='\r'>Carriage return (\r) </option>	                    
	                    <option value ='\e'>Escape (\e)</option>
	                    <option value='\f'>Form feed  (\f)</option>
	                    <option value='\\'>Backslash (\\)</option>
	                    <option value='\$'>Dollar sign (\$)</option>
	                    <option value='\"'>Double-quote (\")</option>
	                    <option value="other">Others...</option>
	                </select>
	            </div>
	            <div class="col-xs-5">
	            	<input disabled="disabled" type="text" id="disabledInput" class="form-control" onkeypress="changeDataInput()" placeholder="Other delimiter character">
                    </br>
	            </div>
            </div>

            <div class="form-group">
                <label class="control-label col-xs-2" style="text-align:right">Add filter condition</label>
                <div class="col-xs-10" id="addCondition">        
                  <p>You can use and, or to delimiter condition</p>
                </div>
            </div>

        </div>        
    </div>

 <p id="demo"></p>

<div class="well">

<!-- <?= Html::submitButton('Generation', ['class' => 'btn btn-success']) ?> -->
<button type="button" class="btn btn-success" onclick="testClick()">Generation</button>
<button type="button" class="btn btn-warning" onclick="testClick2()">Reset</button>
</div>
<?php ActiveForm::end(); ?>

<script src="<?= Yii::$app->request->baseUrl?>/js/upload/jquery.ui.widget.js"></script>
<script src="<?= Yii::$app->request->baseUrl?>/js/upload/jquery.iframe-transport.js"></script>
<script src="<?= Yii::$app->request->baseUrl?>/js/upload/jquery.fileupload.js"></script>
<script>
$(function () {
        var url = 'files.php';
        $('#fileupload').fileupload({
            url: url,
            dataType: 'json',
            done: function (e, data) {
              $.each(data.result.files, function (index, file) {
                $.get('/dack/basic/web/files/'+file.name, function(data) {
                  $('#dataInput').val(data);
                  changeDataInput();
                }, 'text');
                
              });
            },
        });
    });
function testClick(){
  var values1 = [];
  var values2 = [];
  var values3 = [];
  $("[id='andOr']").each(function() {
        if( $(this).is(":checked") ){
            values1.push($(this).val());
        }
  });
  $("[id='buttonConditions']").each(function() {
    values2.push($(this).text());
  });
  $("[id='textCondition']").each(function() {
    values3.push($(this).val());
  });

  var myObject = new Object();
  myObject.logic = values1;
  myObject.key = values2;
  myObject.condition = values3;
  var myString = JSON.stringify(myObject);
  

  var $items = $('#codeName,#lenghtOfData,#calculationType')
  var obj = {}
  $items.each(function() {
      obj[this.id] = $(this).val();
  })

  if($("#DelimiterSelect option:selected" ).val() != "other")
    obj["DelimiterSelect"]=$("#DelimiterSelect option:selected" ).val();
  else
    obj["DelimiterSelect"]=$("#disabledInput" ).val();
  
  obj["readColumnsHeaders"] = '';
  obj["inputData"] = $('input[name=inputData]:checked').val();
  obj["dataLenght"] = $('input[name=dataLenght]:checked').val();
  obj["inputType"]=$("#inputType option:selected" ).val();

  obj["keyOperation"]=values1;
  obj["keySelectedLis"]=values2;
  obj["valueSelectedLis"]=values3;

  obj["metaData"] = metadata();

// alert(obj["keyOperation"]);
  for (var key in obj) {
    if (obj.hasOwnProperty(key)) {
      var fields = '<input type="hidden" id="changeform-'+key+'" class="form-control" name="ChangeForm['+key+']" value="'+obj[key]+'">';
      // alert(fields);
      $("#active-form").append(fields);
    }
  }
  $("#active-form" ).submit();
}

    function changeDataInput (){    

        var DelimiterSelect="";
        if($("#DelimiterSelect option:selected" ).val() != "other")
          DelimiterSelect="\t"
        else
          DelimiterSelect=$("#disabledInput" ).val();

        var lines = dataInput.value.split('\n');
        var fields = lines[0].split(DelimiterSelect);
        for(var i = 0;i < fields.length;i++){
        var _html = '<div class="row" id="Conditions"><label><input type="radio" name="andOr'+i+'" id="andOr" value="and">And</label>&emsp;<label><input type="radio" name="andOr'+i+'" id="andOr" value="or">Or</label>&emsp;<label><input type="radio" name="andOr'+i+'" id="andOr" value="none" checked>None</label>&emsp;<button type="button" id="buttonConditions" class="btn btn-default disabled">'+ fields[i]+'</button>&emsp;&nbsp;<input type="text" id="textCondition" placeholder="Enter condition"><hr></div>';
        $("#addCondition").append(_html);
        }

        
    }
  function metadata(){
    var lines = dataInput.value.split('\n');
    var fields = lines[0].split(DelimiterSelect);
    return fields;
  }

	function changeDelimiter() {
    changeDataInput();
		var e = document.getElementById("DelimiterSelect");
		var opt = e.options[e.selectedIndex].value;
		if (opt == 'other'){
			document.getElementById('disabledInput').removeAttribute("disabled");
		}
		else{
			document.getElementById('disabledInput').setAttribute("disabled", "disabled");
		}
    // testClick();
	}
function testClick2(){


}
</script>