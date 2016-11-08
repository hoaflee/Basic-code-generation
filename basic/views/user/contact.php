<script src="<?= Yii::$app->request->baseUrl?>/js/ckeditor/ckeditor.js"></script>

<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\widgets\Breadcrumbs;
use app\models\UserInfo;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

$this->title = 'Contact';
$this->params['breadcrumbs'][] = $this->title;

$UserInfo = UserInfo::find()->where(['user_id' => Yii::$app->user->identity->id])->one();
?>
<?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>

        <div id="loginbox" style="" class="col-md-12">                    
            <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title"><h2>Let's Keep In Touch!</h2></div>
                    </div>     

                    <div style="padding-top:30px" class="panel-body" >
    <strong>
        If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.
    </strong>
    <hr>

                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                        <div class="row">
                            <div class="col-lg-6">
                                <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
                                <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input id="contactform-name" type="text" class="form-control" name="ContactForm[name]" value="<?= $UserInfo->lastname ?>" placeholder="Your Name">
                                </div>

                                <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                        <input id="contactform-email" type="text" class="form-control" name="ContactForm[email]" value="<?= $UserInfo->user->email ?>" placeholder="Your Mail">
                                </div>

                                <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                                        <input id="contactform-subject" type="text" class="form-control" name="ContactForm[subject]" value="" placeholder="Subject">
                                </div>
                                    <?= $form->field($model, 'body')->textArea(['rows' => 15,'id' => 'content']) ?>
                                    <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                                        'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                                    ]) ?>
                                    <div class="form-group">
                                        <?= Html::submitButton('Send contact', ['class' => 'btn btn-primary', 'name' => 'contact-button',]) ?>
                                    </div>
                                <?php ActiveForm::end(); ?>
                            </div>

                            <div class="col-lg-6">
                                <div class="row"> 
                                    <div class="col-lg-4">
                                        <address>
                                        <strong class="text-primary">BiCoG  e, Inc.</strong><br>
                                        Thu Duc, Ho Chi Minh City<br>
                                        <i class="glyphicon glyphicon-earphone"></i> + 84 (08) 888 - 888 
                                        </address>
                                    </div>
                                    <div class="col-lg-4">                                        
                                        <strong class="text-primary">Lê Hoàng Hòa</strong><br>                                 
                                        <i class="fa fa-mobile"></i> + 84 (1688) 824-579</br>
                                        <i class="fa fa-envelope"></i><small class="text-info"> hoanghoauit@gmail.com</small></br>                                   

                                    </div>
                                    <div class="col-lg-4">                                        
                                        <strong class="text-primary">Đỗ Thị Duyên</strong><br>                                
                                        <i class="fa fa-mobile"></i> + 84 (1647) 117-312</br>
                                        <i class="fa fa-envelope"></i><small class="text-info"> dtduyenit@gmail.com </small></br>                                   

                                    </div>
                                </div>  
                            </div>
                            <div class="col-lg-6">
                                <div class="well">
<iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d7836.476913097902!2d106.804868455203!3d10.869459366191734!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1zVW5pdmVyc2l0eSBvZiBJbmZvcm1hdGlvbiBUZWNobm9sb2d5LCBLaHUgcGjhu5EsIExpbmggVHJ1bmcsIEjhu5MgQ2jDrSBNaW5oLCBI4buTIENow60gTWluaCwgVmlldG5hbQ!5e0!3m2!1sen!2s!4v1420281573527" width=100% height="500" frameborder="0" style="border:0"></iframe>                            </div>
                        </div>

                        </div>                     
                    </div>  
        </div>

<script>
 CKEDITOR.replace( 'content', {
    });
</script>