<?php
use app\models\Resource;
use app\models\UserInfo;
use app\models\User;

/* @var $this yii\web\View */
$this->title = 'All User';
$this->params['breadcrumbs'][] = $this->title;
?>

    <div class="col-lg-12">

        <div class="panel panel-primary">
            <div class="panel-heading">
                Code created by BiCoGe
            </div>

            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="userDataTables">
                        <thead>
                            <tr>
                                <th class="text-primary">Full Name</th>                               
                                <th class="text-primary">Job description</th>
                                <th class="text-primary">Phone</th>
                                <th class="text-primary">Email</th>
                                <th class="text-primary">location</th>
                                <th class="text-primary">Create Time</th>                                
                            </tr>
                        </thead>
                        <tbody>           
                        <?php
                            foreach ($members as $member) {
                            	$userProfile = Yii::$app->urlManager->createUrl(['user/profile','user'=> $member->user_id]);
                                echo <<<EOF
                                    <tr>
                                        <td><a href="{$userProfile}">
                                        <img class="media-object img-thumbnail" src="{$member->user_image}" style="width:40px; height 40px;">

                                        {$member->lastname}</a></td>
                                        <td>{$member->job_description}</td>
                                        <td class="center">{$member->phone}</td>
                                        <td class="center">{$member->user->email}</td>
                                        <td class="center">{$member->location}</td>
                                        <td class="center">{$member->joined_date}</td>
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
<script>
    $('#userDataTables').dataTable();
</script>