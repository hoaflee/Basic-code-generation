<?php
  $this->title = 'User profile';
  $this->params['breadcrumbs'][] = $this->title;
?>
    <div class="row">
        <div class="col-sm-9">
             <h1 class=""><?= $UserInfo->lastname?></h1>         
            
            <div class="panel panel-info">
                <div class="panel-heading">About me</div>
                <div class="panel-body"><?= $UserInfo->description?>
                </div>
            </div>
            <?php
            if(Yii::$app->user->identity->id !== $UserInfo->user->id){
echo <<<EOF
            <div class="input-group">
                    <input type="text" name="{$UserInfo->user->id}" class="form-control" id="yourMessage" placeholder="Send me your message">
                    <span class="input-group-btn">
                        <button class="btn btn-info" id="sentMessage" type="button">Send</button>
                    </span>
            </div>
EOF;
          }
            ?>
            <br>
        </div>
        <div class="col-sm-3"><a class="pull-right"><img style="width:300px; height 300px;" title="profile image" class="img-circle img-responsive" src="<?= $UserInfo->user_image?>"></a>

        </div>

    </div>
    <br>
    <div class="row">
        <div class="col-sm-3">
            <!--left col-->
            <ul class="list-group">
                <li class="list-group-item text-muted" contenteditable="false"><h4 class="text-primary">Profile</h4></li>
                <li class="list-group-item text-right"><span class="pull-left"><strong class="">Joined Day :</strong></span> <?= $UserInfo->joined_date?></li>
                <li class="list-group-item text-right"><span class="pull-left"><strong class="">Job :</strong></span> <?php echo $UserInfo->job.' '. $UserInfo->job_description;?></li>
                <li class="list-group-item text-right"><span class="pull-left"><strong class="">Phone : </strong></span> <?= $UserInfo->phone?></li>
                <li class="list-group-item text-right"><span class="pull-left"><strong class="">Email : </strong></span> <?= $UserInfo->user->email?> </li>
                <li class="list-group-item text-right"><span class="pull-left"><strong class="">Location : </strong></span> <?= $UserInfo->location?> </li>

            </ul>

            <?php
            if(!is_null($UserInfo->website))
echo <<<EOF
            <div class="panel panel-info">
                <div class="panel-heading">Website <i class="fa fa-link fa-1x"></i>

                </div>
                <div class="panel-body"><a href="{$UserInfo->website}" class="">{$UserInfo->website}</a>

                </div>
            </div>
