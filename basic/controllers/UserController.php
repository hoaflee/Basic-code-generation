<?php
namespace app\controllers;

use Yii;
use app\models\action\PasswordResetRequestForm;
use app\models\action\ResetPasswordForm;

use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\action\LoginForm;
use app\models\action\SignupForm;
use yii\db\ActiveRecord;
use app\models\Pattern;
use app\models\DesignPatterns;
use app\models\ChangeForm;
use app\models\UserCode;
use app\models\Comment;
use app\models\UserInfo;
use app\models\User;
use app\models\Message;
use app\models\ContactForm;
use app\models\Resource;
use app\models\CommentResource;
use yii\db\Query;

//use app\models\UploadHandler;

class UserController extends Controller
{
    public $layout = 'user';
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionLogin()
    {
        $this->layout = 'register';
        if (!\Yii::$app->user->isGuest) {
            return $this->redirect('user/index');
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
        //var_dump(Yii::app()->user);
    }

    public function actionSignup()
    {
        $this->layout = 'register';
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->redirect('user/index');
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    //public function actionRequestPasswordReset()
    public function actionRequestPasswordReset()
    {
         $this->layout = 'register';
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->getSession()->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->getSession()->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    public function actionResetPassword($token)
    {
        $this->layout = 'register';
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->getSession()->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    public function actionIndex()
    {

        if (Yii::$app->user->isGuest){
            $this->redirect('?r=user/login');
        }
        else
            return $this->render('index');        
    }
	
	public function actionIntro($model)
    {
        return $this->render('intro',['model' => $model]);        
    }
	
	public function actionPattern($pattern)
    {
 		$patternList = Pattern::find()
						->where(['design_patterns_id' => $pattern])
						->all();
		$patternName = DesignPatterns::find()
						->where(['id' => $pattern])
						->one();
        return $this->render('pattern',['patternList' => $patternList,'pattern'=>$patternName->name]);        
    }
	
	public function actionGencode($pattern)
    {
    	$chForm = new ChangeForm;
		if ($chForm->load(Yii::$app->request->post()) && $chForm->validate()){
			return $this->render('codecreated',['pattern' => $pattern,'chForm' => $chForm]); 
		}
		else {
			return $this->render('gencode',['pattern' => $pattern,'chForm' => $chForm]);  
		}              
    }

    public function actionManagercode($user)
    {
        $send = Yii::$app->request->get('send');
        if($send){
            echo '<script language="javascript">';
            echo 'alert("Code successfully sent, Please check your mail box!")';
            echo '</script>';
        }
        $UserCode = UserCode::find()
                    ->where(['owner' => $user])
                    ->all();
        return $this->render('managercode',['UserCode' => $UserCode,'user'=>$user]);             
    }

    public function actionCodereview($id)
    {
        $UserCode = UserCode::find()
                    ->where(['id' => $id])
                    ->one();
        return $this->render('codereview',['UserCode' => $UserCode,'id'=>$id]);             
    }

    public function actionProfile($user)
    {        
        $UserCode = UserCode::find()
                    ->where(['owner' => $user])
                    ->all();
        $UserInfo = UserInfo::find()->where(['user_id' => $user])->one();
        return $this->render('profile',['UserCode' => $UserCode,'UserInfo'=>$UserInfo]);                   
    }

    public function actionSearch($keyword)
    {
        return $this->render('search',['keyword' => $keyword]);                   
    }

    public function actionComment()
    {
        $data = Yii::$app->request;
        $content = $data->post('content');
        $code_id = $data->post('code_id');

        $user_id = Yii::$app->user->identity->id;     

        if(!is_null($data->post('type')))
        {
            $comment = new CommentResource();
            $comment->resource_id = $code_id;
            $comment->owner = $user_id;
            $comment->content = $content;
            $comment->create_date = date('Y-m-d H:i:s');
            $comment->save();
        }
        else{
            try{
                $comment = new Comment();
                $comment->code_id = $code_id;
                $comment->owner = $user_id;
                $comment->content = $content;
                $comment->create_date = date('Y-m-d H:i:s');
                $comment->save();

            }
            catch (Exception $e) {
                return 'Caught exception: '.$e->getMessage(). '\n';
            }
        }
        //return ('Something wrong! please try again!');

    }

    public function actionDeletecomment()
    {
        $data = Yii::$app->request;
        $code_id = $data->post('code_id');
        $code = Comment::findOne(['id' => $code_id])->delete();
        return 'Delete code successfully!';                 
    }

    public function actionUpdateuser()
    {
        $data = Yii::$app->request;
        $user_image = $data->post('user_image');
        $description = $data->post('description');
        $facebook = $data->post('facebook');
        $github = $data->post('github');
        $googleplus = $data->post('googleplus');
        $twitter = $data->post('twitter');
        $job_description = $data->post('job_description');
        $email = $data->post('email');
        $location = $data->post('location');
        $password = $data->post('password');
        $phone = $data->post('phone');
        $lastname = $data->post('lastname');
        try{
            $UserInfo = UserInfo::find()->where(['user_id' => Yii::$app->user->identity->id])->one();
            $User = User::find()->where(['id' => Yii::$app->user->identity->id])->one();

            $UserInfo->lastname = $lastname;
            $UserInfo->user_image=$user_image;
            $UserInfo->description=$description;
            $UserInfo->facebook=$facebook;
            $UserInfo->twitter=$twitter;
            $UserInfo->googleplus=$googleplus;
            $UserInfo->github=$github;
            $UserInfo->location=$location;
            $UserInfo->phone=$phone;
            $UserInfo->job_description = $job_description;
            $UserInfo->save();

            $User->email=$email;
            if($password !==""){
                $User->setPassword($password);
                $User->generateAuthKey();
            }
            $User->save();

            return 'Update user success! Reload page to apply!';
        }
        catch (Exception $e) {
            return 'Caught exception: '.$e->getMessage(). '\n';
        }
    }

    public function actionMessage()
    {
        $query = new Query;
        $userId = Yii::$app->user->identity->id;
        $query->distinct('content, user_from, isNew, max(sent_date)')
            ->where('user_to=:user_to', [':user_to' => $userId])
            ->from('tbl_message')
            ->groupBy('user_from');

        $message = $query->all();
        //return (var_dump($message[0]['id']));
        //var_dump($message);
        return $this->render('message',['message' => $message]);       
    }

    public function actionLoadmessage(){
        $data = Yii::$app->request;
        $user_id = $data->post('user_id');
        $userId = Yii::$app->user->identity->id;

        $message = Message::find()
            ->where(['user_to' => $userId, 'user_from' => $user_id])
            ->orWhere(['user_to' => $user_id, 'user_from' => $userId])
            ->orderBy('sent_date DESC')
            ->all(); 
        $html='';
        foreach ($message as $mes) {
        $mes->isNew = '0';
        $mes->save();
        $html = '<li class="media">
                        <div class="media-body">
                            <div class="media">
                                <a class="pull-left" href="#">
                                    <img class="media-object img-circle " style="width:50px; height 50px;" src="'.$mes->userFrom->user_image.'" />
                                </a>
                                <div class="media-body" >'.$mes->content.'
                                    <br />
                                   <small class="text-muted">'.$mes->userFrom->lastname.' | '.$mes->sent_date.' </small>
                                    <hr />
                                </div>
                            </div>

                        </div>
                    </li>' . $html;
        }
        return $html;
    }

    public function actionSentmessage()
    {
        $data = Yii::$app->request;
        $content = $data->post('content');
        $user_to = $data->post('user_to');
        $user_id = Yii::$app->user->identity->id;

        $UserInfo = UserInfo::find()->where(['user_id' => Yii::$app->user->identity->id])->one();
        if($user_to!=="")
        {
            try{
                $message = new Message();
                $message->content = $content;
                $message->user_from = $user_id;
                $message->user_to = $user_to;
                $message->isNew = '1';
                $message->sent_date = date('Y-m-d H:i:s');
                $message->save();

                return '<li class="media">
                            <div class="media-body">
                                <div class="media">
                                    <a class="pull-left" href="#">
                                        <img class="media-object img-circle " style="width:50px; height 50px;" src="'.$UserInfo->user_image.'" />
                                    </a>
                                    <div class="media-body" >'.$content.'
                                        <br />
                                       <small class="text-muted">'.$UserInfo->lastname.' | '.date('Y-m-d H:i:s').' </small>
                                        <hr />
                                    </div>
                                </div>

                            </div>
                        </li>' ;

            }
            catch (Exception $e) {
                return 'Caught exception: '.$e->getMessage(). '\n';
            }
        }
    }

    public function actionContact()
    {
        $this->layout = 'register';

        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionResource()
    {
        $resource = Resource::find() ->all();  
        return $this->render('resource',['resource'=>$resource]);
    }

    public function actionActicle($id)
    {
        $resource = Resource::find()->where(['id'=>$id])->one();
        $comments = CommentResource::find()
            ->where(['resource_id' => $id])
            ->orderBy('create_date')
            ->all();
        return $this->render('acticle',['resource'=>$resource,'comments'=>$comments]);
    }

    public function actionNewacticle()
    { 
        return $this->render('newacticle');
    }

    public function actionAlluser()
    { 
        $members = UserInfo::find()->all();

        return $this->render('allUser',['members'=>$members]);
    }

    public function actionSaveacticle()
    { 
        $data = Yii::$app->request; 
        $user_id = Yii::$app->user->identity->id;     
    try
        {
            $content = $data->post('content');
            $title = $data->post('title');
            $thumbnail = $data->post('thumbnail');
            $description = $data->post('description');

            $resource = new Resource();
            $resource->title = $title;
            $resource->decription = $description;
            $resource->author = $user_id;
            $resource->create_date = date('Y-m-d H:i:s');
            $resource->thumbnail=$thumbnail;
            $resource->content=$content;
            $resource->save();
            return 'Your acticle successfully save!';

        }
        catch (Exception $e) {
                return 'Caught exception: '.$e->getMessage(). '\n';
            }       
    }

    public function actionNew()
    { 
        $resource = new Resource();
        $resource->title = 'title';
        $resource->decription = 'decription';
        $resource->author = '3';
        $resource->create_date = date('Y-m-d H:i:s');
        $resource->thumbnail='thumbnail';
        $resource->content='content';

        $resource->save();
    }

    public function actionTypeahead()
    {
        $resources = Resource::find()->all();
        $members = UserInfo::find()->all();
        $source = [];
        foreach ($resources as $resource ) {
            $source = array_merge($source, array(['id'=>Yii::$app->urlManager->createUrl(['user/acticle','id'=> $resource->id]),'name'=>$resource->title]));
        }

        foreach ($members as $member ) {
            $source = array_merge($source, array(['id'=>Yii::$app->urlManager->createUrl(['user/profile','user'=> $member->user_id]),'name'=>$member->lastname]));
        }

        // $fp = fopen('source', 'w');
        // fwrite($fp, json_encode($source));
        // fclose($fp);
    }
}
