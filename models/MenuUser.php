<?php

namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "menu_user".
 *
 * @property int $id_user_menu
 * @property string|null $user_id
 * @property int|null $id_menu
 * @property int|null $create
 * @property int|null $update
 * @property int|null $read
 * @property int|null $delete
 */
class MenuUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'menu_user';
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
            [['id_menu', 'create', 'update', 'read', 'delete','created_by','updated_by','created_at','updated_at'], 'integer'],
            [['user_id'], 'string', 'max' => 16],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_user_menu' => 'Id User Menu',
            'user_id' => 'User ID',
            'id_menu' => 'Id Menu',
            'create' => 'Create',
            'update' => 'Update',
            'read' => 'Read',
            'delete' => 'Delete',
        ];
    }
}
