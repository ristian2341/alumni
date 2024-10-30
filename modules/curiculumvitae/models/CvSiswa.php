<?php

namespace app\modules\curiculumvitae\models;

use Yii;

use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use app\models\Siswa;
/**
 * This is the model class for table "cv_siswa".
 *
 * @property string $code
 * @property string $nik
 * @property string|null $pendidikan
 * @property string|null $pengalaman
 * @property string|null $kemampuan
 */
class CvSiswa extends \yii\db\ActiveRecord
{
    public $nama,$jurusan;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cv_siswa';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            BlameableBehavior::className(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'nik'], 'required'],
            [['pendidikan', 'pengalaman', 'kemampuan'], 'string'],
            [['code', 'nik'], 'string', 'max' => 16],
            [['code', 'nik'], 'unique', 'targetAttribute' => ['code', 'nik']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'code' => 'Code',
            'nik' => 'Nik',
            'pendidikan' => 'Pendidikan',
            'pengalaman' => 'Pengalaman',
            'kemampuan' => 'Kemampuan',
        ];
    }

    public function getDataSiswa()
    {
        return $this->hasOne(Siswa::className(),['nik' => 'nik']);
    }

    public function getDataSiswaNik()
    {
        return $this->hasOne(Siswa::className(),['nisn' => Yii::$app->user->nis,'id_status_siswa' => 1]);
    }
}
