<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property string $user_id
 * @property string|null $nis
 * @property string|null $username
 * @property string|null $password
 * @property string|null $full_name
 * @property string|null $type_akun 'CUSTOMER' | 'PO'
 * @property string|null $device_id
 * @property string|null $fire_base
 * @property string|null $email
 * @property int|null $last_login
 * @property int|null $long
 * @property int|null $lat
 * @property string|null $id_telegram
 * @property string|null $generate_code
 * @property string|null $type_user SISWA, PEGAWAI, PERUSAHAAN
 * @property int|null $developer
 * @property int|null $approval
 * @property int|null $admin
 * @property int|null $status
 * @property int|null $created_at
 * @property string|null $created_by
 * @property int|null $updated_at
 * @property string|null $updated_by
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['last_login', 'long', 'lat', 'developer', 'approval', 'admin', 'status', 'created_at', 'updated_at'], 'integer'],
            [['user_id', 'created_by', 'updated_by'], 'string', 'max' => 16],
            [['nis'], 'string', 'max' => 50],
            [['username', 'email', 'id_telegram', 'type_user'], 'string', 'max' => 100],
            [['password', 'device_id', 'fire_base'], 'string', 'max' => 255],
            [['full_name', 'type_akun'], 'string', 'max' => 150],
            [['generate_code'], 'string', 'max' => 10],
            [['user_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'nis' => 'Nis',
            'username' => 'Username',
            'password' => 'Password',
            'full_name' => 'Full Name',
            'type_akun' => 'Type Akun',
            'device_id' => 'Device ID',
            'fire_base' => 'Fire Base',
            'email' => 'Email',
            'last_login' => 'Last Login',
            'long' => 'Long',
            'lat' => 'Lat',
            'id_telegram' => 'Id Telegram',
            'generate_code' => 'Generate Code',
            'type_user' => 'Type User',
            'developer' => 'Developer',
            'approval' => 'Approval',
            'admin' => 'Admin',
            'status' => 'Status',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
}
