<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_user_info".
 *
 * @property integer $id
 * @property string $description
 * @property integer $user_id
 * @property string $user_image
 * @property string $facebook
 * @property string $github
 * @property string $firstname
 * @property string $lastname
 * @property string $phone
 * @property string $job
 * @property string $location
 * @property string $job_description
 * @property string $googleplus
 * @property string $twitter
 * @property string $joined_date
 * @property string $last_login
 * @property string $website
 *
 * @property Comment[] $comments
 * @property User $user
 */
class UserInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_user_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description', 'user_image'], 'string'],
            [['user_id'], 'required'],
            [['user_id'], 'integer'],
            [['joined_date'], 'safe'],
            [['facebook', 'github', 'firstname', 'lastname', 'phone', 'job', 'location', 'job_description', 'googleplus', 'twitter', 'last_login', 'website'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'description' => 'Description',
            'user_id' => 'User ID',
            'user_image' => 'User Image',
            'facebook' => 'Facebook',
            'github' => 'Github',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'phone' => 'Phone',
            'job' => 'Job',
            'location' => 'Location',
            'job_description' => 'Job Description',
            'googleplus' => 'Googleplus',
            'twitter' => 'Twitter',
            'joined_date' => 'Joined Date',
            'last_login' => 'Last Login',
            'website' => 'Website',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['owner' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
