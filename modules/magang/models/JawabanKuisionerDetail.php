<?php

namespace app\modules\magang\models;

use Yii;
use app\modules\master\models\MasterKuisioner;

/**
 * This is the model class for table "jawaban_kuisioner_detail".
 *
 * @property string $code_jawaban
 * @property string $code_kuisioner
 * @property string|null $jawaban
 */
class JawabanKuisionerDetail extends \yii\db\ActiveRecord
{

    public $pertanyaan;
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
            [['jawaban','pertanyaan'], 'string'],
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
            'pertanyaan' => 'Pertanyaan',
            'jawaban' => 'Jawaban',
        ];
    }

    public function getDataPertanyaan()
    {
        return $this->hasOne(MasterKuisioner::className(),['code' => 'code_kuisioner']);
    }
}
