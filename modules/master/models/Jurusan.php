<?php

namespace app\modules\master\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use app\models\User;

/**
 * This is the model class for table "jurusan".
 *
 * @property string|null $code
 * @property string|null $nama
 * @property int|null $status_data
 * @property string|null $created_by
 * @property int|null $created_at
 * @property string|null $updated_by
 * @property int|null $updated_at
 */
class Jurusan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jurusan';
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
            [['status_data', 'created_at', 'updated_at'], 'integer'],
            [['code'], 'string', 'max' => 15],
            [['nama'], 'string', 'max' => 100],
            [['created_by', 'updated_by'], 'string', 'max' => 16],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'code' => 'Code',
            'nama' => 'Nama',
            'status_data' => 'Status Data',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
        ];
    }

    public function getCode()
    {
        $sDate = date('Ymd');
        $count = $this->find()->where(['like','code',$sDate])->count();
        $n = 0;
        if($count > 0){
            $model = $this->find()->where(['like','code',$sDate])->orderBy(['code' => SORT_DESC])->one();
            $n = (int)substr($model->code, -3);
        }
        return (string) $sDate.sprintf('%03s', ($n +1));
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