EOF;
            ?>

            <div class="panel panel-info">
                <div class="panel-heading">Social Media</div>
                <div class="panel-body">	
                  <?php
                  if(!is_null($UserInfo->facebook)){
                    echo '<a href="'.$UserInfo->facebook.'"><i class="fa fa-facebook fa-2x"></i></a>';
                  }
                  if(!is_null($UserInfo->twitter)){
                    echo '<a href="'.$UserInfo->twitter.'"><i class="fa fa-twitter fa-2x"></i></a>';
                  }
                  if(!is_null($UserInfo->github)){
                    echo '<a href="'.$UserInfo->github.'"><i class="fa fa-github fa-2x"></i></a>';
                  }
                  if(!is_null($UserInfo->googleplus)){
                    echo '<a href="'.$UserInfo->googleplus.'"><i class="fa fa-google-plus fa-2x"></i></a>';
                  }
                  // </i>  <i class="fa fa-github fa-2x"></i> 
                  //   <i class="fa fa-twitter fa-2x"></i> <i class="fa fa-google-plus fa-2x"></i>
                    ?>
                </div>
            </div>
        </div>

        <div class="col-sm-9" contenteditable="false" style="">
            
            <div class="panel panel-info target">
                <div class="panel-heading" contenteditable="false">Main page</div>
                <div class="panel-body">              
                    <div class="row">
                      <div class="col-sm-12">          
                        <ul class="nav nav-tabs" id="myTab">
                          <li class="active"><a href="#home" data-toggle="tab">Home</a></li>
                          <?php
            if(Yii::$app->user->identity->id === $UserInfo->user->id){
                          echo '<li><a href="#settings" data-toggle="tab">Settings</a></li>';
                        }
                          ?>
                        </ul>
              
          <div class="tab-content">
            <div class="tab-pane active" id="home">
              <br>
              <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Design Patterns</th>
                                <th>Pattern</th>
                                <th>Create Time</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>           
                        <?php
                            foreach ($UserCode as $code) {
                                $codeReviewUrl = Yii::$app->urlManager->createUrl(['user/codereview','id'=> $code->id]);
                                //$modelUrl = Yii::$app->urlManager->createUrl(['user/intro','model'=> $code->program_model]);
                                $designPatternsUrl = Yii::$app->urlManager->createUrl(['user/pattern','pattern'=> $code->design_patterns]);
                                $patternUrl = Yii::$app->urlManager->createUrl(['user/gencode','pattern'=> $code->pattern]);
                                //$status = ($code->is_edited)? 'Edited': 'Original';
                                $deleteUrl = Yii::$app->urlManager->createUrl(['mapreduce/deletecode','id'=> $code->id]);
                                $downloadUrl = Yii::$app->urlManager->createUrl(['mapreduce/downloadcode','id'=> $code->id]);
                                $sendUrl = Yii::$app->urlManager->createUrl(['mapreduce/sendcode','id'=> $code->id]);
                                $editUrl = Yii::$app->urlManager->createUrl(['mapreduce/editcode','id' => $code->id]);
                                $des = substr($code->description,0,20);
                                echo <<<EOF
                                    <tr class="gradeU">
                                        <td><a href="{$codeReviewUrl}">{$code->name}</a></td>
                                                                        
                                        <td><a href="{$designPatternsUrl}">{$code->designPatterns->name}</a></td>
                                        <td class="center">{$code->pattern0->name} <a href="{$patternUrl}">(Create New)</a></td>
                                        <td class="center">{$code->create_date}</td>
                                        <td class="center">{$des}
                                        </td>
                                    </tr>
EOF;
                            }

                        ?>                                          
                        </tbody>
                    </table>
                </div>
              
              <hr>
              
             </div><!--/tab-pane-->
             <div class="tab-pane" id="settings"> 

                <div class="col-xs-6">
                  <div class="text-center">
                    <img id="user_image" style="width:100px; height 100px;" src="<?= $UserInfo->user_image?>" class="avatar img-circle" alt="avatar">
                    <span class="btn btn-success fileinput-button">
                    <!-- The file input field used as target for the file upload widget -->
                    <input id="fileupload" type="file" name="files[]" multiple>
                    </span>
                  </div>
                </div>                   
                    
                <div class="col-xs-6">
                    <label for="first_name" class="text-primary"><h4>Full name</h4></label>
                    <input type="text" class="form-control" name="first_name" id="userFullName" placeholder="first name" title="enter your first name if any." value="<?= $UserInfo->lastname ?>">
                </div>

                <div class="col-xs-6">
                    <label for="phone" class="text-primary"><h4>Phone</h4></label>
                    <input type="text" class="form-control" name="phone" id="userPhone" placeholder="enter phone" title="enter your phone number if any." value="<?= $UserInfo->phone?>">
                </div>
            
                
                <div class="col-xs-6">
                    <label for="email" class="text-primary"><h4>Email</h4></label>
                    <input type="text" class="form-control" name="email" id="userEmail" placeholder="you@email.com" title="enter your email." value="<?= $UserInfo->user->email?>">
                </div>
          
                
                <div class="col-xs-6">
                    <label for="email" class="text-primary"><h4>Location</h4></label>
                    <input type="text" class="form-control" id="userLocation" placeholder="somewhere" title="enter a location" value="<?= $UserInfo->location?>">
                </div>
            
                
                <div class="col-xs-6">
                    <label for="password" class="text-primary"><h4>Password</h4></label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="password" title="enter your password.">
                </div>       
       
                <div class="col-xs-6">
                  <label for="facebook" class="text-primary"><h4>Facebook</h4></label>
                    <input type="text" class="form-control" name="facebook" id="userFacebook" placeholder="Facebook" title="enter your Facebook url." value="<?= $UserInfo->facebook?>">
                </div>
           
                
                <div class="col-xs-6">
                  <label for="googleplus" class="text-primary"><h4>Google Plus</h4></label>
                    <input type="text" class="form-control" id="userGoogleplus" placeholder="GooglePlus" title="enter your Google Plus url." value="<?= $UserInfo->googleplus?>">
                </div>
            
                
                <div class="col-xs-6">
                  <label for="github" class="text-primary"><h4>Github</h4></label>
                    <input type="text" class="form-control" name="github" id="userGithub"  title="enter your Git Hub url." value="<?= $UserInfo->github?>">
                </div>
           
                
                <div class="col-xs-6">
                  <label for="twitter" class="text-primary"><h4>Twitter</h4></label>
                    <input type="text" class="form-control" name="twitter" id="userTwitter"  title="enter your Twitter url." value="<?= $UserInfo->twitter?>">
                </div>
                <div class="col-xs-6">
                  <label for="twitter" class="text-primary"><h4>Job</h4></label>
                    <input type="text" class="form-control" name="twitter" id="userTwitter"  title="enter your job" value="<?= $UserInfo->job?>">
                </div>

                 <div class="col-xs-6">
                  <label for="last_name" class="text-primary"><h4>About me</h4></label>
                    <textarea id="userDescription" style ="width: 100% !important;" rows="10" id="userAboutMe" placeholder="last name" title="enter your last name if any."><?= $UserInfo->description?></textarea>
                </div>

                 <div class="col-xs-6">
                  <label for="Job description" class="text-primary"><h4>Job description</h4></label>
                    <textarea style ="width: 100% !important;" rows="10" id="userJobDescription" placeholder="Job description" title="enter your Job description"><?= $UserInfo->job_description?></textarea>
                </div>
            
                 <div class="col-xs-12">
                      <br>
                      <button class="btn btn-lg btn-success" id="userUpdate"><i class="glyphicon glyphicon-ok-sign"></i> Save</button>
                      <!-- <button class="btn btn-lg" id="resetForm"><i class="glyphicon glyphicon-repeat"></i> Reset</button> -->
                  </div>
                      
              </div>
               
              </div><!--/tab-pane-->
          </div><!--/tab-content-->

        </div><!--/col-9-->
                    </div>
                </div>              
            </div>
        </div>
    </div>
    <p id="test"></p>
