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
<!-- Droppable jQuery -->
<link rel="stylesheet" href="<?= Yii::$app->request->baseUrl?>/css/jquery-ui.css">
<script type="text/javascript" src="<?= Yii::$app->request->baseUrl?>/js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="<?= Yii::$app->request->baseUrl?>/js/jquery-ui.js"></script>
<style>
  #gallery { float: left; width: 49%; min-height: 12em; }
  .gallery.custom-state-active { background: #eee; }
  .gallery li { float: left; width: 30%; padding: 0.4em; margin: 0 0.4em 0.4em 0; text-align: center; }
  .gallery li h5 { margin: 0 0 0.4em; cursor: move; }
  .gallery li a { float: right; }
  .gallery li a.ui-icon-zoomin { float: left; }
  .gallery li img { width: 100%; cursor: move; }
 
  #fieldselected { float: right; width: 49%; min-height: 10em; padding: 1%; text-align: center;}
  #fieldselected h4 { line-height: 16px; margin: 0 0 0.4em; }
  #fieldselected h4 .ui-icon { float: left; }
  #fieldselected .gallery h5 { display: none; }


  #gallery2 { float: left; width: 49%; min-height: 12em; }
  .gallery2.custom-state-active { background: #eee; }
  .gallery2 li { float: left; width: 30%; padding: 0.4em; margin: 0 0.4em 0.4em 0; text-align: center; }
  .gallery2 li h5 { margin: 0 0 0.4em; cursor: move; }
  .gallery2 li a { float: right; }
  .gallery2 li a.ui-icon-zoomin { float: left; }
  .gallery2 li img { width: 100%; cursor: move; }
 
  #fieldselected2 { float: right; width: 49%; min-height: 10em; padding: 1%; text-align: center;}
  #fieldselected2 h4 { line-height: 16px; margin: 0 0 0.4em; }
  #fieldselected2 h4 .ui-icon { float: left; }
  #fieldselected2 .gallery2 h5 { display: none; }

  </style>
  <script>


  </script>


<?php $form = ActiveForm::begin([
    'id' => 'active-form',
  ]); ?>

<div class="col-md-9">
    <div class="row shop-tracking-status">
      <div class="order-status">
          <div class="order-status-timeline">
              <!-- class names: c0 c1 c2 c3 and c4 -->
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

         <!--  <div class="form-group">
              <label class="control-label col-xs-2" style="text-align:right"></label>
              <div class="col-xs-10">
                  <?= Html::submitButton('Auto Generation', ['class' => 'btn btn-success']) ?>
                  <p class="help-block">Source code will created with defaul data and condition, or you can modify source code with condition below</p>
              </div>
          </div> -->

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
                                  <label>
                                      <input type="radio" name="inputData" id="inputData" value="datafile">Upload data file
                                  </label>

                                  <input id="fileupload" type="file" name="files[]" multiple>
                           
                            </div>
                            <div class="form-group">
                                <label>
                                    <input type="radio" name="inputData" id="inputData" value="datasample" checked>Insert sample data
                                </label>
                                <textarea  style="margin-top: 10px;"class="form-control" rows="3" id="dataInput" onchange="changeDataInput()"></textarea>
                                <div class="checkbox">
                                    <label>
                                        <input id="readColumnsHeaders" type="checkbox" value="true">Read columns headers
                                    </label>
                                </div>
                            </div>                            
                        </div>
                        <div class="form-group">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="dataLenght" id="dataLenght" value="datasamelenght" checked>All data line are same lenght
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="dataLenght" id="dataLenght" value="modifylenght">
                                    <input id="lenghtOfData" type="text" class="form-control" placeholder="Check lenght of line">
                                </label>
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
                <label class="control-label col-xs-2" style="text-align:right">Select Key and value to calculate average</label>
                <div class="col-xs-10">
                    <div class="well" style="background-color: #81BEF7">                        
                        <div class="ui-widget ui-helper-clearfix"> 
                            <ul id="gallery" class="gallery ui-helper-reset ui-helper-clearfix">
                            </ul>
                            <div id="fieldselected" class="ui-widget-content ui-state-default alert alert-info">
                                <h4 class="ui-widget-header alert alert-info"><span class="ui-icon ui-icon-fieldselected">fieldselected</span>Key field selected</h4>
                            </div>

                        </div>
                    </div> 
                    <div class="well" style="background-color: #81BEF7">                        
                        <div class="ui-widget ui-helper-clearfix"> 
                            <ul id="gallery2" class="gallery2 ui-helper-reset ui-helper-clearfix">

                            </ul>
                            <div id="fieldselected2" class="ui-widget-content ui-state-default alert alert-info">
                                <h4 class="ui-widget-header alert alert-info"><span class="ui-icon ui-icon-fieldselected2">fieldselected</span>Value column for averaging</h4>
                            </div>

                        </div>
                    </div>                    
                </div>
            </div>

            <div class="form-group" style="display: none;">
              <label class="control-label col-xs-2" style="text-align:right">Key for Operation</label>
              <div class="col-xs-10">
                  <input type="text" class="form-control" placeholder="key or array of key here" id="keyOperation">
                  <p class="help-block">Ouput keys separate by ','</t> example: hello, what, you</p>
              </div>
            </div>

            <div class="form-group" style="display: none;">
              <label class="control-label col-xs-2" style="text-align:right">Calculation Type</label>
              <div class="col-xs-4">
                    <select id="calculationType" class="form-control">
                        <option selected>Max Calculation</option>
                        <option>Min Calculation</option>
                    </select>
                    <p class="help-block">Source code will created for Max or Min calculation</p>                
            </div>
           </div>

        </div>        
    </div>

 <p id="demo"></p>

<div class="well">

<!-- <?= Html::submitButton('Generation', ['class' => 'btn btn-success']) ?> -->
<button type="button" class="btn btn-success" onclick="testClick()">Generation</button>
<button type="button" class="btn btn-warning">Reset</button>
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
                  //alert(data);
                }, 'text');
                
              });
            },
        });
    });
