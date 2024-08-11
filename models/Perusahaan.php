<?php

namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use app\models\User;

/**
 * This is the model class for table "perusahaan".
 *
 * @property int $id_perusahaan
 * @property string|null $nama
 * @property string|null $alamat
 * @property string|null $kota
 * @property string|null $propinsi
 * @property string|null $email
 * @property string|null $phone
 * @property string|null $pic1
 * @property string|null $phone_pic1
 * @property string|null $email_pic1
 * @property string|null $pic2
 * @property string|null $phone_pic2
 * @property string|null $email_pic2
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 */
class Perusahaan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'perusahaan';
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
            [['id_perusahaan'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['nama'], 'string', 'max' => 150],
            [['alamat'], 'string', 'max' => 255],
            [['kota', 'propinsi', 'email', 'pic1', 'email_pic1', 'pic2', 'phone_pic2', 'email_pic2'], 'string', 'max' => 100],
            [['phone', 'phone_pic1'], 'string', 'max' => 15],
            [['id_perusahaan','updated_by', 'created_by'], 'string', 'max' => 16],
            [['id_perusahaan'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_perusahaan' => 'Id Perusahaan',
            'nama' => 'Nama',
            'alamat' => 'Alamat',
            'kota' => 'Kota',
            'propinsi' => 'Propinsi',
            'email' => 'Email',
            'phone' => 'Phone',
            'pic1' => 'Pic1',
            'phone_pic1' => 'Phone Pic1',
            'email_pic1' => 'Email Pic1',
            'pic2' => 'Pic2',
            'phone_pic2' => 'Phone Pic2',
            'email_pic2' => 'Email Pic2',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    public function getPerusahaanId()
    {
        $sDate = date('Ymd');
        $count = $this->find()->where(['like','id_perusahaan',$sDate])->count();
        $n = 0;
        if($count > 0){
            $model = $this->find()->where(['like','id_perusahaan',$sDate])->orderBy(['id_perusahaan' => SORT_DESC])->one();
            $n = (int)substr($model->id_perusahaan, -5);
        }
        return (string) $sDate.sprintf('%05s', ($n +1));
    }

    public function getCreated()
    {
        $username = User::find()->select(['full_name'])->where(['user_id' => $this->created_by])->column();
        return $username[0];
    }

    public function getUpdated()
    {
        $username = User::find()->select(['full_name'])->where(['user_id' => $this->created_by])->column();
        return $username[0];
    }

}
