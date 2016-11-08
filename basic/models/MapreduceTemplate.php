<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%mapreduce_template}}".
 *
 * @property integer $id
 * @property string $pattern_id
 * @property string $map_code
 * @property string $reduce_code
 *
 * @property Pattern $pattern
 */
class MapreduceTemplate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%mapreduce_template}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['map_code', 'reduce_code'], 'string'],
            [['pattern_id'], 'string', 'max' => 20]
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
            'map_code' => 'Map Code',
            'reduce_code' => 'Reduce Code',
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