function testClick(){

  var $items = $('#codeName,#lenghtOfData,#calculationType,#keyOperation')
  var obj = {}
  $items.each(function() {
      obj[this.id] = $(this).val();
  })

  if($("#DelimiterSelect option:selected" ).val() != "other")
    obj["DelimiterSelect"]=$("#DelimiterSelect option:selected" ).val();
  else
    obj["DelimiterSelect"]=$("#disabledInput" ).val();
  
  obj["readColumnsHeaders"] = document.getElementById("readColumnsHeaders").checked;
  obj["inputData"] = $('input[name=inputData]:checked').val();
  obj["dataLenght"] = $('input[name=dataLenght]:checked').val();
  obj["inputType"]=$("#inputType option:selected" ).val();

  keyList=[];  
  var keySelectedLis = document.getElementById("fieldselected").getElementsByTagName("li");
  for (var i = 0; i < keySelectedLis.length; i++) {
    keyList.push(keySelectedLis[i].getElementsByTagName("p")[0].innerHTML);
  }

  valueList=[];
  var valueSelectedLis = document.getElementById("fieldselected2").getElementsByTagName("li");
  for (var i = 0; i < valueSelectedLis.length; i++) {
    valueList.push(valueSelectedLis[i].getElementsByTagName("p")[0].innerHTML);
  }

  obj["metaData"] = changeDataInput();
  obj["keySelectedLis"]=keyList;
  obj["valueSelectedLis"]=valueList;

  for (var key in obj) {
    if (obj.hasOwnProperty(key)) {
      var fields = '<input type="hidden" id="changeform-'+key+'" class="form-control" name="ChangeForm['+key+']" value="'+obj[key]+'">';
      $("#active-form").append(fields);
    }
  }
  $("#active-form" ).submit();
}

    function changeDataInput (){    
        var arrayId = ["gallery", "gallery2"]; 
        cleanUl(arrayId);
        $("#fieldselected2 > ul").remove();
        $("#fieldselected > ul").remove();

        var DelimiterSelect="";
        if($("#DelimiterSelect option:selected" ).val() != "other")
          DelimiterSelect="\t"
        else
          DelimiterSelect=$("#disabledInput" ).val();

        var lines = dataInput.value.split('\n');
        var fields = lines[0].split(DelimiterSelect);
        for(var i = 0;i < fields.length;i++){
        var _html = '<li class="ui-widget-content ui-corner-tr ui-draggable ui-draggable-handle">' +
                                '<p class="ui-widget-header">'+fields[i]+'</p>'+
                                '<a title="select field" class="glyphicon glyphicon-ok ui-icon-fieldselected"></a>'+
                                '</li>'
                       $("#gallery").append(_html);


        var _html2 = '<li class="ui-widget-content ui-corner-tr ui-draggable ui-draggable-handle">' +
                                '<p class="ui-widget-header">'+fields[i]+'</p>'+
                                '<a title="select field" class="glyphicon glyphicon-ok ui-icon-fieldselected2"></a>'+
                                '</li>'
                       $("#gallery2").append(_html2);
        }
// there's the gallery and the fieldselected
        initDrap();
        initDrap2();
        return fields;
    }

  function initDrap(){
    var $gallery = $( "#gallery" ),
        $fieldselected = $( "#fieldselected" );
      
        // let the gallery items be draggable
        window.test = $( "li", $gallery );
        $( "li", $gallery ).draggable({
          cancel: "a.ui-icon", // clicking an icon won't initiate dragging
          revert: "invalid", // when not dropped, the item will revert back to its initial position
          containment: "document",
          helper: "clone",
          cursor: "move"
        });
     
        // let the fieldselected be droppable, accepting the gallery items
        $fieldselected.droppable({
          accept: "#gallery > li",
          activeClass: "ui-state-highlight",
          drop: function( event, ui ) {
            deleteImage( ui.draggable );
          }
        });
     
        // let the gallery be droppable as well, accepting items from the fieldselected
        $gallery.droppable({
          accept: "#fieldselected li",
          activeClass: "custom-state-active",
          drop: function( event, ui ) {
            recycleImage( ui.draggable );
          }
        });
     
        // image deletion function
        var recycle_icon = "<a title='remove field' class='glyphicon glyphicon-remove ui-icon-refresh'></a>";
        function deleteImage( $item ) {
          $item.fadeOut(function() {
            var $list = $( "ul", $fieldselected ).length ?
              $( "ul", $fieldselected ) :
              $( "<ul class='gallery ui-helper-reset'/>" ).appendTo( $fieldselected );
     
            $item.find( "a.ui-icon-fieldselected" ).remove();
            $item.append( recycle_icon ).appendTo( $list ).fadeIn(function() {
            $item
                .animate({ width: "auto" })
                .find( "img" )
                .animate({ height: "100px" });
            });
          });
        }
     
        // image recycle function
        var fieldselected_icon = "<a title='select field' class='glyphicon glyphicon-ok ui-icon-fieldselected'></a>";
        function recycleImage( $item ) {
          $item.fadeOut(function() {
            $item
              .find( "a.ui-icon-refresh" )
                .remove()
              .end()
              .css( "width", "30%")
              .append( fieldselected_icon )
              .find( "img" )
              .end()
              .appendTo( $gallery )
              .fadeIn();
          });
        }
     
        // resolve the icons behavior with event delegation
        $( "ul.gallery > li" ).click(function( event ) {
          var $item = $( this ),
            $target = $( event.target );
     
          if ( $target.is( "a.ui-icon-fieldselected" ) ) {
            deleteImage( $item );
          }else if ( $target.is( "a.ui-icon-refresh" ) ) {
            recycleImage( $item );
          }     
          return false;
        });

  }
        // there's the gallery and the fieldselected
  function initDrap2(){
    var $gallery2 = $( "#gallery2" ),
        $fieldselected2 = $( "#fieldselected2" );
     
        // let the gallery2 items be draggable
        window.test = $( "li", $gallery2 );
        $( "li", $gallery2 ).draggable({
          cancel: "a.ui-icon", // clicking an icon won't initiate dragging
          revert: "invalid", // when not dropped, the item will revert back to its initial position
          containment: "document",
          helper: "clone",
          cursor: "move"
        });
     
        // let the fieldselected2 be droppable, accepting the gallery2 items
        $fieldselected2.droppable({
          accept: "#gallery2 > li",
          activeClass: "ui-state-highlight",
          drop: function( event, ui ) {
            deleteImage( ui.draggable );
          }
        });
     
        // let the gallery2 be droppable as well, accepting items from the fieldselected2
        $gallery2.droppable({
          accept: "#fieldselected2 li",
          activeClass: "custom-state-active",
          drop: function( event, ui ) {
            recycleImage( ui.draggable );
          }
        });
     
        // image deletion function
        var recycle_icon = "<a title='remove field' class='glyphicon glyphicon-remove ui-icon-refresh'></a>";
        function deleteImage( $item ) {
          $item.fadeOut(function() {
            var $list = $( "ul", $fieldselected2 ).length ?
              $( "ul", $fieldselected2 ) :
              $( "<ul class='gallery2 ui-helper-reset'/>" ).appendTo( $fieldselected2 );
     
            $item.find( "a.ui-icon-fieldselected2" ).remove();
            $item.append( recycle_icon ).appendTo( $list ).fadeIn(function() {
            $item
                .animate({ width: "auto" })
                .find( "img" )
                .animate({ height: "100px" });
            });
          });
        }
     
        // image recycle function
        var fieldselected2_icon = "<a title='select field' class='glyphicon glyphicon-ok ui-icon-fieldselected2'></a>";
        function recycleImage( $item ) {
          $item.fadeOut(function() {
            $item
              .find( "a.ui-icon-refresh" )
                .remove()
              .end()
              .css( "width", "30%")
              .append( fieldselected2_icon )
              .find( "img" )
              .end()
              .appendTo( $gallery2 )
              .fadeIn();
          });
        }
     
        // resolve the icons behavior with event delegation
        $( "ul.gallery2 > li" ).click(function( event ) {
          var $item = $( this ),
            $target = $( event.target );
     
          if ( $target.is( "a.ui-icon-fieldselected2" ) ) {
            deleteImage( $item );
          }else if ( $target.is( "a.ui-icon-refresh" ) ) {
            recycleImage( $item );
          }
     
          return false;
        });
  }
        
  function cleanUl(arrayId){
    for (i = 0; i < arrayId.length; i++) { 
        var myList = document.getElementById(arrayId[i]);
        myList.innerHTML = '';
    }
      
  }
	function changeDelimiter() {
		var e = document.getElementById("DelimiterSelect");
		var opt = e.options[e.selectedIndex].value;
		if (opt == 'other'){
			document.getElementById('disabledInput').removeAttribute("disabled");
		}
		else{
			document.getElementById('disabledInput').setAttribute("disabled", "disabled");
		}
    testClick();
	}

</script>