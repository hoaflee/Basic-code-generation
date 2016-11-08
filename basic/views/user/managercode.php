<?php
  $this->title = 'Code Manager';
  $this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-lg-12">
        <strong><i class="glyphicon glyphicon-dashboard"></i> Manager Code</strong>      
        <hr>

        <div class="panel panel-primary">
            <div class="panel-heading">
                Code created by BiCoGe
            </div>

            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>Name</th>                               
                                <th>Design Patterns</th>
                                <th>Pattern</th>
                                <th>Create Time</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>           
                        <?php
                            foreach ($UserCode as $code) {
                                $codeReviewUrl = Yii::$app->urlManager->createUrl(['user/codereview','id'=> $code->id]);
                               // $modelUrl = Yii::$app->urlManager->createUrl(['user/intro','model'=> $code->program_model]);
                                $designPatternsUrl = Yii::$app->urlManager->createUrl(['user/pattern','pattern'=> $code->design_patterns]);
                                $patternUrl = Yii::$app->urlManager->createUrl(['mapreduce/gencode','pattern'=> $code->pattern]);
                               // $status = ($code->is_edited)? 'Edited': 'Original';
                                $deleteUrl = Yii::$app->urlManager->createUrl(['mapreduce/deletecode','id'=> $code->id]);
                                $downloadUrl = Yii::$app->urlManager->createUrl(['mapreduce/downloadcode','id'=> $code->id]);
                                $sendUrl = Yii::$app->urlManager->createUrl(['mapreduce/sendcode','id'=> $code->id]);
                                $editUrl = Yii::$app->urlManager->createUrl(['mapreduce/editcode','id' => $code->id]);

                                echo <<<EOF
                                    <tr class="gradeU" id="{$code->id}">
                                        <td><a href="{$codeReviewUrl}">{$code->name}</a></td>
                                        <td><a href="{$designPatternsUrl}">{$code->designPatterns->name}</a></td>
                                        <td class="center">{$code->pattern0->name} <a href="{$patternUrl}">(Create New)</a></td>
                                        <td class="center">{$code->create_date}</td>
                                        <td class="center">
                                            <a href="{$editUrl}"><button type="button" class="btn btn-default" aria-label="Left Align" name="download" id="{$code->id}">
                                                <span class="glyphicon glyphicon-edit text-warning" aria-hidden="true" title="Edit this code"></span>
                                            </button></a>

                                            <a href="{$downloadUrl}"><button type="button" class="btn btn-default" aria-label="Left Align" name="download" id="{$code->id}">
                                                <span class="glyphicon glyphicon-cloud-download text-primary" aria-hidden="true" title="Download this code"></span>
                                            </button></a>
                                            <button type="button" class="btn btn-default" aria-label="Left Align" name="send" id="{$code->id}">
                                                <span class="glyphicon glyphicon-send text-success" aria-hidden="true" title="Send this code to Email"></span>
                                            </button>
                                            <button type="button" class="btn btn-default" aria-label="Left Align" name="delete" id="{$code->id}">
                                                <span class="glyphicon glyphicon-remove text-danger" aria-hidden="true" title="Delete this code" ></span>
                                            </button>
                                        </td>
                                    </tr>
EOF;
                            }

                        ?>                                          
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>

<script>
    $('#dataTables-example').dataTable();
    // $('button[name="download"]').click(function(){
    //     if(confirm("Are you sure to download this item?")){
    //         alert(this.id);
    //     }   
    // });
    $('button[name="delete"]').click(function(){
        if(confirm("Are you sure to delete this item?")){
            //alert(this.id);
            $.ajax({
                type: "POST",
                data:{id: this.id},
                url: '?r=mapreduce/deletecode',
                success: function(data) {                
                    alert(data);
                    location.reload();
                }
            })
            }        
    });
    $('button[name="send"]').click(function(){
        if(confirm("Are you sure to send this item to your email?")){
            //alert(this.id);
            $.ajax({
                type: "POST",
                data:{id: this.id},
                url: '?r=mapreduce/sendcode',
                success: function(data) {                
                    alert(data);
                }
            })
        }   
    });
   
</script>
