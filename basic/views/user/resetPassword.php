<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

$this->title = 'Reset password';
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- <div class="site-reset-password">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please choose your new password:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>
                <?= $form->field($model, 'password')->passwordInput() ?>
                <div class="form-group">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div> -->
<div class="site-reset-password">
    <div class="container">    
        <div id="loginbox" style="" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title">Reset password</div>
                    </div>     

                    <div style="padding-top:30px" class="panel-body" >
                    <p>Please choose your new password:</p>


                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                            
                       
            <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input id="resetpasswordform-password" type="password" class="form-control" name="ResetPasswordForm[password]" value="" placeholder="Inter your email">
                            </div>                         

                                <div style="margin-top:10px" class="form-group">
                                    <div class="col-sm-12 controls">
                                        <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
                                    </div>
                                </div>
  
            <?php ActiveForm::end(); ?>
                            



                        </div>                     
                    </div>  
        </div>
        
    </div>
</div>