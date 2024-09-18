<?php

namespace app\modules\magang\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

use app\modules\magang\models\JawabanKuisionerDetail;

/**
 * This is the model class for table "jawaban_kuisioner".
 *
 * @property string|null $code
 * @property string|null $nisn
 * @property string|null $nama
 * @property int|null $created_at
 * @property string|null $created_by
 * @property int|null $updated_at
 * @property string|null $updated_by
 */
class JawabanKuisioner extends \yii\db\ActiveRecord
{

    public $rombel,$jurusan;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jawaban_kuisioner';
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
            [['created_at', 'updated_at','status_data'], 'integer'],
            [['code', 'created_by', 'updated_by'], 'string', 'max' => 15],
            [['nisn'], 'string', 'max' => 100],
            [['nama','rombel','jurusan'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'code' => 'Code',
            'nisn' => 'Nisn',
            'nama' => 'Nama',
            'rombel' => 'Rombel',
            'jurusan' => 'Jurusan',
            'status_data' => 'Status Data',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    public function getCode()
    {
        $sDate = date('Ymd');
        $count = $this->find()->where(['like','code',$sDate])->count();
        $n = 0;
        if($count > 0){
            $model = $this->find()->where(['like','code',$sDate])->orderBy(['code' => SORT_DESC])->one();
            $n = (int)substr($model->code, -4);
        }
        return (string) $sDate.sprintf('%04s', ($n +1));
    }

    public function getJawabanDetail()
    {
        return $this->hasMany(JawabanKuisionerDetail::className(),['code_jawaban' => 'code']);
    }

}
