<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_comment".
 *
 * @property integer $id
 * @property integer $code_id
 * @property integer $owner
 * @property string $create_date
 * @property string $update_date
 * @property string $content
 *
 * @property UserInfo $owner0
 * @property UserCode $code
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code_id', 'owner'], 'integer'],
            [['create_date', 'update_date'], 'safe'],
            [['content'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code_id' => 'Code ID',
            'owner' => 'Owner',
            'create_date' => 'Create Date',
            'update_date' => 'Update Date',
            'content' => 'Content',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOwner0()
    {
        return $this->hasOne(UserInfo::className(), ['user_id' => 'owner']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCode()
    {
        return $this->hasOne(UserCode::className(), ['id' => 'code_id']);
    }
}
