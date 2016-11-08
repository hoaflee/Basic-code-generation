<?php
use app\models\UserInfo;
  $this->title = 'Messager';
  $this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-sm-4">
          <div class="panel panel-primary">
            <div class="panel-heading">
               MESSAGES BOX
            </div>
            <div class="panel-body">
                <ul class="media-list">
<?php
foreach ($message as $mes){
    $UserInfo = UserInfo::find()->where(['user_id' => $mes['user_from']])->one();
    $userName= $UserInfo->lastname;
    $userImage = $UserInfo->user_image;
    $mesCont = substr($mes['content'],0,15)."...";
    
    $style= ($mes['isNew'] == "1" ? 'style="background: rgb(217, 237, 247);"': "");
echo <<<EOF
                    <li class="media" {$style} name="userChat" id="{$mes["user_from"]}">
                        <div class="media-body">
                            <div class="media">
                                <a class="pull-left" href="#">
                                    <img class="media-object img-circle" style="width:40px; height 40px;" src="{$userImage}" />
                                </a>
                                <div class="media-body" >
                                    <a href="?r=user/profile&user={$mes["user_from"]}"<h5 class="text-primary">{$userName}</h5></a> |                                  
                                    <small class="text-muted">{$mes["sent_date"]}</small>
                                    <p>{$mesCont}<p>
                                </div>
                            </div>
                        </div>
                    </li>
EOF;
}
?>
    
                </ul>
                </div>
            </div>
        
    </div>

    <div class="col-sm-8" id="messageConversation">
        <div class="panel panel-info">
            <div class="panel-heading">
                RECENT MESSAGE HISTORY
            </div>
            <div class="panel-body">
                <ul class="media-list" id="messageContent">
                    <!-- <li class="media">
                        <div class="media-body">
                            <div class="media">
                                <a class="pull-left" href="#">
                                    <img class="media-object img-circle " src="assets/img/user.png" />
                                </a>
                                <div class="media-body" >
                                    Donec sit amet ligula enim. Duis vel condimentum massa.

        Donec sit amet ligula enim. Duis vel condimentum massa.Donec sit amet ligula enim. 
                                    Duis vel condimentum massa.
                                    Donec sit amet ligula enim. Duis vel condimentum massa.
                                    <br />
                                   <small class="text-muted">Alex Deo | 23rd June at 5:00pm</small>
                                    <hr />
                                </div>
                            </div>

                        </div>
                    </li> -->

                </ul>
            </div>
            <div class="panel-footer">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Enter Message" id="yourMessage" />
                    <span class="input-group-btn">
                        <button class="btn btn-info" type="button" id="sentMessage">SEND</button>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <p id="tmp" name=""></p>
</div>

<script>
$('li[name="userChat"]').click(function(){
        // alert(this.id);
    $.ajax({
            type: "POST",
            data:
            {
                user_id:this.id,
            },
            url: '?r=user/loadmessage',
            success: function(data) {       
                //location.reload();         
                $( "#messageContent" ).empty();
                $("#messageContent").append(data);                
            }
        })
    $("#tmp").attr('name',this.id);

});

$("#sentMessage").click(function (){
    //alert($('#yourMessage').val());
    if($("#yourMessage").val() && $("#tmp").attr('name')) {
        $.ajax({
            type: "POST",
            data:
            {
                content: $('#yourMessage').val(),
                user_to: $("#tmp").attr('name'),
            },
            url: '?r=user/sentmessage',
            success: function(data) {
                $("#yourMessage").val('');
                $("#messageContent").append(data); 
            }
        });
    };
  });
</script>