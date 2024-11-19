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
    public $file_upload,$file;
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
            // [['code', 'nik'], 'required'],
            [['tanggal_lahir'], 'safe'],
            [['pendidikan', 'pengalaman', 'kemampuan','hobi','alamat_tinggal','path_foto'], 'string'],
            [['tahun_lulus'], 'string', 'max' => 5],
            [['code', 'nik'], 'string', 'max' => 16],
            [['nama', 'tempat_lahir'], 'string', 'max' => 150],
            [['jenis_kelamin', 'kewarganegaraan','status','kontak','email'], 'string', 'max' => 100],
            [['code', 'nik'], 'unique', 'targetAttribute' => ['code', 'nik']],
            [['file_upload','file'], 'file','maxFiles' => 1],
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
            'nama' => 'Nama Lengkap',
            'jenis_kelamin' => 'Jenis Kelamin',
            'tempat_lahir' => 'Tempat Lahir',
            'tanggal_lahir' => 'Tanggal Lahir',
            'alamat_tinggal' => 'Alamat Tinggal',
            'kontak' => 'Kontak / WA',
            'email' => 'Email',
            'kewarganegaraan' => 'Kewarganegaraan',
            'status' => 'Status',
            'pendidikan' => 'Pendidikan',
            'tahun_lulus' => 'Tahun Lulus',
            'pengalaman' => 'Pengalaman',
            'kemampuan' => 'Kemampuan',
            'hobi' => 'Hobi',
            'path_foto' => 'Foto',
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
