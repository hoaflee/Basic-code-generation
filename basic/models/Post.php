<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%post}}".
 *
 * @property integer $id
 * @property integer $owner_id
 * @property string $title
 * @property string $date
 * @property string $update_date
 * @property string $content
 *
 * @property Comment[] $comments
 * @property User $owner
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%post}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'owner_id', 'title'], 'required'],
            [['id', 'owner_id'], 'integer'],
            [['date', 'update_date'], 'safe'],
            [['content'], 'string'],
            [['title'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'owner_id' => 'Owner ID',
            'title' => 'Title',
            'date' => 'Date',
            'update_date' => 'Update Date',
            'content' => 'Content',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['post_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOwner()
    {
        return $this->hasOne(User::className(), ['id' => 'owner_id']);
    }
}
