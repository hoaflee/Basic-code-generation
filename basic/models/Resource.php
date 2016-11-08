<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_resource".
 *
 * @property integer $id
 * @property string $title
 * @property string $decription
 * @property string $content
 * @property integer $author
 * @property string $create_date
 * @property string $thumbnail
 *
 * @property CommentResource[] $commentResources
 * @property UserInfo $author0
 */
class Resource extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_resource';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['decription', 'content'], 'string'],
            [['author'], 'integer'],
            [['create_date'], 'safe'],
            [['title', 'thumbnail'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'decription' => 'Decription',
            'content' => 'Content',
            'author' => 'Author',
            'create_date' => 'Create Date',
            'thumbnail' => 'Thumbnail',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCommentResources()
    {
        return $this->hasMany(CommentResource::className(), ['resource_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor0()
    {
        return $this->hasOne(UserInfo::className(), ['user_id' => 'author']);
    }
    
    public function countComment()
    {
        return CommentResource::find()->where(['resource_id'=>$this->id])->count();
    }
}
