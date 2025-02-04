<?php

namespace app\modules\curiculumvitae\models;

use Yii;

/**
 * This is the model class for table "cv_pendidikan".
 *
 * @property int $id
 * @property string $code_cv
 * @property string $nik
 * @property string|null $sekolah
 * @property string|null $jurusan
 * @property string|null $periode
 */
class CvPendidikan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cv_pendidikan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code_cv', 'nis'], 'required'],
            [['code_cv', 'nis'], 'string', 'max' => 16],
            [['sekolah', 'jurusan'], 'string', 'max' => 100],
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
            'sekolah' => 'Sekolah',
            'jurusan' => 'Jurusan',
            'periode' => 'Periode',
        ];
    }
}
