<?php
namespace app\controllers;

use Yii;
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

class MapreduceController extends Controller
{
    public $layout = 'user';

    public function actionIndex()
    {
        echo 'index';        
    }
	
	public function actionPattern($model)
    {
        #return $this->render('intro',['model' => $model]);        
        $patternList = Pattern::find()
                        ->where(['design_patterns_id' => $pattern])
                        ->all();
        $patternName = DesignPatterns::find()
                        ->where(['id' => $pattern])
                        ->one();
        return $this->render('pattern',['patternList' => $patternList,'pattern'=>$patternName]);     
    }
	
	public function actionIntro($pattern)
    {
 		$patternList = Pattern::find()
						->where(['design_patterns_id' => $pattern])
						->all();
		$patternName = DesignPatterns::find()
						->where(['id' => $pattern])
						->one();
        return $this->render('intro',['patternList' => $patternList,'pattern'=>$patternName]);        
    }

    public function actionGencode($pattern)
    {

        $chForm = new ChangeForm;
        if ($chForm->load(Yii::$app->request->post())){
            return $this->render('codecreated',['pattern' => $pattern,'chForm' => $chForm]); 
        }
        else {
            if(file_exists(\Yii::$app->basePath.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'mapreduce'.DIRECTORY_SEPARATOR.$pattern.'.php')){
                return $this->render($pattern,['pattern' => $pattern,'chForm' => $chForm]);      
            }
            else 
                return $this->render('autocode',['pattern' => $pattern]);
        }              
    }

    public function actionEditcode($id)
    {
        $code = UserCode::find()
                    ->where(['id' => $id])
                    ->one();
        return $this->render('editcode',['code'=>$code]);        
    }


    public function actionSavecode()
    {
        $data = Yii::$app->request;
        $mapCode = $data->post('mapCode');
        $reduceCode = $data->post('reduceCode');
        $description = $data->post('description');
        $nameCode = $data->post('nameCode');
        $pattern = $data->post('pattern');
        $design_patterns = Pattern::find()
                        ->where(['id' => $pattern])
                        ->one();
        try{
            $code = UserCode::find()
                    ->where(['name' => $nameCode,'owner'=>Yii::$app->user->identity->id])
                    ->one();

            if(is_null($code))
            {
                $newCode = new UserCode();
                $newCode->name = $nameCode;
                $newCode->pattern = $pattern;
                $newCode->description = $description;
                $newCode->map = $mapCode;
                $newCode->reduce = $reduceCode;
                $newCode->owner = Yii::$app->user->identity->id;        
                $newCode->create_date = date('Y-m-d H:i:s');
                $newCode->design_patterns = $design_patterns->designPatterns->id;
                $newCode->save();
                return 'Save code to your profile success!';
            //return var_dump($design_patterns->designPatterns->name);
            }
            else
            {
                $code->description = $description;
                $code->map = $mapCode;
                $code->reduce = $reduceCode;
                $code->create_date = date('Y-m-d H:i:s');
                $code->save();
                return 'Save code to your profile success!';
            }
        }
        catch (Exception $e) {
            return 'Caught exception: '.$e->getMessage(). '\n';
        }
        return ('Something wrong! please try again!');

    }

    public function actionSaveeditcode()
    {
        $data = Yii::$app->request;
        $idCode = $data->post('idCode');
        $mapCode = $data->post('mapCode');
        $reduceCode = $data->post('reduceCode');
        $description = $data->post('description');
        $nameCode = $data->post('nameCode');

        try{
            $code = UserCode::find()
                    ->where(['id' => $idCode])
                    ->one();

            $code->description = $description;
            $code->map = $mapCode;
            $code->name = $nameCode;
            $code->reduce = $reduceCode;
            $code->create_date = date('Y-m-d H:i:s');
            $code->save();
            return 'Code successfully edited!';
        }
        catch (Exception $e) {
            return 'Caught exception: '.$e->getMessage(). '\n';
        }
        return ('Something wrong! please try again!');

    }

    public function actionDownloadcode($id)
    {
        $code = UserCode::find()
                    ->where(['id' => $id])
                    ->one();

        $mapCode = $code->map;
        $reduceCode = $code->reduce;
        $nameCode = $code->name;

        $mapCodeName = $nameCode.'_mapper.py';
        $reduceCodeName = $nameCode.'_reducer.py';

        $zip = new \ZipArchive();
        $zipName = $nameCode.".zip";
        if($zip->open($zipName,\ZIPARCHIVE::CREATE)!==TRUE){
            $error .= "* sorry zip createion failed at this time";
        }
        $zip->addFromString($mapCodeName,$mapCode);
        $zip->addFromString($reduceCodeName,$reduceCode);
        $zip->close();
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.basename($zipName));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($zipName));
        readfile($zipName);
        unlink($zipName);
    }

    public function actionDeletecode()
    {
        $id = Yii::$app->request->post('id');
        $code = UserCode::findOne(['id' => $id])->delete();
        return "Delete code successfully!";
    }
    public function actionSendcode()
    {   
        $id = Yii::$app->request->post('id');
        $code = UserCode::find()
                    ->where(['id' => $id])
                    ->one();

        $mapCode = $code->map;
        $reduceCode = $code->reduce;
        $nameCode = $code->name;

        $mapCodeName = $nameCode.'_mapper.py';
        $reduceCodeName = $nameCode.'_reducer.py';

        $zip = new \ZipArchive();
        $zipName = $nameCode.".zip";
        if($zip->open($zipName,\ZIPARCHIVE::CREATE)!==TRUE){
            $error .= "* sorry zip createion failed at this time";
        }
        $zip->addFromString($mapCodeName,$mapCode);
        $zip->addFromString($reduceCodeName,$reduceCode);
        $zip->close();

        Yii::$app->mailer->compose()
            ->setFrom('bicoge.uit@gmail.com')
            ->setTo(Yii::$app->user->identity->email)
            ->setSubject('BiCoge - '.$code->name.' MapReduce code for you!')
            ->setHtmlBody('<b>Thanks for use we service!</b><br>'.$code->description)
            ->attach($zipName)
            ->send();
        unlink($zipName);
        return "Code successfully sent, Please check your mail box!";
    }
}
