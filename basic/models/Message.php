<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_message".
 *
 * @property integer $id
 * @property string $content
 * @property integer $user_from
 * @property integer $user_to
 * @property string $sent_date
 * @property integer $isNew
 *
 * @property UserInfo $userTo
 * @property UserInfo $userFrom
 */
class Message extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_message';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
            [['user_from', 'user_to', 'isNew'], 'integer'],
            [['sent_date'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content' => 'Content',
            'user_from' => 'User From',
            'user_to' => 'User To',
            'sent_date' => 'Sent Date',
            'isNew' => 'Is New',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserTo()
    {
        return $this->hasOne(UserInfo::className(), ['user_id' => 'user_to']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserFrom()
    {
        return $this->hasOne(UserInfo::className(), ['user_id' => 'user_from']);
    }
}
