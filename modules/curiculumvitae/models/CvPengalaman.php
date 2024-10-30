<?php

namespace app\modules\curiculumvitae\models;

use Yii;

/**
 * This is the model class for table "cv_pengalaman".
 *
 * @property int $id
 * @property string $code_cv
 * @property string $nik
 * @property string|null $nama_pt
 * @property string|null $periode
 * @property string|null $jabatan
 * @property string|null $type_pendidikan Formal || Non Formal
 */
class CvPengalaman extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cv_pengalaman';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code_cv', 'nik'], 'required'],
            [['code_cv', 'nik'], 'string', 'max' => 16],
            [['nama_pt', 'jabatan', 'type_pendidikan'], 'string', 'max' => 100],
            [['periode'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code_cv' => 'Code Cv',
            'nik' => 'Nik',
            'nama_pt' => 'Nama Pt',
            'periode' => 'Periode',
            'jabatan' => 'Jabatan',
            'type_pendidikan' => 'Type Pendidikan',
        ];
    }
}