<script src="<?= Yii::$app->request->baseUrl?>/js/upload/jquery.ui.widget.js"></script>
<script src="<?= Yii::$app->request->baseUrl?>/js/upload/jquery.iframe-transport.js"></script>
<script src="<?= Yii::$app->request->baseUrl?>/js/upload/jquery.fileupload.js"></script>
<script>
    $('#dataTables-example').dataTable();   
    $(function () {
        'use strict';
        
        // Define the url to send the image data to
        var url = 'files.php';
        
        // Call the fileupload widget and set some parameters
        $('#fileupload').fileupload({
            url: url,
            dataType: 'json',
            done: function (e, data) {
                // Add each uploaded file name to the #files list
                $.each(data.result.files, function (index, file) {
                    // $('<li/>').text(file.name).appendTo('#files');
                    //val src = 'dack/web/files/'+file.name;
                    // alert('dack/web/files/'+file.name);
                    $("#user_image").attr('src','/dack/basic/web/files/'+file.name);
                });
            },
        });
    });

 $("#userUpdate").click(function (){
  //alert($("userTwitter").val());
    $.ajax({
        type: "POST",
        data:
        {
            user_image: $("#user_image").attr('src'),
            lastname: $("#userFullName").val(),
            phone:$("#userPhone").val(),
            email:$("#userEmail").val(),
            location:$("#userLocation").val(),
            password:$("#password").val(),
            facebook:$("#userFacebook").val(),
            github:$("#userGithub").val(),
            googleplus:$("#userGoogleplus").val(),
            twitter:$("#userTwitter").val(),
            description:$("#userDescription").val(),
            job_description:$("#userJobDescription").val(),
        },
        url: '?r=user/updateuser',
        success: function(data) {
            alert(data);
             //$("#test").append(data);
        }
    })
 });
    
$("#sentMessage").click(function (){
    //alert($('#yourMessage').attr('name'));
    if($("#yourMessage").val()) {
        $.ajax({
            type: "POST",
            data:
            {
                content: $('#yourMessage').val(),
                user_to: $('#yourMessage').attr('name'),
            },
            url: '?r=user/sentmessage',
            success: function(data) {
                $("#yourMessage").val('');
                alert('Your message successfully sent!');
                //$("#messageContent").append(data); 
            }
        });
    };
  });
</script>
