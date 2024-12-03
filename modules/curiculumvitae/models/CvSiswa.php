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
    public$file;
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
            [['created_at', 'updated_at'], 'integer'],
            [['tahun_lulus'], 'string', 'max' => 5],
            [['code', 'nik','created_by','updated_by'], 'string', 'max' => 16],
            [['nama', 'tempat_lahir'], 'string', 'max' => 150],
            [['jenis_kelamin', 'kewarganegaraan','status','kontak','email'], 'string', 'max' => 100],
            [['code', 'nik'], 'unique', 'targetAttribute' => ['code', 'nik']],
            [['file'], 'file','maxFiles' => 1],
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
            'pengalaman' => 'Pengalaman Kerja',
            'kemampuan' => 'Kemampuan',
            'hobi' => 'Hobi',
            'path_foto' => 'Foto',
            'created_at' => 'Created at',
            'updated_at' => 'Updated at',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
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

    public function getCode()
    {
        $sDate = date('Ymd');
        $count = $this->find()->where(['like','code',$sDate])->count();
        $n = 0;
        if($count > 0){
            $model = $this->find()->where(['like','code',$sDate])->orderBy(['code' => SORT_DESC])->one();
            $n = (int)substr($model->code, -6);
        }
        return (string) $sDate.sprintf('%06s', ($n +1));
    }
}
