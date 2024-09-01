<?php

namespace app\models;

use Yii;
use app\models\Menu;

/**
 * This is the model class for table "group_menu_detail".
 *
 * @property int|null $id_group
 * @property int|null $id_menu
 * @property int|null $read
 * @property int|null $create
 * @property int|null $update
 * @property int|null $delete
 */
class GroupMenuDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'group_menu_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_group', 'id_menu', 'read', 'create', 'update', 'delete'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_group' => 'Id Group',
            'id_menu' => 'Id Menu',
            'read' => 'Read',
            'create' => 'Create',
            'update' => 'Update',
            'delete' => 'Delete',
        ];
    }

    public function getMenu()
    {
        return $this->hasOne(Menu::className(),['id_menu' => 'id_menu']);
    }
}
