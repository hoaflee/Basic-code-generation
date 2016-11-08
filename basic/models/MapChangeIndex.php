<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%map_change_index}}".
 *
 * @property integer $id
 * @property string $pattern_id
 * @property string $key_change
 * @property string $type
 * @property string $code_chane
 * @property string $comment
 *
 * @property Pattern $pattern
 */
class MapChangeIndex extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%map_change_index}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pattern_id', 'key_change'], 'required'],
            [['key_change', 'code_chane', 'comment'], 'string'],
            [['pattern_id'], 'string', 'max' => 20],
            [['type'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pattern_id' => 'Pattern ID',
            'key_change' => 'Key Change',
            'type' => 'Type',
            'code_chane' => 'Code Chane',
            'comment' => 'Comment',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPattern()
    {
        return $this->hasOne(Pattern::className(), ['id' => 'pattern_id']);
    }
}
