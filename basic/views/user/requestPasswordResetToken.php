<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

$this->title = 'Request password reset';
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- <div class="site-request-password-reset">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out your email. A link to reset password will be sent there.</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>
                <?= $form->field($model, 'email') ?>
                <div class="form-group">
                    <?= Html::submitButton('Send', ['class' => 'btn btn-primary']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div> -->
<div class="site-request-password-reset">
    <div class="container">    
        <div id="loginbox" style="" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title">Request password reset</div>
                    </div>     

                    <div style="padding-top:30px" class="panel-body" >
                            <p>Please fill out your email. A link to reset password will be sent there.</p>


                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                            
                       
                            <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                        <input id="passwordresetrequestform-email" type="text" class="form-control" name="PasswordResetRequestForm[email]" value="" placeholder="Inter your email">
                                        <!-- <input type="text" id="passwordresetrequestform-email" class="form-control" name="PasswordResetRequestForm[email]">                                         -->
                            </div>                         

                                <div style="margin-top:10px" class="form-group">
                                    <div class="col-sm-12 controls">
                                    <?= Html::submitButton('Send', ['class' => 'btn btn-primary']) ?>
                                    </div>
                                </div>
  
                                <?php ActiveForm::end(); ?>
                            



                        </div>                     
                    </div>  
        </div>
        
    </div>
</div>