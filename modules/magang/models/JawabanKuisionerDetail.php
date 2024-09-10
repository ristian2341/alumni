<?php

namespace app\modules\magang\models;

use Yii;

/**
 * This is the model class for table "jawaban_kuisioner_detail".
 *
 * @property string $code_jawaban
 * @property string $code_kuisioner
 * @property string|null $jawaban
 */
class JawabanKuisionerDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jawaban_kuisioner_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code_kuisioner','jawaban'], 'required'],
            [['code_jawaban', 'code_kuisioner'], 'string', 'max' => 15],
            [['jawaban'], 'string'],
            [['code_jawaban', 'code_kuisioner'], 'unique', 'targetAttribute' => ['code_jawaban', 'code_kuisioner']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'code_jawaban' => 'Code Jawaban',
            'code_kuisioner' => 'Code Kuisioner',
            'jawaban' => 'Jawaban',
        ];
    }
}
