<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_java_template".
 *
 * @property integer $id
 * @property integer $pattern_id
 * @property string $code
 * @property string $description
 */
class JavaTemplate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_java_template';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pattern_id'], 'integer'],
            [['code', 'description'], 'string'],
            [['pattern_id'], 'unique']
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
            'code' => 'Code',
            'description' => 'Description',
        ];
    }
}
