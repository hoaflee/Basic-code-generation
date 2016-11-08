<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%pattern}}".
 *
 * @property string $id
 * @property string $design_patterns_id
 * @property string $name
 * @property string $code_template
 * @property string $description
 *
 * @property ChangeIndex[] $changeIndices
 * @property DesignPatterns $designPatterns
 * @property UserCode[] $userCodes
 */
class Pattern extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%pattern}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'design_patterns_id', 'name', 'code_template'], 'required'],
            [['code_template', 'description'], 'string'],
            [['id', 'design_patterns_id'], 'string', 'max' => 20],
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
            'design_patterns_id' => 'Design Patterns ID',
            'name' => 'Name',
            'code_template' => 'Code Template',
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChangeIndices()
    {
        return $this->hasMany(ChangeIndex::className(), ['pattern_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDesignPatterns()
    {
        return $this->hasOne(DesignPatterns::className(), ['id' => 'design_patterns_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserCodes()
    {
        return $this->hasMany(UserCode::className(), ['pattern' => 'id']);
    }
}
