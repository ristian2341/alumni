<?php

namespace app\modules\magang\models;

use Yii;

/**
 * This is the model class for table "magang_detail".
 *
 * @property string|null $code_magang
 * @property string|null $nisn
 * @property string|null $nama
 * @property string|null $rombel
 */
class MagangDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'magang_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code_magang'], 'string', 'max' => 15],
            [['nisn'], 'string', 'max' => 16],
            [['rombel'], 'string', 'max' => 100],
            [['nama'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'code_magang' => 'Code Magang',
            'nisn' => 'Nisn',
            'nama' => 'Nama',
            'rombel' => 'Code Jurusan',
        ];
    }
}
