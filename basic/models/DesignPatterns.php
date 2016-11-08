<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%design_patterns}}".
 *
 * @property string $id
 * @property string $model_id
 * @property string $name
 * @property string $description
 *
 * @property ProgrammingModel $model
 * @property Pattern[] $patterns
 * @property UserCode[] $userCodes
 */
class DesignPatterns extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%design_patterns}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'model_id', 'name'], 'required'],
            [['description'], 'string'],
            [['id', 'model_id'], 'string', 'max' => 20],
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
            'model_id' => 'Model ID',
            'name' => 'Name',
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModel()
    {
        return $this->hasOne(ProgrammingModel::className(), ['id' => 'model_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPatterns()
    {
        return $this->hasMany(Pattern::className(), ['design_patterns_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserCodes()
    {
        return $this->hasMany(UserCode::className(), ['design_patterns' => 'id']);
    }
}
