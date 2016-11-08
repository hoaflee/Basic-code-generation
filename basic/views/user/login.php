<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- <div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to login:</p>

    <div class="row" >
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                <?= $form->field($model, 'username') ?>
                <?= $form->field($model, 'password')->passwordInput() ?>
                <?= $form->field($model, 'rememberMe')->checkbox() ?>
                <div style="color:#999;margin:1em 0">
                    If you forgot your password you can <?= Html::a('reset it', ['site/request-password-reset']) ?>.
                </div>
                <div class="form-group">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>  -->

<div class="site-login">
    <div class="container">    
        <div id="loginbox" style="" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title">Sign In</div>
                        <div style="float:right; font-size: 80%; position: relative; top:-10px"><?= Html::a('Forgot password?', ['user/request-password-reset']) ?></div>
                    </div>     

                    <div style="padding-top:30px" class="panel-body" >

                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                            
                       
                            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?> 
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input id="loginform-username" type="text" class="form-control" name="LoginForm[username]" value="" placeholder="username or email">
                                        <!-- <input type="text" id="loginform-username" class="form-control" name="LoginForm[username]"> -->
                                        
                                    </div>
                                
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input id="loginform-password" type="password" class="form-control" name="LoginForm[password]" placeholder="password">
                                        <!-- <input type="password" id="loginform-password" class="form-control" name="LoginForm[password]"> -->
                                    </div>
                                    

                                
                            <div class="input-group">
                                      <div class="checkbox">
                                        <label>
                                          <input id="loginform-rememberme" type="checkbox" name="LoginForm[rememberMe]" value="1" checked=""> Remember me
                                          <!-- <input type="checkbox" id="loginform-rememberme" name="LoginForm[rememberMe]" value="1" checked=""> -->
                                        </label>
                                      </div>
                                    </div>


                                <div style="margin-top:10px" class="form-group">
                                    <!-- Button -->

                                    <div class="col-sm-12 controls">
                                      <!-- <a id="btn-login" href="#" class="btn btn-success">Login  </a> -->
                                      <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12 control">
                                        <hr>
                                        <div style="padding-top:10px; font-size:85%" >
                                            Don't have an account! 
                                            <?= Html::a('Sign Up Here', ['user/signup']) ?>
                                        </div>
                                    </div>
                                </div>   
                            <?php ActiveForm::end(); ?>
                            



                        </div>                     
                    </div>  
        </div>
        
    </div>
</div>