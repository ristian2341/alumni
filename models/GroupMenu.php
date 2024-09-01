<?php

namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use app\models\GroupMenuDetail;
use app\models\Menu;

/**
 * This is the model class for table "group_menu".
 *
 * @property int $id
 * @property string|null $nama
 * @property int|null $status
 * @property int|null $created_at
 * @property string|null $created_by
 * @property int|null $updated_at
 * @property string|null $updated_by
 */
class GroupMenu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'group_menu';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['nama'], 'string', 'max' => 100],
            [['created_by', 'updated_by'], 'string', 'max' => 16],
        ];
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
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => 'Nama',
            'status' => 'Status',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    public function getCreated()
    {
        $username = User::find()->select(['full_name'])->where(['user_id' => $this->created_by])->column();
        return $username[0];
    }

    public function getUpdated()
    {
        $username = User::find()->select(['full_name'])->where(['user_id' => $this->updated_by])->column();
        return $username[0];
    }

    public function getGroupdetail()
    { 
        return $this->hasMany(GroupMenuDetail::className(),['id_group' => 'id']);
    }
}
