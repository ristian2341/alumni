<?php

namespace app\modules\magang\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use app\models\User;
use app\models\Perusahaan;

/**
 * This is the model class for table "magang".
 *
 * @property string $code
 * @property string|null $code_perusahaan
 * @property string|null $nama_perusahaan
 * @property string|null $pic
 * @property string|null $tgl_mulai
 * @property string|null $tgl_akhir
 * @property string|null $created_by
 * @property int|null $created_at
 * @property string|null $updated_by
 * @property int|null $updated_at
 */
class Magang extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'magang';
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
            [['tgl_mulai','tgl_akhir','code_perusahaan'], 'required'],
            [['tgl_mulai', 'tgl_akhir'], 'safe'],
            [['created_at', 'updated_at'], 'integer'],
            [['code'], 'string', 'max' => 15],
            [['code_perusahaan', 'created_by', 'updated_by'], 'string', 'max' => 16],
            [['nama_perusahaan', 'pic'], 'string', 'max' => 100],
            [['code'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'code' => 'Code',
            'code_perusahaan' => 'Code Perusahaan',
            'nama_perusahaan' => 'Nama Perusahaan',
            'pic' => 'Pic',
            'tgl_mulai' => 'Tgl Mulai',
            'tgl_akhir' => 'Tgl Akhir',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
        ];
    }

    public function getDataDetail()
    {
        return $this->hasMany(MagangDetail::className(),['code_magang' => 'code']);
    }

    public function getDataPerusahaan()
    {
        return $this->hasOne(Perusahaan::className(),['id_perusahaan' => 'code_perusahaan']);
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

    public function getCode()
    {
        $sDate = date('Ymd');
        $count = $this->find()->where(['like','code',$sDate])->count();
        $n = 0;
        if($count > 0){
            $model = $this->find()->where(['like','code',$sDate])->orderBy(['code' => SORT_DESC])->one();
            $n = (int)substr($model->code, -5);
        }
        return (string) $sDate.sprintf('%04s', ($n +1));
    }
}
