<?php

namespace app\models;

use Yii;

use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "lowker".
 *
 * @property string $code_lowker
 * @property string|null $tgl_post
 * @property string|null $tgl_last
 * @property string|null $lowongan
 * @property string|null $id_perusahaan
 * @property string|null $nama_perusahaan
 * @property string|null $alamat
 * @property string|null $kabupaten
 * @property string|null $propinsi
 * @property string|null $kontak
 * @property string|null $email
 * @property string|null $requirement
 * @property string|null $keterangan
 * @property int|null $created_at
 * @property string|null $created_by
 * @property int|null $updated_at
 * @property string|null $updated_by
 */
class Lowker extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lowker';
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
            [['code_lowker','tgl_post', 'tgl_last'], 'required'],
            [['tgl_post', 'tgl_last'], 'safe'],
            [['requirement', 'keterangan'], 'string'],
            [['created_at', 'updated_at'], 'integer'],
            [['code_lowker', 'id_perusahaan', 'created_by', 'updated_by'], 'string', 'max' => 16],
            [['lowongan', 'email'], 'string', 'max' => 100],
            [['nama_perusahaan', 'kabupaten', 'propinsi'], 'string', 'max' => 150],
            [['alamat'], 'string', 'max' => 255],
            [['kontak'], 'string', 'max' => 15],
            [['code_lowker'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'code_lowker' => 'Code Lowker',
            'tgl_post' => 'Tgl Post',
            'tgl_last' => 'Tgl Akhir',
            'lowongan' => 'Lowongan',
            'id_perusahaan' => 'Id Perusahaan',
            'nama_perusahaan' => 'Nama Perusahaan',
            'alamat' => 'Alamat',
            'kabupaten' => 'Kota / Kabupaten',
            'propinsi' => 'Propinsi',
            'kontak' => 'Kontak',
            'email' => 'Email',
            'requirement' => 'Requirement',
            'keterangan' => 'Keterangan',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    public function getLowkerId()
    {
        $sDate = date('Ymd');
        $count = $this->find()->where(['like','code_lowker',$sDate])->count();
        $n = 0;
        if($count > 0){
            $model = $this->find()->where(['like','code_lowker',$sDate])->orderBy(['code_lowker' => SORT_DESC])->one();
            $n = (int)substr($model->code_lowker, -4);
        }
        return (string) $sDate.sprintf('%04s', ($n +1));
    }

    public function getCreated()
    {
        $username = User::find()->select(['username'])->where(['user_id' => $this->created_by])->column();
        return $username[0];
    }

    public function getUpdated()
    {
        $username = User::find()->select(['username'])->where(['user_id' => $this->created_by])->column();
        return $username[0];
    }
}
