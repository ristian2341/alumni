<?php

namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "menu".
 *
 * @property int $id_menu
 * @property string|null $nama
 * @property int|null $id_header
 * @property int|null $level
 * @property int|null $urutan
 * @property string|null $posisi left, top
 * @property int|null $read
 * @property int|null $create
 * @property int|null $update
 * @property int|null $delete
 * @property int|null $created_at
 * @property string|null $created_by
 * @property int|null $updated_at
 * @property string|null $updated_by
 */
class Menu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'menu';
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
            [['url_menu','nama'],'required'],
            [['id_header', 'level', 'urutan', 'read', 'create', 'update', 'delete', 'created_at', 'updated_at'], 'integer'],
            [['nama'], 'string', 'max' => 150],
            [['posisi','url_menu'], 'string', 'max' => 100],
            [['created_by', 'updated_by'], 'string', 'max' => 16],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_menu' => 'Id Menu',
            'nama' => 'Nama',
            'id_header' => 'Header Menu',
            'level' => 'Level',
            'url_menu' => 'Url',
            'urutan' => 'Urutan',
            // 'posisi' => 'Posisi',
            'read' => 'Read',
            'create' => 'Create',
            'update' => 'Update',
            'delete' => 'Delete',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    public function getHeader()
    {
        return $this::find()->where(['id_menu' => $this->id_header])->one();
    }
}
