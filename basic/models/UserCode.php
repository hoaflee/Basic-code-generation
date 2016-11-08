<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%user_code}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $program_model
 * @property string $design_patterns
 * @property string $pattern
 * @property integer $owner
 * @property string $map
 * @property string $reduce
 * @property string $description
 * @property string $create_date
 * @property integer $is_edited
 *
 * @property ProgrammingModel $programModel
 * @property DesignPatterns $designPatterns
 * @property Pattern $pattern0
 * @property User $owner0
 */
class UserCode extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_code}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['owner', 'is_edited'], 'integer'],
            [['map', 'reduce', 'description'], 'string'],
            [['create_date'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['program_model', 'design_patterns', 'pattern'], 'string', 'max' => 20]
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
            'program_model' => 'Program Model',
            'design_patterns' => 'Design Patterns',
            'pattern' => 'Pattern',
            'owner' => 'Owner',
            'map' => 'Map',
            'reduce' => 'Reduce',
            'description' => 'Description',
            'create_date' => 'Create Date',
            'is_edited' => 'Is Edited',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProgramModel()
    {
        return $this->hasOne(ProgrammingModel::className(), ['id' => 'program_model']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDesignPatterns()
    {
        return $this->hasOne(DesignPatterns::className(), ['id' => 'design_patterns']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPattern0()
    {
        return $this->hasOne(Pattern::className(), ['id' => 'pattern']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOwner0()
    {
        return $this->hasOne(User::className(), ['id' => 'owner']);
    }
}
