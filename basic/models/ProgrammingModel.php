<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%programming_model}}".
 *
 * @property string $id
 * @property string $name
 * @property string $description
 *
 * @property DesignPatterns[] $designPatterns
 * @property UserCode[] $userCodes
 */
class ProgrammingModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%programming_model}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'name'], 'required'],
            [['description'], 'string'],
            [['id'], 'string', 'max' => 20],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDesignPatterns()
    {
        return $this->hasMany(DesignPatterns::className(), ['model_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserCodes()
    {
        return $this->hasMany(UserCode::className(), ['program_model' => 'id']);
    }
}
