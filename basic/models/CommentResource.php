<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_comment_resource".
 *
 * @property integer $id
 * @property integer $resource_id
 * @property integer $owner
 * @property string $create_date
 * @property string $content
 *
 * @property UserInfo $owner0
 * @property Resource $resource
 */
class CommentResource extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_comment_resource';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['resource_id', 'owner'], 'integer'],
            [['create_date'], 'safe'],
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
            'resource_id' => 'Resource ID',
            'owner' => 'Owner',
            'create_date' => 'Create Date',
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
    public function getResource()
    {
        return $this->hasOne(Resource::className(), ['id' => 'resource_id']);
    }
}
