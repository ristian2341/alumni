<?php

namespace app\modules\master\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use app\models\User;

/**
 * This is the model class for table "master_kuisioner".
 *
 * @property string $code
 * @property string|null $code_jurusan
 * @property string|null $type 'MAGANG','ALUMNI'
 * @property string|null $pertanyaan
 * @property int|null $created_at
 * @property string|null $created_by
 * @property int|null $updated_at
 * @property string|null $updated_by
 */
class MasterKuisioner extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'master_kuisioner';
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
            [['pertanyaan'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['code', 'code_jurusan'], 'string', 'max' => 15],
            [['type'], 'string', 'max' => 100],
            [['pertanyaan'], 'string', 'max' => 255],
            [['created_by', 'updated_by'], 'string', 'max' => 16],
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
            'code_jurusan' => 'Code Jurusan',
            'type' => 'Type',
            'pertanyaan' => 'Pertanyaan',
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

    public function getMasterJurusan()
    {
        return $this->hasOne(Jurusan::className(),['code' => 'code_jurusan']);
    }
}
