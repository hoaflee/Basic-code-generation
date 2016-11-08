<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- <div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to signup:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
                <?= $form->field($model, 'username') ?>
                <?= $form->field($model, 'email') ?>
                <?= $form->field($model, 'password')->passwordInput() ?>
                <div class="form-group">
                    <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>  -->
<div class="site-signup">
<div class="container">    
        <div id="loginbox" style="" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title">Sign In</div>
                        <div style="float:right; font-size: 90%; position: relative; top:-15px"><p>Please fill out the following fields to signup:</p></div>
                    </div>     

                    <div style="padding-top:30px" class="panel-body" >

                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                           <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?> 
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input id="signupform-username" type="text" class="form-control" name="SignupForm[username]" value="" placeholder="Your username">
                                        <!-- <input type="text" id="signupform-username" class="form-control" name="SignupForm[username]"> -->
                                    </div>
                                
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                        <input id="signupform-email" type="text" class="form-control" name="SignupForm[email]" placeholder=" Your email">
                                        <!-- <input type="text" id="signupform-email" class="form-control" name="SignupForm[email]"> -->
                                    </div>

                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input id="signupform-password" type="password" class="form-control" name="SignupForm[password]" placeholder="Password">
                                        <!-- <input type="password" id="signupform-password" class="form-control" name="SignupForm[password]"> -->
                                    </div>


                                <div style="margin-top:10px" class="form-group">
                                    <!-- Button -->

                                    <div class="col-sm-12 controls">
                                        <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                                    </div>
                                </div>
  
                            <?php ActiveForm::end(); ?>
                        </div>                     
                    </div>  
        </div>
        
    </div>
</div>