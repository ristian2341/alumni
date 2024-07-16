<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "setting".
 *
 * @property int $id_setting
 * @property string|null $instansi
 * @property string|null $alamat_instansi
 * @property string|null $kabupaten
 * @property string|null $profinsi
 * @property string|null $nama_aplikasi
 * @property string|null $logo
 * @property string|null $background
 */
class Setting extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'setting';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['instansi', 'kabupaten', 'nama_aplikasi', 'logo'], 'string', 'max' => 100],
            [['alamat_instansi', 'profinsi', 'background'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_setting' => 'Id Setting',
            'instansi' => 'Instansi',
            'alamat_instansi' => 'Alamat Instansi',
            'kabupaten' => 'Kabupaten',
            'profinsi' => 'Profinsi',
            'nama_aplikasi' => 'Nama Aplikasi',
            'logo' => 'Logo',
            'background' => 'Background',
        ];
    }
}
