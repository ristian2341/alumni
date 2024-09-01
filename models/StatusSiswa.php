<?php

namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "status_siswa".
 *
 * @property int $id
 * @property string|null $status
 */
class StatusSiswa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'status_siswa';
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
            [['status'], 'string', 'max' => 150],
            [['updated_by', 'created_by'], 'string', 'max' => 16],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status' => 'Status',
            'status_data' => 'Status Data',
            'created_at' => 'Created At',
            'updated_at' => 'Updateda At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }
}
